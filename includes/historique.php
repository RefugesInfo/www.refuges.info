<?php
/**********************************************************************************************
Fonctions liées à l'historisation des modifications

**********************************************************************************************/

/**********************************************************************************************************************
sly : 2019-09-09 Historisation du pauvre, on log dans une table un dump de l'objet point avant et après modification
L'objet $point par défaut dispose de trop de propriété, ne gardons que celles qui peuvent être modifiées par le formulaire, 
c'est à dire celle de $point_apres qui est issue du formulaire (donc comparaison sioux entre les propriété de $point_apres et $point_avant)

**********************************************************************************************************************/
function point_historisation_modification($point_avant,$point_apres,$id_utilisateur_qui_modifie=0,$type_operation="modification")
{
  global $pdo;
  
  $point_avant_simple = new stdClass;
    if (isset($point_apres)) // la point après modification existe, on stockera d'utile que les propriétés qui ont été passé par le formulaire (moins lourd)
     foreach ($point_apres as $propriete => $valeur)
       $point_avant_simple->$propriete=$point_avant->$propriete;
    else
      foreach ($point_avant as $propriete => $valeur)
        if ($propriete!='polygones') // en cas de suppression, la liste des polygones auquel appartenait le point ne nous intéresse pas tant que ça, lourd à l'écran !
          $point_avant_simple->$propriete=$point_avant->$propriete;
       
  $query_log_modification="insert into historique_modifications_points 
  (id_point,id_user,date_modification,avant,apres,type_modification) 
  values 
  ($point_avant->id_point,
  $id_utilisateur_qui_modifie,
  NOW(),
  ".$pdo->quote(serialize($point_avant_simple)).",
  ".$pdo->quote(serialize($point_apres)).",
  '$type_operation')";
  
  if (!$pdo->exec($query_log_modification))
      return erreur("Requête en erreur, impossible d'historiser la modification",$query_log_modification);
}

/**********************************************************************************************************************
Dom : 2024-07-25 Généralisation de l'historisation
Sauvegarde dans la table historique_modifications :
- La commande, l'ID user, date, ...
- Les données SQL avant la modification (seulement les données modifiées ou supprimées)
- Le GEOM avant (seulement s'il est modifié)

**********************************************************************************************************************/
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
