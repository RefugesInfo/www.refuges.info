# Ajout de la nouvelle table pour suivre les emails qui n'arrivent pas


DROP TABLE IF EXISTS "emails_bounce";
DROP SEQUENCE IF EXISTS emails_bounce_id_email_bounce_seq;
CREATE SEQUENCE emails_bounce_id_email_bounce_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."emails_bounce" (
    "id_email_bounce" integer DEFAULT nextval('emails_bounce_id_email_bounce_seq') NOT NULL,
    "date" timestamp NOT NULL,
    "contenu" text NOT NULL,
    "a_traiter" boolean DEFAULT true,
    CONSTRAINT "emails_bounce_id_email_bounce" PRIMARY KEY ("id_email_bounce")
) WITH (oids = false);

CREATE INDEX "emails_bounce_a_traiter" ON "public"."emails_bounce" USING btree ("a_traiter");

CREATE INDEX "emails_bounce_date" ON "public"."emails_bounce" USING btree ("date");
