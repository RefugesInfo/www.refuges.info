/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Display remote layers with geoJSON format
 * Requires L.GeoJSON.Style
 *
 * GeoJSON Spécifications: http://geojson.org/geojson-spec.html
 * With the great initial push from https://github.com/LeOSW42
 */

L.GeoJSON.Ajax = L.GeoJSON.Style.extend({
	ajaxRequest: null,

	options: {
		urlGeoJSON: null, // GeoJSON server URL.
		argsGeoJSON: {}, // GeoJSON server args.
		idAjaxStatus: null // HTML id element owning the loading status display
	},

	initialize: function(urlGeoJSON, options) {
		if (typeof urlGeoJSON == 'string')
			this.options.urlGeoJSON = urlGeoJSON;
		else
			options = options || urlGeoJSON; // Simplified call, with no urlGeoJSON

		// L.GeoJSON init with blank content as we will get it later.
		L.GeoJSON.Style.prototype.initialize.call(this, null, options);

		// Change class of id="ajax-status" to class="ajax-<STATUS>"
		// <STATUS> = none | zoom | wait | some | zero | error
		this.elAjaxStatus = document.getElementById(this.options.idAjaxStatus) || document.createElement('div');

		// Prepare the Request object
		if (window.XMLHttpRequest)
			this.ajaxRequest = new XMLHttpRequest();
		else if (window.ActiveXObject)
			this.ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		else {
//DEBUG/*
			console.log('Your browser doesn\'t support AJAX requests.');
//DEBUG*/
			return;
		}
		this.ajaxRequest.context = this; // Reference the layer object for further usage.
		this.ajaxRequest.onreadystatechange = this._onreadystatechange; // Action when receiving data
	},

	onAdd: function(map) {
		L.GeoJSON.Style.prototype.onAdd.call(this, map);

		this.reload(); // Load it at the beginning.

		if (this.options.bbox) // Replay if the map moves
			this._map.on('moveend', this.reload, this);
	},

	onRemove: function(map) {
		this.elAjaxStatus.className = '';
		this._map.off('moveend', this.reload, this);

		L.GeoJSON.Style.prototype.onRemove.call(this, map);
	},

	// Build the final url request to send to the server
	_getUrl: function() {
		var argsGeoJSON =
			typeof this.options.argsGeoJSON == 'function'
			? this.options.argsGeoJSON.call(this, this)
			: this.options.argsGeoJSON;

		// Add bbox param if necessary
		if (this.options.bbox && this._map)
			argsGeoJSON.bbox = this._map.getBounds().toBBoxString();

		return this.options.urlGeoJSON + L.Util.getParamString(argsGeoJSON);
	},

	reload: function() {
		if (this.ajaxRequest) {
			// Build the request
			this.ajaxRequest.open(
				'GET',
				this._getUrl(),
				true
			);

			// If temporary disabled
			if (this.options.disabled) {
				this.redraw(); // Just erase the data
				this.elAjaxStatus.className = 'ajax-none';
				return;
			}

			// Zoom too large
			if (this._map) {
				var b = this._map.getBounds();
				if (b._northEast.lng - b._southWest.lng > this.options.maxLatAperture) {
					this.elAjaxStatus.className = 'ajax-zoom';
					this.redraw(); // Just erase the data
					return;
				}
			}

			// Send the request
			this.ajaxRequest.send(null);
			this.elAjaxStatus.className = 'ajax-wait';
		}
	},

	// Action when receiving data
	_onreadystatechange: function(e) {
		if (e.target.readyState < 4) // Still in progress
			;
		else if (e.target.status == 200)
			e.target.context.redraw(e.target.responseText);
		else if (typeof e.target.context['error' + e.target.status] == 'function')
			e.target.context['error' + e.target.status].call(e.target.context);
//DEBUG/*
		else if (e.target.status)
			console.log('ajaxRequest error status = ' + e.target.status + ' calling ' + e.target.context._getUrl());
//DEBUG*/
	},

	redraw: function(json) {
		// Empty the layer
		for (l in this._layers)
			if (this._map)
				this._map.removeLayer(this._layers[l]);
		this._layers = [];

		if (json) {
			try {
				var js = JSON.parse(json); // Get json data
			} catch (e) {
//DEBUG/*
				console.log('Json syntax error on ' + this._getUrl() + ' :\n' + json);
//DEBUG*/
				this.elAjaxStatus.className = 'ajax-error';
				return;
			}
			js = this._tradJson.call(this, js);

			// Add it to the layer
			this.addData(js);

			if (this.elAjaxStatus.className == 'ajax-wait')
				this.elAjaxStatus.className =
				js.length || (js.features && js.features.length) ? 'ajax-some' : 'ajax-zero';
		}
	},

	// Perform a special calculation if necessary (used by OSM overpass)
	_tradJson: function(json) {
		return json;
	}
});