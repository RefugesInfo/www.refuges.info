<?php
/* Cet utilitaire produit toutes les icônes SVG utilisées par les cartes
/images/icones/debut-du-nom-<code>_<code>_<code>.svg ou .png
Chaque <code> désigne une forme élémentaire :

Le premier est obligatoirement le nom complet de l'icône
	bus
	cabane
	camping
	eau (point d'eau)
	lac
	parking
	ravitaillement
	sommet
	triangle (passage délicat)

Un premier champ du nom d'une couleur CSS génère une icône en forme de bâtiment de cette couleur
	black (bâtiment à contour et toits noirs, face blanche)
	blue (bâtiment bleu)
	green (gîte)
	red (refuge gardé)

les suivants définissent les surcharges
	cle
	eau (petite goutte d'eau)
	feu (cheminée et fumée)
	manqueunmur
	x (une grande croix noire)
	a123 le caractère ascii 123 (en décimal)

le dernier (facultatif)
	t123 (taille de l'icône 123*123 - défaut 24)
*/

//-------------------------------------
$alias = [
	// Icônes refuges.info
	// Tableau de correspondance temporaire
	// A retirer quand tous les noms des icones auront été codés
	// TOREFLECHIR : sly 2021-03-04 : de notre site seul l'export kml s'en sert encore, je pense corriger ça, mais j'hésite à le garder quand même pour la compatiblité des autres sites qui utiliseraient encore cette syntaxe ?
	// DOM : je pense que non, la compatibilité serait plutôt un site qui aurait ses propres icônes ancien-point-d-eau.png et qui n'aurait pas les nouveaux noms
	'ancien-point-d-eau' => 'eau_x',
	'batiment-en-montagne' => 'black_a63',
	'batiment-inutilisable' => 'black_x',
	'cabane-avec-eau' => 'cabane_eau',
	'cabane-avec-moyen-de-chauffage' => 'cabane_feu',
	'cabane-avec-moyen-de-chauffage-et-eau-a-proximite' => 'cabane_eau_feu',
	'cabane-cle' => 'cabane_cle',
	'cabane-eau-a-proximite' => 'cabane_eau',
	'cabane-non-gardee' => 'cabane',
	'cabane-sans-places-dormir' => 'cabane_a48',
	'gite-d-etape' => 'blue',
	'inutilisable' => 'black_x',
//	'lac' => 'lac',
	'passage-delicat' => 'triangle_a33',
	'point-d-eau' => 'eau',
	'refuge-garde' => 'red',
//	'sommet' => 'sommet',

	// Favicon
	'favicon' => 'cabane_feu_t384',

	// Equivalence des anciens .png
	'abri' => 'cabane_manqueunmur',
	'cabane-manque-un-mur' => 'cabane_manqueunmur',

	// Icônes Overpass, C2C & PRC (remplacer ' ' par %20 dans l'URL)
	// Il s'agit en fait d'une équivalence des symboles geocaching utilisés par les GPS
	'Campground' => 'camping',
	'City Hall' => 'blue', // Hôtel ou location
	'Crossing' => 'black_x', // Fermé
	'Drinking Water' => 'eau',
	'Fishing Hot Spot Facility' => 'cabane_manqueunmur', // Manque un mur
	'Ground Transportation' => 'bus',
	'Lodge' => 'cabane',
	'Parking Area' => 'parking',
	'Shopping Center' => 'ravitaillement', // Ravitaillement
	'Summit' => 'sommet',
	'Tunnel' => 'cabane_manqueunmur', // Orri
	'Water Source' => 'eau',
	'Waypoint' => 'triangle_a33',
];
if (isset ($alias[$_GET['nom']]))
	$_GET['nom'] = $alias[$_GET['nom']];

//------------------------------------------------------
// On va rechercher les arguments dans le nom du fichier
preg_match_all ('/([a-z]+)([0-9]*)_/', $_GET['nom'].'_', $matches);

$taille = 24;
$nbc = count ($matches[0]) - 1;
if ($matches[1][$nbc] == 't' &&
	is_numeric ($matches[2][$nbc]))
	$taille = $matches[2][$nbc];

$icone = array_shift ($matches[1]); // On enlève le premier code

//-----------------------
// Génération du code SVG
$svg = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" height=\"$taille\" width=\"$taille\">";

