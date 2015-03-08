/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Edition d'un polyline
 *
 * Nécéssite:
 * plugins/draw/dist/leaflet.draw-src.js
 * plugins/GeometryUtil/dist/leaflet.geometryutil.js
 * plugins/Snap/leaflet.snap.js
 *
 * Pour qu'une couche serve de référence de collage, ajouter l'option: <layer>.options.editSnapable = true
 */

L.Control.PolylineEditor = L.Control.extend({
	options: {
		position: 'topleft',
		help: ['Edit command list'], // Documentation de la liste des commandes
		idInput: 'input-editor', // id de l'imput de saisie des coordonnées à remonter
		idChange: null, // id d'un élement auquel appliquer display= le contenu édité change
		submit: '<not implemented>', // Libellé du bouton de soumission du questionnaire
	},
	changed: true,

	onAdd: function(map) {
		map.editor = this;

		// Affichage et édition du contenu de l'input
		this.elInput = document.getElementById(this.options.idInput);
		this.elChange = document.getElementById(this.options.idChange);
		if (this.elInput) {
			var input = [];
			if (this.elInput.value) {
				this.inputValue = this.elInput.value;
				eval('input = ' + this.elInput.value);
			}
			this.type = input.type; // Mémorisation pour pouvoir rendre le même format

			// On converti en *LineString pour pouvoir éditer les segments
			switch (input.type) {
				case 'MultiPolygon'://DCMM TODO: enlever les formats geoJSON
					var c = input.coordinates;
					input.coordinates = [];
					for (i in c)
						input.coordinates.push(c[i][0]);
				case 'Polygon':
					input.type = 'MultiLineString';
				case 'LineString':
				case 'MultiLineString':
					break;
				case undefined: // Format [[[8.857,47.851],[8.854,47.851]],[[8.856,47.852],[8.856,47.852]]]
					input = {
						type: 'MultiLineString',
						coordinates: input
					};
					break;
				default:
					alert('Type de geometrie inconnue de l\'editeur: ' + input.type);
			}
			var el = new L.GeoJSON(
				input,
				L.Polyline.prototype.options
			);
			el.addTo(map);
			this.addEdit(el);
		}

		// Début céation du nouveau poly
		map.doubleClickZoom.disable();
		map.on('dblclick', function(e) {
			var draw = new L.Draw.Polyline(map, {
				shapeOptions: L.Polyline.prototype.options
			});
			draw.addHooks();
			draw.enable();
			draw._currentLatLng = L.latLng([e.latlng.lat, e.latlng.lng]);
			if (e.last)
				draw.addVertex(e.last._latlng);
			draw.addVertex(draw._currentLatLng);
		});

		// Fin création du nouveau poly
		map.on('draw:created', function(e) {
			e.layer.options.editSnapable = true;
			map.addLayer(e.layer); // On l'ajoute à la carte
			this.addEdit(e.layer); // On le rend éditable
		}, this);

		// Cleaning des segments
		map.on('mouseup', function() {
			this.changed = true;
		}, this);
		map.on('mousemove', function() {
			if (this.changed) {
				this.changed = false;

				// Fusionne les segments ayant mêmes extrémités
				for (il1 in map._layers) // Pour toutes les couches
					for (il2 in map._layers) {
						var le1 = map._layers[il1].editing,
							le2 = map._layers[il2].editing;
						if (le1 && le1._enabled && // Éditables
							le2 && le2._enabled &&
							le1._leaflet_id < le2._leaflet_id) { // 1 seule fois chaque couple
							var ll1 = le1._poly._latlngs,
								ll2 = le2._poly._latlngs,
								lladd = null; // Les points à ajouter
							if (ll1[0].equals(ll2[0])) {
								ll1.reverse();
								lladd = ll2;
							} else if (ll1[0].equals(ll2[ll2.length - 1])) {
								ll1.reverse();
								lladd = ll2.reverse();
							} else if (ll1[ll1.length - 1].equals(ll2[0])) {
								lladd = ll2;
							} else if (ll1[ll1.length - 1].equals(ll2[ll2.length - 1])) {
								lladd = ll2.reverse();
							}
							if (lladd) { // Points à fusionner
								le1._poly._latlngs.pop(); // On enlève le dernier point pour qu'il ne soit pas en double
								le1._poly._latlngs = ll1.concat(lladd);
								le1._poly.redraw(); // On redessine le trait
								le1.updateMarkers(); // On redessine les marqueurs
								map.removeLayer(le2._poly); // On efface l'autre polyline
							}
						}
					}
				// Réinitialise snap toutes les couches "options.editSnapable" = true
				for (il1 in map._layers) {
					var le1 = map._layers[il1].editing;
					if (le1 && le1._enabled && le1._snapper) {
						le1._snapper._guides = []; // Raz
						for (il2 in map._layers) {
							var l2 = map._layers[il2];
							if (il1 != il2 && // On ne snappe pas soi même
								l2.options && l2.options.editSnapable)
								le1._snapper.addGuideLayer(l2);
						}
					}
				}
				// Remontée des coordonnées des couches éditables dans l'input initial
				var mp = [],
					ml = [];
				for (il1 in map._layers) { // Pour toutes les couches
					var le1 = map._layers[il1].editing;
					if (le1 && le1._enabled) { // Éditables
						var g = map._layers[il1].toGeoJSON().geometry;
						switch (g.type) {
							case 'Polygon':
								ml = ml.concat(g.coordinates);
								mp.push(g.coordinates);
								break;
							case 'LineString':
								mp.push([g.coordinates]);
								ml.push(g.coordinates);
								break;
							default:
								alert('Type de geometrie inconnue dans l\'editeur: ' + g.type);
						}
					}
				}
				switch (this.type) {
					case 'Polygon':
					case 'MultiPolygon':
						ml = {
							type: 'MultiPolygon',
							coordinates: mp
						};
						break
					case 'LineString':
					case 'MultiLineString':
						ml = {
							type: 'MultiLineString',
							coordinates: ml
						};
				}
				if (this.elInput)
					this.elInput.value =
					this.elInput.innerHTML =
					JSON.stringify(ml);
				if (this.elChange &&
					(this.inputValue||'[]').trim() != this.elInput.value)
					this.elChange.style.display = '';
			}
		}, this);

		// Icône du contrôle & help
		var container = L.DomUtil.create('div', 'leaflet-control-edit-help leaflet-bar');
		this.link = L.DomUtil.create('a', 'leaflet-control-edit-help-button', container);
		this.link.title = this.options.help.join('.\n') + this.options.submit+'.';
        L.DomEvent.on(this.link, 'click', function(){
			alert(this.options.help.join('.\n') + this.options.submit+'.');
		}, this);
		return container;
	},

	addEdit: function(layer) {
		// On ajoute des appels à _createMarker pour ces couches
		if (layer.editing) {
			layer.options.editing = {}; //DCMM TODO voir pourquoi (nouvelle version de draw)
			layer.editing._snapper = new L.Handler.MarkerSnap(this._map);
			layer.editing.enable();
			layer.options.editSnapable = true;
		}
		// On rend éditables toutes les couches déjà déclarées dans le contrôle
		for (l in layer._layers)
			this.addEdit(layer._layers[l]);
	}
});

