// Init input when the file is not PHP
if ("<?=0?>")
	document.getElementById('edit-json').value =		'{"type":"FeatureCollection","features":[{"type":"Feature","geometry":{"type":"LineString","coordinates":[[2.5,46],[3,45],[4,45],[5,45.8]]}},{"type":"Feature","geometry":{"type":"Point","coordinates":[3.5,45.5]}}]}';

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
