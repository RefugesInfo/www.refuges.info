/*DCM++ © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/OSM.js
 * @requires OpenLayers/BaseTypes/Bounds.js
 */

/**
 * Class: OpenLayers.Layer.OSMFR
 * Create a maps.refuges.info layer
 *
 * Inherits from:
 *  - <OpenLayers.Layer.OSM>
 */

OpenLayers.Layer.OSMFR = OpenLayers.Class(OpenLayers.Layer.OSM, {

    url: [
        'http://a.tile.openstreetmap.fr/osmfr/${z}/${x}/${y}.png',
        'http://b.tile.openstreetmap.fr/osmfr/${z}/${x}/${y}.png',
        'http://c.tile.openstreetmap.fr/osmfr/${z}/${x}/${y}.png'
    ],

    initialize: function (name) { // OpenLayers.Layer.OSM ne comporte pas de méthode initialize,
        OpenLayers.Layer.XYZ.prototype.initialize.call( //il faut donc appeler la classe dont il hérite
			this, name, null, {
				validExtent: new OpenLayers.Bounds (-25, 33, 45, 72) .transform ('EPSG:4326', 'EPSG:900913'),
				numZoomLevels: 18 // Il faut forcer zoom comme ça, sinon XYZ.initialize l'écrase
			}
		);
    },

	attribution:
		'<a href="http://wiki.openstreetmap.org/wiki/FR:Servers/tile.openstreetmap.fr">osm-fr tiles</a> by C. Quest '+
		OpenLayers.Layer.OSM.prototype.attribution,

    CLASS_NAME: "OpenLayers.Layer.OSMFR"
});
