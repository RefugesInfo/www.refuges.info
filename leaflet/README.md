Dominique92.MyLeaflet
=====================

Leaflet extensions for
* multi vendors maps &amp; projections:
```
- IGN France
- SwissTopo
- IDEE España
- IGM Italie
- OS Great Britain
- Kompass Austria
- Libres: OSM, Maps.Refuges.Info, Thunder Forest, Hike & Bike, ClycleMap, Outdoors & Bike, ClycleMap, 
- Bing Microsoft
- Google maps
```
* GeoJson ajax layers,
* Editable position marker with multi-projection position display,
* Markers, polylines & polugons editor.

DEMO
====
[See a DEMO](http://dominique92.github.io/MyLeaflet/)

USAGE
=====
* Include MyLeaflet for production (compressed files):
```html
	<link rel="stylesheet" href="dist/leaflet.css" />
	<script src="dist/leaflet.js"></script>
```

* Include MyLeaflet for developpement (full sources):
```html
	<link rel="stylesheet" href="src/leaflet.css" />
	<script src="src/leaflet.js"></script>
```

* Compressed files generation: run build/index.php

* Tinny distribution: only copy dist/... files

FILES
=====
* /build/... : Files compression tool + github plugins update.
* /dist/... : Tinny distribution files.
* /github.com/... : Local copy of some of github Leaflet kernel or pluggins files used in this library.
A CREDIT.txt file gives the github commit ref of each plugin.
Some very few sources modifications are taged "GEO", "GEO optimisation" or "GEOmin".
* /libs/... : Other extern libraries
* /src/... : Other specific sources.
* /src/leaflet.css /src/leaflet.js : List of source files, to be included for debug.
* /examples/... : Extern demos.
* /test/... : Debug test files or ongoing developments.
* /index.php : Demo.
