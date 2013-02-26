<?php
/**********************************************************************************************
Fonctions liées à l'accès à ou aux bases de données et quelques "helpers" pour en tirer des infos

**********************************************************************************************/

require_once("config.php");

/****************************************
Fonction générique de connexion à la base
elle renvois un lien de connexion de type $PDO
***************************************/
function connexion_base()
{
	global $config;

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
FIXME sly : cette fonction n'est à mon avis pas à la bonne place, rempli des tableaux là où
on a pas forcément besoin de tout. Peut-être une variante modulaire ? passer a pdo_biblio_init( $pdo ) ci après ?
***************************************/
//PDO : 13/02/13 jmb abstraction PDO, ce seront des requete en prepare()
// reste que l'execute() de la couche PDO
function infos_base () {
	global $config,$pdo;
	
	// On évite "*" pour les polygones car il y a des mastoques géométries maintenant
	// Déjà que cette requête va chercher tous les polygones, qui vont être de plus en plus nombreux...
	$sql = "SELECT id_polygone,id_polygone_type,article_partitif,nom_polygone,source,message_information_polygone,url_exterieure
		FROM polygones
		WHERE 
			polygones.id_polygone_type = ".$config['id_massif']."
			AND id_polygone != ".$config['numero_polygone_fictif']."
		ORDER BY nom_polygone";
	$q = $pdo->query( $sql );
	while( $res = $q->fetch() )
		$r->massifs[] = $res ;

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


// renvoie un objet avec toutes les requetes preparees PDO
function pdo_biblio_init( $pdo )
{
	global $config;
	$biblio = new stdClass(); //yip : c'est quoi ?
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
/*
Avec Postgresql impossible de ré-utiliser une forme commune de requête entre un update et un insert, c'est 
devenu tellement relou que j'ai fais cette fonction pour construire la requête
$table = le nom de la table dans laquelle on veut mettre à jour un enregistrement ou inserer un enregistrement
$champs_valeur = un array associatif avec comme clef, le champ à mettre à jour, sa valeur la valeur à mettre à jour
$update_ou_insert = soit 'update' soit 'insert'
$condition = la clause, dans le cas d'un update indiquant quel enregistrement à mettre à jour genre 'id_point=5'

*/
function requete_modification_ou_ajout_generique($table,$champs_valeur,$update_ou_insert,$condition="")
{
	if ($update_ou_insert == "update") // Un UPDATE
	{
		foreach ($champs_valeur as $champ_sql => $valeur)
			$sql_update.="\n$champ_sql=$valeur,";
		$sql_update = trim($sql_update,",");
		$query="UPDATE $table SET 
		  $sql_update
		WHERE 
		  $condition";
	} 
	else // un INSERT
	{
		foreach ($champs_valeur as $champ_sql => $valeur)
		{
			$liste_champs.="$champ_sql,";
			$liste_valeurs.="$valeur,";
		}
		$liste_champs = trim($liste_champs,",");
		$liste_valeurs = trim($liste_valeurs,",");
		
		$query="INSERT INTO $table
		  ($liste_champs)
		VALUES
		  ($liste_valeurs)";
	}
	return $query;
}

// on garde le lien BDD sous le coude
global $pdo;
//global $pdo_biblio; 

$pdo = connexion_base();

// peuple les pré-requetes dans $pdo->requetes
$pdo->requetes= pdo_biblio_init( $pdo ) ;

?>
