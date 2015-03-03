<?php
// Script lié à la page d'acceuil
// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
?>

// Crée la carte dés que la page est chargée
window.addEventListener('load', function() {
	var bboxs = [ <?=$vue->bbox?> ]; // Bbox au format Openlayers
	new L.Map('accueil', {
		zoomControl: false,
		layers: [
			new L.TileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png'),
			new L.GeoJSON.Ajax( // Les massifs WRI
				'<?=$config['sous_dossier_installation']?>api/polygones', {
					argsGeoJSON: {
						type_polygon: 1
					},
					bbox: true, // Optimise la gestion des couleurs
					url: function(feature) {
						return feature.properties.lien;
					},
					style: function(feature) {
						return {
							color: 'black',
							fillColor: feature.properties.couleur,
							weight: 1,
							opacity: 0.5,
							fillOpacity: 0.3
						}
					}
				}
			)
		]
	}).fitBounds([
		[bboxs[3], bboxs[0]], // Bbox au format Leaflet
		[bboxs[1], bboxs[2]]
	]);
});