<?php 
/*******************************************************************************
Ecran d'accueil

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...
*******************************************************************************/

require_once ("nouvelle.php");
require_once ("polygone.php");
require_once ("wiki.php");

$vue->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$vue->description='Base de donnee de refuges, abris, gites, sommets et divers points en montagne avec cartes satellite, descriptions et coordonnees GPS';

$vue->java_lib_foot [] = $config['url_chemin_leaflet'].'leaflet.js?' .filemtime($config['chemin_leaflet'].'leaflet.js');
$vue->css           [] = $config['url_chemin_leaflet'].'leaflet.css?'.filemtime($config['chemin_leaflet'].'leaflet.css');

$conditions_notre_zone = new stdClass;
$conditions_notre_zone->ids_polygones=$config['id_zone_accueil'];
$polygones=infos_polygones($conditions_notre_zone);
$vue->bbox=$polygones[0]->bbox;

// liens vers les zones
$conditions = new stdClass;
$conditions->ids_polygone_type=$config['id_zone'];
$zones=infos_polygones($conditions);

// Ajoute les liens vers les autres zones
if ($zones)
  foreach ($zones as $zone)
    $vue->zones [$zone->nom_polygone] = lien_polygone($zone)."?mode_affichage=zone";

// Nouvelles
$vue->commentaires = $commentaires;
$vue->stat = stat_site ();

// Préparation de la liste des photos récentes
$conditions = new stdclass();
$conditions->limite=5;
$conditions->avec_photo=True;
$conditions->avec_infos_point=True;
$commentaires_avec_photos_recentes=infos_commentaires($conditions);
foreach ($commentaires_avec_photos_recentes as $commentaire_avec_photo_recente)
{
    $commentaire_avec_photo_recente->lien=lien_point($commentaire_avec_photo_recente)."#C$vignette->id_commentaire";
    $commentaire_avec_photo_recente->nom=bbcode2html($commentaire_avec_photo_recente->nom);
    $vue->photos_recentes[]=$commentaire_avec_photo_recente;
}

$vue->lien_a_propos_site=lien_wiki("index");

// Préparation de la liste des nouvelles générales
$conditions_commentaires_generaux = new stdClass;
$conditions_commentaires_generaux->ids_points=$config['numero_commentaires_generaux'];
$conditions_commentaires_generaux->limite=2;
$vue->nouvelles_generales=infos_commentaires($conditions_commentaires_generaux);

// FIXME: Préparation de la liste des nouveaux commentaires
// ici, on pourrait vraiment se passer de la fonction nouvelles et ainsi de pas dépendre d'un truc qui génère du HTML
$vue->nouveaux_commentaires=nouvelles(9,"commentaires");

// Préparation de la liste des nouveaux points rentrés
$conditions_nouveaux_points = new stdClass;
$conditions_nouveaux_points->limite=3;
$conditions_nouveaux_points->avec_infos_massif=True;
$conditions_nouveaux_points->ordre="date_creation DESC";
$nouveaux_points=infos_points($conditions_nouveaux_points);
foreach ($nouveaux_points as $nouveau_point)
{
    $nouveau_point->lien=lien_point($nouveau_point);
    $nouveau_point->nom=mb_ucfirst(bbcode2html($nouveau_point->nom));
    $vue->nouveaux_points[]=$nouveau_point;
}
$page_nouvelles=recupere_contenu("nouvelles_generales");
$vue->nouvelles_generales=$page_nouvelles->contenu_html;

?>
