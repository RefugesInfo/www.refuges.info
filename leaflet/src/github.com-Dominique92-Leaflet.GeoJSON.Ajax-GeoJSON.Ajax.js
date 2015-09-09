/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Display remote layers with geoJSON format
 *
 * geoJSON Spécifications: http://geojson.org/geojson-spec.html
 * With the great help of https://github.com/LeOSW42
 */

L.GeoJSON.Ajax = L.GeoJSON.extend({
	ajaxRequest: null,

	initialize: function(urlGeoJSON, options) {
		if (urlGeoJSON)
			options.urlGeoJSON = urlGeoJSON;

		// On initialise L.GeoJSON mais sans contenu puisqu'on ne l'obtiendra que plus tard par AJAX
		L.GeoJSON.prototype.initialize.call(this, null, options);
	},

	onAdd: function(map) {
		L.GeoJSON.prototype.onAdd.call(this, map);

		// Quand on bouge une carte avec bbox, il faut recharger le geoJSON à chaque fois
		if (this.options.bbox)
			map.on('moveend', this.reload, this);

		// De toute façon, il faut charger au début
		this.reload();
	},

	reload: function(argsGeoJSON) {
		L.Util.extend(this.options.argsGeoJSON, argsGeoJSON); // On change éventuellement quelque chose

		// On prépare l'adresse à télécharger, avec la bbox.
		if (this.options.bbox && this._map) { // Les quatres angles de la vue courante (bbox à télécharger)
			var bounds = this._map.getBounds();
			if (bounds) {
				var minll = bounds.getSouthWest();
				var maxll = bounds.getNorthEast();
				this.options.argsGeoJSON['bbox'] = minll.lng + ',' + minll.lat + ',' + maxll.lng + ',' + maxll.lat;
			}
		}
		this.args = '';
		if (this.options.argsGeoJSON)
			for (a in this.options.argsGeoJSON)
				if (this.options.argsGeoJSON[a])
					this.args += (this.args ? '&' : '?') + a + '=' + this.options.argsGeoJSON[a];

		// On prépare (une fois) l'objet request
		if (!this.ajaxRequest) {
			if (window.XMLHttpRequest)
				this.ajaxRequest = new XMLHttpRequest();
			else if (window.ActiveXObject)
				this.ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
			else {
				alert('Ce navigateur ne supporte pas les requettes AJAX.');
				exit;
			}
			this.ajaxRequest.context = this; // On mémorise le contexte
		}

		// On envoie la requete AJAX
		this.url = this.options.proxy + this.options.urlGeoJSON + this.args;
		if (this.url == this.actual) // TODO: Voir pourquoi le cache de l'explo n'a pas l'air de fonctionner: On refait le cache dans cette classe !
			this.redraw(this.responseText);
		else {
			this.ajaxRequest.onreadystatechange = function(e) {
				if (e.target.readyState == 4 && // Si AJAX à bien retourné ce que l'on attendait
					e.target.status == 200) {
					e.target.context.redraw(e.target.responseText);
					e.target.context.actual = e.target.context.url; // On mémorise le flux demandé pour éviter de le demander plusiers fois.
					}
			}
			this.ajaxRequest.open('GET', this.url, true);
			this.ajaxRequest.send(null);
		}
	},

	redraw: function(geojson) {
		// On vide la couche
		for (l in this._layers)
			if (this._map)
				this._map.removeLayer(this._layers[l]);

		// On recharge les nouveaux features
		try {
			eval('this.addData([' + geojson + '])');
		} catch (e) {
			if (e instanceof SyntaxError)
				alert('Json syntax error on ' + this.options.urlGeoJSON + this.args + ' :\n' + geojson);
		}

		// Référence le layer geojson et la position initiale de chacun de ses sous layers
		for (i in this._layers)
			L.extend(this._layers[i], {
				_geojson: this,
				_ll_init: this._layers[i]._latlng
			});
	},

	options: {
		proxy: '', // Eventuel proxy du lien du flux GeoJSON
		urlGeoJSON: null, // Lien du flux GeoJSON
		argsGeoJSON: {}, // Eventuels arguments du lien du flux GeoJSON

		// On initialise quelques comportements suivant les propriétés
		onEachFeature: function(feature, layer) {

			// Icône de marqueur
			if (this.icon) {
				var icon = this.icon;
				if (typeof icon === 'function')
					icon = icon(feature);

				layer.setIcon(L.icon({
					iconUrl: icon.url,
					iconSize: [icon.size, icon.size],
					iconAnchor: [icon.size / 2, icon.size / 2],
					popupAnchor: [icon.size / 2, 0]
				}));
			}

			layer.on('mouseover mousemove', function(e) {
				// Dégroupage des marqueurs trop prés au survol
				if (this._geojson &&
					this._geojson.options.degroup && // Pour les couches dont options.degroup = distance en nb de pixels
					this._latlng.equals(this._ll_init) // On ne touche pas si déjà shifté
				) {
					var xysi = this._map.latLngToLayerPoint(this._ll_init), // XY point survolé
						dm = this._geojson.options.degroup;
					for (p in this._geojson._layers) {
						var point = this._geojson._layers[p]; // Les autres points
						if (point._leaflet_id != this._leaflet_id) {
							var xypi = this._map.latLngToLayerPoint(point._ll_init), // XY autre point
								dp = xypi.distanceTo(xysi); // Distance du point p au point survolé
							if (!dp) { // S'il est confondu, on ajoute simplement l'écart voulu vers la droite // TODO: si 3 points sont confondus !
								xypi.x += dm;
								point.setLatLng(this._map.layerPointToLatLng(xypi));
							} else
								point.setLatLng(
									dp > dm ? point._ll_init // Si loin, on le remet à sa position initiale
									: [ // Sinon, on ajoute au décalage
										this._ll_init.lat + (point._ll_init.lat - this._ll_init.lat) * dm / dp,
										this._ll_init.lng + (point._ll_init.lng - this._ll_init.lng) * dm / dp
									]
								);
						}
					}
				}

				// Etiquette au survol
				var hover_bubble = new L.Rrose({
						offset: new L.Point(-1, -3), // Evite que le curseur se retrouve sur le popup
						closeButton: false,
						autoPan: false
					})
					.setContent(feature.properties.nom) // TODO: ce serait préférable de mettre nom mais ruprure d'interface WRI
					.setLatLng(e.latlng)
					.openOn(this._map);
			});

			if (typeof this.hover == 'function')//TODO voir pourquoi pas if (typeof e.target._options == 'object'
				// Action au survol
				layer.on('mouseover', function(e) {
					e.target._options.hover(e.target, 'in');
			});

			layer.on('mouseout', function(e) {
				// On retire l'étiquette à la fin du survol
				if (this._map)
					this._map.closePopup();

				// Action à la fin du survol
				if (typeof e.target._options == 'object' &&
					typeof e.target._options.hover == 'function')
					e.target._options.hover(e.target, 'out');
			});

			// Si le feature retourné par la requette ajax a une propriété url:
			if (typeof this.url == 'function') {
				var url = this.url(layer);
				if (url)
					layer.on('click', function(e) { // Va sur la page quand on clique sur le marqueur
						if (e.originalEvent.shiftKey || e.originalEvent.ctrlKey) // Shift + Click lance le lien dans une nouvelle fenêtre
							window.open(url);
						else
							document.location.href = url;
					});
			}
		}
	}
});
