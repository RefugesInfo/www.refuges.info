const baseLayers = {
		'Refuges.info': layerMRI(),
		'OpenTopo': layerOpenTopo(),
		'Outdoors': layerThunderforest('outdoors'),
		'OSM fr': layerOSM('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		'IGN TOP25': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS'), // Need an IGN key
		'IGN V2': layerIGN('GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2', 'png', 'pratique'), // 'pratique' is the key for the free layers
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo IGN': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS', 'jpeg', 'pratique'),
		'Photo Bing': layerBing('Aerial'),
	},

	controls = [
		controlLayerSwitcher(baseLayers),
		controlPermalink({ // Permet de garder le même réglage de carte d'une page à l'autre
			visible: false, // Mais on ne visualise pas le lien du permalink
			init: false, // Ici, on utilisera plutôt la position du point
		}),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		controlFullScreen(),
		new ol.control.Attribution(),
	],

	coordinates = [<?=$vue->point->longitude?>,<?=$vue->point->latitude?>],

	cadre = layerEditGeoJson({
		displayPointId: 'marqueur',
		singlePoint: true,
		geoJson: {
			type: 'Point',
			coordinates: coordinates,
		},
		styleOptions: {
			image: new ol.style.Icon({
				src: '<?=$config_wri["sous_dossier_installation"]?>images/cadre.png',
				imgSize: [31, 43], // IE compatibility
			}),
		},
	});

new ol.Map({
	target: 'carte-point',
	view: new ol.View({
		center: ol.proj.fromLonLat(coordinates),
		zoom: 13,
		enableRotation: false,
	}),
	controls: controls,
	layers: [
		layerMRI(), // Fond de carte WRI
		layerWri({ // La couche des points
			host: '<?=$config_wri["sous_dossier_installation"]?>',
			distance: 30, // Clusterisation
			styleOptionsFunction: function(feature, properties) {
				return styleOptionsIcon(properties.icon); // Display only the icon
			},
		}),
		cadre,
	],
});
