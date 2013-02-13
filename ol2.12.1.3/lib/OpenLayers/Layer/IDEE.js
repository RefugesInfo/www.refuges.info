/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.  
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMS.js
 * @requires OpenLayers/Layer/Grid.js
 * @requires OpenLayers/Tile/Image.js
 * @requires proj4js-1.1.0/lib/proj4js-combined.js
*/

/**
 * Class: OpenLayers.Layer.IDEE
 * Instances of the IDEE class allow viewing maps of Infraestructura de Datos Espaciales de España
 * IDEE Espana
 * From : http://mapa.ign.gob.ar/docs/OpenLayers
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMS>
 */
 
OpenLayers.Layer.IDEE = OpenLayers.Class(OpenLayers.Layer.WMS, {
	
    initialize: function(name) {
		Proj4js.defs["EPSG:23030"] = "+proj=utm +zone=30 +ellps=intl +towgs84=-131,-100.3,-163.4,-1.244,-0.020,-1.144,9.39 +units=m +no_defs";
        OpenLayers.Layer.WMS.prototype.initialize.call(this, name, 
		'http://www.idee.es/wms/MTN-Raster/MTN-Raster', 
		{layers: 'mtn_rasterizado'},
		{
			buffer: 0,
			maxExtent: new OpenLayers.Bounds (-100000, 3950000, 1150000, 4900000),
			projection: 'EPSG:23030',
			resolutions: [1800,900,450,225,120,50,25,10,4.5,3,2],
			attribution: '<a class="DCattribution" style="'+this.attribution.style+'" href="'+this.attribution.site+'" title"Site d\'origine">&copy; '+this.attribution.name+'</a>&nbsp;<a href="'+this.attribution.licence+'" title="Conditions d\'utilisation">Conditions d\'utilisation</a>'
		});
    },

	attribution: {
		name: 'IDEE',
		site: 'http://www.idee.es/clientesIGN/wmsGenericClient/index.html',
		licence: 'http://www.idee.es/show.do?to=pideep_aviso_legal.FR',
		style: 'background-color:#E2BF0D'
	},

    CLASS_NAME: "OpenLayers.Layer.IDEE"
});
