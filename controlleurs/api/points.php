<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/bbox?bbox=world : Tout
 * http://leo.refuges.info/api/bbox?bbox=5.5,45.1,6.5,45.6 : Un bout d'alpes
********************************************/
include_once("point.php");
include_once("mise_en_forme_texte.php");
include_once("utilisateur.php");
include_once("identification.php");
include_once("entetes_http.php");

// FIXME: Il doit moyen de faire mieux, mais préparer l'export en mettant tout dans un énorme tableau n'est en fait pas la meilleure idée,
// en 2025 nous touchons la limite en RAM de 128Mo, alors, spécifiquement pour l'export, et car j'ai la flemme de tout reprendre, je boost à 256Mo et ça ira bien
ini_set('memory_limit','256M');

/****************************************/

$vue = new stdClass();
// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->page = $cible; // Ici on récupère la page (point, bbox, massif, contribution...)
$req->bbox = $_REQUEST['bbox'] ?? '';
$req->massif = $_REQUEST['massif'] ?? '';
$req->id = $_REQUEST['id'] ?? '';
$req->format = $_REQUEST['format'] ?? '';
$req->detail = $_REQUEST['detail'] ?? '';
$req->format_texte = $_REQUEST['format_texte'] ?? '';
$req->nb_points = $_REQUEST['nb_points'] ?? '';
$req->cluster = $_REQUEST['cluster'] ?? '';
$req->type_points = $_REQUEST['type_points'] ?? '';

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format_texte = array("bbcode", "texte", "markdown", "html");
// FIXME sly 2019 : tout ça devrait être récupéré de la base de donnée, ça exite déjà dans point_type, quel dommage de maintenir 2 duplicats ;-(
$val->type_points = array("cabane", "refuge", "gite", "grotte", "pt_eau", "pt_passage", "batiment_a_explorer");
$val->type_points_id = array(7, 10, 9, 29, 23, 3, 28);

/****************************** VALEURS PAR DÉFAUT - PARAMS FACULTATIFS ******************************/


// On teste chaque champ pour voir si la valeur est dans liste des formats accepté, sinon on choisir le format geojson
if(!array_key_exists($req->format,$config_wri['api_format_points']))
  $req->format = "geojson";

if(!in_array($req->format_texte,$val->format_texte)) {
  switch ($req->page) {
    case 'bbox':
    case 'massif':
    case 'point':
      $req->format_texte = "bbcode";
      break;
    case 'contributions':
      $req->format_texte = "rss";
      break;
    default:
      $req->format_texte = "texte";
      break;
    }
}

if(!is_numeric($req->nb_points) && $req->nb_points!="all") {
  switch ($req->page) {
    case 'bbox':
    case 'massif':
      $req->nb_points = $config_wri['defaut_max_nombre_point'];
      break;
    case 'point':
      $req->nb_points = 1;
      break;
    default:
      $req->nb_points = "all";
      break;
  }
}

if(!array_key_exists($req->detail,$config_wri['api_format_detail']))
  $req->detail = "simple";

// On vérifie que les types de points sont ok, sinon on met all comme valeur
if($req->page!="point") {
  $temp = explode(",", $req->type_points);
  foreach ($temp as $type_point) {
    if (!in_array($type_point,$val->type_points) &&
      !in_array($type_point,$val->type_points_id)) {
      $req->type_points = "all"; break;
    }
  }
}
else {
  $req->type_points = "all";
}

// On vérifie que la bbox est correcte
$temp = explode(",", $req->bbox);
if($req->bbox=="") {
  $req->bbox="world";
}
else if(!((count($temp)==4 &&
  is_numeric($temp[0]) &&
  is_numeric($temp[1]) &&
  is_numeric($temp[2]) &&
  is_numeric($temp[3])) ||
  $req->bbox == "world")) {
  exit ("Error : wrong bbox parameter");
}

// On vérifie que la liste de massif est correcte
$temp = explode(",", $req->massif);
foreach ($temp as $massif) {
  if($req->page == "massif" && !is_numeric($massif)) { exit ("Error : wrong massif id"); }
}

