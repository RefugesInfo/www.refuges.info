<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/bbox?bbox=world : Tout
 * http://leo.refuges.info/api/bbox?bbox=5.5,45.1,6.5,45.6 : Un bout d'alpes
********************************************/
include_once("point.php");
include_once("api.php");
include_once("mise_en_forme_texte.php");
include_once("utilisateur.php");

/****************************************/
// Ça permet de mettre convertir tout un objet
function updatebbcode2html(&$html, $key) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL) && $key != 'url') 
        $html=bbcode2html($html,0,1,0); 
}
function updatebbcode2markdown(&$html, $key) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL) && $key != 'url')
        $html=bbcode2markdown($html);
}
function updatebbcode2txt(&$html, $key) {
    if (!($html === FALSE OR $html === TRUE OR $html === NULL) && $key != 'url')
        $html=bbcode2txt($html);
}
function updatebool2char(&$html) { 
    if($html===FALSE) 
        $html='0';  
    elseif($html===TRUE) 
        $html='1'; 
}
/****************************************/

// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->page = $cible; // Ici on récupère la page (point, bbox, massif, contribution...)
$req->bbox = $_REQUEST['bbox'];
$req->massif = $_REQUEST['massif'];
$req->id = $_REQUEST['id'];
$req->format = $_REQUEST['format'];
$req->format_texte = $_REQUEST['format_texte'];
$req->nb_points = $_REQUEST['nb_points'];
$req->detail = $_REQUEST['detail'];
$req->nb_coms = $_REQUEST['nb_coms'];
$req->nb_points_proches = $_REQUEST['nb_points_proches'];
$req->type_points = $_REQUEST['type_points'];

// Ici c'est les valeurs possibles
$val = new stdClass();
$val->format = array("geojson", "kmz", "kml", "gml", "gpx", "csv", "gpi", "xml"/*, "yaml"*/, "rss");
$val->format_texte = array("bbcode", "texte", "markdown", "html");
$val->detail = array("simple", "complet");
// FIXME sly : tout ça devrait être stocké dans la base de donnée
$val->type_points = array("cabane", "refuge", "gite", "pt_eau", "sommet", "pt_passage", "bivouac", "lac", "batiment_a_explorer");
$val->type_points_id = array(7, 10, 9, 23, 6, 3, 19, 16, 28);

/****************************** VALEURS PAR DÉFAUT - PARAMS FACULTATIFS ******************************/


