<?php 
/***
Formulaire de recherche
***/

require_once("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_meta_donnees.php");

// etait modele=info_base. plus coherent avec les aurt pages
$vue = new stdClass;
$conditions_polygones = new stdClass;
$vue->infos_base = infos_base ();
$vue->titre = "Recherche de refuges/cabanes/gites";

// preparation de la liste deroulante des massifs:
// on va faire que 2 niveau, en dur.
// j'aurais put utiliser toute la chaine montagnarde. mais bon.
$conditions_polygones->ids_polygone_type=$config['id_massif'];
$conditions_polygones->avec_zone_parente=True;
$vue->massifs=infos_polygones($conditions_polygones);

$conditions_polygones->ids_polygone_type=$config['id_zone'];
$conditions_polygones->avec_zone_parente=False;
$vue->zones=infos_polygones($conditions_polygones);

// On affiche le tout
$vue->type = 'point_formulaire_recherche';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$vue->type.html");
include ($config['chemin_vues']."_pied.html");
?>
