<?php
/*******************************************************************************************************
fonctions de gestion de l'autoconnexion des utilisateurs permettant de coupler le forum et le site
Fichier à inclure si besoin d'auto-loger sur une page
comme une session est démarrée, c'est à faire avant tout affichage

Afin de simplifier grandement la gestion des utilisateurs
Il n'y a plus de table moderateur, le niveau de moderation
d'un utilisateur est récupérée dans la table phpbb_users
Ensuite sont stocké dans la session ( accessible par toutes
les pages ):
$_SESSION['login_utilisateur']
$_SESSION['password_utilisateur'] (en md5 )
$_SESSION['id_utilisateur'] ( celui de la table phpbb_users )
$_SESSION['niveau_moderation'] ayant pour signification
0 = utilisateur normal
1 = modérateur général du site
2 = programmeur du site
3 = administrateur du site

REMARQUE :
En lisant ce code vous allez vous dire qu'il est dommage
d'inclure si souvent dans les pages, la raison est qu'il
faut vérifier à chaque fois que l'utilisateur ne s'est pas
déconnecté du forum.
l'idéal serait sûrement de vider la session au niveau du forum

29/08/2007 sly création initiale gestion de la connexion par cookie permanent
03/09/2007 sly gestion du cas de la connexion temporaire par session phpBB
14/09/2007 sly remplissage plus logique et plus complet de la session
15/02/13 jmb : PDO migration , petite etoile mise en commentaire ? g pas compris
*********************************************************************************************/

require_once ("config.php");
require_once ("fonctions_bdd.php");

			
/*** 
	fonction de reconnaissance d'un utilisateur déjà connecté sur le forum, on lui épargne le double login 
	On peut être connecté à phpBB de deux façon :
	1) avec leur système interne de session ( Ils-n'auraient pas pu faire comme tout le monde chez phpBB ?? )
	2) avec le cookie permanent
***/
// on vide les traces qu'on a sur l'utilisateur
function vider_session()
{
  foreach (array('login_utilisateur','password_utilisateur','id_utilisateur','niveau_moderation') as $variable)
  {
    if (isset($_SESSION[$variable]))
      unset($_SESSION[$variable]);
  }
}

/*** 
Cette fonction a pour rôle "d'auto-connecter" les utilisateurs s'ils ont un cookie phpbb sur le reste du site wri
elle est donc lancé sur chaque page qui pourrait nécessiter d'être connecté
***/
function auto_login_phpbb_users()
{
  global $pdo;
  // etape 1) vérifions si la session est correct
  // je suis sûr qu'au niveau sécurité c'est pas top, mais franchement, qui irait pirater le compte d'un utilisateur du forum ?
  if (isset($_COOKIE['phpbb2mysql_sid']))
  {
    $query_connexion_temporaire="SELECT * FROM phpbb_sessions WHERE session_id='".$_COOKIE['phpbb2mysql_sid']."'";
    $res = $pdo->query($query_connexion_temporaire) ;
    if ( $user = $res->fetch() )
    {
      $authentifie=TRUE;
      $user_id=$user->session_user_id;
    }
    else
      $authentifie=FALSE;
  }
  if (!$authentifie AND isset($_COOKIE['phpbb2mysql_data']))
  {
    
    // Etape 2) si c'est une connexion de type permanente avec le cookie phpbb2mysql_data, on vérifie que c'est bien lui
    $phpbb_user_data=unserialize(stripslashes($_COOKIE['phpbb2mysql_data']));
    if (!isset($phpbb_user_data['autologinid']) OR !isset($phpbb_user_data['userid']) )
      $authentifie=FALSE;
    else
    {
      //pas de num row en PDO ..... relou .. celle la renvoie 0 ou 1
      $query_verif="SELECT COUNT(*) AS auth FROM phpbb_users WHERE user_id=".$phpbb_user_data['userid']." AND user_password=\"".$phpbb_user_data['autologinid']."\"";
      $res = $pdo->query($query_verif);
      $r = $res->fetch();
      if (  $r->auth == 0 )
	$authentifie=FALSE;
      else
      {$user_id=$phpbb_user_data['userid'];$authentifie=TRUE;}
    }
  }
  if (!$authentifie OR ($user_id==-1) )
    // cet utilisateur n'est pas ou plus connu du forum phpBB ou alors connecté en anonyme sur le forum
    {
      vider_session();
      return FALSE;
    }
    // allons chercher les infos de cet utilisateur
    $query_infos="SELECT * FROM phpbb_users where user_id=$user_id";
  
  $res = $pdo->query($query_infos);
  // ça ne devrait pas être possible puisqu'on à réussi à l'identifier, mais dans le doute
  if ( ! $user = $res->fetch() )
  {
    vider_session();
    return FALSE;
  }
  
  /* on rempli notre session */
  
  $_SESSION['password_utilisateur']=$user->user_password;
  $_SESSION['login_utilisateur']=$user->username;
  $_SESSION['id_utilisateur']=$user->user_id;
  
  
  /* Attention, Fusion des droit forum avec droit du site
  Sauf que phpBB n'utilise pas une classification ordonnée, alors que la gestion se sert de ce fait car un admin 
  a plus de droits qu'un modérateur qui a plus de droit qu'un utilisateur normal
  chez phpBB :
  0 = rien
  1 = admin
  2 = modérateur
  chez nous :
  0 = rien
  1 = modérateur
  2 = programmeur
  3 = admin
  */
  switch ($user->user_level)
  {
    case 0:$_SESSION['niveau_moderation']=0;break;
    case 1:$_SESSION['niveau_moderation']=3;break;
    case 2:$_SESSION['niveau_moderation']=1;break;
    // programmeur ça n'existe plus pour l'instant
  }
  return TRUE;
}

// Fonction qui va permettre ensuite d'afficher la "petite étoile :*" en haut à coté du nom du modérateur
// Pour le prévenir si un commentaire est en attente avec une demande de correction
// FIXME : cette fonction n'a rien à faire dans fonctions_autoconnexion.php
function info_demande_correction () 
{
  global $pdo;
  // ici se trouve une petite alerte marquée par une étoile indiquant que dans le menu gestion y'a du boulot pour les modérateurs
  // à regrouper à l'occassion dans une jolie fonction qui récapitule les différents besoin de modération sly 24/03/2008
  $query="SELECT * FROM commentaires
  WHERE (demande_correction!=0) OR (qualite_supposee<0) LIMIT 1";
  $res = $pdo->query($query);
  if ( $r = $res->fetch() ) 
  return true;    // le fetch est possible, donc ya des trucs
  else
    return false;
}

auto_login_phpbb_users();

?>
