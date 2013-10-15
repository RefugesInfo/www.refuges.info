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
  $query="select * from phpbb_users where user_id=".$id_utilisateur;
  $res=$pdo->query($query);
  $utilisateur=$res->fetch();
  if (!$utilisateur)
    return erreur("Utilisateur inexistant",$query);
  else
    return $utilisateur;
}

?>