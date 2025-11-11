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

// Ceci est le chemin relatif à la racine web d'accès au projet wri : / si on est à la racine ou /mon/installation/ par exemple. Doit finir par un "/".
if (isset($_SERVER['DOCUMENT_ROOT']))
  $config_wri['sous_dossier_installation']=str_replace($_SERVER['DOCUMENT_ROOT'],"",$config_wri['racine_projet']);
else
  $config_wri['sous_dossier_installation']='/'; // si on est appelé depuis la ligne de commande, $_SERVER['DOCUMENT_ROOT'] n'existe pas, on suppose "/" mais en vrai, on s'en fiche un peu car en ligne de commande aucun de ces chemins de devrait servir

$config_wri['rep_web_photos_points']=$config_wri['sous_dossier_installation']."photos_points/";
$config_wri['rep_photos_points']=$config_wri['racine_projet']."photos_points/";
$config_wri['url_chemin_vues']=$config_wri['sous_dossier_installation']."vues/";
$config_wri['chemin_vues']=$config_wri['racine_projet']."vues/";
$config_wri['chemin_modeles']=$config_wri['racine_projet']."modeles/";
$config_wri['chemin_controlleurs']=$config_wri['racine_projet']."controlleurs/";
$config_wri['chemin_routes']=$config_wri['racine_projet']."routes/";

$config_wri['url_chemin_images']=$config_wri['sous_dossier_installation']."images/";
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

// Liste des icône de base pour nos types de point de base, va être utilisé comme case à cocher à gauche de la carte
$config_wri['correspondance_type_icone'] = [
	'batiment-en-montagne' => 'cabane_white_black_a63',
	'cabane-non-gardee' => 'cabane',
	'gite-d-etape' => 'cabane_green',
	'lac' => 'lac',
	'passage-delicat' => 'triangle_a33.10',
	'point-d-eau' => 'pointdeau',
	'refuge-garde' => 'cabane_red',
	'grotte' => 'grotte',
];

// Liste des autres icônes utilisées dans les cartes : n'est utilisée que pour l'export kml dont la liste des icônes doit être définie comme style en en-tête de fichier
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
$config_wri['chemin_ol']=$config_wri['racine_projet'].'myol/dist/';
$config_wri['url_chemin_ol']=$config_wri['sous_dossier_installation'].'myol/dist/';

// En version opérationnelle, deviendra www.refuges.info, mais permet aux zones de dev sur d'autres domaine d'être plus dynamique. Si cette variable n'est pas définie on utilise du vide.
$config_wri['nom_hote'] = $_SERVER['HTTP_HOST'] ?? '';

// Permet d'ajouter le chemin des includes et des modeles au path de recherche, ainsi, il suffit d'inclure le config.php
// afin de pouvoir faire des require_once('modele.php');
// ATTENTION ! on pourait être tenté de faire de même pour les controlleurs et les vues, mais les conflits en nom identiques seraient trop important
ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$config_wri['chemin_modeles'].PATH_SEPARATOR.$config_wri['chemin_routes'].PATH_SEPARATOR.__DIR__);

/********** photos / images points ************/
// Liste des formats de photo autorisées pour la fonction exif_imagetype()
$config_wri['format_photo_autorisees']=array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP, IMAGETYPE_BMP);
// Liste des format des extensions de fichiers photo que l'on accepte de garder sur le disque comme "photo originale"
$config_wri['extensions_fichier_photo']=array("jpeg", "png", "webp", "bmp");
$config_wri['texte_des_formats_photo_autorisee']="jpeg, png, bmp ou webp";

$config_wri['largeur_max_photo']=700;
$config_wri['hauteur_max_photo']=600;
$config_wri['largeur_max_vignette']=140;
$config_wri['hauteur_max_vignette']=140*3/4;
$config_wri['qualite_jpeg']=80;


/***** En rapport avec les questions anti-robots ou captcha : sly 07/2024 : ok, je vous vois venir, vous vous dites que c'est trop nul une question qui ne change jamais, que c'est trop facile, que chatgpt il connait la réponse avant d'avoir lu la question, que recaptcha/google cloudflaire c'est tellement mieux.
Et bien dites vous que ce système est en place depuis 10 (?) ans, a nécessité 2 minutes de travail, se résoud par un humain normal en une touche, et n'a jamais été craké jusqu'à.... maintenant, le 23/07/2024 quelqu'un a enfin trouvé la "réponse d".
Je vous invite à lire le livre que je n'ai pas encore écrit intitulé "De l'analogie numérique à la survie darwinienne en milieu viral du simple mais tout seul contre le tous complexes"
Alors avant de tout remettre en cause, je rend ça paramétrique et on voit s'il passe toujours, si oui, je cèderais peut-être au terrorisme.
****/
$config_wri['captcha_question']="Entrez la lettre <strong>g</strong>";
$config_wri['captcha_reponse']="g";

/********** posts dans la page points ************/
$config_wri['point_posts_nb_max_post'] = 4;
$config_wri['point_posts_lon_max_text'] = 250;

