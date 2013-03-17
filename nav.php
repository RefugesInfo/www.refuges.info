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
Les variables sont passées dans l'objet $modele->...

Concept de Zone et Massifs :
Massif (1): classique : un poly qui entoure tous les points, possibilité de jouer avec le panel de gauche
Zone  (11): affiche tous les massifs inclus. pas de points, pas de panel. faut cliquer pour aller sur un massif. comme l'ancienne page massifs.
************************************************************************************************/

require_once ('modeles/config.php');
require_once ("fonctions_bdd.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_meta_donnees.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");

$modele = new stdClass();
$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';

// Récupère les infos de type "méta informations" sur les points et les polygones
$modele->infos_base = infos_base ();
						
// l'URL d'appel de la page 
// typiquement:  /nav/34/massif/Vercors/?mode_affichage=massif  pour le referenceement google
$tableau_url = explode ('/',$_SERVER['PATH_INFO']);
$id_polygone = $tableau_url [1];
$modele->type_affichage = $_GET['mode_affichage']; // "zone" ou "massif". ca definit l'affichage qui suit

$polygone = new stdClass;
$polygone->id_polygone=0; // Par défaut si aucun polygone n'est trouvé ou demandé
// Les paramètres des layers points et massifs
if ($id_polygone)
{
  $polygone=infos_polygone ($id_polygone);
  if (!$polygone->erreur) 
  {
    $modele->titre="Cartes des refuges, sommets et sources/point d'eau dans $infos_polygone->art_def_poly $infos_polygone->type_polygone $infos_polygone->article_partitif $infos_polygone->nom_polygone";
    $modele->description = $modele->titre.". Possibilité de naviguer sur une carte avec image satellite, cartes IGN, googlemaps...";
  }
  else
    $modele->titre="Polygone demandé incorrect : $polygone->message";
} 
else
  $modele->titre = "Navigation sur les photos satellite";
$modele->polygone=$polygone;

$modele->viseur = isset ($_GET ['cree']); // Si le paramètre cree est déclaré, le menu de création est ouvert / Pour le lien "Ajouter un refuge" en bas de page
$modele->liste_id_point_type = // Dominique 2010 12 05 / Ajout pour retrouver les checks mémorisés dans un cookie
		$HTTP_COOKIE_VARS ['liste_id_point_type']
		? $HTTP_COOKIE_VARS ['liste_id_point_type']
		: '7,10,9,23,6,3';

		
$modele->lien_mode_emploi=lien_mode_emploi();
// On affiche le tout
$modele->type = 'nav';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
