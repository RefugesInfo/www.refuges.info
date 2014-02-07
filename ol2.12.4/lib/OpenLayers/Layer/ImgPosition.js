/*DCM++ © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/Img.js
 * @requires OpenLayers/BaseTypes/Bounds.js
 * @requires OpenLayers/Projection.js
 * @requires ../proj4js-1.1.0/lib/proj4js-combined.js
 * @requires ../proj4js-1.1.0/lib/defs/UTM.js
 */

/**
 * Class: OpenLayers.Layer.ImgPosition
 * Crée un layer vector et qui met à jour des champs lon/lat avec sélection du type de coordonnée
 *
 * Inherits from:
 *  - <OpenLayers.Layer.Img>
 */

OpenLayers.Layer.ImgPosition = OpenLayers.Class (OpenLayers.Layer.Img, {

	projections: {
		decimal:   'Degrés décimaux',
		degminsec: 'Deg Min Sec',
		'EPSG:21781': 'SwissGrid(CH1903/NV03)',
		'EPSG:32630': 'UTM 30N (France ouest)',
		'EPSG:32631': 'UTM 31N (France centre)',
		'EPSG:32632': 'UTM 32N (France est)',
		'EPSG:32633': 'UTM 33N (Autriche)',
		'EPSG:27571': 'Lambert I (Nord)',
		'EPSG:27572': 'Lambert II (Centre)',
		'EPSG:27573': 'Lambert III (Sud)',
		'EPSG:27574': 'Lambert IV (Corse)'
	},
	bounds: {
		'EPSG:21781': new OpenLayers.Bounds (5.97, 45.83, 10.49, 47.81),
		'EPSG:32630': new OpenLayers.Bounds (-6, 0, 0, 84),
		'EPSG:32631': new OpenLayers.Bounds (0, 0, 6, 84),
		'EPSG:32632': new OpenLayers.Bounds (6, 0, 12, 84),
		'EPSG:32633': new OpenLayers.Bounds (12, 0, 18, 84),
		'EPSG:27571': new OpenLayers.Bounds (-5.2, 48.15, 8.23, 51.1),
		'EPSG:27572': new OpenLayers.Bounds (-5.2, 42.25, 8.23, 51.1),
		'EPSG:27573': new OpenLayers.Bounds (-1.76, 42.33, 7.77, 45.45),
		'EPSG:27574': new OpenLayers.Bounds (8.5, 41.33, 9.6, 43.05)
	},
	titles: {
		defaut: {lon: 'Longitude', lat: 'Latitude'},
		'EPSG:21781': {lon: 'x', lat: 'y'}
	},
	format: {
		defaut: function (v) { // Prend la partie entière et insére un blanc avant les milliers
			v = Math.abs (v);
			if (v < 1000) return Math.round (v);
			var m = Math.floor (v / 1000); 
			var u = Math.round (v - m * 1000);
			if (u < 10) u = '00' + u;
			else if (u < 100) u = '0' + u;
			if (u==1000) {m++; u='000';}
			return '' + m + ' ' + u;
		},
		decimal: function (v) {
			return Math.round (v * 100000) / 100000;
		},
		degminsec: function (v) {
			v = Math.abs (v);
			var d = Math.floor (v);
			var mf = (v-d)*60;
			var m = Math.floor(mf);
			var s = Math.round((mf-m)*60);
			if (s==60) {m++; s=0;}
			if (m==60) {d++; m=0;}
			return '' + d + '°' + (m < 10 ? '0' : '') + m + "'" + (s < 10 ? '0' : '') + s + '"';
		}
	},
	unformat: {
		defaut: function (v) {
			v = v.replace(/ /g,''); // Juste enlever les séparateurs de miliers
			v = v.replace(/,/g,'.'); // Au cas où il y aurait une , à la place du .
			return '0' + v;
		},
		decimal: function (v) {
			v = v.replace(/,/g,'.'); // Au cas où il y aurait une , à la place du .
			return '0' + v;
		},
		degminsec: function (v) {
			v = v.replace(/'|"/g,'°').split('°');
			return '0' + (v[0]/1 + v[1]/60 + v[2]/3600);
		}
	},
	prefixeId: {
		titre: 'titre-',
		decimal: 'dec-',
		projected: ''
	},
	idll: {
		lon: 'lon',
		lat: 'lat'
	},
	idSelect: 'select-projection',
	projectionType: 'decimal',
	position: null, // Toujours exprimé en format EPSG:4326

    initialize: function (name, options) {
        OpenLayers.Layer.Img.prototype.initialize.apply (this, arguments); // Initialise la classe héritée
		
		// Détection des éléments html concernés
		this.el = {};
		for (e in this.prefixeId)
			this.el [e] = {
				lon: document.getElementById (this.prefixeId [e] + this.idll.lon), 
				lat: document.getElementById (this.prefixeId [e] + this.idll.lat)
			};
		this.elSelect = document.getElementById (this.idSelect);

		// Initialise les écouteurs du select
		if (this.elSelect) {
			this.elSelect.owner = this; // Pour retrouver le contexte lors du callback
			this.elSelect.onchange = function (e) {
				this.owner.projectionType = this.value;
				this.owner.drawValues ();
			}
		}
	},

	setMap: function  (map) {
        OpenLayers.Layer.Img.prototype.setMap.apply (this, arguments);

		if (this.position)
			this.drawSelect ();
		this.drawValues ();
	},

	// Réécrit les options du sélecteur de type de projection
 	drawSelect: function () {
		if (this.elSelect) {
			// On efface tout le contenu
			while (this.elSelect.hasChildNodes())
				this.elSelect.removeChild (this.elSelect.firstChild);       
		
			// On initialise la liste de séléction avec les projections disponibles pour ce point
			for (i in this.projections)
				if (!this.bounds [i] ||
					 this.bounds [i].contains (this.position.lon, this.position.lat)
				) {
					var option = document.createElement ('option');
					option.value = i;
					if (i == this.projectionType)
						option.selected = 'selected';
					option.appendChild (document.createTextNode (this.projections [i]));
					this.elSelect.appendChild (option);
				}
			this.projectionType = this.elSelect.value; // Permet de récupérer la projection si la position est sortie de la zone de validité
		}
	},
	
 	drawValues: function () { // Ecrit tous les champs
		// Prépare ce qu'il y a a afficher
		var data = {
			titre:  this.find (this.titles, this.projectionType),
			decimal: this.position,
			projected: Proj4js.defs [this.projectionType]
				? this.position.clone().transform (
					new OpenLayers.Projection ('EPSG:4326'),
					new OpenLayers.Projection (this.projectionType)
				)
				: this.position
		}
		var format = {
			projected: this.find (this.format, this.projectionType),
			decimal: this.format.decimal // Pour enregistrer les points avec 5 décimales
		}
		// Balaye tous les champs
		for (e in this.prefixeId)
			for (l in this.idll) {
				var val = format[e]
					? format[e] (data[e][l])
					: data[e][l];
				var el = this.el[e][l];
				if (el) {
					if (el.tagName == 'INPUT')
						el.value = val;
					else
						el.innerHTML = val;
				}
			}
	},

	// Fonctions de service
	find: function (s, m) { // Recherche l'occurence m de la structure s
		var r = null;
		for (i in s)
			if (i == m)
				return s [i];
			else if (!r)
				r = s [i];
		return r; // Sinon, retourne la première valeur
	},

    CLASS_NAME: "OpenLayers.Layer.ImgPosition"
});
