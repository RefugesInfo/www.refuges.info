/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Register permalink in a cookie & recover it at each load
 */

L.Control.Permalink.Cookies = L.Control.Permalink.extend({

	_pk: document.cookie.match(/permalink=([^;]+)/), // Mem here before it's corrupted by L.Control.Permalink._update_href

	options: {
		useAnchor: false, // Permalink URL use ? url?arg=value&... (not #)
		move: true, // Move the map to the cookie position when initialising the control
		layer: true // Set the map to the cookie layer.
	},

	onAdd: function(map) {
		if (this._pk && !this._params.zoom) // Priority url arguments, then cookies
			this._params = L.UrlUtil.queryParse(this._pk[1]);

		return L.Control.Permalink.prototype.onAdd.call(this, map);
	},

	_set_center: function(e) {
		var p = e.params;
		if (p.zoom && p.lat && p.lon && this.options.move)
			this._map.setView(
				new L.LatLng(p.lat, p.lon),
				p.zoom, {
					reset: true
				}
			);
	},

	_set_layer: function(e) {
		if (this.options.layer)
			L.Control.Permalink.prototype._set_layer.call(this, e);
	},

	_update_href: function() {
		document.cookie = 'permalink=' + L.Util.getParamString(this._params).substring(1) + ';path=/';
		return L.Control.Permalink.prototype._update_href.call(this);
	}
});