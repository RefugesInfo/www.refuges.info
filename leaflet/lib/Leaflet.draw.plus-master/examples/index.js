var map = L.map('map').setView([45, 5], 7);

L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>; contributors'
}).addTo(map);

var editor = new L.Control.Draw.Plus({
	draw: {
		marker: true,
		polyline: true,
		polygon: true
	},
	edit: {
		remove: true
	},
	entry: 'edit-json'
}).addTo(map);

// File loader
var fl = new L.Control.FileLayerLoad().addTo(map);
fl.loader.on('data:loaded', function(e) {
	e.layer.addTo(editor);
}, fl);
