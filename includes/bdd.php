<?php
/**********************************************************************************************
Fonctions liées à l'accès à ou aux bases de données et quelques "helpers" pour en tirer des infos

**********************************************************************************************/

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
				$config_wri['mot_de_passe_pgsql']
				,array(PDO::ATTR_PERSISTENT => true));
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

2023 TO CHECK : Il parait que PostGresql dispose du mode : INSERT INTO table (id, x) VALUES (2, "x") ON CONFLICT (id) DO UPDATE
Avec ça, on pourrait se passer de cette fonction (qui n'est utilisée que 2 fois)
*/
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

/*
Dom : 2024-07-25 Généralisation de l'historisation
Sauvegarde dans la table historique_modifications :
- La commande, l'ID user, date, ...
- Les données SQL avant la modification (seulement les données modifiées ou supprimées)
- Le GEOM avant (seulement s'il est modifié)
*/
function historisation_modification($commande,$table,$nom_index,$valeur_index,$champs_valeurs_apres=[])
{
  global $pdo, $user;

  // On récupère les valeurs avant modifs
  $sql = "SELECT *, ST_AsGeoJSON(geom) AS geojson FROM $table WHERE $nom_index = $valeur_index";
  $res = $pdo->query($sql);
  if (!$res)
    return erreur("Erreur sur la requête SQL",$sql);
  $champs_valeurs_avant = (array) $res->fetch();

  $modifs_valeurs = [];
  $keys = array_keys ($commande == 'delete' ? $champs_valeurs_avant : $champs_valeurs_apres);
  foreach ($keys as $colonne)
  {
    $avant = $champs_valeurs_avant[$colonne];
	// Ramène le champ au format string du résultat SQL
    if ($avant === TRUE) $avant = 'TRUE';
    elseif ($avant === FALSE) $avant = 'FALSE';
    elseif ($avant === NULL) $avant = 'NULL';
    else $avant = strval($avant); // Valeur numérique

    $apres = str_replace("''", "'", trim($champs_valeurs_apres[$colonne], "'"));

    if ($avant && // S'il n'y avait rien avant, on ne cherche pas
      $avant !== $apres &&
      $colonne !== $nom_index &&
      strncmp($colonne, 'geo', 3) && // geom, geojson
      strncmp($colonne, 'date', 4)) // date_modification date_creation
      $modifs_valeurs[$colonne] = $champs_valeurs_avant[$colonne];
  }

  $trace = [
    "id_user" => $user->data['user_id'],
    "date_modification" => 'NOW()',
    "commande" => $pdo->quote($commande),
    "nom_table" => $pdo->quote($table),
    "id_point" => $champs_valeurs_avant[$nom_index],
    "donnees_avant" => $pdo->quote(json_encode($modifs_valeurs)),
  ];

  $geom_avant = "ST_SetSRID(ST_GeomFromGeoJSON('{$champs_valeurs_avant['geojson']}'), 4326)";
  if ($champs_valeurs_apres['geom'] !== $geom_avant)
    $trace['geom_avant'] = $geom_avant;

  $sql = "insert into historique_modifications
    (" . implode(',', array_keys($trace)) . ")
    values (" . implode(',',$trace) . ")";

  if (!$pdo->exec ($sql))
    return erreur ("Erreur sur la requête SQL",$sql);
}

// Vu qu'on inclus ce fichier, c'est qu'on a besoin d'une connexion, chaque appelant pourrait la faire, mais c'est plus lourd
$pdo = new PDO_wri();
