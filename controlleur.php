<?php 
/*******************************************************************************
Ceci est un essai actuellement (17/03/2013) de sly pour voir si on pourrait encore mutualiser
des choses pour le MVC en réduisant tous les appels aux templates, js, styles et autre
en créant un seul fichier "controlleur.php" qui soit le point d'entrée quasi unique du site

Il s'occupe alors d'analyser l'url pour en déterminer ce qui doit être fait, appeler les controlleurs
selon cette url puis ouvrir les vues, toujours selon cet url.

*******************************************************************************/
require_once ('./includes/config.php');
require_once ("autoconnexion.php");
require_once ("wiki.php");

// Analyse de l'url (basique pour l'instant pourrait être étendu ultérieurement selon les besoins)
$controlleur = new stdClass;
$vue = new stdClass;

// On garde dans $controlleur l'url complète d'appel, au cas où
$controlleur->url_complete=$_SERVER['REQUEST_URI'];
$sans_parametres=explode ('?',$controlleur->url_complete);

// Uniquement /point/5/toto/sfsdf (pas les ?toto=coucou...)
$controlleur->url_base=$sans_parametres[0];
$controlleur->url_decoupee = explode ('/',$controlleur->url_base);

// Par défaut, on veut un en-tête et pied de page html, mais dans de rare cas (point-geojson) on ne veut pas
// le débat étant à poursuivre ici : http://www.refuges.info/forum/viewtopic.php?t=5294
$controlleur->avec_entete_et_pied=True;

// On pourrait être tenté de faire une conversion direct de url vers controlleur, mais si un filou commence à indiquer
// n'importe quelle url, il pourrait réussir à ouvrir des trucs pas souhaités, avec une liste, on s'assure
// de n'autoriser que ceux que l'on veut
switch ($controlleur->url_decoupee[1])
{
    // sly: Pour toutes ces routes, on est dans un cas simple, l'url correspond au controlleur du même nom, factorisation !
    case "point" :
    case "nav" :
    case "wiki" :
    case "nouvelles" :
    case "point_ajout_commentaire" :
    case "point_recherche" :
    case "rss" :
    case "formulaire_rss" :
    case "avis-internaute-commentaire" :
    case "formulaire_exportations" :
    case "point_formulaire_recherche" :
        $controlleur->type=$controlleur->url_decoupee[1];
        break;
    case "point-geojson":
        $controlleur->type="point";
        $vue->template="point.geojson";
        $controlleur->avec_entete_et_pied=False;
        break;
    case "index": case "" :
        $controlleur->type="index";
        break;
    case "point_formulaire_modification.php" : case "point_formulaire_modification" :
        $controlleur->type="point_formulaire_modification";
        break;
    case "point_modification.php" : case "point_modification" :
        $controlleur->type="point_modification";
        break;
    case "point_ajout" :
        $controlleur->type="point_ajout_choix_type";
        break;
    case "test" :
        $controlleur->type="test";
        $controlleur->avec_entete_et_pied=false;
        break;
    default : 
        $controlleur->type="page_introuvable"; 
    break;
}

// Petite factorisation, dans la majorité des cas, la vue porte le nom du controlleur + .html ... mais pas toujours
if (!isset($vue->type))
    $vue->type=$controlleur->type;

// On gère l'éventuel connexion automatique de l'internaute
auto_login_phpbb_users();

// On appel le controlleur qui pourra, s'il le souhaite, changer le type de vue ($type->vue)
include ($config['chemin_controlleurs'].$controlleur->type.".php");

// et vérification s'il n'y a pas un commentaire à modérer pour notre équipe de modération
if ($_SESSION['niveau_moderation']>=1)
    $vue->demande_correction=info_demande_correction ();

// On affiche le tout
if ($controlleur->avec_entete_et_pied)
{
    $vue->lien_wiki=prepare_lien_wiki_du_bandeau();
    include ($config['chemin_vues']."_entete.html");
}	

// Là, c'est bidouille compatibilité avec avant, je pense que chaque controlleur devrait pouvoir décider de la vue sans que soit imposée l'extension
if (!isset($vue->template))
    $vue->template=$vue->type.".html";
    
include ($config['chemin_vues'].$vue->template);
if ($controlleur->avec_entete_et_pied)
    include ($config['chemin_vues']."_pied.html");
?>
