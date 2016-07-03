/*
 * Copyright (c) 2015 Dominique Cavailhez
 * Leaflet extension for Leaflet.draw
 * Markers, polylines, polygons, rectangles & circle editor
 * Snap on others markers, lines & polygons including the edited shape itself
 * Need https://github.com/Leaflet/Leaflet.draw and https://github.com/makinacorpus/Leaflet.Snap
 */

L.Control.Draw.Plus = L.Control.Draw.extend({
	snapLayers: new L.FeatureGroup(), // Container of layers used for snap
	editLayers: new L.FeatureGroup(), // Container of editable layers

	options: {
		draw: {
			marker: false, // Capability to create a marker
			polyline: false, // Capability to create a polyline
			polygon: false, // Capability to create a polygon
			rectangle: false, // Capability to create a rectangle
			circle: false // Capability to create a circle
		},
		edit: {
			edit: false, // Capability to edit a feature
			remove: false // Capability to remove a feature
		},
		entry: 'edit-json', // <textarea id="edit-json">JSON</textarea> | <input type="hidden" id="edit-json" name="xxx" value="JSON"> : geoJson field to be edited
		jsonOptions: {}, // Options to be used when retreiving Json from <input />
		editType: null, // Type of entry: Marker | [Multi]Poly[line|gon]
		changed: 'edit-changed' // <span id="edit-changed" style="display:none">changed</span> : warn changes to be saved
	},

	initialize: function(options) {
		// Allign drawing style on display
		L.Util.extend(L.Draw.Polyline.prototype.options.shapeOptions, L.Polyline.prototype.options);
		L.Util.extend(L.Draw.Polygon.prototype.options.shapeOptions, L.Polygon.prototype.options);

		options.edit = L.extend(this.options.edit, options.edit); // Init false non chosen options
		options.draw = L.extend(this.options.draw, options.draw);
		for (o in options.draw)
			if (options.draw[o])
				options.draw[o] = {
					guideLayers: [this.snapLayers]
				}; // Allow snap on creating elements

		L.Control.Draw.prototype.initialize.call(this, options);
	},

	onAdd: function(map) {
		this.editToolbar = this._toolbars[Object.keys(this._toolbars)[1]]; // Find edit tool bar
		this.editToolbar.options.featureGroup = this.editLayers; // Link the layers to edit
		this.editLayers.addTo(this.snapLayers); // Cascade to snapLayers & add the map
		this.snapLayers.addTo(map); // Make all this visble

		map.on('draw:created', function(e) {
			this.addLayer(e.layer);
		}, this); // Add a new feature
		map.on('draw:edited draw:deleted', this._optimPoly, this); // Finish modifications & upload

		var ele = document.getElementById(this.options.entry),
			elc = document.getElementById(this.options.changed);
		if (ele) {
			var elei = typeof ele.value != 'undefined' ? 'value' : 'innerHTML',
				ljs = new L.GeoJSON(JSON.parse(ele[elei] || '{"type":"FeatureCollection","features":[]}'), this.options.jsonOptions)._layers;

			// Read geoJson field to be edited
			for (l in ljs)
				ljs[l].addTo(this);

			// Write edited geoJson field
			map.on('draw:edited', function() {
				if (!this.options.editType)
					ele[elei] = JSON.stringify(this.editLayers.toGeoJSON()); // Basic FeatureCollection output
				else {
					// Specific format filter / transformation
					var p = [];
					this.editLayers.eachLayer(function(l) {
						if (this.options.editType == 'Marker') {
							// Marker : Only the last point will be saved {"type":"Point","coordinates":[0,0]}
							if (l._latlng)
								p = l._latlng;
						} else if (l._latlngs) {
							if (this.options.editType.substring(0, 5) == 'Multi')
							// MultiPolyline : All poly will be saved / converted  in {"type":"MultiLineString","coordinates":[[[[0,0],[0,0]]],[[[0,0],[0,0]]]]}
							// MultiPolygon : All poly will be saved / converted  in {"type":"MultiPolygon","coordinates":[[[[0,0],[0,0]]],[[[0,0],[0,0]]]]}
								p.push(l._latlngs);
							else
							// Polyline : Only the last poly will be saved / converted in {"type":"LineString","coordinates":[[0,0],[0,0]]}
							// Polygon : Only the last poly will be saved / converted in {"type":"Polygon","coordinates":[[0,0],[0,0]]}
								p = l._latlngs;
						}
					}, this);

					ele[elei] = JSON.stringify(new L[this.options.editType](p).toGeoJSON().geometry);
				}

				// Unmask "changed" message
				if (elc)
					elc.style.display = '';
			}, this);
		}

		return L.Control.Draw.prototype.onAdd.call(this, map);
	},

	// Add a new feature
	addLayer: function(layer) {
		// Récurse in GeometryCollection
		if (layer._layers) {
			for (l in layer._layers)
				this.addLayer(layer._layers[l]);
			return;
		}

		// Change color when hover (to be able to see different poly)
		layer.on('mouseover mouseout', function(e) {
			if (typeof e.target.setStyle == 'function')
				e.target.setStyle({
					color: e.type == 'mouseover' ? 'red' : L.Polyline.prototype.options.color
				});
		});

		// Add snapping to vectors layers
		layer.addTo(this.editLayers);
		if (layer._latlng) // Point
			layer.snapediting = new L.Handler.MarkerSnap(this._map, layer);
		else if (layer._latlngs) // Polyline, Polygon, Rectangle
			layer.snapediting = new L.Handler.PolylineSnap(this._map, layer);
		else // ?? protection
			return;

		layer.options.editing = {};
		layer.snapediting.addGuideLayer(this.snapLayers);
		layer.snapediting.enable();

		// Close enables edit toolbar handlers & save changes
		layer.on('deleted', function() {
			for (m in this.editToolbar._modes)
				this.editToolbar._modes[m].handler.disable();
		}, this);

		// Fire the map to enable any changes uploads
		layer.on('created edit dragend deleted', function() {
			this._map.fire('draw:edited');
		}, this);

		layer.fire('created');
	},

	_optimPoly: function() {
		var ls = this.editLayers._layers;
		for (il1 in ls) { // For all layers being edited
			var ll1 = ls[il1]._latlngs;
			if (ll1 && !ls[il1].options.fill) { // For all polylines
				// Transform polyline whose the 2 ends match into polygon
				if (ll1[0].equals(ll1[ll1.length - 1])) {
					this.editLayers.removeLayer(ls[il1]);
					this._map.fire('draw:created', {
						layer: new L.Polygon(ll1)
					});
				}
				// Merge polylines having ends at the same position
				for (il2 in ls) {
					var ll2 = ls[il2]._latlngs,
						lladd = null; // List of points to move to another polyline
					if (ll2 && !ls[il2].options.fill && // The other is also a polyline
						ls[il1]._leaflet_id < ls[il2]._leaflet_id) { // Only once each pair
						if (ll1[0].equals(ll2[0])) {
							ll1.reverse();
							lladd = ll2;
						} else if (ll1[0].equals(ll2[ll2.length - 1])) {
							ll1.reverse();
							lladd = ll2.reverse();
						} else if (ll1[ll1.length - 1].equals(ll2[0])) {
							lladd = ll2;
						} else if (ll1[ll1.length - 1].equals(ll2[ll2.length - 1])) {
							lladd = ll2.reverse();
						}
						if (lladd) {
							ll1.pop(); // We remove the last point as it's already there
							ls[il1]._latlngs = ll1.concat(lladd);
							ls[il1].editing._poly.redraw(); // Redraw the lines
							ls[il1].snapediting.updateMarkers(); // Redraw the markers
							this.editLayers.removeLayer(ls[il2].editing._poly); // Erase the initial polyline
							this._map.fire('draw:edited'); // Redo this until there are no more merge to do
						}
					}
				}
			}
		}
	}
});

