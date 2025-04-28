<?php 
/***
Formulaire de recherche
***/

require_once ("polygone.php");
require_once ("meta_donnee.php");
require_once ("utilisateur.php");

$conditions_polygones = new stdClass;
$vue->infos_base = infos_base ();
$vue->titre = "Recherche de points sur refuges.info";

$vue->utilisateurs=infos_utilisateurs();

// Pour le champ de recherche "polygone" on peut chercher dans tous ces polygones qui nous intéressent :
$conditions_polygones->ids_polygone_type=$config_wri['id_zone'].",".$config_wri['id_massif'].",".$config_wri['id_zone_reglementee'].",".$config_wri['id_departement'].",".$config_wri['id_region_naturelle'];
$conditions_polygones->avec_zone_parente=False;
$vue->polygones=infos_polygones($conditions_polygones);

add_lib('autocomplete.js');
