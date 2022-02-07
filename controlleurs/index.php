<?php 
/*******************************************************************************
Ecran d'accueil

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...
*******************************************************************************/

require_once ("nouvelle.php");
require_once ("polygone.php");
$vue->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';

if ($config_wri['is_ie']) {
  // Includes pour IE
  $vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'ol-681/polyfill.min.js?'.filemtime($config_wri['chemin_ol'].'ol-681/polyfill.min.js');
  // Last IE compatible OL version
  $vue->css           [] = $config_wri['url_chemin_ol'].'ol-681/ol.css?'.filemtime($config_wri['chemin_ol'].'ol-681/ol.css');
  $vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'ol-681/ol.js?'.filemtime($config_wri['chemin_ol'].'ol-681/ol.js');
} else {
  // Includes pour autres que IE
  $vue->css           [] = $config_wri['url_chemin_ol'].'ol/ol.css?'.filemtime($config_wri['chemin_ol'].'ol/ol.css');
  $vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'ol/ol.js?'.filemtime($config_wri['chemin_ol'].'ol/ol.js');
}
// Includes communs à IE et autres
$vue->css           [] = $config_wri['url_chemin_ol'].'myol.css?'.filemtime($config_wri['chemin_ol'].'myol.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'myol.js?'.filemtime($config_wri['chemin_ol'].'myol.js');

$vue->stat = stat_site ();

// Préparation de la liste des photos et commentaires récent(e)s
$conditions_nouveaux_commentaires = new stdclass();
$conditions_nouveaux_commentaires->date_apres="NOW() - INTERVAL '".$config_wri['defaut_max_jours_ajouts_recents']." days'";
$conditions_nouveaux_commentaires->avec_infos_point=True;
$conditions_nouveaux_commentaires->ordre="date_creation DESC";
$vue->nouveaux_commentaires=infos_commentaires($conditions_nouveaux_commentaires);


$conditions_nouveaux_points = new stdclass();
$conditions_nouveaux_points->date_creation_apres="NOW() - INTERVAL '".$config_wri['defaut_max_jours_ajouts_recents']." days'";
$conditions_nouveaux_points->avec_infos_massif=True;
$conditions_nouveaux_points->ordre="date_creation DESC";
$vue->nouveaux_points=infos_points($conditions_nouveaux_points);

$vue->type="index";
$vue->bbox=$config_wri['bbox_page_accueil']; //point de vue et position initiale de la page
