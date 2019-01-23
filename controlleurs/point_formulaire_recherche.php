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

// preparation de la liste deroulante des massifs:
// on va faire que 2 niveau, en dur.
// j'aurais put utiliser toute la chaine montagnarde. mais bon.
$conditions_polygones->ids_polygone_type=$config_wri['id_massif'];
$conditions_polygones->avec_zone_parente=True;
$vue->massifs=infos_polygones($conditions_polygones);

$conditions_polygones->ids_polygone_type=$config_wri['id_zone'];
$conditions_polygones->avec_zone_parente=False;
$vue->zones=infos_polygones($conditions_polygones);
$vue->utilisateurs=infos_utilisateurs();

//d($vue->zones);

?>
