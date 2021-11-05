/**
 * This module defines many WMTS EPSG:3857 tiles layers
 */

/**
 * Openstreetmap
 */
function layerOSM(url, attribution, maxZoom) {
	return new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: url,
			maxZoom: maxZoom || 21,
			attributions: [
				attribution || '',
				ol.source.OSM.ATTRIBUTION,
			],
		}),
	});
}

function layerOpenTopo() {
	return layerOSM(
		'//{a-c}.tile.opentopomap.org/{z}/{x}/{y}.png',
		'<a href="https://opentopomap.org">OpenTopoMap</a> ' +
		'(<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
		17
	);
}

function layerMRI() {
	return layerOSM(
		'//maps.refuges.info/hiking/{z}/{x}/{y}.png',
		'<a href="//wiki.openstreetmap.org/wiki/Hiking/mri">Refuges.info</a>'
	);
}

/**
 * Kompas (Austria)
 * Requires layerOSM
 * This will not work on http: pages. No workarond available !
 */
function layerKompass(subLayer) {
	return layerOSM(
		'http://ec{0-3}.cdn.ecmaps.de/WmsGateway.ashx.jpg?' + // Not available via https
		'Experience=ecmaps&MapStyle=' + subLayer + '&TileX={x}&TileY={y}&ZoomLevel={z}',
		'<a href="http://www.kompass.de/livemap/">KOMPASS</a>'
	);
}

/**
 * Thunderforest
 * Requires layerOSM
 * var mapKeys.thunderforest = Get your own (free) THUNDERFOREST key at https://manage.thunderforest.com
 */
function layerThunderforest(subLayer) {
	return typeof mapKeys == 'object' && mapKeys && mapKeys.thunderforest ?
		layerOSM(
			'//{a-c}.tile.thunderforest.com/' + subLayer + '/{z}/{x}/{y}.png?apikey=' + mapKeys.thunderforest,
			'<a href="http://www.thunderforest.com">Thunderforest</a>'
		) : null;
}

/**
 * Google
 */
function layerGoogle(subLayer) {
	return new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: '//mt{0-3}.google.com/vt/lyrs=' + subLayer + '&hl=fr&x={x}&y={y}&z={z}',
			attributions: '&copy; <a href="https://www.google.com/maps">Google</a>',
		}),
	});
}
//BEST lien vers GGstreet

/**
 * Stamen http://maps.stamen.com
 */
function layerStamen(subLayer) {
	return new ol.layer.Tile({
		source: new ol.source.Stamen({
			layer: subLayer,
		}),
	});
}

/**
 * IGN France
 * Doc on http://api.ign.fr
 * var mapKeys.ign = Get your own (free)IGN key at https://professionnels.ign.fr/user
 * IGN V2 & photo don't need this key
 */
function layerIGN(subLayer, format) {
	let IGNresolutions = [],
		IGNmatrixIds = [];

	for (let i = 0; i < 18; i++) {
		IGNresolutions[i] = ol.extent.getWidth(ol.proj.get('EPSG:3857').getExtent()) / 256 / Math.pow(2, i);
		IGNmatrixIds[i] = i.toString();
	}

	return typeof mapKeys == 'object' && mapKeys && mapKeys.ign ?
		new ol.layer.Tile({
			source: new ol.source.WMTS({
				url: '//wxs.ign.fr/' + mapKeys.ign + '/wmts',
				layer: subLayer,
				matrixSet: 'PM',
				format: 'image/' + (format || 'jpeg'),
				tileGrid: new ol.tilegrid.WMTS({
					origin: [-20037508, 20037508],
					resolutions: IGNresolutions,
					matrixIds: IGNmatrixIds,
				}),
				style: 'normal',
				attributions: '&copy; <a href="http://www.geoportail.fr/" target="_blank">IGN</a>',
			}),
		}) : null;
}

/**
 * Swisstopo https://api.geo.admin.ch/
 */
function layerSwissTopo(layer1) {
	//BEST carte stamen hors zoom ou extent
	const projectionExtent = ol.proj.get('EPSG:3857').getExtent(),
		resolutions = [],
		matrixIds = [];

	for (let r = 0; r < 18; ++r) {
		resolutions[r] = ol.extent.getWidth(projectionExtent) / 256 / Math.pow(2, r);
		matrixIds[r] = r;
	}

	return new ol.layer.Tile({
		source: new ol.source.WMTS(({
			crossOrigin: 'anonymous',
			url: '//wmts2{0-4}.geo.admin.ch/1.0.0/' + layer1 + '/default/current/3857/{TileMatrix}/{TileCol}/{TileRow}.jpeg',
			tileGrid: new ol.tilegrid.WMTS({
				origin: ol.extent.getTopLeft(projectionExtent),
				resolutions: resolutions,
				matrixIds: matrixIds,
			}),
			requestEncoding: 'REST',
			attributions: '&copy <a href="https://map.geo.admin.ch/">SwissTopo</a>',
		})),
	});
}

/**
 * Spain
 */
function layerSpain(server, subLayer) {
	return new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: '//www.ign.es/wmts/' + server + '?layer=' + subLayer +
				'&Service=WMTS&Request=GetTile&Version=1.0.0&Format=image/jpeg' +
				'&style=default&tilematrixset=GoogleMapsCompatible' +
				'&TileMatrix={z}&TileCol={x}&TileRow={y}',
			attributions: '&copy; <a href="http://www.ign.es/">IGN España</a>',
		}),
	});
}

