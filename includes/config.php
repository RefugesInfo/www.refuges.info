<?php
/**
Fichier regroupant les paramètres + config du site
des dossiers, des chemins, des options par défaut, etc.
tout dans un gros tableau $config_wri qu'il suffit de récupérer en déclarant 
global $config_wri; dans les fonctions

un require_once("../emplacement/du/fichier/config.php") est la seule inclusion avec chemin d'accès nécessaire dans un programme non contrôlé par /index.php
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

// c'est le nom de la page du wiki qui explique la syntaxe bbcode
$config_wri['bbcode_wiki_page']="syntaxe_bbcode";

// On centralise ici tous les paramètres PhpBB qui sont figés
// Des fois qu'on décide de re-bouger le forum, on ne le changera qu'ici
$config_wri['lien_forum']=$config_wri['sous_dossier_installation']."forum/";

// Liste des icône de base pour nos types de point de base
$config_wri['correspondance_type_icone'] = [
	'batiment-en-montagne' => 'cabane_white_black_a63',
	'cabane-non-gardee' => 'cabane',
	'gite-d-etape' => 'cabane_green',
	'lac' => 'lac',
	'passage-delicat' => 'triangle_a33.10',
	'point-d-eau' => 'pointdeau',
	'refuge-garde' => 'cabane_red',
	'sommet' => 'sommet',
];

// Liste des autres icônes utilisées dans les cartes
$config_wri['definition_icones'] = array_merge ($config_wri['correspondance_type_icone'], [
	'ancien-point-d-eau' => 'pointdeau_x',
	'batiment-inutilisable' => 'cabane_white_black_x',
	'cabane-avec-eau' => 'cabane_eau',
	'cabane-avec-moyen-de-chauffage' => 'cabane_feu',
	'cabane-avec-moyen-de-chauffage-et-eau-a-proximite' => 'cabane_eau_feu',
	'cabane-cle' => 'cabane_cle',
	'cabane-eau-a-proximite' => 'cabane_eau',
	'cabane-manque-un-mur' => 'cabane_manqueunmur',
	'cabane-sans-places-dormir' => 'cabane_a48',
	'inutilisable' => 'cabane_white_black_x',
]);

// On paramètre le numéro du forum qui contient les topics de discussion sur les fiches des points
$config_wri['forum_refuges']=4;

// Paramètrage des cartes vignettes des fiches de points
$config_wri['chemin_ol']=$config_wri['racine_projet'].'MyOl/';
$config_wri['url_chemin_ol']=$config_wri['sous_dossier_installation'].'MyOl/';
error_reporting(E_ALL);
ini_set('display_errors','on');

// détection de MS Internet Explorer
$config_wri['is_ie']=strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false;

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

/********** posts dans la page points ************/
$config_wri['point_posts_nb_max_post'] = 4;
$config_wri['point_posts_lon_max_text'] = 250;

/********** id internes liés à certains éléments remarquables de la base. Merci d'éviter les numéros en dur dans le code, car si ça doit changer, c'est jeu de la fourmis ************/
// sly  27/04/06 je préfère me baser sur l'id pour le retrouver plutôt que son type ( que je viens d'ailleurs de modifier )
$config_wri['id_massif']=1; //rff 21/03/06 : id du type de polygone correspondant aux 'massifs'
$config_wri['id_carte']=3; //sly : id du type de polygone correspondant aux 'cartes papier'
$config_wri['id_zone']=11; // jmb : grandes zones, alpes, pyrenees, massif central, ile de la réunion ... 
$config_wri['id_zone_reglementee']=12; // sly 2020 : réserves natuelles, réserves biologique, parcs nationaux.

// Catégorie "tout type de refuges"
// certes une gestion par catégorie directement dans la base serait préférable, mais on a au plus 1 ou 2 catégorie donc, bon,
// à la main dans la config : ( ce sont les id des refuges gardés, non gardés et gites)
$config_wri['tout_type_refuge']="7,9,10";

$config_wri['bbox_page_accueil']='-5,42,8,51';

