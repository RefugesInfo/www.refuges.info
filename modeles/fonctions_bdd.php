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
	try {
		
		// Options de connection
		$pdo_options = array(
					PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8"  // a changer pour pgsql
		);
		$pdo = new PDO(
				"mysql:host=".$config['serveur_mysql'] . ";dbname=" . $config['base_mysql'] ,
				$config['utilisateur_mysql'],
				$config['mot_de_passe_mysql'],
				$pdo_options );
		// TOUTES les requetes seront renvoyees en fetch_object (resultat->columname)
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		return $pdo;
	} catch(Exception $e) {
		echo 'Echec de la connexion à la base de données erreur '.$e->getCode() ;
		exit();
	}

  //PDO-
//    $link_mysql = mysql_connect ($config['serveur_mysql'],$config['utilisateur_mysql'],$config['mot_de_passe_mysql']) or die("pb a la connection mysql");
//  mysql_select_db($config['base_mysql']);
//  return $link_mysql;
}
/****************************************
Retourne un tableau contenant le résultat de la requette
***************************************/
//PDO jmb c'etait pour une couche d'abstraction ? 
/*
function sql_infos ($q_select) 
{
	$r_select = mysql_query ($q_select) or die ('mauvaise requete: '.$q_select);
	
	while ($res = mysql_fetch_object ($r_select))
	  $r [] = $res;
	
	mysql_free_result ($r_select);
	
	return $r;
}
*/
/****************************************
Fonction donnant plusieurs informations générales sur la base
***************************************/
//PDO : 13/02/13 jmb abstraction PDO, ce seront des requete en prepare(). PDO+ = ajouts , PDO- = a virer
// reste que l'execute() de la couche PDO
function infos_base () {
	global $pdo;

	try {
		$pdo->requetes->liste_massifs->execute();
		$r->massifs = $pdo->requetes->liste_massifs->fetch();
		
		$pdo->requetes->liste_comments->bindValue('affichpas', -1, PDO::PARAM_INT );   // param_int CAPITAL pour PostGres
		$pdo->requetes->liste_points->execute();  // tous les points
		$r->types_point = $pdo->requetes->liste_points->fetch();

		$pdo->requetes->liste_comments->bindValue('affichpas', 0, PDO::PARAM_INT );  // param_int CAPITAL pour PostGres
		$pdo->requetes->liste_points->execute();    // que les points affichables
		$r->types_point_affichables = $pdo->requetes->liste_points->fetch();

		$pdo->requetes->liste_precisionsgps->execute();
		$r->type_precision = $pdo->requetes->liste_precisionsgps->fetch();

	} catch( PDOException $e ){
		echo 'Erreur de requete  : une des requetes info_base ', $e->getMessage();
	}

	return $r ;
/*	
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

	return $r;*/
}


// renvoie un objet avec toutes les requetes preparees PDO
function pdo_biblio_init( $pdo )
{
	global $config;

	// Donne Toutes les infos d'un polygone en joignant les 2 tables
	// :idpoly // parametre du poly a querir
	$r="SELECT *
		FROM polygone_type NATURAL JOIN polygones
		WHERE id_polygone=:idpoly";
	$biblio->infos_poly = $pdo->prepare($r);

	// liste de tous les poly de type massifs. pas de param (dommage).
	$r="SELECT *
		FROM polygones
		WHERE polygones.id_polygone_type = ".$config['id_massif']."
		ORDER BY nom_polygone'";
	$biblio->liste_massifs = $pdo->prepare($r);

	// Listage des types de points 
	// :affichpas // 0 pour les points affichables ?!?
	$r="SELECT * 
		FROM point_type 
		WHERE CASE :affichpas
					WHEN point_type.pas_afficher THEN TRUE
					WHEN -1 THEN TRUE
					ELSE FALSE
				END
		ORDER BY importance DESC";   // LIKE pour que soit accepté aussi bien 123 que %. MYSQL ONLY
	$biblio->liste_points = $pdo->prepare($r);

	// Précision des points GPS
	$r="SELECT *
		FROM type_precision_gps
		ORDER BY id_type_precision_gps";
	$biblio->liste_precisionsgps = $pdo->prepare($r);
	

	// Tous les comments d'un ou des points
	// :point // -1 pour tout avoir, il faut un INT pas un STR !!!
	// :vignette // un SQL complet genre AND 
	// :limite // LIMIT
	$r="SELECT commentaires.auteur,points.id_point,
			points.nom,commentaires.id_commentaire,commentaires.photo_existe,
			UNIX_TIMESTAMP(commentaires.date) as date
		FROM commentaires LEFT JOIN points ON commentaires.id_point = points.id_point
        WHERE
			points.modele!=1
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
        LIMIT 0,:limite";
	$biblio->liste_comments = $pdo->prepare($r);
	//$biblio->liste_comments->bindParam(':limite', $nombre_article, PDO::PARAM_INT);

	
	// Lecture de tous les massifs
	// :type // de type 1 pour massifs 10 pour dept ...
	// :fictif // le poly fictif 0 ?
	//$pdo_biblio->massifs = $pdo->prepare('SELECT * FROM polygones WHERE id_polygone_type IN ( :type ) AND id_polygone!=:fictif ' );
	//$biblio->massifs = $pdo->prepare('SELECT * FROM polygones WHERE id_polygone_type IN ( :type ) AND id_polygone!=:fictif ' );

//	$q_select_mass= "
//		SELECT *
//		FROM polygones
//		WHERE id_polygone_type={$config["id_massif"]}
//			AND id_polygone != {$config['numero_polygone_fictif']}";
//	$r_select_mass= mysql_query($q_select_mass) or die("mauvaise requete dans GMcreemassifs: $q_select_mass");

	return $biblio;
}


//FIXME sly 24/11/2012, certes, si on inclue ce fichier de fonction, c'est pour se connecter à la base mysql
//Donc on s'y connecte d'office, toutefois, une version proper serait que chaque fonction qui en a besoin
// s'y connecte d'elle même
//PDO+ on garde le lien BDD sous le coude
global $pdo;
global $pdo_biblio;

$pdo = connexion_base();

// peuple les pré-requetes dans $pdo->requetes
$pdo->requetes= pdo_biblio_init( $pdo ) ;
//var_dump($pdo->requetes);

//PDO-  inutile ici, il est dans la conx_base.
//mysql_query ( "SET NAMES utf8" );

?>
