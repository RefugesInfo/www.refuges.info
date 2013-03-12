/*DCM++ © Dominique Cavailhez 2012.
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMTS.js
 */

/**
 * Class: OpenLayers.Layer.IGN
 * Instances of the IGN WMTS API V3
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMTS>
 *
 * Clé V3 développement sur: http://api.ign.fr
 * Clé V3 production sur: http://pro.ign.fr/api-web => Service en ligne => Service en ligne => S'ABONNER
 * Doc sur http://api.ign.fr/jsp/site/Portal.jsp?page_id=6&document_id=80&dossier_id=53
 */
OpenLayers.Layer.IGN = OpenLayers.Class(OpenLayers.Layer.WMTS, {

    /**
     * APIProperty: layer
     * {String} The layer name of the WMTS service distributed
     */
	layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',

    /**
     * APIProperty: format
     * {String} The format of the layer distributed
     */
	format: 'image/jpeg',
	
    /** 
     * APIProperty: maxZoomLevel
	 * Low limit of zoom, depending on the layer
     */
	maxZoomLevel: 18,
	
    /**
     * Constructor: OpenLayers.Layer.IGN
     * Create a new IGN layer.
     */
    initialize: function(name, cle, options) {
        OpenLayers.Layer.WMTS.prototype.initialize.call(this, 
			OpenLayers.Util.extend(
				{
					name: name,
					url: 'http://gpp3-wxs.ign.fr/'+cle+'/wmts',
					layer: this.layer,
					format: this.format,
					matrixSet: 'PM',
					style: 'normal',
					projection: 'EPSG:900913',
					validExtent: new OpenLayers.Bounds (-4.8, 38.8, 8.2, 51.1) .transform ('EPSG:4326', 'EPSG:900913'),
					maxZoomLevel: this. maxZoomLevel,
					attribution:
						'<a href="http://geoportail.fr" title="Acc&egrave;s IGN">'+
							'<img src="http://api.ign.fr/geoportail/api/js/2.0.0beta/theme/geoportal/img/logo_gp.gif" />'+
						'</a> '+
						'<a style="position:relative;bottom:7px;"'+
							' title="Conditions d\'utilisations"'+
							' href="http://geoportail.gouv.fr/depot/api/cgu/licAPI_CGUF.pdf">'+
							'Conditions d\'utilisations'+
						'</a>'
				}
			), options
		);
    },

    CLASS_NAME: "OpenLayers.Layer.IGN"
});


/**
 * Class: OpenLayers.Layer.IGN.Photo
 * Instances of the IGN WMTS API V3 for the photo layer
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.IGN>
 *
 */
OpenLayers.Layer.IGN.Photo = OpenLayers.Class(OpenLayers.Layer.IGN, {
	
    /**
     * APIProperty: layer
     * {String} The layer name of the WMTS service is distributed by IGN
     */
	layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
	
    /** 
     * APIProperty: maxZoomLevel
	 * Low limit of zoom, depending on the layer
     */
	maxZoomLevel: 19,
	
    CLASS_NAME: "OpenLayers.Layer.IGN.Photo"
});


/**
 * Class: OpenLayers.Layer.IGN.Photo
 * Instances of the IGN WMTS API V3 for the photo layer
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.IGN>
 *
 */
OpenLayers.Layer.IGN.Cadastre = OpenLayers.Class(OpenLayers.Layer.IGN, {
	
    /**
     * APIProperty: layer
     * {String} The layer name of the WMTS service is distributed by IGN
     */
	layer: 'CADASTRALPARCELS.PARCELS',

    /**
     * APIProperty: format
     * {String} The format of the layer distributed by IGN
     */
	format: 'image/png',
	
    /** 
     * APIProperty: maxZoomLevel
	 * Low limit of zoom, depending on the layer
     */
	maxZoomLevel: 20,
	
    CLASS_NAME: "OpenLayers.Layer.IGN.Cadastre"
});
