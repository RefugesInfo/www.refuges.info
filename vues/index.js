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
			new L.GeoJSON.ajax( // Les massifs WRI
				'<?=$config['sous_dossier_installation']?>api/polygones', {
					argsGeoJson: {
						type_polygon: 1
					},
					url: function(feature) {
						return feature.properties.lien;
					},
					style: function(feature) {
						return {
							color: feature.properties.couleur,
							weight: 2,
							opacity: 0.5
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