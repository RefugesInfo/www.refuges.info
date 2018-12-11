<?php
/**********************************************************************************************
Ensemble des fonctions permettant des manipulations des utilisateurs du forum, qui sont
aussi des utilisateurs du site
**********************************************************************************************/

require_once ("bdd.php");
require_once ("gestion_erreur.php");

function infos_utilisateur($id_utilisateur)
{
  global $pdo;
  $query="SELECT * FROM phpbb3_users WHERE user_id=".$id_utilisateur;
  $res=$pdo->query($query);
  $utilisateur=$res->fetch();
  // phpBB intègre un nom d'utilisateur dans sa base après avoir passé un htmlentities, pour les users connectés
  if (!$utilisateur)
    return erreur("Utilisateur inexistant",$query);
  else {
    $utilisateur->username=html_entity_decode($utilisateur->username);
    $utilisateur->username=html_entity_decode($utilisateur->username);
    return $utilisateur;
  }
}
/**
On génére une url vers la fiche d'un utilisateur (en fait, sont profil sur le forum
si local est False un lien absolu sera généré
**/
function lien_utilisateur($utilisateur,$local=True)
{
  global $config_wri;
  if (isset($_SERVER['HTTP']))
      $schema="http";
  else
      $schema="https";
  
  if ($local)
    $url_complete="";
  else
    $url_complete="$schema://".$config_wri['nom_hote'];
  return $url_complete.$config_wri['fiche_utilisateur'].$utilisateur->user_id;
}
/**
Pour obtenir la liste des utilisateurs phpBB avec leur id, dans un tableau
**/
function infos_utilisateurs()
{
  global $config_wri;
  global $pdo;
  // 2 on dirait que c'est les faux users de phpbb (bots, anonymous, spiders)
  $query="SELECT * FROM phpbb3_users where user_type!=2 order by username";
  $res=$pdo->query($query);
  while ($utilisateur = $res->fetch())
    $utilisateurs[]=$utilisateur;
  return $utilisateurs;
}
?>
