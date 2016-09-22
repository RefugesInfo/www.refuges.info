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
		this._toolbars['edit'].options.featureGroup = this.editLayers; // Link the layers to edit
		this.editLayers.addTo(this.snapLayers); // Cascade to snapLayers & add the map
		this.snapLayers.addTo(map); // Make all this visble

		// Add all new features to the map
		map.on('draw:created', function(e) {
			this.addLayer(e.layer);
			e.layer.on('deleted', this._optimSavGeom, this);
		}, this);

		// Read geoJson field to be edited
		var ele = document.getElementById(this.options.entry),
			elc = document.getElementById(this.options.changed);
		if (ele) {
			var elei = typeof ele.value != 'undefined' ? 'value' : 'innerHTML';

			var ljs = new L.GeoJSON(
				JSON.parse(ele[elei] || '{"type":"FeatureCollection","features":[]}'),
				this.options.jsonOptions
			)._layers;
			for (l in ljs)
				ljs[l].addTo(this);
		}

		// Finish modifications & upload
		map.on('draw:created draw:editvertex', this._optimSavGeom, this);
		this._optimSavGeom(); // Clean & rewrite json field at the init

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
			for (m in this._toolbars['edit']._modes)
				this._toolbars['edit']._modes[m].handler.disable();
			this._optimSavGeom();
		}, this);
	},

	_optimSavGeom: function() {
		if (this._map.noOptim)
			return;

		// Optimize the edited layers
		var ls = this.editLayers._layers;
		for (il1 in ls) { // For all layers being edited
			var ll1 = ls[il1]._latlngs;
			if (ll1 && !ls[il1].options.fill) { // For all polylines
				// Transform polyline whose the 2 ends match into polygon
				if (ll1[0].equals(ll1[ll1.length - 1])) {
					this.editLayers.removeLayer(ls[il1]);
					if (ll1.length > 2) // If at least a triangle. Otherwize delete it.
						this._map.fire('draw:created', { // Create a Polygon
							layer: new L.Polygon(ll1)
						});
				}
				// Merge polylines having ends at the same position
				for (il2 in ls) {
					var ll2 = ls[il2]._latlngs,
						lladd = null; // List of points to move to another polyline
					if (ls[il1] && // The first hasn't been deleted !
						ll2 && !ls[il2].options.fill && // The 2nd is also a polyline
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
							lladd.shift(); // We avoid the first point as it's already on the first poly
							var nll = ls[il1]._latlngs.concat(lladd); // We concatenate the 2 polys lls
							this.addLayer(new L.Polyline(nll)); // Create a new poly
							this.editLayers.removeLayer(ls[il1]); // Erase the initial polylines
							this.editLayers.removeLayer(ls[il2]);
							return this._optimSavGeom(); // Redo this until there are no more merge to do
						}
					}
				}
			}
		}

		// Save edited data to the json output field
		var ele = document.getElementById(this.options.entry),
			elc = document.getElementById(this.options.changed);
		if (ele) {
			var elei = typeof ele.value != 'undefined' ? 'value' : 'innerHTML';
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
		}

		// Unmask "changed" message
		if (elc)
			elc.style.display = '';
	}
});

// Cut a polyline by removing a segment whose the middle marker is cliqued
// Cut a polygon by removing a segment whose the middle marker is cliqued & transform it into polyline

// Horible hack : modify onClick action on MiddleMarkers Leaflet.draw/Edit.Poly.js & generated files
eval ('L.Edit.PolyVerticesEdit.prototype._createMiddleMarker = ' +
	L.Edit.PolyVerticesEdit.prototype._createMiddleMarker.toString()
		.replace (/'click', onClick, this|'click',[a-z],this/g, "'click',this._cut,this")
);

L.Edit.PolyVerticesEdit.include({
	_cut: function(e) {
		if (this._markers.length < 3) // Last segment
			return;

		// Find closest markers
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
			this._poly._map.fire('draw:created', { // Create a new Polyline
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
				this._map.noOptim = true;
				var ll = [];
				while (m = this._markers[marker2._index]) { // Remove all the summits between the cut & the end line
					ll.push(m._latlng);
					this._onMarkerClick({
						target: m
					});
				}
				this._map.noOptim = false;

				// And reuse these summits to create a new polyline
				this._poly._map.fire('draw:created', { // Create a new Polyline
					layer: new L.Polyline(ll, this._poly.options)
				});
			}
		}
	}
});
