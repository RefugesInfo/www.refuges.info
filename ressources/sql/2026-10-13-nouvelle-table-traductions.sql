-- Nouvelle table des traductions automatiques des contenus utilisateurs (commentaires, fiches, messages du forum)
--
-- Le texte original reste dans sa table d'origine (commentaires.texte, points.remarques...) : cette table ne contient
-- que des textes dérivés, régénérables. Une ligne par objet, champ et langue cible.
--   texte NULL        : la source est déjà dans cette langue, rien à traduire (évite de la soumettre à nouveau)
--   hash_source       : md5 du texte source au moment de la traduction, une différence = traduction périmée
--   langue_source     : langue détectée du texte original
-- À exécuter avec le rôle propriétaire des autres tables (refuges en prod, le rôle de la base en dev)

CREATE TABLE "public"."traductions" (
    "id" bigserial PRIMARY KEY,
    "type_objet" text NOT NULL,
    "id_objet" integer NOT NULL,
    "champ" text NOT NULL,
    "langue" text NOT NULL,
    "langue_source" text,
    "hash_source" character(32) NOT NULL,
    "texte" text,
    "moteur" text NOT NULL,
    "date_traduction" timestamp NOT NULL DEFAULT now(),
    CONSTRAINT "traductions_type_objet" CHECK ("type_objet" IN ('commentaire','point','post_forum')),
    CONSTRAINT "traductions_langue" CHECK ("langue" ~ '^[a-z]{2}$'),
    CONSTRAINT "traductions_unique" UNIQUE ("type_objet","id_objet","champ","langue")
);

COMMENT ON COLUMN "public"."traductions"."id_objet" IS 'id_commentaire, id_point ou post_id selon type_objet (pas de clé étrangère : plusieurs tables)';
COMMENT ON COLUMN "public"."traductions"."texte" IS 'NULL = la source est déjà dans cette langue, rien à traduire';
