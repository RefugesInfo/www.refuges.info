// Contient les déclarations communes aux cartes

const layersSwitcher = controlLayersSwitcher({
	<?if (isset($config_wri["carte_base"])){?>
		init: '<?=$config_wri["carte_base"]?>',
	<?}?>
	baseLayers: {
		'Refuges.info': layerOsmMri(),
		'OpenTopo': layerOsmOpenTopo(),
		'Outdoors': layerThunderforest('outdoors'),
		'OSM-fr': layerOsm('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		<?php if ($vue->type != 'point_formulaire_modification' && $vue->type != 'edit') { ?>
			'IGN': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS'),
			'IGN Express': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
		<?php } ?>
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo Bing': layerBing('Aerial'),
		'Photo IGN': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS'),
	},
});