// Cut a polyline by removing a segment whose the middle marker is cliqued
// Cut a polygon by removing a segment whose the middle marker is cliqued & transform it into polyline
// This needs modification of Leaflet.draw/src/edit/handler/Edit.Poly line 233 : .on('click', this._cut, this)
L.Edit.Poly.include({
	_cut: function(e) {
		if (e.target._index)
			return; // Did not click a middle marker !

		var marker1, marker2;
		for (m in this._markers)
			if (this._markers[m]._middleRight && this._markers[m]._middleRight._leaflet_id == e.target._leaflet_id)
				marker1 = this._markers[m];
			else if (this._markers[m]._middleLeft && this._markers[m]._middleLeft._leaflet_id == e.target._leaflet_id)
			marker2 = this._markers[m];

		if (this._poly.options.fill) { // This is a polygon, we will remove the clicked segment & transform it to polyline
			var ll = [];
			for (var s = 0; s < this._markers.length; s++) // Roll the summits beginning at the clicked segment
				ll.push(this._markers[(marker2._index + s) % this._markers.length]._latlng);

			// And use these summits to create a new polyline
			this._poly._map.fire('draw:created', {
				layer: new L.Polyline(ll)
			});
			this._poly._map.removeLayer(this._poly); // Remove the old polygon
		} else { // This is a polyline
			if (!marker1._prev && !marker2._next) // This is a single segment
				this._poly._map.removeLayer(this._poly); // Just delete the poly
			else if (!marker1._prev) // This is the first segment
				this._onMarkerClick({
				target: marker1,
				remove: true // Just remove it
			});
			else if (!marker2._next) // This is the last segment
				this._onMarkerClick({
				target: marker2,
				remove: true // Just remove it
			});
			else {
				var ll = [];
				while (m = this._markers[marker2._index]) { // Remove all the summits between the cut & the end line
					ll.push(m._latlng);
					this._onMarkerClick({
						target: m,
						remove: true
					});
				}
				// And reuse these summits to create a new polyline
				this._poly._map.fire('draw:created', {
					layer: new L.Polyline(ll, this._poly.options)
				});
			}
		}
	}
});