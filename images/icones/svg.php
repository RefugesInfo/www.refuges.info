<?php /*
Cet utilitaire produit toutes les icônes SVG utilisées par les cartes

Syntaxe :
	/images/icones/debut-du-nom-<element>_<element>_<element>.[svg|png]

Chaque <element> désigne une forme élémentaire :
	bus
	cabane
	camping
	pointdeau (icône toute seule)
	lac
	parking
	ravitaillement
	sommet
	triangle (pour passage délicat)

ou une surcharge :
	cle
	eau (petite goutte d'eau)
	feu (cheminée et fumée)
	manqueunmur
	x (une grande croix noire)

ou une ou deux couleurs CSS :
La première est la couleur de l'icône, la deuxième celle du toit et des murs
	white_black (bâtiment à face blanche, contour et toits noirs)
	blue (bâtiment bleu)
	green (gîte)
	red (refuge gardé)

ou
	a123.4.5 (caractère Ascii décimal &#123; à la position x = 4, y = 5)
	t123 (taille de l'icône 123*123 - défaut 24)
*/

// Traduit le nom si nécéssaire
include ('alias.php');
$nom = isset ($alias[$_GET['nom']]) ? $alias[$_GET['nom']] : $_GET['nom'];

// Recherche les éléments à afficher dans le nom du fichier
preg_match_all ('/([a-z]+)([0-9]*)\.?([0-9]*)\.?([0-9]*)_/', $nom.'_', $elements);

// Elements par defaut
$taille = 24;
$premier_element = $elements[1][0];
$couleurs = [0]; // On initialise l'iondex 0 pour que la première couleur commence à 1

// Le premier élément est obligatoirement affichable
if (!file_exists("elements/$premier_element.svg"))
	$elements[1] = ['_404'];

// Parcours des éléments
foreach ($elements[1] AS $k => $element) {
	// Ascii a123.4.5 = caractère &#123; à la position x = 4, y = 5
	if ($element == 'a') {
		$ascii = intval ($elements[2][$k]) ?: 32; // Extrait le code décimal
		$x_ascii = $elements[3][$k] ? $elements[3][$k] : 7.6;
		$y_ascii = $elements[4][$k] ? $elements[4][$k] : 21.5;
	}

	// On enlève la porte dans certains cas
	if (in_array ($element, ['a','eau','manqueunmur']))
			$premier_element = false;

	// t24 définit une taille de l'icone SVG 24x24 pixels
	if ($element == 't')
		$taille = $elements[2][$k];
	else
	// Alors, ça doit être une couleur
	if (!file_exists("elements/$element.svg")) {
		$couleurs[] = $element;
		$premier_element = false;
	}
}

// Force 2 valeurs nulles pour faciliter le test dans les templates
$couleurs[] = $couleurs[] = null;

// Ajoute un élément porte avant les autres
if ($premier_element == 'cabane')
	array_splice ($elements[1], 1, 0, ['porte']);

// Génération du fichier SVG
header ('Content-type: image/svg+xml');
//header ('Content-type: text/html'); // Debug
header ('Cache-Control: max-age=86000');
header ('Access-Control-Allow-Origin: *');
if ($elements[1][0] == '_404')
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

include ("_head.svg");

foreach ($elements[1] AS $element)
	if (file_exists("elements/$element.svg")) {
		echo PHP_EOL; // Jolie mise en page du fichier .svg
		include ("elements/$element.svg");
	}

include ("_tail.svg");
