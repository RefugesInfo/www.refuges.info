<?php 
// Ecran d'accueil

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 10/03/06 rff : déplacement échelle à droite en bas de l'image. Ajout instr. de libération query sql
// 21/03/06 rff : Insertion infos de session : utile pour gestion du cache & menu gestion. Ajout layer 'polygones'
// 06/11/10 Dominique : Passage sur les cartes Openlayers
// 20/12/10 Dominique : Retour en GoogleMap API V2
// 04/10/11 Dominique : Gestion multicartes
// 08/10/11 Dominique : Utilisation des templates
// 08/05/12 Dominique : Retour en modeles simples
// 12/07/12 Dominique : Enrichissement avec les news

require_once ('modeles/config.php');
require_once ($config['chemin_modeles']."fonctions_nouvelles.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");

$modele->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';

//ce sont polygones maintenant
//$zones = Array ( //     [left, bottom, right, top]
//	'Alpes'            => Array (  5.5, 43.1, 11  ,  47.2),
//	'Alpes orientales' => Array ( 11  , 46  , 15  ,  47  ),
//	'Pyrénées'         => Array ( -1.5, 42  ,  2.7,  43.4),
//	'Massif Central'   => Array (  1.3, 43.5,  5  ,  46.5),
//	
//);

//=============  Zone TEST a la crado =======================

//=============  Zone TEST a la crado =======================


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
