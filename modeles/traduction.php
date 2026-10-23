<?php
/**********************************************************************************************
Fonctions sur la table traductions (traductions automatiques des contenus : fiches, commentaires, pages du wiki)
Une traduction est liée à sa source par (type_objet, id_objet, cle_objet) ; il n'y a pas de ON DELETE CASCADE,
c'est ici que la suppression d'une source emporte ses traductions.
**********************************************************************************************/

require_once ("bdd.php");

// Supprime toutes les traductions (toutes langues) d'un objet source.
// $type : 'point', 'commentaire', 'wiki' ou 'post_forum' ; $cle : nom de la page pour 'wiki' (id_objet vaut alors 0), vide sinon
function supprime_traductions($type, $id, $cle = '')
{
  global $pdo;
  if (!in_array($type, array('point', 'commentaire', 'wiki', 'post_forum'), true))
    return false;
  return $pdo->exec("DELETE FROM traductions WHERE type_objet=".$pdo->quote($type)
    ." AND id_objet=".(int)$id." AND cle_objet=".$pdo->quote($cle));
}

function supprime_traductions_point($point)
{
  return supprime_traductions('point', $point->id_point);
}

function supprime_traductions_commentaire($commentaire)
{
  return supprime_traductions('commentaire', $commentaire->id_commentaire);
}

function supprime_traductions_wiki($page)
{
  return supprime_traductions('wiki', 0, $page);
}
