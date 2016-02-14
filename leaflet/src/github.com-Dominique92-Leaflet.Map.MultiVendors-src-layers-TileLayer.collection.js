/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * Collection of many maps vendors
 */

L.TileLayer.collection = function(name) {
	var collection = L.TileLayer._collection;
	if (typeof collection == 'undefined') { // Build it only once
		collection = {
			'OSM': new L.TileLayer.OSM(),
			'OSM-FR': new L.TileLayer.OSM.FR(),
			'Maps.Refuges.Info': new L.TileLayer.OSM.MRI(),
			'Hike & Bike': new L.TileLayer.OSM.hikebike()
		};

		// ThunderForest
		var ft = ['Landscape', 'Outdoors', 'Cycle', 'Transport'];
		for (m in ft)
			if (typeof L.TileLayer.OSM[ft[m]] != 'undefined')
				collection['OSM-' + ft[m]] = new L.TileLayer.OSM[ft[m]]();

		// France
		if (typeof L.TileLayer.IGN != 'undefined' &&
			typeof key != 'undefined' && typeof key.ign != 'undefined')
			L.Util.extend(collection, {
				'IGN':           new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}),
				'IGN Photo':     new L.TileLayer.IGN({k: key.ign, l:'ORTHOIMAGERY.ORTHOPHOTOS'}),
				'IGN Topo':      new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'}),
				'IGN Classique': new L.TileLayer.IGN({k: key.ign, l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}),
				'IGN Cadastre':  new L.TileLayer.IGN({k: key.ign, l:'CADASTRALPARCELS.PARCELS'})
			});

		// Espana
		if (typeof L.TileLayer.WMS.IDEE != 'undefined')
			L.Util.extend(collection, {
				'Espagne': new L.TileLayer.WMS.IDEE(),
				'Espagne photo': new L.TileLayer.WMS.IDEE.Photo()
			});

		// Italy
		if (typeof L.TileLayer.WMS.IGM != 'undefined')
			collection.Italie = new L.TileLayer.WMS.IGM();

		// Swiss
		if (typeof L.TileLayer.SwissTopo != 'undefined')
			L.Util.extend(collection, {
				'SwissTopo': new L.TileLayer.SwissTopo({l:'ch.swisstopo.pixelkarte-farbe'}),
//				'Swiss Siegfried': new L.TileLayer.SwissTopo({l:'ch.swisstopo.hiks-siegfried'}),
//				'Swiss Dufour': new L.TileLayer.SwissTopo({l:'ch.swisstopo.hiks-dufour'}),
				'Swiss Image': new L.TileLayer.SwissTopo({l:'ch.swisstopo.swissimage'})
			});

		// Austria
		if (typeof L.TileLayer.Kompass != 'undefined')
			L.Util.extend(collection, {
				'Autriche': new L.TileLayer.Kompass({l:'Touristik'}),
				'Kompass':  new L.TileLayer.Kompass({l:'OSM'})
			});

		// OS-map (Great Britain)
		if (typeof key != 'undefined' && typeof key.os != 'undefined') {
			if (typeof L.TileLayer.OSOpenSpace != 'undefined')// For Leaflet V0.7
				collection['OS-Great Britain'] = new L.TileLayer.OSOpenSpace(key.os, {}); // Il faut mettre le {} sinon BUG
			else
			if (typeof L.TileLayer.WMS.OS != 'undefined') // For Leaflet V1.0
				collection['OS Great Britain'] = new L.TileLayer.WMS.OS({k:key.os});
		}

		// MicroSoft
		if (typeof L.BingLayer != 'undefined' &&
			typeof key != 'undefined' && typeof key.bing != 'undefined')
			L.Util.extend(collection, {
				'Bing Road':   new L.BingLayer(key.bing, {type:'Road'}),
				'Bing Photo':  new L.BingLayer(key.bing, {type:'Aerial'}),
				'Bing Hybrid': new L.BingLayer(key.bing, {type:'AerialWithLabels'})
			});

		// Google
		if (typeof L.TileLayer.Google != 'undefined')
			L.Util.extend(collection, {
				'Google Road':    new L.TileLayer.Google({l:'m'}),
				'Google Terrain': new L.TileLayer.Google({l:'p'}),
				'Google Photo':   new L.TileLayer.Google({l:'s'}),
				'Google Hybride': new L.TileLayer.Google({l:'s,h'})
			});
	}

	return typeof collection[name] != 'undefined' ? collection[name] : collection;
};