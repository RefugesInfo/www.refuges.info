<?php
/***
Fonctions d'état de connexion et de droit des utilisateurs.

Elle retourne :
  $infos_identification->user_id = 216

  $infos_identification->username = 'Mon nom'

  $infos_identification->group_id
    198 Invités
    199 Utilisateurs enregistrés
    200 Utilisateurs COPPA enregistrés (- de 13 ans)
    201 Modérateurs globaux
    202 Administrateurs
    203 Robots
    204 Nouveaux utilisateurs enregistrés

  $infos_identification->niveau_moderation
  Il n'y a que 2 niveaux dans WRI aujourd'hui 01/02/2021: 0 = rien, >= 1 = tout
    Est niveau 1 un utilisateur qui est dans un des groupes 201 ou 202

  $infos_identification->creation_time
  $infos_identification->login_form_token
  2 infos importantes pour valider le formulaire de connexion

***/
require_once ("bdd.php");

function infos_identification()
{
  global $pdo, $infos_identification, $config_wri, $user, $auth;

  // On ne rapelle pas SQL à chaque fois !
  if (isset ($infos_identification))
    return $infos_identification;

  $infos_identification = false;
  $group_ids = [];

  // Pages du forum : la connexion au forum à déjà eu lieu quand on déroule cette fonction
  // Et l'objet PhpBB $user contient toutes les informations nécéssaires
  if (isset ($user)) {
    $infos_identification = new stdClass;
    $infos_identification->user_id = $user->data['user_id'];
    $infos_identification->username = $user->data['username'];
    $infos_identification->group_id = $user->data['group_id'];
    $infos_identification->user_form_salt = $user->data['user_form_salt'];
    $infos_identification->niveau_administration = $auth->acl_get('a_');
    $infos_identification->niveau_moderation = $auth->acl_get('m_');
  }

  // On n'est pas dans une page du forum, il faut faire la calcul nous même
  // On va chercher les valeurs de config dans la table phpbb3_config
  $sql = "SELECT config_name, config_value
    FROM phpbb3_config
    WHERE config_name IN ('cookie_name', 'session_length')";
  $res = $pdo->query($sql);
  while ($row = $res->fetch())
    $config_phpbb[$row->config_name] = $row->config_value;

  // On filtre le contenu des cookies pour éviter les injections
  // Le cookie porte un nom variable selon la config phpBB et on n'a pas choisi le standard !
  preg_match ('/[0-9a-z]*/', @$_COOKIE[$config_phpbb['cookie_name'].'_u'], $cookie_u);
  preg_match ('/[0-9a-z]*/', @$_COOKIE[$config_phpbb['cookie_name'].'_k'], $cookie_k);
  if (isset($_GET['sid']))
    $cookie_sid = [$_GET['sid']]; // Le sid peut être passé en argument de l'url !
  else
    preg_match ('/[0-9a-z]*/', @$_COOKIE[$config_phpbb['cookie_name'].'_sid'], $cookie_sid);

  // Cas de la connexion permanente (se souvenir de moi)
  if (!$infos_identification && $cookie_k[0] && $cookie_u[0] > 1) {
    $sql = "SELECT user_id, username, phpbb3_user_group.group_id, user_form_salt
      FROM phpbb3_sessions_keys
      JOIN phpbb3_users USING (user_id)
      JOIN phpbb3_user_group USING (user_id)
      WHERE user_id = '{$cookie_u[0]}' AND
        key_id = '".md5($cookie_k[0])."'";
    $res = $pdo->query($sql);
    if (!empty($res))
      while( $raw = $res->fetch() )
	  {
        $infos_identification = $raw;
        $group_ids[] = $raw->group_id;
      }
  }

  // Cas de la connexion limitée à l'ouverture de l'explorateur
  // ou à la durée de la session définie dans les paramètres du forum
  if (!$infos_identification && $cookie_sid[0] && $cookie_u[0] > 1) {
    $sql = "SELECT user_id, username, phpbb3_user_group.group_id, user_form_salt, session_time
      FROM phpbb3_sessions
      JOIN phpbb3_users ON (phpbb3_users.user_id = phpbb3_sessions.session_user_id)
      JOIN phpbb3_user_group USING (user_id)
      WHERE user_id = '{$cookie_u[0]}' AND
        session_ip = '{$_SERVER['REMOTE_ADDR']}' AND
        session_time >= ". (time() - $config_phpbb['session_length']) ." AND
        session_browser = '{$_SERVER['HTTP_USER_AGENT']}' AND
        session_id = '{$cookie_sid[0]}'";
    $res = $pdo->query($sql);
      while( $raw = $res->fetch() )
	  {
        $infos_identification = $raw;
        $group_ids[] = $raw->group_id;
      }
  }

  // Pas de cookies du tout ou
  // La session a expirée car on a bien le cookie, le sid mais la table ne la contient plus
  if (!$infos_identification) {
    $sql = "SELECT user_id, username, group_id, user_form_salt
      FROM phpbb3_users
      WHERE user_id = 1"; // On prend les infos de l'utilisateur UNKNOWN
    $res = $pdo->query($sql);
    $infos_identification = $res->fetch();
  }

  // Infos à calculer dans tous les cas, à partir des précédentes
  if ($group_ids) {
    $infos_identification->niveau_administration = empty(array_intersect($group_ids, [202])) ? 0 : 1;
    $infos_identification->niveau_moderation = empty(array_intersect($group_ids, [201,202])) ? 0 : 1;
  }

  // Tokens du formulaire de login
  // Nécessite : GENERAL -> CONFIGURATION DU SERVEUR -> Paramètres de sécurité
  // -> Lier les formulaires aux sessions des invités : Non
  $infos_identification->creation_time = time();
  $infos_identification->login_form_token = sha1(
    $infos_identification->creation_time .
    $infos_identification->user_form_salt .
    'login');

  return $infos_identification;
}

function est_administrateur()
{
  global $infos_identification;
  return $infos_identification->niveau_administration;
}

function est_moderateur()
{
  global $infos_identification;
  if (isset($infos_identification) && $infos_identification->user_id > 1)
    return $infos_identification->niveau_moderation >= 1;
}

function est_autorise($id_utilisateur)
{
  global $infos_identification;
  if (isset($infos_identification) && $infos_identification->user_id > 1)
    return $infos_identification->niveau_moderation >= 1 ||
    $infos_identification->user_id == $id_utilisateur;
}
// L'utilisateur est connecté, et n'est pas anonyme
function est_connecte()
{
  global $infos_identification;
  if (isset($infos_identification) && $infos_identification->user_id > 1)
    return $infos_identification->user_id !== 1 ;
}
