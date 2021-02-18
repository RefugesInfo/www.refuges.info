<?php // Contient les déclarations communes aux cartes
?>
const layersSwitcher = controlLayersSwitcher({
	<?if (isset($config_wri["carte_base"])){?>
		init: '<?=$config_wri["carte_base"]?>',
	<?}?>
	baseLayers: {
		'Refuges.info': layerOsmMri(),
		'OpenTopo': layerOsmOpenTopo(),
		'Outdoors': layerThunderforest('outdoors'),
		'OSM-fr': layerOsm('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		<?php if (!isset($vue) || // For /gps
			($vue->type != 'point_formulaire_modification' && $vue->type != 'edit')) { ?>
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

function layerRefugesInfo(options) {
	var ie = navigator.userAgent.indexOf('MSIE ') > -1 || // MS old browsers
		navigator.userAgent.indexOf('Trident/') > -1; // Newer ones

	options = Object.assign({
		baseUrl: '//www.refuges.info/',
		urlSuffix: 'api/bbox?type_points=',
		strategy: ol.loadingstrategy.bboxLimit,
		receiveProperties: function(properties) {
			properties.name = properties.nom;
			properties.link = properties.lien;
			properties.ele = properties.coord.alt;
			properties.icone = properties.type.icone;
			properties.type = properties.type.valeur;
			properties.bed = properties.places.valeur;
			// Need to have clean KML export
			properties.nom =
				properties.lien =
				properties.date = '';
		},
		styleOptions: function(properties) {
			return {
				image: new ol.style.Icon({
					src: options.baseUrl + 'images/icones/' + properties.icone + '.png',
// A remplacer dès que SVG marche pour tous ;-)
//					src: options.baseUrl + 'images/icones/' + properties.icone + (ie ? '.png' : '.svg'),
				}),
			};
		},
	}, options);
	return layerVectorURL(options);
}
