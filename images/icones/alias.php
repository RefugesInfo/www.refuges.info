<?php
include (__DIR__.'/../../includes/config.php');

$alias = array_merge ($config_wri['definition_icones'], [
	// Compatibilité des exports KML
	'abri' => 'cabane',

	// Favicon
	'favicon' => 'cabane_feu_t384',

	// Icônes Overpass, C2C & PRC (remplacer ' ' par %20 dans l'URL)
	// Il s'agit en fait d'une équivalence des symboles geocaching utilisés par les GPS
	'Campground' => 'camping',
	'City Hall' => 'cabane_blue', // Hôtel ou location
	'Crossing' => 'cabane_white_black_x', // Fermé
	'Drinking Water' => 'pointdeau',
	'Danger Area' => 'triangle_a33',
	'Fishing Hot Spot Facility' => 'cabane_manqueunmur', // Manque un mur
	'Ground Transportation' => 'bus',
	'Lodge' => 'cabane',
	'Parking Area' => 'parking',
	'Puzzle Cache' => 'cabane_white_black_a63',
	'Shopping Center' => 'ravitaillement', // Ravitaillement
	'Summit' => 'sommet',
	'Tunnel' => 'cabane_manqueunmur', // Orri
	'Water Source' => 'pointdeau',
	'Waypoint' => 'triangle_a33',
]);