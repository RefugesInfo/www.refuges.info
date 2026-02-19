<?php
/***
Récupère l'environnement du forum pour les actions qui en ont besoin (uniquement en traitement des actions)
***/

// Initialise comme une page forum
// Cette séquence ne peut pas être dans une function
if (!defined('IN_PHPBB')) // Sauf dans le forum
{
  define('IN_PHPBB', true);
  $phpbb_root_path = $config_wri['rep_forum'];
  $phpEx = substr(strrchr(__FILE__, '.'), 1);
  include($phpbb_root_path . 'common.' . $phpEx);
  $user->session_begin();
  $user->setup();
  $auth->acl($user->data);

  // On restitue le contexte et les options WRI qui a été écrasé par le framework du forum
  restore_error_handler(); // phpBB a défini lui même sa fonction pour gérer les erreurs

  // Pour avoir accés aux variables globales $_SERVER, ...
  $request->enable_super_globals();

  // Infos utilisateur
  $infos_identification = new stdClass;
  $infos_identification->user_id = $user->data['user_id'];
  $infos_identification->username = $user->data['username'];
  $infos_identification->session_id = $user->data['session_id'];

  // Tokens du formulaire de login
  // Nécessite : GENERAL -> CONFIGURATION DU SERVEUR -> Paramètres de sécurité
  // -> Lier les formulaires aux sessions des invités : Non
  if (!est_connecte()) {
    $infos_identification->creation_time = time();
    $infos_identification->login_form_token = sha1(
      $infos_identification->creation_time .
      $user->data['user_form_salt'] .
      'login');
  }
}

function est_connecte()
{
  global $user;
  if (!empty($user->data['user_id']))
    return $user->data['user_id'] > 1;
}
/* retourne true si l'utilisateur identifié dispose d'au moins une permission de modération dans le forum phpBB.
 * Attention: l'utilisateur peut disposer de cette permission de plusieures manière :
 * - S'il est dans le groupe modérateur globaux, il dispose alors automatiquement de toutes les permissions que lui confère le groupe
 * - s'il est dans le groupe administrateur
 * - Ou si l'utilisateur dispose spécifiquement, dans "permissions avancées", d'au moins une de modération
 */
function est_moderateur()
{
  global $auth;
  return $auth->acl_get('m_');
}

/* retourne true si l'utilisateur identifié dispose d'au moins une permission d'administration.
 * Attention: l'utilisateur peut disposer de cette permission de plusieures manière :
 * - s'il est dans le groupe administrateur
 * - Ou si l'utilisateur dispose spécifiquement, dans "permissions avancées", d'au moins une d'administration
 */
function est_administrateur()
{
  global $auth;
  return $auth->acl_get('a_');
}

function est_autorise($id_utilisateur)
{
  global $user;
  if (est_connecte())
    return est_moderateur() || $user->data['user_id'] == $id_utilisateur;
  return false;
}
