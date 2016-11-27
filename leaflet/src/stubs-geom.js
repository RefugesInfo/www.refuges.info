/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Missing declaration due to Leaflet build optimisation
 */

L.Marker.include.prototype.closePopup = L.Marker.include.prototype.closePopup || function(){return this};
L.ImageOverlay = L.ImageOverlay || L.Class.extend({});
L.DivIcon      = L.DivIcon      || L.Class.extend({});
L.Rectangle    = L.Rectangle    || L.Polygon.extend({});

// Proposed upgrade LL 1.1
L.LayerGroup.include({
	eachLayerRecursive: function (method, context) {
		this.eachLayer(function(layer) {
			method.call(context, layer);
			if (layer._layers)
				layer.eachLayerRecursive (method, context);
		});
	}
});
