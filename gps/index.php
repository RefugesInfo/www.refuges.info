<?php
include ('../config_privee.php');
include ('../MyOl/gps/index.php');

$notail = true;
?>

<div id="additional-selector" >
	<hr/>
	<div>
		<label for="selecteur-wri-7">Cabanes</label>
		<input type="checkbox" id="selecteur-wri-7" name="selecteur-wri" value="7" />
	</div>
	<div>
		<label for="selecteur-wri-10">Refuges</label>
		<input type="checkbox" id="selecteur-wri-10" name="selecteur-wri" value="10" />
	</div>
	<div>
		<label for="selecteur-wri-9">Gîtes</label>
		<input type="checkbox" id="selecteur-wri-9" name="selecteur-wri" value="9" />
	</div>
	<div>
		<label for="selecteur-wri-23">Eau</label>
		<input type="checkbox" id="selecteur-wri-23" name="selecteur-wri" value="23" />
	</div>
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
controlOptions.layerSwitcher.layers = mapBaseLayers('gps');
controlOptions.layerSwitcher.additionalSelectorId = 'additional-selector';

layers.push(layerWri({
	host: '/',
	selectorName: 'selecteur-wri',
}));
</script>

</body>
</html>