/********** id internes liés à certains éléments remarquables de la base. Merci d'éviter les numéros en dur dans le code, car si ça doit changer, c'est jeu de la fourmis ************/
// sly  27/04/06 je préfère me baser sur l'id pour le retrouver plutôt que son type ( que je viens d'ailleurs de modifier )
$config_wri['id_massif']=1; //rff 21/03/06 : id du type de polygone correspondant aux 'massifs'
$config_wri['id_carte']=3; //sly : id du type de polygone correspondant aux 'cartes papier'
$config_wri['id_zone']=11; // jmb : grandes zones, alpes, pyrenees, massif central, ile de la réunion ... 
$config_wri['id_zone_reglementee']=12; // sly 2020 : réserves natuelles, réserves biologique, parcs nationaux.
$config_wri['id_region_naturelle']=20;
$config_wri['id_departement']=10;

$config_wri['bbox_page_accueil']='-1.75,41.4,11,49.2';

// C'est clair que c'est bizarre de mettre ces ids en dur, mais à certain endroits c'est bien pratique voire dur de faire autrement qu'interroger le bon id directement
$config_wri['id_passage_delicat']=3;
$config_wri['id_cabane_non_gardee']=7; 
$config_wri['id_gite_etape']=9;
$config_wri['id_refuge_garde']=10; 
$config_wri['id_point_d_eau']=23;
$config_wri['id_batiment_en_montagne']=28;
$config_wri['id_grotte']=29;

// Catégorie "tout type de refuges" ( ce sont les ids des refuges gardés, non gardés, gîtes)
// certes une gestion par catégorie directement dans la base serait préférable, mais en 2024 on a 1 seules catégorie donc, bon...
$config_wri['tout_type_refuge']=array($config_wri['id_cabane_non_gardee'],$config_wri['id_gite_etape'],$config_wri['id_refuge_garde']);

// Catégorie "tout type d'abris, pareil qu'avant, les grottes en plus
$config_wri['tout_type_d_abri']=array_merge($config_wri['tout_type_refuge'],array($config_wri['id_grotte']));

//là aussi ça parait crétin de stocker ça en dur, alors qu'il y a bien une technique pour lister dynamiquement le nom des champs, et ben, allez savoir pourquoi, chez postgres, cette méthode bouffe ~10ms !! Vu que je m'en sers plusieurs fois en plus, quitte à en arriver là, je l'écris ici et zou
//pensez à ajouter vous même à la main "geom" si vous voulez la géométrie, car c'est justement là le but de ne pas mettre "*" : éviter de récupérer la géométrie pour rien
$config_wri['champs_table_polygones']='polygones.id_polygone,polygones.id_polygone_type,polygones.article_partitif,polygones.nom_polygone,polygones.source,polygones.message_information_polygone,polygones.url_exterieure,polygones.site_web';

// Champs valables pour les points classés par spécificité (permet de dynamiquement gérer en partie le formulaire de saisie et d'affichage)
$config_wri['champs_trinaires_points']=array('couvertures','manque_un_mur','eau_a_proximite','latrines','poele','cheminee','bois_a_proximite'); // ceux là sont des champs ou ne sait pas/oui/non sont possible (traiter dynamiquement dans une boucle)
$config_wri['champs_entier_ou_sait_pas_points']=array('places','places_matelas');
$config_wri['champs_simples_points']=array_merge(array('conditions_utilisation','places','places_matelas',"cache","nom","acces","remark","proprio","id_point_type","id_createur","modele","altitude","id_type_precision_gps",'nom_createur'),$config_wri['champs_trinaires_points'],$config_wri['champs_entier_ou_sait_pas_points']);

// c'est l'id pour lequel les coordonnées gps données sont volontairement fausses
$config_wri['id_coordonees_gps_fausses']=5;
// c'est l'id pour lequel les coordonnées gps données sont approximatives
$config_wri['id_coordonees_gps_approximative']=4;


/********** choix de maximums ************/

// nombre maximum de points que peut sortir la recherche
$config_wri['points_maximum_recherche']=40;

// nombre de points renvoyés par défaut, par l'API
$config_wri['defaut_max_nombre_point']=250;

// nombre de commentaires ou de point ajouté tels que présentés sur la page d'accueil
$config_wri['defaut_max_commentaires_recents']=10;
$config_wri['defaut_max_ajouts_recents']=10;

// nombre de lignes renvoyées par défaut sur la page nouvelle
$config_wri['defaut_nombre_nouvelles_page_nouvelles']=100;

// distance d'une cabane cachée à laquelle on ne peut pas créer d'autres cabanes
$config_wri['defaut_max_distance_cabane_cachee']=100; // en mètres


/********** Lié au Forum / comptes / utilisateurs / login / users ************/
// lien direct pour se connecter, ou créer un compte sur le forum
$config_wri['connexion_forum']=$config_wri['lien_forum']."ucp.php?mode=login";
// lien vers le profil d'un utilisateur
$config_wri['fiche_utilisateur']=$config_wri['lien_forum']."memberlist.php?mode=viewprofile&u=";
$config_wri['forum_refuge']=$config_wri['lien_forum']."viewtopic.php";

