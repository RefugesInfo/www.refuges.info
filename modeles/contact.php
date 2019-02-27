<?php
// Fonction qui permet à la page contact d'accéder à la base

require_once ("bdd.php");

function liste_forums_refuges ($cherche_refuge, $numero_forum, $nbmax)
{
  global $config_wri,$pdo;

  $sql = "SELECT * FROM phpbb3_topics WHERE forum_id = $numero_forum AND topic_title ILIKE '%$cherche_refuge%' LIMIT $nbmax";
  if ( ! ($res = $pdo->query($sql)))
    return erreur("Une erreur sur la requête est survenue",$sql);

  while ($row = $res->fetch())
    $refuges[] = $row;

  return $refuges;
}
?>
