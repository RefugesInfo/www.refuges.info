/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Traduction des textes apparaissant à l'exécution
 */

// Fixe un bug de reconnaissance de path si leaflet.js n'est pas inclus directement
L.Icon.Default.imagePath = L.Icon.Default.imagePath.replace(/(dist\/src|dist|src)/g, 'leafletjs.com');

// Style de base des polylines édités
L.Polyline = L.Polyline.extend({
	options: {
		color: 'red',
		weight: 4,
		opacity: 1,
	}
});

if (navigator.language || navigator.userLanguage == 'fr') {
	if (L.Control.Fullscreen)
		L.Control.Fullscreen = L.Control.Fullscreen.extend({
			options: {
				title: {
					false: 'Plein écran',
					true: 'Sortir du plein écran'
				}
			}
		});

	if (L.Control.Gps)
		L.Control.Gps = L.Control.Gps.extend({
			options: {
				title: 'Afficher votre position GPS'
			}
		});

	if (L.Control.FileLayerLoad)
		L.Control.FileLayerLoad = L.Control.FileLayerLoad.extend({
			statics: {
				TITLE: 'Charger un fichier GPX, KML, GeoJSON'
			}
		});

	if (L.Control.OSMGeocoder)
		L.Control.OSMGeocoder = L.Control.OSMGeocoder.extend({
			options: {
				position: 'topleft',
				text: 'Chercher',
			}
		});

	if (L.Control.PolylineEditor)
		L.Control.PolylineEditor = L.Control.PolylineEditor.extend({
			options: {
				help: [
					'EDITEUR DE LIGNE',
					'Créer une nouvelle ligne: double cliquer sur la carte',
					'Insérer un sommet: cliquer et glisser le carré intermédiaire',
					'Déplacer un sommet: cliquer et glisser le carré',
					'Supprimer un sommet: cliquer sur le carré',
					'NOTE: un effet d\'adhérence prend les coordonnées des points proches',
					'NOTE: l\'éditeur fusionne les lignes de même extrémité',
					'Supprimer un segment: cliquer sur le carré intermédiaire',
					'Allonger une ligne: cliquer sur le carré à l\'extrémité',
					'Supprimer une ligne: cliquer sur la ligne',
					'Enregitrer les modifications: ',
				]
			}
		});
}