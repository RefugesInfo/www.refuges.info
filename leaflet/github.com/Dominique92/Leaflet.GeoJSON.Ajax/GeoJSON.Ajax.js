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

/* L.GeoJSON.Style
 * Add presentation & actions to geoJSON format
 */

L.GeoJSON.Style = L.GeoJSON.extend({

	// Modify the way the layer representing one of the features is displayed
	_setLayerStyle: function(layer, layerStyle) {
		// Merge layer style & feature properties.
		var style = L.extend({},
			layer.feature.properties, // Low priority: geoJSON properties.
			typeof layerStyle == 'function'
				? layerStyle.call(this, layer.feature) // When layer.options.style is a function
				: layerStyle // Priority one: layer.options.style
		);

		// Use an icon file to display a marker.
		if (style.iconUrl)
			layer.setIcon(L.icon(style));

		// Show a popup when clicking the marker.
		if (style.popup)
			layer.on('click', function(e) {
				layer.off('mouseout', this._closePopup); // Don't close on moving out
				var popup = L.popup({
						className: style.popupClass ? style.popupClass : ''
					})
					.setLatLng(e.latlng)
					.setContent(style.popup)
					.openOn(this._map);
			});

		// Navigate the the url when clicking the marker.
		if (style.url)
			layer.on('click', function(e) {
				if (e.originalEvent.shiftKey || e.originalEvent.ctrlKey) // Shift + Click open the url in a new window. //TODO: doesn't work on FF
					window.open(style.url);
				else
					document.location.href = style.url;
			});

		layer.on('mouseover mousemove', function(e) {
			if (style.degroup)
				this._degroup(layer, style.degroup);

			// Display a label when hover the feature.
			if (style.title) {
				var popupAnchor = style.popupAnchor || [0, 0];
				new(L.Rrose || L.Popup)({
					offset: new L.Point(popupAnchor[0], popupAnchor[1]), // Avoid to cover the marker with the popup.
					className: style.labelClass ? style.labelClass : '',
					closeButton: false,
					autoPan: false
				})
				.setContent(style.title)
					.setLatLng(e.latlng)
					.openOn(this._map);

				// Close the label when moving out of the marker
				if (!style.remanent) {
					layer.off('mouseout', this._closePopup); // Only once
					layer.on('mouseout', this._closePopup); // Use named function to not off all mouseout when layer off 'mouseout'
				}
			}
		}, this);

		// Finish as usual.
		L.GeoJSON.prototype._setLayerStyle.call(this, layer, style);
	},

	_closePopup: function() {
		if (this._map)
			this._map.closePopup();
	},

	// Isolate too close markers when the mouse hover over the group.
	_degroup: function(p1, delta) {
		var ll1 = p1._latlng;
		if (ll1) { // Only for markers
			var xy1 = this._map.latLngToLayerPoint(ll1); // XY point overflown.
			for (l in this._layers) {
				var p2 = this._layers[l]; // An other point.
				if (!p2._lli) // Mem the initial position of each points (_lli is local to this routine).
					p2._lli = p2._latlng;
				if (p2._latlng &&
					p1._leaflet_id != p2._leaflet_id) {
					var xy2 = this._map.latLngToLayerPoint(p2._lli), // XY other point.
						dp = xy2.distanceTo(xy1); // Distance between the itarated point & the overflown point.
					if (!dp) // If the 2 points are too close, we shift right one.
						p2.setLatLng(this._map.layerPointToLatLng(xy2.add([delta, 0])));
					else
						p2.setLatLng(
							dp > delta ? p2._lli // If it's far, we bring it at it initial position.
							: [ // If not, we add to the existing shift.
								ll1.lat + (p2._lli.lat - ll1.lat) * delta / dp,
								ll1.lng + (p2._lli.lng - ll1.lng) * delta / dp
							]
						);
				}
			}
		}
	}
});


/* L.GeoJSON.Ajax
 * Remote access to geoJson data flow
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
		L.GeoJSON.prototype.initialize.call(this, null, options);

		// Change class of id="ajax-status" to class="ajax-<STATUS>"
		// <STATUS> = none | zoom | wait | some | zero | error
		this.elAjaxStatus = document.getElementById(this.options.idAjaxStatus) || document.createElement('div');

		// Prepare the Request object
		if (window.XMLHttpRequest)
			this.ajaxRequest = new XMLHttpRequest();
		else if (window.ActiveXObject)
			this.ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		else {
			alert('Your browser doesn\'t support AJAX requests.');
			exit;
		}
		this.ajaxRequest.context = this; // Reference the layer object for further usage.
		this.ajaxRequest.onreadystatechange = this._onreadystatechange; // Action when receiving data
	},

	onAdd: function(map) {
		L.GeoJSON.prototype.onAdd.call(this, map);

		this.reload(); // Load it at the beginning.

		if (this.options.bbox) // Replay if the map moves
			this._map.on('moveend', this.reload, this);
	},

	onRemove: function(map) {
		this.elAjaxStatus.className = '';
		this._map.off('moveend', this.reload, this);

		L.GeoJSON.prototype.onRemove.call(this, map);
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
	},

	// Action when receiving data
	_onreadystatechange: function(e) {
		if (e.target.readyState < 4) // Still in progress
			;
		else if (e.target.status == 200)
			e.target.context.redraw(e.target.responseText);
		else if (typeof e.target.context['error' + e.target.status] == 'function')
			e.target.context['error' + e.target.status].call(e.target.context);
		else if (e.target.status)
			alert('ajaxRequest error status = ' + e.target.status + ' calling ' + e.target.context._getUrl());
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
				alert('Json syntax error on ' + this._getUrl() + ' :\n' + json);
				this.elAjaxStatus.className = 'ajax-error';
				return;
			}
			// Perform a special calculation if necessary (used by OSM overpass)
			if (typeof this._tradJson == 'function')
				js = this._tradJson.call(this, js);

			// Add it to the layer
			this.addData(js);

			if (this.elAjaxStatus.className == 'ajax-wait')
				this.elAjaxStatus.className =
				js.length || (js.features && js.features.length) ? 'ajax-some' : 'ajax-zero';
		}
	}
});