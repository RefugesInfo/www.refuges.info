/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Traduction des textes en français
 */

L.myLeafletVersion = '1.0.0';

L.Control.Scale.prototype.options.imperial = false;

if (navigator.language || navigator.userLanguage == 'fr') {

	// Textes des contrôles
	if (L.Control.Zoom)
		L.Control.Zoom = L.Control.Zoom.extend({
			options: {
				zoomInTitle: 'Rapprocher',
				zoomOutTitle: 'Eloigner'
			}
		});

	if (L.Control.Fullscreen)
		L.Control.Fullscreen = L.Control.Fullscreen.extend({
			options: {
				title: {
					'false': 'Plein écran',
					'true': 'Sortir du plein écran'
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
				TITLE: 'Importer un fichier GPX, KML, GeoJSON',
				LABEL: '&#8657;'
			}
		});

	if (L.Control.OSMGeocoder)
		L.Control.OSMGeocoder = L.Control.OSMGeocoder.extend({
			options: {
				text: 'Chercher'
			}
		});

	// Textes de l'éditeur
	L.drawLocal = {
		draw: {
			toolbar: {
				actions: {
					title: 'Annuler le dessin',
					text: 'Annuler'
				},
				finish: {
					title: 'Finir le dessin',
					text: 'Finir'
				},
				undo: {
					title: 'Supprimer le dernier point',
					text: 'Supprimer le dernier point'
				},
				buttons: {
					polyline: 'Tracer une ligne',
					polygon: 'Tracer un polygone',
					rectangle: 'Tracer un rectangle',
					circle: 'Tracer un cercle',
					marker: 'Placer un marqueur'
				}
			},
			handlers: {
				circle: {
					tooltip: {
						start: 'Cliquer et glisser pour tracer un cercle'
					},
					radius: 'Rayon'
				},
				marker: {
					tooltip: {
						start: 'Cliquer sur la carte pour placer un marqueur'
					}
				},
				polygon: {
					tooltip: {
						start: 'Cliquer pour commencer le dessin d\'un polygone',
						cont: 'Cliquer pour continuer le dessin d\'un polygone',
						end: 'Cliquer sur le premier point clôt le polygone'
					}
				},
				polyline: {
					error: '<strong>Erreur:</strong> Les contours de la forme ne peuvent pas se croiser !',
					tooltip: {
						start: 'Cliquer pour commencer une ligne',
						cont: 'Cliquer pour continuer le dessin de la ligne',
						end: 'Cliquer sur le dernier point pour finir la ligne'
					}
				},
				rectangle: {
					tooltip: {
						start: 'Cliquer et glisser pour tracer un rectangle'
					}
				},
				simpleshape: {
					tooltip: {
						end: 'Relacher la souris pour finir le dessin'
					}
				}
			}
		},
		edit: {
			toolbar: {
				actions: {
					save: {
						title: 'Finir les changements',
						text: 'Finir'
					},
					cancel: {
						title: 'Annuler les changements',
						text: 'Annuler'
					}
				},
				buttons: {
					edit: 'Editer les éléments',
					editDisabled: 'Pas d\'élément',
					remove: 'Supprimer un élément',
					removeDisabled: 'Pas d\'élément'
				}
			},
			handlers: {
				edit: {
					tooltip: {
						text: 'Cliquer et glisser pour editer',
						subtext: 'Cliquer annuler pour annuler les changements'
					}
				},
				remove: {
					tooltip: {
						text: 'Cliquer sur un élément pour le supprimer'
					}
				}
			}
		}
	};
}