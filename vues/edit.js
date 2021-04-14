<?php
// Code Javascript de la page d'édition des contours de massifs

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

$edition = true; // N'affiche pas les couches dont la licence ne permet pas la recopie
include ($config_wri['racine_projet'].'vues/_carte.js');
?>

// Affiche en noir la limite de tous les massifs
const layerMassifs = layerVectorURL({
		baseUrl: '<?=$config_wri["sous_dossier_installation"]?>api/polygones?type_polygon=1',
		receiveProperties: function(properties) {
			properties.type = null; // Avoid label
		},
		styleOptions: function(properties) {
			return {
				fill: new ol.style.Fill({
					color: 'rgba(0,0,0,0)',
				}),
				stroke: new ol.style.Stroke({
					color: 'black',
				})
			};
		},
	}),

	editeur = layerEditGeoJson({
		geoJsonId: 'edit-json',
		snapLayers: [layerMassifs],
		titleModify: 'Modification d‘un polygone:\n' +
			'Activer ce bouton (couleur jaune) puis:\n' +
			'Déplacer un sommet: Cliquer dessus puis le déplacer.\n' +
			'Ajouter un sommet: Cliquer sur un côté puis le déplacer.\n' +
			'Supprimer un sommet: Alt + cliquer dessus.\n' +
			'Scinder un polygone: Joindre 2 sommets du polygone,\n' +
			'Fusionner 2 polygones: Coller un côté identique\n' +
			'(entre 2 sommets consécutifs) de chaque polygone\n' +
			'puis alt+cliquer dessus.\n' +
			'Supprimer un polygone: Ctrl + Alt + cliquer dessus.',
		titlePolygon: 'Création d‘un polygone:\n' +
			'Activer ce bouton (couleur jaune) puis:\n' +
			'Cliquer sur la carte et sur chaque point désiré pour dessiner un polygone,\n' +
			'double cliquer pour terminer.\n' +
			'Un polygone entièrement compris dans un autre crée un "trou".',
		saveFeatures: function(coordinates, format) {
			return format.writeGeometry(
				new ol.geom.MultiPolygon(coordinates.polys),
				{
					featureProjection: 'EPSG:3857',
					decimals: 5,
				});
		},
	}),

	controls = [
		layersSwitcher,
		controlPermalink(), // Permet de garder le même réglage de carte en création
		new ol.control.Attribution(),
		new ol.control.ScaleLine(),
		controlMousePosition(),
		new ol.control.Zoom(),
		controlFullScreen(),
		controlGeocoder(),
		controlLoadGPX(),
		controlDownload({
			savedLayer: editeur,
			title: 'Choisir un format ci-dessous et\n' +
				'cliquer sur la flèche pour obtenir\n' +
				'un fichier contenant\n' +
				'les éléments en édition.',
		}),
	],

	map = new ol.Map({
		target: 'carte-nav',
		controls: controls,
		layers: [
			layerMassifs,
			editeur,
		],
	});