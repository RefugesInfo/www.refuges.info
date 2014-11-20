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
$req->page = $cible;
$req->bbox = $_GET['bbox'];
$req->id = $_GET['id'];
$req->format = $_GET['format'];
$req->format_texte = $_GET['format_texte'];
$req->nb_points = $_GET['nb_points'];
$req->detail = $_GET['detail'];
$req->nb_coms = $_GET['nb_coms'];
$req->nb_points_proches = $_GET['nb_points_proches'];
$req->type_points = $_GET['type_points'];

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format = array("geojson", "kmz", "kml", "gml", "gpx", "gpi", "csv", "xml"/*, "yaml"*/);
$val->format_texte = array("bbcode", "texte", "markdown", "html");
$val->detail = array("simple", "complet");
$val->type_points = array("cabane", "refuge", "gite", "pt_eau", "sommet", "pt_passage", "bivouac", "lac");
$val->type_points_id = array(7, 10, 9, 23, 6, 3, 19, 16);

/****************************** VALEURS PAR DÉFAUT - PARAMS FACULTATIFS ******************************/


// On teste chaque champ pour voir si la valeur est correcte, sinon valeur par défaut
if(!in_array($req->format,$val->format)) {
    switch ($req->page) {
        case 'bbox':
            $req->format = "geojson";
            break;
        case 'point':
            $req->format = "geojson";
            break;
        default:
            $req->format = "geojson";
            break;
    }
}
if(!in_array($req->format_texte,$val->format_texte)) {
    switch ($req->page) {
        case 'bbox':
            $req->format_texte = "bbcode";
            break;
        case 'point':
            $req->format_texte = "bbcode";
            break;
        default:
            $req->format_texte = "texte";
            break;
    }
}
if(!in_array($req->detail,$val->detail)) {
    switch ($req->page) {
        case 'bbox':
            $req->detail = "simple";
            break;
        case 'point':
            $req->detail = "complet";
            break;
        default:
            $req->detail = "simple";
            break;
    }
}
if(!is_numeric($req->nb_points) && $req->nb_points!="all") {
    switch ($req->page) {
        case 'bbox':
            $req->nb_points = 121;
            break;
        case 'point':
            $req->nb_points = 1;
            break;
        default:
            $req->nb_points = "all";
            break;
    }
}
if(!is_numeric($req->nb_coms)) {
    switch ($req->page) {
        case 'bbox':
            $req->nb_coms = 0;
            break;
        case 'point':
            $req->nb_coms = 5;
            break;
        default:
            $req->nb_coms = 0;
            break;
    }
}
if(!is_numeric($req->nb_points_proches) || $req->page!="point") { // On empêche le retour de points quand on a plusieurs points proches
    switch ($req->page) {
        case 'bbox':
            $req->nb_points_proches = 0;
            break;
        case 'point':
            $req->nb_points_proches = 3;
            break;
        default:
            $req->nb_points_proches = 0;
            break;
    }
}
// On vérifie que les types de points sont ok, sinon on met all comme valeur
if($req->page!="point") {
    $temp = explode(",", $req->type_points);
    foreach ($temp as $type_pt) {
        if(!in_array($type_pt,$val->type_points)) { $req->type_points = "all"; break; }
    }
    unset($type_pt);
}
else {
    $req->type_points = "all";
}

// On vérifie que la bbox est correcte
$temp = explode(",", $req->bbox);
if($req->page == "bbox" &&
    !((count($temp)==4 &&
    is_numeric($temp[0]) &&
    is_numeric($temp[1]) &&
    is_numeric($temp[2]) &&
    is_numeric($temp[3])) ||
    $req->bbox == "world")) {
    exit ("Error : wrong bbox parameter");
}


/****************************** REQUÊTE RÉCUPÉRATION PTS ******************************/

$params = new stdClass();