// On teste chaque champ pour voir si la valeur est correcte, sinon valeur par défaut
if(!in_array($req->format,$val->format)) {
    switch ($req->page) {
        case 'bbox':
            $req->format = "geojson";
            break;
        case 'massif':
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
        case 'massif':
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
        case 'massif':
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
        case 'massif':
            $req->nb_points = 250;
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
        case 'massif':
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
        case 'massif':
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
if($req->type_points != "all") {
    $params->ids_types_point = str_replace($val->type_points, $val->type_points_id, $req->type_points);
}

$points_bruts = new stdClass();
$points = new stdClass();

$points_bruts = infos_points($params);

/****************************** INFOS GÉNÉRALES ******************************/

$i = 0;
foreach ($points_bruts as $point) {
    $points->$i = new stdClass();
    $points->$i->id = $point->id_point;
    $points->$i->id_gps = $point->id_point_gps;
    $points->$i->lien = lien_point($point);
    $points->$i->nom = mb_ucfirst($point->nom);
	switch ($point->conditions_utilisation) {
		case 'fermeture':
		case 'detruit':
			$points->$i->sym = "Crossing";
			break;
		case 'cle_a_recuperer': // TODO : trouver un symbole
		default:
			$points->$i->sym = $point->symbole;
	}
    // On affiche les coordonnées que si elles ne sont pas cachées
    if($point->id_type_precision_gps != $config_wri['id_coordonees_gps_fausses']) {
        $points->$i->coord['long'] = $point->longitude;
        $points->$i->coord['lat'] = $point->latitude;
    }
    $points->$i->coord['alt'] = $point->altitude;
    $points->$i->type['id'] = $point->id_point_type;
    $points->$i->type['valeur'] = $point->nom_type;
    $points->$i->type['icone'] = choix_icone($point);
    $points->$i->places['nom'] = $point->equivalent_places;
    $points->$i->places['valeur'] = $point->places;
    $points->$i->etat['id'] = $point->conditions_utilisation;
    $points->$i->etat['valeur'] = texte_non_ouverte($point);
    $points->$i->date['derniere_modif'] = $point->date_derniere_modification;
   // On rajoute des informations complémentaires si on demande détaillé
    if($req->detail == "complet") {
        $points->$i->coord['precision']['nom'] = $point->nom_precision_gps;
        $points->$i->coord['precision']['type'] = $point->id_type_precision_gps;
        $points->$i->remarque['nom'] = 'Remarque';
        $points->$i->remarque['valeur'] = $point->remark;
        $points->$i->acces['nom'] = 'Accès';
        $points->$i->acces['valeur'] = $point->acces;
        $points->$i->proprio['nom'] = $point->equivalent_proprio;
        $points->$i->proprio['valeur'] = $point->proprio;
        $points->$i->createur['id'] = $point->id_createur;
        // info sur le modérateur actuel de la fiche (authentifié ou non)
        if ($point->id_createur==0) // non authentifié
            $points->$i->createur['nom']=$point->nom_createur;
        else
            $points->$i->createur['nom'] = infos_utilisateur($point->id_createur)->username;
        $points->$i->date['creation'] = $point->date_creation;
        $points->$i->article['demonstratif'] = $point->article_demonstratif;
        $points->$i->article['defini'] = $point->article_defini;
        $points->$i->article['partitif'] = $point->article_partitif_point_type;
        $points->$i->info_comp['site_officiel']['nom'] = $point->equivalent_site_officiel;
        $points->$i->info_comp['site_officiel']['url'] = $point->site_officiel;
        $points->$i->info_comp['site_officiel']['valeur'] = $point->site_officiel;
        $points->$i->info_comp['manque_un_mur']['nom'] = $point->equivalent_manque_un_mur;
        $points->$i->info_comp['manque_un_mur']['valeur'] = $point->manque_un_mur;
        $points->$i->info_comp['cheminee']['nom'] = $point->equivalent_cheminee;
        $points->$i->info_comp['cheminee']['valeur'] = $point->cheminee;
        $points->$i->info_comp['poele']['nom'] = $point->equivalent_poele;
        $points->$i->info_comp['poele']['valeur'] = $point->poele;
        $points->$i->info_comp['couvertures']['nom'] = $point->equivalent_couvertures;
        $points->$i->info_comp['couvertures']['valeur'] = $point->couvertures;
        $points->$i->info_comp['places_matelas']['nom'] = $point->equivalent_places_matelas;
        $points->$i->info_comp['places_matelas']['nb'] = $point->places_matelas;
        if($point->places_matelas == -1)
            $points->$i->info_comp['places_matelas']['valeur'] = "Sans";
        elseif($point->places_matelas === 0)
            $points->$i->info_comp['places_matelas']['valeur'] = "Avec, en nombre inconnu";
        else
            $points->$i->info_comp['places_matelas']['valeur'] = $point->matelas;
        $points->$i->info_comp['latrines']['nom'] = $point->equivalent_latrines;
        $points->$i->info_comp['latrines']['valeur'] = $point->latrines;
        $points->$i->info_comp['bois']['nom'] = $point->equivalent_bois_a_proximite;
        $points->$i->info_comp['bois']['valeur'] = $point->bois_a_proximite;
        $points->$i->info_comp['eau']['nom'] = $point->equivalent_eau_a_proximite;
        $points->$i->info_comp['eau']['valeur'] = $point->eau_a_proximite;
    }

    /****************************** POINTS PROCHES ******************************/

    if ($point->id_type_precision_gps != $config_wri['id_coordonees_gps_fausses'] &&
        $req->nb_points_proches != 0)
    {
        $conditions = new stdClass;
        $conditions->limite = $req->nb_points_proches+1; // Parce que le point que l'on observe est retourné en premier
        $conditions->ouvert = 'oui';
        
        $g = array ( 'lat' => $point->latitude, 'lon' => $point->longitude , 'rayon' => 5000 );
        $conditions->geometrie = cree_geometrie( $g , 'cercle' );
        $conditions->avec_distance=True;

        $points_proches=infos_points($conditions);

        if (count($points_proches)) {
            $k=0;
            foreach ($points_proches as $point_proche) 
            {
                //On ne veut pas dans les points proches le point lui même
                if ($point_proche->id_point!=$point->id_point)
                {
                    $points->$i->pp[$k]['id']=$point_proche->id_point;
                    $points->$i->pp[$k]['nom']=$point_proche->nom;
                    $points->$i->pp[$k]['alt']=$point_proche->altitude;
                    $points->$i->pp[$k]['type']['id']=$point_proche->id_point_type;
                    $points->$i->pp[$k]['type']['valeur']=$point_proche->nom_type;
                    $points->$i->pp[$k]['distance']=$point_proche->distance;
                    $k++;
                }
            }
            $points->$i->pp[nb] = $k;
        }

        unset($conditions);
        unset($point_proche);
        unset($points_proches);
    }

    /****************************** COMMENTAIRES ******************************/

    $conditions = new stdClass();
    $conditions->ids_points = $point->id_point;
    $conditions->limite = $req->nb_coms;
    $tous_commentaires = infos_commentaires ($conditions);

    $k=0;
    foreach ($tous_commentaires AS $commentaire)
    {
        $points->$i->coms[$k]['id'] = $commentaire->id_commentaire;
        $points->$i->coms[$k]['date'] = $commentaire->date;
        $points->$i->coms[$k]['createur']['id'] = $commentaire->id_createur_commentaire;
        // info sur l'auteur du commentaire (authentifié ou non)
        if ($commentaire->id_createur_commentaire==0) // non authentifié
        $points->$i->coms[$k]['createur']['nom']=$commentaire->auteur_commentaire;
        else
        $points->$i->coms[$k]['createur']['nom'] = infos_utilisateur($commentaire->id_createur_commentaire)->username;
        $points->$i->coms[$k]['texte'] = $commentaire->texte;
        $points->$i->coms[$k]['photo']['nb'] = $commentaire->photo_existe;
        $points->$i->coms[$k]['photo']['date'] = $commentaire->date_photo;
        $points->$i->coms[$k]['photo']['reduite'] = $commentaire->lien_photo['reduite'];
        $points->$i->coms[$k]['photo']['originale'] = $commentaire->lien_photo['originale'];
        $k++;
    }
    $points->$i->coms['nb'] = $k;

    unset($conditions);
    unset($commentaire);
    unset($tous_commentaires);

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

    $i++;
}
$nombre_points = $i;
unset($points_bruts, $i);

/****************************** FORMAT VUE ******************************/

switch ($req->format) {
    case 'kml': case 'kmz':
        include($config_wri['chemin_vues'].'/api/points.vue.kml');
        break;
    case 'gml':
        include($config_wri['chemin_vues'].'/api/points.vue.gml');
        break;
    case 'gpx': case 'gpi':
        include($config_wri['chemin_vues'].'/api/points.vue.gpx');
        break;
    case 'csv':
        include($config_wri['chemin_vues'].'/api/points.vue.csv');
        break;
    case 'xml':
        include($config_wri['chemin_vues'].'/api/points.vue.xml');
        break;
    case 'rss':
        include($config_wri['chemin_vues'].'/api/points.vue.rss');
        break;
    case 'geojson': default:
        include($config_wri['chemin_vues'].'/api/points.vue.json');
        break;
}

?>
