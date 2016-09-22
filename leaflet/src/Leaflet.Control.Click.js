L.Control.Click = L.Control.extend({
	options: {
		position: 'topleft',
		title: 'Click to launch action',
		label: 'X'
	},

	initialize: function(url, options) {
		this._url = url;
		L.Util.setOptions(this, options);
	},

	onAdd: function(map) {
		// Create a button
		var container = L.DomUtil.create('div', 'leaflet-control-zoom leaflet-bar');
		var link = L.DomUtil.create('a', 'leaflet-control-zoom-in leaflet-bar-part', container);
		link.innerHTML = this.options.label;
		link.title = this.options.title;
		link.style.cursor = 'pointer';

		L.DomEvent.on(link, 'click', function() {
			// The parameter <url> can be a function returning the url
			var url = typeof this._url == 'function' ?
				this._url() :
				this._url;
			// If the result is null, don't call the url.
			if (url)
				link.href = url;
		}, this);

		return container;
	}
});