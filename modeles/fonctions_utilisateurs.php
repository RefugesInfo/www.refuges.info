
<?php
/**********************************************************************************************
Ensemble des fonctions permettant des manipulations des utilisateurs du forum, qui sont
aussi des utilisateurs du site
**********************************************************************************************/

require_once ("fonctions_bdd.php");
require_once ("fonctions_gestion_erreurs.php");

function infos_utilisateur($user_id)
{
  global $pdo;
 $query="select * from phpbb_users where user_id=".$user_id;
 $res=$pdo->query($query);
 if (!$res->fetch())
   return erreur("Utilisateur inexistant");
 else
 {
   $utilisateur=$polygones_du_points = $res->fetch();
   return $utilisateur;
 }
  
}

?>