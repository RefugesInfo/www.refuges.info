#!/usr/bin/python3 -I
"""Traduction « au fil de l'eau » de refuges.info (prototype, à lancer sur hq par cron : python3 -I fil-eau.py).

Étapes : détection SQL (hash) -> tampon anti-édition -> plafond -> quota -> claude -p (traduction seule, outils
Read/Write dans un dossier de travail) -> validation déterministe -> insertion SQL. Le LLM n'a ni shell ni base.
Options : --dry (détection seule, rien d'écrit), --sans-insertion (traduit et valide, écrit le SQL sans l'exécuter,
garde le dossier de travail), --max N, --tampon MIN, --seuil POURCENT."""
import argparse, datetime, fcntl, json, os, re, secrets, shutil, subprocess, sys, tarfile, io, time

RACINE = os.path.dirname(os.path.abspath(__file__))
LANGUES = ['fr', 'en', 'it', 'es', 'de']
CHAMPS = ('texte', 'remarques', 'acces', 'proprietaires', 'contenu', 'titre_sujet')
FORUMS_EXCLUS = '7,11'   # modérateurs, contacts (tout en français)
FORUM_TITRES_EXCLUS = 4   # titres créés automatiquement depuis les fiches
CLAUDE = '/home/users/sly/.local/bin/claude'
QUOTAS = '/home/users/sly/.claude/quotas.sh'
MODELE = 'claude-sonnet-5-5'
SSH = ['ssh', '-o', 'BatchMode=yes', '-o', 'ConnectTimeout=10', 'refuges']
PSQL = SSH + ['psql -w -U refuges -d refuges -At -q -v ON_ERROR_STOP=1']
TRAVAIL = '/home/users/sly/traduction-travail'  # hors ~/.claude : Claude Code y interdit l'écriture
MAX_ECHECS = 3
MAX_CARACTERES = 40000
ARRIERE_ALERTE = 50
os.environ['PATH'] += ':/home/users/sly/.local/bin'

SQL_DETECTION = """
WITH src AS (
 SELECT 'C' AS t, 'commentaire' AS typ, c.id_commentaire AS id, 'texte' AS champ, c.texte AS texte, c.date::timestamptz AS d, ''::text AS cle
 FROM commentaires c JOIN points p USING(id_point)
 WHERE NOT p.cache AND p.modele<>1 AND length(trim(c.texte))>1
 UNION ALL
 SELECT 'P', 'point', p.id_point, v.champ, v.texte, p.date_derniere_modification, ''
 FROM points p, LATERAL (VALUES ('remarques',p.remarques),('acces',p.acces),('proprietaires',p.proprietaires)) v(champ,texte)
 WHERE NOT p.cache AND p.modele<>1 AND length(trim(coalesce(v.texte,'')))>1
 UNION ALL
 SELECT 'W', 'wiki', 0, 'contenu', w.contenu, w.date, w.nom_page::text
 FROM (SELECT DISTINCT ON (nom_page) nom_page, contenu, date FROM pages_wiki ORDER BY nom_page, date DESC) w
 WHERE length(trim(coalesce(w.contenu,'')))>1 AND w.nom_page NOT IN ('bandeau','bbcode_tests')
 UNION ALL
 SELECT 'F', 'post_forum', f.post_id, 'texte', f.post_text, to_timestamp(greatest(f.post_time, f.post_edit_time)), ''
 FROM phpbb3_posts f
 WHERE f.post_visibility=1 AND f.forum_id NOT IN (@@FORUMS_EXCLUS@@) AND f.post_attachment=0 AND length(trim(coalesce(f.post_text,'')))>1
 UNION ALL
 SELECT 'T', 'post_forum', tp.topic_id, 'titre_sujet', tp.topic_title, to_timestamp(tp.topic_time), ''
 FROM phpbb3_topics tp
 WHERE tp.topic_visibility=1 AND tp.forum_id NOT IN (@@FORUMS_EXCLUS@@, @@FORUM_TITRES_EXCLUS@@) AND length(trim(coalesce(tp.topic_title,'')))>1
), cand AS (
 SELECT s.*, md5(s.texte) AS h,
  coalesce((SELECT array_agg(t.langue::text ORDER BY t.langue) FROM traductions t WHERE t.type_objet=s.typ AND t.id_objet=s.id AND t.cle_objet=s.cle AND t.champ=s.champ AND t.hash_source<>md5(s.texte)), '{}'::text[]) AS perimees,
  EXISTS (SELECT 1 FROM traductions t WHERE t.type_objet=s.typ AND t.id_objet=s.id AND t.cle_objet=s.cle AND t.champ=s.champ) AS a_lignes
 FROM src s
)
SELECT json_agg(r ORDER BY r.d) FROM (
 SELECT q.t, q.id, q.cle, q.champ, q.h, q.texte, q.d, q.langues, count(*) OVER () AS total FROM (
  SELECT t, id, cle, champ, h, texte, d,
   CASE WHEN cardinality(perimees)>0 THEN perimees
        WHEN NOT a_lignes AND d > now() - interval '1 month' THEN CASE WHEN t IN ('W','F','T') THEN ARRAY['en','it','es','de'] ELSE ARRAY['fr','en','it','es','de'] END
        ELSE '{}'::text[] END AS langues
  FROM cand) q
 WHERE cardinality(q.langues)>0 ORDER BY q.d LIMIT 200) r;
"""

