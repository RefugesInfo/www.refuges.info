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

require_once ("bdd.php");
require_once ("meta_donnee.php");
require_once ("polygone.php");

$vue->css           [] = $config_wri['url_chemin_leaflet'].'leaflet.css?'.filemtime($config_wri['chemin_leaflet'].'leaflet.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_leaflet'].'leaflet.js?' .filemtime($config_wri['chemin_leaflet'].'leaflet.js');
$vue->java_lib_foot [] = $config_wri['sous_dossier_installation'].'vues/wiki.js';

// Récupère les infos de type "méta informations" sur les points et les polygones
$vue->infos_base = infos_base ();

$vue->types_point_affichables=types_point_affichables();
// typiquement:  /nav/34/massif/Vercors/?mode_affichage=massif  pour le referencement google, c'est le controlleur.php qui passe ce tableau
$id_polygone = (int) $controlleur->url_decoupee[1];
$vue->mode_affichage = $_GET['mode_affichage']; // "zone", "massif" ou "edit". ca definit l'affichage qui suit

//Récupère les soumissions du formulaire de modification de paramètres de massifs
if ($id_polygone_edit = edit_info_polygone())
    $id_polygone = $id_polygone_edit;

$polygone = new stdClass;
$polygone->id_polygone=0; // Par défaut si aucun polygone n'est trouvé ou demandé
// Les paramètres des layers points et massifs
if ($id_polygone)
{
  $polygone=infos_polygone ($id_polygone);
  if (!$polygone->erreur) 
  {
      $vue->titre="Cartes des refuges, sommets et sources/point d'eau dans $polygone->art_def_poly $polygone->type_polygone $polygone->article_partitif $polygone->nom_polygone";
    $vue->description = $vue->titre.". Possibilité de naviguer sur une carte avec image satellite, cartes IGN, SwissTopo, Bings...";
  }
  else
    $vue->titre="Polygone demandé incorrect : $polygone->message";
} 
else
  $vue->titre = "Navigation sur les photos satellite";
$vue->polygone=$polygone;

// Les coordonnées des polygones à éditer
$params = new stdClass();
$params->ids_polygones = $id_polygone;
$params->avec_geometrie = 'geojson';
$params->intersection = NULL;
$polygones_bruts=infos_polygones($params);
$vue->json_polygones = $polygones_bruts[0]->geometrie_geojson;

$vue->lien_legende_carte=lien_wiki('legende_carte');
?>
