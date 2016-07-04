/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supportè sur Leaflet V0.7 & V1.0
 *
 * Cartes françaises
 * Projections Lambert et couches IGN
 * Clé de développement (localhost) sur: http://api.ign.fr
 * Clé de production sur: http://pro.ign.fr/api-web => Service en ligne => Pour un site internet grand public => S'ABONNER
 * Doc sur http://api.ign.fr/jsp/site/Portal.jsp?page_id=6&document_id=80&dossier_id=53
 *
 * Layers (dépend de l'abonnement lié à votre clé)
	new L.TileLayer.IGN({k:'CLE_IGN', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}) : Normal
	new L.TileLayer.IGN({k:'CLE_IGN', l:'ORTHOIMAGERY.ORTHOPHOTOS'}) : Photos
	new L.TileLayer.IGN({k:'CLE_IGN', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD'}) : TOP 25
	new L.TileLayer.IGN({k:'CLE_IGN', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}) : Nouvelle présentation
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