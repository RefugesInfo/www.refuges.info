/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Layer/OSM.js
 */

/**
 * Class: OpenLayers.Layer.OCM
 * Create a opencyclemap layer
 *
 * Inherits from:
 *  - <OpenLayers.Layer.OSM>
 */

OpenLayers.Layer.OCM = OpenLayers.Class(OpenLayers.Layer.OSM, {

    server: 'tile.opencyclemap.org/cycle',

    initialize: function(name) { // OpenLayers.Layer.OSM ne comporte pas de méthode initialize,
        OpenLayers.Layer.XYZ.prototype.initialize.call( // il faut donc appeler la classe dont il hérite
            this, name,
            [
                'http://a.' + this.server + '/${z}/${x}/${y}.png',
                'http://b.' + this.server + '/${z}/${x}/${y}.png',
                'http://c.' + this.server + '/${z}/${x}/${y}.png'
            ], {
                displayOutsideMaxExtent: true,
                transitionEffect: 'resize'
            }
        );
    },

    attribution:
        '<b>OpenCycleMap.org - the <a href="http://www.openstreetmap.org">OpenStreetMap</a> Cycle Map</b><br />'
        + '<a href="/docs/">Key and More Info</a>'
        + ' | <a href="/donate/">Donate</a>'
        + ' | <a href="http://shop.opencyclemap.org">Shop</a>'
        + ' | <a href="/gps/">GPS</a><br /><br />'
        + '<a href="http://www.thunderforest.com">Developer Information</a><img class="tf-logo" src="http://opencyclemap.org/images/tf-logo-36-inv.png"/>',

    CLASS_NAME: 'OpenLayers.Layer.OCM'
});

OpenLayers.Layer.OCM.Transport = OpenLayers.Class(OpenLayers.Layer.OCM, {

    server: 'tile2.opencyclemap.org/transport',

    attribution:
        '<b>Thunderforest Transport Map</b><br />A global public transport map<br /><br />'
        + '<a href="http://www.thunderforest.com">Developer Information</a><img class="tf-logo" src="/images/tf-logo-36-inv.png"/>',

    CLASS_NAME: 'OpenLayers.Layer.OCM.Transport'
});

OpenLayers.Layer.OCM.Landscape = OpenLayers.Class(OpenLayers.Layer.OCM, {

    server: 'tile3.opencyclemap.org/landscape',

    attribution:
        '<b>Thunderforest Landscape Map</b><br />A map style highlightning the landscape environment<br /><br />'
        + '<a href="http://www.thunderforest.com">Developer Information</a><img class="tf-logo" src="/images/tf-logo-36-inv.png"/>',

    CLASS_NAME: 'OpenLayers.Layer.OCM.Landscape'
});

OpenLayers.Layer.OCM.Outdoors = OpenLayers.Class(OpenLayers.Layer.OCM, {

    server: 'tile.thunderforest.com/outdoors',

    attribution:
        '<b>Thunderforest Outdoors Map</b><br />A world-wide map for outdoor activities<br /><br />'
        + '<a href="http://www.thunderforest.com">Developer Information</a><img class="tf-logo" src="/images/tf-logo-36-inv.png"/>',

    CLASS_NAME: 'OpenLayers.Layer.OCM.Outdoors'
});
