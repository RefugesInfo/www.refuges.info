/*DCM++ © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMTS.js
 * @requires OpenLayers/BaseTypes/Bounds.js
 * @requires ../proj4js-1.1.0/lib/proj4js-combined.js
 * @requires ../proj4js-1.1.0/lib/defs/EPSG21781.js
 */

/**
 * Class: OpenLayers.Layer.SwissTopo
 * Instances of the SwissTopo class allow viewing maps of http://map.geo.admin.ch/
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMTS>
 * 
 * Doc sur: http://swisstopo.admin.ch/internet/swisstopo/fr/home/products/services/web_services/webaccess.html
 * Demande pour autoriser le domaine à accéder aux données: même lien => Accès au formulaire de commande
 * Automatiquement autorisé sur //localhost
 */
OpenLayers.Layer.SwissTopo = OpenLayers.Class(OpenLayers.Layer.WMTS, {

    /**
     * APIProperty: layerName
     * {String} The layer name of the WMTS service distributed
     */
	layerName: 'ch.swisstopo.pixelkarte-farbe',

    /** 
     * APIProperty: time
	 * Time tag of the layer distributed
	 * The last up to date value is provided by ttp://wmts.geo.admin.ch/1.0.0/WMTSCapabilities.xml
     */
	time: 20120809,

    /**
     * APIProperty: format
     * {String} The format of the layer distributed
     */
	format: 'jpeg',

    /**
     * Property: serverResolutions
     * {Array} the resolutions provided by the servers
     */
    resolutions: [2250,2000,1750,1500,1250,1000,750,650,500,250,100,50,20,10,5,2.5,2,1.5],

    /**
     * Constructor: OpenLayers.Layer.SwissTopo
     * Create a new SwissTopo layer.
     */
    initialize: function(name, options) {
		if (typeof Proj4js != 'object')
			alert ('ERROR: This map needs to include proj4js-combined.js');

		OpenLayers.Util.extend (this, options);
		var capa = this.getCapabilities ();
				
        OpenLayers.Layer.WMTS.prototype.initialize.call(this, {
			name: name,
			url: capa.operationsMetadata_GetTile_dcp_http_get,
			layer: this.layerName,
			matrixSet: '21781',
			projection: 'EPSG:21781',
			maxExtent: new OpenLayers.Bounds(420000, 30000, 900000, 350000),
			validExtent: new OpenLayers.Bounds (6, 45.86, 10.5, 47.8) .transform ('EPSG:4326', 'EPSG:21781'),
			units: 'm',
			resolutions: this.resolutions, // Seules ces résolutions sont affichées
			matrixIds: capa.matrixIds,
			requestEncoding: 'REST',
			style: 'default', // must be provided
			dimensions: ['TIME'], // ATTENTION : future versions OL : n'est plus uppercase : utiliser Time
			params: {'time': this.time},
			formatSuffix: this.format,
			attribution:
				'<a style="text-decoration:none;padding:0px 4px 2px 4px;color:black;font-size:12;font-family:Arial black;color:white;background-color:red"'+
					' title"Accés SwissTopo"'+
					' href="http://map.geo.admin.ch">'+
					'&copy; SwissTopo'+
				'</a> '+
				'<a href="http://geo.admin.ch/internet/geoportal/fr/home/geoadmin/contact.html#copyright" title="Conditions d\'utilisation">'+
					'Conditions d\'utilisation'+
				'</a>'
		});
    },

    /**
     * APIMethod: getCapabilities
     * Generates capabilities data
	 * The capabilities are defined in http://wmts.geo.admin.ch/1.0.0/WMTSCapabilities.xml
	 * To save time, they are simulated
	 * If they change, we must update the following code
     *
     * Returns:
     * {Array} List of capabilities.
     */
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


/**
 * Class: OpenLayers.Layer.SwissTopo.Photo
 * Instances of the SwissTopo class allow viewing maps of http://map.geo.admin.ch/
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.SwissTopo>
 * 
 */
OpenLayers.Layer.SwissTopo.Photo = OpenLayers.Class(OpenLayers.Layer.SwissTopo, {

    /**
     * APIProperty: layerName
     * {String} The layer name of the WMTS service distributed
     */
	layerName: 'ch.swisstopo.swissimage',
	
    /** 
     * APIProperty: time
	 * Time tag of the layer distributed
	 * The last up to date value is provided by ttp://wmts.geo.admin.ch/1.0.0/WMTSCapabilities.xml
     */
	time: 20120809,

    /**
     * Property: serverResolutions
     * {Array} the resolutions provided by the servers
     */
    resolutions: [2250,2000,1750,1500,1250,1000,750,650,500,250,100,50,20,10,5,2.5,2,1.5,1,0.5,0.25],
	
    CLASS_NAME: "OpenLayers.Layer.SwissTopo.Photo"
});


/**
 * Class: OpenLayers.Layer.SwissTopo.Siegfried
 * Instances of the SwissTopo class allow viewing maps of http://map.geo.admin.ch/
 * Siegfried Swiss map (1949)
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.SwissTopo>
 * 
 */
OpenLayers.Layer.SwissTopo.Siegfried = OpenLayers.Class(OpenLayers.Layer.SwissTopo, {

    /**
     * APIProperty: layerName
     * {String} The layer name of the WMTS service distributed
     */
	layerName: 'ch.swisstopo.hiks-siegfried',
	
    /** 
     * APIProperty: time
	 * Time tag of the layer distributed
	 * The last up to date value is provided by ttp://wmts.geo.admin.ch/1.0.0/WMTSCapabilities.xml
     */
	time: 18700101,
	
    /**
     * APIProperty: format
     * {String} The format of the layer distributed
     */
	format: 'png',
	
    CLASS_NAME: "OpenLayers.Layer.SwissTopo.Siegfried"
});


/**
 * Class: OpenLayers.Layer.SwissTopo.Dufour
 * Instances of the SwissTopo class allow viewing maps of http://map.geo.admin.ch/
 * Dufour Swiss map (1864)
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.SwissTopo>
 * 
 */
OpenLayers.Layer.SwissTopo.Dufour = OpenLayers.Class(OpenLayers.Layer.SwissTopo, {

    /**
     * APIProperty: layerName
     * {String} The layer name of the WMTS service distributed
     */
	layerName: 'ch.swisstopo.hiks-dufour',
	
    /** 
     * APIProperty: time
	 * Time tag of the layer distributed
	 * The last up to date value is provided by ttp://wmts.geo.admin.ch/1.0.0/WMTSCapabilities.xml
     */
	time: 18450101,

    /**
     * Property: serverResolutions
     * {Array} the resolutions provided by the servers
     */
    resolutions: [2250,2000,1750,1500,1250,1000,750,650,500,250,100,50,20,10,5],
	
    /**
     * APIProperty: format
     * {String} The format of the layer distributed
     */
	format: 'png',
	
    CLASS_NAME: "OpenLayers.Layer.SwissTopo.Dufour"
});
