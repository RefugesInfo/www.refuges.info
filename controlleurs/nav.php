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
Zone (11): affiche tous les massifs inclus. pas de points, pas de panel. faut cliquer pour aller sur un massif. comme l'ancienne page massifs.
************************************************************************************************/

require_once ("bdd.php");
require_once ("polygone.php");
require_once ("point.php");
require_once ("forum.php");

$vue->java_lib_foot [] = $config_wri['sous_dossier_installation'].'vues/wiki.js';

// Includes cartes
$vue->css           [] = $config_wri['url_chemin_ol'].'ol/ol.css?'.filemtime($config_wri['chemin_ol'].'ol/ol.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'ol/ol.js?'.filemtime($config_wri['chemin_ol'].'ol/ol.js');
$vue->css           [] = $config_wri['url_chemin_ol'].'geocoder/ol-geocoder.min.css?'.filemtime($config_wri['chemin_ol'].'geocoder/ol-geocoder.min.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'geocoder/ol-geocoder.js?'.filemtime($config_wri['chemin_ol'].'geocoder/ol-geocoder.js');
$vue->css           [] = $config_wri['url_chemin_ol'].'myol.css?'.filemtime($config_wri['chemin_ol'].'myol.css');
$vue->java_lib_foot [] = $config_wri['url_chemin_ol'].'myol.js?'.filemtime($config_wri['chemin_ol'].'myol.js');
$vue->java_lib_foot [] = $config_wri['sous_dossier_installation'].'vues/_cartes.js?'.filemtime($config_wri['chemin_vues'].'_cartes.js');

// Récupère les infos de type "méta informations" sur les points et les polygones
$vue->infos_base = infos_base ();

/* Variables d'entrée
/nav : affiche tous les points
/nav/4 : affiche les points contenus dans le polygone 4 (ici le massif du Vercors)
/nav/50?id_polygone_type=1 : affiche les massifs contenus dans le polygone 50 (ici la zone du Massif Central)
/nav/?id_polygone_type=1 : affiche tous les massifs
/nav/?id_polygone_type=11 : affiche toutes les zones
/edit : crée un massif
/edit/4 : édite les contours du polygone 4
/edit?id_polygone_type=11 : crée une zone
*/
$id_polygone = $controlleur->url_decoupee[1]; // Id du polygone contenant


// Récupère les soumissions du formulaire de modification de paramètres de massifs
if (est_moderateur()) 
  if ($id_polygone_edit = edit_info_polygone())
    $id_polygone = $id_polygone_edit;


// Le paramètre d'URL id_polygone_type permet d'afficher différents contenus
// Si absent : affiche le contour du polygone demandé et les points à l'intérieur
// Si présent : les polygones qui intersectent le polygone demandé

if (!empty($_GET['id_polygone_type']))
{
  $vue->contenu=infos_type_polygone($_GET['id_polygone_type']);
  if (!empty($vue->contenu->erreur)) // quand même, si id_polygone_type présente un problème, on propose un message d'erreur un peu plus humain
  {
    $vue->contenu=$vue->contenu->message;
    $vue->http_status_code="404";
    $vue->type="page_simple";
    return;
  }
}

if (empty($id_polygone)) // Pas de numéro de polygone, ça n'est pas une erreur, on affiche les points visibles
  return;


$polygone=infos_polygone ($id_polygone,False,True);

if (empty($polygone->erreur)) 
{
  $vue->quoi=$vue->contenu ?
    $vue->contenu->type_polygone."s" :
    "refuges, cabanes, sommets et points d'eau";
  $vue->ou="$polygone->art_def_poly $polygone->type_polygone $polygone->article_partitif $polygone->nom_polygone";
  $vue->titre=ucfirst(
    ($polygone->nom_polygone ? "$vue->ou : " : "") .
    "$vue->quoi sur une carte"
  );
}
else // On a un problème avec le polygone demandé dans l'url, inutile d'aller plus loin
{
  $vue->contenu=$vue->titre="Impossible d'afficher la carte sur ce polygone car : ".$polygone->message;
  $vue->http_status_code="404";
  $vue->type='page_simple';
  return;
}

$vue->polygone=$polygone;


// Les coordonnées des polygones à éditer
$params = new stdClass();
$params->ids_polygones = $id_polygone;
$params->avec_geometrie = 'geojson';
$params->intersection = NULL;
$polygones_bruts=infos_polygones($params);
$vue->json_polygones = $polygones_bruts[0]->geometrie_geojson;

/* sly 2021-02-12 : dans un objectif de test, j'ajoute en fin de page la liste plate (dans une limite de perf de 150) des liens vers toutes les fiches du polygone considéré.
L'objectif est multiple : je veux savoir si ça améliore le référencement de ces pages, car je trouve que les moteurs de recherche ne les indexent que très mal. 
Sans doute car il ne savent pas intérpréter le js de OL alors qu'en terme de pertinence, selon moi il apparait pertinent que "refuges+écrins" devrait tomber sur la carte des écrins chez nous ;-)
L'autre, c'est pour les utilisateurs sans javascript (ouais, ça doit plus trop exister), mais pour eux, cette page ne sert vraiment à rien !
Et enfin, sur mobile, parfois, le js ne se charge pas en 2G, avoir cette liste donnerait a minima un truc que l'on peut "chercher" par ctrl+f
Et tout ça pour ~20ms de coût de chargement, dans une zone qui ne perturbe pas beaucoup les users normaux.
*/
if (empty($_GET['id_polygone_type']))
{
  $conditions = new stdClass;
  $conditions->ids_polygones=$id_polygone;
  $conditions->limite=150;
  $vue->points_de_la_zone=infos_points($conditions);
}