switch ($req->page) {
    case 'bbox':
        if($req->bbox != "world") { // Si on a world, on ne passe pas de paramètre à postgis
            list($ouest,$sud,$est,$nord) = explode(",", $req->bbox);
            $params->geometrie = "ST_SetSRID(ST_MakeBox2D(ST_Point($ouest, $sud), ST_Point($est ,$nord)),4326)";
        }
        unset($ouest,$sud,$est,$nord);
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
if($req->type_points != "all") {
    $params->ids_types_point = str_replace($val->type_points, $val->type_points_id, $req->type_points);
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
    // On affiche les coordonnées que si elles ne sont pas cachées
    if($pt->id_type_precision_gps != $config['id_coordonees_gps_fausses']) {
        $pts->$i->coord['long'] = $pt->longitude;
        $pts->$i->coord['lat'] = $pt->latitude;
    }
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

    /****************************** POINTS PROCHES ******************************/

    if ($pt->id_type_precision_gps != $config['id_coordonees_gps_fausses'] &&
        $req->nb_points_proches != 0)
    {
        $conditions = new stdClass;
        $conditions->limite = $req->nb_pp+1; // Parce que le point que l'on observe est retourné en premier
        $conditions->ouvert = 'oui';
        
        $g = array ( 'lat' => $pt->latitude, 'lon' => $pt->longitude , 'rayon' => 5000 );
        $conditions->geometrie = cree_geometrie( $g , 'cercle' );
        $conditions->avec_distance=True;

        $points_proches=infos_points($conditions);
        
        if (count($points_proches))
        $k=0;
        foreach ($points_proches as $point_proche) 
        {
            //On ne veut pas dans les points proches le point lui même
            if ($point_proche->id_point!=$point->id)
            {
            $pts->$i->pp[$k]['id']=$point_proche->id_point;
            $pts->$i->pp[$k]['nom']=$point_proche->nom;
            $pts->$i->pp[$k]['alt']=$point_proche->altitude;
            $pts->$i->pp[$k]['type']['id']=$point_proche->id_point_type;
            $pts->$i->pp[$k]['type']['valeur']=$point_proche->nom_type;
            $pts->$i->pp[$k]['distance']=$point_proche->distance;
            $k++;
            }
        }
        $pts->$i->pp[nb] = $k;

        unset($conditions);
        unset($point_proche);
        unset($points_proches);
    }

    /****************************** COMMENTAIRES ******************************/

    $conditions = new stdClass();
    $conditions->ids_points = $pt->id_point;
    $conditions->limite = $req->nb_coms;
    $tous_commentaires = infos_commentaires ($conditions);

    $k=0;
    foreach ($tous_commentaires AS $commentaire)
    {
        $pts->$i->coms[$k]['id'] = $commentaire->id_commentaire;
        $pts->$i->coms[$k]['date'] = $commentaire->date;
        $pts->$i->coms[$k]['createur']['id'] = $commentaire->id_createur_commentaire;
        // info sur l'auteur du commentaire (authentifié ou non)
        if ($commentaire->id_createur_commentaire==0) // non authentifié
        $pts->$i->coms[$k]['createur']['nom']=$commentaire->auteur_commentaire;
        else
        $pts->$i->coms[$k]['createur']['nom'] = infos_utilisateur($commentaire->id_createur_commentaire)->username;
        $pts->$i->coms[$k]['texte'] = $commentaire->texte;
        $pts->$i->coms[$k]['photo']['nb'] = $commentaire->photo_existe;
        $pts->$i->coms[$k]['photo']['date'] = $commentaire->date_photo;
        $pts->$i->coms[$k]['photo']['reduite'] = $commentaire->reduite;
        $pts->$i->coms[$k]['photo']['originale'] = $commentaire->originale;
        $k++;
    }
    $pts->$i->coms['nb'] = $k;

    unset($conditions);
    unset($commentaire);
    unset($tous_commentaires);

    /****************************** FORMATAGE DU TEXTE ******************************/

    // On transforme le texte dans la correcte syntaxe
    if($req->format_texte == "texte") {
        array_walk_recursive($pts->$i, 'updatebbcode2txt');
    }
    elseif($req->format_texte == "html") {
        array_walk_recursive($pts->$i, 'updatebbcode2html');
    }
    elseif($req->format_texte == "markdown") {
        array_walk_recursive($pts->$i, 'updatebbcode2markdown');
    }
    array_walk_recursive($pts->$i, 'updatebool2char'); // Remplace les False et True en 0 ou 1


    $i++;
}
$nbpts = $i;
unset($pts_bruts, $i);

/****************************** FORMAT VUE ******************************/


switch ($req->format) {
    case 'geojson':
        include('./vue/liste.json');
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
    case 'xml':
        include('./vue/liste.xml');
        break;
    default:
        include('./vue/liste.json');
        break;
}

?>