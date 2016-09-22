/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported both on Leaflet V0.7 & V1.0
 *
 * French maps
 * Lambert projections et IGN layers
 * Developpement key (localhost): http://api.ign.fr
 * Production key: http://pro.ign.fr/api-web => Service en ligne => Pour un site internet grand public => S'ABONNER
 * IGN doc on http://api.ign.fr/jsp/site/Portal.jsp?page_id=6&document_id=80&dossier_id=53
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
		p: window.location.href.match(/[a-z]*/i)[0], // Use the same protocol than the referer.
		l: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
		f: 'jpeg',
		attribution: '&copy; <a href="http://www.ign.fr/">IGN</a>'
	},
	initialize: function(options) {
		L.TileLayer.prototype.initialize.call(this,
			'{p}://wxs.ign.fr/{k}/geoportail/wmts' +
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