/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Layer/XYZ.js
 * @requires OpenLayers/Layer/Grid.js
 * @requires OpenLayers/Tile/Image.js
 */

/**
 * Class: OpenLayers.Layer.WRI
 * Create a map.refuges.info layer
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
