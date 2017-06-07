var map = new L.Map('map', {
	center: new L.LatLng(47, 2), // Centre France
	zoom: 6,
	layers: [L.TileLayer.collection('OSM-FR')]
});

new L.Control.Layers(L.TileLayer.collection()).addTo(map);
