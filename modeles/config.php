<?php
/*************************************************
Constantes de configuration, plus propre qu'en dur
*************************************************/

/******** Paramètrage des cartes vignettes des fiches de points **********/
//$config['carte_base'] = 'maps.refuges.info';
$config['carte_base'] = 'Google';
$config['cartes_vignettes'] = Array (
//	'Pays'      => Array ('Carte initiale', 'article', 'Carte agrandie', échelle),
	'France'    => Array ($config['carte_base'], ''      , 'IGN',          50000),
	'Suisse'    => Array ($config['carte_base'], ''      , 'SwissTopo',    50000),
	'Italie'    => Array ($config['carte_base'], 'de l\'', 'Italie',      100000),
	'Espagne'   => Array ($config['carte_base'], 'de l\'', 'Espagne',      25000),
	'Andorre'   => Array ($config['carte_base'], ''      , 'IGN',          25000),
//	'Argentina' => Array ('Google'          , ''      , 'OpenCycleMap', 50000),
	'Autres'    => Array ($config['carte_base'], ''      , 'OpenCycleMap', 50000),
);

/******** Clés des contrats des cartes **********/
// Dominique 09/05/2012. Déplacées de /includes/fonctions_gmaps.php
$config['gmaps_key']="";// Obsolète en GG V3

$config['ign_key']=""; // ID contrat 0004365 / Expire le 31/08/2013 / http://professionnels.ign.fr/user/393960/orders

// cartes anglaises
$config['os_key']=""; // User cavailhezd / http://openspace.ordnancesurvey.co.uk

// Accès MySQL : réglages de production
// si une zone développement doit un jour voir le jour, on pourra mettre un if pour choisir entre prod et dév
$config['utilisateur_mysql']="user";
$config['mot_de_passe_mysql']="pass";
$config['serveur_mysql']="localhost";
$config['base_mysql']="refuges";

// voici les mensurations des taille des photos afficher sur le site ( pour éviter une guirlande )
$config['largeur_max_photo']=700;
$config['hauteur_max_photo']=600;
$config['largeur_max_vignette']=140;
$config['hauteur_max_vignette']=140*3/4;
$config['qualite_jpeg']=80;

//sly 27/04/06 quelques variable afin d'éviter de mettre des chemins un peu partout
$config['document_root']=$_SERVER['DOCUMENT_ROOT']."/";
$config['rep_web_photos_points']="/photos_points/";
$config['rep_photos_points']=$config['document_root'].$config['rep_web_photos_points']; 
$config['chemin_vues']=$config['document_root']."vues/"; 
$config['chemin_modeles']=$config['document_root']."modeles/"; 
$config['chemin_controlleurs']=$config['document_root']."controlleurs/"; 

$config['url_chemin_icones']="/images/icones/";
$config['chemin_icones']=$config['document_root'].$config['url_chemin_icones'];

$config['404_page']=$config['document_root']."/statique/erreur_404.php";

$config['textes_mode_emploi']=$config['document_root']."/statique/mode_emploi_textes/";

//jmb 04/07 on continue avec des rep de moderation
$config['rep_moder_photos_backup']=$config['document_root']."/gestion/sauvegardes-photos/"; 
$config['rep_forum_photos']=$config['document_root']."/forum/photos-points/"; 
$config['rep_web_forum_photos']="/forum/photos-points/"; 

// sly  27/04/06 je préfère me baser sur l'id pour le retrouver plutôt que son type ( que je viens d'ailleurs de modifier )
$config['id_massif']="1"; //rff 21/03/06 : id du type de polygone correspondant aux 'massifs'
$config['id_carte']="3"; //sly : id du type de polygone correspondant aux 'cartes papier'


// Catégorie "tout type de refuges"
// certes une gestion par catégorie directement dans la base serait préférable, mais on a au plus 1 ou 2 catégorie donc, bon,
// à la main dans la config : ( ce sont les id des refuges gardés, non gardés et gites)
$config['tout_type_refuge']="7,9,10";

// C'est clair que c'est nul, mais à certain endroits c'est bien pratique voire dur de faire autrement qu'intéroger le bon id directement
$config['id_cabane_gardee']="7";
$config['id_refuge_garde']="10";
$config['id_gite_etape']="9";

$config['champs_binaires_simples_points']=array('couvertures','eau_a_proximite','bois_a_proximite','latrines','sommaire','poele','cheminee','clef_a_recuperer');
$config['champs_binaires_points']=array_merge(array('ferme','matelas'),$config['champs_binaires_simples_points']);
$config['champs_simples_points']=array_merge(array("nom","places","remark","proprio","id_point_type","id_createur","modele","id_point_gps",'places_matelas','nom_createur'),$config['champs_binaires_points']);

// les numéros d'id spéciaux qu'on trouve dans les bases
// avec ça c'est une news générale
$config['numero_commentaires_generaux']=-2;
// ça, c'est le polygone "qui n'existe pas" et qui contient les points dans aucuns polygone de même type, 
// on pourrait appeler ça "la vallée" pour les massif, le néant pour les cartes
$config['numero_polygone_fictif']=$config['numero_massif_fictif']=0;

//nombre maximum de point que peut sortir la recherche
$config['points_maximum_recherche']=40;
// c'est l'id pour lequel les coordonnées gps données sont volontairement fausses
$config['id_coordonees_gps_fausses']=5;
// c'est l'id pour lequel les coordonnées gps données sont approximatives
$config['id_coordonees_gps_approximative']=4;

/********** truc sur le Forum ************/
// des fois qu'on décide de re-bouger le forum, on ne le changera qu'ici
$config['lien_forum']="/forum/";
// lien direct pour se connecter, ou créer un compte sur le forum
$config['connexion_forum']=$config['lien_forum']."login.php";
// lien vers le profil d'un utilisateur
$config['fiche_utilisateur']=$config['lien_forum']."profile.php?mode=viewprofile&amp;u=";
$config['forum_refuge']=$config['lien_forum']."viewtopic.php?t=";

// l'id des modérateurs du forum, pour qu'ils puissent devenir modérateur du site
$config['id_forum_moderateur']=7;
$config['id_forum_developpement']=2;
$config['encodage_exportation']="utf-8";
$config['encodage_des_contenu_web']=$config['encodage_exportation'];


/******** Nom du fichier contenant les points exportés **********/
$config['nom_fichier_export']="refuge-info";

$config['message_licence']="
<p>
	L'information que vous allez rentrer <a href=\"/statique/mode_emploi.php?page=restriction_licence\">sera soumise à la licence creative commons by-sa</a>
</p>
";
$config['lien_syntaxe']="<a href=\"/statique/mode_emploi.php?page=syntaxe_bbcode\">Syntaxe possible</a> (bouton du milieu pour nouvel onglet)";

// indispensable pour avoir les affichage de date en french et en UTF-8
setlocale(LC_TIME, "fr_FR.UTF-8");
