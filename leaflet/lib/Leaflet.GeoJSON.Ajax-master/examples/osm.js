var map = new L.Map('map');
map.setView([45.18, 5.7], 12);

// Baselayer
new L.TileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// OSM overpass layer
var osm = new L.GeoJSON.Ajax.OSM({
	maxLatAperture: 0.5, // (°) latitude map max aperture for OSM POI request
	timeout: 5, // (seconds) server max request time
	idAjaxStatus: 'ajax-status', // HTML id element owning the loading status display

	// Label text translation (lowercase !)
	language: {
		hotel: 'h&ocirc;tel',
		room: 'chambre',
		camp_site: 'camping',
		convenience: 'alimentation',
		supermarket: 'supermarch&egrave;'
	},

	// Icons display style
	style: function(feature) {
		return {
			iconUrl: '//chemineur.fr/ext/Dominique92/GeoBB/types_points/' + feature.properties.icon_name + '.png',
			iconAnchor: [8, 4],
			popupClass: 'etiquette'
		};
	}
}).addTo(map);
