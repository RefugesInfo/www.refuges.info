/*DCM++ © Dominique Cavailhez / Florent Coste 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Control/Navigation.js
 */

/**
 * Class: OpenLayers.Control.DownloadFeature
 * Create an instance of OpenLayers.Control that download the features from the editor to the local PC
 *
 * Inherits from:
 *  - <OpenLayers.Control>
 */

OpenLayers.Control.DownloadFeature = OpenLayers.Class(OpenLayers.Control, {

    /**
     * APIMethod: activate
     * Activate the control.
     * 
     * Returns:
     * {Boolean} Successfully activated the control.
     */
    activate: function () {
        var r = OpenLayers.Control.prototype.activate.apply(this,arguments);
		
		// On force l'upload pour tous les segments
		for (f = 0; f < this.layer.features.length; f++)
			this.layer.features[f].state = OpenLayers.State.INSERT; 

		if (typeof this.form == 'undefined') { // On crée le formulaire une fois seulement
			this.form = document.createElement ('form');
			this.form.method = 'POST';
			this.form.action = OpenLayers._getScriptLocation() + 'services/echo-file.php?filename=trace.gpx';
			this.map.div.appendChild(this.form);
			
			this.textarea = document.createElement ('textarea');
			this.textarea.style.display = 'none';
			this.textarea.name = 'data';
			this.form.appendChild (this.textarea);
		}
		var format = new OpenLayers.Format.GPX({
			'internalProjection': this.map.baseLayer.projection,
			'externalProjection': new OpenLayers.Projection('EPSG:4326')
		});
		this.textarea.value = format.write (this.layer.features) .replace(/\n/g,''). replace(/>/g,'>\n');
		this.form.submit();

		return r;
    },

	CLASS_NAME: "OpenLayers.Control.DownloadFeature"
});
