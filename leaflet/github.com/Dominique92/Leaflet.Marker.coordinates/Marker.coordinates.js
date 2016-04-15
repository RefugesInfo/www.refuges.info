/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Gestion de l'affichage et de la saisie de la position d'un marqueur sur la carte
 */

L.Marker.include({
	coordinates: function(id) {
		this._elCoordinate = id;
		var el = document.getElementById(id+'-json'),
			cs;
		if (el) {
			try {
				cs = JSON.parse(el.innerHTML || el.value).coordinates;
			} catch (e) {
				// GEO TODO traiter erreur
			}
			if (cs)
				this.setLatLng([cs[1], cs[0]]);
		}
		this._displayCoord(); // On affiche une fois au début
		this.on('move', this._displayCoord, this); // On réaffiche aussi si on déplace le marqueur

		return this; // Able to chain this method
	},

	_displayCoord: function() {
		var marker = this, // Indispensable pour ne pas confondre avec le this dans certaines fonctions incluses
			latlng = marker._latlng,
			typeCoordonnee = 'decimal'; // Valeur par défaut

		if (!latlng)
			return;

		// Réécrit les options du sélecteur de type de projection
		var selectEL = document.getElementById(this._elCoordinate+'-select');
		if (selectEL) {
			if (selectEL.value)
				typeCoordonnee = selectEL.value;

			// On efface tout le contenu
			while (selectEL.hasChildNodes())
				selectEL.removeChild(selectEL.firstChild);

			// On initialise la liste de séléction avec les projections disponibles pour ce point
			for (c in L.CRS)
				if (L.CRS[c] &&
					L.CRS[c].name &&
					typeof L.CRS[c] == 'object' &&
					(!L.CRS[c].bounds || // On affiche les projections qui n'ont pas de limite
						L.CRS[c].bounds.contains([latlng.lng, latlng.lat]) // Ou celles qui sont dans les limite
					)
				) {
					var option = document.createElement('option');
					option.value = c;
					if (c == typeCoordonnee)
						option.selected = 'selected';
					option.appendChild(document.createTextNode(L.CRS[c].name));
					selectEL.appendChild(option);
				}

			// Et si on change la sélection du type de coordonnées, on réaffiche aussi
			selectEL.onchange = function() {
				marker._displayCoord();
			};
		}

		var crs = L.extend({},
			L.CRS, // Add default if not yet done
			L.CRS[typeCoordonnee]
		);

		// Affichages
		var lonlatProj = L.Projection.LonLat.unproject(crs.projection.project(latlng));
		for (l in latlng) {
			// id des champs: id-[select|title|deg|proj|json]-[lon|lng|] 
			var vals = {
				title: crs.title[l],
				deg: latlng[l],
				proj: crs.format(lonlatProj[l]),
				json: JSON.stringify(this.toGeoJSON().geometry)
			};
			for (v in vals) {
				var el = document.getElementById([this._elCoordinate, v, l].join('-'))
					  || document.getElementById([this._elCoordinate, v].join('-'));
				if (el) {
					var eli = typeof el.value != 'undefined' ? 'value' : 'innerHTML';
					el[eli] = vals[v];
					el.onchange = function() { // Le contenu des champs à changé
						var lonlatChanged = {};
						for (l in latlng) {
							var ids = this.id.split('-');
							ids[2] = l;
							var el = document.getElementById(ids.join('-'));
							if (el)
								lonlatChanged[l] = crs.unformat(el[eli]);
						}
						var newLL = crs.projection.unproject(L.Projection.LonLat.project(lonlatChanged));
						marker.setLatLng(newLL);
						marker._map.panTo (newLL);
					};
				}
			}
		}
	}
});