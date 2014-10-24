<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/point?id=2205 : pt normal
 * http://leo.refuges.info/api/point?id=2777 : coordonnées cachées
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

/****************************** INFOS GÉNÉRALES ******************************/

// La on met en forme l'objet, c'est assez gros :
$point = new stdClass();
$point->id = $pointBrut->id_point;
$point->id_gps = $pointBrut->id_point_gps;
$point->nom = $pointBrut->nom;
// On affiche les coordonnées que si elles ne sont pas cachées
if($pointBrut->id_type_precision_gps != $config['id_coordonees_gps_fausses']) {
    $point->coord['long'] = $pointBrut->longitude;
    $point->coord['lat'] = $pointBrut->latitude;
}
$point->coord['alt'] = $pointBrut->altitude;
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
$point->etat['valeur'] = texte_non_ouverte($pointBrut);
$point->createur['id'] = $pointBrut->id_createur;
// info sur le créateur de la fiche (authentifié ou non)
if ($pointBrut->id_createur==0) // non authentifié
    $point->createur['nom']=$pointBrut->nom_createur;
else
    $point->createur['nom'] = infos_utilisateur($pointBrut->id_createur)->username;
$point->date['derniere_modif'] = $pointBrut->date_derniere_modification;
$point->date['creation'] = $pointBrut->date_creation;
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
$point->info_comp['places_matelas']['nb'] = $pointBrut->places_matelas;
if($pointBrut->places_matelas == -1)
    $point->info_comp['places_matelas']['valeur'] = "Sans";
elseif($pointBrut->places_matelas === 0)
    $point->info_comp['places_matelas']['valeur'] = "Avec, en nombre inconnu";
else
    $point->info_comp['places_matelas']['valeur'] = $pointBrut->matelas;
$point->info_comp['latrines']['nom'] = $pointBrut->equivalent_latrines;
$point->info_comp['latrines']['valeur'] = $pointBrut->latrines;
$point->info_comp['bois']['nom'] = $pointBrut->equivalent_bois_a_proximite;
$point->info_comp['bois']['valeur'] = $pointBrut->bois_a_proximite;
$point->info_comp['eau']['nom'] = $pointBrut->equivalent_eau_a_proximite;
$point->info_comp['eau']['valeur'] = $pointBrut->eau_a_proximite;

unset($pointBrut);

/****************************** POINTS PROCHES ******************************/

if ($point->coord['precision']['type'] != $config['id_coordonees_gps_fausses'])
{
    $conditions = new stdClass;
    $conditions->limite = $req->nb_pp+1; // Parce que le point que l'on observe est retourné en premier
    $conditions->ouvert = 'oui';
    
    $g = array ( 'lat' => $point->coord['lat'], 'lon' => $point->coord['long'] , 'rayon' => 5000 );
    $conditions->geometrie = cree_geometrie( $g , 'cercle' );
    $conditions->avec_distance=True;

    $points_proches=infos_points($conditions);
    
    if (count($points_proches))
	$i=0;
	foreach ($points_proches as $point_proche) 
	{
	    //On ne veut pas dans les points proches le point lui même
	    if ($point_proche->id_point!=$point->id)
	    {
		$point->pp[$i]['id']=$point_proche->id_point;
		$point->pp[$i]['nom']=$point_proche->nom;
		$point->pp[$i]['alt']=$point_proche->altitude;
		$point->pp[$i]['type']['id']=$point_proche->id_point_type;
		$point->pp[$i]['type']['valeur']=$point_proche->nom_type;
		$point->pp[$i]['distance']=$point_proche->distance;
		$i++;
	    }
	}
}

$point->pp[nb] = $i;

unset($conditions);
unset($point_proche);
unset($points_proches);

/****************************** COMMENTAIRES ******************************/

$conditions = new stdClass();
$conditions->ids_points = $point->id;
$conditions->limite = $req->nb_coms;
$tous_commentaires = infos_commentaires ($conditions);

$i=0;
foreach ($tous_commentaires AS $commentaire)
{
    $point->coms[$i]['id'] = $commentaire->id_commentaire;
    $point->coms[$i]['date'] = $commentaire->date;
    $point->coms[$i]['createur']['id'] = $commentaire->id_createur_commentaire;
    // info sur l'auteur du commentaire (authentifié ou non)
    if ($commentaire->id_createur_commentaire==0) // non authentifié
	$point->coms[$i]['createur']['nom']=$commentaire->auteur_commentaire;
    else
	$point->coms[$i]['createur']['nom'] = infos_utilisateur($commentaire->id_createur_commentaire)->username;
    $point->coms[$i]['texte'] = $commentaire->texte;
    $point->coms[$i]['photo']['nb'] = $commentaire->photo_existe;
    $point->coms[$i]['photo']['date'] = $commentaire->date_photo;
    $point->coms[$i]['photo']['reduite'] = $commentaire->reduite;
    $point->coms[$i]['photo']['originale'] = $commentaire->originale;
    $i++;
}
$point->coms['nb'] = $i;

unset($conditions);
unset($commentaire);
unset($tous_commentaires);

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
    default:
        include('./vue/point.json');
        break;
}

?>