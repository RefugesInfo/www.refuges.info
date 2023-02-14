<?php
error_reporting(E_ALL);
ini_set('display_errors','on');

header('Cache-Control: no-cache');
header('Pragma: no-cache');

// Get manifest info
$manifest = json_decode (file_get_contents ('manifest.json'), true);
$icon_file = $manifest['icons'][0]['src'];
$icon_type = pathinfo ($icon_file, PATHINFO_EXTENSION);

// Get package info
$start_dirs = explode ('/', str_replace ('index.php', '', $_SERVER['SCRIPT_FILENAME']));
$myol_dirs = explode ('/', str_replace ('\\', '/', __DIR__ .'/'));
// Remove common part of the paths (except the last /)
while (count ($start_dirs) > 1 && count ($myol_dirs) > 1 &&
	$start_dirs [0] == $myol_dirs [0]) {
	array_shift ($start_dirs);
	array_shift ($myol_dirs);
}

// Url start path from service-worker
$reverse_path = str_repeat ('../', count ($myol_dirs) - 1) .implode ('/', $start_dirs);
$sw_instance = str_replace (['../','/'], [':','.'], $reverse_path); //HACK avoid http 406 error

// Url start path from index.php
$start_path = '';

// MyOl/gps scripts path from index.php
$myol_path = str_repeat ('../', count ($start_dirs) - 1) .implode ('/', $myol_dirs);

function fl ($filename) {
	return implode ('', [
		(pathinfo($filename, PATHINFO_EXTENSION) == 'js' ? 'src' : 'href'),
		 '="'.$filename.'?'.filemtime($filename).'"',
		(pathinfo($filename, PATHINFO_EXTENSION) == 'css' ? ' type="text/css" rel="stylesheet"' : ''),
	]);
}

include ('common.php');

?><!DOCTYPE html>
<!--
© Dominique Cavailhez 2019
https://github.com/Dominique92/MyOl
Based on https://openlayers.org
-->
<html>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<link <?=fl('manifest.json')?> rel="manifest">

	<title><?=$manifest['name']?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link <?=fl($icon_file)?> rel="icon" type="image/<?=$icon_type?>" />
	<link <?=fl($icon_file)?> rel="apple-touch-icon" />

	<!-- Openlayers -->
	<script <?=fl($myol_path.'../ol/ol.js')?>></script>
	<link <?=fl($myol_path.'../ol/ol.css')?>>

	<!-- Recherche par nom -->
	<script <?=fl($myol_path.'../geocoder/ol-geocoder.js')?>></script>
	<link <?=fl($myol_path.'../geocoder/ol-geocoder.min.css')?>>

	<!-- My Openlayers -->
	<script <?=fl($myol_path.'../myol.js')?>></script>
	<link <?=fl($myol_path.'../myol.css')?>>

	<!-- This app -->
	<script>
	// Vars for index.js
	var myolPath = '<?=$myol_path?>',
		swInstance = '<?=$sw_instance?>',
		buildDate = '<?=$build_date?>',
		gpxParam = '<?=$gpx_param?>';
	</script>
	<script <?=fl($myol_path.'./index.js')?>></script>
	<link <?=fl($myol_path.'./index.css')?>>
</head>

<body>
	<div id="map"></div>

	<div id="myol-gps-help">
		<p>Vous pouvez utiliser ce GPS hors réseau en l'installant:</p>
		<hr /><p><u>Avant le départ:</u></p>
		<p>- Explorateur -> options -> ajoutez à l'écran d'accueil (ou installer)</p>
		<p>Pour mémoriser un fond de carte:</p>
		<p>- Choisissez un fond de carte</p>
		<p>- Placez-vous au point de départ de votre randonnée</p>
		<p>- Zoomez au niveau le plus détaillé que vous voulez mémoriser</p>
		<p>- Déplacez-vous suivant le trajet de votre randonnée suffisamment lentement pour charger toutes les dalles</p>
		<p>- Recommencez avec les fonds de cartes que vous voulez mémoriser</p>
		<p>* Toutes les dalles visualisées une fois seront conservées
			dans le cache de l'explorateur quelques jours et
			pourront être affichées même hors de portée du réseau</p>
		<hr /><p><u>Hors réseau :</u></p>
		<p>- Ouvrez le marque-page ou l'application</p>
		<p>- Si vous avez un fichier trace .gpx dans votre mobile, visualisez-le en cliquant sur &#x1F4C2;</p>
<?php if (count ($gpx_files) > 1) { ?>
		<p>- Si vous voulez suivre une trace du serveur, affichez là en cliquant sur &#x1F6B6;</p>
<?php } ?>
		<p>- Lancez la localisation en cliquant sur &#x2295;</p>
		<hr />
		<p>* Fonctionne bien sur Android avec Chrome, Edge, Brave, Samsung Internet,
			fonctions réduites avec Firefox & Safari</p>
		<p>* Cette application ne permet pas de visualiser ni d'enregistrer le parcours</p>
		<p>* Aucune donnée ni géolocalisation n'est remontée ni mémorisée</p>
		<hr />
		<p style="font-size:0.7em">Mise à jour <?=$sw_instance.$build_date?> @<?=$_SERVER['HTTP_HOST']?></p>
	</div>
<?php if (!isset ($notail)) { ?>
</body>
</html>
<?php } ?>
