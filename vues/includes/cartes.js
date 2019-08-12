// Contient les déclarations communes aux cartes

/* Super zoom pour les photos aériennes */
L.BingLayer.prototype.options.maxNativeZoom = 18;
L.BingLayer.prototype.options.maxZoom = 21;

L.TileLayer.OSM.OTP = L.TileLayer.OSM.extend({
	options: {
		url: '//{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
		subAttribution: '<a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
	}
});

// Couches de base
<?if (strstr('nav|point',$vue->type)) {?>
if (typeof L.OSOpenSpace.TileLayer != 'undefined')
	L.OSOpenSpace.TileLayer.prototype.options.crs = L.OSOpenSpace.CRS; // Assign CRS to OS-UK layer options

var baseLayers = {
	'Refuges.info':new L.TileLayer.OSM.MRI(),
	'OSM fr':      new L.TileLayer.OSM.FR(),
	'OpenTopoMap': new L.TileLayer.OSM.OTP(),
	'IGN':         new L.TileLayer.IGN({k: '<?=$config_wri['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}),
	'IGN Express': new L.TileLayer.IGN({k: '<?=$config_wri['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}),
	'SwissTopo':   new L.TileLayer.SwissTopo({l:'ch.swisstopo.pixelkarte-farbe'}),
	'Autriche':    new L.TileLayer.Kompass({l:'Touristik'}),
	'Espagne':     new L.TileLayer.WMS.IDEE(),
	'Photo Bing':  new L.BingLayer('<?=$config_wri['bing_key']?>', {type:'Aerial'}),
	'Photo IGN':   new L.TileLayer.IGN({k: '<?=$config_wri['ign_key']?>', l:'ORTHOIMAGERY.ORTHOPHOTOS'})
};
<?}?>

// Points d'interêt refuges.info
L.GeoJSON.Ajax.wriPoi = L.GeoJSON.Ajax.extend({
	options: {
		urlGeoJSON: '<?=$config_wri['sous_dossier_installation']?>api/bbox',
		argsGeoJSON: {
			type_points: 'all'
		},
		bbox: true,
		idAjaxStatus: 'ajax-poi-status', // HTML id element owning the loading status display
		style: function(feature) {
			var url_point = feature.properties.lien,
				prop = [];
			if (feature.properties.coord.alt)
				prop.push(feature.properties.coord.alt + 'm');
			if (feature.properties.places.valeur)
				prop.push(feature.properties.places.valeur + '<img src="' + '<?=$config_wri['sous_dossier_installation']?>images/lit.png"/>');
			this.options.disabled = !this.options.argsGeoJSON.type_points;
			return {
				url: url_point,
				iconUrl: '<?=$config_wri['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
				iconAnchor: [8, 8],
				popup: feature.properties.nom +
					(prop.length ? '<div style=text-align:center>' + prop.join(' ') + '</div>' : ''),
				popupClass: 'carte-point-etiquette',
				degroup: 12 // Spread the icons when the cursor hovers on a busy area.
			};
		}
	}
});

// Points d'interêt via chemineur.fr
<?if (strstr('nav',$vue->type)) {?>
L.GeoJSON.Ajax.chem = L.GeoJSON.Ajax.extend({
	options: {
		urlGeoJSON: '//dc9.fr/chemineur/ext/Dominique92/GeoBB/gis.php',
		argsGeoJSON: {
			site: 'this',
			poi: '3,8,16,20,23,28,30,40,44,64,58,62'
		},
		bbox: true,
		idAjaxStatus: 'ajax-poiCHEM-status',
		style: function(feature) {
			var url = feature.properties.url;
			delete feature.properties.url; // Avoid double action
			return {
				title: feature.properties.nom,
				popup: feature.properties.nom + ' <a href="' + url + '" target="_blank">&copy;</a>',
				iconUrl: feature.properties.icone,
				iconAnchor: [8, 8],
				popupClass: 'carte-site-etiquette',
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
		urlGeoJSON: '<?=$config_wri['overpass_api']?>',
		maxLatAperture: 0.5, // Largeur de la carte (en degrés latitude) en dessous de laquelle on recherche les points
		timeout: 5, // En secondes, du serveur à partir duquel il abandonne la recherche et affiche la loupe rouge
		idAjaxStatus: 'ajax-osm-status', // HTML id element owning the loading status display

		// Traduction du nom des icônes (en minuscule !)
		// Les clés du tableau ci dessous sont les <VALEUR> retournées par overpass dans la structure .tags = {"xxx": <VALEUR>}
		// Les valeurs du tableau ci dessous sont les <NOM> des icones dans //WRI/images/icones/<NOM>.png
		// hotel & parking sont implicites (traduits par eux même par défaut parcequepas dans le tableau)
		icons: {
			camp_site: 'camping',
			guest_house: 'hotel',
			chalet: 'hotel',
			hostel: 'hotel',
			apartment: 'hotel',
			supermarket: 'ravitaillement',
			convenience: 'ravitaillement'
		},

		// Traduction du texte des étiquettes (en minuscule !)
		// Cette traduction est effectuée à la fin de la constitution du texte de l'étiquette et traduit aussi bien les infos overpass que les noms d'icônes que les textes ajoutés
		language: {
			hotel: 'hôtel',
			guest_house: 'chambre d\'hôte',
			chalet: 'gîte rural',
			apartement: 'meublé de tourisme',
			hostel: 'auberge de jeunesse/gîte d\'étape',
			camp_site: 'camping',
			convenience: 'alimentation',
			supermarket: 'supermarché',
			bus_stop: 'arrêt de bus'
		},

		// Formatage de l'étiquette affichée au survol
		label: function(data) { // Entrée: les données retournées par Overpass (corrigées pour certaines)
			return { // Sortie: les lignes à écrire dans l'étiquette du point
				name: '<b>' + data.tags.name + '</b>',
				description: [
					data.tag,
					'*'.repeat(data.tags.stars),
					data.tags.rooms ? data.tags.rooms + ' chambres' : '',
					data.tags.place ? data.tags.place + ' places' : '',
					data.tags.capacity ? data.tags.capacity + ' places' : '',
					'<a href="http://www.openstreetmap.org/' + (data.center ? 'way' : 'node') + '/' + data.id + '" target="_blank">&copy;</a>',
					data.tags.description ? '<br />' + data.tags.description : ''
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
				iconUrl: '<?=$config_wri['sous_dossier_installation']?>images/icones/' + feature.properties.icon_name + '.png',
				iconAnchor: [8, 8],
				popupClass: 'carte-service-etiquette',
				degroup: 12
			};
		}
	}
});
<?}?>
