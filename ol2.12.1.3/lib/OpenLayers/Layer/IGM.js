/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.  
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMS.js
 * @requires OpenLayers/Layer/Grid.js
 * @requires OpenLayers/Tile/Image.js
 */

/**
 * Class: OpenLayers.Layer.IGM
 * Instances of the IGM class allow viewing maps of IGM (Istituto Geografico Militare) Geoportale Nazionale
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMS>
 */
 
OpenLayers.Layer.IGM = OpenLayers.Class(OpenLayers.Layer.WMS, {

	mapUrl: 'http://wms.pcn.minambiente.it/ogc?map=/ms_ogc/WMS_v1.3/raster/',
	
	resolutions: [
/* pour les grandes échèles
		1.40625,
		0.703125,
		0.3515625,
		0.17578125,
		0.087890625,
		0.0439453125,
		0.02197265625,
		0.010986328125,
		0.0054931640625,
		0.00274658203125,
		0.001373291015625,
*/
		0.0006866455078125,
		0.00034332275390625,
		0.000171661376953125,
		0.0000858306884765625,
		0.00004291534423828125,
		0.00004291534423828125/2
	],
	
	attribution: {
		name: 'IGM',
		site: 'http://www.pcn.minambiente.it/viewer/',
		licence: 'http://www.pcn.minambiente.it/GN/terminidiservizio.php',
		style: 'color:white;background-color:#6A0000'
	},
	
    moveTo: function(bounds, zoomChanged, dragging) {
		if(zoomChanged) {
/* pour mettre la carte expérimentale OSM format WMS pour les grandes échèles
			if (this.map.zoom < 11) {
				this.url = 'http://129.206.228.72/cached/osm?';
				this.params.LAYERS= 'osm_auto:all';
				this.params.FORMAT= 'image/png';
			} else
*/
			if (this.map.zoom < this.resolutions.length - 4) {
				this.url = this.mapUrl + 'IGM_250000.map';
				this.params.LAYERS= 'CB.IGM250000';
//				this.params.FORMAT= 'image/jpeg';
			} else
			if (this.map.zoom < this.resolutions.length - 2) {
				this.params.LAYERS= 'MB.IGM100000';
				this.url = this.mapUrl + 'IGM_100000.map';
//				this.params.FORMAT= 'image/jpeg';
			} else {
				this.url = this.mapUrl + 'IGM_25000.map';
				this.params.LAYERS= 'CB.IGM25000';
//				this.params.FORMAT= 'image/jpeg';
			}
		}
		return OpenLayers.Layer.WMS.prototype.moveTo.apply(this, arguments);
    },
	
    initialize: function(name) {
        OpenLayers.Layer.WMS.prototype.initialize.call(this, name, 
		null, 
		{layers: this.layerName},
		{
			maxExtent: new OpenLayers.Bounds (6.6, 36.7, 18.5, 47),
			buffer: 0,
			tileSize: new OpenLayers.Size (512, 512), // Moins de filigranes
			resolutions: this.resolutions,
			attribution: '<a class="DCattribution" style="'+this.attribution.style+'" href="'+this.attribution.site+'" title"Site d\'origine">&copy; '+this.attribution.name+'</a>&nbsp;<a href="'+this.attribution.licence+'" title="Conditions d\'utilisation">Conditions d\'utilisation</a>'
		});
    },
	


    CLASS_NAME: "OpenLayers.Layer.IGM"
});
