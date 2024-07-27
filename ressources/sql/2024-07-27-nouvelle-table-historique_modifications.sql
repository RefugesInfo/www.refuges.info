DROP TABLE IF EXISTS "historique_modifications";
DROP SEQUENCE IF EXISTS historique_modifications_id_historique_modifications_seq;
CREATE SEQUENCE historique_modifications_id_historique_modifications_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."historique_modifications" (
    "id_historique_modifications" integer DEFAULT nextval('historique_modifications_id_historique_modifications_seq') NOT NULL,
    "id_point" integer DEFAULT '0' NOT NULL,
    "id_user" integer DEFAULT '0' NOT NULL,
    "date_modification" timestamptz NOT NULL,
    "type_modification" character(50) DEFAULT 'modification' NOT NULL,
    "raison_modification" text,
    "geom_avant" geometry,
    CONSTRAINT "historique_modifications_id_historique_modifications_poi" PRIMARY KEY ("id_historique_modifications")
) WITH (oids = false);

CREATE INDEX "historique_modifications_date_modification" ON "public"."historique_modifications" USING btree ("date_modification");

CREATE INDEX "historique_modifications_id_point" ON "public"."historique_modifications" USING btree ("id_point");

CREATE INDEX "historique_modifications_id_user" ON "public"."historique_modifications" USING btree ("id_user");
