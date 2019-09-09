ALTER TABLE "points"
ADD "altitude" integer NOT NULL DEFAULT '0',
ADD "acces" text NOT NULL DEFAULT ' ',
ADD "id_type_precision_gps" integer NOT NULL DEFAULT '0',
ADD "geom" geometry NULL;
CREATE INDEX "points_geom" ON "points" ("geom");
CREATE INDEX "points_id_type_precision_gps" ON "points" ("id_type_precision_gps");
CREATE INDEX "points_altitude" ON "points" ("altitude");
alter table points add CONSTRAINT enforce_dims_geom CHECK ((st_ndims(geom) = 2));
alter table points add CONSTRAINT enforce_geotype_geom CHECK (((geometrytype(geom) = 'POINT'::text) OR (geom IS NULL)));
alter table points add     CONSTRAINT enforce_srid_geom CHECK ((st_srid(geom) = 4326))


update points 
set 
altitude=points_gps.altitude,
acces=points_gps.acces,
id_type_precision_gps=points_gps.id_type_precision_gps,
geom=points_gps.geom
from points_gps
where points.id_point_gps=points_gps.id_point_gps


ALTER TABLE "points" DROP "id_point_gps";
DROP TABLE "points_gps";
