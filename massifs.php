<?php 
// Ecran d'accueil (massifs disponibles)

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 10/03/06 rff : déplacement échelle à droite en bas de l'image. Ajout instr. de libération query sql
// 21/03/06 rff : Insertion infos de session : utile pour gestion du cache & menu gestion. Ajout layer 'polygones'
// 06/11/10 Dominique : Passage sur les cartes Openlayers
// 20/12/10 Dominique : Retour en GoogleMap API V2
// 04/10/11 Dominique : Gestion multicartes
// 08/10/11 Dominique : Utilisation des templates
// 08/05/12 Dominique : Retour en modeles simples
// 15/02/13 jmb : page redondante avec NAV ? 
// --> Oui, clairement, il faut qu'on se débarrasse de ce trucs et que les zones soient des polygones comme les autres gérés par nav.php sly 16/02/2013

require_once ("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_bdd.php");

$modele = new stdClass;
$modele->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';

// l'URL d'appel de la page 
// typiquement:  /massif/34/zone/pyrenees/?mode_affichage=zone  pour le referenceement google
$tableau_url = explode ('/',$_SERVER['PATH_INFO']);
$modele->id_polygone = $tableau_url [1];
$modele->type_affichage = $_GET['mode_affichage']; // "zone" ou "massif". ca definit l'affichage qui suit
if (!is_numeric($modele->id_polygone))
  $modele->id_polygone=$config['id_zone_defaut'];

$conditions_notre_zone = new stdClass;
$conditions_notre_zone->ids_polygones=$modele->id_polygone;
$conditions_notre_zone->avec_bbox_geometrie=True;

$polygones=infos_polygones($conditions_notre_zone);
$modele->bbox=$polygones[0]->bbox;



$conditions = new stdClass;

// liens vers les autres zones
$conditions->id_polygone_type=$config['id_zone'];
$zones=infos_polygones($conditions);
// Ajoute les liens vers les autres zones
foreach ($zones as $zone) // FIXME ce preg_replace est complètement ridicule mais sautera avec fusion massif/nav
  $modele->zones [$zone->nom_polygone] = preg_replace("/nav/","massifs",lien_polygone($zone))."?mode_affichage=zone";

// Réinitialise les paramètres de réaffichage des pages suivantes, notamment la couche par défaut = Google
setcookie ('Olparams', '', time() - 3600, '/');

// On affiche le tout
$modele->type = 'massifs';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
