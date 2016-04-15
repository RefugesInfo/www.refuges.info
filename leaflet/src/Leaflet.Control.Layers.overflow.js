/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Tune the control layer height accordighly with map width
 * in case of the layer list exceed the map height
 */

L.Control.Layers.overflow = L.Control.Layers.extend({

	onAdd: function(map) {
		L.Control.Layers.prototype.onAdd.call(this, map);

		map.on('resize', this._autoHeight, this);
		this._autoHeight();

		return this._container;
	},

	_autoHeight: function() {
		this._baseLayersList.style.maxHeight = (this._map._container.offsetHeight - 86) + 'px';
		this._baseLayersList.style.overflow = 'auto';
	}
});