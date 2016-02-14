/**
 * Copyright (c) 2016 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Google Maps
 * Instances of the WMS class allow viewing maps inherited from Google Maps
 * (c) https://www.google.com/maps
 * From the excellent capie69 comment on: http://stackoverflow.com/questions/9394190/leaflet-map-api-with-google-satellite-layer
 *
 * Different layers:
	new L.TileLayer.Google({l:'m'}) : Road
	new L.TileLayer.Google({l:'p'}) : Terrain
	new L.TileLayer.Google({l:'s'}) : Satellite
	new L.TileLayer.Google({l:'s,h'}) : Hybrid
 */

L.TileLayer.Google = L.TileLayer.extend({
	options: {
		l: 'm', // Part of the url depending on the GG layer type.
		maxZoom: 20,
		subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
		attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
	},

	initialize: function(options) {
		L.TileLayer.prototype.initialize.call(this,
			'http://{s}.google.com/vt/lyrs={l}&x={x}&y={y}&z={z}',
			options
		);
	}
});