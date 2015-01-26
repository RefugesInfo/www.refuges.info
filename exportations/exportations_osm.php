<?php
/**********************************************************************************************
Renvoi un fichier au format gml contenant les données en provenance d'une copie partielle d'openstreetmap
le lien d'accès à pour format :
http://<site>/exportation/exportations_osm.php?format=kmz&
ATTENTION : des sites partenaires sont peut-être basés sur cette adresse!

**********************************************************************************************/

require_once ("../includes/config.php");
require_once ("exportation.php");
require_once ("point_osm.php");
$conditions = new stdClass;
$config['nom_fichier_export']="sans-espece-d-importance";
if (isset($_GET["limite"]))
  $conditions->limite = $_GET ["limite"]; 
else
  $conditions->limite=100;
	
// SLY : format bbox d'openlayers : &bbox=est,sud,ouest,nord
if (isset ($_GET ['bbox']))
{
  $bbox=explode(",",$_GET ['bbox']);
  $conditions->sud=$bbox [1];
  $conditions->nord=$bbox [3];
  $conditions->ouest=$bbox [0];
  $conditions->est=$bbox [2];
}

//Tout, mais à sélectionner par la requête par la suite
$conditions->tag_condition[]['tourism']='hotel';
$conditions->tag_condition[]['tourism']='camp_site';
$conditions->tag_condition[]['tourism']='guest_house';
$conditions->tag_condition[]['shop']='supermarket';
$conditions->tag_condition[]['shop']='convenience';



/*** Appel à la fonction principal qui nous fourni nos informations ***/
$points_osm = recuperation_poi_osm ($conditions);
if ($points_osm)
  foreach ($points_osm as $point_osm ) 
  {
    $point_osm_export = new stdClass;
    // On pourrait tout aussi bien envoyer tous les champs mais ça ferait des trucs un peu inutile donc sélection :
    $point_osm_export->feature_name="point";
    $point_osm_export->proprietes['nom']="bug";
    $point_osm_export->proprietes['url']=$point_osm->site_web;
    $point_osm_export->proprietes['type']="osm/".c($point_osm->nom_icone);
    $point_osm_export->geometrie_gml=$point_osm->geometrie_gml;
    $point_osm_export->proprietes['site']='osm'; // Dominique: permet de rechercher les icones et styles correspondantes à OSM
  
    $vue->features[]=$point_osm_export;
  }
//---------------------------------------------------------------------------------------
// On affiche tout ça avec le template correspondant au format
$vue->nom_fichier_export = "pour_openlayers";
$vue->type="export_gml";
$vue->content_type="UTF-8";
$vue->description = "Licence ODBL, copyright Openstreetmap.org et contributeurs";
include ($config['chemin_vues']."exportations/$vue->type.php");



?>