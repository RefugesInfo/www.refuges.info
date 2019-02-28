<?php
// Fonction qui permet à la page contact d'accéder à la base

require_once ("bdd.php");

function liste_points ($cherche_point, $nbmax)
{
  global $config_wri,$pdo;

  $sql = "SELECT * FROM points WHERE nom ILIKE '%$cherche_point%' LIMIT $nbmax";
  if ( ! ($res = $pdo->query($sql)))
    return erreur("Une erreur sur la requête est survenue",$sql);

  while ($row = $res->fetch())
    $points[] = $row;

  return $points;
}
?>
