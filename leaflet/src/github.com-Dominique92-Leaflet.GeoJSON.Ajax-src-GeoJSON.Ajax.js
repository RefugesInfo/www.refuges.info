/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Display remote layers with geoJSON format
 *
 * geoJSON Spécifications: http://geojson.org/geojson-spec.html
 * With the great initial push from https://github.com/LeOSW42
 */

L.GeoJSON.Ajax = L.GeoJSON.Style.extend({
	ajaxRequest: null,

	options: {
		proxy: '', // If needed by the GeoJSON server / This can be avoided if the GeoJSON server delivers: header("Access-Control-Allow-Origin: *");
		urlGeoJSON: null, // GeoJSON server URL.
		argsGeoJSON: {} // GeoJSON server args.
	},

	initialize: function(urlGeoJSON, options) {
		if (urlGeoJSON)
			options.urlGeoJSON = urlGeoJSON;

		// L.GeoJSON init with blank content as we will get it later.
		L.GeoJSON.prototype.initialize.call(this, null, options);
	},

	onAdd: function(map) {
		L.GeoJSON.prototype.onAdd.call(this, map);

		// If BBOX, reload the geoJSON from the server each time the map moves/zoom.
		if (this.options.bbox)
			map.on('moveend', this.reload, this);

		// Anyway, we need to load it at the beginning.
		this.reload();
	},

	reload: function(args) {
		// Update args if necessary
		L.extend(this.options.argsGeoJSON, args);

		// Prepare the BBOX url options.
		if (this.options.bbox && this._map) {
			var bounds = this._map.getBounds(),
				minll = bounds.getSouthWest(),
				maxll = bounds.getNorthEast();
			this.options.argsGeoJSON['bbox'] = minll.lng + ',' + minll.lat + ',' + maxll.lng + ',' + maxll.lat;
		}

		// We prepare the Request object
		if (!this.ajaxRequest) { // Only once.
			if (window.XMLHttpRequest)
				this.ajaxRequest = new XMLHttpRequest();
			else if (window.ActiveXObject)
				this.ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
			else {
				alert("Your browser doesn't support AJAX requests.");
				exit;
			}
			this.ajaxRequest.context = this; // Reference the layer object for further usage.
		}

		// Process AJAX response.
		this.ajaxRequest.onreadystatechange = function(e) {
			if (e.target.readyState < 4) // Still in process
				return;
			if (e.target.status == 200)
				e.target.context.redraw(e.target.responseText);
			else if (e.target.status)
				alert('ajaxRequest error status = ' + e.target.status + ' calling ' + this.options.urlGeoJSON);
		};
		this.ajaxRequest.open('GET', this.options.proxy + this.options.urlGeoJSON + L.Util.getParamString(this.options.argsGeoJSON), true);
		this.ajaxRequest.send(null);
	},

	redraw: function(geoJSON) {
		// Empty the layer.
		for (l in this._layers)
			if (this._map)
				this._map.removeLayer(this._layers[l]);

		// Redraw new features.
		try {
			eval('this.addData([' + geoJSON + '])');
		} catch (e) {
			if (e instanceof SyntaxError)
				alert('Json syntax error on ' + this.options.urlGeoJSON + this.args + ' :\n' + geoJSON);
		}
	}
});