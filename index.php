<?php 
/*******************************************************************************
Ecran d'accueil

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $modele->...
*******************************************************************************/

require_once ('modeles/config.php');
require_once ("fonctions_nouvelles.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_autoconnexion.php");

$modele = new stdClass();
$modele->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';

// on passe en param un string a peu pres utilisable
// et ce sont des zones qu'on veut pas des massifs
$modele->massifs = liste_autres_zones ( urldecode($_GET['zone']) );

// Réinitialise les paramètres de réaffichage des pages suivantes, notamment la couche par défaut = Google
setcookie ('Olparams', '', time() - 3600, '/');


// News
$modele->commentaires = $commentaires;
$modele->stat = stat_site ();
$modele->general = $general;
$modele->quoi = $_GET ['quoi']
			  ? $_GET ['quoi']
			  : 'commentaires,points,forums';

// On affiche le tout
$modele->type = 'index';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
