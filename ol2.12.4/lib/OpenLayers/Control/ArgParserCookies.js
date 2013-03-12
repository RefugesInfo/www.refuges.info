/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Control/ArgParser.js
 */

/**
 * Class: OpenLayers.Control.ArgParserCookies
 * Create an instance of OpenLayers.Control.ArgParser that keep lon,lat, zoom & active layers in cookies
 *
 * Inherits from:
 *  - <OpenLayers.ArgParser>
 */

OpenLayers.Control.ArgParserCookies = OpenLayers.Class(OpenLayers.Control.ArgParser, {

	// Paramètres invariants suivant les couches présentes sur les différentes cartes
    scale: null, // L'échèle en clair
    baseLayer: null, // La couche de base en clair

    getParameters: function(map) {
		// par ordre inverse de priorité
		// Si rien d'autre n'est spécifié
		this.params = {
			zoom: 6,
			lat: 47,
			lon: 2,
			layers: 'B' // Sinon, n'appelle pas configureLayers
		};

		// Les défauts déclarés dans le PermalinkCookies
		var plc = this.map.getControlsByClass ('OpenLayers.Control.PermalinkCookies');
		if (plc.length && plc[0].defaut)
			OpenLayers.Util.extend (this.params, plc[0].defaut);

		// ou ArgParserCookies
		OpenLayers.Util.extend (this.params, this.defaut);

		// Les paramètres mémorisés par le cookie OLparams
		var cookies = OpenLayers.Util.readCookie ('params');
		if (cookies) 
			OpenLayers.Util.extend (this.params, OpenLayers.Util.getParameters('?'+cookies));

		// Les arguments de la ligne de commande
		var args = OpenLayers.Util.getParameters(window.location.href);
		// Annule les paramètres supplémentaires précédents
		OpenLayers.Util.extend (this.params, args);
		
		// Les valeurs forcées déclarés dans le PermalinkCookies
		if (plc.length && plc[0].force)
			OpenLayers.Util.extend (this.params, plc[0].force);

		// ou ArgParserCookies
		OpenLayers.Util.extend (this.params, this.force);

		return this.params;
    },
	
    configureLayers: function() {
		// Les paramètres scale & baseLayer, indépendants des couches, ont priorité
		if (this.params.baseLayer) {
			for (var i=0, len=this.map.layers.length; i<len; i++)
				if (this.map.layers[i].isBaseLayer &&
					this.map.layers[i].name == this.params.baseLayer) { // Quand on a trouvé la bonne baseLayer
                    this.map.setBaseLayer (this.map.layers[i]); // On la paramètre
					this.map.events.unregister('addlayer', this, this.configureLayers); // Et on arrête là
				}
		}
		else // Si on n'a pas de paramètre, on fait comme d'habitude
			OpenLayers.Control.ArgParser.prototype.configureLayers.apply(this, arguments);
    },

    setCenter: function(map) {
		// Réinitialise le zoom avec l'échele de la carte mémorisée (si toutes les cartes n'ont pas les mêmes résolutions)
		// Ce calcul est fait ici car la baselayer est définie
		if (this.map.baseLayer && this.params.scale) {
			var resolution = OpenLayers.Util.getResolutionFromScale (this.params.scale, this.map.baseLayer.units);
			this.zoom = this.map.getZoomForResolution (resolution, true);
		}
		OpenLayers.Control.ArgParser.prototype.setCenter.apply(this, arguments);
    },

    CLASS_NAME: "OpenLayers.Control.ArgParserCookies"
});
