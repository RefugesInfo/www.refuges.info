/*DCM++ © Dominique Cavailhez 2012.
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/OSM.js
 * @requires OpenLayers/Layer/XYZ.js
 * @requires OpenLayers/Layer/Grid.js
 * @requires OpenLayers/Tile/Image.js
 */

/**
 * Class: OpenLayers.Layer.WRI
 * Create a maps.refuges.info layer
 *
 * Inherits from:
 *  - <OpenLayers.Layer.OSM>
 */
 
OpenLayers.Layer.WRI = OpenLayers.Class(OpenLayers.Layer.OSM, {

	url: 'http://maps.refuges.info/hiking/${z}/${x}/${y}.png',
	
    initialize: function(name) { // OpenLayers.Layer.OSM ne comporte pas de méthode initialize, 
        OpenLayers.Layer.XYZ.prototype.initialize.call( //il faut donc appeler la classe dont il hérite
			this, name, null, {numZoomLevels: 18} // Il faut forcer zoom comme ça, sinon XYZ.initialize l'écrase
		);
    },
	
	attribution:
		'<a class="DCattribution" style="background-color:#F2F2F2" href="http://maps.refuges.info">Refuges.Info</a>&nbsp;'+
		OpenLayers.Layer.OSM.prototype.attribution,

    CLASS_NAME: "OpenLayers.Layer.WRI"
});
