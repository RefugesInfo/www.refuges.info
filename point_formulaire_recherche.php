<?php 
/***
Formulaire de recherche
***/

require_once("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_meta_donnees.php");

// etait modele=info_base. plus coherent avec les aurt pages
$modele = new stdClass;
$conditions_polygones = new stdClass;
$modele->infos_base = infos_base ();
$modele->titre = "Recherche de refuges/cabanes/gites";

// preparation de la liste deroulante des massifs:
// on va faire que 2 niveau, en dur.
// j'aurais put utiliser toute la chaine montagnarde. mais bon.
$conditions_polygones->ids_polygone_type=$config['id_massif'];
$modele->massifs=infos_polygones($conditions_polygones);

$conditions_polygones->ids_polygone_type=$config['id_zone'];
$modele->zones=infos_polygones($conditions_polygones);

// On affiche le tout
$modele->type = 'point_formulaire_recherche';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
