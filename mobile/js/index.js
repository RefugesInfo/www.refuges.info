// Script lié à la page d'acceuil

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $modele contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 14/03/2013 Léo - Création

//****************************************************
// WINDOW ONLOAD - Crée la carte dès que la page est chargée
//****************************************************
window.onload = function () {

	// On créé un calque pour la carte	
	var map = L.map('map');
	L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
	    attribution: '&copy; Contributeurs d\'<a href="http://openstreetmap.org">OpenStreetMap</a>',
	    maxZoom: 18
	}).addTo(map);

	// On créé un calque où se trouve les points des fiches
		// On créé un style que jes points prennent par défaut
	var defaultIcon = L.icon({
		iconUrl: '../images/icones/cabane.png',
		iconSize: [16, 16],
		iconAnchor: [8, 8],
		popupAnchor: [0, -8]
	});

		// Pour chaque point, on le créé avec style et popup
	function onEachFeature(feature, layer) {
		var popupContent = '<a href="' + feature.properties.url + '">' + feature.properties.nom + "</a>";
		layer.bindPopup(popupContent);
		var cabaneIcon = L.icon({
			iconUrl: '../images/icones/' + feature.properties.type + '.png',
			iconSize: [16, 16],
			iconAnchor: [8, 8],
			popupAnchor: [0, -8]
		});
		layer.setIcon(cabaneIcon);
	}

		// Appel des points
	L.geoJson(pointsWRI,{
		onEachFeature: onEachFeature,

		pointToLayer: function (feature, latlng) {
			return L.marker(latlng, {icon: defaultIcon});
		}
	}).addTo(map);

	// Fonctions de Géolocalisation, on affiche la zone où on se trouve.
	function onLocationFound(e) {
	    var radius = e.accuracy / 2;
	    L.marker(e.latlng).addTo(map);
	}
	function onLocationError(e) {
 	   alert(e.message);
	}

	// On modifie les données si :
	map.on('locationerror', onLocationError);
	map.on('locationfound', onLocationFound);
	map.locate({setView: true, maxZoom: 14});
	map.on('moveend', actualiseGeoJSON); // Si l'utilisateur a fini de trifouiller la position de la carte, on actualise les points

	// On actualise les points
	function actualiseGeoJSON () {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', '../exportations/exportations.php?format=geojson&bbox=' + map.getBounds().toBBoxString() + "", true);
		xhr.send();

		// On créé un style que jes points prennent par défaut
		var defaultIcon = L.icon({
			iconUrl: '../images/icones/cabane.png',
			iconSize: [16, 16],
			iconAnchor: [8, 8],
			popupAnchor: [0, -8]
		});

		// Pour chaque point, on le créé avec style et popup
		function onEachFeature(feature, layer) {
			var popupContent = '<a href="' + feature.properties.url + '">' + feature.properties.nom + "</a>";
			layer.bindPopup(popupContent);
			var cabaneIcon = L.icon({
				iconUrl: '../images/icones/' + feature.properties.type + '.png',
				iconSize: [16, 16],
				iconAnchor: [8, 8],
				popupAnchor: [0, -8]
			});
			layer.setIcon(cabaneIcon);
		}

		// Appel des points
		L.geoJson(pointsWRI,{
			onEachFeature: onEachFeature,

			pointToLayer: function (feature, latlng) {
				return L.marker(latlng, {icon: defaultIcon});
			}
		}).addTo(map);
	}
}