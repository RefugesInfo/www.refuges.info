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

// On garde dans $controlleur l'url complète d'appel, au cas où
$controlleur->url_complete=$_SERVER['REQUEST_URI'];
$sans_parametres=explode ('?',$controlleur->url_complete);

// Uniquement /point/5/toto/sfsdf (pas les ?toto=coucou...) et pas le sous dossier dans lequel wri pourrait être installé
$controlleur->url_base=str_replace('RACINE'.$config['sous_dossier_installation'],'','RACINE'.$sans_parametres[0]);
//DOM ajout de RACINE évite d'enlever tous les / quand sous_dossier_installation = /
$controlleur->url_decoupee = explode ('/',$controlleur->url_base);

// Par défaut, on veut un en-tête et pied de page html, mais dans de rare cas (point-json) on ne veut pas
// le débat étant à poursuivre ici : http://www.refuges.info/forum/viewtopic.php?t=5294
$controlleur->avec_entete_et_pied=True;

// On pourrait être tenté de faire une conversion direct de url vers controlleur, mais si un filou commence à indiquer
// n'importe quelle url, il pourrait réussir à ouvrir des trucs pas souhaités, avec une liste, on s'assure
// de n'autoriser que ceux que l'on a
switch ($controlleur->url_decoupee[0])
{
    // sly: Pour toutes ces routes, on est dans un cas simple, l'url correspond au controlleur du même nom, factorisation !
    case "point" :
    case "nav" :
    case "wiki" :
    case "nouvelles" :
    case "point_ajout_commentaire" :
    case "point_recherche" :
    case "avis_internaute_commentaire" :
    case "formulaire_exportations" :
    case "point_formulaire_recherche" :
        auto_login_phpbb_users();
    case "formulaire_rss" :
        $controlleur->type=$controlleur->url_decoupee[0];
        break;
    case "point-json":
        $controlleur->type="point";
        $vue->template="point.json";
        $controlleur->avec_entete_et_pied=False;
        break;
    case "index": case "" :
        auto_login_phpbb_users();
        $controlleur->type="index";
        break;
    case "point_formulaire_modification.php" : case "point_formulaire_modification" :
        auto_login_phpbb_users();
        $controlleur->type="point_formulaire_modification";
        break;
    case "point_modification.php" : case "point_modification" :
        auto_login_phpbb_users();
        $controlleur->type="point_modification";
        break;
    case "point_ajout" :
        auto_login_phpbb_users();
        $controlleur->type="point_ajout_choix_type";
        break;
    case "test" :
        $controlleur->type="test";
        $controlleur->avec_entete_et_pied=false;
        break;
    case "api" :
        require_once ("api.routes.php");
        exit(0); // magouille car les routes de l'api ne fonctionnent pas tout à fait comme les autres, il faudrait pouvoir uniformiser et pour ça, être plus flexible sur la gestion routes + controlleurs + vues
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

// La suite, c'est une somme de "par défaut" sauf si le controlleur a imposé ses choix

// Ajoute les liens vers les autres zones
$conditions = new stdClass;
$conditions->ids_polygone_type=$config['id_zone'];
$zones=infos_polygones($conditions);
if ($zones)
  foreach ($zones as $zone)
    $vue->zones [ucfirst($zone->nom_polygone)] = lien_polygone($zone)."?mode_affichage=zone";

// et vérification s'il n'y a pas un commentaire à modérer pour notre équipe de modération
// FIXME : Dans une logique de rangement parfait, ça ne devrait pas être ici, mais dans chaque contrôleur qui a besoin de modifier le bandeau avec l'étoile, mais la factorisation a eu raison de moi ;-)
// Si quelqu'un veut le bouger, il a mon feu vert -- sly
if (isset ($_SESSION['niveau_moderation']) and $_SESSION['niveau_moderation']>=1)
    $vue->demande_correction=info_demande_correction ();

// On affiche le tout
// FIXME : Chaque controlleur, ou mieux encore, chaque vue (un include ?) devrait être autonome pour dire s'il veut l'entête ou non
if ($controlleur->avec_entete_et_pied)
{
    $vue->lien_wiki=prepare_lien_wiki_du_bandeau();
    include ($config['chemin_vues']."_entete.html");
}	

// Là, c'est bidouille compatibilité avec avant, je pense que chaque controlleur devrait pouvoir décider de la vue sans que soit imposée l'extension
if (!isset($vue->template))
    $vue->template=$vue->type.".html";

// FIXME : idem entête
include ($config['chemin_vues'].$vue->template);
if ($controlleur->avec_entete_et_pied)
    include ($config['chemin_vues']."_pied.html");
?>
