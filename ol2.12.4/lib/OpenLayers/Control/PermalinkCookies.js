/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Control/Permalink.js
 * @requires OpenLayers/Control/ArgParserCookies.js
 */

/**
 * Class: OpenLayers.Control.PermalinkCookies
 * Create an instance of OpenLayers.Control.Permalink that keep lon,lat, scale & active layers in cookies
 *
 * Inherits from:
 *  - <OpenLayers.Permalink>
 */

OpenLayers.Control.PermalinkCookies = OpenLayers.Class(OpenLayers.Control.Permalink, {

	// Pour récupérer les valeurs des cookies, va utiliser ce parser à la place de OpenLayers.Control.ArgParser
    argParserClass: OpenLayers.Control.ArgParserCookies, 

	// Enregistre les paramètres de la carte dans des cookies à chaque changement de lat lon zoom & layer
    createParams: function(center, zoom, layers) {
		var params = OpenLayers.Control.Permalink.prototype.createParams.apply (this, arguments);
		
		if (this.map.baseLayer) {
			// Ajoute un paramètre d'échelle qui permet de retrouver la bonne échèle quelque soit le nombre de couches de la carte
			params.scale = 
				Math.round (
					OpenLayers.Util.getScaleFromResolution (
						this.map.baseLayer.resolutions[this.map.zoom], 
						this.map.baseLayer.units
					)
				);
			// Ajoute le nom de la couche de base, en clair (si la page suivante n'a pas la même liste de couches)
			params.baseLayer = this.map.baseLayer.name; // La dernière base utilisée
		}

		// En plus d'afficher un permalink, l'enregistre dans un cookie
		OpenLayers.Util.writeCookie (
			'params', 
			OpenLayers.Util.getParameterString (params)
		);
		
		return params;
    },

    CLASS_NAME: "OpenLayers.Control.PermalinkCookies"
});

