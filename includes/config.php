<?php
/**
Fichier regroupant les paramètres + config du site
des dossiers, des chemins, des options par défaut, etc.
tout dans un gros tableau $config qu'il suffit de récupérer en déclarant 
global $config; dans les fonctions

un require_once("../emplacement/du/fichier/config.php") est la seule inclusion avec chemin d'accès nécessaire dans un programme non contrôlé par /routage.php
à partir de là tout peut s'inclure par require_once("modele.php")
Si vous êtes en train d'écrire un contrôleur et une règle de routage, cette inclusion du config est inutile car déjà faite

**/

/******** Ce bloc gère la détection automatique des chemins et où on peut trouver les différent dossiers du projet wri **********/
// Il doit s'agir du nom du dossier dans lequel se trouve ce fichier config.php par rapport à la racine du projet wri, soit "includes" si personne ne le change
$config['includes_directory']=basename(__DIR__);

// Ceci est le chemin d'accès physique au / du projet wri
$config['racine_projet']=str_replace($config['includes_directory'],"",__DIR__);

// Ceci est le chemin relatif à la racine web d'accès au projet wri : / si on est à la racine ou /mon/installation/ par exemple. Commence et fini par un "/"
$config['sous_dossier_installation']=str_replace($_SERVER['DOCUMENT_ROOT'],"",$config['racine_projet']);

$config['rep_web_photos_points']=$config['sous_dossier_installation']."photos_points/";
$config['rep_photos_points']=$config['racine_projet']."photos_points/";
$config['chemin_vues']=$config['racine_projet']."vues/";
$config['chemin_modeles']=$config['racine_projet']."modeles/";
$config['chemin_controlleurs']=$config['racine_projet']."controlleurs/";
$config['chemin_routes']=$config['racine_projet']."routes/";

$config['url_chemin_icones']=$config['sous_dossier_installation']."images/icones/";
$config['chemin_icones']=$config['racine_projet']."images/icones/";

//jmb 04/07 on continue avec des rep de moderation
$config['rep_moder_photos_backup']=$config['racine_projet']."gestion/sauvegardes-photos/";
$config['rep_forum_photos']=$config['racine_projet']."forum/photos-points/";
$config['rep_web_forum_photos']=$config['sous_dossier_installation']."forum/photos-points/";

// Lien direct vers le mode d'emploi
$config['base_wiki']=$config['sous_dossier_installation']."wiki/";

// des fois qu'on décide de re-bouger le forum, on ne le changera qu'ici
$config['lien_forum']=$config['sous_dossier_installation']."forum/";

// Paramètrage des cartes vignettes des fiches de points
$config['chemin_leaflet']=$config['racine_projet'].'leaflet/';
$config['url_chemin_leaflet']=$config['sous_dossier_installation'].'leaflet/';

// En version opérationnelle, deviendra www.refuges.info, mais permet aux zones de dev sur d'autres domaine d'être plus dynamique
$config['nom_hote']=$_SERVER['HTTP_HOST'];

// Permet d'ajouter le chemin des includes et des modeles au path de recherche, ainsi, il suffit d'inclure le config.php
// afin de pouvoir faire des require_once('modele.php');
// ATTENTION ! on pourait être tenté de faire de même pour les controlleurs et les vues, mais les conflits en nom identiques seraient trop important
ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$config['chemin_modeles'].PATH_SEPARATOR.$config['chemin_routes'].PATH_SEPARATOR.__DIR__);

/** Auto chargement des déclarations de classes
    les classes ModeleClasse sont déclarées dans modeles/Classe.php
    les classes ControleurClasse sont déclarése dans controleurs/Classe.php
    les autres classes Classe sont déclarées dans includes/Classe.php
**/
spl_autoload_register(function ($class) {
	if (preg_match ('/([A-Z][a-z]+)(.*)/', $class, $c))
        require_once '../'.strtolower($c[1]).'s/'.$c[2].'.php';
    else
        require_once __DIR__.'/'.$class.'.php';
});

/********** photos / images points ************/
$config['largeur_max_photo']=700;
$config['hauteur_max_photo']=600;
$config['largeur_max_vignette']=140;
$config['hauteur_max_vignette']=140*3/4;
$config['qualite_jpeg']=80;