SQL_DETECTION = SQL_DETECTION.replace('@@FORUMS_EXCLUS@@', FORUMS_EXCLUS).replace('@@FORUM_TITRES_EXCLUS@@', str(FORUM_TITRES_EXCLUS))

URL = re.compile(r'https?://[^\s<>\[\]"\']+')
MAIL = re.compile(r'[\w.+-]+@[\w-]+(?:\.[\w-]+)+')
CIBLE_LIEN = re.compile(r'(?:\[url=|href="|\]\()(/[^\]"\s)]*)')
ENTETE_SORTIE = re.compile(r'^@@ ([CPWFT]) (\d+) (\w+) ([a-z]{2}) ([a-z]{2}(?:\+[a-z]{2})*)\s*$')


def journal(msg):
    print(datetime.datetime.now().strftime('%F %T'), msg, flush=True)


def psql(sql):
    r = subprocess.run(PSQL, input=sql, capture_output=True, text=True, timeout=120)
    if r.returncode:
        raise RuntimeError('psql : ' + r.stderr.strip()[:500])
    return r.stdout


def jetons(s):
    return {u.rstrip('.,;:)!?') for u in URL.findall(s)} | {m.rstrip('.') for m in MAIL.findall(s)}


def sans_lettres(s):
    s = re.sub(r'<[^>]*>|\[/?[a-zA-Z]+(?:=[^\]]*)?\]', '', s)  # balises XML phpBB / BBCode
    return not re.search(r'[^\W\d_]', URL.sub('', MAIL.sub('', s)))


BALISE = re.compile(r'\[(/?[a-z]+)(?:=[^\]]*)?\]|<(/?[a-zA-Z0-9]+)[^>]*>')


def balises(s):
    return sorted(a or b for a, b in BALISE.findall(s))


def cibles_liens(s):
    """Liens internes /xxx du texte, normalisés (suffixe de langue /en/ retiré), pour comparer source et traduction."""
    out = []
    for t in CIBLE_LIEN.findall(s):
        m = re.match(r'([^?#]*)(.*)$', t)
        out.append(re.sub(r'/(?:en|it|es|de)(?=/|$)', '', m.group(1)).rstrip('/') + m.group(2))
    return sorted(out)


TAG_XML = re.compile(r'<[A-Za-z][^>]*>')


