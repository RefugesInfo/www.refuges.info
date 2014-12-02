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
function updatebbcode2html(&$html) { $html=bbcode2html($html,0,1,0); }
function updatebbcode2markdown(&$html) { $html=bbcode2markdown($html); }
function updatebbcode2txt(&$html) { $html=bbcode2txt($html); }
function updatebool2char(&$html) { if($html===FALSE) { $html='0'; } elseif($html===TRUE) { $html='1'; } }
/****************************************/

// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->page = $cible; // Ici on récupère la page (point, bbox, massif, contribution...)
$req->format = $_GET['format'];
$req->massif = $_GET['massif'];
$req->type_polygones = $_GET['type_polygon'];
$req->bbox = $_GET['bbox'];

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
$params->avec_geometrie='gml';

$polygones_bruts = new stdClass();
$polygones = new stdClass();

$polygones_bruts=infos_polygones($params);

/****************************** INFOS GÉNÉRALES ******************************/

// Générateur de couleurs qui tournent autour du cercle colorimétrique
$no_coul =   0; // Le numéro de la couleur du massif va s'incrémenter
$pas     =   7; // On tourne de $pas à chaque polynome pour bien répartir les couleurs
// FIXME, le nombre de massif change !
$nb_coul =  44; // Jusqu'au massif 44 
$ymin    =   0; // Luminance min
$ymax    = 200; // Luminance max
$b = ($ymin + $ymax) / 2; // Coefs du calcul
$a = 256 + $b; // +256 pour bénéficier du 0 à gauche quand on passe en hexadécimal



$i = 0;
foreach ($points_bruts as $point) {
    $points->$i = new stdClass();
    $points->$i->id = $point->id_point;
    $points->$i->id_gps = $point->id_point_gps;
    $points->$i->nom = $point->nom;
    // On affiche les coordonnées que si elles ne sont pas cachées
    if($point->id_type_precision_gps != $config['id_coordonees_gps_fausses']) {
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
        // info sur le créateur de la fiche (authentifié ou non)
        if ($point->id_createur==0) // non authentifié
            $points->$i->createur['nom']=$point->nom_createur;
        else
            $points->$i->createur['nom'] = infos_utilisateur($point->id_createur)->username;
        $points->$i->date['creation'] = $point->date_creation;
        $points->$i->article['demonstratif'] = $point->article_demonstratif;
        $points->$i->article['defini'] = $point->article_defini;
        $points->$i->article['partitif'] = $point->article_partitif_point_type;
        $points->$i->info_comp['site_officiel']['nom'] = $point->equivalent_site_officiel;
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

    if ($point->id_type_precision_gps != $config['id_coordonees_gps_fausses'] &&
        $req->nb_points_proches != 0)
    {
        $conditions = new stdClass;
        $conditions->limite = $req->nb_pp+1; // Parce que le point que l'on observe est retourné en premier
        $conditions->ouvert = 'oui';
        
        $g = array ( 'lat' => $point->latitude, 'lon' => $point->longitude , 'rayon' => 5000 );
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
        $points->$i->coms[$k]['photo']['reduite'] = $commentaire->reduite;
        $points->$i->coms[$k]['photo']['originale'] = $commentaire->originale;
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
    case 'geojson':
        include('../vues/api/points.vue.json');
        break;
    case 'kml': case 'kmz':
        include('../vues/api/points.vue.kml');
        break;
    case 'gml':
        include('../vues/api/points.vue.gml');
        break;
    case 'gpx': case 'gpi':
        include('../vues/api/points.vue.gpx');
        break;
    case 'csv':
        include('../vues/api/points.vue.csv');
        break;
    case 'xml':
        include('../vues/api/points.vue.xml');
        break;
    case 'rss':
        include('../vues/api/points.vue.rss');
        break;
    default:
        include('../vues/api/points.vue.json');
        break;
}

?>
