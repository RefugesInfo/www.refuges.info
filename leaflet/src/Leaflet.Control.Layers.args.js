/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Checkbox control for Ajax layers parameters
 */

L.Control.Layers.args = L.Control.Layers.overflow.extend({
	_kl: document.cookie.match(/layerargs=([^;]+)/), // Mem here before it's corrupted by L.Control.Permalink._update_href
	_ac: window.location.search.match(/cookie=([^&]*)/), // URL argument

	onAdd: function (map) {
		var r = L.Control.Layers.overflow.prototype.onAdd.call(this, map), // Creates the elements first
			inputs = this._form.getElementsByTagName('input'),
			cookChecked =
				this._ac ? this._ac[1].split(',') : // &cookie= argument overwrites the cookie
				this._kl ? this._kl[1].split(',') : // cookie
				[], // Fist time
			cat = null;

		for (var i = 0; i < inputs.length; i++) {
			var input = inputs[i],
				obj = this._layers[input.layerId];

			// Add separator between categories
			if (cat && cat != obj.layer.k)
				input.parentElement.className = 'overlay_separator';
			cat = obj.layer.k; 

			input.checked =
				cookChecked.indexOf(obj.name) != -1
				|| !this._kl; // All checked the fist time
		}
		return r;
	},

	args: function () {
		var check = [], // Names checked for cookie update
			args = {}, // Service args in getParamString format
		    inputs = this._form.getElementsByTagName('input');

		for (var i = 0; i < inputs.length; i++) {
			var input = inputs[i],
				obj = this._layers[input.layerId];

			if (input.checked) {
				check.push (obj.name);
				if (typeof args[obj.layer.k] == 'string')
					args[obj.layer.k] += ','+obj.layer.v;
				else
					args[obj.layer.k] = obj.layer.v;
			}
		}
		document.cookie = 'layerargs=' + check.join(',') + ';path=/'; // Updates the cookie
		return args; // Returns the args list
	},

	_onInputClick: function (e) {
		if (typeof e == 'object') // TODO BUG: Sinon appelle 2 fois dont 1 avec e = indefini
			this._map.fire('clickLayersArgs');
	}
});