/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Italian maps
 * Instance of the WMS class allow viewing maps of IGM (Istituto Geografico Militare) Geoportale Nazionale
 * (c) http://www.pcn.minambiente.it
 *
 * Usage:
	new L.TileLayer.WMS.IGM()
 */

L.TileLayer.WMS.IGM = L.TileLayer.WMS.extend({

	initialize: function() {
		L.TileLayer.WMS.prototype.initialize.call(this,
			'http://129.206.228.72/cached/osm?', { // Pour les grands zooms, il n'y a pas de carte IGM, donc on prend une carte OSM au même format WMS
				crs: L.CRS.EPSG900913,
				tileSize: 512 // Moins de filigranes
			}
		);
	},

	onAdd: function(map) {
		L.TileLayer.WMS.prototype.onAdd.call(this, map);
		map.on('zoomend', this._onZoom, this); // On ajoute une action sur chaque changement de zoom
		this._onZoom(); // Et, pour bien commencer, on l'exécute au démarrage
	},

	_onZoom: function() {
		if (!this._map)
			return;
		// Il y a 3 sources de cartes IGM pour des définitions bien précises
		var np = {
			url: 'http://wms.pcn.minambiente.it/ogc?map=/ms_ogc/WMS_v1.3/raster/',
			urlExt: '',
			attribution: '&copy; <a href="http://www.pcn.minambiente.it/viewer">IGM</a>'
		};
		if (this._map._zoom < 11) {
			np.url = 'http://129.206.228.72/cached/osm?';
			np.layers = 'osm_auto:all';
			np.attribution = '&copy; <a href="http://www.osm-wms.de/">OSM</a>';
		} else if (this._map._zoom < 13) {
			np.urlExt = 'IGM_250000.map';
			np.layers = 'CB.IGM250000';
		} else if (this._map._zoom < 15) {
			np.urlExt = 'IGM_100000.map';
			np.layers = 'MB.IGM100000';
		} else if (this._map._zoom < 16) {
			np.urlExt = 'IGM_25000.map';
			np.layers = 'CB.IGM25000';
		}

		// Si les paramètres ont changé
		if (this.wmsParams.layers != np.layers) {
			// On réinitialise les paramètres et on recharge la couche
			this._url = np.url + np.urlExt;
			this.wmsParams.layers = np.layers;
			this.redraw();

			// Sans oublier l'attribution
			this.options.attribution = np.attribution;
			this._map.attributionControl._attributions = [];
			this._map.attributionControl.addAttribution(np.attribution);
		}
	}
});