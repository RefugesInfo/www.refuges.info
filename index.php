<?php 
/*******************************************************************************
Ecran d'accueil

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $modele->...
*******************************************************************************/

require_once ('modeles/config.php');
require_once ("fonctions_nouvelles.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_autoconnexion.php");

$modele = new stdClass;
$modele->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';

$conditions_notre_zone = new stdClass;
$conditions_notre_zone->ids_polygones=$config['id_zone_defaut'];
$conditions_notre_zone->avec_bbox_geometrie=True;

$polygones=infos_polygones($conditions_notre_zone);
$modele->bbox=$polygones[0]->bbox;

// liens vers les zones
$conditions = new stdClass;
$conditions->id_polygone_type=$config['id_zone'];
$zones=infos_polygones($conditions);
// Ajoute les liens vers les autres zones
foreach ($zones as $zone) // FIXME ce preg_replace est complètement ridicule mais sautera avec fusion massif/nav
  $modele->zones [$zone->nom_polygone] = preg_replace("/nav/","massifs",lien_polygone($zone))."?mode_affichage=zone";


// Réinitialise les paramètres de réaffichage des pages suivantes, notamment la couche par défaut = Google
setcookie ('Olparams', '', time() - 3600, '/');


// News
$modele->commentaires = $commentaires;
$modele->stat = stat_site ();
$modele->general = $general;
$modele->quoi = $_GET ['quoi']
			  ? $_GET ['quoi']
			  : 'commentaires,points,forums';
			  
// Préparation de la liste des photos récentes
$conditions = new stdclass();
$conditions->limite=5;
$conditions->avec_photo=True;
$conditions->avec_infos_point=True;
$modele->photos_recentes=infos_commentaires($conditions);

// On affiche le tout
$modele->type = 'index';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
