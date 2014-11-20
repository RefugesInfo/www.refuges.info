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
    list($ouest,$sud,$est,$nord) = explode(",", $req->bbox);
    $params->geometrie = "ST_SetSRID(ST_MakeBox2D(ST_Point($ouest, $sud), ST_Point($est ,$nord)),4326)";
}
unset($ouest,$sud,$est,$nord);
$params->pas_les_points_caches=1;
$params->ordre="point_type.importance DESC";
if($req->nb_pts != "all") {
    $params->limite = $req->nb_pts;
}
if($req->type_pts != "all") {
    $params->ids_types_point = str_replace($val->type_pts, $val->type_pts_id, $req->type_pts);
}

$pts_bruts = new stdClass();
$pts = new stdClass();

$pts_bruts = infos_points($params);

/****************************** INFOS GÉNÉRALES ******************************/

$i = 0;
foreach ($pts_bruts as $pt) {
    $pts->$i = new stdClass();
    $pts->$i->id = $pt->id_point;
    $pts->$i->id_gps = $pt->id_point_gps;
    $pts->$i->nom = $pt->nom;
    $pts->$i->coord['long'] = $pt->longitude;
    $pts->$i->coord['lat'] = $pt->latitude;
    $pts->$i->coord['alt'] = $pt->altitude;
    $pts->$i->type['id'] = $pt->id_point_type;
    $pts->$i->type['valeur'] = $pt->nom_type;
    $pts->$i->places['nom'] = $pt->equivalent_places;
    $pts->$i->places['valeur'] = $pt->places;
    $pts->$i->etat['id'] = $pt->conditions_utilisation;
    $pts->$i->etat['valeur'] = texte_non_ouverte($pt);
    // On rajoute des informations complémentaires si on demande détaillé
    if($req->detail == "complet") {
        $pts->$i->coord['precision']['nom'] = $pt->nom_precision_gps;
        $pts->$i->coord['precision']['type'] = $pt->id_type_precision_gps;
        $pts->$i->remarque['nom'] = 'Remarque';
        $pts->$i->remarque['valeur'] = $pt->remark;
        $pts->$i->acces['nom'] = 'Accès';
        $pts->$i->acces['valeur'] = $pt->acces;
        $pts->$i->proprio['nom'] = $pt->equivalent_proprio;
        $pts->$i->proprio['valeur'] = $pt->proprio;
        $pts->$i->createur['id'] = $pt->id_createur;
        // info sur le créateur de la fiche (authentifié ou non)
        if ($pt->id_createur==0) // non authentifié
            $pts->$i->createur['nom']=$pt->nom_createur;
        else
            $pts->$i->createur['nom'] = infos_utilisateur($pt->id_createur)->username;
        $pts->$i->date['derniere_modif'] = $pt->date_derniere_modification;
        $pts->$i->date['creation'] = $pt->date_creation;
        $pts->$i->article['demonstratif'] = $pt->article_demonstratif;
        $pts->$i->article['defini'] = $pt->article_defini;
        $pts->$i->article['partitif'] = $pt->article_partitif_point_type;
        $pts->$i->info_comp['site_officiel']['nom'] = $pt->equivalent_site_officiel;
        $pts->$i->info_comp['site_officiel']['valeur'] = $pt->site_officiel;
        $pts->$i->info_comp['manque_un_mur']['nom'] = $pt->equivalent_manque_un_mur;
        $pts->$i->info_comp['manque_un_mur']['valeur'] = $pt->manque_un_mur;
        $pts->$i->info_comp['cheminee']['nom'] = $pt->equivalent_cheminee;
        $pts->$i->info_comp['cheminee']['valeur'] = $pt->cheminee;
        $pts->$i->info_comp['poele']['nom'] = $pt->equivalent_poele;
        $pts->$i->info_comp['poele']['valeur'] = $pt->poele;
        $pts->$i->info_comp['couvertures']['nom'] = $pt->equivalent_couvertures;
        $pts->$i->info_comp['couvertures']['valeur'] = $pt->couvertures;
        $pts->$i->info_comp['places_matelas']['nom'] = $pt->equivalent_places_matelas;
        $pts->$i->info_comp['places_matelas']['nb'] = $pt->places_matelas;
        if($pt->places_matelas == -1)
            $pts->$i->info_comp['places_matelas']['valeur'] = "Sans";
        elseif($pt->places_matelas === 0)
            $pts->$i->info_comp['places_matelas']['valeur'] = "Avec, en nombre inconnu";
        else
            $pts->$i->info_comp['places_matelas']['valeur'] = $pt->matelas;
        $pts->$i->info_comp['latrines']['nom'] = $pt->equivalent_latrines;
        $pts->$i->info_comp['latrines']['valeur'] = $pt->latrines;
        $pts->$i->info_comp['bois']['nom'] = $pt->equivalent_bois_a_proximite;
        $pts->$i->info_comp['bois']['valeur'] = $pt->bois_a_proximite;
        $pts->$i->info_comp['eau']['nom'] = $pt->equivalent_eau_a_proximite;
        $pts->$i->info_comp['eau']['valeur'] = $pt->eau_a_proximite;
    }
    $i++;
}

/****************************** FORMATAGE DU TEXTE ******************************/

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
array_walk_recursive($point, 'updatebool2char'); // Remplace les False et True en 0 ou 1

/****************************** FORMAT VUE ******************************/

switch ($req->format) {
    case 'geojson':
        include('./vue/liste.geojson');
        break;
    case 'kmz':
        include('./vue/liste.kmz');
        break;
    case 'kml':
        include('./vue/liste.kml');
        break;
    case 'gml':
        include('./vue/liste.gml');
        break;
    case 'gpx':
        include('./vue/liste.gpx');
        break;
    case 'gpi':
        include('./vue/liste.gpi');
        break;
    case 'csv':
        include('./vue/liste.csv');
        break;
    default:
        include('./vue/liste.geojson');
        break;
}

?>