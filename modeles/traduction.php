<?php
/**********************************************************************************************
Fonctions sur la table traductions (traductions automatiques des contenus : fiches, commentaires, pages du wiki)
Une traduction est liée à sa source par (type_objet, id_objet, cle_objet) ; il n'y a pas de ON DELETE CASCADE,
c'est ici que la suppression d'une source emporte ses traductions.
**********************************************************************************************/

require_once ("bdd.php");

// Traduction d'un champ dans la langue de la page, seulement si elle correspond au texte source actuel $source
// (hash_source = md5 du texte au moment de la traduction) : sinon l'appelant garde l'original plutôt qu'une information périmée.
// Retourne la ligne (texte, langue_source) ou null ; une ligne à texte NULL (source déjà dans la langue) donne null.
// $cle : nom de la page pour le type 'wiki' (id_objet vaut alors 0)
function traduction_a_jour($type, $id, $champ, $source, $cle = '')
{
  global $pdo, $config_wri;
  $res = $pdo->query("SELECT texte,langue_source FROM traductions
    WHERE type_objet=".$pdo->quote($type)." AND id_objet=".(int)$id." AND cle_objet=".$pdo->quote($cle)."
    AND champ=".$pdo->quote($champ)." AND langue=".$pdo->quote($config_wri['langue_courante'])."
    AND texte IS NOT NULL AND hash_source=".$pdo->quote(md5((string)$source)));
  return $res->fetch() ?: null;
}

function traduction_a_jour_point($point, $champ)
{
  return traduction_a_jour('point', $point->id_point, $champ, $point->$champ ?? '');
}

function traduction_a_jour_commentaire($commentaire)
{
  return traduction_a_jour('commentaire', $commentaire->id_commentaire, 'texte', $commentaire->texte);
}

function traduction_a_jour_wiki($page, $contenu)
{
  return traduction_a_jour('wiki', 0, 'contenu', $contenu, $page);
}

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
