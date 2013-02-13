/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.  
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMTS.js
 * @requires OpenLayers/Layer/Grid.js
 * @requires OpenLayers/Tile/Image.js
 */

/**
 * Class: OpenLayers.Layer.IGN
 * Instances of the IGN WMTS API V3
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMTS>
 *
 * clé V2 sur: http://api-archives.ign.fr/geoportail
 * clé V3 développement sur: http://api.ign.fr
 * clé V3 production sur: http://pro.ign.fr/api-web => Service en ligne => S'ABONNER
 * doc sur http://api.ign.fr/jsp/site/Portal.jsp?page_id=6&document_id=80&dossier_id=53
 */
 
OpenLayers.Layer.IGN = OpenLayers.Class(OpenLayers.Layer.WMTS, {
	
	layer: 'GEOGRAPHICALGRIDSYSTEMS.MAPS',
	maxZoomLevel:18,
	
    initialize: function(name, cle) {
        OpenLayers.Layer.WMTS.prototype.initialize.call(this,
		{
			name: name,
			url: 'http://gpp3-wxs.ign.fr/'+cle+'/wmts',
			layer: this.layer,
			matrixSet: 'PM',
			style: 'normal',
			projection: 'EPSG:900913',
			maxZoomLevel: this. maxZoomLevel,
			attribution: '&copy;IGN '+
						 '<a href="http://www.geoportail.fr/" target="_blank">'+
							'<img src="http://api.ign.fr/geoportail/api/js/2.0.0beta/theme/geoportal/img/logo_gp.gif">'+
						 '</a> '+
						 '<a href="http://www.geoportail.gouv.fr/depot/api/cgu/licAPI_CGUF.pdf" alt="TOS" title="TOS" target="_blank">'+
							'Terms of Service'+
						 '</a>'
		});
    },

    CLASS_NAME: "OpenLayers.Layer.IGN"
});

OpenLayers.Layer.IGN.Photo = OpenLayers.Class(OpenLayers.Layer.IGN, {
	layer: 'ORTHOIMAGERY.ORTHOPHOTOS',
	maxZoomLevel:19,
    CLASS_NAME: "OpenLayers.Layer.IGN.Photo"
});
