<?php
// Force la couche carte quand on lance le GPS
setcookie ('baselayer', 'Refuges.info');

include ('../config_privee.php');
$mapKeys = $config_wri['mapKeys'];

$no_tail = true;
include ('../MyOl/gps/index.php');
?>

<div id="additional-selector" >
	Refuges.info <input type="checkbox" name="wri-features" />
	<ul>
		<li><input type="checkbox" name="wri-features" value="7" checked="checked" />Cabane</li>
		<li><input type="checkbox" name="wri-features" value="10" checked="checked" />Refuge</li>
		<li><input type="checkbox" name="wri-features" value="9" />Gîte</li>
		<li><input type="checkbox" name="wri-features" value="23" checked="checked" />Point d'eau</li>
		<li><input type="checkbox" name="wri-features" value="6" />Sommet</li>
		<li><input type="checkbox" name="wri-features" value="3" />Passage</li>
		<li><input type="checkbox" name="wri-features" value="28" />Bâtiment</li>
	</ul>
</div>

<script>
	window.addEventListener('load', function() {
		map.addLayer(layerWri({
			selectorName: 'wri-features',
			maxResolution: 100, // La couche est affichée pour les résolutions < 100 Mercator map unit / pixel
			distance: 30, // Clusterisation
		}));
	});
</script>

</body>
</html>
