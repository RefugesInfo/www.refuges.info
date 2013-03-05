/*DCM++ © Dominique Cavailhez 2012.
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/VectorClickHover.js
 */

/**
 * Class: OpenLayers.Layer.GMLSLD
 * Create a vector layer by parsing a GML file & a SLD stylesheet.
 *
 * Inherits from:
 *  - <OpenLayers.Layer.VectorClickHover>
 */

OpenLayers.Layer.GMLSLD = OpenLayers.Class (OpenLayers.Layer.VectorClickHover, {

	layers: [], // Les couches en attente de style
	sldFiles: [], // Les feuilles de styles déjà arrivées
	bbBoxRatio: 1, // On va demander seulement les points situés dans la zone affichée pour optimiser le nb de points visibles

    initialize: function (name, options) {
		OpenLayers.Util.extend (this, options);
		
		// Télécharge le style (1 seule fois pour toutes les couches qui ont le même style)
		if (OpenLayers.Layer.GMLSLD.prototype.layers[options.urlSLD] == undefined) { // Est ce que c'est la première fois pour ce SLD ?
			OpenLayers.Layer.GMLSLD.prototype.layers[options.urlSLD] = [];
			
			OpenLayers.Request.GET({
				url: options.urlSLD, 
				scope: this, 
				success: function (sldFile) { // Le fichier est chargé
					// On stocke la feuille de style pour les couches qui seront déclarées plus tard
					OpenLayers.Layer.GMLSLD.prototype.sldFiles[options.urlSLD] = sldFile;
					
					// On applique ce SLD à toutes les couches GMLSLD déjà initialisées
					var layers = OpenLayers.Layer.GMLSLD.prototype.layers[options.urlSLD];
					for (i in layers)
						layers[i].setStyle (sldFile); // On réaffiche avec le bon style
				}, 
				failure: function () { // onFailure
					alert ('Echec chargement de la feuille de style SLD ' + options.urlSLD);
				}
			});
		}

        OpenLayers.Layer.Vector.prototype.initialize.call (this, name, 
			OpenLayers.Util.extend (options, {
				protocol: new OpenLayers.Protocol.HTTP ({
					url: this.urlGML,
					format: new OpenLayers.Format.GML ()                               
				}),
				strategies: [new OpenLayers.Strategy.BBOX ({ // new OpenLayers.Strategy.Fixed () 
					ratio: this.bbBoxRatio,
					resFactor: 1 // Une demande sera effectuée au serveur pour chaque déplacement ou zoom de afficheur, sinon on n'ajoute pas de point quand on zoom in
				})]
			})
		);
		
		if (OpenLayers.Layer.GMLSLD.prototype.sldFiles[options.urlSLD]) // Est ce qu'on à déjà cette feuille de style ?
			this.setStyle (sldFile); // On affiche directement avec le bon style
		else
			OpenLayers.Layer.GMLSLD.prototype.layers[options.urlSLD].push (this); // On mémorise la couche pour lui appliquer le style plus tard
    },
	
    setStyle: function (sldFile) { // On a reçu le style
		var format = // Extrait les styles du fichier SLD.
			new OpenLayers.Format.SLD ()
			.read (sldFile.responseXML || sldFile.responseText) 
			.namedLayers [this.styleName];
		var style = new Array ();
		if (typeof format == 'object' && // Teste l'existence des balises à chaque niveau pour éviter de planter
			typeof format.userStyles == 'object')
				for (i in format .userStyles)
					if (typeof format .userStyles [i] == 'object') // DCM 10/04/2011 plus sécure et compatible mootools
						style [format .userStyles [i].name] = 
							format .userStyles [i];
							
		this.styleMap = new OpenLayers.StyleMap (style); // On met le style à jour
		this.redraw (); // Et on réaffiche parceque ça ne marche pas à chaque fois // DCM TODO : éviter de demander 2 fois les couches au serveur
    },
	
    CLASS_NAME: "OpenLayers.Layer.GMLSLD"
});
