/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Switzerland projections & layer for the Swisstopo maps http://map.geo.admin.ch/
 * Doc et demande pour autoriser le domaine à accéder aux données: http://www.swisstopo.admin.ch/internet/swisstopo/fr/home/products/services/web_services/webaccess.html
 * Automatiquement autorisé sur //localhost
 */

// Switzerland Coordinate Reference System
L.CRS.EPSG21781 = L.extend(
	new L.Proj.CRS(
		'EPSG:21781',
		'+proj=somerc +lat_0=46.95240555555556 +lon_0=7.439583333333333 +x_0=600000 +y_0=200000 +ellps=bessel +towgs84=674.374,15.056,405.346,0,0,0,0 +units=m +no_defs', {
			resolutions: [4000, 3750, 3500, 3250, 3000, 2750, 2500, 2250, 2000, 1750, 1500, 1250, 1000, 750, 650, 500, 250, 100, 50, 20, 10, 5, 2.5, 2, 1.5, 1, 0.5],
			origin: [420000, 350000]
		}
	), {
		bounds: L.bounds([5.97, 45.83], [10.49, 47.81]),
		name: 'SwissGrid(CH1903/NV03)',
		title: {
			lng: 'X', // Nom de la coordonnée pour affichage
			lat: 'Y'
		}
	}
);

// SwissTopo layer
L.TileLayer.SwissTopo = L.TileLayer.extend({
	options: {
		url: 'http://wmts{s}.geo.admin.ch/1.0.0/',
		subdomains: '56789',
		layerName: 'ch.swisstopo.pixelkarte-farbe',
		time: 20120809,
		matrixSet: 21781,
		scheme: 'xyz',
		crs: L.CRS.EPSG21781,
		maxZoom: L.CRS.EPSG21781.options.resolutions.length - 1,
		minZoom: 0,
		continuousWorld: true,
		attribution: 'Map data &copy; 2013 swisstopo, BAFU'
	},

	initialize: function(layer, options) {
		L.setOptions(this, options);
		if (layer)
			this.options.layerName = layer;
		L.TileLayer.prototype.initialize.call(
			this,
			this.options.url + this.options.layerName + '/default/' + this.options.time + '/' + this.options.matrixSet + '/{z}/{y}/{x}.jpeg',
			this.options
		);
	}
});