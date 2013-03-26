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
//$vue->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
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
  foreach ($zones as $zone) // FIXME ce foreach et preg_replace sont complètement ridicule mais sautero avec fusion massif/nav
    $vue->zones [$zone->nom_polygone] = lien_polygone($zone)."?mode_affichage=zone";

// News
$vue->commentaires = $commentaires;
$vue->stat = stat_site ();
$vue->general = $general;
$vue->quoi = $_GET ['quoi']
              ? $_GET ['quoi']
              : 'commentaires,points,forums';

// Préparation de la liste des photos récentes
$conditions = new stdclass();
$conditions->limite=5;
$conditions->avec_photo=True;
$conditions->avec_infos_point=True;
$vue->photos_recentes=infos_commentaires($conditions);
$vue->lien_mode_emploi=lien_mode_emploi();
?>
