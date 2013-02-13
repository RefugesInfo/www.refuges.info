<?php
/**********************************************************************************************
Fonctions liées à l'accès à ou aux bases de données et quelques "helpers" pour en tirer des infos

**********************************************************************************************/


// jmb: pour suivre l'idee de sly: on deplace la conf
require_once("config.php");

/****************************************
Fonction générique de connexion à la base
elle renvois un lien de connexion vers mysql
***************************************/
function connexion_base()
{
  global $config;
  $link_mysql = mysql_connect ($config['serveur_mysql'],$config['utilisateur_mysql'],$config['mot_de_passe_mysql']) or die("pb a la connection mysql");
  mysql_select_db($config['base_mysql']);
  return $link_mysql;
}
/****************************************
Retourne un tableau contenant le résultat de la requette
***************************************/
function sql_infos ($q_select) 
{
	$r_select = mysql_query ($q_select) or die ('mauvaise requete: '.$q_select);
	
	while ($res = mysql_fetch_object ($r_select))
	  $r [] = $res;
	
	mysql_free_result ($r_select);
	
	return $r;
}
/****************************************
Fonction donnant plusieurs informations générales sur la base
***************************************/
function infos_base () {
	global $config;
	
	//remplissage de la combobox 'massifs'  (on laisse le massif 'nul part' qui contient des points hors massifs
	$r->massifs = sql_infos ('
		SELECT *
		FROM polygones
		WHERE polygones.id_polygone_type = '.$config['id_massif'].'
		ORDER BY nom_polygone
	');

	// Listage des types de points pour la combo box de recherche
	$r->types_point = sql_infos ('
		SELECT * 
		FROM point_type 
		ORDER BY importance DESC
	');

	// Uniquement les poinnts affichables
	$r->types_point_affichables = sql_infos ('
		SELECT * 
		FROM point_type 
		WHERE pas_afficher = 0
		ORDER BY importance DESC
	');

	// Précision des points GPS
	$r->type_precision = sql_infos ('
		SELECT *
		FROM type_precision_gps
		ORDER BY id_type_precision_gps
	');

	return $r;
}

//FIXME sly 24/11/2012, certes, si on inclue ce fichier de fonction, c'est pour se connecter à la base mysql
//Donc on s'y connecte d'office, toutefois, une version proper serait que chaque fonction qui en a besoin
// s'y connecte d'elle même
connexion_base();
mysql_query ( "SET NAMES utf8" );

?>