switch ($icone) {
	case 'bus':
		$svg .= "
	<path d=\"M0.5 7 l21.5 0, 1.5 5, -23 0 z\" stroke-linejoin=\"round\" stroke=\"black\" fill=\"#99FFFF\" />
	<path d=\"M3 7 l0 5, 4 0, 0 -5, 4 0, 0 5, 4 0, 0 -5, 4 0, 0 5\" stroke=\"black\" fill=\"none\" />
	<path d=\"M0.5 12.4 l23 0, 0 5.5, -23 0 z\" stroke-linejoin=\"round\" stroke=\"black\" fill=\"yellow\" />
	<ellipse cx=\"4.5\" cy=\"18.5\" rx=\"2\" ry=\"2\" stroke=\"black\" fill=\"grey\" />
	<ellipse cx=\"19\" cy=\"18.5\" rx=\"2\" ry=\"2\" stroke=\"black\" fill=\"grey\" />
";
	break;

	case 'eau':
		$svg .= "
	<ellipse cx=\"12\" cy=\"15\" rx=\"6.75\" ry=\"6.75\" stroke-width=\"0.75\" stroke=\"#005e5e\" fill=\"cyan\" />
	<ellipse cx=\"12\" cy=\"15\" rx=\"4.5\" ry=\"4.5\" stroke-width=\"0\" fill=\"#005e5e\" />
	<ellipse cx=\"13\" cy=\"14\" rx=\"4.5\" ry=\"4.5\" stroke-width=\"0\" fill=\"cyan\" />
	<path d=\"M6.3 11.4 l5.7 -10,5.7 10\" stroke-width=\"0.75\" stroke=\"#005e5e\" fill=\"cyan\" />
";
	break;

	case 'camping':
		$svg .= "
	<path d=\"M1.75 23 l12.8 -22.5,-2.5 4.5,-2.5 -4.5,12.7 22.5\" stroke-width=\"2\" stroke=\"red\" fill=\"yellow\" />
";
	break;

	case 'lac':
		$svg .= "
	<ellipse cx=\"7.5\" cy=\"9\" rx=\"6\" ry=\"4.5\" stroke=\"#204A87\" fill=\"#204A87\" />
	<ellipse cx=\"13.5\" cy=\"13.5\" rx=\"9\" ry=\"4.5\" stroke=\"#204A87\" fill=\"#204A87\" />
	<ellipse cx=\"11\" cy=\"12\" rx=\"9\" ry=\"4.5\" stroke=\"#204A87\" fill=\"#204A87\" />
";
	break;

	case 'sommet':
		$svg .= "
	<path d=\"M0 26 l8 -17,3 5,5 -12,8 24\" stroke=\"white\" fill=\"#583E24\" />
";
	break;

	case 'parking':
		$svg .= "
	<path d=\"M4 3 l16 0, 0 18, -16 0 z\" stroke-width=\"1.5\" stroke-linejoin=\"round\" stroke=\"white\" fill=\"#064CA0\" />
	<text x=\"6.1\" y=\"18.5\" font-size=\"18px\" font-family=\"sans-serif\" fill=\"white\">P</text>
";
	break;

	case 'ravitaillement':
		$svg .= "
	<ellipse cx=\"12\" cy=\"9\" rx=\"4\" ry=\"4\" stroke-width=\"3\" stroke=\"black\" fill=\"grey\" />
	<path d=\"M1 9 l4 10,12 0,6 -10\" stroke-width=\"3\" stroke=\"black\" fill=\"grey\" />
";
	break;

	case 'triangle': // Passage délicat
		$svg .= "
	<path d=\"M1.75 23 l10.3 -18,10.2 18 Z\" stroke-width=\"2\" stroke=\"red\" fill=\"white\" />
";
	break;

	case 'black': // Bâtiment à contour et toits noirs, face blanche
		$couleur = 'white';

	case 'blue': // Bâtiment bleu (hotel)
	case 'green': // Gîte
	case 'red': // Refuge gardé
		if (!isset ($couleur))
			$couleur = $icone;
		$couleur_toit = $icone;
		$couleur_mur = $icone;

	case 'cabane':
		if (!isset ($couleur)) {
			$couleur = '#ffeedd';
			$couleur_toit = 'red';
			$couleur_mur = '#e08020';
			$porte = true; // Il faudra dessiner une porte
		}
		$svg .= "
	<path d=\"M3 10.7 l0 13,18 0,0 -13\" stroke-width=\"0.5\" stroke=\"$couleur_mur\" fill=\"$couleur\" />
	<path d=\"M1.5 12.3 l10.5 -10.5,10.5 10.5\" stroke-width=\"3\" stroke-linecap=\"round\" stroke=\"$couleur_toit\" fill=\"$couleur\" />
";
	break;

	default: // Bon, ben là, on a tout faux !
		$erreur = true;
}

