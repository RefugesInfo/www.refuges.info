<?php
/**
Fichier regroupant les paramètres + config du site
des dossiers, des chemins, des options par défaut, etc.
tout dans un gros tableau $config_wri qu'il suffit de récupérer en déclarant 
global $config_wri; dans les fonctions

un require_once("../emplacement/du/fichier/config.php") est la seule inclusion avec chemin d'accès nécessaire dans un programme non contrôlé par /routage.php
à partir de là tout peut s'inclure par require_once("modele.php")
Si vous êtes en train d'écrire un contrôleur et une règle de routage, cette inclusion du config est inutile car déjà faite

**/

/******** Ce bloc gère la détection automatique des chemins et où on peut trouver les différent dossiers du projet wri **********/
// Il doit s'agir du nom du dossier dans lequel se trouve ce fichier config.php par rapport à la racine du projet wri, soit "includes" si personne ne le change
$config_wri['includes_directory']=basename(__DIR__);

// Ceci est le chemin d'accès physique au / du projet wri
$config_wri['racine_projet']=str_replace($config_wri['includes_directory'],"",__DIR__);

// Ceci est le chemin relatif à la racine web d'accès au projet wri : / si on est à la racine ou /mon/installation/ par exemple. Commence et fini par un "/"
$config_wri['sous_dossier_installation']=str_replace($_SERVER['DOCUMENT_ROOT'],"",$config_wri['racine_projet']);

$config_wri['rep_web_photos_points']=$config_wri['sous_dossier_installation']."photos_points/";
$config_wri['rep_photos_points']=$config_wri['racine_projet']."photos_points/";
$config_wri['chemin_vues']=$config_wri['racine_projet']."vues/";
$config_wri['chemin_modeles']=$config_wri['racine_projet']."modeles/";
$config_wri['chemin_controlleurs']=$config_wri['racine_projet']."controlleurs/";
$config_wri['chemin_routes']=$config_wri['racine_projet']."routes/";

$config_wri['url_chemin_icones']=$config_wri['sous_dossier_installation']."images/icones/";
$config_wri['chemin_icones']=$config_wri['racine_projet']."images/icones/";

//jmb 04/07 on continue avec des rep de moderation
$config_wri['rep_forum']=$config_wri['racine_projet']."forum/";
$config_wri['rep_moder_photos_backup']=$config_wri['racine_projet']."gestion/sauvegardes-photos/";
$config_wri['rep_forum_photos']=$config_wri['racine_projet']."forum/photos-points/";
$config_wri['rep_web_forum_photos']=$config_wri['sous_dossier_installation']."forum/photos-points/";

// Lien direct vers le mode d'emploi
$config_wri['base_wiki']=$config_wri['sous_dossier_installation']."wiki/";

// On centralise ici tous les paramètres PhpBB qui sont figés
// Des fois qu'on décide de re-bouger le forum, on ne le changera qu'ici
$config_wri['lien_forum']=$config_wri['sous_dossier_installation']."forum/";
$config_wri['url_api']=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$config_wri['lien_forum'].'ext/RefugesInfo/couplage/api.php';
// Il faut forcer le préfixe des noms de cookies du forum à 'phpbb3_wri'
// TODO : On pourrait aussi aller le chercher dans phpbb3_config.cookie_name mais, bof, ça va plus vite de le fixer ici !
$config_wri['cookie_prefix']="phpbb3_wri";
// On paramètre le numéro du forum qui contient les topics de discussion sur les fiches des points
$config_wri['forum_refuges']=4;

// Paramètrage des cartes vignettes des fiches de points
$config_wri['chemin_leaflet']=$config_wri['racine_projet'].'leaflet/';
$config_wri['url_chemin_leaflet']=$config_wri['sous_dossier_installation'].'leaflet/';

// En version opérationnelle, deviendra www.refuges.info, mais permet aux zones de dev sur d'autres domaine d'être plus dynamique
$config_wri['nom_hote']=$_SERVER['HTTP_HOST'];

// Permet d'ajouter le chemin des includes et des modeles au path de recherche, ainsi, il suffit d'inclure le config.php
// afin de pouvoir faire des require_once('modele.php');
// ATTENTION ! on pourait être tenté de faire de même pour les controlleurs et les vues, mais les conflits en nom identiques seraient trop important
ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$config_wri['chemin_modeles'].PATH_SEPARATOR.$config_wri['chemin_routes'].PATH_SEPARATOR.__DIR__);

/********** photos / images points ************/
$config_wri['largeur_max_photo']=700;
$config_wri['hauteur_max_photo']=600;
$config_wri['largeur_max_vignette']=140;
$config_wri['hauteur_max_vignette']=140*3/4;
$config_wri['qualite_jpeg']=80;


