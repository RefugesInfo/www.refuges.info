<?php
/**********************************************************************************************
Fonctions liées à l'accès à ou aux bases de données et quelques "helpers" pour en tirer des infos

**********************************************************************************************/


// jmb: pour suivre l'idee de sly: on deplace la conf
require_once("config.php");

/****************************************
Fonction générique de connexion à la base
elle renvois un lien de connexion vers mysql
//PDO : 13/02/13 jmb abstraction PDO, pour remplacement. PDO+ = ajouts , PDO- = a virer
***************************************/
function connexion_base()
{
	global $config;

	//PDO+
	//les try catch ne marchent pas
	try {
		
		// Options de connection
		$pdo_options = array(
					PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8"  // a changer pour pgsql
		);
		$pdo = new PDO(
				"pgsql:host=".$config['serveur_pgsql'] . ";dbname=" . $config['base_pgsql'] ,
				$config['utilisateur_pgsql'],
				$config['mot_de_passe_pgsql'],
				$pdo_options );
		// TOUTES les requetes seront renvoyees en fetch_object (resultat->columname)
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		return $pdo;
	} catch(Exception $e) {
		echo 'Echec de la connexion à la base de données erreur '.$e->getCode() ;
		exit();
	}
}

/****************************************
Fonction donnant plusieurs informations générales sur la base
***************************************/
//PDO : 13/02/13 jmb abstraction PDO, ce seront des requete en prepare()
// reste que l'execute() de la couche PDO
function infos_base () {
	global $config,$pdo;

	try {
		$pdo->requetes->liste_polys->bindValue('typepoly', $config['id_massif'] , PDO::PARAM_INT );   // param_int CAPITAL pour PostGres
		$pdo->requetes->liste_polys->execute() ;
		while( $res = $pdo->requetes->liste_polys->fetch() )
			$r->massifs[] = $res ;

		$pdo->requetes->liste_points->bindValue('affichpas', -1, PDO::PARAM_INT );   // param_int CAPITAL pour PostGres
		$pdo->requetes->liste_points->execute();  // tous les points
		while( $res = $pdo->requetes->liste_points->fetch() )
			$r->types_point[] = $res ;

		$pdo->requetes->liste_points->bindValue('affichpas', 0, PDO::PARAM_INT );  // param_int CAPITAL pour PostGres
		$pdo->requetes->liste_points->execute();    // que les points affichables
		while( $res = $pdo->requetes->liste_points->fetch() )
			$r->types_point_affichables[] = $res ;

		$pdo->requetes->liste_precisionsgps->execute();
		while( $res = $pdo->requetes->liste_precisionsgps->fetch() )
			$r->type_precision[] = $res ;

	} catch( PDOException $e ){
		echo 'Erreur de requete  : une des requetes info_base ', $e->getMessage();
	}

	return $r ;
}


// renvoie un objet avec toutes les requetes preparees PDO
function pdo_biblio_init( $pdo )
{
	global $config;
	$biblio = new stdClass();
	//===== INFOS_POLY
	// Donne Toutes les infos d'un polygone en joignant les 2 tables
	// :idpoly // parametre du poly a querir
	$r="SELECT *
		FROM polygone_type NATURAL JOIN polygones
		WHERE id_polygone=:idpoly";
	$biblio->infos_poly = $pdo->prepare($r);

	//===== INFOS_COMMENT
	// Les infos d'un commentaire
	// timestamp géré en PHP, pour la portabilité mysql/pgsql
	// :comment // id du comment
	$r="SELECT *
		FROM commentaires
		WHERE id_commentaire = :comment";
	$biblio->infos_comment = $pdo->prepare($r);

	//===== LISTE_POLYS
	// liste de tous les poly de type massifs. pas de param (dommage).
	// :typepoly // liste les polys de ce type seulement. -1 pour tous
	$r="SELECT *
		FROM polygones
		WHERE 
			id_polygone != ".$config['numero_polygone_fictif']."
			AND CASE :typepoly
				WHEN polygones.id_polygone_type THEN TRUE
				WHEN -1 THEN TRUE
				ELSE FALSE
			END
		ORDER BY nom_polygone";
	$biblio->liste_polys = $pdo->prepare($r);

	//===== LISTE_POINTS
	// Listage des types de points 
	// :affichpas // 0 pour les points affichables ?!?
	$r="SELECT * 
		FROM point_type 
		WHERE CASE :affichpas
					WHEN point_type.pas_afficher THEN TRUE
					WHEN -1 THEN TRUE
					ELSE FALSE
				END
		ORDER BY importance DESC";  
	$biblio->liste_points = $pdo->prepare($r);

	//===== LISTE_PRECISIONGPS
	// Précision des points GPS
	$r="SELECT *
		FROM type_precision_gps
		ORDER BY ordre";
	$biblio->liste_precisionsgps = $pdo->prepare($r);
	
	//===== LISTE_COMMENTS
	// Tous les comments d'un ou des points
	// :comment // un id de comment, -1 pour tout
	// :point // -1 pour tout avoir, il faut un INT pas un STR !!!
	// :vignette // -1 pour tout
	// :limite // LIMIT
	$r="SELECT commentaires.auteur,points.id_point,
			points.nom,commentaires.id_commentaire,commentaires.photo_existe,
			extract('epoch' from commentaires.date) as date
		FROM commentaires LEFT JOIN points ON commentaires.id_point = points.id_point
        WHERE
			points.modele!=1
			AND CASE :comment
				WHEN commentaires.id_commentaire THEN TRUE
				WHEN -1 THEN TRUE
				ELSE FALSE
			END
			AND CASE :point
				WHEN points.id_point THEN TRUE
				WHEN -1 THEN TRUE
				ELSE FALSE
			END
			AND CASE :vignette
				WHEN commentaires.photo_existe THEN TRUE
				WHEN -1 THEN TRUE
				ELSE FALSE
			END
		ORDER BY commentaires.date DESC
        LIMIT :limite";
	$biblio->liste_comments = $pdo->prepare($r);

	return $biblio;
}


// on garde le lien BDD sous le coude
global $pdo;
global $pdo_biblio;

$pdo = connexion_base();

// peuple les pré-requetes dans $pdo->requetes
$pdo->requetes= pdo_biblio_init( $pdo ) ;

?>
