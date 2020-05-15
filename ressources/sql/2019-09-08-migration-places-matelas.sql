# pour supprier le cas "-1" des places sur matelas : 0 veut dire, y'en a aps, et NULL on ne sait pas
# !! ORDRE IMPORTANT !!
update points set places_matelas=NULL where places_matelas=0;

update points set places_matelas=0 where places_matelas=-1;

ALTER TABLE "points"
ALTER "places" TYPE bigint,
ALTER "places" SET DEFAULT '0',
ALTER "places" DROP NOT NULL;
