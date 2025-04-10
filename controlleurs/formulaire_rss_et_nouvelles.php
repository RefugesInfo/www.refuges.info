<?php
/********************************************************************************************************
Préparer des liens d'accès direct de nos nouvelles sous différents formats.
Depuis 2008 : un flux RSS 
Depuis 2025 : la page des nouvelles "customisable"

NOTE : Ce formulaire est proche de l'exportation des points, peut-être qu'on pourrait factoriser un peu ?

********************************************************************************************************/

require_once ("wiki.php");
require_once ("bdd.php");

$vue->titre="Choix du flux RSS ou de la page des nouvelles du site Refuges.info";
$vue->description="";

$vue->types_de_nouvelles = new stdClass; // objet contenant les type de nouvelles (en tant quobjets eux memes)
$vue->massifs = new stdClass;

// LES TYPES DE POINTS ====================================
$vue->types_de_nouvelles->nom_type = ["Commentaires", "Refuges", "Tous les points", "Messages des forums"];
$vue->types_de_nouvelles->checked = [1, 1, 1, 0];
$vue->types_de_nouvelles->id_nouvelle_type = ["commentaires", "refuges", "points", "forums"];

// LES MASSIFS/ZONES ======================================
// Creation d'une case à cocher pour chaque type massif
// exploite le champs id_zone renvoyé par infos_polygones

$conditions = new stdClass;
$conditions->ids_polygone_type=$config_wri['id_massif'];
$conditions->ordre = "id_zone"; // classe les massifs par zone
$conditions->avec_zone_parente=True;
$massifs=infos_polygones($conditions);

foreach ( $massifs AS $index => $massif ) 
{
  $vue->massifs->$index = new stdClass;
  $vue->massifs->$index->nom_polygone = $massif->nom_polygone ;
  $vue->massifs->$index->id_polygone = $massif->id_polygone ;
  $vue->massifs->$index->id_zone = $massif->id_zone ;
  $vue->massifs->$index->nom_zone = $massif->nom_zone ;
  if ( !isset($_REQUEST['id_massif']) OR  ( (array) $_REQUEST['id_massif'] == $massif->id_polygone ) )
    $vue->massifs->$index->checked = true;
}