/********** id internes liés à certains éléments remarquables de la base. Merci d'éviter les numéros en dur dans le code, car si ça doit changer, c'est jeu de la fourmis ************/
// sly  27/04/06 je préfère me baser sur l'id pour le retrouver plutôt que son type ( que je viens d'ailleurs de modifier )
$config_wri['id_massif']=1; //rff 21/03/06 : id du type de polygone correspondant aux 'massifs'
$config_wri['id_carte']=3; //sly : id du type de polygone correspondant aux 'cartes papier'
$config_wri['id_zone']=11; // jmb : grandes zones, alpes, pyrenees ... 
$config_wri['id_zone_defaut']=352; // sly en fait ce sont les alpes
$config_wri['id_zone_accueil']=9956; // DOM: une zone définie uniquement pour montrer les massifs en pages d'accueil

// Catégorie "tout type de refuges"
// certes une gestion par catégorie directement dans la base serait préférable, mais on a au plus 1 ou 2 catégorie donc, bon,
// à la main dans la config : ( ce sont les id des refuges gardés, non gardés et gites)
$config_wri['tout_type_refuge']="7,9,10";

// C'est clair que c'est nul, mais à certain endroits c'est bien pratique voire dur de faire autrement qu'intéroger le bon id directement
$config_wri['id_cabane_non_gardee']=7; 
$config_wri['id_refuge_garde']=10; 
$config_wri['id_gite_etape']=9;
$config_wri['point_d_eau']=23;
$config_wri['id_batiment_en_montagne']=28;

// Champs valables pour les points classés par spécificité (permet de dynamiquement gérer le formulaire de saisie et d'affichage)
// FIXME sly 13/08/2013 : on pourrait presque aller les chercher dans la base directement, mais on perdrait la possiblité de changer l'ordre facilement. A voir le pour et le contre
$config_wri['champs_binaires_points']=array('couvertures','manque_un_mur','eau_a_proximite','latrines','poele','cheminee','bois_a_proximite');
$config_wri['champs_choix_multiples_points']=array_merge(array('conditions_utilisation','places_matelas'),$config_wri['champs_binaires_points']);
$config_wri['champs_simples_points']=array_merge(array("censure","nom","places","remark","proprio","id_point_type","id_createur","modele","id_point_gps",'places_matelas','nom_createur'),$config_wri['champs_choix_multiples_points']);

// c'est l'id pour lequel les coordonnées gps données sont volontairement fausses
$config_wri['id_coordonees_gps_fausses']=5;
// c'est l'id pour lequel les coordonnées gps données sont approximatives
$config_wri['id_coordonees_gps_approximative']=4;


/********** choix de maximums pour rechercher et cartes ************/

//nombre maximum de point que peut sortir la recherche
$config_wri['points_maximum_recherche']=40;

// nombre de point renvoyé par défaut, par l'API (/exportations/)
$config_wri['defaut_max_nombre_point']=121; // NicoM : pourquoi 120 ? sly: pourquoi pas 120 ? NicoM : ben 121 c'est 11^2 sly: alors va pour 121 !


/********** Lié au Forum / comptes / utilisateurs / login / users ************/
// lien direct pour se connecter, ou créer un compte sur le forum
$config_wri['connexion_forum']=$config_wri['lien_forum']."login.php";
// lien vers le profil d'un utilisateur
$config_wri['fiche_utilisateur']=$config_wri['lien_forum']."memberlist.php?mode=viewprofile&u=";
$config_wri['forum_refuge']=$config_wri['lien_forum']."viewtopic.php?t=";

// l'id des modérateurs du forum, pour qu'ils puissent devenir modérateur du site
$config_wri['id_forum_moderateur']=7;
$config_wri['id_forum_developpement']=2;
$config_wri['encodage_exportation']="utf-8";
$config_wri['encodage_des_contenu_web']=$config_wri['encodage_exportation'];

/********** URLs d'accès aux données openstreetmap ************/
// NOTE: ne pas mettre le "schéma" permet d'utiliser le même que celui de la page.
$config_wri['xapi_url_poi']="//api.openstreetmap.fr/osm2node?";
//$config_wri['overpass_api']="//api.openstreetmap.fr/oapi/interpreter";
//Autre serveur de backup :
$config_wri['overpass_api']="//overpass-api.de/api/interpreter";

$config_wri['url_nominatim']="//nominatim.openstreetmap.org/";
$config_wri['url_appel_nominatim']=$config_wri['url_nominatim'] . "search.php?";
$config_wri['email_contact_nominatim']="sylvain@refuges.info";

/********** Cartes vignettes, fond de carte ************/


