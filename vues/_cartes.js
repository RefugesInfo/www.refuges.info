// Partie commune des cartes : les couches de fond et les contrôles
function mapBaseLayers(page) {
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
			key: 'essentiels', // The key for the free layers
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

function mapControls(page) {

	return [
		new ol.control.Zoom(),
		new ol.control.FullScreen(),
		controlGeocoder(),
		controlGPS(),
		page == 'point' ? controlButton() : controlLoadGPX(),
		page == 'point' || page == 'modif' ? controlButton() : controlDownload(),
		page == 'modif' ? controlButton() : controlPrint(),
		controlLayerSwitcher({
			layers: mapBaseLayers(page),
		}),
		controlMousePosition(),
		new ol.control.ScaleLine(),
		new ol.control.Attribution({
			collapsed: false,
		}),
	];
}