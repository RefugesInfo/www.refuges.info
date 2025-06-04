<?php
$colors = ['black','green','lightgreen','blue','red','grey','yellow','white',
	'maroon','orange','blanchedalmond','lightgrey','violet','purple','turquoise'];

// Tableau de correspondance des icônes
$alias = [
	// Chemineur
	'abri' => 'cabane_manqueunmur',
	'abri_pierre' => 'arc_white_maroon_manqueunmur',
	'aeroport' => 'cabane_white_black_a9992.6.20',
	'bivouac' => 'camping_grey_maroon',
	'buron' => 'cabane_maroon',
	'cafe' => 'cabane_white_maroon_a9749.1',
	'camping' => 'camping_yellow_green',
	'chambre_hote' => 'cabane_green',
//	'bus' => 'bus',
//	'cabane' => 'cabane',
//	'cabane_cle' => 'cabane_cle',
//	'col' => 'col',
	'edifice_religieux' => 'cabane_white_maroon_croix',
	'ferme' => 'cabane_white_black_x',
	'gare' => 'cabane_white_black_loco',
	'gite' => 'cabane_green',
	'grotte' => 'arc_lightgrey_black_manqueunmur',
	'hotel' => 'cabane_blue',
	'ile' => 'lac_orange_a45.8.15',
	'inconnu' => 'cabane_white_black_a63',
//	'lac' => 'lac',
	'librairie' => 'cabane_white_maroon_a10000.5',
	'maison_maitre' => 'cabane_white_maroon_a9884.5',
	'musee' => 'cabane_white_maroon_a9905.7',
	'orri' => 'arc_blanchedalmond_red_manqueunmur',
	'ouvrage' => 'arc_white_black_a9910.5',
	'ouvrage_militaire' => 'cabane_white_maroon_a9876.6',
//	'parking' => 'parking',
	'passage_a_niveau' => 'triangle_loco',
	'phare' => 'lac_orange_a9820.4.15',
	'point_eau' => 'pointdeau',
	'pont' => 'arc_white_black_loco',
	'port' => 'bateau',
//	'ravitaillement' => 'ravitaillement',
	'refuge' => 'cabane_red',
	'refuge_garde' => 'cabane_red',
	'restaurant' => 'cabane_white_maroon_a9832.5',
	'rond_point' => 'triangle_a8634.5.22',
	'ruine' => 'triangle_grey_black_manqueunmur',
	'site_industriel' => 'cabane_white_maroon_a9874.6',
	'site_historique' => 'rond_lightgreen_a10035.5.17',
	'site_remarquable' => 'rond_yellow_a9728.5.17',
//	'sommet' => 'sommet',
	'tunnel' => 'arc_black_grey_loco',
	'urbanisme' => 'rond_blanchedalmond_a9751.6.16',
	'vignoble' => 'cabane_violet_purple_a9753.6',
	'village' => 'cabane_grey_black_a118',
	'ville' => 'cabane_white_black_a86',

	// WRI
	//'gite-d-etape' => 'blue',
	//'passage-delicat' => 'triangle_a33',
	// Favicon
	'favicon' => 'feu_cabane_porte_oeuil_t384',
	// PRC
	'cabane_fermee' => 'cabane_white_black_x',
	'cabane_mais' => 'cabane_white_black_x',
	'cabane_ouverte' => 'cabane',
	'orri_toue' => 'arc_blanchedalmond_red_manqueunmur',

	// C2C
	'bus_stop' => 'bus',
	'canyon' => 'triangle_a33',
	'climbing_indoor' => 'sommet',
	'climbing_outdoor' => 'sommet',
	'convenience' => 'ravitaillement',
	'locality' => 'cabane_grey_black_a118',
	'misc' => 'a63',
	'paragliding_takeoff' => 'sommet',
	'paragliding_landing' => 'triangle_a33',
	'retail' => 'ravitaillement',
	'slackline_spot' => 'a63',
	'virtual' => 'a63',
	'waterpoint' => 'pointdeau',
	'waterfall' => 'pointdeau',
	'weather_station' => 'a63',
	'webcam' => 'a63',
	/*//BEST manque
	refuges
	parkings
	WC -> yes
	*/

	// OSM
	'access' => 'parking',
	'alpine_hut' => 'cabane',
	'apartment' => 'cabane_blue',
	'basic_hut' => 'cabane',
	'bivouac' => 'camping_yellow_green',
	'buffet' => 'cabane_white_maroon_a9832.5',
	'cabin' => 'cabane',
	'car' => 'bus',
	'camp_site' => 'camping_yellow_green',
	'cave' => 'arc_lightgrey_black_manqueunmur',
	'chalet' => 'cabane_blue',
	'guest_house' => 'cabane_blue',
	'hostel' => 'cabane_blue',
	'hut' => 'cabane_manqueunmur',
	'lake' => 'lac',
	'local_product' => 'ravitaillement',
	'museum' => 'cabane_white_maroon_a9905.7',
	'pass' => 'triangle_a33',
	'shelter' => 'cabane',
	'spring' => 'pointdeau',
	'summit' => 'sommet',
	'supermarket' => 'ravitaillement',
	'toilets' => 'a87',
	'water_well' => 'pointdeau',

	// Alpages.info
	'reseau' => 'a63',

	// EPGV
	'gym' => 'cabane_turquoise_blue_a71.6.20',
];


$geocaching = [
	// Icônes Overpass, C2C & PRC (remplacer ' ' par %20 dans l'URL)
	// Il s'agit en fait d'une équivalence des symboles geocaching utilisés par les GPS
	'Campground' => 'camping_yellow_green',
	'City Hall' => 'cabane_blue', // Hôtel ou location
	'Crossing' => 'cabane_white_black_x', // Fermé
	'Danger Area' => 'triangle_a33',
	'Drinking Water' => 'pointdeau',
	'Fishing Hot Spot Facility' => 'cabane_manqueunmur', // Manque un mur
	'Ground Transportation' => 'bus',
	'Lodge' => 'cabane',
	'Oil Field' => 'a9910.5',
	'Parking Area' => 'parking', //BEST Parking avec un P ascii avec couleurs
	'Puzzle Cache' => 'cabane_black_a63',
	'Residence' => 'cabane_green',
	'Restaurant' => 'cabane_white_maroon_a9832.5',
	'Restroom' => 'a87',
	'Shopping Center' => 'ravitaillement', // Ravitaillement
	'Summit' => 'sommet',
	'Telephone' => 'a9743',
	'Tunnel' => 'arc_blanchedalmond_red_manqueunmur', // Orri
	'Water Source' => 'pointdeau',
	'Waypoint' => 'triangle_a33',
];

foreach ($geocaching AS $k=>$v)
	$alias [str_replace (' ', '_', strtolower($k))] = $v;
