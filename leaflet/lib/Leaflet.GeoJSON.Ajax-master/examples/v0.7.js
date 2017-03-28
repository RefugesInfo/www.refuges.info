// Stub for V1.0 changes
L.Control.Layers.argsGeoJSON = L.Control.Layers.extend({
	initialize: function (jsonLayer) {
		L.Control.Layers.prototype.initialize.call(this, {}, {'chemineur.fr': jsonLayer});
	}
});
