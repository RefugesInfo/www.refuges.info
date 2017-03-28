var map = new L.Map('map');
map.setView([45.18, 5.7], 12);

// Baselayers
var baselayers = {
	'OSM': new L.TileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>'
	}),
	'OSM-FR': new L.TileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', { // Available on http & https
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>'
	})
}
baselayers.OSM.addTo(map);

var lc = new L.Control.Layers(baselayers).addTo(map);

new L.Control.Permalink.Cookies({ // shramov/leaflet-plugins
	layers: lc
}).addTo(map);