<?php
/*******************************************************************************
Ceci est le fichier des routes principales, il s'ocupe de faire correspondre
une route (qui correspond à une forme d'url) vers un controlleur.

exemple : https://www.refuges.info/point/X/Y/Z => le controlleur point.php

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
$controlleur->url_base=str_replace('RACINE'."/",'','RACINE'.$sans_parametres[0]);
//DOM ajout de RACINE évite d'enlever tous les / quand sous_dossier_installation = /
$controlleur->url_decoupee = explode ('/',$controlleur->url_base);

// Langue d'affichage portée par l'url (le français = aucune marque, pour garder les urls historiques).
// La marque de langue est toujours le DERNIER élément de l'url :
//   /point/91/type/nom/en/  et  /nav/5257/massif/nom/en/ : à l'indice 4 strictement, pour ne jamais être confondue avec
//                                                          le nom d'une fiche (indice 3) ; forme courte /point/91/en/ acceptée
//   /wiki/legende_carte/en/ : à l'indice 2 strictement (la page d'accueil du wiki est /wiki/index/en/)
//   /en/  /nouvelles/en/  /formulaire_exportations/en/ : dernier élément pour toutes les autres pages
$langue_url = '';
$indice_langue = null;
$premier = $controlleur->url_decoupee[0];
$utiles = array_keys(array_filter($controlleur->url_decoupee, function ($segment) { return $segment !== ''; }));
$dernier_utile = $utiles ? end($utiles) : null;
$est_langue = function ($indice) use ($controlleur, $config_wri) {
  return isset($controlleur->url_decoupee[$indice]) and in_array($controlleur->url_decoupee[$indice], $config_wri['langues_url'], true);
};
if (in_array($premier, array('point','nav'), true))
{
  if ($est_langue(4))
    $indice_langue = 4;
  elseif ($est_langue(2) and $dernier_utile === 2)
    $indice_langue = 2;
  elseif ($est_langue(1) and $dernier_utile === 1)
    $indice_langue = 1; // /nav/en/ : la vue carte sans identifiant (un id de point ou de polygone n est jamais une langue)
}
elseif ($premier == 'wiki')
{
  if ($est_langue(2))
    $indice_langue = 2;
}
elseif ($premier != 'api' and $dernier_utile !== null and $est_langue($dernier_utile))
  $indice_langue = $dernier_utile;
if ($indice_langue !== null)
{
  $langue_url = $controlleur->url_decoupee[$indice_langue];
  array_splice($controlleur->url_decoupee, $indice_langue, 1); // les contrôleurs ne voient pas la langue
  if (!$controlleur->url_decoupee)
    $controlleur->url_decoupee = array('');
}
$segments_neutres = $controlleur->url_decoupee; // url sans marque de langue, pour construire le sélecteur de langue
if ($segments_neutres[0]=='wiki')
  // une seule url par page et par langue (canonical, hreflang) : /wiki/page (fr) et /wiki/page/en/ ; /wiki et /wiki/ sont la page "index"
  $segments_neutres = array('wiki', ($segments_neutres[1] ?? '')!=='' ? $segments_neutres[1] : 'index');
$controlleur->langue = $langue_url ?: 'fr';
// Url de la page courante dans chaque langue (sélecteur de langue, hreflang) : même page, autre marque de langue
$requete = ($_SERVER['QUERY_STRING'] ?? '') !== '' ? '?'.$_SERVER['QUERY_STRING'] : '';
foreach (array_merge(array('fr'), $config_wri['langues_url']) as $langue_cible)
{
  $s = $segments_neutres;
  if ($langue_cible != 'fr')
  {
    if (in_array($s[0], array('point','nav'), true) and count($s) >= 4 and $s[3] !== '')
      array_splice($s, 4, 0, $langue_cible);
    elseif ($s[0] == 'wiki')
    {
      $s = array_pad($s, 2, '');
      array_splice($s, 2, 0, $langue_cible);
      if (end($s) !== '')
        $s[] = ''; // forme canonique /wiki/page/en/ (avec la barre finale)
    }
    else
    {
      if (in_array($s[0], array('point','nav'), true))
        $s = array_slice($s, 0, 2); // /point/91/en/ : forme courte, redirigée vers l'url complète
      while ($s and end($s) === '')
        array_pop($s);
      $s[] = $langue_cible;
      $s[] = '';
    }
  }
  $config_wri['liens_langues'][$langue_cible] = '/'.implode('/', $s).$requete;
}
if ($langue_url)
{
  $config_wri['langue_courante'] = $langue_url;
  $config_wri['url_suffixe_langue'] = $langue_url.'/';
  $config_wri['langue'] = 'en_GB'; // IntlDateFormatter
  setlocale(LC_TIME, $config_wri['locales_systeme'][$langue_url] ?? 'fr_FR.UTF-8');
}
// gettext : à refaire à chaque requête car les processus PHP-FPM gardent leur locale d'une requête à l'autre.
// LC_MESSAGES seulement (jamais LC_ALL : le séparateur décimal changerait). Sans catalogue pour la locale (français), _() rend le msgid.
setlocale(LC_MESSAGES, $config_wri['locales_systeme'][$controlleur->langue] ?? 'fr_FR.UTF-8');
bindtextdomain('refuges', $config_wri['chemin_locale']);
bind_textdomain_codeset('refuges', 'UTF-8');
textdomain('refuges');

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
  case "commentaire_formulaire_modification" :
  case "commentaire_modification" :
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
