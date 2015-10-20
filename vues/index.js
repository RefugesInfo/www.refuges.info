<?php
// Script lié à la page d'acceuil
// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
?>

// Crée la carte dés que la page est chargée
window.addEventListener('load', function() {
  var baseLayers = {
    'maps.refuges.info': L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
    }),
    'OpenStreetMap': L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a>'
    }),
    'Outdoors': L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://www.thunderforest.com">Thunderforest</a>'
    })
  };
	var bboxs = [ <?=$vue->bbox?> ]; // Bbox au format Openlayers
	new L.Map('accueil', {
		zoomControl: false,
		layers: [
      baseLayers['<?=$vue->fond_carte_par_defaut?>'],
			new L.GeoJSON.Ajax( // Les massifs WRI
				'<?=$config['sous_dossier_installation']?>api/polygones', {
					argsGeoJSON: {
						type_polygon: 1
					},
					bbox: true, // Optimise la gestion des couleurs
					url: function(target) {
						return target.feature.properties.lien;
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