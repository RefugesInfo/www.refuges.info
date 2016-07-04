/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Collection of many maps vendors
 */

L.TileLayer.collection = function(name) {
	if (typeof this._col == 'undefined') { // Build it only once
		this._col = {
//			'OSM': new L.TileLayer.OSM(),
			'OSM-FR': new L.TileLayer.OSM.FR(),
			'Maps-refuges-info': new L.TileLayer.OSM.MRI(),
			'Hike & Bike': new L.TileLayer.OSM.hikebike()
		};

		// ThunderForest
		var ft = ['Landscape', 'Outdoors', 'Cycle', 'Transport'];
		for (m in ft)
			if (typeof L.TileLayer.OSM[ft[m]] != 'undefined')
				this._col['OSM-' + ft[m]] = new L.TileLayer.OSM[ft[m]]();

		// France
		if (typeof L.TileLayer.IGN != 'undefined' &&
			typeof key != 'undefined' && typeof key.ign != 'undefined')
			L.Util.extend(this._col, {
				'IGN':           new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}),
				'IGN topo':      new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'}),
				'IGN classique': new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}),
//				'IGN plan':      new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.PLANIGN'}),
				'IGN cadastre':  new L.TileLayer.IGN({k: key.ign, l:'CADASTRALPARCELS.PARCELS', f: 'png'}),
				'IGN photo':     new L.TileLayer.IGN({k: key.ign, l:'ORTHOIMAGERY.ORTHOPHOTOS'})
			});

		// Espana
		if (typeof L.TileLayer.WMS.IDEE != 'undefined')
			L.Util.extend(this._col, {
				'Espagne': new L.TileLayer.WMS.IDEE(),
				'Espagne photo': new L.TileLayer.WMS.IDEE.Photo()
			});

		// Italy
//		if (typeof L.TileLayer.WMS.IGM != 'undefined')
//			this._col.Italie = new L.TileLayer.WMS.IGM();

		// Swiss
		if (typeof L.TileLayer.SwissTopo != 'undefined')
			L.Util.extend(this._col, {
				'SwissTopo': new L.TileLayer.SwissTopo.Extended(),
//				'Swiss Siegfried': new L.TileLayer.SwissTopo({l:'ch.swisstopo.hiks-siegfried'}),
//				'Swiss Dufour': new L.TileLayer.SwissTopo({l:'ch.swisstopo.hiks-dufour'}),
				'Swiss Image': new L.TileLayer.SwissTopo({l:'ch.swisstopo.swissimage'})
			});

		// Austria
		if (typeof L.TileLayer.Kompass != 'undefined')
			L.Util.extend(this._col, {
//				'Kompass':  new L.TileLayer.Kompass({l:'OSM'}),
				'Autriche': new L.TileLayer.Kompass({l:'Touristik'})
			});

		// OS-map (Great Britain)
		if (typeof key != 'undefined' && typeof key.os != 'undefined') {
				if (window.location.href[4] != 's') // Use the same protocol than the referer.
			L.TileLayer.OSOpenSpace.prototype._url =
				L.TileLayer.OSOpenSpace.prototype._url.replace('https', 'http');
			if (typeof L.TileLayer.OSOpenSpace != 'undefined')// For Leaflet V0.7
				this._col['OS-Great Britain'] = new L.TileLayer.OSOpenSpace(key.os, {}); // Il faut mettre le {} sinon BUG
			else
			if (typeof L.TileLayer.WMS.OS != 'undefined') // For Leaflet V1.0
				this._col['OS Great Britain'] = new L.TileLayer.WMS.OS({k:key.os});
		}

		// MicroSoft
		if (typeof L.BingLayer != 'undefined' &&
			typeof key != 'undefined' && typeof key.bing != 'undefined')
			L.Util.extend(this._col, {
//				'Bing Road':   new L.BingLayer(key.bing, {type:'Road'}),
				'Bing Photo':  new L.BingLayer(key.bing, {type:'Aerial'}),
//				'Bing Hybrid': new L.BingLayer(key.bing, {type:'AerialWithLabels'})
			});

		// Google
		if (typeof L.TileLayer.Google != 'undefined')
			L.Util.extend(this._col, {
//				'Google Road':    new L.TileLayer.Google({l:'m'}),
				'Google Terrain': new L.TileLayer.Google({l:'p'}),
//				'Google Hybride': new L.TileLayer.Google({l:'s,h'}),
				'Google Photo':   new L.TileLayer.Google({l:'s'})
			});
	}

	return typeof this._col[name] != 'undefined' ? this._col[name] : this._col;
};