<?php
/*******************************************************************************************************
fonctions de gestion de l'autoconnexion des utilisateurs permettant de coupler le forum et le site
Fichier à inclure si besoin d'auto-loger sur une page
comme une session est démarrée, c'est à faire avant tout affichage

Afin de simplifier grandement la gestion des utilisateurs
Il n'y a plus de table moderateur, le niveau de moderation
est récupéré avec la fonction d'autorisatin de PhpBB
Ensuite sont stocké dans la session ( accessible par toutes les pages ):
$_SESSION['login_utilisateur']
$_SESSION['id_utilisateur'] ( celui de la table phpbb_users )
$_SESSION['niveau_moderation'] ayant pour signification
Il n'y a que 2 niveaux dans WRI aujourd'hui : 0 = rien, >= 1 = tout

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
require_once ("bdd.php");
require_once ("gestion_erreur.php");
require_once ("commentaire.php");
require_once ("forum.php");

/***
    fonction de reconnaissance d'un utilisateur déjà connecté sur le forum, on lui épargne le double login
    On peut être connecté à phpBB de deux façon :
    1) avec leur système interne de session ( Ils-n'auraient pas pu faire comme tout le monde chez phpBB ?? )
    2) avec le cookie permanent
***/

/***
Cette fonction a pour rôle "d'auto-connecter" les utilisateurs s'ils ont un cookie phpbb sur le reste du site wri
elle est donc lancé sur chaque page qui pourrait nécessiter d'être connecté
***/
function auto_login_phpbb_users()
{
  global $user, $auth; // Contexte PhpBB


  unset($_SESSION['id_utilisateur']);
  unset($_SESSION['login_utilisateur']);
  unset($_SESSION['niveau_moderation']);
  unset($_SESSION['phpbb_sid']);

  if ($user->data['user_id'] <= ANONYMOUS)
    return false;

  /* on rempli notre session */
  // Les références de l'utilisateur
  $_SESSION['id_utilisateur'] = $user->data['user_id'];
  $_SESSION['login_utilisateur']= $user->data['username'];

  // Le niveau d'autorisation
  // m_warn est la seule autorisation moderateur ne dépendant pas d'un forum particulier
  $_SESSION['niveau_moderation'] = $auth->acl_get('m_warn');

  // On retrouve l'identifiant de session pour le passer en paramètre _GET lors des déconnexion hors forum
  // Utilisé exclusivement dans /vues/_bandeau.html
  $_SESSION['phpbb_sid'] = $user->data['session_id'];

  return true;
}

// Fonction qui va permettre ensuite d'afficher la "petite étoile :*" en haut à coté du nom du modérateur
// Pour le prévenir si un commentaire est en attente avec une demande de correction
// FIXME : cette fonction n'a rien à faire dans autoconnexion.php
function info_demande_correction ()
{
    $conditions_attente_correction = new stdclass;
    $conditions_attente_correction->demande_correction=True;
    $conditions_attente_correction->avec_points_en_attente=True;
    $commentaires_attente_correction=infos_commentaires($conditions_attente_correction);
    if (count($commentaires_attente_correction)>0)
        return true;
    else
        return false;
}
// FIXME : pas mieux que info_demande_correction tout ça est lié au bandeau et devrait filer dans un autre fichier
function remplissage_zones_bandeau()
{
    global $config_wri;
    // Ajoute les liens vers les autres zones
    $conditions = new stdClass;
    $conditions->ids_polygone_type=$config_wri['id_zone'];
    $zones=infos_polygones($conditions);
    if ($zones)
        foreach ($zones as $zone)
            $array_zones [ucfirst($zone->nom_polygone)] = lien_polygone($zone)."?mode_affichage=zone";
    return $array_zones;
}
?>
