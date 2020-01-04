<?php // Contient les déclarations communes aux cartes
?>
const layersSwitcher = controlLayersSwitcher({
	init: '<?=$config_wri["carte_base"]?>',
	baseLayers: {
		'Refuges.info': layerOsmMri(),
		'OpenTopo': layerOsmOpenTopo(),
		'Outdoors': layerThunderforest('<?=$config_wri['thunderforest_key']?>', 'outdoors'),
		'OSM-fr': layerOsm('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		<?php if ($vue->type != 'point_formulaire_modification' && $vue->type != 'edit') { ?>
		'IGN': layerIGN('<?=$config_wri['ign_key']?>', 'GEOGRAPHICALGRIDSYSTEMS.MAPS'),
		'IGN Express': layerIGN('<?=$config_wri['ign_key']?>', 'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
		<?php } ?>
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo Bing': layerBing('<?=$config_wri['bing_key']?>', 'Aerial'),
		'Photo IGN': layerIGN('<?=$config_wri['ign_key']?>', 'ORTHOIMAGERY.ORTHOPHOTOS'),
	},
});