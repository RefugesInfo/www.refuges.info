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

// Includes cartes
$vue->css           [] = $config_wri['url_chemin_ol'].'myol.css?'.filemtime($config_wri['chemin_ol'].'myol.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_ol'].$config_wri['nom_ol'].'.js?'.
	filemtime($config_wri['chemin_ol'].$config_wri['nom_ol'].'.js');
$vue->java_lib_foot [] = $config_wri['url_chemin_vues'].'_cartes.js?'.filemtime($config_wri['chemin_vues'].'_cartes.js');

$vue->stat = stat_site ();

// Préparation de la liste des photos et commentaires récent(e)s
$conditions_nouveaux_commentaires = new stdclass();
$conditions_nouveaux_commentaires->limite=$config_wri['defaut_max_commentaires_recents'];
$conditions_nouveaux_commentaires->avec_infos_point=True;
$conditions_nouveaux_commentaires->ordre="date_creation DESC";
$vue->nouveaux_commentaires=infos_commentaires($conditions_nouveaux_commentaires);


$conditions_nouveaux_points = new stdclass();
$conditions_nouveaux_points->limite=$config_wri['defaut_max_ajouts_recents'];
$conditions_nouveaux_points->ordre="date_creation DESC";
$vue->nouveaux_points=infos_points($conditions_nouveaux_points);

$vue->type="index";
$vue->bbox=$config_wri['bbox_page_accueil']; //point de vue et position initiale de la page
$vue->zones_pour_bandeau=remplissage_zones_bandeau(); // Menu des zones couvertes
