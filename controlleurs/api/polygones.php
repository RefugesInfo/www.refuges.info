<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/polygones?format=gml
********************************************/
include_once("point.php");
include_once("mise_en_forme_texte.php");

/****************************************/
// Ça permet de mettre convertir tout un objet
function updatebbcode2html(&$html) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL)) 
        $html=bbcode2html($html,0,1,0); 
}
function updatebbcode2markdown(&$html) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL)) 
        $html=bbcode2markdown($html);
}
function updatebbcode2txt(&$html) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL)) 
            $html=bbcode2txt($html);
}
function updatebool2char(&$html) { if($html===FALSE) { $html='0'; } elseif($html===TRUE) { $html='1'; } }
/****************************************/

// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->page = $cible; // Ici on récupère la page (point, bbox, massif, contribution...)
$req->format = $_REQUEST['format'];
$req->massif = $_REQUEST['massif'];
$req->type_polygones = $_REQUEST['type_polygon'];
$req->bbox = $_REQUEST['bbox'];
$req->intersection = $_REQUEST['intersection'];

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format = array("geojson", "gml");

/****************************** VALEURS PAR DÉFAUT - PARAMS FACULTATIFS ******************************/

// On teste chaque champ pour voir si la valeur est correcte, sinon valeur par défaut
if(!in_array($req->format,$val->format))
    $req->format = "geojson";
// On vérifie que la liste de massif est correcte
$temp = explode(",", $req->massif);
foreach ($temp as $massif) {
    if(!is_numeric($massif)) { $req->massif = ""; }
}
// On vérifie que la liste des types de polygones est correcte
$temp = explode(",", $req->type_polygones);
foreach ($temp as $type_polygone) {
    if(!is_numeric($type_polygone)) { $req->type_polygones = ""; }
}
// On vérifie que la bbox est correcte
$temp = explode(",", $req->bbox);
if(!((count($temp)==4 &&
    is_numeric($temp[0]) &&
    is_numeric($temp[1]) &&
    is_numeric($temp[2]) &&
    is_numeric($temp[3])) ||
    $req->bbox == "world")) {
    $req->bbox = "world";
}

/****************************** REQUÊTE RÉCUPÉRATION POLYS ******************************/

$params = new stdClass();

if($req->bbox != "world") { // Si on a world, on ne passe pas de paramètre à postgis
	list($ouest,$sud,$est,$nord) = explode(",", $req->bbox);
	$params->geometrie = "ST_SetSRID(ST_MakeBox2D(ST_Point($ouest, $sud), ST_Point($est ,$nord)),4326)";
}
unset($ouest,$sud,$est,$nord);
if($req->massif != "")
	$params->ids_polygones=$req->massif;
if($req->type_polygones != "")
	$params->ids_polygone_type=$req->type_polygones;
$params->avec_geometrie=$req->format;
$params->intersection=$req->intersection;

$polygones_bruts = new stdClass();
$polygones = new stdClass();

$polygones_bruts=infos_polygones($params);

/****************************** INFOS GÉNÉRALES ******************************/
// Générateur de couleurs qui tournent autour du cercle colorimétrique
$lum = 0xC0 / 2; // Luminance constante pour un meilleur contraste
$nb_coul =  count ($polygones_bruts); // Pour répartir les couleurs
// Incrément des couleurs pour ne pas avoir de couleurs proches pour des massifs de n° proches
if ($nb_coul) {
	for ($pas = (int)($nb_coul/6+1); $nb_coul%$pas == 0; $pas++); // Le premier non diviseur de nb_coul > nb_coul / 6
	$pas_angulaire = $pas * 2*M_PI / $nb_coul;
	$i = 0;
	foreach($polygones_bruts as $polygone)
	{
		$geo = "geometrie_".$req->format;
		if (isset($polygone->$geo)) {
			$polygones->$i = new stdClass();
			$couleur = '#';
				for ($c = 0; $c < 2*M_PI; $c += 2*M_PI/3) // Chacune des 3 couleurs primaires
					$couleur .= substr (dechex (0x100 + $lum * (1 + cos ($i * $pas_angulaire + $c))), -2);
					// +0x100 pour bénéficier du 0 à gauche quand on passe en hexadécimal
			$polygones->$i->nom = $polygone->nom_polygone;
			$polygones->$i->id = $polygone->id_polygone;
			$polygones->$i->type['id'] = $polygone->id_polygone_type;
			$polygones->$i->type['type'] = $polygone->type_polygone;
			$polygones->$i->type['categorie'] = $polygone->categorie_polygone_type;
			$polygones->$i->geometrie =
				$_GET['type_geom']=='polylines'
					? str_replace (array('MultiPolygon','[[[',']]]'), array('MultiLineString','[[',']]'), $polygone->$geo)
					: $polygone->$geo;
			$polygones->$i->partitif = $polygone->article_partitif;
			$polygones->$i->bbox = $polygone->bbox;
			$polygones->$i->lien = lien_polygone($polygone,False);
			$polygones->$i->couleur = $couleur;
			$i++;
		}
	}
}
$nombre_polygones = $i;

/****************************** FORMATAGE DES CHAMPS ******************************/

array_walk_recursive($polygones, 'updatebool2char'); // Remplace les False et True en 0 ou 1

/****************************** FORMAT VUE ******************************/

switch ($req->format) {
    case 'geojson':
        include($config_wri['chemin_vues'].'/api/polygones.vue.json');
        break;
    case 'gml':
        include($config_wri['chemin_vues'].'/api/polygones.vue.gml');
        break;
    default:
        include($config_wri['chemin_vues'].'/api/polygones.vue.json');
        break;
}

?>
