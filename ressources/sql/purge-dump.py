#!/usr/bin/env python3
"""Purge d un dump PostgreSQL de refuges.info : retire données personnelles et secrets.
Usage : purge-dump.py dump_brut.sql dump_purge.sql
(utilisé par `make db-dump`, voir docker/README.md)
"""
import re,sys

HASH_MDP_TEST = '$2y$12$4jsYQfYyn1cYt0AEJkoV3u6VDrtaYsiMdMdZ3.Gg52zwhpnDRWB6C'   # mot de passe de test : admin

# Tables dont on vide entièrement le contenu (structure conservée)
VIDER = {
    'phpbb3_privmsgs','phpbb3_privmsgs_to','phpbb3_log','phpbb3_sessions','phpbb3_sessions_keys',
    'phpbb3_login_attempts','phpbb3_qa_confirm','phpbb3_confirm','phpbb3_notifications','phpbb3_banlist',
    'phpbb3_cleantalk_sfw','phpbb3_cleantalk_sfw_logs','emails_bounce','phpbb3_drafts','phpbb3_reports',
}
# Colonnes remplacées par une valeur fixe (table -> {colonne: valeur en format COPY})
FIXER = {
    'phpbb3_posts': {'poster_ip': '0.0.0.0'},
    'phpbb3_poll_votes': {'vote_user_ip': '0.0.0.0'},
}
# Colonnes des utilisateurs (type 2 = robots phpBB, laissés tels quels)
USERS_VIDER = ('user_ip','user_actkey','user_last_confirm_key')
USERS_ZERO = ('user_passchg','user_emailtime')
# Valeurs de configuration remplacées (table config)
CONFIG = {
    'server_name':'localhost','sitename':'Forum refuges.info (instance de developpement)',
    'site_desc':'Instance de developpement','board_email':'noreply@example.invalid',
    'board_contact':'noreply@example.invalid','board_email_sig':'','email_enable':'0',
    'cookie_domain':'','cookie_secure':'0',
}

src,dst = sys.argv[1],sys.argv[2]

# Forums non publics : 7 = coin des modérateurs, 15 = Contacts (messages du formulaire de contact)
FORUMS_VIDES = {'7','15'}
def ids_forums_vides(table, col_id, col_forum):
    ids=set(); t=None; cs=[]
    for l in open(src,encoding='utf-8'):
        if l.startswith('COPY '):
            m=re.match(r'COPY public\.(\S+) \((.*)\) FROM stdin;',l)
            t=m.group(1) if m and m.group(1)==table else None
            cs=[c.strip().strip('"') for c in m.group(2).split(',')] if t else []
            continue
        if t:
            if l.startswith('\\.'): t=None; continue
            f=l.rstrip('\n').split('\t')
            if f[cs.index(col_forum)] in FORUMS_VIDES: ids.add(f[cs.index(col_id)])
    return ids
TOPICS_VIDES=ids_forums_vides('phpbb3_topics','topic_id','forum_id')
POSTS_VIDES=ids_forums_vides('phpbb3_posts','post_id','forum_id')
tbl=None; cols=[]; nb=0
out=open(dst,'w',encoding='utf-8')
for line in open(src,encoding='utf-8'):
    # Commandes psql "\restrict" (pg_dump >= 17.6) et paramètre inconnu des PostgreSQL plus anciens
    if re.match(r'(REVOKE|GRANT) .* ON TABLE public\.spatial_ref_sys ', line): continue   # rôles absents ailleurs
    if line.startswith('\\restrict') or line.startswith('\\unrestrict') or line.startswith('SET transaction_timeout'):
        continue
    if line.startswith('COPY '):
        m=re.match(r'COPY public\.(\S+) \((.*)\) FROM stdin;',line)
        tbl=m.group(1) if m else None
        cols=[c.strip().strip('"') for c in m.group(2).split(',')] if m else []
        out.write(line); continue
    if tbl is None:
        out.write(line); continue
    if line.startswith('\\.'):
        tbl=None; out.write(line); continue
    if tbl in VIDER:
        continue
    f=line.rstrip('\n').split('\t')
    if tbl in ('phpbb3_posts','phpbb3_topics') and f[cols.index('forum_id')] in FORUMS_VIDES: continue
    if tbl in ('phpbb3_topics_watch','phpbb3_topics_posted','phpbb3_topics_track','phpbb3_poll_options','phpbb3_poll_votes','phpbb3_bookmarks') and f[cols.index('topic_id')] in TOPICS_VIDES: continue
    if tbl=='phpbb3_attachments' and f[cols.index('post_msg_id')] in POSTS_VIDES: continue
    if tbl=='phpbb3_forums' and f[cols.index('forum_id')] in FORUMS_VIDES:
        for c in cols:
            if re.match(r'forum_(posts|topics)_',c) or c in ('forum_last_post_id','forum_last_poster_id','forum_last_post_time'): f[cols.index(c)]='0'
            if c in ('forum_last_post_subject','forum_last_poster_name','forum_last_poster_colour'): f[cols.index(c)]=''
    if tbl=='phpbb3_posts': f[cols.index('post_text')]=f[cols.index('post_text')].replace('157.143.155.108','0.0.0.0')
    if tbl in FIXER:
        for c,v in FIXER[tbl].items():
            i=cols.index(c)
            if f[i] not in ('','\\N'): f[i]=v
    elif tbl=='phpbb3_users':
        t=int(f[cols.index('user_type')])
        for c in USERS_VIDER: f[cols.index(c)]=''
        for c in USERS_ZERO: f[cols.index(c)]='0'
        if t!=2: f[cols.index('user_password')]=HASH_MDP_TEST
    elif tbl in ('phpbb3_config','phpbb3_config_text'):
        if f[0].startswith('cleantalk'): continue          # clés d'API et jetons Cleantalk
        if tbl=='phpbb3_config' and f[0] in CONFIG: f[1]=CONFIG[f[0]]
    elif tbl=='phpbb3_ext':
        if f[0]=='cleantalk/antispam': f[1]='0'             # ne doit pas appeler le service externe
    out.write('\t'.join(f)+'\n')
out.close()
