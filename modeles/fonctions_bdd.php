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
/* Et une autre fonction postgresql spécifique pour obtenir les noms des colonnes d'une table
FIXME : ça risque d'être trop souvent appelé, le mettre dans un tableau global pourrait être plus économe... à voir
c'est pas non plus la requête qui consomme beaucoup -- sly
Le but est le suivant : Les géométries GIS peuvent être énormes, et d'habitude, je mets "select *" car c'est bien plus
simple que de lister tous les champs, qui en plus, pourraient augmenter en nombre. Mais là, surtout avec les polygones énormes
il vaut mieux pouvoir enlever la colonne "geom" si demandée (ce qui sera quasi tout le temps le cas, mais je préfère être générique)
*/
function colonnes_table($table,$renvoyer_aussi_colonne_geometrie=True)
{
  global $pdo;
  $res=$pdo->query("select column_name 
                    from information_schema.columns 
                    where 
                      table_name='$table'");
  while ($colonne=$res->fetch())
    if ($renvoyer_aussi_colonne_geometrie or $colonne->column_name!="geom")
      $r.="$table.$colonne->column_name,";
  $r=trim($r,",");
  return $r;
}

// Vu qu'on inclus ce fichier, c'est qu'on a besoin d'une connexion, chaque appelant pourrait la faire, mais c'est plus lourd
$pdo = connexion_base();


?>
