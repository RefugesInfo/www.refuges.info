-- La page d'accueil du wiki (nom de page vide) est renommée "index" (2026-10-15)
-- Un nom vide posait problème (/wiki//en/ aplati en /wiki/en/ par les robots, tests de nom vide...). Les contenus et
-- toutes les versions sont conservés, seul le nom change ; la clé de ses traductions suit ('/' devient 'index').
-- /wiki et /wiki/ affichent la page "index" (voir controlleurs/wiki.php).
-- À exécuter avec le rôle propriétaire des tables (refuges en prod). Idempotent.
BEGIN;
UPDATE pages_wiki SET nom_page = 'index' WHERE nom_page = '';
UPDATE traductions SET cle_objet = 'index' WHERE type_objet = 'wiki' AND cle_objet = '/';
COMMIT;
