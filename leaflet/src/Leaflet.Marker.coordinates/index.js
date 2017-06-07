map = L.map('map');

new L.TileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', { // Available on http & https
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Frame fixe marquant une position. La carte est centrée autour
var frame = new L.Marker([46.5, 6.5], { // Position par défaut
		icon: L.icon({
			iconUrl: 'images/frame.png',
			className: 'leaflet-grab', // Même curseur que le reste de la carte
			iconAnchor: [15, 21]
		})
	})
	.coordinates('position') // Affiche les coordonnées
	.addTo(map);

// Recentre la carte sur ce frame
map.setView(frame._latlng, 6, {
	reset: true
});

// viewfinder déplaçable affichant sa position éditable.
viewfinder = new L.Marker([], { // Prendra la valeur du champ "x-json"
		draggable: true,
		icon: L.icon({
			iconUrl: 'images/viewfinder.png',
			className: 'leaflet-move',
			iconAnchor: [15, 15]
		})
	})
	.coordinates('viewfinder') // Affiche / saisi les coordonnées
	.addTo(map);
