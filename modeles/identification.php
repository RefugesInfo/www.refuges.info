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

  if (!isset ($infos_identification)) // On ne rapelle pas SQL à chaque fois !
  {
    // le cookie porte un nom variable selon la config phpBB et on n'a pas choisi le standard ! Donc, je vais le chercher dans la table phpbb3_config
    $sql_cookie = "SELECT config_value as cookie_name from phpbb3_config where config_name='cookie_name'";
    $res_cookie = $pdo->query($sql_cookie);
    $config_phpbb = $res_cookie->fetch();

    // Il nous faut un cookie et un user id !=1 (anonyme) pour authentifier nos users, sinon on peut retourner NULL car il n'est pas connecté et n'a donc aucun droit spécial
    if (!empty($_COOKIE) and isset ($_COOKIE[$config_phpbb->cookie_name.'_u']) and $_COOKIE[$config_phpbb->cookie_name.'_u']!=1 ) 
    {
      $sql = "SELECT user_id, username, group_id
        FROM phpbb3_sessions_keys
        JOIN phpbb3_users USING (user_id)
        WHERE key_id = '".md5($_COOKIE['phpbb3_wri_k'])."'";
      $res = $pdo->query($sql);
      $infos_identification = $res->fetch();
      if (empty($infos_identification)) // Visiblement, la session a expirée car on a bien le cookie, le sid mais la table ne la contient plus
        return NULL;

      $infos_identification->niveau_moderation =
      $infos_identification->group_id == 201 ||
      $infos_identification->group_id == 202
        ? 1 : 0;
    }
    else
      return NULL;
  }
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
