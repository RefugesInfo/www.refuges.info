/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Switzerland projections & layer for the Swisstopo maps http://map.geo.admin.ch/
 * Documentation & key: http://www.swisstopo.admin.ch/internet/swisstopo/fr/home/products/services/web_services/webaccess.html
 * Always allowed on //localhost
 *
 * Usage: new L.TileLayer.SwissTopo().addTo(map);
 *
 * Different layers:
	new L.TileLayer.SwissTopo({l:'ch.swisstopo.pixelkarte-farbe'}) : Basic 2015
	new L.TileLayer.SwissTopo({l:'ch.swisstopo.hiks-siegfried'}) : Siegfried historical 1870-1949
	new L.TileLayer.SwissTopo({l:'ch.swisstopo.hiks-dufour'}) : Dufour historical 1845-1939
	new L.TileLayer.SwissTopo({l:'ch.swisstopo.swissimage'}) : Satellite
 */

// Switzerland Coordinate Reference System
L.CRS.EPSG21781 = L.extend(
	new L.Proj.CRS(
		'EPSG:21781',
		'+proj=somerc +lat_0=46.95240555555556 +lon_0=7.439583333333333 +k_0=1 +x_0=600000 +y_0=200000 +ellps=bessel +towgs84=674.374,15.056,405.346,0,0,0,0 +units=m +no_defs', {
			resolutions: [4000, 3750, 3500, 3250, 3000, 2750, 2500, 2250, 2000, 1750, 1500, 1250, 1000, 750, 650, 500, 250, 100, 50, 20, 10, 5, 2.5, 2, 1.5, 1, 0.5,
				1/4, 1/8, 1/16], // Extra for scaled images zoom
			origin: [420000, 350000]
		}
	), {
		bounds: L.bounds([5.97, 45.83], [10.49, 47.81]),
		name: 'Coordonnées suisses',
		title: {
			lng: 'X', // Nom de la coordonnée pour affichage
			lat: 'Y'
		},
		distance: function(a, b) {
			return L.CRS.Earth.distance(a, b);
		}
	}
);

// SwissTopo layer
L.TileLayer.SwissTopo = L.TileLayer.extend({
	options: {
		subdomains: '56789',
		l: 'ch.swisstopo.pixelkarte-farbe',
		f: 'jpeg',
		crs: L.CRS.EPSG21781,
		minZoom: 0,
		maxNativeZoom: L.CRS.EPSG21781.options.resolutions.length - 1 - 3, // Max available tiles
		maxZoom: L.CRS.EPSG21781.options.resolutions.length - 1, // Max authorized zoom
		attribution: '&copy; <a href="http://www.swisstopo.admin.ch/internet/swisstopo/fr/home.html">swisstopo, BAFU</a>'
	},

	initialize: function(options) {
		L.TileLayer.prototype.initialize.call(
			this,
			'//wmts{s}.geo.admin.ch/1.0.0/{l}/default/current/21781/{z}/{y}/{x}.{f}',
			options
		);
	}
});

// SwissTopo extended layer
L.TileLayer.SwissTopo.Extended = L.TileLayer.SwissTopo.extend({
	_update: function() {
		if (this._map) {
			this.options.l =
				this._map._zoom < 24 ?
				'ch.swisstopo.pixelkarte-farbe' :
				'ch.swisstopo.landeskarte-farbe-10';

			this.options.f =
				this._map._zoom < 24 ?
				'jpeg' :
				'png';
		}
		L.TileLayer.prototype._update.call(this);
	}
});