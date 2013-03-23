/*DCM++ © Dominique Cavailhez 2012.
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Control.js
 * @requires OpenLayers/Format/GPX.js
 * @requires OpenLayers/Projection.js
 */

/**
 * Class: OpenLayers.Control.LoadFeature
 * Create an instance of OpenLayers.Control that load a local GPX file to the editor
 *
 * Inherits from:
 *  - <OpenLayers.Control>
 */

OpenLayers.Control.LoadFeature = OpenLayers.Class(OpenLayers.Control, {

	notApplicable: !window.FileReader, // Ce contrôle n'est pas utilisable sur les explorateurs n'implémentant pas FileReader (IE < 9)

    /**
     * APIMethod: activate
     * Activate the control.
     * 
     * Returns:
     * {Boolean} Successfully activated the control.
     */
    activate: function () {
        var r = OpenLayers.Control.prototype.activate.apply(this,arguments);
		
		if (typeof this.input == 'undefined') { // On crée le formulaire une fois seulement
			this.input = document.createElement ('input');
			this.input.type = 'file';
			this.input.style.display = 'none';
			this.input.control = this; // Pour référence dans le callback
			this.input.onchange = function() {this.control.getFiles(this)}; // Procédure de callback
			this.map.div.appendChild(this.input); // On appelle le selécteur de fichier
		}
		this.input.click(); // On passe au choix du fichier immédiatement
		
		return r;
    },
	
    /**
     * Method: getFiles
     * Private 
     * Check selected files
     */
    getFiles: function (e) {
		for (i=0; i<e.files.length; i++) // Pour chaque fichier choisi
			if (!e.files[i])
				alert ('Failed to load file');
			else  {
				var fr = new FileReader();
				fr.control = this; // Pour référence dans le callback
				fr.onload = function (e) {this.control.getFile (e)}; // Procédure de callback
				fr.readAsText (e.files[i]); // On lance la lecture des fichiers sélectionnés
			}
    },
	
    /**
     * Method: getFiles
     * Private 
     * Read a single selected file
     */
    getFile: function (e) {
		var format = new OpenLayers.Format.GPX ({
			'internalProjection': this.map.baseLayer.projection,
			'externalProjection': new OpenLayers.Projection('EPSG:4326')
		});
		this.layer.addFeatures (format.read (e.target.result));
		
		// On recadre à chaque fichier car on ne sait pas si c'est le dernier
		this.map.zoomToExtent (this.layer.getDataExtent ()); 
	},

	CLASS_NAME: "OpenLayers.Control.LoadFeature"
});
