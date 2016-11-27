/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Add presentation & actions to geoJSON layers
 *
 * geoJSON Spécifications: http://geojson.org/geojson-spec.html
 * With the great initial push from https://github.com/LeOSW42
 */

L.Marker.include({
	setStyle: function(style) {
		L.setOptions(this, style);

		if (this._map) {
			this._initIcon();
			this.update();
		}

		return this;
	},
});

L.GeoJSON.Style = L.GeoJSON.extend({
	// Modify the way the layer representing one of the features is displayed
	_setLayerStyle: function(layer, layerStyle) {
		// Merge layer style & feature properties.
		var style = L.extend(
			{ // Default
				popupAnchor: [0, -8],
				popupClass: '',
				popupValidity: 100
			},
			layer.feature.properties, // Low priority: geoJSON properties.
			typeof layerStyle == 'function'
				? layerStyle.call(this, layer.feature) // When layer.options.style is a function
				: layerStyle // Priority one: layer.options.style
		);

		// Use an icon file to display a marker.
		if (style.iconUrl && typeof layer.setIcon == 'function')
			layer.setIcon(L.icon(style));

		function onClick(e) {
			e = e.originalEvent || e;
			if (e.shiftKey || e.ctrlKey) // Shift + Click open the url in a new window. //TODO: doesn't work on FF
				window.open(style.url);
			else
				document.location.href = style.url;
		}

		layer.on('mouseover mousemove', function(e) {
			// Display a label when hover the feature.
			if (style.popup) {
				var popup = new(L.Rrose || L.Popup)({
						offset: new L.Point(style.popupAnchor[0], style.popupAnchor[1]), // Avoid to cover the marker with the popup.
						className: style.popupClass,
						closeButton: false,
						autoPan: false
					});
				popup.setContent(style.popup)
					.setLatLng(e.latlng)
					.openOn(this._map);

				if (style.url) {
					popup._container.style.cursor = 'pointer';
					popup._container.addEventListener('click', onClick, false);
				}

				// Mem the popup position to be able to delete it when moving far
				this.popupLatlng = e.latlng;
			}
		}, this);

		// Close popups when moving > popupValidity px far or leaving the map
		if (this._map) {
			if (style.popupValidity)
				this._map.on('mousemove', function(e) {
					if (typeof this.popupLatlng == 'object') {
						var popupXY = this._map.latLngToLayerPoint(this.popupLatlng),
							dist = Math.hypot(popupXY.x - e.layerPoint.x, popupXY.y - e.layerPoint.y);
						if (dist > style.popupValidity)
							this._closePopup();
					}
				}, this);
			else
				layer.on('mouseout', this._closePopup, this);

			this._map.on('mouseout', this._closePopup, this);
		}

		// Navigate the the url when clicking a feature.
		if (style.url)
			layer.on('click', onClick);

		// Isolate too close markers when the mouse hovers over the group.
		layer.on('mouseover', function(e) {
			if (style.degroup)
				this._degroup(layer, style.degroup);
		}, this);

		// Drag the icon & take actions
		if (typeof style.draggable == 'function')
			layer.on('dragstart drag dragend', style.draggable, this);

		// Finish as usual.
		L.GeoJSON.prototype._setLayerStyle.call(this, layer, style);
	},

	_closePopup: function() {
		if (this._map)
			this._map.closePopup();
		delete this.popupLatlng;
	},

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
						dp = xy2.distanceTo(xy1); // Distance between the iterated point & the overflown point.
					if (!dp) // If the 2 points are too close, we shift right one.
						p2.setLatLng(this._map.layerPointToLatLng(xy2.add([delta, 0])));
					else
						p2.setLatLng(
							dp > delta ? p2._lli // If it's far, we bring it at it initial position.
							:
							[ // If not, we add to the existing shift.
								ll1.lat + (p2._lli.lat - ll1.lat) * delta / dp,
								ll1.lng + (p2._lli.lng - ll1.lng) * delta / dp
							]
						);
				}
			}
		}
	}
});