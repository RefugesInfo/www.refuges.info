/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Control/Navigation.js
 */

/**
 * Class: OpenLayers.Control.SaveFeature
 * Create an instance of OpenLayers.Control.Navigation that completely remove a feature
 *
 * Inherits from:
 *  - <OpenLayers.Control.Navigation>
 */

OpenLayers.Control.SaveFeature = OpenLayers.Class(OpenLayers.Control.Navigation, {
    activate: function () {
        var r = OpenLayers.Control.Navigation.prototype.activate.apply(this,arguments);
		
		for (f = 0; f < this.layer.features.length; f++)
			this.layer.features[f].state = OpenLayers.State.INSERT; // On force l'upload
/*
		if (!this.layer.features.length) // Sinon, save n'agit pas
			alert ('Il doit rester au moins une ligne');
		else {
alert(this.layer.features.length);
if(0){
			// S'il y a des features avec 0 ou 1 points, on les supprime
			for (f = this.layer.features.length-1; f >= 0; f--) { // On agit dans l'ordre inverse car la supression d'1 item décale les suivants
				var points = this.layer.features[f].geometry.getVertices();
				if (points.length < 2)
					this.layer.features[f].destroy (); // On supprime le feature
			}
			// S'il y a plusieurs lignes, on les concatène
			for (f = this.layer.features.length-1; f; f--) {
				var points = this.layer.features[f].geometry.getVertices();
				for (p=0; p<=points.length; p++)
					this.layer.features[0].geometry.addComponent(points[p]); // On insère les points dans la première ligne
				this.layer.features[f].destroy (); // On supprime le feature
			}
}
		}
*/
		this.layer.saveStrategy.save ();
		
		return r;
    },

	CLASS_NAME: "OpenLayers.Control.SaveFeature"
});