// l'id de catégories spéciales du forum (que l'on veut voir s'afficher sur la page des nouvelles)
$config_wri['id_forum_vie_du_site']=1;
$config_wri['id_forum_des_refuges']=4;
$config_wri['ids_forum_pour_les_nouvelles']=$config_wri['id_forum_des_refuges'];

$config_wri['encodage_exportation']="utf-8";
$config_wri['encodage_des_contenu_web']=$config_wri['encodage_exportation'];

$config_wri['url_nominatim']="//nominatim.openstreetmap.org/";
$config_wri['url_appel_nominatim']=$config_wri['url_nominatim'] . "search.php?";
$config_wri['email_contact_nominatim']="sylvain@refuges.info";

// Signalement aux modérateurs des messages de réservation (On peut aussi le compléter de la config_privee type $config_wri['censure'].="|nombreux")
$config_wri['censure']="reservat|reserver|fete|noel|l\'an |l\'an$|reveillon|prevenir|previen";

// Mots clés interdits dans les commentaires (le commentaire sera refusé). Par défaut vide, mais en urgence on peut en ajouter dans la config_privee type $config_wri['mots_interdits'].="|credit-immobilier-pas-cher.fr"
// C'est une méthode de défense assez peu efficace contre les robots, mais peut décourager les commentateurs humains
$config_wri['mots_interdits']="";

// tableau contenant les formats possibles pour exporter des points par l'API et une descripion courte (sly: j'hésite à y mettre un paté d'explication, mais ça fait un peu lourd à maintenir)
// La vue qui doit être choisie est /vues/api/points.vue.$format. L'ordre pourra déterminer l'ordre proposé à l'internaute

$config_wri['api_format_points'] = Array 
( 
'gpx' => "gpx (Complet, pour logiciel type osmand, marble, ...)",
'gpx_garmin' => "gpx (compatible basecamp/mapsource/viking/...)",
'gpx_simple' => "gpx simplifié (sans remarques et accès)",
'kml' => "kml (googlearth et plusieurs applications smartphone )",
'gml' => "Geography Markup Language",
'csv' => "csv (tableurs)",

'xml' => "xml Spécifique à notre base, exhaustif",
'json' => "JSON",
'geojson' => "GeoJSON"
);
    
/******** Nom du fichier contenant les points exportés **********/
$config_wri['nom_fichier_export']="refuge-info";

/******** Paramètres de l'API **********/
$config_wri['autoriser_CORS']=TRUE; // Autoriser les requêtes AJAX sur notre API
$config_wri['copyright_API']="The data included in this document is from www.refuges.info. The data is made available under CC By-Sa 2.0";

// ******* options php *******
setlocale(LC_TIME, "fr_FR.UTF-8"); // Pour avoir les affichage de date en french et en UTF-8
// Pour l'instant, en statique mais le jour ou on passera en multi-langue, on pourra ici choisir les chaines de caractères générées (en 2024 les dates inclus les jours et mois en français
$config_wri['langue']="fr_FR";

// Timezone par défaut pour choisir l'affichage des dates+heures
$config_wri['timezone']='Europe/Paris';

mb_internal_encoding("UTF-8");



ini_set('short_open_tag','1'); // on utilise encore par ci par là la notation < ? print(1); ? > qui a besoin de cette option
ini_set('date.timezone',$config_wri['timezone']);
// NOTE: j'aurais aimé tout mettre ici, par exemple la taille max de fichier qu'on peut envoyer, mais ça n'est pas pris en compte par php, voir le fichier .user.ini

// option de développement et debug 
ini_set('error_reporting', E_ERROR); // par défaut, pas d'erreur php à l'écran, développeurs : utilisez vore config_privee.php pour définir vos propres options
ini_set('display_errors', '0');
$config_wri['debug']=false; // cette option contrôle des sorties avec plus d'info mais un peu privée comme requêtes SQL et variables, mettez à true dans votre fichier privee

// Ce fichier est privée et contient des différentes mot de passe à garder secret ou options spécifique à cette installation de refuges.info
// que l'on ne souhaite pas du tout voir atterrir sur github, il est donc indiqué dans le .gitignore 
// il est volontairement placé "presque" à la fin pour que les variables ci-avant puissent par exemple être remplacées si on souhaite un autre comportement
// DOM 11/25 on force l'inclusion de config_privee car il y a des cas (forum) où il a déjà été appelé
include($config_wri['racine_projet']."config_privee.php");

/*** N'ajoutez rien *** après ce require_once("config_privee.php"); sauf si vous savez pourquoi, car ajouter après empêche de "surdéfinir" certaines variables du fichier privé à chaque instance ci avant mettez par contre tout ce que vous voulez avant le require_once("config_privee.php"); ***/
