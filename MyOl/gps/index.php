<!DOCTYPE html>
<!--
© Dominique Cavailhez 2019
https://github.com/Dominique92/MyOl
Based on https://openlayers.org
-->
<?php
	// This is the entry point for the apache servers running PHP
	// You can include it from another directory
	// It needs a manifest.json file in the same directory

	//BEST BUG battements entre deux instances de GPS

	// Read info in the manifest.json & list *.gpx files
	$manifest = json_decode (file_get_contents ('manifest.json'), true);
	$icon = $manifest['icons'][0];

	// Find the last subdir server internal files
	preg_match ('/[^\/]*$/', $_SERVER['DOCUMENT_ROOT'], $tag_root);

	// Calculate relative paths between the requested url & the GPS package directory
	$urls = explode ($tag_root[0], pathinfo ($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME));
	$dirs = explode ($tag_root[0], str_replace ('\\', '/', __DIR__));
	$url_dir = explode ('/', $urls[1]);
	$gps_dir = explode ('/', $dirs[1]);

	// Remove common part of the paths
	foreach ($url_dir AS $k=>$v)
		if (@$gps_dir[$k] == $v) {
			unset ($url_dir[$k]);
			unset ($gps_dir[$k]);
		}

	if (count ($gps_dir)) { // If the URL is not in the GPS package directory
		$url_dir[] = $gps_dir[] = ''; // Add a / at the end if necessary

		$url_path = str_repeat ('../', count ($gps_dir) - 1) .implode ('/', $url_dir); // Path of the URL from the GPS dir
		$gps_path = str_repeat ('../', count ($url_dir) - 1) .implode ('/', $gps_dir); // Path of the GPS dir from the URL

		$myol_path = preg_replace ('/gps\/$/', '', $gps_path);
	} else {
		$url_path = $gps_path = '';
		$myol_path = '../';
	}

	// List the files to cache
	$service_worker =
		$gps_path.
		'service-worker.js.php?files='.
		str_replace (['gps/../', '../'], ['', ':'], // Optimise link, avoid error 406 ModSecurity
			implode (',', [
				$url_path.pathinfo ($_SERVER['SCRIPT_FILENAME'], PATHINFO_BASENAME),
				$url_path.'manifest.json',
				$url_path.$icon['src'],
			])
		);

	// Get gpx files on the url directory
	$gpx_files = glob ('*.gpx');
?>
<html>
<head>
	<link rel="manifest" href="manifest.json">

	<title><?=$manifest['name']?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="<?=$icon['type']?>" href="<?=$icon['src']?>" />

	<!-- Polyfill iOS : Amélioration du pseudo full screen pour les cartes pour d'anciennes versions d'iOS/Safari -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<!-- Openlayers -->
	<link href="<?=$myol_path?>ol/ol.css" type="text/css" rel="stylesheet">
	<script src="<?=$myol_path?>ol/ol.js"></script>

	<!-- Recherche par nom -->
	<link href="<?=$myol_path?>geocoder/ol-geocoder.min.css" type="text/css" rel="stylesheet">
	<script src="<?=$myol_path?>geocoder/ol-geocoder.js"></script>

	<!-- My Openlayers -->
	<link href="<?=$myol_path?>myol.css" type="text/css" rel="stylesheet">
	<script src="<?=$myol_path?>myol.js"></script>

	<!-- This app -->
	<link href="<?=$gps_path?>index.css" type="text/css" rel="stylesheet">
	<script src="<?=$gps_path?>index.js" defer="defer"></script>
	<script>
		var service_worker = '<?=$service_worker?>',
<?php if (isset ($manifest['scope'])) { ?>
			scope = '<?=$manifest['scope']?>',
<?php } ?>
			mapKeys = <?=json_encode(@$mapKeys)?>,
			baselayers = <?=isset ($baselayers)?$baselayers:'{}'?>;

<?php if (isset ($_GET['gpx']) || isset ($overlays)) { ?>
			window.onload = function() {
<?php if (isset ($_GET['gpx'])) { ?>
				addLayer ('<?=dirname($_SERVER['SCRIPT_NAME'])?>/<?=$_GET['gpx']?>.gpx');
<?php }
if (isset ($overlays)) { ?>
				for (let o in <?=$overlays?>)
					map.addLayer (<?=$overlays?>[o]);
<?php } ?>
			};
<?php } ?>
	</script>
</head>

<body>
	<?php if (count ($gpx_files) && !isset ($_GET['gpx'])) { ?>
		<div id="liste">
			<p>Cliquez sur le nom de la trace pour l'afficher :</p>
			<ul>
			<?php foreach ($gpx_files AS $gpx) { ?>
				<li>
					<a title="Cliquer pour afficher la trace"
						onclick="addLayer('<?=dirname($_SERVER['SCRIPT_NAME']).'/'.$gpx?>')">
						<?=ucfirst(pathinfo($gpx,PATHINFO_FILENAME))?>
					</a>
				</li>
		<?php } ?>
			</ul>
			<p>Puis sur la cible pour afficher votre position.</p>
			<p>Fermer : <a onclick="document.getElementById('liste').style.display='none'" title="Replier">&#9651;</a></p>
		</div>
	<?php } ?>

	<div id="map"></div>
</body>
</html>