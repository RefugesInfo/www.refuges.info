/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Traduction des textes apparaissant à l'exécution
 */

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

	if (L.Control.PolylineEditor)
		L.Control.PolylineEditor = L.Control.PolylineEditor.extend({
			options: {
				help: [
					'Déplacer un sommet: cliquer et glisser le carré',
					'NOTE: un effet d\'adhérence prend les coordonnées des points proches',
					'NOTE: l\'éditeur fusionne les lignes de même extrémité',
					'Insérer un sommet: cliquer et glisser le carré intermédiaire',
					'Allonger une ligne: cliquer sur le carré à l\'extrémité',
					'Créer une nouvelle ligne: double cliquer sur la carte',
					'Supprimer un sommet: cliquer sur le carré',
					'Supprimer un segment: cliquer sur le carré intermédiaire',
					'Supprimer une ligne: cliquer sur la ligne',
					'Enregitrer les modifications: ',
				]
			}
		});
}