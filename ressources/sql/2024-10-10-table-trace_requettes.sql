CREATE SEQUENCE trace_requettes_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;
CREATE TABLE "trace_requettes" (
  "trace_id" integer DEFAULT nextval('trace_requettes_seq') NOT NULL,
  PRIMARY KEY ("trace_id"),
  "post_id" integer NULL,
  "user_id" integer NULL,
  "uri" text NULL,
  "ip" character(64) NULL,
  "real_ip" character(64) NULL,
  "host" character(128) NULL,
  "user_agent" character(256) NULL,
  "country_code" character(16) NULL,
  "language" character(128) NULL,
  "browser_locale" character(128) NULL,
  "browser_timezone" character(128) NULL,
  "sid" character(128) NULL,
  "date" character(64) NULL,
  "topic_title" character(256) NULL,
  "text" text NULL,
  "user_name" character(128) NULL,
  "user_email" character(128) NULL,
  "user_signature" text NULL,
  "user_posts" integer NULL,
  "user_lang" character(128) NULL,
  "user_timezone" character(64) NULL,
  "ip_enregistrement" character(64) NULL,
  "host_enregistrement" character(128) NULL
);
