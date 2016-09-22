/*
 * Integrated by Dominique Cavailhez (c) 2016
 * https://github.com/Dominique92/MyLeaflet
 *
 * List .js files to be included in the MyLeaflet library.
 */

var js_list = [
// V1.0: https://github.com/Leaflet/Leaflet/tree/master
//	'../github.com/Leaflet/Leaflet/dist/leaflet-src.js', /* OPTIM LEAFLET KERNEL
	// Dans l'ordre de leaflet-src.js
	'../github.com/Leaflet/Leaflet/src/Leaflet.js',

	'../github.com/Leaflet/Leaflet/src/core/Util.js',
	'../github.com/Leaflet/Leaflet/src/core/Class.js',
	'../github.com/Leaflet/Leaflet/src/core/Events.js',
	'../github.com/Leaflet/Leaflet/src/core/Browser.js',

	'../github.com/Leaflet/Leaflet/src/geometry/Point.js',
	'../github.com/Leaflet/Leaflet/src/geometry/Bounds.js',
	'../github.com/Leaflet/Leaflet/src/geometry/Transformation.js',

	'../github.com/Leaflet/Leaflet/src/dom/DomUtil.js',

	'../github.com/Leaflet/Leaflet/src/geo/LatLng.js',
	'../github.com/Leaflet/Leaflet/src/geo/LatLngBounds.js',
	'../github.com/Leaflet/Leaflet/src/geo/projection/Projection.js',
	'../github.com/Leaflet/Leaflet/src/geo/projection/Projection.SphericalMercator.js',
	'../github.com/Leaflet/Leaflet/src/geo/projection/Projection.LonLat.js',

	'../github.com/Leaflet/Leaflet/src/geo/crs/CRS.js',
//	'../github.com/Leaflet/Leaflet/src/geo/crs/CRS.Simple.js', // Pour panoramas
//V1.0	'../github.com/Leaflet/Leaflet/src/geo/crs/CRS.Earth.js',
	'../github.com/Leaflet/Leaflet/src/geo/crs/CRS.EPSG3857.js',
	'../github.com/Leaflet/Leaflet/src/geo/crs/CRS.EPSG4326.js', // Utilisé par coordonnees

	'../github.com/Leaflet/Leaflet/src/map/Map.js',

//V1.0	'../github.com/Leaflet/Leaflet/src/layer/Layer.js',
//	'../github.com/Leaflet/Leaflet/src/geo/projection/Projection.Mercator.js', // wgs 84 / world mercator
//	'../github.com/Leaflet/Leaflet/src/geo/crs/CRS.EPSG3395.js', // wgs 84 / world mercator
//V1.0	'../github.com/Leaflet/Leaflet/src/layer/tile/GridLayer.js',
	'../github.com/Leaflet/Leaflet/src/layer/tile/TileLayer.js',
	'../github.com/Leaflet/Leaflet/src/layer/tile/TileLayer.WMS.js',
//	'../github.com/Leaflet/Leaflet/src/layer/tile/TileLayer.Canvas.js',

//	'../github.com/Leaflet/Leaflet/src/layer/ImageOverlay.js', // Pour draw
	'../github.com/Leaflet/Leaflet/src/layer/marker/Icon.js',
	'../github.com/Leaflet/Leaflet/src/layer/marker/Icon.Default.js',
	'../github.com/Leaflet/Leaflet/src/layer/marker/Marker.js',
	'../github.com/Leaflet/Leaflet/src/layer/marker/DivIcon.js', // Pour draw

	'../github.com/Leaflet/Leaflet/src/layer/marker/Marker.Popup.js', // Utilisé par draw
	'../github.com/Leaflet/Leaflet/src/layer/Popup.js',
//V1.0	'../github.com/Leaflet/Leaflet/src/layer/Layer.Popup.js',

	'../github.com/Leaflet/Leaflet/src/layer/LayerGroup.js',
	'../github.com/Leaflet/Leaflet/src/layer/FeatureGroup.js',
	'../github.com/Leaflet/Leaflet/src/layer/vector/Path.js',
	'../github.com/Leaflet/Leaflet/src/layer/vector/Path.SVG.js', // Nécéssaire pour poly* (massifs)
//	'../github.com/Leaflet/Leaflet/src/layer/vector/Path.Popup.js',
//	'../github.com/Leaflet/Leaflet/src/layer/vector/Path.VML.js',
//	'../github.com/Leaflet/Leaflet/src/layer/vector/canvas/Path.Canvas.js',
	'../github.com/Leaflet/Leaflet/src/geometry/LineUtil.js', // Dessine les Poly*
	'../github.com/Leaflet/Leaflet/src/layer/vector/Polyline.js', // Dessine les Poly*
	'../github.com/Leaflet/Leaflet/src/geometry/PolyUtil.js', // Dessine les Poly*
	'../github.com/Leaflet/Leaflet/src/layer/vector/Polygon.js', // Dessine les Poly*
	'../github.com/Leaflet/Leaflet/src/layer/vector/MultiPoly.js',
//	'../github.com/Leaflet/Leaflet/src/layer/vector/Rectangle.js',
	'../github.com/Leaflet/Leaflet/src/layer/vector/Circle.js', // Utilisé par GPS
	'../github.com/Leaflet/Leaflet/src/layer/vector/CircleMarker.js', // Utilisé par GPS
//	'../github.com/Leaflet/Leaflet/src/layer/vector/canvas/Polyline.Canvas.js', // Canvas fallback for vector rendering core (makes it work on Android 2+).
//	'../github.com/Leaflet/Leaflet/src/layer/vector/canvas/Polygon.Canvas.js',
//	'../github.com/Leaflet/Leaflet/src/layer/vector/canvas/Circle.Canvas.js',
//	'../github.com/Leaflet/Leaflet/src/layer/vector/canvas/CircleMarker.Canvas.js',
//V1.0	'../github.com/Leaflet/Leaflet/src/layer/vector/Renderer.js',
//V1.0	'../github.com/Leaflet/Leaflet/src/layer/vector/Path.js',

	'../github.com/Leaflet/Leaflet/src/layer/GeoJSON.js',
	'../github.com/Leaflet/Leaflet/src/dom/DomEvent.js',
	'../github.com/Leaflet/Leaflet/src/dom/Draggable.js',
	'../github.com/Leaflet/Leaflet/src/core/Handler.js',
	'../github.com/Leaflet/Leaflet/src/map/handler/Map.Drag.js', // Déplace la carte
//	'../github.com/Leaflet/Leaflet/src/map/handler/Map.DoubleClickZoom.js', // Non souhaité
	'../github.com/Leaflet/Leaflet/src/map/handler/Map.ScrollWheelZoom.js', // OUI. Zoom avec la roulette

//	'../github.com/Leaflet/Leaflet/src/dom/DomEvent.DoubleTap.js', // Non souhaité. Pour mobiles.
	'../github.com/Leaflet/Leaflet/src/dom/DomEvent.Pointer.js', // Touch support for Internet Explorer and Windows-based devices.
	'../github.com/Leaflet/Leaflet/src/map/handler/Map.TouchZoom.js', // OUI. Pinch zoom on supported mobile browsers.
//	'../github.com/Leaflet/Leaflet/src/map/handler/Map.Tap.js', // Non souhaité. Mobile hacks like quick taps and long hold.
//	'../github.com/Leaflet/Leaflet/src/map/handler/Map.BoxZoom.js', // Non souhaité. Shift-drag zoom interaction to the map (zoom to a selected bounding box)
//	'../github.com/Leaflet/Leaflet/src/map/handler/Map.Keyboard.js', // Non souhaité. Action des touches (mais pas escape full screen)
	'../github.com/Leaflet/Leaflet/src/layer/marker/Marker.Drag.js', // Utilisé par draw

//V1.0	'../github.com/Leaflet/Leaflet/src/layer/vector/SVG.js', // Dessine les Poly*
//V1.0	'../github.com/Leaflet/Leaflet/src/layer/vector/SVG.VML.js',
//V1.0	'../github.com/Leaflet/Leaflet/src/layer/vector/Canvas.js',

	'../github.com/Leaflet/Leaflet/src/control/Control.js',
	'../github.com/Leaflet/Leaflet/src/control/Control.Zoom.js', // Default zoom buttons on the map.
	'../github.com/Leaflet/Leaflet/src/control/Control.Attribution.js',
	'../github.com/Leaflet/Leaflet/src/control/Control.Scale.js',
	'../github.com/Leaflet/Leaflet/src/control/Control.Layers.js',
	'../src/Leaflet.Control.Layers.overflow.js',

	'../github.com/Leaflet/Leaflet/src/dom/PosAnimation.js', // Pour Map.PanAnimation.js
	'../github.com/Leaflet/Leaflet/src/map/anim/Map.PanAnimation.js', // Nécéssaire pour zoom animé
//	'../github.com/Leaflet/Leaflet/src/dom/PosAnimation.Timer.js',
	'../github.com/Leaflet/Leaflet/src/map/anim/Map.ZoomAnimation.js', // Zoom lent
	'../github.com/Leaflet/Leaflet/src/layer/tile/TileLayer.Anim.js',
//V1.0	'../github.com/Leaflet/Leaflet/src/map/anim/Map.FlyTo.js',

	'../github.com/Leaflet/Leaflet/src/map/ext/Map.Geolocation.js', // Nécéssaire pour GPS
/* FIN OPTIM LEAFLET KERNEL */

	'../src/lib/Leaflet-optim-stub.js', // Remplace certaines définitions de fonctions mamquantes suite aux optimisations

	// Controles
	'../github.com/Leaflet/Leaflet.fullscreen/dist/Leaflet.fullscreen.js', //V1.0 testé OK
	'../github.com/rowanwins/leaflet-easyPrint/dist/leaflet.easyPrint.js', //V1.0 ?? à tester
	'../github.com/MrMufflon/Leaflet.Coordinates/src/util/NumberFormatter.js', // Pour Coordinates
	'../github.com/MrMufflon/Leaflet.Coordinates/src/Control.Coordinates.js', //V1.0 testé OK
	'../github.com/stefanocudini/leaflet-gps/src/leaflet-gps.js', //work with Leaflet 1.0 beta
	'../github.com/k4r573n/leaflet-control-osm-geocoder/Control.OSMGeocoder.js', //V1.0 testé OK
	'../github.com/shramov/leaflet-plugins/control/Permalink.js', //V1.0 https://github.com/shramov/leaflet-plugins/tree/leaflet_one
	'../github.com/shramov/leaflet-plugins/control/Permalink.Layer.js', //V1.0 idem
	'../github.com/Dominique92/Leaflet.Permalink.Cookies/Permalink.Cookies.js',
	'../src/Leaflet.Control.Layers.args.js',
	'../src/AntiBot.js',

	// CRS exotiques
//	'../github.com/proj4js/proj4js/dist/proj4-src.js', // FULL
	'../src/lib/proj4-OPTIM.js', // OPTIM
//V1.0: https://github.com/kartena/Proj4Leaflet/tree/leaflet-proj-refactor
//	'../github.com/kartena/Proj4Leaflet/lib/proj4.js', // Ne marche pas (contient define...)
	'../github.com/kartena/Proj4Leaflet/src/proj4leaflet.js', // 6k
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/MapMultiCRS.js',
	'../github.com/tyrasd/togpx/togpx.js', // Converts GeoJSON to GPX.
	'../github.com/Dominique92/Leaflet.Marker.coordinates/CRS.js',
	'../github.com/Dominique92/Leaflet.Marker.coordinates/Marker.coordinates.js',

	// Couches autres fournisseurs
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/OSM.js',
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/IGN.js',
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/IGM.js',
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/IDEE.js',
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/SwissTopo.js',
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/Google.js',
	'../github.com/rob-murray/os-leaflet/OSOpenSpace.js', // V0.7 
// V1.0	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/OS.js', 
// V1.0 (rob-murray/os-leaflet-1.0-beta/src/OSOpenSpace.js KO)
	'../github.com/shramov/leaflet-plugins/layer/tile/Bing.js',// V1.0: leaflet_one
	'../github.com/Dominique92/Leaflet.Map.MultiVendors/layers/TileLayer.collection.js',

	// Couches vectotielles
	'../github.com/mapbox/togeojson/togeojson.js', //V1.0 ??
	'../github.com/makinacorpus/Leaflet.FileLayer/src/leaflet.filelayer.js', //V1.0 ??
//	'../github.com/mapbox/leaflet-omnivore/leaflet-omnivore.js', // TBD KML/ ...
	'../github.com/erictheise/rrose/leaflet.rrose-src.js', //V1.0 ??
	'../github.com/Dominique92/Leaflet.GeoJSON.Ajax/GeoJSON.Style.js',
	'../github.com/Dominique92/Leaflet.GeoJSON.Ajax/GeoJSON.Ajax.js',
	'../github.com/Dominique92/Leaflet.GeoJSON.Ajax/layers/GeoJSON.Ajax.OSM.js',
// INSERER SUR DEMANDE	'../github.com/Dominique92/Leaflet.GeoJSON.Ajax/layers/GeoJSON.Ajax.WRI.js',

	// Editeur
// V1.0: https://github.com/Leaflet/Leaflet.draw/tree/leaflet-master
//	'../github.com/Leaflet/Leaflet.draw/dist/leaflet.draw-src.js', /* OPTIM DRAW
//	'../github.com/Leaflet/Leaflet.draw/src/Leaflet.draw.js',

	'../github.com/Leaflet/Leaflet.draw/src/Toolbar.js',
	'../github.com/Leaflet/Leaflet.draw/src/Tooltip.js',
//	'../github.com/Leaflet/Leaflet.draw/src/ext/GeometryUtil.js',
	'../github.com/Leaflet/Leaflet.draw/src/ext/TouchEvents.js',
	'../github.com/Leaflet/Leaflet.draw/src/ext/LatLngUtil.js',
	'../github.com/Leaflet/Leaflet.draw/src/ext/LineUtil.Intersect.js',
	'../github.com/Leaflet/Leaflet.draw/src/ext/Polygon.Intersect.js', // Nécéssaire pour éditer les polygones
	'../github.com/Leaflet/Leaflet.draw/src/ext/Polyline.Intersect.js', // Nécéssaire pour merger les lignes

	'../github.com/Leaflet/Leaflet.draw/src/draw/DrawToolbar.js',
	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.Feature.js',
//	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.SimpleShape.js',
	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.Polyline.js',
//	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.Circle.js',
	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.Marker.js',
	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.Polygon.js',
//	'../github.com/Leaflet/Leaflet.draw/src/draw/handler/Draw.Rectangle.js',

	'../github.com/Leaflet/Leaflet.draw/src/edit/EditToolbar.js',
	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/EditToolbar.Edit.js',
	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/EditToolbar.Delete.js',

	'../github.com/Leaflet/Leaflet.draw/src/Control.Draw.js',

	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/Edit.Poly.js',
//	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/Edit.SimpleShape.js',
//	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/Edit.Circle.js',
//	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/Edit.Rectangle.js',
	'../github.com/Leaflet/Leaflet.draw/src/edit/handler/Edit.Marker.js',
/* FIN OPTIM DRAW */

	'../src/lib/Leaflet-optim-stub-draw.js', // Remplace certaines définitions de fonctions mamquantes suite aux optimisations

	'../github.com/makinacorpus/Leaflet.GeometryUtil/src/leaflet.geometryutil.js', // A mettre sinon snap plante.
	'../github.com/makinacorpus/Leaflet.Snap/leaflet.snap.js', // Incompatible V1.0

	'../github.com/Dominique92/Leaflet.draw.plus/Control.Draw.Plus.js',
	'../src/Leaflet.Control.Click.js',

	// Adaptations
	'../src/locales.fr.js',
];
/* php libs - pour import du github mais à ne pas insérer dans le .js
	'../github.com/tubalmartin/YUI-CSS-compressor-PHP-port/', // Build: compresse css
	'../github.com/nicolas-grekas/JSqueeze/', // Build: compresse js
*/

var scripts = document.getElementsByTagName('script'),
	script = scripts[scripts.length - 1].src,
	racineSources = script.substring(0, script.lastIndexOf('/')) + '/';

for (j in js_list)
		document.write('<script src="' + racineSources + js_list[j] + '"></script>');
