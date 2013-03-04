<?php 
/***
Formulaire de recherche
***/

require_once("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_meta_donnees.php");

// etait modele=info_base. plus coherent avec les aurt pages
$modele = new stdClass();
$modele->infos_base = infos_base ();
$modele->titre = "Recherche de refuges/cabanes/gites";

// On affiche le tout
$modele->type = 'point_formulaire_recherche';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
