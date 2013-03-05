/*DCM++ © Dominique Cavailhez 2012.
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */
 
//DCM  TODO: intégrer script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"
//*DCM*/document.write('<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>'); // Inclue la déclaration google

/**
 * @requires OpenLayers/Layer/Google.js
 * @requires OpenLayers/Layer/SphericalMercator.js
 * @requires OpenLayers/Layer/EventPane.js
 * @requires OpenLayers/Layer/FixedZoomLevels.js
 * @requires OpenLayers/Lang.js
 */

/**
 * Class: OpenLayers.Layer.Google...
 * Create various Google layers
 *
 * Inherits from:
 *  - <OpenLayers.Layer.Google>
 */

//DCM  TODO ??? OpenLayers.Layer.Google.prototype.MIN_ZOOM_LEVEL = 2;
if (typeof google == 'object') {
//	OpenLayers.Layer.Google.prototype.MIN_ZOOM_LEVEL = 5;

	OpenLayers.Layer.Google.Terrain = OpenLayers.Class(OpenLayers.Layer.Google, {
		type: google.maps.MapTypeId.TERRAIN,
		MAX_ZOOM_LEVEL: 15,
		numZoomLevels: 15,
		CLASS_NAME: "OpenLayers.Google.Terrain"
	});
	 
	OpenLayers.Layer.Google.Photo = OpenLayers.Class(OpenLayers.Layer.Google, {
		type: google.maps.MapTypeId.SATELLITE,
		MAX_ZOOM_LEVEL: 20,
		numZoomLevels: 20,
		CLASS_NAME: "OpenLayers.Google.Photo"
	});
	 
	OpenLayers.Layer.Google.Hybrid = OpenLayers.Class(OpenLayers.Layer.Google, {
		type: google.maps.MapTypeId.HYBRID,
		MAX_ZOOM_LEVEL: 20,
		numZoomLevels: 20,
		CLASS_NAME: "OpenLayers.Google.Hybrid"
	});
}