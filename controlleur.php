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
// Je doute qu'avoir l'url complète serve ?
$controlleur->url_complete=$_SERVER['REQUEST_URI'];
$sans_parametres=explode ('?',$controlleur->url_complete);

// Uniquement /point/5/toto/sfsdf (pas les ?toto=coucou...)
$controlleur->url_base=$sans_parametres[0];
$controlleur->url_decoupee = explode ('/',$controlleur->url_base);

// On pourrait être tenté de faire une conversion direct de url vers controlleur, mais si un filou commence à indiquer
// n'importe quelle url, il pourrait réussir à ouvrir des trucs pas souhaités, avec une liste, on s'assure
// de n'autoriser que ceux que l'on veut
switch ($controlleur->url_decoupee[1])
{
    case "point": $vue->type=$controlleur->type="point"; break;
    case "nav": $vue->type=$controlleur->type="nav"; break;
    case "mode_emploi": $vue->type=$controlleur->type="mode_emploi"; break;
    case "nouvelles": case "news": case "news.php" : $vue->type=$controlleur->type="nouvelles"; break;
    case "index": case "index.php" : case "" : $vue->type=$controlleur->type="index"; break;
    case "point_ajout_commentaire.php" : case "point_ajout_commentaire" : $vue->type=$controlleur->type="point_ajout_commentaire"; break;
    case "point_recherche.php" : case "point_recherche" : $vue->type=$controlleur->type="point_recherche"; break;
    case "point_formulaire_recherche.php" : case "point_formulaire_recherche" : $vue->type=$controlleur->type="point_formulaire_recherche"; break;
    case "point_formulaire_modification.php" : case "point_formulaire_modification" : $vue->type=$controlleur->type="point_formulaire_modification"; break;
    case "point_modification.php" : case "point_modification" : $vue->type=$controlleur->type="point_modification"; break;
    case "rss" : case "rss.php" : $vue->type=$controlleur->type="rss"; break;
    case "formulaire_rss.php" : case "formulaire_rss" : $vue->type=$controlleur->type="formulaire_rss"; break;
    case "avis-internaute-commentaire" : $vue->type=$controlleur->type="avis-internaute-commentaire"; break;
    case "formulaire_exportations" : $vue->type=$controlleur->type="formulaire_exportations"; break;
    default : $vue->type=$controlleur->type="page_introuvable"; break;
}

// On appel le controlleur adapté
include ($config['chemin_controlleurs'].$controlleur->type.".php");


if ($_GET['format']=="geojson" && $vue->type=="point") {
    include ($config['chemin_vues']."$vue->type.geojson");
}
else {
    /*********** On affiche le tout ***/
    include ($config['chemin_vues']."_entete.html");
    include ($config['chemin_vues']."$vue->type.html");
    include ($config['chemin_vues']."_pied.html");
}
?>
