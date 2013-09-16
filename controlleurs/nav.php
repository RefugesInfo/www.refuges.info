<?php 
/***********************************************************************************************
Préparation d'une page HTML de type 'navigation satellite'
avec une zone de détermination de critères de choix (couches) et une fonction de zoomage.
Des critères tels que 'refuges', villes, apparaissent au dessus d'un fond de carte.
La page ainsi préparée comporte un script Java permettant la sélection des points chauds ("ex: refuges") de la carte
et renvoi vers un lien sur clic souris. Le déplacement de la souris sur le fond de carte provoque l'affichage des coordonnées du point.

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...

Concept de Zone et Massifs :
Massif (1): classique : un poly qui entoure tous les points, possibilité de jouer avec le panel de gauche
Zone  (11): affiche tous les massifs inclus. pas de points, pas de panel. faut cliquer pour aller sur un massif. comme l'ancienne page massifs.
************************************************************************************************/

require_once ("fonctions_bdd.php");
require_once ("fonctions_meta_donnees.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");

//$vue->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$vue->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';

// Récupère les infos de type "méta informations" sur les points et les polygones
$vue->infos_base = infos_base ();

$vue->types_point_affichables=types_point_affichables();

// typiquement:  /nav/34/massif/Vercors/?mode_affichage=massif  pour le referenceement google, c'est le controlleur.php qui passe ce tableau
$id_polygone = $controlleur->url_decoupee[2];;
$vue->type_affichage = $_GET['mode_affichage']; // "zone" ou "massif". ca definit l'affichage qui suit

$polygone = new stdClass;
$polygone->id_polygone=0; // Par défaut si aucun polygone n'est trouvé ou demandé
// Les paramètres des layers points et massifs
if ($id_polygone)
{
  $polygone=infos_polygone ($id_polygone);
  if (!$polygone->erreur) 
  {
    $vue->titre="Cartes des refuges, sommets et sources/point d'eau dans $infos_polygone->art_def_poly $infos_polygone->type_polygone $infos_polygone->article_partitif $infos_polygone->nom_polygone";
    $vue->description = $vue->titre.". Possibilité de naviguer sur une carte avec image satellite, cartes IGN, SwissTopo, Bings...";
  }
  else
    $vue->titre="Polygone demandé incorrect : $polygone->message";
} 
else
  $vue->titre = "Navigation sur les photos satellite";
$vue->polygone=$polygone;

$vue->liste_id_point_type = // Dominique 2010 12 05 / Ajout pour retrouver les checks mémorisés dans un cookie
		$HTTP_COOKIE_VARS ['liste_id_point_type']
		? $HTTP_COOKIE_VARS ['liste_id_point_type']
		: '7,10,9,23,6,3';

		
$vue->lien_mode_emploi=lien_mode_emploi();
?>
