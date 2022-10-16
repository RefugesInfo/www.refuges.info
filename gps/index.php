<?php
include ('../config_privee.php');
include ('../MyOl/gps/index.php');

$notail = true;
?>

<div id="select-ext">
	<hr/>
	<label for="selecteur-wri-7">Cabanes
		<input type="checkbox" id="selecteur-wri-7" name="selecteur-wri" value="7" />
	</label>
	<label for="selecteur-wri-10">Refuges
		<input type="checkbox" id="selecteur-wri-10" name="selecteur-wri" value="10" />
	</label>
	<label for="selecteur-wri-9">Gîtes
		<input type="checkbox" id="selecteur-wri-9" name="selecteur-wri" value="9" />
	</label>
	<label for="selecteur-wri-23">Eau
		<input type="checkbox" id="selecteur-wri-23" name="selecteur-wri" value="23" />
	</label>
</div>

<script src="../vues/_cartes.js"></script>
<script>
var mapKeys = <?=json_encode($config_wri['mapKeys'])?>;

controlOptions.supplementaryControls = [
	controlButton({
		label: '&#x1F3E0;',
		submenuHTML: '<p>Retour à <a href="/">Refuges.info</a></p>',
	}),
];
controlOptions.layerSwitcher.layers = wriMapBaseLayers('gps');
controlOptions.layerSwitcher.selectExtId = 'select-ext';

layers.push(layerWri({
	host: '/',
	selectName: 'selecteur-wri',
}));
</script>

</body>
</html>