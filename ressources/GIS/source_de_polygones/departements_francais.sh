#!/bin/bash

# agit dans le repertoire de deptfr-dta
# NECESSITE UN PASSAGE A LA MAIN POUR RETABLIR LES ACCENTS !!
source des donnée : http://melusine.eu.org/syracuse/jms/depfr/

touch SQL

for fdta in *.dta
do
	dep=`echo $fdta | cut -f2 -d'-'|cut -f1 -d'.'`
	cat $fdta |sed '/^$/d' | tr '\n' ','|sed "s/^/UPDATE polygones SET gis=PolygonFromText\(\'POLYGON\(\(/" | sed "s/,$/\)\)\'\) WHERE nom_polygone='$dep' ;%/" | tr '%' '\n'>> SQL
done

