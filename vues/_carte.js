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
		<?php if (!$edition) { ?>
			'IGN-TOP25': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS'),
		<?php } ?>
		'IGN-V2': layerIGN('GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2', 'png', 'pratique'),
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo-IGN': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS', 'jpeg', 'pratique'),
		'Photo-Bing': layerBing('Aerial'),
	},
});