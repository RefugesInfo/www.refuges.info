// Script lié à la page d'acceuil

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $modele contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 14/03/2013 Léo - Création

/*

// On actualise les points
function actualiseGeoJSON() {
	// On créé un style que jes points prennent par défaut
	var defaultIcon = L.icon({
		iconUrl: '../images/icones/cabane.png',
		iconSize: [16, 16],
		iconAnchor: [8, 8],
		popupAnchor: [0, -8]
	});

	// Pour chaque point, on le créé avec style et popup
	function onEachFeature(feature, layer) {
		var popupContent = '<a href="' + feature.properties.url + '">' + feature.properties.nom + "</a>";
		layer.bindPopup(popupContent);
		var cabaneIcon = L.icon({
			iconUrl: '../images/icones/' + feature.properties.type + '.png',
			iconSize: [16, 16],
			iconAnchor: [8, 8],
			popupAnchor: [0, -8]
		});
		layer.setIcon(cabaneIcon);
	}

	// Appel des points
	var GeoJSONlayer = L.geoJson.ajax('../exportations/exportations.php?format=geojson&bbox=' + map.getBounds().toBBoxString() + '',{
		onEachFeature: onEachFeature,

		pointToLayer: function (feature, latlng) {
			return L.marker(latlng, {icon: defaultIcon});
		}
	}).addTo(map);


	// if (GeoJSONlayer != undefined)
 //    {
 //        map.removeLayer(GeoJSONlayer);
 //    }

}

// On créé un calque pour la carte	
var map = L.map('map');
L.tileLayer('http://maps.refuges.info/hiking/{z}/{x}/{y}.png', {
    attribution: '&copy; Contributeurs d\'<a href="http://openstreetmap.org">OpenStreetMap</a>',
    maxZoom: 18
}).addTo(map);

var GeoJSONlayer = L.geoJson().addTo(map);

// Fonctions de Géolocalisation, on affiche la zone où on se trouve.
function onLocationFound(e) {
    var radius = e.accuracy / 2;
    L.marker(e.latlng).addTo(map);
	actualiseGeoJSON();
}
function onLocationError(e) {
	alert(e.message);
	actualiseGeoJSON();
}
function onMove() {
	// map.removeLayer(GeoJSONlayer);
	actualiseGeoJSON();
}

map.locate({setView: true, maxZoom: 14});

// On modifie les données si :
map.on('locationerror', onLocationError);
map.on('locationfound', onLocationFound);
map.on('moveend', onMove); // Si l'utilisateur a fini de trifouiller la position de la carte, on actualise les points

*/



var map;
var ajaxRequest;
var plotlist;
var plotlayers=[];

function initmap(){
	// set up the AJAX stuff
	ajaxRequest=GetXmlHttpObject();
	if (ajaxRequest==null) {
		alert ("This browser does not support HTTP Request");
		return;
	}

	// set up the map
	map = new L.Map('map');

	var MRIUrl='http://maps.refuges.info/hiking/{z}/{x}/{y}.png';
	var MRIAttrib='&copy; Contributeurs d\'<a href="http://openstreetmap.org">OpenStreetMap</a>';
	var MRI = new L.TileLayer(MRIUrl, {minZoom: 1, maxZoom: 12, attribution: MRIAttrib});		

	map.setView(new L.LatLng(45.9, 7.7),9);
	map.attributionControl.setPrefix('');
	map.addLayer(MRI);
	askForPlots();
	map.on('moveend', onMapMove);
}

function askForPlots() {
	// request the marker info with AJAX for the current bounds
	var bounds=map.getBounds();
	var minll=bounds.getSouthWest();
	var maxll=bounds.getNorthEast();
	var msg='../exportations/exportations.php?format=geojson&bbox='+minll.lng+','+minll.lat+','+maxll.lng+','+maxll.lat;
	ajaxRequest.onreadystatechange = stateChanged; 
	ajaxRequest.open('GET', msg, true);
	ajaxRequest.send(null); 
}

function onMapMove(e) { askForPlots(); }

function GetXmlHttpObject() {
	if (window.XMLHttpRequest) { return new XMLHttpRequest(); }
	if (window.ActiveXObject)  { return new ActiveXObject("Microsoft.XMLHTTP"); }
	return null;
}

function stateChanged() {
	// if AJAX returned a list of markers, add them to the map
	if (ajaxRequest.readyState==4) {
		//use the info here that was returned
		if (ajaxRequest.status==200) {
			plotlist=eval("(" + ajaxRequest.responseText + ")");
			removeMarkers();
			for (i=0;i<plotlist.features.length;i++) {
				var plotll = new L.LatLng(plotlist.features[i].geometry.coordinates[1],plotlist.features[i].geometry.coordinates[0]);
				plotll.lat=""+plotll.lat;
				plotll.lng=""+plotll.lng;
				var plotmark = new L.Marker(plotll);
				plotmark.data=plotlist.features[i];
				map.addLayer(plotmark);
				plotmark.bindPopup('<a href="' + plotlist.features[i].properties.url + '">' + plotlist.features[i].properties.nom + '</a>');
				plotlayers.push(plotmark);
			}
		}
	}
}

function removeMarkers() {
	for (i=0;i<plotlayers.length;i++) {
		map.removeLayer(plotlayers[i]);
	}
	plotlayers=[];
}

