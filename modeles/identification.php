<?php
/***
Fonctions d'état de connexion et de droit des utilisateurs.

Elle retourne :
  $r->user_id = 216

  $r->username = 'Mon nom'

  $r->group_id
    198 Invités
    199 Utilisateurs enregistrés
    200 Utilisateurs COPPA enregistrés (- de 13 ans)
    201 Modérateurs globaux
    202 Administrateurs
    203 Robots
    204 Nouveaux utilisateurs enregistrés

  $r->niveau_moderation
  Il n'y a que 2 niveaux dans WRI aujourd'hui 01/02/2021: 0 = rien, >= 1 = tout

***/
require_once ("bdd.php");

function infos_identification()
{
  global $pdo, $infos_identification, $config_wri;

  // On ne rapelle pas SQL à chaque fois !
  if (isset ($infos_identification))
    return $infos_identification;

  // le cookie porte un nom variable selon la config phpBB et on n'a pas choisi le standard ! Donc, je vais le chercher dans la table phpbb3_config
  $sql_cookie = "SELECT config_value as cookie_name from phpbb3_config where config_name='cookie_name'";
  $res_cookie = $pdo->query($sql_cookie);
  $config_phpbb = $res_cookie->fetch();

  // Cas où on n'est pas connecté
  if (empty($_COOKIE) || // Pas de cookies du tout
  !isset ($_COOKIE[$config_phpbb->cookie_name.'_u']) || // Pas de cookie de connexion
  $_COOKIE[$config_phpbb->cookie_name.'_u']==1 ) // Anonymous
    return NULL;

  // Cas de la connexion permanente (se souvenir de moi)
  if ($_COOKIE[$config_phpbb->cookie_name.'_k'])
    $sql = "SELECT user_id, username, group_id
      FROM phpbb3_sessions_keys
      JOIN phpbb3_users USING (user_id)
      WHERE key_id = '".md5($_COOKIE[$config_phpbb->cookie_name.'_k'])."'";

  // Cas de la connexion limitée à l'ouverture de l'explorateur
  // ou à la durée de la session définie dans les paramètres du forum
  else
    $sql = "SELECT user_id, username, group_id, session_id
      FROM phpbb3_sessions
      JOIN phpbb3_users ON (phpbb3_users.user_id = phpbb3_sessions.session_user_id)
      WHERE session_id = '{$_COOKIE['phpbb3_wri_sid']}'";

  $res = $pdo->query($sql);
  $infos_identification = $res->fetch();

  // La session a expirée car on a bien le cookie, le sid mais la table ne la contient plus
  if (empty($infos_identification))
    return NULL;

  $infos_identification->session_id = $_COOKIE[$config_phpbb->cookie_name.'_sid'];
  $infos_identification->niveau_moderation =
    $infos_identification->group_id == 201 ||
    $infos_identification->group_id == 202
      ? 1 : 0;

  return $infos_identification;
}

function est_moderateur()
{
  global $infos_identification;
  if (isset($infos_identification))
    return $infos_identification->niveau_moderation >= 1;
}

function est_autorise($id_utilisateur)
{
  global $infos_identification;
  if (isset($infos_identification))
    return $infos_identification->niveau_moderation >= 1 ||
    $infos_identification->user_id == $id_utilisateur;
}
// L'utilisateur est connecté, et n'est pas anonyme
function est_connecte()
{
  global $infos_identification;
  if (isset($infos_identification))
    return $infos_identification->user_id !== 1 ;
}
