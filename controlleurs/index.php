<?php 
/*******************************************************************************
Ecran d'accueil

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...
*******************************************************************************/

require_once ("fonctions_nouvelles.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_mode_emploi.php");

$vue->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$vue->java_lib [] = $config['chemin_openlayers'].'OpenLayers.js';

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
$vue->photos_recentes=infos_commentaires($conditions);
$vue->lien_mode_emploi=lien_mode_emploi();

// Préparation de la liste des nouvelles générales
$conditions_commentaires_generaux = new stdClass;
$conditions_commentaires_generaux->ids_points=$config['numero_commentaires_generaux'];
$conditions_commentaires_generaux->limite=2;
$vue->nouvelles_generales=infos_commentaires($conditions_commentaires_generaux);

// Préparation de la liste des nouveaux commentaires
// ici, on pourrait vraiment se passer de la fonction nouvelles et ansi de pas dépendre d'un truc qui génère du HTML
$vue->nouveaux_commentaires=nouvelles(9,"commentaires");

// Préparation de la liste des nouveaux points rentrés
$conditions_nouveaux_points = new stdClass;
$conditions_nouveaux_points->limite=3;
$conditions_nouveaux_points->avec_infos_massif=True;
$conditions_nouveaux_points->ordre="date_creation DESC";
$vue->nouveaux_points=infos_points($conditions_nouveaux_points);
?>
