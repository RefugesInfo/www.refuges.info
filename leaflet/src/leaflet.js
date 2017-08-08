/*
 * Integrated by Dominique Cavailhez (c) 2016
 * https://github.com/Dominique92/MyLeaflet
 *
 * List of .js files to be included in the MyLeaflet library.
 */

var deps = [
	// Kernel leaflet
	'../node_modules/leaflet/dist/leaflet-src.js',

	// Controls
	'../node_modules/leaflet.coordinates/src/util/NumberFormatter.js',
	'../node_modules/leaflet.coordinates/src/Control.Coordinates.js',

	'../node_modules/leaflet-plugins/control/Permalink.js',
	'../node_modules/leaflet-plugins/control/Permalink.Layer.js',
	'../src/Permalink.Cookies.js',
	
	'../node_modules/leaflet-fullscreen/dist/Leaflet.fullscreen.js',
	'../node_modules/leaflet-control-osm-geocoder/Control.OSMGeocoder.js',
	'../node_modules/leaflet-gps/dist/leaflet-gps.src.js',

	'../node_modules/togeojson/togeojson.js',
	'../node_modules/leaflet-filelayer/leaflet.filelayer.js',
	'../src/Control.Click.js',

	'../node_modules/leaflet-easyprint/dist/leaflet.easyPrint.js',

	// Couches autres fournisseurs
	'../src/Leaflet.Map.MultiVendors/src/layers/OSM.js',
	'../src/Leaflet.Map.MultiVendors/src/layers/IGN.js',
	'../src/Leaflet.Map.MultiVendors/src/layers/IGM.js',
	'../src/Leaflet.Map.MultiVendors/src/layers/IDEE.js',
	'../src/Leaflet.Map.MultiVendors/src/layers/Google.js',

	// CRS exotiques
	'../node_modules/proj4/dist/proj4-src.js',
	'../node_modules/proj4leaflet/src/proj4leaflet.js',
	'../src/Leaflet.Map.MultiVendors/src/MapMultiCRS.js',
	'../src/Leaflet.Map.MultiVendors/src/layers/SwissTopo.js',
	'../node_modules/os-leaflet/OSOpenSpace.js',
	'../node_modules/leaflet-plugins/layer/tile/Bing.js',
	'../src/Leaflet.Map.MultiVendors/src/layers/TileLayer.collection.js',

	// Couches vectotielles
	'../node_modules/rrose/leaflet.rrose-src.js',
	'../src/Leaflet.GeoJSON.Ajax/src/GeoJSON.Style.js',
	'../src/Leaflet.GeoJSON.Ajax/src/GeoJSON.Ajax.js',
	'../src/Leaflet.GeoJSON.Ajax/src/Control.Layers.argsGeoJSON.js', // Define a second control layer for overlays arguments selection
	'../src/Leaflet.GeoJSON.Ajax/src/layers/GeoJSON.Ajax.OSM.js', // Specific layer for OSM POI
// INSERER SUR DEMANDE	'../src/Leaflet.GeoJSON.Ajax/layers/GeoJSON.Ajax.WRI.js',
//	'../leaflet-omnivore-master/leaflet-omnivore.js', // TODO KML/ ...

//	'../togpx-master/togpx.js', // Converts GeoJSON to GPX.
	'../src/Leaflet.Marker.coordinates/src/CRS.js',
	'../src/Leaflet.Marker.coordinates/src/Marker.coordinates.js',

	// Draw for leaflet
	'../node_modules/leaflet-draw/dist/leaflet.draw-src.js',
	'../node_modules/leaflet-geometryutil/src/leaflet.geometryutil.js', // A mettre sinon snap plante.
	'../node_modules/leaflet-snap/leaflet.snap.js',
	'../src/Leaflet.draw.plus/src/Control.Draw.Plus.js',

	'../src/Control.Layers.remanent.js', // Keep the layer selector open until we leave the map
	'../src/locales.fr.js', // Adaptations
	'../src/patches.js', // Plugin's patches
	'../src/AntiBot.js', // Frezze map on pages called by bots
];

var scripts = document.getElementsByTagName('script'),
	script = scripts[scripts.length - 1].src,
	racineSources = script.substring(0, script.lastIndexOf('/')) + '/';

for (j in deps)
		document.write('<script src="' + racineSources + deps[j] + '"></script>');
