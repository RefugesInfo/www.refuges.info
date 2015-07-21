/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Add references to many maps vendors
 */

L.Map.maps = function(name) {
	if (typeof L.Map._maps == 'undefined') {
		var maps = {
			'Maps.Refuges.Info': L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & <a href="http://wiki.openstreetmap.org/wiki/Hiking/mri">MRI</a>'
			}),
			'OpenStreetMap': L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a>'
			}),
			'OpenStreetMap-FR': L.tileLayer('http://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a>'
			}),
			'MapQuest': L.tileLayer('http://otile{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png', {
				subdomains: '1234',
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a>. Tiles courtesy of <a href="http://www.mapquest.com/">MapQuest</a>'
			}),

			'IGN': new L.TileLayer.IGN(),
			'IGN Photo': new L.TileLayer.IGN('ORTHOIMAGERY.ORTHOPHOTOS'),
			'IGN Topo': new L.TileLayer.IGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'),
			'IGN Classique': new L.TileLayer.IGN('GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'),
			'IGN Cadastre': new L.TileLayer.IGN('CADASTRALPARCELS.PARCELS'),

			'SwissTopo': new L.TileLayer.SwissTopo(),
			'Swiss Image': new L.TileLayer.SwissTopo('ch.swisstopo.swissimage'),
			'Swiss Siegfried': new L.TileLayer.SwissTopo('ch.swisstopo.hiks-siegfried'),
			'Swiss Dufour': new L.TileLayer.SwissTopo('ch.swisstopo.hiks-dufour'),

			'Espagne': new L.TileLayer.WMS.IDEE(),
			'Espagne photo': new L.TileLayer.WMS.IDEE.Photo(),
			'Italie': new L.TileLayer.WMS.IGM(),

			/* DCMM TODO Mapbox
			'Mapbox':new L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
				maxZoom: 18,
				attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
					'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="http://mapbox.com">Mapbox</a>',
				id: 'examples.map-i86knfo3'
			}),
			*/
			/* DCMM TODO Russie
				'Yandex':new L.Yandex(),
				'Yandex map':new L.Yandex('map'),
				'Yandex satellite':new L.Yandex('satellite'),
				'Yandex hybrid':new L.Yandex('hybrid'),
				'Yandex publicMap':new L.Yandex('publicMap'),
				'Yandex publicMapHybrid':new L.Yandex('publicMapHybrid'),
			*/
		};

		// Cartes google
		if (typeof L.Google != 'undefined' &&
			typeof google != 'undefined') // Si le script google de déclaration de l'API a été inclus
			L.Util.extend(maps, {
			'Google Road': new L.Google('ROADMAP'),
			'Google Terrain': new L.Google('TERRAIN'),
			'Google Photo': new L.Google(), // Idem 'SATELLITE'
			'Google Hybrid': new L.Google('HYBRID')
		});

		// Cartes MicroSoft
		if (typeof L.BingLayer != 'undefined' &&
			typeof key != 'undefined' && typeof key.bing != 'undefined')
			L.Util.extend(maps, {
				'Bing Road': new L.BingLayer(key.bing, {
					type: 'Road'
				}),
				'Bing Photo': new L.BingLayer(key.bing), // Idem type:'Aerial'
				'Bing Hybrid': new L.BingLayer(key.bing, {
					type: 'AerialWithLabels'
				}),
			});

		// Cartes ThunderForest
		var ft = ['Landscape', 'Outdoors', 'Cycle', 'Transport'];
		for (m in ft)
			maps['OSM-' + ft[m]] =
			new L.tileLayer('http://{s}.tile.thunderforest.com/' + ft[m].toLowerCase() + '/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">Contributeurs OpenStreetMap</a> & ' +
					'<a href="http://www.thunderforest.com">Thunderforest ' + ft[m] + '</a>'
			});

		// Cartes Ordnance Survey: Britain's mapping agency
		if (typeof L.OSOpenSpace != 'undefined' &&
			typeof key != 'undefined' && typeof key.os != 'undefined') {
			maps['OS-GB'] = new L.TileLayer.OSOpenSpace(key.os, {}); //DCMM BUG effet de bord sur les cartes thunderforest de tile = 200
			maps['OS-GB'].options.crs = L.OSOpenSpace.getCRS();
		}

		// On remet les couches dans l'ordre de leur nom
		L.Map._maps = {};
		var keys = Object.keys(maps).sort();
		for (k in keys)
			L.Map._maps[keys[k]] = maps[keys[k]];
	}

	return typeof L.Map._maps[name] != 'undefined' ? L.Map._maps[name] : L.Map._maps;
}