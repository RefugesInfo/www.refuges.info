/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported on Leaflet V0.7 & V1.0
 *
 * Allows the use of layers with different projections on the same map
 * Such layer must be declared with layer.options.crs = L.CRS.EPSG****; // default EPSG3857
 *
 * Usage : no specific call : just add this file before declare your map.
 */

L.Map.addInitHook(function() {
	this.on('layeradd', function(e) {
		if (e.layer.options) {
			var crs = e.layer.options.crs || L.CRS.EPSG3857;

			if (e.layer.options.tileSize && // Is that a TileLayer ?
				this.options.crs != crs) { // Has the projection changed ?

				// We store the previous map parameters
				var bounds = this.getBounds(),
					center = this.getCenter();

				// We setup the map Coordinate Reference with the layer CRS
				this.options.crs = crs;

				// We search the new CRS zoom closest to the previous
				var nw = bounds.getNorthWest(),
					se = bounds.getSouthEast(),
					diagMap = this.getSize().distanceTo(L.point(0, 0)),
					minGap = Infinity;

				for (z = 0; z < this.getMaxZoom(); z++) {
					var diagBoundsAtZoom = this.project(se, z).distanceTo(this.project(nw, z)),
						gap = Math.abs(diagBoundsAtZoom - diagMap);
					if (gap < minGap) {
						minGap = gap;
						closestZoom = z;
					}
				}

				// We reinitialize the map & redraw all the layers with the new projections
				this._resetView(center, closestZoom);
			}
		}
	}, this);
});