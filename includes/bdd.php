<?php
/**********************************************************************************************
Fonctions liées à l'accès à ou aux bases de données et quelques "helpers" pour en tirer des infos

**********************************************************************************************/

require_once("config.php");
require_once("gestion_erreur.php");

/*
Extension de la classe qui nous permet de récupérer le last inserted ID sans être obligé de spécifier à chaque fois la séquence postgresql, 
et en restant dans la compatibilité avec PDO.
J'en profite pour faire que cette classe se connecte avec les identifiants wri
*/
class PDO_wri extends PDO
{
    function lastInsertId ($string=Null)
    {
        $q="select LASTVAL() as last_id;";
        $res=$this->query($q);
        if (!$res)
            return erreur("Impossible de récupérer le dernier id créé",$q);
        $id=$res->fetch();
        return $id->last_id;
    }
    function __construct()
    {
        global $config_wri;
        try
        {
            parent::__construct(
				"pgsql:host=".$config_wri['serveur_pgsql'] . ";dbname=" . $config_wri['base_pgsql'] ,
				$config_wri['utilisateur_pgsql'],
				$config_wri['mot_de_passe_pgsql']);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
	catch(Exception $e) 
        {
            return erreur('Echec de la connexion à la base de données erreur ',$e->getCode());
        }
    }
}

/*
Avec Postgresql impossible de ré-utiliser une forme commune de requête entre un update et un insert, c'est 
devenu tellement relou que j'ai fais cette fonction pour construire la requête
$table = le nom de la table dans laquelle on veut mettre à jour un enregistrement ou inserer un enregistrement
$champs_valeur = un array associatif avec comme cle, le champ à mettre à jour, sa valeur la valeur à mettre à jour
$update_ou_insert = soit 'update' soit 'insert'
$condition = la clause, dans le cas d'un update indiquant quel enregistrement à mettre à jour genre 'id_point=5'

*/
// bonne idée la centralisation des UPDATE/INSERT
// TODO (jmb) Faire un UPSERT a la place, pas de differenciation dans tous les appelants,
// ils fournissent l'objet, et on se demerde pour savoir.
// la difference serait faite ici: pas de condition => INSERT.
// c'est quasiment tout fait puisque $condition="". 
// la requete PDO devrait etre aussi lancee ici, et renvoyer l'ID
function requete_modification_ou_ajout_generique($table,$champs_valeur,$update_ou_insert,$condition="")
{
    // Regroupement : un pas vers l'UPSERT
    foreach ($champs_valeur as $champ_sql => $valeur)
	{
		$liste_champs[]  = $champ_sql;
		$liste_valeurs[] = $valeur;
	}

    if( $condition )
        $query = "UPDATE $table SET (".implode(',',$liste_champs).") = (".implode(',',$liste_valeurs).") WHERE $condition";
    else
        $query = "INSERT INTO $table (".implode(',',$liste_champs).") VALUES (".implode(',',$liste_valeurs).")";

    return $query;
}
/* Et une autre fonction postgresql spécifique pour obtenir les noms des colonnes d'une table
FIXME : ça risque d'être trop souvent appelé, le mettre dans un tableau global pourrait être plus économe... à voir
c'est pas non plus la requête qui consomme beaucoup -- sly
Le but est le suivant : Les géométries GIS peuvent être énormes, et d'habitude, je mets "select *" car c'est bien plus
simple que de lister tous les champs, qui en plus, pourraient augmenter en nombre. Mais là, surtout avec les polygones énormes
il vaut mieux pouvoir enlever la colonne "geom" si demandée (ce qui sera quasi tout le temps le cas, mais je préfère être générique)

Cette fonction retourne les champs sous la forme d'une chaine au format "table.champ1,table.champ2"
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
$pdo = new PDO_wri();


?>
