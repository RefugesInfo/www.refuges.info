
Documentée le 2026-10-20 (demande de sly) en attendant mieux (script + API ou routine, voir [[project-refuges-multilangue]] « traduction au fil de l'eau »). Première passe faite le jour même : 12 commentaires (ids 56895-56906, Italie/Suisse, surtout des liens chemineur.fr) + 4 lignes périmées (4848 proprietaires en ; 5243 remarques en+it ; 5815 remarques it). Procédure générale des lots : [[reference-refuges-multilangue-procedure]] ; quota : [[feedback-quota-seuil-traduction]] (lancer `~/.claude/quotas.sh` AVANT ; seuil 60 %, relevé à 90 % le 2026-10-20 seulement).

## Périmètre (décisions de sly, révisées le 2026-10-20 soir)
- **RÈGLE DE DÉCISION (sly, 2026-10-25) : le HASH SUFFIT pour savoir s'il faut générer une traduction.** Texte sans ligne `traductions`, ou ligne dont `hash_source <> md5(source)` → à traduire ; hash identique → rien à faire. Ne pas partir d'une extraction « langue manquante par langue » sur toute une fenêtre (2026-10-25 : j'ai extrait 171-229 items par langue pour des contenus du mois qui n'avaient que l'anglais, c'était trop long et hors procédure, interrompu par sly sans rien insérer). Combler it/es/de/fr sur d'anciens contenus déjà traduits en en = « stock du passé », seulement sur demande.
- **Reprise du stock sans traduction (sly, 2026-10-25) : quand sly aura un peu de quota, on retraduira les textes qui n'ont aujourd'hui aucune traduction.** **POUR L'INSTANT, une fiche de point situé dans un pays n'a besoin que de l'anglais + la langue parlée dans ce pays (FR → en ; IT → en+it ; ES → en+es ; DE/AT/CH → en+de), pas plus.** Les 5 langues partout (règle « TOUTES » ci-dessous) ne sont donc pas exigées pour le stock ; ne pas élargir sans demande. À clarifier avec sly si cette limite remplace aussi la règle « toutes langues » des passes au fil de l'eau.
- **Coût du fil de l'eau (sly, 2026-10-25) : ~200 textes par semaine au maximum, ça tient largement dans les quotas même en 4 langues** ; la limite « pays » du stock ne remplace PAS la règle « toutes langues » du fil de l'eau (confirmé par sly).
- **Fenêtre glissante de 1 MOIS (élargie par sly le 2026-10-25 ; était 15 jours), critère `date_derniere_modification` pour les fiches et `commentaires.date` pour les commentaires** (sly : une fiche récemment modifiée est plus intéressante qu'une modifiée il y a des années ; ancien critère `date_creation` abandonné). Contenus visibles (`NOT cache AND modele<>1`), texte non vide.
- **PENSER À L'ALLEMAND (de) : cinquième langue à inclure dans chaque passe (demande de sly 2026-10-25)**, y compris hors DE/AT/CH ; glossaire `glossaire-de.md`, VALUES des requêtes à 5 langues ('de' en plus). `de` n'est pas encore langue d'affichage du site.
- **Langues actives : fr, en, it, es (+ de, voir ci-dessus), TOUTES** pour tout ce qui est dans la fenêtre : on comble toutes les lignes manquantes (y compris it/es sur des commentaires ou champs déjà traduits en en), même pour une fiche hors Italie. Pour la langue de la source : ligne `texte` NULL. Commentaire déjà dans une langue cible : pas de traduction (NULL). URL seule (rien à traduire) : NULL dans toutes les langues.
- **Lignes périmées** (`hash_source <> md5(source)`) : retraduites dans les langues où la ligne existe déjà (aussi pour les contenus hors fenêtre si la détection les voit).
- **Hors périmètre (le « stock du passé »)** : tout contenu non modifié/non commenté dans le mois (fiches anciennes sans ligne, langues manquantes sur de vieux contenus). **Raison : quota insuffisant et non prioritaire.** Projet de sly pour plus tard : traduire tout le stock, soit avec des quotas non utilisés avant leur remise à zéro, soit avec des financements reçus (plutôt en lots opportunistes ou via API, voir [[project-refuges-multilangue]]). Ne pas le lancer sans demande.

## Historique des passes
- 2026-10-20 (après-midi) : 12 commentaires + 4 lignes périmées.
- 2026-10-20 (soir, fenêtre 15 j) : 142 commentaires (tous fr), 130 champs de fiche (54 fiches) → 259 lignes fr (NULL), 12 en, 247 it, 257 es. Coût mesuré : ~71 k car. lus (27 k commentaires + 44 k champs) et ~100 k car. écrits, en une seule session sans fork : quota 5h 87 → 94 % (+7), hebdo 65 → 66 % (+1). Plafond du jour relevé à 90 %.
- 2026-10-20 (nuit, 3e passe) : 8 commentaires (56902 périmé, 56912-56919) + 7 champs de fiche (2854, 11683 périmés ; 11818, 11819 nouvelles) → 15 lignes fr/en/it, 13 es ; contrôles à 0. Requêtes de détection avec fenêtre 15 j (commentaires.date / date_derniere_modification) : voir étape 2 en remplaçant les NOT EXISTS par un filtre de date.
- 2026-10-25 (fenêtre 15 j, + allemand) : 42 commentaires + 91 champs de fiche en fr/en/it/es/de (133 lignes par langue ; en 119) puis, pour de seulement, 218 contenus déjà faits dans les 4 autres langues (119 commentaires, 99 champs). Cas mixtes `co+fr` (10830) et `it+fr` (11517) ; commentaire en anglais 57003 → fr/it/es/de traduits, en NULL. Quotas fin de passe : 5h 21 %, hebdo 36 %. Contrôles à 0 (5 langues).

## Étapes
1. `~/.claude/quotas.sh` (code 0 = ok).
2. Détecter (remplacer `now()-interval '15 days'` par la fenêtre voulue ; prod, lecture : `sudo -n ssh refuges 'sudo -u postgres psql -d refuges -At' < requetes.sql`) :
```sql
\echo == lignes par langue (hors wiki)
SELECT langue,type_objet,count(*) FROM traductions WHERE type_objet<>'wiki' GROUP BY 1,2 ORDER BY 1,2;
\echo == commentaires visibles avec texte, sans AUCUNE ligne traductions
SELECT count(*), sum(length(c.texte)) FROM commentaires c JOIN points p USING(id_point) WHERE NOT p.cache AND p.modele<>1 AND length(trim(c.texte))>1
 AND NOT EXISTS (SELECT 1 FROM traductions t WHERE t.type_objet='commentaire' AND t.id_objet=c.id_commentaire);
\echo == idem mais manquant dans au moins une des 4 langues (par langue)
SELECT l.langue, count(*) FROM commentaires c JOIN points p USING(id_point), (VALUES ('fr'),('en'),('it'),('es')) l(langue)
 WHERE NOT p.cache AND p.modele<>1 AND length(trim(c.texte))>1
 AND NOT EXISTS (SELECT 1 FROM traductions t WHERE t.type_objet='commentaire' AND t.id_objet=c.id_commentaire AND t.langue=l.langue) GROUP BY 1 ORDER BY 1;
\echo == lignes périmées (par type, langue)
SELECT t.type_objet,t.langue,count(*) FROM traductions t
 LEFT JOIN commentaires c ON t.type_objet='commentaire' AND c.id_commentaire=t.id_objet
 LEFT JOIN points p ON t.type_objet='point' AND p.id_point=t.id_objet
 WHERE t.type_objet IN ('commentaire','point') AND t.hash_source<>md5(coalesce(CASE WHEN t.type_objet='commentaire' THEN c.texte WHEN t.champ='remarques' THEN p.remarques WHEN t.champ='acces' THEN p.acces ELSE p.proprietaires END,'')) GROUP BY 1,2 ORDER BY 1,2;
\echo == fiches visibles avec texte sans AUCUNE ligne
SELECT count(*) FROM points p WHERE NOT p.cache AND p.modele<>1 AND (length(trim(coalesce(remarques,'')))>1 OR length(trim(coalesce(acces,'')))>1 OR length(trim(coalesce(proprietaires,'')))>1)
 AND NOT EXISTS (SELECT 1 FROM traductions t WHERE t.type_objet='point' AND t.id_objet=p.id_point);
```
3. Extraire les textes sources (`@@C id` / `@@P id champ`, corps = source), vérifier les anciennes traductions des périmées (cohérence terminologique), lire glossaires : `ressources/traduction/contexte.md`, `glossaire-en.md`, `glossaire-it.md`, `glossaire-es.md` (dépôt dev `~/sly.refuges.info` sur `ssh refuges`). it = tutoiement ; « gîte d'étape » = « alloggio di tappa (gîte d'étape) » / « albergue de etapa (gîte d'étape) » / « stage lodging ».
4. Écrire un fichier par langue cible : `src.<cible>.txt` (sources) et `<cible>.txt` (traductions), mêmes marqueurs, `NULL` si rien à traduire. Les URL, pseudos, téléphones, mails restent inchangés ; seuls les préfixes (« Photos : », « Voir aussi : ») se traduisent.
5. `python3 -I insere_multi.py DOSSIER <cible>` pour chaque cible (vérifie la couverture, génère `<cible>.sql`), puis `sudo -n ssh refuges "sudo -u postgres psql -q -At -v ON_ERROR_STOP=1 -d refuges" < <cible>.sql`.
6. Relancer les requêtes de l'étape 2 : doit afficher 0 commentaire sans ligne et 0 périmée. Supprimer les fichiers temporaires.

Le script fait un `ON CONFLICT DO UPDATE` (nouvelles lignes ET rafraîchissement des périmées), calcule le hash en SQL, restitue les `\r\n` si la source en contient, s'exécute sous `SET ROLE refuges` (sur testsly : `SET ROLE slydb`).

```python
"""Usage: python3 -I insere_multi.py DOSSIER CIBLE   (lit DOSSIER/src.CIBLE.txt et DOSSIER/CIBLE.txt, écrit DOSSIER/CIBLE.sql)
Format des deux fichiers : blocs '@@C id [langue_source]' (commentaire) ou '@@P id champ [langue_source]' (champ de fiche),
corps = texte ; corps 'NULL' = pas de traduction nécessaire (déjà dans la langue cible, ou rien à traduire : URL seule).
INSERT ... ON CONFLICT DO UPDATE : sert aussi bien aux nouvelles lignes qu'au rafraîchissement des lignes périmées (hash recalculé par PostgreSQL)."""
import re, sys
D, cible = sys.argv[1].rstrip('/') + '/', sys.argv[2]
def parse(path):
    blocs, cle, buf = {}, None, []
    for l in open(path, encoding='utf-8').read().split('\n'):
        m = re.match(r'^@@([CP]) (.*)$', l)
        if m:
            if cle: blocs[cle] = '\n'.join(buf).strip('\n')
            p = m.group(2).split()
            cle = ('C', int(p[0]), 'texte', p[1] if len(p) > 1 else 'fr') if m.group(1) == 'C' else ('P', int(p[0]), p[1], p[2] if len(p) > 2 else 'fr')
            buf = []
        else: buf.append(l)
    if cle: blocs[cle] = '\n'.join(buf).strip('\n')
    return blocs
src, tr = parse(D + 'src.' + cible + '.txt'), parse(D + cible + '.txt')
ks = lambda d: {(t, i, c) for (t, i, c, _s) in d}
if ks(src) != ks(tr): sys.exit("couverture : manquantes %s, en trop %s" % (sorted(ks(src) - ks(tr)), sorted(ks(tr) - ks(src))))
if any(v.strip() == '' for v in tr.values()): sys.exit("corps vide (mettre NULL)")
out = ["SET ROLE refuges;", "BEGIN;"]
for (t, i, c, ls) in tr:
    txt = tr[(t, i, c, ls)]; assert '$t$' not in txt
    tbl, col, key, typ = ('commentaires', 'texte', 'id_commentaire', 'commentaire') if t == 'C' else ('points', c, 'id_point', 'point')
    val = 'NULL' if txt == 'NULL' else f"CASE WHEN {col} LIKE E'%\\r\\n%' THEN replace($t${txt}$t$, E'\\n', E'\\r\\n') ELSE $t${txt}$t$ END"
    out.append(f"INSERT INTO traductions (type_objet,id_objet,cle_objet,champ,langue,langue_source,hash_source,texte,moteur) SELECT '{typ}',{key},'','{c}','{cible}','{ls}',md5({col}),{val},'claude-sonnet-5-5' FROM {tbl} WHERE {key}={i} AND {col} IS NOT NULL "
               f"ON CONFLICT (type_objet,id_objet,cle_objet,champ,langue) DO UPDATE SET langue_source=EXCLUDED.langue_source,hash_source=EXCLUDED.hash_source,texte=EXCLUDED.texte,moteur=EXCLUDED.moteur,date_traduction=now();")
out.append("COMMIT;")
open(D + cible + '.sql', 'w', encoding='utf-8').write('\n'.join(out) + '\n'); print(cible, "SQL écrit :", len(tr), "lignes")
```

## Pièges
- Des contenus arrivent pendant la session (commentaire 56911, fiche 5343 modifiée en cours de route) : relancer les requêtes de contrôle à la fin et compléter.
- Méthode de la passe « tout fr/en/it/es sur 15 jours » : extraire commentaires (`c.txt`) et champs (`p.txt`) avec en en-tête les lignes déjà présentes (`[en/fr,es/fr]`), traduire seulement it/es (et en si absent) dans un fichier à sections `--it` / `--es` / `--en`, puis un script (non conservé, simple) répartit par langue cible : lignes déjà présentes et non périmées ignorées, langue de la source → NULL, vérifie qu'aucune ligne manquante ne reste, puis `insere_multi.py` par cible.
- Une source peut changer entre l'extraction et l'insertion → refaire l'étape 6.
- Fiche 4848 : périmée alors que le texte anglais était identique (différence de blancs/`\r\n` en source) → retraduction = même texte, hash rafraîchi.
- Ne pas confondre avec les fiches « modèles » (`modele=1`, voir [[reference-refuges-ajout-langue-checklist]] point 11) : exclues par `p.modele<>1`.

## Passe du 2026-10-26 (sly, quota en rab avant remise à zéro)
- 25 lignes périmées (7 commentaires + 18 champs, en) + 4 lignes wiki `cookies` (en/it/es/de, phrase des langues patchée en SQL puis hash recalculé) ; puis 5 commentaires + 12 fiches neuves en fr/en/it/es/de (100 lignes). Fenêtre = 1 mois, « tous les commentaires récents, pas toute la base ».
- **Coût mesuré par sly : quota 43 % → 43 %, soit < 1 %** pour ~15 k + ~10 k car. en session directe, sans fork.
- `~/.claude/quotas.sh` n'existe plus (absent le 2026-10-26) : le quota se lit via `/usage` demandé à sly.
- Pour une ligne dont la source est devenue vide : insérer `NULL` (hash rafraîchi), pas de suppression. Détection fiches : colonne `points.id_point_type` (pas id_type_point).
