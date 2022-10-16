// Les couches de fond des cartes de refuges.info
function wriMapBaseLayers(page) {
	return {
		'Refuges.info': layerMRI(),
		'OSM fr': layerOSM({
			url: '//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
		}),
		'OpenTopo': layerOpenTopo(),
		'Outdoors': layerThunderforest({
			subLayer: 'outdoors',
			key: mapKeys.thunderforest,
		}),
		'IGN TOP25': page == 'modif' ? null : layerIGN({
			layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
			key: mapKeys.ign,
		}),
		'IGN V2': layerIGN({
			layer: 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
			key: 'essentiels', // La clé pour les couches publiques
			format: 'image/png',
		}),
		'SwissTopo': page == 'modif' ? null : layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass(),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo IGN': layerIGN({
			layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
			key: 'essentiels',
		}),
		'Photo ArcGIS': layerArcGIS('World_Imagery'),
		'Photo Bing': layerBing('Aerial'),
		'Photo Google': page == 'modif' ? null : layerGoogle('s'),
	};
}

// Les controles des cartes de refuges.info
function wriMapControls(options) {
	return [
		// Haut gauche
		new ol.control.Zoom(),
		new ol.control.FullScreen(),
		controlGeocoder(),
		controlGPS(),
		options.page == 'point' ? controlButton() : controlLoadGPX(),
		options.page == 'nav' ? controlButton() : controlDownload(options.Download),
		options.page == 'modif' ? controlButton() : controlPrint(),

		// Haut droit
		controlLayerSwitcher({
			layers: wriMapBaseLayers(options.page),
		}),

		// Bas gauche
		controlMousePosition(),
		new ol.control.ScaleLine(),

		// Bas droit
		controlPermalink(options.Permalink),
		new ol.control.Attribution({
			collapsed: false,
		}),
	];
}