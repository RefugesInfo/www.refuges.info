#/bin/sh

# don't launch directly this script
# use 'make install-demo' to do so

PGBIN=/usr/lib/postgresql/9.1/bin
PGSHARE=/usr/share/postgresql/9.1/contrib/postgis-1.5
PGUSER=postgres
SHP2PGSQL=/usr/bin/shp2pgsql
DB=tinyows_demo

if [ -d /usr/share/postgresql/9.1/contrib/postgis-2.0 ]; then
	PGSHARE=/usr/share/postgresql/9.1/contrib/postgis-2.0
elif [ -d /usr/share/postgresql/9.1/contrib/postgis-1.5 ]; then
	PGSHARE=/usr/share/postgresql/9.1/contrib/postgis-1.5
else
	echo "Unable to find PostGIS dir in /usr/share/postgresql/9.1/contrib/" && exit 1
fi

echo "Create Spatial Database: $DB"
su $PGUSER -c "$PGBIN/dropdb $DB > /dev/null 2> /dev/null"
su $PGUSER -c "$PGBIN/createdb $DB"
su $PGUSER -c "$PGBIN/createlang plpgsql $DB"
su $PGUSER -c "$PGBIN/psql $DB < $PGSHARE/postgis.sql"
su $PGUSER -c "$PGBIN/psql $DB < $PGSHARE/spatial_ref_sys.sql"

echo "Import layer data: world" 
$SHP2PGSQL -s 4326 -I demo/world.shp world > _world.sql
su $PGUSER -c "$PGBIN/psql $DB < _world.sql"

echo "Import layer data: france_dept" 
$SHP2PGSQL -s 27582 -I -W latin1 demo/france.shp france > _france.sql
su $PGUSER -c "$PGBIN/psql $DB < _france.sql"

rm _world.sql _france.sql
