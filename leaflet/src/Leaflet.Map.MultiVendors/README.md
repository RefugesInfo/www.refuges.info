# Leaflet.Map.MultiVendors
Leaflet plugin for multi vendors maps & projections
```
- OSM, Maps.Refuges.Info
- IGN France, cadastre, photos
- SwissTopo
- IDEE España, photos
- IGM Italie
- OS Great Britain
- Kompass Austria
- Bing Microsoft, photos
- Google maps, photos
```

This plugin can switch between maps using different CRS (Ex: Ordnance Survey for Great Britain, Swisstopo, ...).

This plugin works on both Leaflet V1.0.*

DEMOS
-----
[See a DEMO using Leaflet V1.0](https://dominique92.github.io/MyLeaflet/src/Leaflet.Map.MultiVendors/)

[See a DEMO of France IGN layers](https://dominique92.github.io/MyLeaflet/src/Leaflet.Map.MultiVendors/examples/France-IGN.html)

[See a DEMO of Spain IDEE layer](https://dominique92.github.io/MyLeaflet/src/Leaflet.Map.MultiVendors/examples/Spain-IDEE.html)

[See a DEMO of Italy IGM layers](https://dominique92.github.io/MyLeaflet/src/Leaflet.Map.MultiVendors/examples/Italy-IGM.html)

Usage
-----
Include MapMultiCRS.js & the Use L.Control.Layers as usual.

Just take care to add a crs option to each layer using a spécific crs.

```html
<script src="https://dominique92.github.io/MyLeaflet/lib/Leaflet.Map.MultiVendors-master/src/MapMultiCRS.js"></script>
```

```javascript
// List all required layers
var layers = {
    osm: new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
    osmFR: new L.TileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'),
	// For non standard CRS layers, assign the required CRS as an option to the layer
	OS: new L.OSOpenSpace.TileLayer("<map OS key>", {crs: L.OSOpenSpace.CRS})
};

// Create the map with one of the layers members as initial layer
var map = new L.Map('map', {
	center: new L.LatLng (51.5, 0),
	zoom: 6,
	layers: layers.osm
});

// Add the layer control to the map.
new L.Control.Layers(layers).addTo(map);
```