/********** id internes liés à certains éléments remarqueable de la base. Merci d'éviter les numéros en dur dans le code, car si ça doit changer, c'est jeu de la fourmis ************/
// sly  27/04/06 je préfère me baser sur l'id pour le retrouver plutôt que son type ( que je viens d'ailleurs de modifier )
$config['id_massif']=1; //rff 21/03/06 : id du type de polygone correspondant aux 'massifs'
$config['id_carte']=3; //sly : id du type de polygone correspondant aux 'cartes papier'
$config['id_zone']=11; // jmb : grandes zones, alpes, pyrenees ... 
$config['id_zone_defaut']=352; // sly en fait ce sont les alpes
$config['id_zone_accueil']=3304; // sly en fait ce sont les alpes françaises qui ne devrait servir qu'en page d'accueil pour monter cette zone par défaut sur la petite carte

// Catégorie "tout type de refuges"
// certes une gestion par catégorie directement dans la base serait préférable, mais on a au plus 1 ou 2 catégorie donc, bon,
// à la main dans la config : ( ce sont les id des refuges gardés, non gardés et gites)
$config['tout_type_refuge']="7,9,10";

// C'est clair que c'est nul, mais à certain endroits c'est bien pratique voire dur de faire autrement qu'intéroger le bon id directement
$config['id_cabane_non_gardee']=7; 
$config['id_refuge_garde']=10; 
$config['id_gite_etape']=9;
$config['point_d_eau']=23;
$config['id_batiment_en_montagne']=28;

// Champs valables pour les points classés par spécificité (permet de dynamiquement gérer le formulaire de saisie et d'affichage)
// FIXME sly 13/08/2013 : on pourrait presque aller les chercher dans la base directement, mais on perdrait la possiblité de changer l'ordre facilement. A voir le pour et le contre
$config['champs_binaires_points']=array('couvertures','manque_un_mur','eau_a_proximite','latrines','poele','cheminee','bois_a_proximite');
$config['champs_choix_multiples_points']=array_merge(array('conditions_utilisation','places_matelas'),$config['champs_binaires_points']);
$config['champs_simples_points']=array_merge(array("censure","nom","places","remark","proprio","id_point_type","id_createur","modele","id_point_gps",'places_matelas','nom_createur'),$config['champs_choix_multiples_points']);

// c'est l'id pour lequel les coordonnées gps données sont volontairement fausses
$config['id_coordonees_gps_fausses']=5;
// c'est l'id pour lequel les coordonnées gps données sont approximatives
$config['id_coordonees_gps_approximative']=4;


/********** choix de maximums pour rechercher et cartes ************/

//nombre maximum de point que peut sortir la recherche
$config['points_maximum_recherche']=40;

// nombre de point renvoyé par défaut, par l'API (/exportations/)
$config['defaut_max_nombre_point']=121; // NicoM : pourquoi 120 ? sly: pourquoi pas 120 ? NicoM : ben 121 c'est 11^2 sly: alors va pour 121 !


/********** Lié au Forum / comptes / utilisateurs / login / users ************/
// lien direct pour se connecter, ou créer un compte sur le forum
$config['connexion_forum']=$config['lien_forum']."login.php";
// lien vers le profil d'un utilisateur
$config['fiche_utilisateur']=$config['lien_forum']."profile.php?mode=viewprofile&u=";
$config['forum_refuge']=$config['lien_forum']."viewtopic.php?t=";

// l'id des modérateurs du forum, pour qu'ils puissent devenir modérateur du site
$config['id_forum_moderateur']=7;
$config['id_forum_developpement']=2;
$config['encodage_exportation']="utf-8";
$config['encodage_des_contenu_web']=$config['encodage_exportation'];

/********** URLs d'accès aux données openstreetmap ************/

$config['xapi_url_poi']="https://api.openstreetmap.fr/osm2node?";
$config['overpass_api']="https://api.openstreetmap.fr/oapi/interpreter";
//Autre serveur de backup :
$config['overpass_api']="https://www.overpass-api.de/api/interpreter";

$config['url_nominatim']="https://nominatim.openstreetmap.org/";
$config['url_appel_nominatim']=$config['url_nominatim'] . "search.php?";
$config['email_contact_nominatim']="sylvain@refuges.info";

/********** Cartes vignettes, fond de carte ************/


