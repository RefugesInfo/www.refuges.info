<?php
/*
Script d'importation des données osm qui nous intéressent
polygones : réserves naturelles, pays, département
points : hôtels, campings, chambres d'hôtes

Principe : la base OSM, c'est ENORME : ~350Go en 1 seul fichier xml, donc aucune chance de faire comme ça, il faut donc ne faire des récupérations
que partielles car seule une très faible part des données osm nous intéressent, la solution : interroger le service Overpass :
http://wiki.openstreetmap.org/wiki/Overpass_API uniquement sur les "zones qui nous intéressent" et uniquement pour les types de données qui nous intéressent


FIXME : il faut vraiment tout nettoyer, limiter l'appel à des binaires externes, et passer par PDO
FIXME : automatiser le téléchargement des données osm et le limiter aux "zones" qui nous intéressent
FIXME: code le support, avec curl par exemple, du téléchargement depuis l'overpass API
*/

require_once("../../../modeles/config_privee.php");
putenv("PGPASS=".$config['mot_de_passe_pgsql']);
putenv("PGPASSWORD=".$config['mot_de_passe_pgsql']);

$params="-d ".$config['base_pgsql']." -H ".$config['serveur_pgsql']." -U ".$config['utilisateur_pgsql']."";

// En option : -C 800 -s au cas où on manquerait de ram (plus long, mais plus fiable)
passthru("osm2pgsql -c --number-processes 2 $params -C 800 -s -S ./default.style -p osm -G -l --unlogged $argv[1]");


// Traitements post import
// suppression des reserves naturelles de la base
$query_post_import[]="delete from polygones where id_polygone_type=12;";
// copy de celles importées par osm2pgsql
$query_post_import[]="insert into polygones (id_polygone_type,message_information_polygone,url_exterieure,nom_polygone,source,geom) select 12,\"description:restrictions\",website,name,'openstreetmap et contributeurs',ST_Multi(way) from osm_polygon where leisure='nature_reserve';";

// suppression des tables "temporaires" de osm2pgsql
$query_post_import[]="DROP table osm_line;";
$query_post_import[]="DROP table osm_roads;";
$query_post_import[]="DROP table osm_rels;";
$query_post_import[]="DROP table osm_nodes;";
$query_post_import[]="DROP table osm_ways;";
$query_post_import[]="DROP table osm_polygon;";
$query_post_import[]="DROP table osm_point;";



// A convertir avec nos fonctions internes au site
foreach ($query_post_import as $query)
  passthru("echo \"$query\" | psql ".$config['base_pgsql']." -U ".$config['utilisateur_pgsql']." -h ".$config['serveur_pgsql']."");

?>