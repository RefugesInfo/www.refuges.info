<?php 
/*******************************************************************************
Ceci est le fichier des routes principales, il s'ocupe de faire correspondre 
une route (qui correspond à une forume d'url) vers un controlleur.

exemple : http://www.refuges.info/point/X/Y/Z => le controlleur point.php
  
Il s'occupe alors d'analyser l'url pour en déterminer ce qui doit être fait, appeler les controlleurs
selon cette url puis ouvrir les vues, toujours selon cet url.
*******************************************************************************/

// Analyse de l'url (basique pour l'instant pourrait être étendu ultérieurement selon les besoins)
$controlleur = new stdClass;
$vue = new stdClass;

// On garde dans $controlleur l'url complète d'appel, certains controlleurs peuvent en avoir besoin
$controlleur->url_complete=$_SERVER['REQUEST_URI'];
$sans_parametres=explode ('?',$controlleur->url_complete);

// Uniquement /point/5/toto/sfsdf (pas les ?toto=coucou...) et pas le sous dossier dans lequel wri pourrait être installé
$controlleur->url_base=str_replace('RACINE'.$config_wri['sous_dossier_installation'],'','RACINE'.$sans_parametres[0]);
//DOM ajout de RACINE évite d'enlever tous les / quand sous_dossier_installation = /
$controlleur->url_decoupee = explode ('/',$controlleur->url_base);

// Par défaut, on veut un en-tête et pied de page html, => $vue->type.html sera affiché avec ce qui va bien autour
// mais dans de rare cas (point-json) on ne veut pas => On remplacera $vue->template par le fichier tout seul
$vue->template='_page.html';

// On pourrait être tenté de faire une conversion direct de url vers controlleur, mais si un filou commence à indiquer
// n'importe quelle url, il pourrait réussir à ouvrir des trucs pas souhaités, avec une liste, on s'assure
// de n'autoriser que ceux que l'on a

// API : cas specifique, léger : car les routes de l'api ne fonctionnent pas tout à fait comme les autres, il faudrait pouvoir uniformiser et pour ça, être plus flexible sur la gestion routes + controlleurs + vues
// et en plus je réduis l'include de fichiers inutiles à l'API
if ($controlleur->url_decoupee[0]=="api")
{
  require_once ("api.routes.php");
  exit(0);
}

// PHPBB : Gain de performance donc de temps de réponse, si aucun cookie n'existe, inutile d'essayer de connecter et de charger le framework phpBB qui mange ~80ms
//if (!empty($_COOKIE)) // en cours de test par sylvain
{
  // Et même si un cookie existe, si le user est défini comme 1 c'est qu'il s'agit d'un anonyme, le site n'a pas besoin de faire de stats sur lui et il n'aura pas plus de droits de toute façon
  //if ( isset ($_COOKIE['phpbb3_wri_u']) and $_COOKIE['phpbb3_wri_u']!=1 )
  {
    // Include général pour les pages du site vues par des humains (pas comme l'api ou similaires)
    require_once ('autoconnexion.php');
    auto_login_phpbb_users();
  }
}
 
// Toutes page du site ayant le menu bandeau, donc comme ce menu a besoin au moins de ça :
require_once ('wiki.php');
require_once ('authentification.php');
require_once ('bandeau_dynamique.php');

switch ($controlleur->url_decoupee[0])
{
    // sly: Pour toutes ces routes, on est dans un cas simple, l'url correspond au controlleur du même nom, factorisation !
    case "point" :
    case "nav" :
    case "edit" :
    case "wiki" :
    case "nouvelles" :
    case "point_ajout_commentaire" :
    case "point_recherche" :
    case "avis_internaute_commentaire" :
    case "formulaire_exportations" :
    case "point_formulaire_recherche" :
    case "formulaire_rss" :
    case "point_formulaire_modification" :
    case "point_modification" :
    case "test" :
    case "point_ajout" :
        $controlleur->type=$controlleur->url_decoupee[0];
        break;
    case "" : // c'est la home page "/"
        $controlleur->type="index";
        break;
    case "gestion" :
        require_once ("gestion.routes.php");
        break;
    default : 
        $vue->http_status_code = 404;
        $controlleur->type = 'page_simple';
    break;
}

// Petite factorisation, dans la majorité des cas, la vue porte le nom du controlleur + .html ... mais pas toujours
if (!isset($vue->type))
    $vue->type=$controlleur->type;

// On appel le controlleur qui pourra, s'il le souhaite, changer le type de vue ($type->vue)
include ($config_wri['chemin_controlleurs'].$controlleur->type.".php");

// et vérification s'il n'y a pas un commentaire à modérer pour notre équipe de modération
// FIXME : Dans une logique de rangement parfait, ça ne devrait pas être ici, mais dans chaque contrôleur qui a besoin de modifier le bandeau avec l'étoile, mais la factorisation a eu raison de moi ;-)
// Si quelqu'un veut le bouger, il a mon feu vert -- sly
if (isset ($_SESSION['niveau_moderation']) and $_SESSION['niveau_moderation']>=1)
	$vue->demande_correction=info_demande_correction ();

$vue->zones_pour_bandeau=remplissage_zones_bandeau();
$vue->lien_wiki=prepare_lien_wiki_du_bandeau();

include ($config_wri['chemin_vues'].$vue->template);