/**
 * Ordnance Survey : Great Britain
 * var mapKeys.os = Get your own (free) key at https://osdatahub.os.uk/
 */
function layerOS(subLayer) {
	//BEST carte stamen hors zoom ou extent

	return typeof mapKeys == 'object' && mapKeys && mapKeys.os ?
		new ol.layer.Tile({
			extent: [-1198263, 6365000, 213000, 8702260],
			minZoom: 6.5,
			maxZoom: 16.4,
			source: new ol.source.XYZ({
				url: 'https://api.os.uk/maps/raster/v1/zxy/' + subLayer + '/{z}/{x}/{y}.png?key=' + mapKeys.os,
			}),
		}) : null;
}

/**
 * Bing (Microsoft)
 * var mapKeys.bing = Get your own (free) key at http://www.ordnancesurvey.co.uk/business-and-government/products/os-openspace/
 */
function layerBing(subLayer) {
	const layer = new ol.layer.Tile();

	//HACK : Avoid to call https://dev.virtualearth.net/... if no bing layer is required
	layer.on('change:visible', function() {
		if (!layer.getSource()) {
			layer.setSource(new ol.source.BingMaps({
				imagerySet: subLayer,
				key: mapKeys.bing,
			}));
		}
	});

	return typeof mapKeys == 'object' && mapKeys.bing ? layer : null;
}

/**
 * Tile layers examples
 */
function layersCollection() {
	return {
		'OpenTopo': layerOpenTopo(),
		'OSM outdoors': layerThunderforest('outdoors'),
		'OSM transport': layerThunderforest('transport'),
		'Refuges.info': layerMRI(),
		'OSM fr': layerOSM('//{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
		'IGN TOP25': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS'), // Need an IGN key
		'IGN V2': layerIGN('GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2', 'png', 'pratique'), // 'pratique' is the key for the free layers
		'SwissTopo': layerSwissTopo('ch.swisstopo.pixelkarte-farbe'),
		'Autriche': layerKompass('KOMPASS Touristik'),
		'Angleterre': layerOS('Outdoor_3857'),
		'Espagne': layerSpain('mapa-raster', 'MTN'),
		'Photo IGN': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS', 'jpeg', 'pratique'),
		'Photo Google': layerGoogle('s'),
	};
}

function layersDemo() {
	return Object.assign(layersCollection(), {
		'OSM': layerOSM('//{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
		'Hike & Bike': layerOSM(
			'http://{a-c}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png',
			'<a href="//www.hikebikemap.org/">hikebikemap.org</a>'
		), // Not on https
		'OSM cycle': layerThunderforest('cycle'),
		'OSM landscape': layerThunderforest('landscape'),
		'OSM trains': layerThunderforest('pioneer'),
		'OSM villes': layerThunderforest('neighbourhood'),
		'OSM contraste': layerThunderforest('mobile-atlas'),

		'OS light': layerOS('Light_3857'),
		'OS road': layerOS('Road_3857'),
		'Kompas': layerKompass('KOMPASS'),

		'Bing': layerBing('Road'),
		'Bing photo': layerBing('Aerial'),
		'Bing hybrid': layerBing('AerialWithLabels'),

		'Google road': layerGoogle('m'),
		'Google terrain': layerGoogle('p'),
		'Google hybrid': layerGoogle('s,h'),
		'Stamen': layerStamen('terrain'),
		'Toner': layerStamen('toner'),
		'Watercolor': layerStamen('watercolor'),
		//BEST neutral layer

		// Need an IGN key
		'IGN Classique': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
		'IGN Standard': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'),
		//Double 	'SCAN25TOUR': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN25TOUR'),
		'IGN 1950': layerIGN('ORTHOIMAGERY.ORTHOPHOTOS.1950-1965', 'png'),
		'Cadastre': layerIGN('CADASTRALPARCELS.PARCELS', 'png'),
		'IGN plan': layerIGN('GEOGRAPHICALGRIDSYSTEMS.PLANIGN'),
		'IGN route': layerIGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.ROUTIER'),
		'IGN noms': layerIGN('GEOGRAPHICALNAMES.NAMES', 'png'),
		'IGN rail': layerIGN('TRANSPORTNETWORKS.RAILWAYS', 'png'),
		'IGN hydro': layerIGN('HYDROGRAPHY.HYDROGRAPHY', 'png'),
		'IGN forêt': layerIGN('LANDCOVER.FORESTAREAS', 'png'),
		'IGN limites': layerIGN('ADMINISTRATIVEUNITS.BOUNDARIES', 'png'),

		'Swiss photo': layerSwissTopo('ch.swisstopo.swissimage'),
		'Espagne photo': layerSpain('pnoa-ma', 'OI.OrthoimageCoverage'),

		'SHADOW': layerIGN('ELEVATION.ELEVATIONGRIDCOVERAGE.SHADOW', 'png'),
		'Etat major': layerIGN('GEOGRAPHICALGRIDSYSTEMS.ETATMAJOR40'),
		'ETATMAJOR10': layerIGN('GEOGRAPHICALGRIDSYSTEMS.ETATMAJOR10'),
	});
}