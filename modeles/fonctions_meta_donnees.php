<?php
/**********************************************************************************************
Fonctions fournissant un accès aux données sur les données principales (que sont les points, les commentaires, les polygones et les utilisateurs)

**********************************************************************************************/

require_once("config.php");
require_once("fonctions_bdd.php");

/****************************************
Fonction donnant plusieurs informations générales sur la base
***************************************/
function infos_base () {
	global $config,$pdo;
	
	$sql = "SELECT * 
		FROM point_type 
		ORDER BY importance DESC";  
	$q = $pdo->query( $sql );
	while( $res = $q->fetch() )
		$r->types_point[] = $res ;

	$sql = "SELECT * 
		FROM point_type 
		WHERE point_type.pas_afficher=0
		ORDER BY importance DESC";  
	$q = $pdo->query( $sql );
	while( $res = $q->fetch() )
		$r->types_point_affichables[] = $res ;

	$sql = "SELECT *
		FROM type_precision_gps
		ORDER BY ordre";
	$q = $pdo->query( $sql );
	while( $res = $q->fetch() )
		$r->type_precision[] = $res ;

	return $r ;
}


?>