L.Edit.Poly.addInitHook(function() {
	// Destruction de ligne
	this._poly.on('click', function(e) {
		var map = this._poly._map;
		if (e.target.editing._enabled) {
			e.target.options.weight = 20;
			e.target._updateStyle();
			if (confirm('Supprimer cette ligne ?')) {
				map.removeLayer(this._poly);
				map.editor.changed = true; // On peut être en dehors de la carte
				map.fire('mousemove');
			} else {
				e.target.options.weight = 5;
				e.target._updateStyle();
			}
		}
	}, this);
});

L.Edit.Poly.include({
	_createMarkerOrigin: L.Edit.Poly.prototype._createMarker, // Mémorise la fonction d'origine
	_createMarker: function(latlng, index) {
		var map = this._poly._map,
			marker = this._createMarkerOrigin(latlng, index); // On commence par l'initialisation d'origine

		// Treat middle markers differently
		if (index === undefined) {
			// Snap middle markers, only once they were touched
			marker.on('dragstart', function() {
				this._snapper.watchMarker(marker);
			}, this);

			// Découpe d'une ligne
			if (!this._poly._holePoints) // Sauf pour les polygones
				marker.on('click', this._onClickMiddleMarker, this);
		} else {
			this._snapper.watchMarker(marker);

			// Continuation de l'extrémité d'une ligne
			marker.on('click', function(e) {
				if (!e.remove && (!marker._prev || !marker._next))
					map.fire('dblclick', {
						latlng: marker._latlng,
						last: marker._prev // Une extrémité ou l'autre
							? (marker._prev._prev ? marker._prev : null) // Si au moins 2 segments, reprend à partir du sommet précédent (sinon, pb)
							: (marker._next._next ? marker._next : null)
					});
			});
		}
		return marker;
	},

	/* TODO: évite le patch dans draw/leaflet.draw-src.js
	mais ne fonctionne curieusement pas :( 
		_createMiddleMarker: function(marker1, marker2) {
			var marker = this._createMarker(this._getMiddleLatLng(marker1, marker2));
			marker.setOpacity(0.6);
			marker1._middleRight = marker2._middleLeft = marker;
			this._markerGroup.addLayer(marker);
		},
	*/

	_onClickMiddleMarker: function(e) {
		// Découpe d'une ligne
		var marker1, marker2, map = this._poly._map;
		for (m in this._markers)
			if (this._markers[m]._middleRight && this._markers[m]._middleRight._leaflet_id == e.target._leaflet_id)
				marker1 = this._markers[m];
			else if (this._markers[m]._middleLeft && this._markers[m]._middleLeft._leaflet_id == e.target._leaflet_id)
				marker2 = this._markers[m];

		if (marker1 && marker2) { // Pour les ex-milieux transformés en sommet par drag. TODO: enlever le on quand le marqueur n'est plus un middle
			if (!marker1._prev && !marker2._next) // Il n'y a qu'un seul segment
				map.removeLayer(this._poly); // Le détruit

			if (!marker1._prev) // C'est le premier
				this._onMarkerClick({
					target: marker1,
					remove: true // On l'enlève et c'est tout
				});
			else if (!marker2._next) // C'est le dernier
				this._onMarkerClick({
					target: marker2,
					remove: true // On l'enlève et c'est tout
				});
			else {
				var ll = [];
				for (var m = marker2; m; m = m._next) { // Pour tous les points aprés
					ll.push([m._latlng.lat, m._latlng.lng]); // On liste
					this._onMarkerClick({
						target: m,
						remove: true // On enlève de ce point
					});
				}
				// Et on cree un nouveau segment éditable
				var p = new L.Polyline(ll, this._poly.options).addTo(map);
				map.editor.addEdit(p);
			}
		}
	}
});