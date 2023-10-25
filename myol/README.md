Dominique92.myol
================
* This package adds many features to [openlayer maps](https://openlayers.org/)
* It is deployed on [refuges.info](https://www.refuges.info), [chemineur.fr](https://chemineur.fr) & [alpages.info](https://alpages.info)


INSTALL & BUILD
===============
Requires [node.js](https://nodejs.org/) to be installed

* Download the [full code & tools](https://github.com/Dominique92/).


* Go to the myol repository :
```
cd ./myol
```
* Install the required node_modules :
```
npm install
```
* Build the package & generate ./dist/* files :
```
npm run build
```

Simple example
==============
This [Example demo](https://Dominique92.github.io/myol/) implements a single map with the most current maps layers providers.
* You can download the [DISTRIBUTION ZIPPED PACKAGE](https://github.com/Dominique92/dev/archive/refs/heads/master.zip) and unzip it in your website FTP section.
* You can include the css & js sections of this example on your own page (adjust the include files path to your implementation)

Layer Switcher
==============
See a [Layer Switcher demo](https://Dominique92.github.io/myol/examples/layerSwitcher.html)

Tile layers
===========
See a [Tile layers demo](https://Dominique92.github.io/myol/examples/layerTile.html)
* OSM, OSM-FR, OpenTopo, CyclOsm, Maps.Refuges.Info
* ThunderForest Outdoors, OpenTopoMap, Cycles, Landscape, Transport, ...
* IGN France, cadastre, satellite, ...
* SwissTopo, satellite
* IDEE España, satellite
* IGM Italie
* Ordnance Survey (Great Britain)
* Kompass Austria
* Bing Microsoft, satellite
* Google maps, satellite

Vector layers
=============
See a [Vector layer demo](https://Dominique92.github.io/myol/examples/layerVector.html)
* GeoJson ajax layers,
* OverPass (OSM vector points of interest)

Misc controls
=============
See a [Control demo](https://Dominique92.github.io/myol/examples/controls.html)
* Keep position, zoom & zoom on localStorage
* Geocoder
* Line length display
* GPX upload & download
* Off connexion GPS
* Print map

Marker display & edit
=====================
See a [Marker demo](https://Dominique92.github.io/myol/examples/marker.html)
* Editable position marker with multi-projection position display,

Lines & Polygons editor
=======================
See an [Editor demo](https://Dominique92.github.io/myol/examples/editor.html)
* Polylines & polygons editor.

Off line GPS
============
See an [Off line GPS demo](https://Dominique92.github.io/myol/gps)
* Browser -> options -> add to the home screen
* Choose a map layer
* Place yourself at the starting point of your hike
* Zoom to the most detailed level you want to memorize
* Switch to full screen mode (also memorize the higher scales)
* Move along the path of your hike slowly enough to load all tiles
* Repeat with the layers of cards you want to memorize
* Go to the field and click on the "My GPS" icon
* If you have a .gpx file in your mobile, view it by clicking on ⇑
* All tiles viewed once will be kept in the explorer's cache for a few days
* This application does not record your track
* Works well on Android with Chrome, Edge & Samsung Internet, a little less well with Firefox & Safari

Layers keys
===========
If you want to use external providers layers, you must acquire free keys and replace them in the html (see source comment)
* French IGN : Get your own (free) IGN key at [https://geoservices.ign.fr/](https://geoservices.ign.fr/)
* OSM thunderforest : Get your own (free) THUNDERFOREST key at [https://manage.thunderforest.com](https://manage.thunderforest.com)
* Microsoft BING : Get your own (free) BING key at [https://www.microsoft.com](https://www.microsoft.com/en-us/maps/create-a-bing-maps-key)

Architecture
============
Just include myol.js & myos.css after ol/dist, proj4js & geocoder's js & css.
* See this [example](https://Dominique92.github.io/myol/examples/index.html)
* Code & all tiled layers use EPSG:3857 spherical mercator projection

The coding rules are volontary simple & don't follow all openlayers's
* No JS classes, no jquery, no es6 modules, no nodejs build, no minification, no npm repository, ...
* Each adaptation is included in a single JS function that you can include separately (check dependencies if any)
* Feel free to use, modify & share as you want

Files
=====
* myol.css : full CSS distribution
* myol.js : full JS distribution
* src/... : Source files
* ol/... : Openlayer V6.0.1 (you can use any of openlayers V5.* or V6.*) from [Openlayers](https://openlayers.org/download/)
* geocoder/... : Geocoder V4.0.0 from [Openlayers geocoder](https://github.com/jonataswalker/ol-geocoder/releases/latest)
* proj4/... : Coordinate transformation software proj4js V2.5.0 from [Proj4](https://github.com/proj4js/proj4js/releases/latest)
* examples/... : Demos & visual tests
* gps/... : Off line demo with GPS capabilities

Tested on
=========
* windows 10 : Edge, FireFox, Chrome, Opera, Brave
* Android (Samsung) : Samsung Internet, FireFox, Chrome, Brave, DuckDuckGo
* Linux : FireFox
* NO SUPPORT ON Microsoft Internet Explorer