def valider(src, cible, langue_src, trad, type_contenu=''):
    """-> (traduction à insérer ou None pour NULL, raison du refus ou None)."""
    sources = langue_src.split('+')
    if trad is None or trad.strip() == 'NULL':
        if cible in sources or sans_lettres(src):
            return None, None
        return None, "NULL alors que la source n'est pas en " + cible
    if sources == [cible]:
        return None, None  # déjà dans la langue cible : traduction ignorée
    if trad.strip() == '':
        return None, 'traduction vide'
    if re.search(r'(?m)^@@', trad):
        return None, "ligne commençant par '@@' dans la traduction"
    if jetons(src) != jetons(trad):
        return None, 'URL/e-mails différents : %s' % sorted(jetons(src) ^ jetons(trad))[:3]
    if balises(src) != balises(trad):
        return None, 'balises BBCode/HTML différentes'
    if type_contenu == 'F' and sorted(TAG_XML.findall(src)) != sorted(TAG_XML.findall(trad)):
        return None, 'balises XML phpBB (attributs compris) différentes'
    if type_contenu == 'T' and (re.search(r'[<>]', trad) or sorted(re.findall(r'&[#\w]+;', src)) != sorted(re.findall(r'&[#\w]+;', trad))):
        return None, 'entités HTML du titre modifiées'
    if cibles_liens(src) != cibles_liens(trad):
        return None, 'liens internes différents'
    if len(src) >= 40 and not 0.3 <= len(trad) / len(src) <= 3.5:
        return None, 'longueur suspecte (%d -> %d)' % (len(src), len(trad))
    return trad.replace('\r\n', '\n'), None


def lire_etat():
    try:
        return json.load(open(os.path.join(RACINE, 'etat.json')))
    except (OSError, ValueError):
        return {}


def cle(c):
    return '%s:%s:%s' % (c['t'], c['id'], c['champ']) + (':' + c['cle'] if c['cle'] else '')


def parser_traductions(chemin):
    blocs, courant, buf = {}, None, []
    for ligne in open(chemin, encoding='utf-8').read().split('\n'):
        if ligne.startswith('@@'):
            if courant:
                blocs[courant[:4]] = ('\n'.join(buf).strip('\n'), courant[4])
            m = ENTETE_SORTIE.match(ligne)
            courant = (m.group(1), int(m.group(2)), m.group(3), m.group(4), m.group(5)) if m else None
            buf = []
        else:
            buf.append(ligne)
    if courant:
        blocs[courant[:4]] = ('\n'.join(buf).strip('\n'), courant[4])
    return blocs


def sql_insertion(lots):
    out = ['BEGIN;']
    for (t, i, champ, cible, src_lang, h, texte_trad, cle_page) in lots:
        assert champ in CHAMPS and re.fullmatch(r'[a-z]{2}', cible) and re.fullmatch(r'[a-z]{2}(\+[a-z]{2})*', src_lang)
        if t in 'FT':
            tbl, col, cl = ('phpbb3_posts', 'post_text', 'post_id') if t == 'F' else ('phpbb3_topics', 'topic_title', 'topic_id')
            typ, cle_sql, filtre_id = 'post_forum', "''", '%s=%d AND ' % (cl, i)
        elif t == 'W':
            ptag = '$p%s$' % secrets.token_hex(4)
            nom = ptag + cle_page + ptag
            assert ptag not in cle_page
            tbl, col, cl, typ = ("(SELECT contenu FROM pages_wiki WHERE nom_page=%s ORDER BY date DESC LIMIT 1) w" % nom, 'w.contenu', '0', 'wiki')
            cle_sql, filtre_id = nom, ''
        else:
            tbl, col, cl, typ = ('commentaires', 'texte', 'id_commentaire', 'commentaire') if t == 'C' else ('points', champ, 'id_point', 'point')
            cle_sql, filtre_id = "''", '%s=%d AND ' % (cl, i)
        if texte_trad is None:
            val = 'NULL'
        else:
            tag = '$t%s$' % secrets.token_hex(4)
            val = "CASE WHEN {c} LIKE E'%\\r\\n%' THEN replace({g}{x}{g}, E'\\n', E'\\r\\n') ELSE {g}{x}{g} END".format(c=col, g=tag, x=texte_trad)
        out.append(
            "INSERT INTO traductions (type_objet,id_objet,cle_objet,champ,langue,langue_source,hash_source,texte,moteur) "
            "SELECT '%s',%d,%s,'%s','%s','%s',md5(%s),%s,'%s' FROM %s WHERE %smd5(%s)='%s' "
            "ON CONFLICT (type_objet,id_objet,cle_objet,champ,langue) DO UPDATE SET langue_source=EXCLUDED.langue_source,"
            "hash_source=EXCLUDED.hash_source,texte=EXCLUDED.texte,moteur=EXCLUDED.moteur,date_traduction=now();"
            % (typ, i, cle_sql, champ, cible, src_lang, col, val, MODELE, tbl, filtre_id, col, h))
    out.append('COMMIT;')
    return '\n'.join(out) + '\n'


