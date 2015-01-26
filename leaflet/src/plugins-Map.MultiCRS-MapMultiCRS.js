/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Allow to use layers with different projections on the same map
 * Such layer needs to be declared with layer.options.crs = L.CRS.EPSG****;
 */

L.Map.MultiCRS = L.Map.extend({

	initialize: function(id, options) { // (HTMLElement or String, Object)
		// We get CRS of initial layer if any
		for (l in options.layers)
			if (options.layers[l].options.crs)
				options.crs = options.layers[l].options.crs;

		// Setup change map CRS if layer changed
		this.on('baselayerchange', function(event) {
			event.layer._map.setCRS(event.layer.options.crs);
		});

		L.Map.prototype.initialize.call(this, id, options);
	},

	// Change map CRS
	setCRS: function(crs) {
		if (this.options.crs == crs)
			return;

		// We store the previous map parameters
		var bounds = this.getBounds(),
			center = this.getCenter();

		// We setup the map Coordinate Reference with the layer CRS
		this.options.crs = crs ? crs : L.CRS.EPSG3857;

		// We search the new CRS zoom closest to the previous
		var nw = bounds.getNorthWest(),
			se = bounds.getSouthEast(),
			diagMap = this.getSize().distanceTo(L.point(0, 0)),
			ecartMin = Infinity;

		for (z = 0; z < this.getMaxZoom(); z++) {
			var diagBoundsAtZoom = this.project(se, z).distanceTo(this.project(nw, z)),
				ecart = Math.abs(diagBoundsAtZoom - diagMap);
			if (ecart < ecartMin) {
				ecartMin = ecart;
				closestZoom = z;
			}
		}

		// We reinitialize the map & redraw all the layers with the new projections
		this._resetView(center, closestZoom);
	}
});