<?php
/**********************************************************************************************
Fonctions liées à l'historisation des modifications

**********************************************************************************************/

/**********************************************************************************************************************
sly : 2019-09-09 Historisation du pauvre, on log dans une table un dump de l'objet point avant et après modification
L'objet $point par défaut dispose de trop de propriété, ne gardons que celles qui peuvent être modifiées par le formulaire,
c'est à dire celle de $point_apres qui est issue du formulaire (donc comparaison sioux entre les propriété de $point_apres et $point_avant)

**********************************************************************************************************************/
function historisation_modification($point_avant,$point_apres,$type_operation="modification point",$user_id_faisant_la_modif=0)
{
  global $pdo;

  $point_avant_simple = new stdClass;
  $point_apres_simple = new stdClass;

  // Retournés dans le $_POST mais pas mémorisés dans la base
  unset($point_apres->lat, $point_apres->lon, $point_apres->x, $point_apres->y,
    $point_apres->places_pas_utile, $point_apres->places_matelas_pas_utile);

  // Certaines valeurs ne sont pas identiques dans la base et sans le formulaire
  if (isset($point_avant))
    foreach ($point_avant as $propriete => $valeur)
    {
      if ($valeur === null) $point_avant->$propriete = 'ne_sait_pas';
      if ($valeur === true) $point_avant->$propriete = 'TRUE';
      if ($valeur === false) $point_avant->$propriete = 'FALSE';
    }

  if (isset($point_apres))
  {
    // le point après modification existe, on stockera d'utile que les propriété
    // qui ont été passée par le formulaire (moins lourd)
    foreach ($point_apres as $propriete => $valeur)
    {
      if (isset($point_avant->$propriete))
      {
        $point_avant_simple->$propriete=$point_avant->$propriete;

        if ($valeur != $point_avant->$propriete) // On ne reporte que ce qui est modifié
          $point_apres_simple->$propriete=$valeur;
      }

      // Pour les polygones, on stocke le geom sous sa forme numérique
      $point_avant_simple->geom=$point_avant->geom ?? Null;
    }
  }
  else
  {
    foreach ($point_avant as $propriete => $valeur)
      // en cas de suppression, la liste des polygones auquel appartenait le point
      // ne nous intéresse pas tant que ça, lourd à l'écran !
      if ($propriete!='polygones')
        $point_avant_simple->$propriete=$point_avant->$propriete;
  }

  $id_point_modifie = $point_avant->id_point ?? $point_avant->id_polygone ??
    $point_apres->id_point ?? $point_apres->id_polygone ?? 0;

  $query_log_modification="insert into historique_modifications_points
  (id_point,id_user,date_modification,avant,apres,type_modification)
  values
  ($id_point_modifie,
  $user_id_faisant_la_modif,
  NOW(),
  ".$pdo->quote(serialize($point_avant_simple)).",
  ".$pdo->quote(serialize($point_apres_simple)).",
  '$type_operation')";

  if (!$pdo->exec($query_log_modification))
      return erreur("Requête en erreur, impossible d'historiser la modification",$query_log_modification);
}
