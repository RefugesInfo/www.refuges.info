Dominique92.MyLeaflet
=====================

Leaflet extensions for
* Multi vendors maps &amp; projections:
```
- OSM, Maps.Refuges.Info
- ThunderForest Outdoors, Cycles, Landscape, Transport
- IGN France, cadastre, photos
- SwissTopo
- IDEE España, photos
- IGM Italie
- OS Great Britain
- Kompass Austria
- Bing Microsoft, photos
- Google maps, photos
```
* GeoJson ajax layers,
* Editable position marker with multi-projection position display,
* Markers, polylines & polygons editor.

DEMO
====
[See a DEMO here](https://dominique92.github.io/MyLeaflet/)

VERSION
=======
This master branch is now build on [Leaflet V1.0](http://leafletjs.com/).

You can find the old, not anymore supported, MyLeaflet V0.7 [here](https://github.com/Dominique92/MyLeaflet/tree/v0.7)

USAGE
=====
* Include MyLeaflet for production (compressed files):
```html
	<link  href="dist/leaflet.css" rel="stylesheet" />
	<script src="dist/leaflet.js"></script>
```
* Dist compressed files generation: run build/index.php
* For tinny distribution: only copy dist/... files

* Include MyLeaflet for developpement (full sources):
```html
	<link  href="src/leaflet.css" rel="stylesheet" />
	<script src="src/leaflet.js"></script>
```

FILES
=====
* /build/... : Files compression tool + github plugins update.
* /dist/... : Tinny distribution files.
* /lib/... : Local copy of some of github Leaflet kernel & pluggins files used in this library.
A CREDIT.txt file gives the github commit ref of each plugin.
* /src/... : Sources specific to MyLeaflet.
* /src/leaflet.css /src/leaflet.js : List of source files included in this package.
* /index.html : generic demo on a non PHP server.
* /index.php : generic demo on a PHP & MySql server.
* /examples/... : Demo files or ongoing developments.

Other Leaflet Plugins from this collection 
==========================================
* [Leaflet.GeoJSON.Ajax](https://github.com/Dominique92/Leaflet.GeoJSON.Ajax) remote GeoJSON & OSM overpass layers (Markers, Polylines, Polygons, ...).
* [Leaflet.Map.MultiVendors](https://github.com/Dominique92/Leaflet.Map.MultiVendors) multi vendors maps & projections.
* [Leaflet.Permalink.Cookies](https://github.com/Dominique92/Leaflet.Permalink.Cookies) keeping permalink in cookies.
* [Leaflet.Marker.coordinates](https://github.com/Dominique92/Leaflet.Marker.coordinates) display & edit a marker position.
* [Leaflet.draw.plus](https://github.com/Dominique92/Leaflet.draw.plus) on line markers, polylines & polygons editing.
