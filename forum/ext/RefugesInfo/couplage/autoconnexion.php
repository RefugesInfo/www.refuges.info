<?php
/***
Cette fonction a pour rôle "d'auto-connecter" les utilisateurs s'ils ont un cookie phpbb sur le reste du site wri
elle est donc lancé sur chaque page qui pourrait nécessiter d'être connecté
***/
function auto_login_phpbb_users()
{
  global $user, $auth; // Contexte phpBB

  // On remet tout à 0
  unset($_SESSION['id_utilisateur']);
  unset($_SESSION['login_utilisateur']);
  unset($_SESSION['niveau_moderation']);
  unset($_SESSION['phpbb_sid']);

  if ($user->data['user_id'] <= ANONYMOUS)
    return false;

  /* on rempli notre session */
  // Les références de l'utilisateur
  $_SESSION['id_utilisateur'] = $user->data['user_id'];
  $_SESSION['login_utilisateur']= $user->data['username'];

  // Le niveau d'autorisation
  // Teste si l'utilisateur est dans le groupe "modérateurs globaux"
  $_SESSION['niveau_moderation'] = $auth->acl_get('m_');

  // On retrouve l'identifiant de session pour le passer en paramètre _GET lors des déconnexion hors forum
  // Utilisé exclusivement dans /vues/_bandeau.html
  $_SESSION['phpbb_sid'] = $user->data['session_id'];

  return true;
}

