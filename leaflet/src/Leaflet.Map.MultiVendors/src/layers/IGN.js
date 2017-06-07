/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported on Leaflet V0.7 & V1.0
 *
 * French maps
 * Lambert projections et IGN layers
 * Developpement key (localhost): http://api.ign.fr
 * Production key: http://professionnels.ign.fr
 * IGN doc on http://api.ign.fr
 *
 * Usage: new L.TileLayer.IGN({k:'CLE_IGN').addTo(map);
 *
 * Available layers (ddpends on your IGN contract)
	new L.TileLayer.IGN({k:'CLE_IGN', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}) : Normal
	new L.TileLayer.IGN({k:'CLE_IGN', l:'ORTHOIMAGERY.ORTHOPHOTOS'}) : Photos
	new L.TileLayer.IGN({k:'CLE_IGN', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'}) : TOP 25
	new L.TileLayer.IGN({k:'CLE_IGN', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}) : New presentation
	new L.TileLayer.IGN({k:'CLE_IGN', l:'CADASTRALPARCELS.PARCELS', f: 'png'}) : Cadastre
 */

L.TileLayer.IGN = L.TileLayer.extend({
	options: {
		l: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
		f: 'jpeg',
		maxNativeZoom: 18,
		maxZoom: 21,
		errorTileUrl: 'http://www.ign.fr/sites/all/themes/ign_portail/logo.png',
		attribution: '&copy; <a href="http://www.ign.fr/">IGN</a>'
	},

	initialize: function(options) {
		L.TileLayer.prototype.initialize.call(this,
			'//wxs.ign.fr/{k}/geoportail/wmts' +
				'?LAYER={l}'+
				'&EXCEPTIONS=text/xml'+
				'&FORMAT=image/{f}'+
				'&SERVICE=WMTS'+
				'&VERSION=1.0.0'+
				'&REQUEST=GetTile'+
				'&STYLE=normal'+
				'&TILEMATRIXSET=PM'+
				'&TILEMATRIX={z}'+
				'&TILECOL={x}'+
				'&TILEROW={y}',
			options
		);
	}
});