// C'est clair que c'est nul, mais à certain endroits c'est bien pratique voire dur de faire autrement qu'intéroger le bon id directement
$config_wri['id_cabane_non_gardee']=7; 
$config_wri['id_refuge_garde']=10; 
$config_wri['id_gite_etape']=9;
$config_wri['point_d_eau']=23;
$config_wri['id_batiment_en_montagne']=28;
$config_wri['passage_delicat']=3;

//là aussi ça parait crétin de stocker ça en dur, alors qu'il y a bien une technique pour lister dynamiquement le nom des champs, et ben, allez savoir pourquoi, chez postgres, cette méthode bouffe ~10ms !! Vu que je m'en sers plusieurs fois en plus, quitte à en arriver là, je l'écris ici et zou
//pensez à ajouter vous même à la main "geom" si vous voulez la géométrie, car c'est justement là le but de ne pas mettre "*" : éviter de récupérer la géométrie pour rien
$config_wri['champs_table_polygones']='polygones.id_polygone,polygones.id_polygone_type,polygones.article_partitif,polygones.nom_polygone,polygones.source,polygones.message_information_polygone,polygones.url_exterieure,polygones.site_web';

// Champs valables pour les points classés par spécificité (permet de dynamiquement gérer en partie le formulaire de saisie et d'affichage)
$config_wri['champs_trinaires_points']=array('couvertures','manque_un_mur','eau_a_proximite','latrines','poele','cheminee','bois_a_proximite'); // ceux là sont des champs ou ne sait pas/oui/non sont possible (traiter dynamiquement dans une boucle)
$config_wri['champs_entier_ou_sait_pas_points']=array('places','places_matelas');
$config_wri['champs_simples_points']=array_merge(array('conditions_utilisation','places','places_matelas',"en_attente","nom","acces","remark","proprio","id_point_type","id_createur","modele","altitude","id_type_precision_gps",'nom_createur'),$config_wri['champs_trinaires_points'],$config_wri['champs_entier_ou_sait_pas_points']);

// c'est l'id pour lequel les coordonnées gps données sont volontairement fausses
$config_wri['id_coordonees_gps_fausses']=5;
// c'est l'id pour lequel les coordonnées gps données sont approximatives
$config_wri['id_coordonees_gps_approximative']=4;


/********** choix de maximums ************/

// nombre maximum de points que peut sortir la recherche
$config_wri['points_maximum_recherche']=40;

// nombre de points renvoyés par défaut, par l'API
$config_wri['defaut_max_nombre_point']=250;

// nombre de jours pris en compte pour les derniers ajouts sur la page d'accueil et nouvelles
$config_wri['defaut_max_jours_ajouts_recents']=7;


/********** Lié au Forum / comptes / utilisateurs / login / users ************/
// lien direct pour se connecter, ou créer un compte sur le forum
$config_wri['connexion_forum']=$config_wri['lien_forum']."ucp.php?mode=login";
// lien vers le profil d'un utilisateur
$config_wri['fiche_utilisateur']=$config_wri['lien_forum']."memberlist.php?mode=viewprofile&u=";
$config_wri['forum_refuge']=$config_wri['lien_forum']."viewtopic.php?t=";

// l'id de catégories spéciales du forum
$config_wri['id_forum_moderateur']=7;
$config_wri['id_forum_developpement']=2;
$config_wri['encodage_exportation']="utf-8";
$config_wri['encodage_des_contenu_web']=$config_wri['encodage_exportation'];

/********** URLs d'accès aux données openstreetmap ************/
// NOTE: ne pas mettre le "schéma" permet d'utiliser le même que celui de la page.
$config_wri['overpass_api']="//overpass-api.de/api/interpreter";

$config_wri['url_nominatim']="//nominatim.openstreetmap.org/";
$config_wri['url_appel_nominatim']=$config_wri['url_nominatim'] . "search.php?";
$config_wri['email_contact_nominatim']="sylvain@refuges.info";

// Censure des messages de réservation (On peut aussi le compléter de la config_privee type $config_wri['censure'].="|nombreux")
$config_wri['censure']="reservat|reserver|fete|noel|l\'an |l\'an$|reveillon|prevenir|previen";

