<?php
/*
 * Affichage du bandeau de toutes les pages du site
 * Pour le forum, c'est traité dans l'extension PhpBB
*/

require_once ('identification.php');
require_once ("wiki.php");

if (est_moderateur())
{
  // Affiche la "petite étoile :☆" en haut à coté du nom du modérateur
  // pour le prévenir si un commentaire est en attente avec une demande de correction
  $conditions_attente_correction = new stdclass;
  $conditions_attente_correction->demande_correction=True;
  $conditions_attente_correction->avec_points_caches=True;
  $commentaires_attente_correction=infos_commentaires($conditions_attente_correction);

  if (count($commentaires_attente_correction)>0)
    $vue->demande_correction=true;
  else
    $vue->demande_correction=false;

  // Affiche la "petite lune : 🌙" en haut à coté du nom du modérateur
  // pour le prévenir si un email envoyé par le forum est resté bloqué
  $query_emails_erreur="select * from emails_bounce where a_traiter='t' LIMIT 1";

  if (! ($res = $pdo->query($query_emails_erreur)))
    $vue->email_en_erreur=false; // Pas une erreur gràve, on échoue silencieusement
  else
    $vue->email_en_erreur=count($res->fetchAll())!==0;

  // Affiche un symbole en haut à coté du lien des édition de posts par utilisateur
  // Hook ext/RefugesInfo/trace/listener.php
  $posts_edit = null;
  $vars = [
    'posts_edit',
  ];
  extract($phpbb_dispatcher->trigger_event('refugesinfo.trace_status', compact($vars)));
  $vue->posts_edit = $posts_edit;
}

// Date de dernière modification de point ou polygones pour reload des couches (sauf commentaires)
$query_date_modification_feature="
  SELECT extract(epoch from date_modification)
  FROM historique_modifications_points
  ORDER BY date_modification DESC
  LIMIT 1";

$vue->version_features=intval(time());
if ($res = $pdo->query($query_date_modification_feature))
  if($fetch = $res->fetch())
    $vue->version_features = intval($fetch->extract ?? time());

// Bandeau d'informations masquable
$vue->bandeau_info=wiki_page_brut('bandeau'); // Attention, wiki_page_brut récupère aussi l'info ->date !
$vue->bandeau_info->contenu = wiki_page_html('bandeau');
// Le bandeau n'est affiché que si la page wiki "bandeau" contient quelque chose
// (ignore les [c]commentaires[/c], les balises vides et la page inexistante)
$vue->bandeau_info->actif =
  empty($vue->bandeau_info->erreur) &&
  // &nbsp; (doubles espaces convertis par bbcode2html) et retours ligne ne comptent pas
  preg_replace(
    '/[\s\x{00A0}]+/u', '',
    html_entity_decode(strip_tags($vue->bandeau_info->contenu, '<img>'))
  ) !== '';
$vue->bandeau_info->cookie=$_COOKIE['bandeau_info'] ?? '';
$vue->bandeau_info->new_cookie_expire=
  gmdate('r', time() + 24 * 3600 * (
    $infos_identification->user_id > 1 ? 31 : 7 // Nombre de jours masqués
  ));