/****************************** REQUÊTE RÉCUPÉRATION PTS ******************************/

$params = new stdClass();

if($req->bbox != "world") { // Si on a world, on ne passe pas de paramètre à postgis
  list($ouest,$sud,$est,$nord) = explode(",", $req->bbox);
  $params->geometrie = "ST_SetSRID(ST_MakeBox2D(ST_Point($ouest, $sud), ST_Point($est ,$nord)),4326)";
}
unset($ouest,$sud,$est,$nord);

switch ($req->page) {
  case 'bbox':
    $params->pas_les_points_caches=1;
    $params->ordre="point_type.importance DESC";
    break;
  case 'massif':
    $params->ids_polygones = $req->massif;
    $params->pas_les_points_caches=1;
    $params->ordre="point_type.importance DESC";
    break;
  case 'point':
    $params->ids_points = intval($req->id);
    break;
  default:
    break;
}

if($req->nb_points != "all") {
  $params->limite = $req->nb_points;
}
if(is_numeric($req->cluster)) {
  $params->cluster = $req->cluster;
}
if($req->type_points != "all") {
  $params->ids_types_point = str_replace($val->type_points, $val->type_points_id, $req->type_points);
}

/****************************** FILTRE DES DÉTAILS ******************************/
// Dom 01/2026 : On paramètre, pour chaque niveau de détail
// les champs qu'on veut voir figurer dans la réponse de l'API

switch ($req->detail) {
  case 'complet':
    $params->avec_infos_creation = true;
    $params->avec_infos_complementaires = true;
  case 'simple':
  case 'icone':
    $params->avec_infos_fiche = true;
};

/* Définition des informations transmises pour chaque option "detail" */

// Utilisé par la carte actuelle WRI
$filtre['simple'] = [
  'nom' => true,
  'id' => true,
  'coord' => ['alt' => true],
  'type' => true,
  'sym' => true,
  'etat' => ['valeur' => true],
  'places' => true,
  'lien' => true,
];

$filtre['complet'] = array_merge($filtre['simple'], [
  // Complète avec les autres valeurs
  'coord' => true,
  'etat' => true,
  // Nouveaux
  'date' => true,
  'createur' => true,
  'proprio' => true,
  'acces' => true,
  'remarque' => true,
  'info_comp' => [
    'bois_a_proximite' => 'bois', // On renomme
    'cheminee' => true,
    'couvertures' => true,
    'eau_a_proximite' => 'eau',
    'latrines' => true,
    'manque_un_mur' => true,
    'places' => true,
    'places_matelas' => true,
    'poele' => true,
  ],
  'description' => true,
  'article' => true,
]);

/* Petite fonction qui réalise le filtrage en fonction des définitions ci-dessus */
function filtre_recursif($properties, $filtre) {
  // On est arrivé à la fin des règles
  if (is_scalar($properties) || is_scalar($filtre) || is_object($filtre))
    return $properties;

  $props = (array)$properties; // On transforme toutes les entrées en array car elle sont parfois object
  $obj = [];

  foreach ($filtre as $cle_filtre => $sous_filtre)
    // Cas des tableaux : on prend tout le contenu de ce niveau
    if ($cle_filtre == '*') {
      $tablo=[];
      foreach($properties AS $p)
        $tablo[]= filtre_recursif($p, $sous_filtre);
      return $tablo;
    }
    // Cas normal
    elseif (isset($props[$cle_filtre]) && // Si la valeur existe
      !empty($sous_filtre)) // Sauf si 'id' => false
    {
      // Renommage de la variable
      $cle = is_string($sous_filtre) ? $sous_filtre : $cle_filtre;
      $obj[$cle] = filtre_recursif($props[$cle_filtre], $sous_filtre);
    }

  return $obj;
}


/****************************** RÉCUPÉRATION DES POINTS ******************************/

$points_bruts = new stdClass();
$points = new stdClass();

