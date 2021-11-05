DC92.MyOl
================
* This package adds many features to [openlayer maps](https://openlayers.org/)
* It is deployed on [refuges.info](https://www.refuges.info), [chemineur.fr](https://chemineur.fr) & [alpages.info](https://alpages.info)

SIMPLE EXAMPLE
==============
This [EXAMPLE DEMO](https://DC92.github.io/dev/assets/MyOl/) implements a single map with the most current maps layers providers.
* You can download the [DISTRIBUTION ZIPPED PACKAGE](https://github.com/DC92/dev/archive/refs/heads/master.zip) and unzip it in your website FTP section.
* You can include the css & js sections of this example on your own page (adjust the include files path to your implementation)

LAYER SWITCHER
==============
See a LAYER SWITCHER DEMO [here](https://DC92.github.io/dev/assets/MyOl/examples/layerSwitcher.html)

TILE LAYERS
===========
See a TILE LAYERS DEMO [here](https://DC92.github.io/dev/assets/MyOl/examples/layerTile.html)
* OSM, OSM-FR, OpenTopo, Maps.Refuges.Info
* ThunderForest Outdoors, OpenTopoMap, Cycles, Landscape, Transport, ...
* IGN France, cadastre, satellite, ...
* SwissTopo, satellite
* IDEE España, satellite
* IGM Italie
* Great Britain
* Kompass Austria
* Bing Microsoft, satellite
* Google maps, satellite

VECTOR LAYERS
=============
See a VECTOR LAYER DEMO [here](https://DC92.github.io/dev/assets/MyOl/examples/layerVector.html)
* GeoJson ajax layers,
* OverPass (OSM vector points of interest)

MISC CONTROLS
=============
See a CONTROL DEMO [here](https://DC92.github.io/dev/assets/MyOl/examples/controls.html)
* Keep position, zoom & zoom on cookies
* Geocoder
* Line length display
* GPX upload & download
* Off connexion GPS
* Print map

MARKER DISPLAY & EDIT
=====================
See a MARKER DEMO [here](https://DC92.github.io/dev/assets/MyOl/examples/marker.html)
* Editable position marker with multi-projection position display,

LINES & POLYGONS EDITOR
=======================
See an EDITOR DEMO [here](https://DC92.github.io/dev/assets/MyOl/examples/editor.html)
* Polylines & polygons editor.

OFF LINE GPS
============
See an OFF LINE GPS DEMO [here](https://DC92.github.io/dev/assets/MyOl/gps)
* Open this url : [DC92.github.io/dev/assets/MyOl/gps](https://DC92.github.io/dev/assets/MyOl/gps/)
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
* Not tested on iOs

LAYERS KEYS
===========
If you want to use external providers layers, you must acquire free keys and replace them in the html (see source comment)
* French IGN : Get your own (free) IGN key at [https://professionnels.ign.fr](https://professionnels.ign.fr/ign/contrats)
* OSM thunderforest : Get your own (free) THUNDERFOREST key at [https://manage.thunderforest.com](https://manage.thunderforest.com)
* Microsoft BING : Get your own (free) BING key at [https://www.microsoft.com](https://www.microsoft.com/en-us/maps/create-a-bing-maps-key)

ARCHITECTURE
============
Just include myol.js & myos.css after ol/dist, proj4js & geocoder's js & css.
* See [index.html](https://raw.githubusercontent.com/DC92/dev/master/assets/MyOl/index.html) for example
* Code & all tiled layers use EPSG:3857 spherical mercator projection

The coding rules are volontary simple & don't follow all openlayers's
* No JS classes, no jquery, no es6 modules, no nodejs build, no minification, no npm repository, ...
* Each adaptation is included in a single JS function that you can include separately (check dependencies if any)
* Feel free to use, modify & share as you want

Tested on :
* windows : Chrome, FireFox, Edge, IE11 (with some limitations), Opera (slow)
* Android : Chrome, FireFox, Edge, Opera, Samsung Internet

FILES
=====
* myol.css : full CSS distribution
* myol.js : full JS distribution
* src/... : Source files
* ol/... : Openlayer V6.0.1 (you can use any of openlayers V5.* or V6.*) from [Openlayers](https://openlayers.org/download/)
* geocoder/... : Geocoder V4.0.0 from [Openlayers geocoder](https://github.com/jonataswalker/ol-geocoder/releases/latest)
* proj4/... : Coordinate transformation software proj4js V2.5.0 from [Proj4](https://github.com/proj4js/proj4js/releases/latest)
* index.html : Simple demo
* examples/... : Demos or ongoing developments
* examples/polyfill.js : pour IE, generate with https://polyfill.io/v3/url-builder/
* gps/... : Off line demo with GPS capabilities