// Pour les autres codes
foreach ($matches[1] AS $k=>$code)
	switch ($code) {
		case 'a': // Ascii a123
			$ascii = $matches[2][$k+1]; // On extrait le code décimal
			$x = $ascii == 33 ? 9.7 : 7.6; // Le caractère ! est moins large
			if (is_numeric ($ascii)) {
				$svg .= "
	<text x=\"$x\" y=\"21.5\" font-size=\"16px\" font-family=\"sans-serif\">&#$ascii;</text>
";
				$porte = false;
			} else
				$erreur = true;
		break;

		case 'cle':
		$svg .= "
	<ellipse cx=\"19.8\" cy=\"7.8\" rx=\"3\" ry=\"3\" stroke-width=\"2.4\" stroke=\"black\" fill=\"none\" />
	<path d=\"M18 9 l-13.5 13.5,-2.25 -2.25,4.2 -0.45,0.15 -4,3 2.7\" stroke-width=\"2.1\" stroke=\"black\" fill=\"none\" />
";
		$porte = false;
		break;

		case 'eau':
		$svg .= "
	<ellipse cx=\"16.5\" cy=\"19.2\" rx=\"3.4\" ry=\"3.4\" stroke-width=\"0.75\" stroke=\"#005e5e\" fill=\"cyan\" />
	<path d=\"M13.65 17.36 l2.85 -5,2.85 5\" stroke-width=\"0.75\" stroke=\"#005e5e\" fill=\"cyan\" />
";
		$porte = false;
		break;

		case 'feu':
		$svg .= "
	<rect x=\"3\" y=\"2\" width=\"3\" height=\"7\" fill=\"black\" />
	<ellipse cx=\"9.5\" cy=\"2.5\" rx=\"3\" ry=\"2\" stroke=\"#666666\" fill=\"#bbccff\" />
	<ellipse cx=\"14.5\" cy=\"2.7\" rx=\"3.5\" ry=\"2.2\" stroke=\"#666666\" fill=\"#bbccff\" />
	<ellipse cx=\"20\" cy=\"3.5\" rx=\"3.5\" ry=\"3\" stroke=\"#666666\" fill=\"#bbccff\" />
";
		break;

		case 'manqueunmur':
		$svg .= "
	<path d=\"M6 12 l12 0\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke=\"red\" />
	<path d=\"M4.5 17.25 l15 0\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke=\"red\" />
	<path d=\"M4.5 22.5 l15 0\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke=\"red\" />
";
		$porte = false;
		break;

		case 'x': // Croix (barré)
		$svg .= "
	<path d=\"M1 3 l22 20\" stroke-width=\"2\" stroke-linecap=\"round\" stroke=\"black\" fill=\"none\" />
	<path d=\"M1 23 l22 -20\" stroke-width=\"2\" stroke-linecap=\"round\" stroke=\"black\" fill=\"none\" />
";
		break;

		case 't': // Ne pas générer d'erreur quand on defini une taille
		break;

		default: // Bon, ben là, on a tout faux !
			$erreur = true;
	}

if (isset ($porte) && $porte)
	$svg .= "
	<rect x=\"9\" y=\"13.5\" width=\"6\" height=\"10\" stroke=\"none\" fill=\"#e08020\" />
";

if (isset ($erreur))
	$svg .= "
	<rect x=\"0\" y=\"0\" width=\"$taille\" height=\"$taille\" fill=\"red\" />
	<text x=\"0.5\" y=\"9\" font-size=\"9px\" fill=\"white\">Erreur</text>
	<text x=\"4\" y=\"20\" font-size=\"10px\" fill=\"white\">404</text>
";

$svg .= "</svg>";

//---------------------
// Sortie en format SVG
if ($_GET['ext'] == 'svg') {
	header ('Content-type: image/svg+xml');
	header ('Cache-Control: max-age=86000');
	header ('Access-Control-Allow-Origin: *');
	if (isset ($erreur))
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

	echo $svg;
}

//---------------------
// Sortie en format PNG
if ($_GET['ext'] == 'png') {
	header ('Content-type: image/png');
	header ('Cache-Control: max-age=86000');
	header ('Access-Control-Allow-Origin: *');
	if (isset ($erreur))
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

	// Fabrique une image PNG à partir du script SVG
	$image = new Imagick();
	$image->setBackgroundColor(new ImagickPixel('transparent'));
	$image->readImageBlob($svg);
	$image->setImageFormat('png32');
	echo $image;
	$image->clear();
	$image->destroy();
}