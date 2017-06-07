/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Checkbox control for Ajax layers parameters
 */

L.Control.Layers.argsGeoJSON = L.Control.Layers.extend({
	_kl: document.cookie.match(/layerargs=([^;]+)/), // Mem here before it's corrupted by L.Control.Permalink._update_href
	_ac: window.location.search.match(/cookie=([^&]*)/), // URL argument

	initialize: function(jsonLayer, argsGeoJSON, options) {
		this.jsonLayer = jsonLayer;
		// Stubs for layer behavior of args params choices.
		for (i in argsGeoJSON) {
			argsGeoJSON[i].on = function() {};
			argsGeoJSON[i].options = {};
		}
		L.Control.Layers.prototype.initialize.call(this, {}, argsGeoJSON, options);
	},

	onAdd: function(map) {
		var r = L.Control.Layers.prototype.onAdd.call(this, map), // Creates the dom elements first
			cookChecked =
			this._ac ? this._ac[1].split(',') : // &cookie= argument overwrites the cookie
			this._kl ? this._kl[1].split(',') : // cookie
			[], // Fist time
			cat = null,
			inputs = this._form.getElementsByTagName('input');

		for (var i = 0; i < inputs.length; i++) {
			var e = this._getLayer(inputs[i].layerId);

			// Add separator between categories
			if (cat && cat != e.layer.p)
				inputs[i].parentElement.className = 'overlay-separator';
			cat = e.layer.p;

			inputs[i].checked =
				cookChecked.indexOf(e.name) != -1 ||
				!this._kl; // All checked the fist time
		}
		this._onInputClick(); // Initialise the layers

		return r;
	},

	_onInputClick: function() {
		var check = [], // Names checked for cookie update
			layers = {}, // Names checked for cookie update
			args = {}, // Service args in getParamString format
			inputs = this._form.getElementsByTagName('input');

		for (var i = 0; i < this._layers.length; i++) {
			var e = this._layers[i].layer;
			e.l.options.argsGeoJSON[e.p] = ''; // Erase the argsGeoJSON editable parameters
			layers[e.l._leaflet_id] = e.l; // List the edited layers
		}

		for (var i = 0; i < inputs.length; i++) {
			var e = this._getLayer(inputs[i].layerId),
				a = e.layer.l.options.argsGeoJSON;

			if (inputs[i].checked) {
				a[e.layer.p] += (a[e.layer.p] ? ',' : '') + e.layer.v;
				check.push(e.name);
			}
		}
		document.cookie = 'layerargs=' + check.join(',') + ';path=/'; // Updates the cookie

		// Reload the layers
		for (id in layers)
			layers[id].reload();
	}
});