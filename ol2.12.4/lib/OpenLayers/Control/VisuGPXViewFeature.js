/*DCM++ © Florent Coste 2012
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Control.js
 * @requires OpenLayers/Format/GPX.js
 * @requires OpenLayers/Projection.js
 */

/**
 * Class: OpenLayers.Control.SaveFeature
 * Create an instance of OpenLayers.Control that view the trace on http://visugpx.com
 *
 * Inherits from:
 *  - <OpenLayers.Control>
 */
OpenLayers.Control.VisuGPXViewFeature = OpenLayers.Class(OpenLayers.Control, {

    /**
     * APIMethod: activate
     * Explicitly activates a control and it's associated
     * handler if one has been set.  Controls can be
     * deactivated by calling the deactivate() method.
     * 
     * Returns:
     * {Boolean}  True if the control was successfully activated or
     *            false if the control was already active.
     */
    activate: function () {
        var r = OpenLayers.Control.prototype.activate.apply(this,arguments);
		if (typeof this.form == 'undefined') { // On crée le formulaire une fois seulement
			this.form = document.createElement ('form');
			this.form.name = 'visugpx';
			this.form.method = 'POST';
			this.form.target = '_new';
			this.form.action = 'http://www.visugpx.com/editgpx/gpxecho_moy.php5';
			this.map.div.appendChild(this.form);
			
			this.input = document.createElement ('input');
			this.input.type = 'hidden';
			this.input.name = 'filename';
			this.input.id = 'datavisugpx';
			this.value = 'trace.gpx';
			this.form.appendChild (this.input);
			
			this.input2 = document.createElement ('input');
			this.input2.type = 'hidden';
			this.input2.name = 'visugpx';
			this.input2.id = 'visugpx';
			this.value = 'VisuGPX';
			this.form.appendChild (this.input2);
			
			this.textarea = document.createElement ('textarea');
			this.textarea.id = 'datavisugpx';
			this.textarea.style = 'display:none';
			this.textarea.name = 'data';
			this.form.appendChild (this.textarea);
		}
		
		var format = new OpenLayers.Format.GPX({
			'internalProjection': this.map.baseLayer.projection,
			'externalProjection': new OpenLayers.Projection('EPSG:4326')
		});
		
		this.textarea.value =
			format.write (this.layer.features) 
				.replace(/\n/g,''). replace(/>/g,'>\n') // Insère des césure de lignes pour rendre le fichier plus lisible
				.replace(/gpx\:/gi,''); // Chrome rajoute un gpx: en prefixe dans les tag XML. Pas trouvé de facon propre de fixer ça, autrement que en faisant un beau replace ! 

		this.form.submit();
		this.deactivate(); // Aucune raison de le laisser sélecté quand le save est fait
		
		return r;
    },

	CLASS_NAME: "OpenLayers.Control.VisuGPXViewFeature"
});
