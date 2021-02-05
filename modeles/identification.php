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
require_once ("config.php");
require_once ("bdd.php");

function infos_identification()
{
  global $pdo, $infos_identification;

  if (!empty($_COOKIE) and isset ($_COOKIE['phpbb3_wri_u']) and $_COOKIE['phpbb3_wri_u']!=1 ) // Il nous faut un cookie pour authentifié nos users, et même si un cookie existe, si le user est défini comme 1 c'est qu'il s'agit d'un anonyme, le site n'a pas besoin de faire de stats sur lui et il n'aura pas plus de droits de toute façon
  {
    if (!isset ($infos_identification)) { // On ne rapelle pas SQL à chaque fois !
      $sql = "SELECT user_id, username, group_id
        FROM phpbb3_sessions
        JOIN phpbb3_users ON (phpbb3_users.user_id = phpbb3_sessions.session_user_id)
        WHERE session_id = '{$_COOKIE['phpbb3_wri_sid']}'";
      $res = $pdo->query($sql);
      $infos_identification = $res->fetch();

      $infos_identification->niveau_moderation =
      $infos_identification->group_id == 201 ||
      $infos_identification->group_id == 202
        ? 1 : 0;

      // Pour compatibilité (il y en a un paquet !)
      // TODO ??? remplacer l'utilisation de $_SESSION par l'appel à infos_identification()
      $_SESSION['id_utilisateur'] = $infos_identification->user_id;
      $_SESSION['login_utilisateur'] = $infos_identification->username;
      $_SESSION['niveau_moderation'] = $infos_identification->niveau_moderation;
      $_SESSION['phpbb_sid'] = $_COOKIE['phpbb3_wri_sid'];
    }

    return $infos_identification;
  }
    return NULL;
}

function est_moderateur()
{
  $infos_identification = infos_identification();
  if (isset($infos_identification))
    return $infos_identification->niveau_moderation >= 1;
}

function est_autorise($id_utilisateur)
{
  $infos_identification = infos_identification();
  if (isset($infos_identification))
    return $infos_identification->niveau_moderation >= 1 ||
    $infos_identification->user_id == $id_utilisateur;
}
// L'utilisateur est connecté, et n'est pas anonyme
function est_connecte()
{
  $infos_identification = infos_identification();
  if (isset($infos_identification))
    return $infos_identification->user_id !== 1 ;
}
