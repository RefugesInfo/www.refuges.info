<?php
/*
Ne marchera que à la ligne de commande (à cause du timeout php)

Script d'importation des données osm qui nous intéressent
polygones : réserves naturelles, pays, département
points : hôtels, campings, chambres d'hôtes

Principe : la base OSM, c'est ENORME : ~350Go en 1 seul fichier xml, donc aucune chance de faire comme ça, il faut donc ne faire des récupérations
que partielles car seule une très faible part des données osm nous intéressent, la solution : interroger le service Overpass :
http://wiki.openstreetmap.org/wiki/Overpass_API uniquement sur les "zones qui nous intéressent" et uniquement pour les types de données qui nous intéressent


FIXME : automatiser le téléchargement des données osm et le limiter aux "zones" qui nous intéressent
FIXME: code le support, avec curl par exemple, du téléchargement depuis l'overpass API
FIXME: question à se poser : ce truc est relativement indépendant de wri, dois-je l'inclure dans les modeles ? sachant que ça ne s'appel pas par le web de toute façon ?
*/
require_once("../../../modeles/config.php");
require_once("fonctions_bdd.php");

function requete_overpass_api($xml_query)
{
  global $config;

  $ch = curl_init($config['overpass_api']);
  
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$xml_query);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $reponse = curl_exec($ch);
  curl_close($ch);
  return $reponse;
}


$dossier_temporaire="./tmp";

//************************ récupération des réserves naturelles et parc nationnaux
 

$prefix="osm_temporaire";
$params="-d ".$config['base_pgsql']." -H ".$config['serveur_pgsql']." -U ".$config['utilisateur_pgsql']."";

// osm2pgsql n'accepte pas le mot de passe en paramètre, mais dans une variable d'environnement
putenv("PGPASS=".$config['mot_de_passe_pgsql']);
// hélas un peu obligé de faire appel à ce binaire.
passthru("osm2pgsql -c --number-processes 2 $params -C 800 -s -S ./default.style -p $prefix -G -l --unlogged");


// Traitements post import


//************************ Import des réserves et parcs nationnaux
// suppression des reserves naturelles de notre base
$query_post_import[]="DELETE FROM polygones 
 			WHERE id_polygone_type=12;";
 			
// copy de celles importées par osm2pgsql
$query_post_import[]="INSERT INTO polygones 
			(id_polygone_type,message_information_polygone,url_exterieure,nom_polygone,source,geom) 
			  SELECT 12,\"description:restrictions\",website,name,'openstreetmap et contributeurs',ST_Multi(way) 
			FROM ".$prefix."_polygon 
			WHERE 
			  boundary='';";

// suppression des tables "temporaires" de osm2pgsql
foreach in (array('_line','_roads','_rels','_nodes','_ways','_polygon','_point') as $table)
	$query_post_import[]="DROP table $prefix$table;";

// On execture la pile de fonction qui ne retournent de toute façon rien
foreach ($query_post_import as $query)
  $pdo->query($query);

?>