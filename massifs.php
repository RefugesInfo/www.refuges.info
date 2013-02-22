<?php 
// Ecran d'accueil (massifs disponibles)

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 10/03/06 rff : déplacement échelle à droite en bas de l'image. Ajout instr. de libération query sql
// 21/03/06 rff : Insertion infos de session : utile pour gestion du cache & menu gestion. Ajout layer 'polygones'
// 06/11/10 Dominique : Passage sur les cartes Openlayers
// 20/12/10 Dominique : Retour en GoogleMap API V2
// 04/10/11 Dominique : Gestion multicartes
// 08/10/11 Dominique : Utilisation des templates
// 08/05/12 Dominique : Retour en modeles simples
// 15/02/13 jmb : page redondante avec NAV ? 
// --> Oui, clairement, il faut qu'on se débarrasse de ce trucs et que les zones soient des polygones comme les autres gérés par nav.php sly 16/02/2013

require_once ("modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_bdd.php");

$modele = new stdClass();
$modele->titre = 'Carte et informations sur les refuges, cabanes et abris de montagne';
$modele->java_lib [] = 'http://maps.google.com/maps/api/js?v=3&amp;sensor=false';
$modele->java_lib [] = '/ol2.12.1.3/OpenLayers.js';

/*
$zones = Array ( //                  [left, bottom, right, top]
	'Alpes ouest'          => Array (  4.1,  42.5,  10.8,  47.1),
	'Alpes est'            => Array (  9  ,  45.5,  15  ,  47  ),
	'Pyrénées'             => Array ( -2  ,  42  ,   4.5,  46  ),
//	'Cordillère des Andes' => Array (-81  , -56  , -56  ,  10  ),
);
*/
$zones = Array ( //     [gauche, bas, droit, haut]
	'Europe'           => Array ( -2  , 41.3, 15  ,  49  ),
	'Alpes'            => Array (  5  , 43  , 12  ,  47.5),
	'Alpes orientales' => Array (  8  , 45.3, 15  ,  47.4),
	'Massif Central'   => Array (  1.5, 43.3,  4.9,  46.5),
	'Pyrénées'         => Array ( -1.5, 42  ,  2.7,  43.4),
);

// Lecture de tous les massifs
$q_select_mass= "
	SELECT *
	FROM polygones
	WHERE id_polygone_type=".$config["id_massif"]."
		AND id_polygone != ".$config['numero_polygone_fictif'];
//echo $q_select_mass ;
$r_select_mass = $pdo->query($q_select_mass) or die("mauvaise requete dans GMmasscreemassifs: $q_select_mass");

// Ajoute les liens vers les autres zones
foreach ($zones as $nom => $c)
	if (strtolower (replace_url ($nom)) == strtolower (replace_url ($_GET['zone'])) ||
		!$zone && !$_GET['zone']) // Par défaut, on affiche la première zone
		$zone = $nom;
	else
		$modele->massifs [$nom] = '?zone='.replace_url ($nom);

// Ajoute les liens vers les massifs qui ne sont pas dans une zone
while ($polygone = $r_select_mass->fetch()) {
	$in = false;
	foreach ($zones as $c)
	  if (
		$polygone->longitude_maximum > $c [0] && // S'il est hors du périmètre de la zone
	    $polygone->latitude_maximum  > $c [1] &&
	    $polygone->longitude_minimum < $c [2] &&
	    $polygone->latitude_minimum  < $c [3]
	    )
	    $in = true;
	if (!$in)
		$modele->massifs [$polygone->nom_polygone] = lien_polygone ($polygone->nom_polygone, $polygone->id_polygone, 'Massif');
}

// Réinitialise les paramètres de réaffichage des pages suivantes, notamment la couche par défaut = Google
setcookie ('Olparams', '', time() - 3600, '/');

//echo'<pre>'.var_export($_COOKIE,true).'</pre>';

// On affiche le tout
$modele->type = 'massifs';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
