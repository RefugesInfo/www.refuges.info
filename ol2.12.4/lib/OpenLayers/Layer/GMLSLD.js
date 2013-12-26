/*DCM++ © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/VectorClickHover.js
 * @requires OpenLayers/Protocol/HTTP.js
 * @requires OpenLayers/Format/GML.js
 * @requires OpenLayers/Strategy/BBOX.js
 * @requires OpenLayers/Format/SLD.js
 * @requires OpenLayers/Format/SLD/v1_0_0.js
 * @requires OpenLayers/StyleMap.js
 */

/**
 * Class: OpenLayers.Layer.GMLSLD
 * Create a vector layer by parsing a GML file & a SLD stylesheet.
 *
 * Inherits from:
 *  - <OpenLayers.Layer.VectorClickHover>
 */

OpenLayers.Layer.GMLSLD = OpenLayers.Class (OpenLayers.Layer.VectorClickHover, {

    /** 
     * APIProperty: bbBoxRatio
     * {Float} This specifies the ratio of the size of the visiblity of the Vector Layer features to the size of the map.
     *
     */   
    bbBoxRatio: 1, // par défaut, on va demander seulement les points situés dans la zone affichée pour optimiser le nb de points visibles

    /**
     * Constructor: OpenLayers.Layer.GMLSLD
     * Create a new GMLSLD layer
     *
     * Parameters:
     * name - {String} A name for the layer
     * options - {Object} Optional object with non-default properties to set on
     *           the layer.
     *
     * Returns:
     * {<OpenLayers.Layer.GMLSLD>} A new GMLSLD layer
     */
    initialize: function (name, options) {
        OpenLayers.Util.extend (this, options);

        OpenLayers.Request.GET ({ // Charge la feuille de style
            url: options.urlSLD,
            scope: this,
            success: function (sldFile) { // Le fichier est chargé
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
                for (i in this.features) // Et on reaffiche les features (sans recharger la couche, ce qui appelle le serveur)
                    this.drawFeature (this.features[i], this.selectStyle);
            },
            failure: function () { // onFailure
                alert ('Echec chargement de la feuille de style SLD ' + options.urlSLD);
            }
        });

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
    },

    CLASS_NAME: "OpenLayers.Layer.GMLSLD"
});
