/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Add presentation & actions to geoJSON format
 *
 * geoJSON Spécifications: http://geojson.org/geojson-spec.html
 * With the great initial push from https://github.com/LeOSW42
 */

L.GeoJSON.Style = L.GeoJSON.extend({
	_setLayerStyle: function(layer, layerStyle) {
		// Merge layer style & feature properties.
		var style = L.extend({},
			layer.feature.properties, // Low priority: geoJSON properties.
			typeof layerStyle == 'function'
				? layerStyle(layer.feature) // Priority one: layer.options.style()
				: layerStyle // | layer.options.style
		);

		// Use an icon file to display a marker.
		if (style.iconUrl)
			layer.setIcon(L.icon(style));

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
				this._degroup(e.target, style.degroup);

			// Display a label popup when hover the feature.
			var popupAnchor = style.popupAnchor || [0,-45];
			if (style.title)
				new L.Rrose({
					offset: new L.Point(popupAnchor[0], popupAnchor[1]), // Avoid to cover the marker with the popup.
					closeButton: false,
					autoPan: false
				})
				.setContent(style.title)
				.setLatLng(e.latlng)
				.openOn(this._map);
		}, this);
		layer.on('mouseout', function(e) {
			// Remove the popup at the end of the hover.
			if (this._map)
				this._map.closePopup();
		});

		// Finish as usual.
		L.GeoJSON.prototype._setLayerStyle.call(this, layer, style);
	},

	// Isolate too close markers when the mouse hover over the group.
	_degroup: function(p1, delta) {
		var ll1 = p1._latlng,
			xy1 = this._map.latLngToLayerPoint(ll1); // XY point overflown.
		for (l in this._layers) {
			var p2 = this._layers[l]; // An other point.
			if (!p2._lli) // Mem the initial position of each points.
				p2._lli = p2._latlng;
			if (p1._leaflet_id != p2._leaflet_id) {
				var xy2 = this._map.latLngToLayerPoint(p2._lli), // XY other point.
					dp = xy2.distanceTo(xy1); // Distance between the itarated point & the overflown point.
				if (!dp) // If the 2 points are too close, we shift right one.
					p2.setLatLng(this._map.layerPointToLatLng(xy2.add([delta, 0])));
				else
					p2.setLatLng(
						dp > delta
							? p2._lli // If it's far, we bring it at it initial position.
							: [ // If not, we add to the existing shift.
								ll1.lat + (p2._lli.lat - ll1.lat) * delta / dp,
								ll1.lng + (p2._lli.lng - ll1.lng) * delta / dp
							]
					);
			}
		}
	}
});