// tableau contenant les formats possibles pour exporter des points par l'API et une descripion courte (sly: j'hésite à y mettre un paté d'explication, mais ça fait un lourd à maintenir)
// La vue qui doit être choisie est /vues/api/points.vue.$format. L'ordre pourra déterminer l'ordre proposé à l'internaute

$config_wri['api_format_points'] = Array 
( 
'gpx' => "gpx (Complet, pour logiciel type osmand, marble)",
'gpx_garmin' => "gpx (compatible basecamp/mapsource/viking/...)",
'gpx_simple' => "gpx simplifié (sans remarques et accès)",
'kmz' => "kmz (googlearth compressé)",
'kml' => "kml (googlearth)",
'gml' => "Geography Markup Language",
'csv' => "csv (tableurs)",
'xml' => "xml Spécifique à notre base, exhaustif",
'geojson' => "GeoJSON"
);
    
/******** Nom du fichier contenant les points exportés **********/
$config_wri['nom_fichier_export']="refuge-info";

/******** Paramètres de l'API **********/
$config_wri['autoriser_CORS']=TRUE; // Autoriser les requêtes AJAX sur notre API
$config_wri['copyright_API']="The data included in this document is from www.refuges.info. The data is made available under CC By-Sa 2.0";

// ******* options php *******
setlocale(LC_TIME, "fr_FR.UTF-8"); // Pour avoir les affichage de date en french et en UTF-8
mb_internal_encoding("UTF-8");
// FIXME : les dates que nous avons dans notre base sont déjà en heure locale (de Paris) si j'indique ici Europe/Paris, lors de formatage de date en php, on se retrouve à ajouter une fois de trop 1h ou 2h
// donc en lui disant "UTC" il ne fait pas d'ajout et nous laisse les heures comme elle devrait être
// La bonne solution serait sûrement de convertir toutes les dates de notre base en UTC et de faire les opérations ensuite pour la présentation à l'affichage
date_default_timezone_set('UTC');

ini_set('short_open_tag','1'); // on utilise encore par ci par là la notation < ? print(1); ? > qui a besoin de cette option
ini_set('date.timezone','Europe/Paris');
// NOTE: j'aurais aimé tout mettre ici, par exemple la taille max de fichier qu'on peut envoyer, mais ça n'est pas pris en compte par php, voir le fichier .user.ini

// option de développement et debug 
ini_set('error_reporting', E_ERROR); // par défaut, pas d'erreur php à l'écran, développeurs : utilisez vore config_privee.php pour définir vos propres options
ini_set('display_errors', '0');
$config_wri['debug']=false; // cette option contrôle des sorties avec plus d'info mais un peu privée comme requêtes SQL et variables, mettez à true dans votre fichier privee

// Ce fichier est privée et contient des différentes mot de passe à garder secret ou options spécifique à cette installation de refuges.info
// que l'on ne souhaite pas du tout voir atterrir sur github, il est donc indiqué dans le .gitignore 
// il est volontairement placé "presque" à la fin pour que les variables ci-avant puissent par exemple être remplacées si on souhaite un autre comportement
require_once($config_wri['racine_projet']."config_privee.php");

// Repli si config_privee.php ne contient pas les données du serveur, on va les chercher dans /forum/config.php
if (file_exists ($config_wri['racine_projet']."/forum/config.php") &&
	(!isset ($config_wri['serveur_pgsql']) || !$config_wri['serveur_pgsql'] || $config_wri['serveur_pgsql']=="???")) {
  require($config_wri['racine_projet']."/forum/config.php");
  $config_wri['serveur_pgsql']=$dbhost;
  $config_wri['utilisateur_pgsql']=$dbuser;
  $config_wri['mot_de_passe_pgsql']=$dbpasswd;
  $config_wri['base_pgsql']=$dbname;
}

/*** N'ajoutez rien *** après ce require_once("config_privee.php"); sauf si vous savez pourquoi, car ajouter après empêche de "surdéfinir" certaines variables du fichier privé à chaque instance ci avant mettez par contre tout ce que vous voulez avant le require_once("config_privee.php"); ***/