$points_bruts = infos_points($params);

/****************************** INFOS GÉNÉRALES ******************************/
/*
L'idée est de générer une grosse collection de points avec presque toutes leurs propriétés, la vue ne se servant que ce dont elle a besoin
selon qu'elle est csv, gpx, etc.ça consome plus de RAM bien sûr et plus de CPU, mais ça simplifie vachement le code en ayant le même traitement quel que soit la vue
Seule exception à ça, le cas du format "geojson" :
Car c'est celui utilisé par la carte et que le fichier est généré par un json_encode($point) qui deviendrait trop gros pour les usages en mobilité et débit pourri.
*/

foreach ($points_bruts as $i=>$point) {
  if(isset ($point->nb_points)) // cas des clusters
  {
    $points->$i = new stdClass();
    $points->$i->cluster = $point->nb_points;
    $points->$i->id = $point->id_point;
    $points->$i->nom = mb_ucfirst($point->nom);
    $points->$i->type['icone'] = 'cluster_n'.$point->nb_points;
    $points_geojson[$point->id_point]['geojson'] = $point->geojson;
  }
  else
  {
    // les cabanes cachées ne sont pas exportées. Les coordonnées étant volontairement stockées fausses, les sortir ne fera que créer de la confusion
    if(($point->id_type_precision_gps??'') == $config_wri['id_coordonees_gps_fausses'])
      break;

    $points_geojson[$point->id_point]['geojson'] = $point->geojson;
    // FIXME: comme l'array $points est converti en intégralité en xml ou json, je planque dans une autre variable ce que je veux séparément

    // Dom 01/2026 : transfert du formattage dans le /modele/point.php
    if (!empty($point->infos_complementaires))
      $point->properties->info_comp = $point->infos_complementaires;

    // En geojson, utilisé par la carte, on a pas besoin de tout ça, autant simplifier pour réduire le temps de chargement,
    // sauf si on appel explicitement le mode complet avec &detail=complet
    if ($req->format!="geojson" or $req->detail=="complet")
    {
      /*
      sly 09/12/2019 : Construction d'un grand texte contenant ce qui me semble le plus pertinent concernant un point,
      afin de l'inclure dans la description des gpx et du kml
      */
      $description="";

      if (!empty($point->equivalent_places) and !empty($point->places))
        $description=$point->equivalent_places. ": ".$point->places."\n";

      if (!empty($point->equivalent_places_matelas) and !empty($point->places_matelas))
        $description.=$point->equivalent_places_matelas.": ".$point->places_matelas."\n";

      $description.=$point->remark."\n";
      $description.=$point->acces."\n";
      $description.=$point->proprio."\n";
      $point->properties->description['valeur']=$description;
    }

    // Filtre des détails
    if(in_array($req->format, ['geojson','rss']))
      $points->$i = filtre_recursif($point->properties, $filtre[$req->detail]);
    else
      $points->$i = $point->properties;

    /****************************** FORMATAGE DU TEXTE ******************************/
    // On transforme le texte dans la correcte syntaxe
    if($req->format_texte == "texte") {
      array_walk_recursive($points->$i, 'updatebbcode2txt');
    }
    elseif($req->format_texte == "html") {
      array_walk_recursive($points->$i, 'updatebbcode2html');
    }
    elseif($req->format_texte == "markdown") {
      array_walk_recursive($points->$i, 'updatebbcode2markdown');
    }

    array_walk_recursive($points->$i, 'updatebool2char'); // Remplace les False et True en 0 ou 1
  }
}

// Dans le cas bien spécifique ou l'api ne va renvoyer qu'un seul point,
// nous stockons son nom pour renvoyer un nom de fichier indiquant le nom de ce point !
if (count($points_bruts)==1)
{
  $point=reset($points_bruts);
  $filename=replace_url($point->nom);
}

/****************************** FORMAT VUE ******************************/

include($config_wri['chemin_vues'].'api/points.vue.'.$req->format.".php");
?>
