<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/point?id=2205 : pt normal
 * http://leo.refuges.info/api/point?id=2777 : coordonnées cachées
********************************************/
include_once("point.php");
include_once("mise_en_forme_texte.php");

/****************************************/
// Ça permet de mettre convertir tout un objet
function updatebbcode2html(&$html) { $html=bbcode2html($html,0,1,0); }
function updatebbcode2markdown(&$html) { $html=bbcode2markdown($html); }
function updatebbcode2txt(&$html) { $html=bbcode2txt($html); } 
 
/****************************************/


// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->id = $_GET['id'];
$req->format = $_GET['format'];
$req->format_txt = $_GET['format_texte'];
$req->nb_coms = $_GET['nb_coms'];
$req->nb_pp = $_GET['nb_points_proches'];
$req->carto = $_GET['fond_carto'];

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format = array("json","pdf");
$val->format_txt = array("bbcode","texte","markdown","html");
$val->carto = array("mri","outdoor_tf","osm_fr");

// On teste chaque champ pour voir si la valeur est correcte, sinon valeur par défaut
if(!in_array($req->format,$val->format)) { $req->format = "json"; }
if(!in_array($req->format_txt,$val->format_txt)) { $req->format_txt = "bbcode"; }
if(!in_array($req->carto,$val->carto)) { $req->carto = "mri"; }
if(!is_numeric($req->nb_coms)) { $req->nb_coms = 5; }
if(!is_numeric($req->nb_pp)) { $req->nb_pp = 3; }

// On récupère les infos du point
$pointBrut = new stdClass();
$pointBrut = infos_point($req->id);

// La on met en forme l'objet, c'est assez gros :
$point = new stdClass();
$point->id = $pointBrut->id_point;
$point->id_gps = $pointBrut->id_point_gps;
$point->nom = $pointBrut->nom;
if($pointBrut->id_type_precision_gps != 5) {
    $point->coord['long'] = $pointBrut->longitude;
    $point->coord['lat'] = $pointBrut->latitude;
    $point->coord['alt'] = $pointBrut->altitude;
}
$point->coord['precision']['nom'] = $pointBrut->nom_precision_gps;
$point->coord['precision']['type'] = $pointBrut->id_type_precision_gps;
$point->type['id'] = $pointBrut->id_point_type;
$point->type['valeur'] = $pointBrut->nom_type;
$point->places['nom'] = $pointBrut->equivalent_places;
$point->places['valeur'] = $pointBrut->places;
$point->remarque['nom'] = 'Remarque';
$point->remarque['valeur'] = $pointBrut->remark;
$point->acces['nom'] = 'Accès';
$point->acces['valeur'] = $pointBrut->acces;
$point->proprio['nom'] = $pointBrut->equivalent_proprio;
$point->proprio['valeur'] = $pointBrut->proprio;
$point->etat['id'] = $pointBrut->conditions_utilisation;
$point->etat['valeur'] = $pointBrut->equivalent_conditions_utilisation;
$point->createur['id'] = $pointBrut->id_createur;
$point->createur['nom'] = $pointBrut->nom_createur;
$point->date['derniere_modif'] -> $pointBrut->date_derniere_modification;
$point->date['creation'] -> $pointBrut->date_creation;
$point->article['demonstratif'] = $pointBrut->article_demonstratif;
$point->article['defini'] = $pointBrut->article_defini;
$point->article['partitif'] = $pointBrut->article_partitif_point_type;
$point->info_comp['site_officiel']['nom'] = $pointBrut->equivalent_site_officiel;
$point->info_comp['site_officiel']['valeur'] = $pointBrut->site_officiel;
$point->info_comp['manque_un_mur']['nom'] = $pointBrut->equivalent_manque_un_mur;
$point->info_comp['manque_un_mur']['valeur'] = $pointBrut->manque_un_mur;
$point->info_comp['cheminee']['nom'] = $pointBrut->equivalent_cheminee;
$point->info_comp['cheminee']['valeur'] = $pointBrut->cheminee;
$point->info_comp['poele']['nom'] = $pointBrut->equivalent_poele;
$point->info_comp['poele']['valeur'] = $pointBrut->poele;
$point->info_comp['couvertures']['nom'] = $pointBrut->equivalent_couvertures;
$point->info_comp['couvertures']['valeur'] = $pointBrut->couvertures;
$point->info_comp['places_matelas']['nom'] = $pointBrut->equivalent_places_matelas;
$point->info_comp['places_matelas']['valeur'] = $pointBrut->matelas;
$point->info_comp['places_matelas']['nb'] = $pointBrut->places_matelas;
$point->info_comp['latrines']['nom'] = $pointBrut->equivalent_latrines;
$point->info_comp['latrines']['valeur'] = $pointBrut->latrines;
$point->info_comp['bois']['nom'] = $pointBrut->equivalent_bois_a_proximite;
$point->info_comp['bois']['valeur'] = $pointBrut->bois_a_proximite;
$point->info_comp['eau']['nom'] = $pointBrut->equivalent_eau_a_proximite;
$point->info_comp['eau']['valeur'] = $pointBrut->eau_a_proximite;

unset($pointBrut);

// On transforme le texte dans la correcte syntaxe
if($req->format_txt == "texte") {
    array_walk_recursive($point, 'updatebbcode2txt');
}
elseif($req->format_txt == "html") {
    array_walk_recursive($point, 'updatebbcode2html');
}
elseif($req->format_txt == "markdown") {
    array_walk_recursive($point, 'updatebbcode2markdown');
}

print_r($point);

?>