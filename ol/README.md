Dominique92.MyOl
================
* This package adds many features to [openlayer map](https://openlayers.org/).
* It is deployed on http://alpages.info

SIMPLE EXAMPLE
==============
This [EXAMPLE DEMO](https://dominique92.github.io/MyOl/) implements a single map with the most current maps layers providers.
* You can download the [DISTRIBUTION ZIPPED PACKAGE](https://github.com/Dominique92/MyOl/archive/master.zip) and unzip it in your website FTP section.
* See the [FULL FUNCTIONS EXAMPLE DEMO](https://dominique92.github.io/MyOl/examples/)
* You can include the includes, css & javascript sections of this example on your own page (adjust the include files path to your implementation)

LAYERS KEYS
===========
If you want to use external providers layers, you must acquire free keys and replace them in the html (see source comment)
* French IGN : Get your own (free) IGN key at [http://professionnels.ign.fr](http://professionnels.ign.fr/ign/contrats)
* OSM thunderforest : Get your own (free) THUNDERFOREST key at [https://manage.thunderforest.com](https://manage.thunderforest.com)
* Microsoft BING : Get your own (free) BING key at [https://www.microsoft.com](https://www.microsoft.com/en-us/maps/create-a-bing-maps-key)
* Swiss Topo : You need to register your domain in [https://shop.swisstopo.admin.ch](https://shop.swisstopo.admin.ch/fr/products/geoservice/swisstopo_geoservices/WMTS_info)

FULL FUNCTIONS
==============
MyOL extension provides supplementary functions to [Openlayers V5](https://openlayers.org/)
* GeoJson ajax layers,
* Multi vendors maps :
```
- OSM, OSM-FR, Maps.Refuges.Info
- ThunderForest Outdoors, OpenTopoMap, Cycles, Landscape, Transport, ...
- IGN France, cadastre, satellite, ...
- SwissTopo, satellite
- IDEE España, satellite
- IGM Italie
- OS Great Britain
- Kompass Austria
- Bing Microsoft, satellite
- Google maps, satellite
```
* geoJson vector layers, OverPass (OSM vector points of interest)
* Editable position marker with multi-projection position display,
* Polylines & polygons editor.
* Keep position, zoom & zoom on cookies
* Layer switcher, GPS, geocoder, print map, line length display, GPX upload & download
[See a DEMO here](https://dominique92.github.io/MyOl/examples/)

ARCHITECTURE
============
Just include myol.js & myos.css after ol/dist, proj4js & geocoder's js & css.
* See [examples/index.html](https://raw.githubusercontent.com/Dominique92/MyOl/master/examples/index.html) for example
* Code & all tiled layers use EPSG:3857 spherical mercator projection

The coding rules are volontary simple & don't follow all openlayers's
* Few classes, no inheritage, no jquery...
* Each adaptation is included in a single JS function that you can include separately (check dependencies if any)
* Feel free to use, modify & share as you want

DEPENDENCIES
============
This package includes :
* openlayers v5.3.0
* proj4js 2.5.0
* ol-geocoder v3.2.0

FILES
=====
* ol/... : Openlayer last stable distribution files from [Openlayers GitHub](https://github.com/openlayers/openlayers)
* geocoder/... : Openlayer geocoder last stable distribution files from [Openlayers geocoder GitHub](https://github.com/jonataswalker/ol-geocoder)
* proj4/... : Coordinate transformation software last stable distribution files from [Proj4 GitHub](https://github.com/OSGeo/proj.4)
* examples/... : Demo files or ongoing developments
* myol.css : Specific CSS presentation distribution
* myol.js : Specific CSS extensions distribution
* index.html : Simple demo
