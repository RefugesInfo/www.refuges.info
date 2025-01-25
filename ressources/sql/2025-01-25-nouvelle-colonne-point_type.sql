ALTER TABLE "point_type"
ADD "equivalent_ouverture_contact_prealable" character varying(255) NULL;
COMMENT ON TABLE "point_type" IS ''; 

UPDATE "point_type" SET
"equivalent_ouverture_contact_prealable" = 'Ouverture sur contact préalable'
WHERE "id_point_type" = '9';

UPDATE "point_type" SET
"equivalent_ouverture_contact_prealable" = 'Clés à récupérer'
WHERE "id_point_type" = '7';
