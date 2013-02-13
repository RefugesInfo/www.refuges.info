/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.  
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMTS.js
 * @requires OpenLayers/Layer/Grid.js
 * @requires OpenLayers/Tile/Image.js
 * @requires proj4js-1.1.0/lib/proj4js-combined.js
 */

/**
 * Class: OpenLayers.Layer.SwissTopo
 * Instances of the SwissTopo class allow viewing maps of http://map.geo.admin.ch/
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMTS>
 * 
 * Doc sur: http://www.swisstopo.admin.ch/internet/swisstopo/fr/home/products/services/web_services/webaccess.html
 * Demande pour autoriser le domaine à accéder aux données: même lien => Accès au formulaire de commande
 */
 
OpenLayers.Layer.SwissTopo = OpenLayers.Class(OpenLayers.Layer.WMTS, {

	// Valeurs par défaut pour la carte de base
	layerName: 'ch.swisstopo.pixelkarte-farbe',
	time: 20120809,
	format: 'jpeg',

    resolutions: [2250,2000,1750,1500,1250,1000,750,650,500,250,100,50,20,10,5,2.5,2,1.5],

	attribution: {
		name: 'SwissTopo',
		site: 'http://map.geo.admin.ch/',
		licence: 'http://www.geo.admin.ch/internet/geoportal/fr/home/geoadmin/contact.html#copyright',
		style: 'color:white;background-color:red'
	},
	
    initialize: function(name, options) {
		Proj4js.defs["EPSG:21781"] = "+title=CH1903 / LV03 +proj=somerc +lat_0=46.95240555555556 +lon_0=7.439583333333333 +x_0=600000 +y_0=200000 +ellps=bessel +towgs84=674.374,15.056,405.346,0,0,0,0 +units=m +no_defs";

		OpenLayers.Util.extend (this, options);
		var capa = this.getCapabilities ();
				
        OpenLayers.Layer.WMTS.prototype.initialize.call(this, {
			name: name,
			url: capa.operationsMetadata_GetTile_dcp_http_get,
			layer: this.layerName,
			matrixSet: '21781',
			projection: 'EPSG:21781',
			maxExtent: new OpenLayers.Bounds(420000, 30000, 900000, 350000),
			units: 'm',
			resolutions: this.resolutions, // Seules ces résolutions sont affichées
			matrixIds: capa.matrixIds,
			requestEncoding: 'REST',
			style: 'default' ,  // must be provided
			dimensions: ['TIME'], // ATTENTION : future versions OL : n'est plus uppercase : utiliser Time
			params: {'time': this.time},
			formatSuffix: this.format,
			attribution:
				'<a class="DCattribution" style="'+this.attribution.style+'" href="'+this.attribution.site+'" title"Site d\'origine">&copy; '+this.attribution.name+'</a>&nbsp;'+
				'<a href="'+this.attribution.licence+'" title="Conditions d\'utilisation">Conditions d\'utilisation</a>'
		});
    },

	// Paramètres tirés de http://wmts.geo.admin.ch/1.0.0/WMTSCapabilities.xml
	// Si ces capabilities changent, il faudra les réactualiser
    getCapabilities: function() {
		var matrixIds = [], id = 7;
		for (i in this.resolutions)
			matrixIds.push ({
				identifier: id++,
				scaleDenominator: this.resolutions [i] * 3571.43764288
			});

		return {
			operationsMetadata_GetTile_dcp_http_get: ['http://wmts0.geo.admin.ch/', 'http://wmts1.geo.admin.ch/', 'http://wmts.geo.admin.ch/'],
			matrixIds: matrixIds
		};
	},
	
    CLASS_NAME: "OpenLayers.Layer.SwissTopo"
});

OpenLayers.Layer.SwissTopo.Photo = OpenLayers.Class(OpenLayers.Layer.SwissTopo, {
	layerName: 'ch.swisstopo.swissimage',
	time: 20120809,
    resolutions: [2250,2000,1750,1500,1250,1000,750,650,500,250,100,50,20,10,5,2.5,2,1.5,1,0.5,0.25],
    CLASS_NAME: "OpenLayers.Layer.SwissTopo.Photo"
});

OpenLayers.Layer.SwissTopo.Siegfried = OpenLayers.Class(OpenLayers.Layer.SwissTopo, {
	layerName: 'ch.swisstopo.hiks-siegfried',
	time: 18700101,
	format: 'png',
    CLASS_NAME: "OpenLayers.Layer.SwissTopo.Siegfried"
});

OpenLayers.Layer.SwissTopo.Dufour = OpenLayers.Class(OpenLayers.Layer.SwissTopo, {
	layerName: 'ch.swisstopo.hiks-dufour',
	time: 18450101,
    resolutions: [2250,2000,1750,1500,1250,1000,750,650,500,250,100,50,20,10,5],
	format: 'png',
    CLASS_NAME: "OpenLayers.Layer.SwissTopo.Dufour"
});
