<?php 
/*******************************************************************************
Ceci est un essai actuellement (17/03/2013) de sly pour voir si on pourrait encore mutualiser
des choses pour le MVC en réduisant tous les appels aux templates, js, styles et autre
en créant un seul fichier "controlleur.php" qui soit le point d'entrée quasi unique du site

Il s'occupe alors d'analyser l'url pour en déterminer ce qui doit être fait, appeler les controlleurs
selon cette url puis ouvrir les vues, toujours selon cet url.

*******************************************************************************/
require_once ('./includes/config.php');
require_once ("fonctions_autoconnexion.php");

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
    case "point":
        $controlleur->type="point";
        break;
    case "point-geojson":
        $controlleur->type="point";
        $vue->template="point.geojson";
        $controlleur->avec_entete_et_pied=False;
        break;
    case "nav":
        $controlleur->type="nav";
        break;
    case "mode_emploi":
        $controlleur->type="mode_emploi";
        break;
    case "nouvelles": case "news.php" :// FIXME d'ici ~1an on passera à "nouvelles" uniquement
        $controlleur->type="nouvelles";
        break;
    case "index": case "index.php" : case "" :
        $controlleur->type="index";
        break;
    case "point_ajout_commentaire" :
        $controlleur->type="point_ajout_commentaire";
        break;
    case "point_recherche.php" : case "point_recherche" :
        $controlleur->type="point_recherche";
        break;
    case "point_formulaire_recherche.php" : case "point_formulaire_recherche" :
        $controlleur->type="point_formulaire_recherche";
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
    case "rss" : case "rss.php" :
        $controlleur->type="rss";
        break;
    case "formulaire_rss.php" : case "formulaire_rss" : 
        $controlleur->type="formulaire_rss";
        break;
    case "avis-internaute-commentaire" : 
        $controlleur->type="avis-internaute-commentaire"; 
        break;
    case "formulaire_exportations" : 
        $controlleur->type="formulaire_exportations"; 
        break;
    default : 
        $controlleur->type="page_introuvable"; 
    break;
}

// Petite factorisation, dans la majorité des cas, la vue porte le nom du controlleur + .html ... mais pas toujours
if (!isset($vue->type))
    $vue->type=$controlleur->type;

// On appel le controlleur qui pourra, s'il le souhaite, changer le type de vue ($type->vue)
include ($config['chemin_controlleurs'].$controlleur->type.".php");

// On affiche le tout
if ($controlleur->avec_entete_et_pied)
    include ($config['chemin_vues']."_entete.html");
    
// Là, c'est bidouille compatibilité avec avant, je pense que chaque controlleur devrait pouvoir décider de la vue sans que soit imposée l'extension
if (!isset($vue->template))
    $vue->template=$vue->type.".html";
    
include ($config['chemin_vues'].$vue->template);
if ($controlleur->avec_entete_et_pied)
    include ($config['chemin_vues']."_pied.html");
?>
