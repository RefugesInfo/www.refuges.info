/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * OSM maps
 * Instances of the WMS class allow viewing maps inherited from the OpenStreetMap databases
 * (c) https://www.openstreetmap.org
 */

L.TileLayer.OSM = L.TileLayer.extend({
	options: {
		url: '//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', // No scheme specified to use the same schme than the referer.
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>'
	},
	initialize: function(options) {
		if (this.options.subAttribution)
			this.options.attribution += ' | ' + this.options.subAttribution;

		L.TileLayer.prototype.initialize.call(this,
			this.options.url,
			options
		);
	}
});

L.TileLayer.OSM.FR = L.TileLayer.OSM.extend({
	options: {
		url: '//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png' // Available on http & https
	}
});

L.TileLayer.OSM.MRI = L.TileLayer.OSM.extend({
	options: {
		url: '//maps.refuges.info/hiking/{z}/{x}/{y}.png',
		subAttribution: '<a href="http://wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
	}
});

L.TileLayer.Kompass = L.TileLayer.OSM.extend({
	options: {
		l: 'Touristik',
		url: 'http://ec{s}.cdn.ecmaps.de/WmsGateway.ashx.jpg?Experience=kompass&MapStyle=KOMPASS%20{l}&TileX={x}&TileY={y}&ZoomLevel={z}', // Not available via https
		maxZoom: 15,
		subdomains: '0123',
		subAttribution: '<a href="http://www.kompass.de/livemap/">KOMPASS</a>'
	}
});

L.TileLayer.OSM.hikebike = L.TileLayer.OSM.extend({
	options: {
		url: 'http://{s}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png', // Not available via https
		subdomains: 'abc',
		maxZoom: 20,
		subAttribution: '<a href="http://www.hikebikemap.org/">hikebikemap.org</a>'
	}
});

L.TileLayer.OSM.hill = L.TileLayer.OSM.extend({
	options: {
		url: '//{s}.tiles.wmflabs.org/hillshading/{z}/{x}/{y}.png',
		subdomains: 'abc',
		maxZoom: 15,
		subAttribution: '<a href="https://wikitech.wikimedia.org">Wikimedia Tool Labs</a>'
	}
});

// Cartes ThunderForest
var ft = ['Landscape', 'Outdoors', 'Cycle', 'Transport'];
for (m in ft)
	L.TileLayer.OSM[ft[m]] = L.TileLayer.OSM.extend({
		options: {
			url: '//{s}.tile.thunderforest.com/' + ft[m].toLowerCase() + '/{z}/{x}/{y}.png',
			subAttribution: '<a href="http://www.thunderforest.com">Thunderforest ' + ft[m] + '</a>'
		}
	});