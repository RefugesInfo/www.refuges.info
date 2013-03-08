// Script lié à la page d'acceuil

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $modele contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 17/10/11 Dominique : Création
// 23/10/11 Dominique : Retour ici du code spécifique à la page qui avait été mis dans la bibliothèque
// 15/04/11 Dominique : Passage en OL2.11
// 08/05/12 Dominique : Retour en templates simples
// 12/07/12 Dominique : Enrichissement avec les news
// 15/02/13 jmb : gestion des zones


// Crée la carte dés que la page est chargée
window.onload = function () {
	var map = L.map('map');

	L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
	    attribution: '&copy; Contributeurs d\'<a href="http://openstreetmap.org">OpenStreetMap</a>',
	    maxZoom: 18
	}).addTo(map);

	function onLocationFound(e) {
    var radius = e.accuracy / 2;

    L.marker(e.latlng).addTo(map);
	}

	map.on('locationfound', onLocationFound);

	map.locate({setView: true, maxZoom: 14});

}
