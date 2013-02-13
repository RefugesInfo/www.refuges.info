/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Control/ModifyFeature.js
 */

/**
 * Class: OpenLayers.Control.DeleteFeature
 * Create an instance of OpenLayers.Control.ModifyFeature that completely remove a feature
 *
 * Inherits from:
 *  - <OpenLayers.Control.ModifyFeature>
 */

OpenLayers.Control.DeleteFeature = OpenLayers.Class(OpenLayers.Control.ModifyFeature, {

	// Click sur la ligne : on détruit toute la ligne
    selectFeature: function(feature) {
        if ((!this.standalone ||
			this.layer.events.triggerEvent("beforefeaturesremoved", {feature: feature}) !== false
			) &&
			confirm ('Destruction ' + (feature.attributes.name || feature.id) + ' ?')) {
				feature.destroy ();
				this.layer.events.triggerEvent("featureremoved", {feature: feature})
			}
    },

	CLASS_NAME: "OpenLayers.Control.DeleteFeature"
});
