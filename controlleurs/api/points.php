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
include_once("entetes_http.php");

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
// FIXME sly 2019 : tout ça devrait être récupéré de la base de donnée, ça exite déjà dans point_type, quel dommage de maintenir 2 duplicats
$val->type_points = array("cabane", "refuge", "gite", "pt_eau", "sommet", "pt_passage", "bivouac", "lac", "batiment_a_explorer");
$val->type_points_id = array(7, 10, 9, 23, 6, 3, 19, 16, 28);

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

$points_bruts = new stdClass();
$points = new stdClass();

$points_bruts = infos_points($params);

/****************************** INFOS GÉNÉRALES ******************************/
/*
L'idée est de générer une grosse collection de points avec presque toutes leurs propriétés, la vue ne se servant que ce dont elle a besoin selon qu'elle est csv, gpx, etc. 
ça consome plus de RAM bien sûr et plus de CPU, mais ça simplifie vachement le code en ayant le même traitement quel que soit la vue
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
    if($point->id_type_precision_gps == $config_wri['id_coordonees_gps_fausses']) // les cabanes cachées ne sont pas exportées. Les coordonnées étant volontairement stockées fausses, les sortir ne fera que créer de la confusion 
      break;
    
    $points->$i = new stdClass();
    $points->$i->id = $point->id_point;
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
    // FIXME sly 05/12/2019 : ça me rend fou cette recopie intégrale propriété par propriété. ça oblige à venir maintenir ça !
    // $points[]=$point; n'aurait il pas suffit ? et en plus le nom des propriété changent de peu et je passe mon temps à ne plus m'en rappeler !
    // certes ça fait un joli array final multi-niveau et un joli json_encode($point), mais franchement, le jeu en vaut-il la chandelle ?
    $points->$i->coord['alt'] = $point->altitude;
    $points->$i->type['id'] = $point->id_point_type;
    $points->$i->type['valeur'] = $point->nom_type;
    $points->$i->places['nom'] = $point->equivalent_places;
    $points->$i->places['valeur'] = $point->places;
    $points->$i->etat['valeur'] = texte_non_ouverte($point);
    $points->$i->type['icone'] = choix_icone($point);
    $points_geojson[$point->id_point]['geojson'] = $point->geojson; // FIXME: comme l'array $points est converti en intégralité en xml ou json, je planque dans une autre variable ce que je veux séparément
    
    if ($req->format!="geojson" or $req->detail=="complet") // En geojson, utilisé par la carte, on a pas besoin de tout ça, autant simplifier pour réduire le temps de chargement, sauf si on appel explicitement le mode complet avec &detail=complet
    {
      $points->$i->coord['long'] = $point->longitude;
      $points->$i->coord['lat'] = $point->latitude;
      $points->$i->etat['id'] = $point->conditions_utilisation;
      $points->$i->date['derniere_modif'] = $point->date_derniere_modification;
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
      if($point->places_matelas == 0)
          $points->$i->info_comp['places_matelas']['valeur'] = "Sans";
      else
          $points->$i->info_comp['places_matelas']['valeur'] = $point->places_matelas;
      $points->$i->info_comp['latrines']['nom'] = $point->equivalent_latrines;
      $points->$i->info_comp['latrines']['valeur'] = $point->latrines;
      $points->$i->info_comp['bois']['nom'] = $point->equivalent_bois_a_proximite;
      $points->$i->info_comp['bois']['valeur'] = $point->bois_a_proximite;
      $points->$i->info_comp['eau']['nom'] = $point->equivalent_eau_a_proximite;
      $points->$i->info_comp['eau']['valeur'] = $point->eau_a_proximite;

      /*
      sly 09/12/2019 : Construction d'un grand texte contenant ce qui me semble le plus pertinent concernant un point, afin de l'inclure dans la description des gpx, ça pourrait aussi être réutilisé pour le kml
      */
      $description="";
      if ($point->equivalent_places!="" and !empty($point->places))
        $description=$point->equivalent_places. ": ".$point->places."\n";
        
      if ($point->equivalent_places_matelas!="" and !empty($point->places_matelas))
        $description.=$point->equivalent_places_matelas.": ".$point->places_matelas."\n";
        
      $description.=$point->remark;
      $description.=$point->acces;
      if ( $point->equivalent_proprio!="")
        $description.=$point->proprio;
      
      $points->$i->description['valeur']=htmlspecialchars(bbcode2txt($description));
    }

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
/****************************** FORMAT VUE ******************************/

include($config_wri['chemin_vues'].'api/points.vue.'.$req->format.".php");
?>
