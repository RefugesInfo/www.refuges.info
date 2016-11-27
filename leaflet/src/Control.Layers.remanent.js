/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Keep the layer selector open until we leave or click the map
 */

L.Control.Layers.include({
	addTo: function(map) {
		var r = L.Control.prototype.addTo.call(this, map);

		L.DomEvent.on(this._container, {
			mouseleave: this.expand, // Re expand this one after collapsing
			mouseenter: function() {
				map.fire('cl_collapse', this); // Collapse all other layer.control
			}
		}, this);
		map.on('cl_collapse', this._collapse_others, this);
		map.on('mouseout', this.collapse, this); // Collapse when leaving the map

		return r;
	},

	_collapse_others: function(e) {
		if (e._leaflet_id != this._leaflet_id)
			this.collapse();
	},

	remove: function() {
		map.off('cl_collapse', this._collapse_others, this);
		map.off('mouseout', this.collapse, this); // Collapse when leaving the map

		L.Control.prototype.remove.call(this);
	}
});