// Voici le fond de carte par défaut :
// Si vous voulez en changer ou avoir un autre pour le développement, sans avoir à mettre à jour sur git et faire des pirouettes, vous pouvez simplement modifier cette variable
// située dans le fichier config_privee.php qui lui ne sera pas écrasé par le prochain git pull
$config['carte_base'] = 'Refuges.info';
$config['carte_base_monde'] = 'OSM fr';

// Pour avoir swisstopo je suppose ?
$config['SwissTopo'] = true;


/* tableau indiquant quel fond de carte on préfère selon le polygon dans lequel on se trouve
 * utilisé pour les vignettes des pages points et le lien d'accès en dessous + lorsque l'on modifie un point
 * le premier champs est le nom du polygone tel qu'il est dans la base openstreetmap
 * car c'est ce qui a moins de chance de changer, moins que nos id en tout cas */

$config['fournisseurs_fond_carte'] = Array 
(
    // Nom pays chez OSM               Vignette    Français  Carte agrandie Échelle 
    'France métropolitaine'=> Array (null,       ''      , 'IGN',         50000),
    'Réunion'              => Array ('OSM fr',   ''      , 'IGN',         25000),
    'Nouvelle Calédonie'   => Array ('OSM fr',   ''      , 'IGN',         25000),
    'Andorra'              => Array (null,       ''      , 'IGN',         25000),
    'Schweiz'              => Array (null,       ''      , 'SwissTopo',   50000),
    'Österreich'           => Array (null,       ''      , 'Autriche',    50000),
    'Italia'               => Array (null,       'de l\'', 'Italie',     100000),
    'España'               => Array (null,       'de l\'', 'Espagne',     25000),
    'Autres'               => Array ('OSM fr',   ''      , 'Outdoors',    50000),
    );
    
/******** Nom du fichier contenant les points exportés **********/
$config['nom_fichier_export']="refuge-info";

/******** Paramètres de l'API **********/
$config['autoriser_CORS']=TRUE; // Autoriser les requêtes AJAX sur notre API
$config['copyright_API']="The data included in this document is from www.refuges.info. The data is made available under CC By-Sa 2.0";

// indispensable pour avoir les affichage de date en french et en UTF-8
setlocale(LC_TIME, "fr_FR.UTF-8");
mb_internal_encoding("UTF-8");

// ************* anti-spam, boulets, réservateurs et autres personnes dont on doit se protéger
// Filtrage géographique des inscriptions
//$config['filtre_geo'] = '40 52 -5 10'; // Zone autorisée: latitude_min latitude_max longitude_min longitude_max

// Censure des messages de réservation, à compléter dans config_privee.php si ça évolue trop souvent
$config['censure']="reservat|reserver";

// ************* développeurs debug & co

// par défaut, pas d'information de debug, développeurs : changer cette variable dans le fichier config_privee.php si vous voulez plus de message en cas d'erreurs
$config['debug']=false;

// Ce fichier est privée et contient des différentes mot de passe à garder secret ou options spécifique à cette installation de refuges.info
// que l'on ne souhaite pas du tout voir atterrir sur github, il est donc indiqué dans le .gitignore
// il est volontairement placé "presque*" à la fin pour que les variables ci-avant puissent par exemple être sur-chargées si on souhaite
// un autre comportement
// Le problème c'est que le tableau ci-après re-fait appel à la variable $config['carte_base'] que j'aimerais pouvoir surcharger dans 
// config_privee.php, c'est donc un peu merdique comme méthode, mais j'ai pas trouvé mieux
require_once("config_privee.php");







// *** NON NON : *** N'ajoutez rien après cette ligne sauf si vous savez pourquoi, car ajouter après empêche de "surdéfinir" certaines variables du fichier privé à chaque instance ci avant
// mettez par contre tout ce que vous voulez avant le require_once("config_privee.php");


$config['chemin_leaflet'].=$config['debug']?'src/':'dist/';
$config['url_chemin_leaflet'].=$config['debug']?'src/':'dist/';

// Le forum est bourré de warning que je ne compte pas vraiment reprendre, oui, j'ai mis ça après le include de config_privee.php car si debug vaut true dans le config_privee mis avant, on ne veut quand même pas 
// les warnings du forum qui remplissent l'écran
if ($config['debug'] and !preg_match("/forum/",$_SERVER['REQUEST_URI']))
{
  ini_set('error_reporting', E_ALL ^ E_NOTICE);
  ini_set('display_errors', '1');
}
