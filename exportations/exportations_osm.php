<?php
/**********************************************************************************************
Renvoi un fichier au format gml contenant les données en provenance d'une copie partielle d'openstreetmap
le lien d'accès à pour format :
http://<site>/exportation/exportations_osm.php?format=kmz&

Openlayers est (sera) basé en partie sur cette adresse
**********************************************************************************************/

require_once ("../modeles/config.php");
require_once ("fonctions_exportations.php");
require_once ("fonctions_osm.php");
$conditions = new stdClass;
$config['nom_fichier_export']="sans-espece-d-importance";
// MODIF DOMINIQUE : utilisé par OpenLayers
if (isset($_GET["limite"]))
  $conditions->limite = $_GET ["limite"]; 
else
  $conditions->limite=100;
	
// SLY : format bbox d'openlayers : &bbox=est,sud,ouest,nord
if (isset ($_GET ['bbox']))
{
  $bbox=explode(",",$_GET ['bbox']);
  $conditions->latitude_minimum=$bbox [1];
  $conditions->latitude_maximum=$bbox [3];
  $conditions->longitude_minimum=$bbox [0];
  $conditions->longitude_maximum=$bbox [2];
}

//Tout, mais à sélectionner par la requête par la suite
$conditions->tag_condition[]['tourism']='hotel';
$conditions->tag_condition[]['tourism']='camp_site';
$conditions->tag_condition[]['tourism']='guest_house';
$conditions->tag_condition[]['shop']='supermarket';
$conditions->tag_condition[]['shop']='convenience';



/*** Appel à la fonction principal qui nous fourni nos informations ***/
$modele->pois [] = recuperation_poi_osm ($conditions);
//print_r($modele->osm_pois);
//---------------------------------------------------------------------------------------
// On affiche tout ça avec le template correspondant au format
$modele->nom_fichier_export = "pour_openlayers";
$modele->type="export_gml";
$modele->content_type="UTF-8";
$modele->description = "Licence ODBL, copyright Openstreetmap.org et contributeurs";
include ($config['chemin_vues']."exportations/$modele->type.php");



?>