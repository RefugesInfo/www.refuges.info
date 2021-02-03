<?php
/***
Cette fonction a pour rôle "d'auto-connecter" les utilisateurs s'ils ont un cookie phpbb sur le reste du site wri
elle est donc lancé sur chaque page qui pourrait nécessiter d'être connecté
***/
function auto_login_phpbb_users()
{
  global $pdo;
  
  // Détermination des infos de l'utilisateur connecté au forum
  $q = "SELECT user_id, username, group_id
    FROM phpbb3_sessions
    JOIN phpbb3_users ON (phpbb3_users.user_id = phpbb3_sessions.session_user_id)
    WHERE session_id = '{$_COOKIE['phpbb3_wri_sid']}'";
  $res = $pdo->query($q);
  $infos_connexion = $res->fetch();

  /* group_id
  198 Invités
  199 Utilisateurs enregistrés
  200 Utilisateurs COPPA enregistrés (- de 13 ans)
  201 Modérateurs globaux
  202 Administrateurs
  203 Robots
  204 Nouveaux utilisateurs enregistrés
  */

  if ($infos_connexion->user_id > 1) { // Sauf anonymous

    /* on rempli notre session */
    // Les références de l'utilisateur
    $_SESSION['id_utilisateur'] = $infos_connexion->user_id;
    $_SESSION['login_utilisateur'] = $infos_connexion->username;

    // Le niveau d'autorisation
    // Teste si l'utilisateur est dans le groupe "modérateurs globaux"
    $_SESSION['niveau_moderation'] =
      $infos_connexion->group_id == 201 ||
      $infos_connexion->group_id == 202
        ? 1 : 0;

    // On retrouve l'identifiant de session pour le passer en paramètre _GET lors des déconnexion hors forum
    // Utilisé exclusivement dans /vues/_bandeau.html
    $_SESSION['phpbb_sid'] = $_COOKIE['phpbb3_wri_sid'];
  }

  return true;
}