// Voici le fond de carte par défaut :
// Si vous voulez en changer ou avoir un autre pour le développement, sans avoir à mettre à jour sur git et faire des pirouettes, vous pouvez simplement modifier cette variable
// située dans le fichier config_privee.php qui lui ne sera pas écrasé par le prochain git pull
$config_wri['carte_base'] = 'Refuges.info';
$config_wri['carte_base_monde'] = 'OSM fr';

// Pour avoir swisstopo je suppose ?
$config_wri['SwissTopo'] = true;


/* tableau indiquant quel fond de carte on préfère selon le polygon dans lequel on se trouve
 * utilisé pour les vignettes des pages points et le lien d'accès en dessous + lorsque l'on modifie un point
 * le premier champs est le nom du polygone tel qu'il est dans la base openstreetmap
 * car c'est ce qui a moins de chance de changer, moins que nos id en tout cas */

$config_wri['fournisseurs_fond_carte'] = Array 
(
    // Nom pays chez OSM               Vignette    Français  Carte agrandie Échelle 
    'France métropolitaine'=> Array (null,       ''      , 'IGN',         50000),
    'Réunion'              => Array ('OSM fr',   ''      , 'IGN',         25000),
    'Nouvelle Calédonie'   => Array ('OSM fr',   ''      , 'IGN',         25000),
    'Andorra'              => Array (null,       ''      , 'IGN',         25000),
    'Schweiz'              => Array (null,       ''      , 'SwissTopo',   50000),
    'Österreich'           => Array (null,       ''      , 'Autriche',    50000),
    'España'               => Array (null,       'de l\'', 'Espagne',     25000),
    'Autres'               => Array ('OSM fr',   ''      , 'Outdoors',    50000),
    );
    
/******** Nom du fichier contenant les points exportés **********/
$config_wri['nom_fichier_export']="refuge-info";

/******** Paramètres de l'API **********/
$config_wri['autoriser_CORS']=TRUE; // Autoriser les requêtes AJAX sur notre API
$config_wri['copyright_API']="The data included in this document is from www.refuges.info. The data is made available under CC By-Sa 2.0";

// indispensable pour avoir les affichage de date en french et en UTF-8
setlocale(LC_TIME, "fr_FR.UTF-8");
mb_internal_encoding("UTF-8");
// Bidouille : les dates que nous avons dans notre base sont déjà en heure locale (de Paris) si j'indique ici Europe/Paris, lors de formatage de date en php, on se retrouve à ajouter une fois de trop 1h ou 2h
// donc en lui disant "UTC" il ne fait pas d'ajout et nous laisse les heures comme elle devrait être
date_default_timezone_set('UTC');

// ************* anti-spam, boulets, réservateurs et autres personnes dont on doit se protéger
// Filtrage géographique des inscriptions
//$config_wri['filtre_geo'] = '40 52 -5 10'; // Zone autorisée: latitude_min latitude_max longitude_min longitude_max

// Censure des messages de réservation (On peut aussi le compléter de la config_privee type $config_wri['censure'].="|nombreux")
$config_wri['censure']="reservat|reserver|fete|noel|l\'an |l\'an$|reveillon|prevenir|previen";

// ************* développeurs debug & co

// par défaut, pas d'information de debug, développeurs : changer cette variable dans le fichier config_privee.php si vous voulez plus de message en cas d'erreurs
$config_wri['debug']=false;




// Ce fichier est privée et contient des différentes mot de passe à garder secret ou options spécifique à cette installation de refuges.info
// que l'on ne souhaite pas du tout voir atterrir sur github, il est donc indiqué dans le .gitignore
// il est volontairement placé "presque*" à la fin pour que les variables ci-avant puissent par exemple être sur-chargées si on souhaite
// un autre comportement
// FIXME sly 07/2017 : on devrait utiliser un require_once ici plutôt que require, sauf que le config.php est inclus 2 fois (mais je ne sais pas où !) qui fait qu'au deuxième passaeg, config_privee.php ne surchage plus le par défaut
require($config_wri['racine_projet']."config_privee.php");

// *** NON NON : *** N'ajoutez rien après ce require_once("config_privee.php"); sauf si vous savez pourquoi, car ajouter après empêche de "surdéfinir" certaines variables du fichier privé à chaque instance ci avant
// mettez par contre tout ce que vous voulez avant le require_once("config_privee.php");

// Ceci est après l'inclusion de config_privee.php pour que l'on puisse tenir compte du mode debug que le developpeur peut s'il le souhaite activer
$config_wri['chemin_leaflet'].=$config_wri['debug']?'src/':'dist/';
$config_wri['url_chemin_leaflet'].=$config_wri['debug']?'src/':'dist/';

if ($config_wri['debug'])
{
  ini_set('error_reporting', E_ALL ^ E_NOTICE);
  ini_set('display_errors', '1');
}
