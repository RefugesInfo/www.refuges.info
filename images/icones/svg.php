<?php /*
Cet utilitaire produit les icônes SVG utilisées par les cartes

Syntaxe : .../icones/debut-du-nom-<element>_<element>_<element>.svg

Chaque <element> désigne :
- une forme élémentaire (fichier elements/<element>.svg
- une couleur CSS
	la première est la couleur de l'icône (par défaut beige)
	la deuxième celle du toit et des murs (par défaut rouge et marron)
- a123.4.5 (caractère Ascii décimal &#123; à la position x = 4, y = 5)
- t123 (taille de l'icône 123*123) défaut 24
*/

// Traduit le nom si nécéssaire
include ('alias.php');
$nom = isset ($alias[$_GET['nom']]) ? $alias[$_GET['nom']] : $_GET['nom'];

// Recherche les éléments à afficher dans le nom du fichier
preg_match_all ('/([a-z]+)([0-9]*)\.?([0-9]*)\.?([0-9]*)_/', $nom.'_', $elements);

// Valeurs par defaut
$taille = 24;

// Parcours des éléments
foreach ($elements[1] AS $k => $element)
	// t123 définit une taille de l'icone SVG 123x123 pixels
	if ($element == 't')
		$taille = $elements[2][$k];

	elseif (in_array ($element, $colors))
		$couleurs[] = $element;

	elseif ($element == 'a' || // a123.4.5 = caractère unicode décimal &#123; à la position x = 4, y = 5
		$element == 'n') { // n12.3.2 = entier 12 à la position x = 3, y = 4
		$decimal = intval($elements[2][$k]);
		$x_ascii = $elements[3][$k];
		$y_ascii = $elements[4][$k];
		$images[] = $element;
	}
	elseif (file_exists("elements/$element.svg"))
		$images[] = $element;

	else
		$inconnu = $element;

// Force 2 valeurs nulles pour faciliter le test dans les templates
$couleurs[] = $couleurs[] = null;

// Génération du fichier SVG
header ('Content-type: image/svg+xml');
header ('Cache-Control: max-age=86000');
header ('Access-Control-Allow-Headers: *');
header ('Access-Control-Allow-Origin: *');

if (isset ($inconnu) || !isset ($images)) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	$images = ['_404']; // Uniquement l'élément erreur 404
}

include ('_head.svg');

foreach ($images AS $element) {
		echo PHP_EOL; // Jolie mise en page du fichier .svg
		include ("elements/$element.svg");
	}

include ('_tail.svg');
