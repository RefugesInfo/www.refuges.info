/*
 * Integrated by Dominique Cavailhez (c) 2016
 * https://github.com/Dominique92/MyLeaflet
 *
 * List .js files to be included in the MyLeaflet library.
 */

var deps = [
/* KERNEL LEAFLET */
	// From build/deps.js
	// Paths relative to this file

	// Core : The core of the library, including OOP, events, DOM facilities, basic units, projections (EPSG:3857 and EPSG:4326) and the base Map class.
	'../lib/Leaflet-1.0.3/src/Leaflet.js',

	'../lib/Leaflet-1.0.3/src/core/Util.js',
	'../lib/Leaflet-1.0.3/src/core/Class.js',
	'../lib/Leaflet-1.0.3/src/core/Events.js',
	'../lib/Leaflet-1.0.3/src/core/Browser.js',

	'../lib/Leaflet-1.0.3/src/geometry/Point.js',
	'../lib/Leaflet-1.0.3/src/geometry/Bounds.js',
	'../lib/Leaflet-1.0.3/src/geometry/Transformation.js',

	'../lib/Leaflet-1.0.3/src/dom/DomUtil.js',

	'../lib/Leaflet-1.0.3/src/geo/LatLng.js',
	'../lib/Leaflet-1.0.3/src/geo/LatLngBounds.js',
	'../lib/Leaflet-1.0.3/src/geo/projection/Projection.LonLat.js',
	'../lib/Leaflet-1.0.3/src/geo/projection/Projection.SphericalMercator.js',
	'../lib/Leaflet-1.0.3/src/geo/crs/CRS.js',
//	'../lib/Leaflet-1.0.3/src/geo/crs/CRS.Simple.js', // Pour panoramas
	'../lib/Leaflet-1.0.3/src/geo/crs/CRS.Earth.js',
	'../lib/Leaflet-1.0.3/src/geo/crs/CRS.EPSG3857.js',
	'../lib/Leaflet-1.0.3/src/geo/crs/CRS.EPSG4326.js', // Pour marker.coordinate

	'../lib/Leaflet-1.0.3/src/map/Map.js',
	'../lib/Leaflet-1.0.3/src/layer/Layer.js',

	'../lib/Leaflet-1.0.3/src/dom/DomEvent.js', // For Draggable.js

	'../lib/Leaflet-1.0.3/src/dom/PosAnimation.js', // Pour Map.PanAnimation.js // Zoom animé / utilisé par GPS

	// EPSG:3395 projection (used by some map providers).
//	'../lib/Leaflet-1.0.3/src/geo/projection/Projection.Mercator.js', // wgs 84 / world mercator
//	'../lib/Leaflet-1.0.3/src/geo/crs/CRS.EPSG3395.js', // wgs 84 / world mercator

	'../lib/Leaflet-1.0.3/src/layer/tile/GridLayer.js', // Used as base class for grid-like layers like TileLayer.
	'../lib/Leaflet-1.0.3/src/layer/tile/TileLayer.js', // The base class for displaying tile layers on the map.
	'../lib/Leaflet-1.0.3/src/layer/tile/TileLayer.WMS.js', // WMS tile layer.
//	'../lib/Leaflet-1.0.3/src/layer/ImageOverlay.js', // Used to display an image over a particular rectangular area of the map.

	// Markers to put on the map.
	'../lib/Leaflet-1.0.3/src/layer/marker/Icon.js',
	'../lib/Leaflet-1.0.3/src/layer/marker/Icon.Default.js',
	'../lib/Leaflet-1.0.3/src/layer/marker/Marker.js',

	// Lightweight div-based icon for markers.
	'../lib/Leaflet-1.0.3/src/layer/marker/DivIcon.js', // Pour draw ???

	// Used to display the map popup (used mostly for binding HTML data to markers and paths on click).
	'../lib/Leaflet-1.0.3/src/layer/DivOverlay.js',
	'../lib/Leaflet-1.0.3/src/layer/Popup.js',

	'../lib/Leaflet-1.0.3/src/layer/Tooltip.js', // Used to display the map tooltip (used mostly for binding short descriptions to markers and paths on mouseover).
	'../lib/Leaflet-1.0.3/src/layer/LayerGroup.js', // Allows grouping several layers to handle them as one.
	'../lib/Leaflet-1.0.3/src/layer/FeatureGroup.js', // Extends LayerGroup with mouse events and bindPopup method shared between layers.

	// Vector rendering core.
	'../lib/Leaflet-1.0.3/src/layer/vector/Renderer.js',
	'../lib/Leaflet-1.0.3/src/layer/vector/Path.js',
	'../lib/Leaflet-1.0.3/src/geometry/LineUtil.js',
	'../lib/Leaflet-1.0.3/src/layer/vector/Polyline.js',
	'../lib/Leaflet-1.0.3/src/geometry/PolyUtil.js',
	'../lib/Leaflet-1.0.3/src/layer/vector/Polygon.js',
//	'../lib/Leaflet-1.0.3/src/layer/vector/Rectangle.js',
	'../lib/Leaflet-1.0.3/src/layer/vector/CircleMarker.js', // Utilisé par GPS // Circle overlays with a constant pixel radius.
	'../lib/Leaflet-1.0.3/src/layer/vector/Circle.js', // Utilisé par GPS // Circle overlays (with radius in meters).

	'../src/stubs-geom.js', // Stubs for optimized geometries

	'../lib/Leaflet-1.0.3/src/layer/vector/SVG.js', // Dessine les Poly* // SVG backend for vector layers.
//	'../lib/Leaflet-1.0.3/src/layer/vector/SVG.VML.js', // VML fallback for vector layers in IE7-8.
//	'../lib/Leaflet-1.0.3/src/layer/vector/Canvas.js', // Canvas backend for vector layers.

	'../lib/Leaflet-1.0.3/src/layer/GeoJSON.js', // GeoJSON layer, parses the data and adds corresponding layers above.

	// Makes the map draggable (by mouse or touch).
	'../lib/Leaflet-1.0.3/src/dom/Draggable.js',
	'../lib/Leaflet-1.0.3/src/core/Handler.js',
	'../lib/Leaflet-1.0.3/src/map/handler/Map.Drag.js', // Déplace la carte

	// Scroll wheel zoom and double click zoom on the map.
//	'../lib/Leaflet-1.0.3/src/map/handler/Map.DoubleClickZoom.js', // Non souhaité
	'../lib/Leaflet-1.0.3/src/map/handler/Map.ScrollWheelZoom.js', // OUI. Zoom avec la roulette

//	'../lib/Leaflet-1.0.3/src/dom/DomEvent.DoubleTap.js', // Enables smooth touch zoom / tap / longhold / doubletap on iOS, IE10, Android.
	'../lib/Leaflet-1.0.3/src/dom/DomEvent.Pointer.js', // Touch support for Internet Explorer and Windows-based devices.
	'../lib/Leaflet-1.0.3/src/map/handler/Map.TouchZoom.js', // OUI. Pinch zoom on supported mobile browsers.
//	'../lib/Leaflet-1.0.3/src/map/handler/Map.Tap.js', // Non souhaité. Mobile hacks like quick taps and long hold.

	// Enables zooming to bounding box by shift-dragging the map.
//	'../lib/Leaflet-1.0.3/src/map/handler/Map.BoxZoom.js', // Shift-drag zoom interaction to the map (zoom to a selected bounding box)

//	'../lib/Leaflet-1.0.3/src/map/handler/Map.Keyboard.js', // Enables keyboard pan/zoom when the map is focused. (but not escape full screen)

	// Makes markers draggable (by mouse or touch).
	'../lib/Leaflet-1.0.3/src/layer/marker/Marker.Drag.js', // A voir pour viseur et éditeur ???

	// Controls.
	'../lib/Leaflet-1.0.3/src/control/Control.js',
	'../lib/Leaflet-1.0.3/src/control/Control.Zoom.js', // Default zoom buttons on the map.
	'../lib/Leaflet-1.0.3/src/control/Control.Attribution.js',
	'../lib/Leaflet-1.0.3/src/control/Control.Scale.js',
	'../lib/Leaflet-1.0.3/src/control/Control.Layers.js',	// Layer Switcher control.
/* END OPTIM LEAFLET KERNEL */

	// Couches autres fournisseurs
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/OSM.js',
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/IGN.js',
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/IGM.js',
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/IDEE.js',
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/Google.js',

	// CRS exotiques
//	'../lib/proj4js-master/dist/proj4-src.js', // FULL
	'../src/proj4-OPTIM.js', // DCMM TODO OPTIM: construire automatiquement !
//	'../lib/Proj4Leaflet-master/lib/proj4.js', // Ne marche pas (contient define...)
	'../lib/Proj4Leaflet-master/src/proj4leaflet.js', // V1.0
	'../lib/Leaflet.Map.MultiVendors-master/src/MapMultiCRS.js',
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/SwissTopo.js',
	'../lib/os-leaflet-master/OSOpenSpace.js',
	'../lib/leaflet-plugins-master/layer/tile/Bing.js',
	'../lib/Leaflet.Map.MultiVendors-master/src/layers/TileLayer.collection.js',

	// Controls
	'../lib/leaflet-plugins-master/control/Permalink.js',
	'../lib/leaflet-plugins-master/control/Permalink.Layer.js',
	'../lib/Leaflet.Permalink.Cookies-master/src/Permalink.Cookies.js',
	
	'../lib/Leaflet.Coordinates-master/src/util/NumberFormatter.js',
	'../lib/Leaflet.Coordinates-master/src/Control.Coordinates.js',

	'../lib/Leaflet.fullscreen-gh-pages/dist/Leaflet.fullscreen.js',
	'../lib/leaflet-gps-master/src/leaflet-gps.js',
	'../lib/leaflet-control-osm-geocoder-master/Control.OSMGeocoder.js',

	'../lib/togeojson-master/togeojson.js',
	'../lib/Leaflet.FileLayer-master/src/leaflet.filelayer.js',
	'../src/Control.Click.js',

	'../lib/leaflet-easyPrint-gh-pages/dist/leaflet.easyPrint.js',

	// Couches vectotielles
	'../lib/rrose-master/leaflet.rrose-src.js',
	'../lib/Leaflet.GeoJSON.Ajax-master/src/GeoJSON.Style.js',
	'../lib/Leaflet.GeoJSON.Ajax-master/src/GeoJSON.Ajax.js',
	'../lib/Leaflet.GeoJSON.Ajax-master/src/Control.Layers.argsGeoJSON.js', // Define a second control layer for overlays arguments selection
	'../lib/Leaflet.GeoJSON.Ajax-master/src/layers/GeoJSON.Ajax.OSM.js', // Specific layer for 
// INSERER SUR DEMANDE	'../lib/Leaflet.GeoJSON.Ajax-master/layers/GeoJSON.Ajax.WRI.js',
//	'../lib/leaflet-omnivore-master/leaflet-omnivore.js', // TODO KML/ ...

//	'../lib/togpx-master/togpx.js', // Converts GeoJSON to GPX.
	'../lib/Leaflet.Marker.coordinates-master/src/CRS.js',
	'../lib/Leaflet.Marker.coordinates-master/src/Marker.coordinates.js',

/* DRAW FOR LEAFLET */
	// The core of the plugin. Currently only includes the version.
	'../lib/Leaflet.draw-master/src/Leaflet.draw.js',
	'../lib/Leaflet.draw-master/src/Leaflet.Draw.Event.js',

	// Drawing handlers for: polylines, polygons, rectangles, circles and markers.
	'../lib/Leaflet.draw-master/src/draw/handler/Draw.Feature.js',
	'../lib/Leaflet.draw-master/src/draw/handler/Draw.Polyline.js',
	'../lib/Leaflet.draw-master/src/draw/handler/Draw.Polygon.js',
//	'../lib/Leaflet.draw-master/src/draw/handler/Draw.SimpleShape.js',
//	'../lib/Leaflet.draw-master/src/draw/handler/Draw.Rectangle.js',
//	'../lib/Leaflet.draw-master/src/draw/handler/Draw.Circle.js',
	'../lib/Leaflet.draw-master/src/draw/handler/Draw.Marker.js',

	// Editing handlers for: polylines, polygons, rectangles, and circles.
//	'../lib/Leaflet.draw-master/src/edit/handler/Edit.Marker.js',
	'../lib/Leaflet.draw-master/src/edit/handler/Edit.Poly.js',
//	'../lib/Leaflet.draw-master/src/edit/handler/Edit.SimpleShape.js',
//	'../lib/Leaflet.draw-master/src/edit/handler/Edit.Rectangle.js',
//	'../lib/Leaflet.draw-master/src/edit/handler/Edit.Circle.js',

	// Extensions of leaflet classes.
	'../lib/Leaflet.draw-master/src/ext/TouchEvents.js', // Pour draw+ optim poly
	'../lib/Leaflet.draw-master/src/ext/LatLngUtil.js',
	'../lib/Leaflet.draw-master/src/ext/GeometryUtil.js',
	'../lib/Leaflet.draw-master/src/ext/LineUtil.Intersect.js',
	'../lib/Leaflet.draw-master/src/ext/Polyline.Intersect.js', // Nécéssaire pour merger les lignes
//	'../lib/Leaflet.draw-master/src/ext/Polygon.Intersect.js',

	// Common UI components used.
	'../lib/Leaflet.draw-master/src/Control.Draw.js',
	'../lib/Leaflet.draw-master/src/Toolbar.js',
	'../lib/Leaflet.draw-master/src/Tooltip.js',

	// Draw toolbar.
	'../lib/Leaflet.draw-master/src/draw/DrawToolbar.js',

	// Edit toolbar.
	'../lib/Leaflet.draw-master/src/edit/EditToolbar.js',
	'../lib/Leaflet.draw-master/src/edit/handler/EditToolbar.Edit.js',
	'../lib/Leaflet.draw-master/src/edit/handler/EditToolbar.Delete.js',

	'../src/stubs-draw.js', // Stubs for optimized geometries
/* END DRAW */

	// SNAP
	'../lib/Leaflet.GeometryUtil-master/src/leaflet.geometryutil.js', // A mettre sinon snap plante.
	'../lib/Leaflet.Snap-master/leaflet.snap.js',

	'../lib/Leaflet.draw.plus-master/src/Control.Draw.Plus.js',

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
