/*
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
		subdomains: '0123',
		l: 'm', // Part of the url depending on the GG layer type.
		maxZoom: 22,
		attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
	},

	initialize: function(options) {
		L.TileLayer.prototype.initialize.call(this,
			'//mt{s}.google.com/vt/lyrs={l}&x={x}&y={y}&z={z}',
			options
		);
	},

	onAdd: function(map) {
		map.on('movestart', this._resetNativeZoom, this);
		L.TileLayer.prototype.onAdd.call(this, map);
	},

	onRemove: function(map) {
		map.off('movestart', this._resetNativeZoom, this);
		L.TileLayer.prototype.onRemove.call(this, map);
	},

	_resetNativeZoom: function() {
		this.options.maxNativeZoom = 20;
	},

	_tileOnError: function(done, tile, e) {
		this.options.maxNativeZoom = 19; // Some areas don't support zoom=20
		L.TileLayer.prototype._tileOnError.call(this, done, tile, e);
	}
});