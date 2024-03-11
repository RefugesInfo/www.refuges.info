# Ajout de la nouvelle table pour suivre les emails qui n'arrivent pas

-- Adminer 4.8.1 PostgreSQL 13.13 (Debian 13.13-0+deb11u1) dump

DROP TABLE IF EXISTS "emails_bounce";
DROP SEQUENCE IF EXISTS emails_bounce_id_email_bounce_seq;
CREATE SEQUENCE emails_bounce_id_email_bounce_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."emails_bounce" (
    "id_email_bounce" integer DEFAULT nextval('emails_bounce_id_email_bounce_seq') NOT NULL,
    "date" timestamp NOT NULL,
    "contenu" text NOT NULL,
    CONSTRAINT "emails_bounce_pkey" PRIMARY KEY ("id_email_bounce")
) WITH (oids = false);


-- 2024-03-11 11:37:21.022594+01
