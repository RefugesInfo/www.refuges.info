<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/bbox?bbox=world : Tout
 * http://leo.refuges.info/api/bbox?bbox=5.5,6.5,45.1,45.6 : Un bout d'alpes
********************************************/
include_once("point.php");
include_once("mise_en_forme_texte.php");
include_once("utilisateur.php");

/****************************************/
// Ça permet de mettre convertir tout un objet
function updatebbcode2html(&$html) { $html=bbcode2html($html,0,1,0); }
function updatebbcode2markdown(&$html) { $html=bbcode2markdown($html); }
function updatebbcode2txt(&$html) { $html=bbcode2txt($html); }
function updatebool2char(&$html) { if($html===FALSE) { $html='0'; } elseif($html===TRUE) { $html='1'; } }
/****************************************/

// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->bbox = $_GET['bbox'];
$req->format = $_GET['format'];
$req->format_txt = $_GET['format_texte'];
$req->nb_pts = $_GET['nb_points'];
$req->detail = $_GET['detail'];
$req->type_pts = $_GET['type_points'];

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format = array("geojson", "kmz", "kml", "gml", "gpx", "gpi", "csv");
$val->format_txt = array("bbcode", "texte", "markdown", "html");
$val->detail = array("simple", "complet");
$val->type_pts = array("cabane", "refuge", "gite", "pt_eau", "sommet", "pt_passage", "bivouac", "lac");
$val->type_pts_id = array(7, 10, 9, 23, 6, 3, 19, 16);

// On teste chaque champ pour voir si la valeur est correcte, sinon valeur par défaut
if(!in_array($req->format,$val->format)) { $req->format = "geojson"; }
if(!in_array($req->format_txt,$val->format_txt)) { $req->format_txt = "bbcode"; }
if(!in_array($req->detail,$val->detail)) { $req->detail = "simple"; }
if(!is_numeric($req->nb_pts) && $req->nb_pts!="all") { $req->nb_pts = 121; }
// On vérifie que la bbox est correcte
$temp = explode(",", $req->bbox);
if(!((count($temp)==4 &&
    is_numeric($temp[0]) &&
    is_numeric($temp[1]) &&
    is_numeric($temp[2]) &&
    is_numeric($temp[3]) &&
    $temp[0] >= -180 &&
    $temp[1] <= 180 &&
    $temp[2] >= -90 &&
    $temp[3] <= 90 &&
    $temp[0] < $temp[1] &&
    $temp[2] < $temp[3]) ||
    $req->bbox == "world")) {
    exit ("Error : wrong bbox parameter");
}
// On vérifie que les types de points sont ok, sinon on met all comme valeur
$temp = explode(",", $req->type_pts);
foreach ($temp as $type_pt) {
    if(!in_array($type_pt,$val->type_pts)) { $req->type_pts = "all"; break; }
}
unset($type_pt);

/****************************** REQUÊTE RÉCUPÉRATION PTS ******************************/

$params = new stdClass();

if($req->bbox != "world") { // Si on a world, on ne passe pas de paramètre à postgis
    $temp = explode(",", $req->bbox);
    $params->sud=$temp [2];
    $params->nord=$temp [3];
    $params->ouest=$temp [0];
    $params->est=$temp [1];
}
unset($temp);
$params->pas_les_points_caches=1;
$params->ordre="point_type.importance DESC";
if($req->nb_pts != "all") {
    $params->limite = $req->nb_pts;
}
if($req->type_pts != "all") {
    $params->ids_types_point = str_replace($val->type_pts, $val->type_pts_id, $req->type_pts);
}

print_r($params);

echo "<br>\r\n\r\n\r\n\r\n\r\n<br>";

print_r(infos_points($params));

?>