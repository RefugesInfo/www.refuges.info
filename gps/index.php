<!DOCTYPE html>
<!--
Progressive web application (PWA)
© Dominique Cavailhez 2019
https://github.com/Dominique92/MyOl
Based on https://openlayers.org
-->
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include ('../includes/config.php');
?>
<html>
<head>
	<title>GPS refuges.info</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="image/png" href="../images/favicon.png" />

	<!-- Openlayers -->
	<link href="../ol/ol/ol.css?<?=filemtime('../ol/ol/ol.css')?>" type="text/css" rel="stylesheet">
	<script src="../ol/ol/ol.js?<?=filemtime('../ol/ol/ol.js')?>"></script>

	<!-- Recherche par nom -->
	<link href="../ol/geocoder/ol-geocoder.min.css?<?=filemtime('../ol/geocoder/ol-geocoder.min.css')?>" type="text/css" rel="stylesheet">
	<script src="../ol/geocoder/ol-geocoder.js?<?=filemtime('../ol/geocoder/ol-geocoder.js')?>"></script>

	<!-- My Openlayers -->
	<link href="../ol/myol.css?<?=filemtime('../ol/myol.css')?>" type="text/css" rel="stylesheet">
	<script src="../ol/myol.js?<?=filemtime('../ol/myol.js')?>"></script>

	<!-- This app -->
	<link rel="manifest" href="manifest.json">
	<script defer="defer" src="index.js?<?=filemtime('index.js')?>"></script>
	<!-- ref="index.php" (for cached file list) -->
	<!-- ref="service-worker.php" (for cached file list) -->

	<script>
		var registrationDate = ' <?=date("md-Hi")?>-',
			sous_dossier_installation = '<?=$config_wri["sous_dossier_installation"]?>';

		<?php include ($config_wri['racine_projet'].'vues/includes/cartes.js')?>
	</script>

	<style>
		html, body, #map {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>
	<div id="map"></div>
</body>
</html>