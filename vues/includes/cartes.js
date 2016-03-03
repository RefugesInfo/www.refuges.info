<?php
/*
 * Copyright (c) 2016 Dominique Cavailhez
 * https://github.com/Dominique92/Leaflet.GeoJSON.Ajax
 *
 * Couches geoJson pour www.refuges.info
 */
?>

<?if (strstr('nav|point',$vue->type)) {?>
var baseLayers = {
	'Refuges.info':new L.TileLayer.OSM.MRI(),
	'OSM fr':      new L.TileLayer.OSM.FR(),
	'Outdoors':    new L.TileLayer.OSM.Outdoors(),
	'IGN':         new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}),
	'IGN Express': new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}),
	'SwissTopo':   new L.TileLayer.SwissTopo({l:'ch.swisstopo.pixelkarte-farbe'}),
	'Autriche':    new L.TileLayer.Kompass({l:'Touristik'}),
	'Espagne':     new L.TileLayer.WMS.IDEE(),
	'Italie':      new L.TileLayer.WMS.IGM(),
	'Angleterre':  new L.TileLayer.OSOpenSpace('<?=$config['os_key']?>', {}),
	'Photo Bing':  new L.BingLayer('<?=$config['bing_key']?>', {type:'Aerial'}),
	'Photo IGN':   new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'ORTHOIMAGERY.ORTHOPHOTOS'})
};
<?}?>

// Points d'interêt refuges.info
L.GeoJSON.Ajax.wriPoi = L.GeoJSON.Ajax.extend({
	options: {
		urlGeoJSON: '<?=$config['sous_dossier_installation']?>api/bbox',
		argsGeoJSON: {
			type_points: 'all'
		},
		bbox: true,
		idAjaxStatus: 'ajax-poi-status', // HTML id element owning the loading status display
		style: function(feature) {
			var prop = [];
			if (feature.properties.coord.alt)
				prop.push(feature.properties.coord.alt + 'm');
			if (feature.properties.places.valeur)
				prop.push(feature.properties.places.valeur + '<img src="' + '<?=$config['sous_dossier_installation']?>images/lit.png"/>');
			this.options.disabled = !this.options.argsGeoJSON.type_points;
			return {
				url: feature.properties.lien,
				iconUrl: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
				iconAnchor: [8, 4],
				title: '<a href="' + feature.properties.lien + '">' + feature.properties.nom + '</a>' +
					(prop.length ? '<div style=text-align:center>' + prop.join(' ') + '</div>' : ''),
				labelClass: 'carte-point-etiquette',
				remanent: true,
				degroup: 12 // Spread the icons when the cursor hovers on a busy area.
			};
		}
	}
});

// Points d'interêt via chemineur.fr
<?if (strstr('nav',$vue->type)) {?>
L.GeoJSON.Ajax.chem = L.GeoJSON.Ajax.extend({
	options: {
		urlGeoJSON: 'http://v2.chemineur.fr/prod/chem/json.php',
		urlRootRef: 'http://chemineur.fr/point/',
		bbox: true,
		idAjaxStatus: 'ajax-poiCHEM-status',
		style: function(feature) {
			return {
				title: feature.properties.nom + ' <a href="' + this.options.urlRootRef + feature.properties.id + '" target="_blank">&copy;</a>',
				iconUrl: 'http://v2.chemineur.fr/prod/chemtype/' + feature.properties.type.icone + '.png',
				iconAnchor: [8, 4],
				labelClass: 'carte-site-etiquette',
				remanent: true,
				degroup: 12
			};
		}
	}
});
<?}?>

// Points d'interêt OSM overpass
<?if (strstr('nav|point',$vue->type)) {?>
L.GeoJSON.Ajax.OSM.services = L.GeoJSON.Ajax.OSM.extend({
	options: {
		maxLatAperture: 0.5, // Largeur de la carte (en degrés latitude) en dessous de laquelle on recherche les points
		timeout: 5, // En secondes, du serveur à partir duquel il abandonne la recherche et affiche la loupe rouge
		idAjaxStatus: 'ajax-osm-status', // HTML id element owning the loading status display

		/* Requette :
		La définition des types de points à afficher se trouve:
		- Dans /vues/points.js pour la page point:
			new L.GeoJSON.Ajax.OSM.services({
				services: {
					tourism: 'hotel|camp_site',
					shop: 'supermarket|convenience',
					amenity: 'parking'
				},
		- Dans /vues/nav.js pour la page nav: 
			<ul>
				< ? foreach (array (
					'H&ocirc;tels' => 'tourism~hotel',
					'Campings' => 'tourism~camp_site',
					'Alimentation' => 'shop~supermarket|convenience',
					'Parkings' => 'amenity~parking',
				...
		*/

		// Traduction du nom des icônes (hotel & parking sont implicites)
		icons: {
			camp_site: 'camping',
			supermarket: 'ravitaillement',
			convenience: 'ravitaillement'
		},

		// Traduction du texte des étiquettes (en minuscule !)
		language: {
			hotel: 'h&ocirc;tel',
			camp_site: 'camping',
			convenience: 'alimentation',
			supermarket: 'supermarch&egrave;'
		},

		// Formatage de l'étiquette affichée au survol
		label: function(data) { // Entrée: les données retournées par Overpass (corrigées pour certaines)
			return { // Sortie: les lignes à écrire dans l'étiquette du point
				name: '<b>' + data.tags.name + '</b>',
				description: [
					data.type,
					'*'.repeat(data.tags.stars),
					data.tags.rooms ? data.tags.rooms + ' chambres' : '',
					data.tags.place ? data.tags.place + ' places' : '',
					data.tags.capacity ? data.tags.capacity + ' places' : '',
					'<a href="http://www.openstreetmap.org/' + (data.center ? 'way' : 'node') + '/' + data.id + '" target="_blank">&copy;</a>'
				],
				altitude: data.tags.ele + ' m',
				phone: '<a href="tel:' + data.tags.phone.replace(/[^0-9\+]+/ig, '') + '">' + data.tags.phone + '</a>',
				email: '<a href="mailto:' + data.tags.email + '">' + data.tags.email + '</a>',
				address: [
					data.tags['addr:housenumber'],
					data.tags['addr:street'],
					data.tags['addr:postcode'],
					data.tags['addr:city']
				],
				website: '<a href="' + data.tags.website + '" target="_blank">' + data.tags.website + '</a>'
			};
			// Les tableaux seront concaténés
			// Les lignes correspondantes aux données inexistantes seront ignorées
		},

		// Style d'affichage des icônes
		style: function(feature) {
			return {
				iconUrl: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.icon + '.png',
				iconAnchor: [8, 4],
				labelClass: 'carte-service-etiquette',
				remanent: true,
				degroup: 12
			};
		}
	}
});
<?}?>
