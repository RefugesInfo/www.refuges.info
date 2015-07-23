/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Gestion d'un marqueur sur la carte, de l'affichage et de la saisie de sa position
 */

/*
L.CRS.* = {
	// leafler-src.js / L.CRS
	latLngToPoint: function
	pointToLatLng: function 
	project: function (latlng)
	scale: function (zoom)

	// leafler-src.js / L.CRS.*
	code: 'EPSG:3857'
	projection: L.Projection.SphericalMercator,
	transformation: new L.Transformation(...

	// MarkerPosition.js
	name: 'Deg Min Sec',
	title (titre devant l'affichage d'une coordonnée)
	bounds (de validité de la projection)
	format (decimal -> chaine spécifique à un format)
	unformat (chaine spécifique à un format -> decimal)
}
 */

// Quelques formats d'affichage de la projection de base EPSG4326
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

// Et maintenant, le contrôle lui même
L.Marker.Position = L.Marker.extend({
	options: {
		projectionType: 'degminsec',

		// Définition des id (= "prefixe+prefixeId+idll") des champs d'affichage et saisie
		prefixe: '', // Permet de gérer plusieurs curseurs
		prefixeId: {
			title: 'titre-',
			decimal: '',
			projette: 'proj-',
			affiche: 'aff-',
			select: 'select-'
		},
		idll: {
			lat: 'lat',
			lng: 'lng',
			prj: 'projection'
		}
	},

	onAdd: function(map) {
		L.Marker.prototype.onAdd.call(this, map);

		// Recherche des éléments DOM du formulaire
		for (var id in this.options.prefixeId)
			for (var l in this.options.idll) {
				this[id + l] = document.getElementById(this.options.prefixe + this.options.prefixeId[id] + this.options.idll[l]);
				if (this[id + l])
					this[id + l].el = this; // Pour retrouver le contexte lors du callback
			}

		// On positionne les écouteurs
		if (this.projettelat)
			this.projettelat.onchange = function(e) {
				this.el.affiche('lat', this.value);
			}
		if (this.projettelng)
			this.projettelng.onchange = function(e) {
				this.el.affiche('lng', this.value);
			}
		if (this.selectprj)
			this.selectprj.onchange = function(e) {
				this.el.options.projectionType = this.value;
				this.el.affiche();
			}
		this.on('drag', function(e) {
			this._latlng = e.target.getLatLng();
			this.affiche();
		});
		this.on('move', function() {
			this.affiche();
		});
		this.affiche();
	},

	// Affiche la position du curseur dans les éléments DOM
	affiche: function(coord, val) {
		var proj = L.extend(
			{ // Valeurs par défaut
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
					return (mm == 0 ? '' : mm + ' ') + (mm + m == 0 ? '' : (m < 100 ? '0' : '') + (m < 10 ? '0' : '') + m + ' ') + (u < 100 ? '0' : '') + (u < 10 ? '0' : '') + u;
				},
				unformat: function(v) {
					if (!v)
						return 0; // Cas du champ vide
					else
						return v
							.replace(/\s/g, '') // Juste enlever les séparateurs de miliers
							.replace(/,/g, '.'); // Au cas où il y aurait une , à la place du .
				}
			},
			L.CRS[this.options.projectionType]
		);

		var pp = proj.projection.project(this._latlng);
		var ll = {
			lng: pp.x,
			lat: pp.y
		};

		// Si changement de position: coord = lat | lng / val = valeur à assigner
		if (coord) {
			ll[coord] = proj.unformat(val);
			this._latlng = proj.projection.unproject(new L.Point(ll.lng, ll.lat));
			this.setLatLng(this._latlng);
		}
		for (var l in this.options.idll) {
			if (this['decimal' + l])
				this['decimal' + l].value = L.CRS.decimal.format(this._latlng[l]);
			if (this['affiche' + l])
				this['affiche' + l].innerHTML = proj.format(ll[l]);
			if (this['projette' + l])
				this['projette' + l].value = proj.format(ll[l]);
			if (this['title' + l])
				this['title' + l].innerHTML = proj.title[l];
		}

		// Réécrit les options du sélecteur de type de projection
		if (this.selectprj) {
			// On efface tout le contenu
			while (this.selectprj.hasChildNodes())
				this.selectprj.removeChild(this.selectprj.firstChild);

			// On initialise la liste de séléction avec les projections disponibles pour ce point
			var centre = new L.Point(this._latlng.lng, this._latlng.lat);
			for (c in L.CRS)
				if (L.CRS[c] &&
					L.CRS[c].name && (!L.CRS[c].bounds || // On affiche les projections qui n'ont pas de limite
						L.CRS[c].bounds.contains(centre) // Ou celles qui sont dans les limite
					)) {
					var option = document.createElement('option');
					option.value = c;
					if (c == this.options.projectionType)
						option.selected = 'selected';
					option.appendChild(document.createTextNode(L.CRS[c].name));
					this.selectprj.appendChild(option);
				}
			this.options.projectionType = this.selectprj.value; // Permet de récupérer la projection si la position est sortie de la zone de validité
		}
	}
});