/*
 * Copyright (c) 2015 Dominique Cavailhez
 * Leaflet extension for Leaflet.draw
 * Markers, polylines, polygons, rectangles & circle editor
 * Snap on others markers, lines & polygons including the edited shape itself
 * Need https://github.com/Leaflet/Leaflet.draw and https://github.com/makinacorpus/Leaflet.Snap
 */

L.Control.Draw.Plus = L.Control.Draw.extend({
	snapLayers: new L.FeatureGroup(), // Container for layers used for snap
	editLayers: new L.FeatureGroup(), // Container for editable layers

	options: { // Force default to false to have to declare only required commands
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
		changed: 'edit-changed' // <span id="edit-changed" style="display:none">changed</span> : warn changes to be saved
	},

	initialize: function(options) {
		// Allign drawing style on display
		L.Util.extend(L.Draw.Polyline.prototype.options.shapeOptions, L.Polyline.prototype.options);
		L.Util.extend(L.Draw.Polygon.prototype.options.shapeOptions, L.Polygon.prototype.options);

		options.edit = L.extend(this.options.edit, options.edit); // Init false non chosen options
		options.draw = L.extend(this.options.draw, options.draw);
		for (var o in options.draw)
			if (options.draw[o])
				options.draw[o] = {
					guideLayers: [this.snapLayers] // Allow snap on creating elements
				};

		L.Control.Draw.prototype.initialize.call(this, options);
	},

	onAdd: function(map) {
		this._toolbars['edit'].options.featureGroup = this.editLayers; // Link the layers to edit
		this.editLayers.addTo(this.snapLayers); // Cascade to snapLayers & add the map
		this.snapLayers.addTo(map); // Make all this visble

		// Add new features to the editor
		map.on('draw:created', function(e) {
			this.addLayer(e.layer);
		}, this);

		// Remove deleted features from the editor
		map.on('layerremove', function(e) {
			this.editLayers.removeLayer(e.layer);
		}, this);

		// Read geoJson field to be edited
		var ele = document.getElementById(this.options.entry);
		if (ele) {
			var elei = typeof ele.value != 'undefined' ? 'value' : 'innerHTML',
				gjs = JSON.parse(
					ele[elei].replace(/\s/g, '') || // Get & clean geoJson input
					'{"type":"FeatureCollection","features":[]}' // Default
				);

			new L.GeoJSON(
				this.explodeMultiFeatures(gjs),
				this.options.jsonOptions
			).addTo(this);
		}

		// Clean features & rewrite json field
		map.on('draw:created draw:editvertex', this._optimSavGeom, this); // When something has changed
		this._optimSavGeom(false); // At the init

		return L.Control.Draw.prototype.onAdd.call(this, map);
	},

	// 	Leaflet.draw does not work with multigeometry features such as MultiPoint, MultiLineString, MultiPolygon, or GeometryCollection.
	//	If you need to add multigeometry features to the draw plugin, convert them to a FeatureCollection of non-multigeometries (Points, LineStrings, or Polygons).
	explodeMultiFeatures: function(f) {
		// Prepare replacement structure
		var r = {
			type: 'FeatureCollection',
			features: []
		};

		switch (f.type) {
			case 'FeatureCollection': // Recurse in FeatureCollection
				for (var i = 0; i < f.features.length; i++)
					r.features.push(this.explodeMultiFeatures(f.features[i]));
				return r;

			case 'Feature': // Recurse in Feature
				return this.explodeMultiFeatures(f.geometry);

			case 'MultiPoint': // Convert Multi* geoms
			case 'MultiLineString':
			case 'MultiPolygon':
				for (var i = 0; i < f.coordinates.length; i++)
					r.features.push({
						type: f.type.replace('Multi', ''),
						coordinates: f.coordinates[i]
					});
				return r;
		}
		return f;
	},

	addLayer: function(layer) {
		// Récurse in GeometryCollection
		if (layer._layers) {
			for (var l in layer._layers)
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

		layer.snapediting.addGuideLayer(this.snapLayers);
		layer.snapediting.enable();
		this._optimSavGeom(); // Optimize & write full json on output element

		// Close enables edit toolbar handlers & save changes
		layer.on('deleted', function() {
			for (m in this._toolbars['edit']._modes)
				this._toolbars['edit']._modes[m].handler.disable();
			this._optimSavGeom();
		}, this);
	},

	_optimSavGeom: function(changed) {
		// Optimize the edited layers
		var ls = this.editLayers._layers;
		if (!this._map.noOptim) // To optimize "cut" !!
			for (var il1 in ls) { // For all layers being edited
				var ll1 = ls[il1]._latlngs;
				if (ll1 && !ls[il1].options.fill) { // Only polylines

					// Transform polyline whose the 2 ends match into polygon
					if (ll1[0].equals(ll1[ll1.length - 1]) && // The 2 ends match
						ll1.length > 3) { // If it will make at least a triangle (4 summits line).
						this.editLayers.removeLayer(ls[il1]); //DCCM TODO bug : create a bug while finishing dragend after the poly removal
						this.addLayer(new L.Polygon(ll1)); // Create a new polygon & restart optimization from scratch
						return; // End here the current optimization
					}

					// Merge polylines having ends at the same position
					for (var il2 in ls) {
						var ll2 = ls[il2]._latlngs,
							lladd = null; // List of points to move to another polyline
						if (il1 < il2 && // Not the same & only once each pair
							ll2 && !ls[il2].options.fill) { // The 2nd is also a polyline
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
								this.editLayers.removeLayer(ls[il1]); // Erase the initial polylines
								this.editLayers.removeLayer(ls[il2]);
								this.addLayer(new L.Polyline(ll1.concat(lladd))); // Create a new poly & restart optimization from scratch
								return; // End here the current optimization
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
			ele[elei] = JSON.stringify(this.editLayers.toGeoJSON());
		}
		this._map.fire('draw:entry-changed'); // For user's usage

		// Unmask "changed" message
		if (elc)
			elc.style.display = changed === false ? 'none' : '';
	}
});

// Cut a polyline by removing a segment whose the middle marker is cliqued
// Cut a polygon by removing a segment whose the middle marker is cliqued & transform it into polyline

// Horrible hack : modify onClick action on MiddleMarkers Leaflet.draw/Edit.Poly.js & generated files
eval('L.Edit.PolyVerticesEdit.prototype._createMiddleMarker = ' +
	L.Edit.PolyVerticesEdit.prototype._createMiddleMarker.toString()
	.replace(/'click', onClick, this|'click',[a-z],this/g, "'click',this._cut,this")
);

L.Edit.PolyVerticesEdit.include({
	_cut: function(e) {
		// Split markers on each side of the cut
		var found = 0,
			lls = [[],[]];
		for (m in this._markers) {
			lls[found].push(this._markers[m]._latlng);
			if (this._markers[m]._middleRight && this._markers[m]._middleRight._leaflet_id == e.target._leaflet_id)
				found = 1; // We find the cut point
		}

		// Remove the old poly
		this._map.removeLayer(this._poly);

		// This is a Polygon, we will remove the clicked segment & transform it into a Polyline
		if (this._poly.options.fill)
			this._map.fire('draw:created', { // Create a new Polyline with these summits & optimize
				layer: new L.Polyline(lls[1].concat(lls[0]))
			});

		// This is a polyline
		else
			for (f in lls)
				if (lls[f].length > 1)
					this._map.fire('draw:created', { // Create a new Polyline with the splited summits if any
						layer: new L.Polyline(lls[f])
					});

		// Optimize
		this._map.fire('draw:editvertex');
	}
});