-- Traductions des pages du wiki (2026-10-14)
-- Les pages wiki n'ont pas d'identifiant numérique (pages_wiki : nom_page, date, contenu, une ligne par version).
-- La clé d'une page wiki est donc son nom, dans la nouvelle colonne cle_objet (id_objet vaut 0), champ = 'contenu'.
-- Pour les autres types d'objets cle_objet reste vide : les lignes existantes ne changent pas.
BEGIN;
ALTER TABLE traductions ADD COLUMN cle_objet text NOT NULL DEFAULT '';
ALTER TABLE traductions DROP CONSTRAINT traductions_unique;
ALTER TABLE traductions ADD CONSTRAINT traductions_unique UNIQUE (type_objet, id_objet, cle_objet, champ, langue);
ALTER TABLE traductions DROP CONSTRAINT traductions_type_objet;
ALTER TABLE traductions ADD CONSTRAINT traductions_type_objet
  CHECK (type_objet = ANY (ARRAY['commentaire','point','post_forum','wiki']));
ALTER TABLE traductions ADD CONSTRAINT traductions_cle_objet
  CHECK ((type_objet = 'wiki' AND id_objet = 0 AND cle_objet <> '') OR (type_objet <> 'wiki' AND cle_objet = ''));
COMMIT;
