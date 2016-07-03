<?php
// Script lié à la page d'acceuil
// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
?>

// Crée la carte
var bboxs = [<?=$vue->bbox?>]; // Bbox au format Openlayers
new L.Map('carte-accueil', {
	zoomControl: false,
	layers: [
		new L.TileLayer.OSM.MRI(),
		new L.GeoJSON.Ajax( // Les massifs WRI
			'<?=$config['sous_dossier_installation']?>api/polygones',
			{
				argsGeoJSON: {
					type_polygon: 1
				},
				bbox: true, // Optimise la gestion des couleurs
				style: function(feature) {
					var referers = window.location.href.split("/");						
					return {
						popup: feature.properties.nom,
						popupAnchor: [-1, -2],
						//url: feature.properties.lien,
						url: referers[0]+'//'+referers[2]+'/nav/'+feature.properties.id,
						color: 'black',
						weight: 1,
						opacity: 0.7,
						fillColor: feature.properties.couleur,
						fillOpacity: 0.4
					}
				}
			}
		)
	]
}).fitBounds([
	[bboxs[3], bboxs[0]], // Bbox au format Leaflet
	[bboxs[1], bboxs[2]]
]);
