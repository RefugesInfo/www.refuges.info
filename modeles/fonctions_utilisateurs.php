
<?php
/**********************************************************************************************
Ensemble des fonctions permettant des manipulations des utilisateurs du forum, qui sont
aussi des utilisateurs du site
**********************************************************************************************/

require_once ("fonctions_bdd.php");
require_once ("fonctions_gestion_erreurs.php");

function infos_utilisateur($user_id)
{
 $query="select * from phpbb_users where user_id=".$user_id;
 $res=mysql_query($query);
 if (mysql_num_rows($res)!=1)
   return erreur("Utilisateur inexistant");
 else
 {
   $utilisateur=mysql_fetch_object($res);
   return $utilisateur;
 }
  
}

?>