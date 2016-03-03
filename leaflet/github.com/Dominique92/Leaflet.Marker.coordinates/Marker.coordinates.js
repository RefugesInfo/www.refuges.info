/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Gestion de l'affichage et de la saisie de la position d'un marqueur sur la carte
 */

// Quelques formats d'affichage de la projection de base EPSG4326

L.extend(L.CRS, {
	// Valeurs par défaut
	title: {
		lng: 'Longitude',
		lat: 'Latitude'
	},
	format: function(v) { // Prend la partie entière et insére un blanc avant les milliers
		if (v < 1000)
			return Math.round(v);
		var mm = Math.floor(v / 1000000);
		var m = Math.floor((v - mm * 1000000) / 1000);
		var u = Math.round(v - mm * 1000000 - m * 1000);
		if (u >= 1000) {
			m++;
			u -= 1000;
		}
		if (m >= 1000) {
			mm++;
			m -= 1000;
		}
		return (mm === 0 ? '' : mm + ' ') + (mm + m === 0 ? '' : (m < 100 ? '0' : '') + (m < 10 ? '0' : '') + m + ' ') + (u < 100 ? '0' : '') + (u < 10 ? '0' : '') + u;
	},
	unformat: function(v) {
		if (!v)
			return 0; // Cas du champ vide
		else
			return v
				.replace(/\s/g, '') // Juste enlever les séparateurs de miliers
				.replace(/,/g, '.'); // Au cas où il y aurait une , à la place du .
	}
});

L.CRS.decimal = L.extend({}, L.CRS.EPSG4326, {
	name: 'Degrés décimaux',
	format: function(v) {
		return Math.round(v * 100000) / 100000;
	}
});

L.CRS.degminsec = L.extend({}, L.CRS.decimal, {
	name: 'Deg Min Sec',
	format: function(v) {
		var d = Math.floor(Math.abs(v));
		var mf = (Math.abs(v) - d) * 60;
		var m = Math.floor(mf);
		var s = Math.round((mf - m) * 600) / 10;
		if (s >= 60) {
			m++;
			s -= 60;
		}
		if (m >= 60) {
			d++;
			m -= 60;
		}
		return (v < 0 ? '-' : '') + d + '°' + (m < 10 ? '0' : '') + m + "'" + (s < 10 ? '0' : '') + s + '"';
	},
	unformat: function(v) {
		va = '0' + v
			.replace(/\s/g, '') // On purge les blancs
			.replace(/,/g, '.') // Au cas où il y aurait une , à la place du .
			.replace(/-/g, '') + '°0°';
		vs = va.replace(/'|"/g, '°').split('°');
		return (v[0] == '-' ? -1 : 1) * (parseFloat(vs[0]) + parseFloat(0 + vs[1]) / 60 + parseFloat(0 + vs[2]) / 3600);
	}
});

L.CRS.degmin = L.extend({}, L.CRS.degminsec, {
	name: 'Deg Min',
	format: function(v) {
		var d = Math.floor(Math.abs(v));
		var m = Math.round((Math.abs(v) - d) * 60 * 1000) / 1000;
		if (m >= 60) {
			d++;
			m -= 60;
		}
		return (v < 0 ? '-' : '') + d + '°' + (m < 10 ? '0' : '') + m + "'";
	}
});

// Les projections UTM
for (var u = 28; u <= 35; u++)
	L.CRS['EPSG326' + u] = L.extend(
		new L.Proj.CRS(
			'EPSG:326' + u,
			'+proj=utm +zone=' + u + ' +ellps=WGS84 +datum=WGS84 +units=m +no_defs'
		), {
			bounds: L.bounds([6 * u - 186, 0], [6 * u - 180, 84]),
			name: 'UTM ' + u + 'N'
		}
	);
L.CRS.EPSG32630.name += ' (France ouest)';
L.CRS.EPSG32631.name += ' (France centre)';
L.CRS.EPSG32632.name += ' (France est)';
L.CRS.EPSG32633.name += ' (Autriche)';

// Les projections Lambert
L.CRS.EPSG27571 = L.extend(
	new L.Proj.CRS(
		'EPSG:27571',
		'+title=Lambert zone 1 , LCC +proj=lcc +lat_1=49.5 +lat_0=49.5 +lon_0=0 +k_0=0.999877341 +x_0=600000 +y_0=1200000 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'
	), {
		bounds: L.bounds([-5.2, 48.15], [8.23, 51.1]),
		name: 'Lambert I (Nord)'
	}
);

L.CRS.EPSG27572 = L.extend({},
	L.CRS.EPSG27571,
	new L.Proj.CRS(
		'EPSG:27572',
		'+title=Lambert 2 étendue, LCC +proj=lcc +lat_1=46.8 +lat_0=46.8 +lon_0=0 +k_0=0.99987742 +x_0=600000 +y_0=2200000 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'
	), {
		bounds: L.bounds([-5.2, 42.25], [8.23, 51.1]),
		name: 'Lambert II (Centre)'
	}
);

L.CRS.EPSG27573 = L.extend({},
	L.CRS.EPSG27571,
	new L.Proj.CRS(
		'EPSG:27573',
		'+title=Lambert zone 3, LCC +proj=lcc +lat_1=44.1 +lat_0=44.1 +lon_0=0 +k_0=0.999877499 +x_0=600000 +y_0=3200000 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'
	), {
		bounds: L.bounds([-1.76, 42.33], [7.77, 45.45]),
		name: 'Lambert III (Sud)'
	}
);

L.CRS.EPSG27574 = L.extend({},
	L.CRS.EPSG27571,
	new L.Proj.CRS(
		'EPSG:27574',
		'+title=Lambert zone 4, +proj=lcc +lat_1=42.165 +lat_0=42.165 +lon_0=0 +k_0=0.99994471 +x_0=234.358 +y_0=4185861.369 +a=6378249.2 +b=6356515 +towgs84=-168,-60,320,0,0,0,0 +pm=paris +units=m +no_defs'
	), {
		bounds: L.bounds([8.5, 41.33], [9.6, 43.05]),
		name: 'Lambert IV (Corse)'
	}
);

// Le contrôle
L.Marker.include({
	coordinates: function(id) {
		var el = document.getElementById(id+'-json');
		if (el) {
			var cs = JSON.parse(el.innerHTML || el.value).coordinates;
			if (cs)
				this.setLatLng([cs[1], cs[0]]);
		}
		this._displayCoord(id);

		return this; // Able to chain this method
	},

	_displayCoord: function(id) {
		var marker = this, // Indispensable pour ne pas confondres avec le this dans certains on()
			latlng = marker._latlng,
			typeCoordonnee = 'decimal'; // Valeur par défaut

		// Réécrit les options du sélecteur de type de projection
		var selectEL = document.getElementById(id+'-select');
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
				marker._displayCoord(id);
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
				json: JSON.stringify(marker.toGeoJSON().geometry)
			};
			for (v in vals) {
				var el = document.getElementById([id, v, l].join('-'))
					  || document.getElementById([id, v].join('-'));
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
						marker.fire('edit'); // On redessine le marqueur et on raffraichit les champs de l'éditeur
						marker._map.panTo (newLL);
					};
				}
			}
		}

		// On réaffiche aussi si on déplace le marqueur
		marker.on('move', function() {
			marker.off('move'); // On désactive le temps de traiter l'affichage
			marker._displayCoord(id); // On raffraichit l'affichage
			marker.fire('edit'); // On raffraichit le marqueur et les champs de l'éditeur
		});
	}
});