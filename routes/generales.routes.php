<?php 
/*******************************************************************************
Ceci est le fichier des routes principales, il s'ocupe de faire correspondre 
une route (qui correspond à une forme d'url) vers un controlleur.

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

switch ($controlleur->url_decoupee[0])
{
  // sly: Pour toutes ces routes, on est dans un cas simple, l'url correspond au controlleur du même nom, factorisation !
  // et si, il faut les lister explicitement sinon, un pirate pourrait tenter de mettre de fausse page, et le code ouvrirait des fichiers que l'on ne préfère pas ouvrir
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
  case "formulaire_rss_et_nouvelles" :
  case "formulaire_rss_et_nouvelles_validation" :
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

// On appelle le controlleur du bandeau, nécéssaire pour toutes les pages
include ($config_wri['chemin_controlleurs']."bandeau.php");

// On appelle le controlleur qui pourra, s'il le souhaite, changer le type de vue ($type->vue)
include ($config_wri['chemin_controlleurs'].$controlleur->type.".php");

// On affiche la page (bandeau + vue)
include(fichier_vue($vue->template));
