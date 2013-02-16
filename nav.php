<?php // Préparation d'une page HTML de type 'navigation satellite'
// avec une zone de détermination de critères de choix (couches) et une fonction de zoomage.
// Des critères tels que 'refuges', villes, apparaissent au dessus d'un fond de carte.
// La page ainsi préparée comporte un script Java permettant la sélection des points chauds ("ex: refuges") de la carte
// et renvoi vers un lien sur clic souris. Le déplacement de la souris sur le fond de carte provoque l'affichage des coordonnées du point.

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// ??/11/07 jmb : nouvelle version, avec googlemaps toujours des bugs avec IE
// 01/12/07 jmb : nlle version et chgt de nom (etait wms_nav2.php avant)
// 24/07/08 jmb : mise en place $if_pub, censé transferer de la pub au header. + warning nouvelle caledonie
// 25/09/09 : compatibilité : remplacement de long par lon dans l'URL
// 27/11/10 Dominique : Passage à Openlayers
// 20/12/10 Dominique : Retour en GoogleMap API V2
// 04/10/11 Dominique : Gestion multicartes
// 08/10/11 Dominique : Utilisation des templates
// 08/05/12 Dominique : Retour en modeles simples
// 15/02/13 jmb : nav/zone/id => affichage des sous-massifs de la zone, nav/massif/id => normal
//			jmb: objectif : suppr page massif car elle redonde. modele->type_affichage
//====================
// Concept de Zone et Massifs :
// Massif (1): classique : un poly qui entoure tous les points, possibilité de jouer avec le panel de gauche
// Zone  (11): affiche tous les massifs inclus. pas de points, pas de panel. faut cliquer pour aller sur un massif. comme l'ancienne page massifs.
//===========================
// Fonctions divers et avariées
require_once ('modeles/config.php');
require_once ($config['chemin_modeles']."fonctions_bdd.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");

$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';

// Récupère les infos de type "méta informations" sur les points et les polygones
$modele->infos_base = infos_base ();
						
// l'URL d'appel de la page 
// typiquement:  /nav/Massif/34/Vercors/  pour le referenceement google
$tableau_url = explode ('/',$_SERVER['PATH_INFO']);
$modele->id_polygone = $tableau_url [2];
$modele->type_affichage = $tableau_url [1]; // "zone" ou "massif". ca definit l'affichage qui suit

// Les paramètres des layers points et massifs
if ($modele->id_polygone)
{
	// Un retour à -1 indique un problème de récupération d'un seul polygone, soit on on en voulait plusieurs
	if (($infos_polygone=infos_polygone ($modele->id_polygone))!=-1) 
	{
		$modele->titre="Cartes des refuges, sommets et sources/point d'eau dans $infos_polygone->art_def_poly $infos_polygone->type_polygone $infos_polygone->article_partitif $infos_polygone->nom_polygone";
		$modele->description = $modele->titre.". Possibilité de naviguer sur une carte avec image satellite, cartes IGN, googlemaps...";
		
		// A confirmer les avantages et inconvéniens, la liste des refuges dans le massif pour les personnes ne disposant pas de js
		// Mais également utile au référencement
		$conditions->id_polygone=$modele->id_polygone;
		$conditions->avec_infos_massif=1;
		$conditions->limite = 120; 
		$conditions->avec_liens=true;
		$modele->liste=liste_points($conditions);
	}
	else
		$modele->titre="Polygone demandé incorrect ou multiple : $modele->id_polygone";
} else
    $modele->titre = "Navigation sur les photos satellite";

$modele->viseur = isset ($_GET ['cree']); // Si le paramètre cree est déclaré, le menu de création est ouvert / Pour le lien "Ajouter un refuge" en bas de page
$modele->liste_id_point_type = // Dominique 2010 12 05 / Ajout pour retrouver les checks mémorisés dans un cookie
		$HTTP_COOKIE_VARS ['liste_id_point_type']
		? $HTTP_COOKIE_VARS ['liste_id_point_type']
		: '7,10,9,23,6,3';

		
// On affiche le tout
$modele->type = 'nav';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
