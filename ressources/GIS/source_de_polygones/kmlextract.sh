#!/bin/bash
#
# a partir d'un copier coller bien crade d'un contenu KML, prepare un INSERT POLYGON mysql.
# le nom de fichier contient le nom du polygone !!
# NE GERE PAS LES INCLUSIONS (mysql peut le faire mais on verra 1 autre fois)

#ne garde que 4 decimale, ce qui fait une precision a 10m

#source KML: http://geocommons.com/overlays/119819 (KML countries)


touch SQLkml


for file in *rins*t
do
	pays=`echo $file | cut -f2 -d'-'|cut -f1 -d'.'`
	cat "$file" | tr ' ' '\n' | sed 's/\(\.[0-9][0-9][0-9][0-9]\)[0-9]*/\1/g' | uniq | sed s/','/' '/  |sed '/^$/d' | tr '\n' ','|sed "s/^/UPDATE polygones SET gis=PolygonFromText\(\'POLYGON\(\(/" | sed "s/,$/\)\)\'\) WHERE nom_polygone='$pays' ;%/" | tr '%' '\n'>> SQLkml

done

