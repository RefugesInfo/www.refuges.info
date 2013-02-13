/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license. */

/**
 * @requires OpenLayers/Control/DrawFeature.js
 */

/**
 * Class: OpenLayers.Control.DrawFeature
 * Create an instance of OpenLayers.Control.DrawFeature that
 * fusionne si l'une des extémités de la ligne ajoutée correspond à l'une des extémités d'une autre ligne
 * Inherits from:
 *  - <OpenLayers.Control.DrawFeature>
 */

OpenLayers.Control.DrawFeatureExtended = OpenLayers.Class(OpenLayers.Control.DrawFeature, {

    initialize: function(layer, handler, options) {
		// Met la création de ligne aux mêmes couleurs que le reste
		OpenLayers.Handler.Path.prototype.style = OpenLayers.Feature.Vector.style['default']; 

		OpenLayers.Control.DrawFeature.prototype.initialize.apply (this, arguments);
	},
	
    drawFeature: function(geometry) {
		// On mémorise les lignes de la couche car quand on va en enlever une, on décalera tout
		var layer_features = [];
		for (i in this.layer.features)
			layer_features [i] = this.layer.features [i];
			
		for (i in layer_features) {
			var vertices_i = layer_features[i].geometry.getVertices(); // Chacune des lignes
			if (vertices_i.length > 1) { // Du moins s'il y a 2 points ou plus
				var vertices = geometry.getVertices(); // La ligne ajoutée // On recalcule à chaque fois dés fois qu'il y en aurait plusieur à ajouter
				
				if (vertices_i[0] .equals (vertices[0])) { // Si le premier point de la nouvelle ligne est = au premier d'une autre
					for (j in vertices_i)
						if (j) // On n'ajoute pas le premier, puisqu'il est = à un point existant de la nouvelle ligne
							geometry.addComponent (vertices_i[j], 0); // On ajoute les points de l'autre ligne en tête de la nouvelle
					layer_features[i].destroy(); // Et on détruit l'autre ligne puisqu'on l'a absorbée
				}
				else if (vertices_i[0] .equals (vertices[vertices.length-1])) {
					for (j in vertices_i)
						if (j) // Sauf 1
							geometry.addComponent (vertices_i[vertices_i.length - j], vertices.length); // Ajout à la fin
					layer_features[i].destroy();
				}
				else if (vertices_i[vertices_i.length-1] .equals (vertices[0])) {
					for (j in vertices_i)
						if (j)
							geometry.addComponent (vertices_i[vertices_i.length-1 - j], 0);
					layer_features[i].destroy();
				}
				else if (vertices_i[vertices_i.length-1] .equals (vertices[vertices.length-1])) {
					for (j in vertices_i)
						if (j)
							geometry.addComponent (vertices_i[j], vertices.length);
					layer_features[i].destroy();
				}
			}
		}
        OpenLayers.Control.DrawFeature.prototype.drawFeature.apply (this, arguments);
    },
    CLASS_NAME: "OpenLayers.Control.DrawFeatureExtended"
});
