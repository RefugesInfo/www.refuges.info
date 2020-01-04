<?php // Editeur de massifs

require_once ("bdd.php");
require_once ("meta_donnee.php");
require_once ("polygone.php");

if (!$_SESSION['niveau_moderation']) {
	$vue->type="page_simple";
	$vue->titre="Permissions insuffisantes";
	$vue->contenu="Désolé, mais pour cette opération vous devez être modérateur et être connecté au forum :";
	return "";
}

$vue->css          [] = $config_wri['url_chemin_ol'].'ol/ol.css?'.filemtime($config_wri['chemin_ol'].'ol/ol.css');
$vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'ol/ol.js?'.filemtime($config_wri['chemin_ol'].'ol/ol.js');
$vue->css          [] = $config_wri['url_chemin_ol'].'geocoder/ol-geocoder.min.css?'.filemtime($config_wri['chemin_ol'].'geocoder/ol-geocoder.min.css');
$vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'geocoder/ol-geocoder.js?'.filemtime($config_wri['chemin_ol'].'geocoder/ol-geocoder.js');
$vue->css          [] = $config_wri['url_chemin_ol'].'myol.css?'.filemtime($config_wri['chemin_ol'].'myol.css');
$vue->java_lib_foot[] = $config_wri['url_chemin_ol'].'myol.js?'.filemtime($config_wri['chemin_ol'].'myol.js');
$vue->java_lib_foot[] = $config_wri['sous_dossier_installation'].'vues/wiki.js';

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
    $vue->titre = "Edition du $polygone->type_polygone du $polygone->nom_polygone";
    $vue->intro="Voici les refuges, cabanes, sommets et points d'eau dans $polygone->art_def_poly $polygone->type_polygone $polygone->article_partitif $polygone->nom_polygone";
  }
  else
    $vue->titre="Polygone demandé incorrect : $polygone->message";
} 
else
  $vue->titre = "Création d'un massif";

$vue->polygone=$polygone;

// Les coordonnées des polygones à éditer
$params = new stdClass();
$params->ids_polygones = $id_polygone;
$params->avec_geometrie = 'geojson';
$params->intersection = NULL;
$polygones_bruts=infos_polygones($params);
$vue->json_polygones = $polygones_bruts[0]->geometrie_geojson;

$vue->lien_legende_carte=lien_wiki('legende_carte');

