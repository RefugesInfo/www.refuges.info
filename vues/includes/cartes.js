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
	var ie = navigator.userAgent.indexOf("MSIE ") > -1 || // MS old browsers
		navigator.userAgent.indexOf("Trident/") > -1; // Newer ones

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
			var ext = 'png';
			if (!ie)
				switch(properties.icone) {
					case 'refuge-garde':
					case 'cabane-non-gardee':
					case 'gite-d-etape':
					ext = 'svg';
				}
				//FIXME sly 17/02/2021: temporairement, pour ne pas perturber les habitudes, je maintiens png comme extension pour tous, quelques tests et essais avant de le pousser pour tous
				ext = 'png'; // A enlever dès ques svg marche pour tous ;-)
			return {
				image: new ol.style.Icon({
					src: options.baseUrl + 'images/icones/' + properties.icone + '.' + ext,
				}),
			};
		},
	}, options);
	return layerVectorURL(options);
}