def quota(seuil):
    r = subprocess.run([QUOTAS, str(seuil)], capture_output=True, text=True, timeout=180)
    return r.returncode, r.stdout.strip()


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('--dry', action='store_true')
    ap.add_argument('--sans-insertion', action='store_true')
    ap.add_argument('--max', type=int, default=10)
    ap.add_argument('--types', default='CPWFT', help='sous-ensemble de C(ommentaires) P(champs de fiche) W(iki) F(messages forum) T(itres de sujets), pour les tests')
    ap.add_argument('--tampon', type=int, default=30, help='minutes de stabilité du hash avant traduction')
    ap.add_argument('--seuil', type=int, default=None, help='quota max en %% (défaut 60, 80 le mardi)')
    a = ap.parse_args()
    seuil = a.seuil or (80 if datetime.date.today().weekday() == 1 else 60)

    verrou = open(os.path.join(RACINE, 'verrou'), 'w')
    try:
        fcntl.flock(verrou, fcntl.LOCK_EX | fcntl.LOCK_NB)
    except OSError:
        return 0  # une autre passe tourne

    debut = time.time()
    brut = psql(SQL_DETECTION).strip()
    cands = json.loads(brut) if brut and brut != 'null' else []
    cands = [c for c in cands if c['t'] in a.types]
    total = cands[0]['total'] if cands else 0
    etat, maintenant = lire_etat(), time.time()
    nouvel_etat, pretes = {}, []
    for c in cands:
        k = cle(c)
        vu = etat.get(k)
        e = vu if vu and vu['h'] == c['h'] else {'h': c['h'], 'vu': maintenant, 'echecs': 0}
        nouvel_etat[k] = e
        c['attente'] = max(0, a.tampon * 60 - (maintenant - e['vu']))
        c['echecs'] = e['echecs']
        if c['attente'] == 0 and e['echecs'] < MAX_ECHECS and not re.search(r'(?m)^@@', c['texte']):
            pretes.append(c)
    fichier_alerte = os.path.join(RACINE, 'derniere_alerte')
    if total > ARRIERE_ALERTE and not a.dry and (not os.path.exists(fichier_alerte) or time.time() - os.path.getmtime(fichier_alerte) > 12 * 3600):
        open(fichier_alerte, 'w').close()  # au plus une alerte d'arriéré toutes les 12 h (sinon un mail par heure)
        print('ALERTE refuges-traduction : %d contenus en attente de traduction (> %d), flood possible ?' % (total, ARRIERE_ALERTE), file=sys.stderr)

    lot, nb_car = [], 0
    for c in pretes:
        if len(lot) >= a.max or (lot and nb_car + len(c['texte']) > MAX_CARACTERES):
            break
        lot.append(c)
        nb_car += len(c['texte'])

    for n, c in enumerate(lot):
        c['num'] = c['id'] if c['t'] != 'W' else n + 1  # une page wiki n'a pas d'id : numéro propre à la passe
    if a.dry:
        journal('DRY : %d contenus à traiter au total, %d prêts, lot de %d (%d car.)' % (total, len(pretes), len(lot), nb_car))
        for c in cands[:30]:
            statut = 'ECHECS' if c['echecs'] >= MAX_ECHECS else ('attend %d min' % -(-c['attente'] // 60) if c['attente'] else 'prête')
            print('  %s %-7s %-14s %-24s %5d car. langues=%s [%s]' % (c['t'], c['id'] or c['cle'][:30], c['champ'], c['d'][:19], len(c['texte']), ','.join(c['langues']), statut))
        return 0
    json.dump(nouvel_etat, open(os.path.join(RACINE, 'etat.json'), 'w'))
    if not lot:
        return 0

    code, q_avant = quota(seuil)
    if code == 2:
        print('quotas indisponibles (token expiré ?) : %s' % q_avant, file=sys.stderr)
        return 2
    if code == 1:
        journal('passe sautée, quota au-dessus de %d %% (%s), %d contenus prêts' % (seuil, q_avant, len(lot)))
        return 0

    travail = os.path.join(TRAVAIL, datetime.datetime.now().strftime('%Y%m%d-%H%M%S'))
    os.makedirs(travail)
    r = subprocess.run(SSH + ['cd ~/sly.refuges.info/ressources/traduction && tar cf - contexte.md glossaire-en.md glossaire-it.md glossaire-es.md glossaire-de.md'],
                       capture_output=True, timeout=60)
    if r.returncode:
        print('glossaires illisibles : ' + r.stderr.decode()[:300], file=sys.stderr)
        return 1
    tarfile.open(fileobj=io.BytesIO(r.stdout)).extractall(travail, filter='data')
    with open(os.path.join(travail, 'a_traduire.txt'), 'w', encoding='utf-8') as f:
        for c in lot:
            f.write('@@ %s %s %s cibles=%s\n%s\n' % (c['t'], c['num'], c['champ'], ','.join(c['langues']), c['texte'].replace('\r\n', '\n').strip('\n')))
    prompt = open(os.path.join(RACINE, 'prompt.md'), encoding='utf-8').read()

    r = subprocess.run([CLAUDE, '-p', '--model', MODELE, '--tools', 'Read,Write', '--allowedTools', 'Read,Write', '--permission-mode', 'acceptEdits',
                        '--no-session-persistence', '--output-format', 'json'],
                       input=prompt, capture_output=True, text=True, cwd=travail, timeout=1500)
    tokens = {}
    try:
        tokens = json.loads(r.stdout).get('usage', {})
    except ValueError:
        pass
    sortie = os.path.join(travail, 'traductions.txt')
    if r.returncode or not os.path.exists(sortie):
        print('claude a échoué (code %s, dossier %s) : %s' % (r.returncode, travail, (r.stderr or r.stdout)[:500]), file=sys.stderr)
        return 1

    blocs = parser_traductions(sortie)
    lots, ok_items, ko = [], 0, []
    for c in lot:
        k = cle(c)
        lignes, erreurs = [], []
        for cible in c['langues']:
            corps_src = c['texte'].replace('\r\n', '\n').strip('\n')
            b = blocs.get((c['t'], c['num'], c['champ'], cible))
            if b is None:
                erreurs.append('%s manquante' % cible)
                continue
            trad, raison = valider(corps_src, cible, b[1], b[0], c['t'])
            if raison:
                erreurs.append('%s : %s' % (cible, raison))
            else:
                lignes.append((c['t'], c['id'], c['champ'], cible, b[1], c['h'], trad, c['cle']))
        if erreurs:
            ko.append((c, erreurs))
            nouvel_etat[k]['echecs'] += 1
            journal('REFUS %s : %s' % (k, '; '.join(erreurs)))
            if nouvel_etat[k]['echecs'] == MAX_ECHECS:
                print('ALERTE refuges-traduction : %s refusé %d fois, abandonné (voir journal)' % (k, MAX_ECHECS), file=sys.stderr)
        lots.extend(lignes)  # les langues valides sont insérées même si une autre est refusée
        ok_items += 0 if erreurs else 1

    sql = sql_insertion(lots)
    if a.sans_insertion:
        open(os.path.join(travail, 'insertion.sql'), 'w', encoding='utf-8').write(sql)
        journal('SANS INSERTION : %d lignes validées, %d contenus refusés, SQL et dossier conservés dans %s' % (len(lots), len(ko), travail))
        return 0
    if lots:
        psql(sql)
    json.dump(nouvel_etat, open(os.path.join(RACINE, 'etat.json'), 'w'))
    _, q_apres = quota(100)
    entree = {'ts': datetime.datetime.now().isoformat(timespec='seconds'), 'en_attente': total, 'lot': len(lot), 'contenus_ok': ok_items,
              'refus': len(ko), 'lignes': len(lots), 'car_source': nb_car, 'duree_s': round(time.time() - debut),
              'quota_avant': q_avant, 'quota_apres': q_apres, 'usage': tokens}
    open(os.path.join(RACINE, 'journal.jsonl'), 'a').write(json.dumps(entree, ensure_ascii=False) + '\n')
    journal('OK : %d/%d contenus, %d lignes insérées, %d car. source, quota %s -> %s' % (ok_items, len(lot), len(lots), nb_car, q_avant, q_apres))
    shutil.rmtree(travail)
    return 0


if __name__ == '__main__':
    sys.exit(main())
