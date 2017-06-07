var map = new L.Map('map', {
		center: new L.LatLng(46.8, 2),
		zoom: 6,
		layers: [
			// Baselayer
			new L.TileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', { // Available on http & https
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>'
			})
		]
	});

var wri = new L.GeoJSON.Ajax.WRIpoi({ // Europe mountain points of interest
	idAjaxStatus: 'ajax-status'
}).addTo(map);

new L.GeoJSON.Ajax.WRImassifs().addTo(map); // French mountain limits

// Ajax arguments control
// See http://refuges.info API doc supporting this demo: http://www.refuges.info/api/doc/#/api/bbox
var lc2 = new L.Control.Layers.argsGeoJSON(
	wri,
	{
		'Hut': {l: wri, p: 'type_points', v: 7},
		'Refuge': {l: wri, p: 'type_points', v: 10},
		'Hotel': {l: wri, p: 'type_points', v: 9},
		'Water': {l: wri, p: 'type_points', v: 23},
		'Summit': {l: wri, p: 'type_points', v: 6},
		'Pass': {l: wri, p: 'type_points', v: 6},
		'Unknown': {l: wri, p: 'type_points', v: 28}
	}
).addTo(map);
