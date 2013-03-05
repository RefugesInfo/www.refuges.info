/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * full text of the license. */

/** 
 * @requires OpenLayers/Control/LayerSwitcher.js
 * @requires OpenLayers/Control.js
 * @requires OpenLayers/Lang.js
 * @requires Rico/Corner.js
 */

/**
 * Class: OpenLayers.Control.LayerSwitcherConditional
 * The same than LayerSwitcher control but disable & gray out of bounds & zoom layers checkboxes
 * 
 * Inherits from:
 *  - <OpenLayers.Control.LayerSwitcher>
 */
 
OpenLayers.Control.LayerSwitcherConditional =
  OpenLayers.Class(OpenLayers.Control.LayerSwitcher, {
  
    setMap: function(map) {
        OpenLayers.Control.LayerSwitcher.prototype.setMap.apply(this, arguments);

		this.map.events.on({ // Pour recalculer les contrôles à chaque fois que quelque chose change
			buttonclick: this.greySwitcher, // N'importe quoi qui clique (y compris l'ouverture du pavé des couches)
			moveend:     this.greySwitcher, // Un zoom par molette par exemple (ou le setCenter initial)
			scope:       this
		});
    },

	greySwitcher: function() {
		this.div.className = 'olControlLayerSwitcher olControlNoSelect'; // Pour récupérer les styles du contrôle d'origine
		
		var mapext = this.map.getExtent();
		if (!mapext) return;

		var refprj = new OpenLayers.Projection ('EPSG:4326'); // DC TODO Curieusement, ça ne marche pas si on ne ramène pas à EPSG:4326
		var mapprj = this.map.getProjectionObject();
		mapext = mapext.transform (mapprj, refprj);

		for (var i=0, len=this.baseLayers.length; i<len; i++) {
			var layerEntry = this.baseLayers[i];
			var inRange = layerEntry.layer.calculateInRange();
			
			var layprj = layerEntry.layer.projection;
			var layext = layerEntry.layer.maxExtent.clone(); // Clone, pour que transform ne transforme pas la variable du layer !!!
			layext = layext.transform (layprj, refprj);
			var contains = layext.containsBounds (mapext);

			if ((contains && inRange) || layerEntry.layer == this.map.baseLayer) {
				layerEntry.inputElem.disabled = false;
				layerEntry.labelSpan.style.color =
				layerEntry.inputElem.title =
				layerEntry.labelSpan.title = '';
			} else {
				layerEntry.inputElem.disabled = true;
				layerEntry.labelSpan.style.color = 'gray';
				layerEntry.inputElem.title =
				layerEntry.labelSpan.title = 'Couche non disponible ' + (
					contains
						? 'à cette échelle'
						: 'sur cette zone'
				);
			}
		}
	},
	
	CLASS_NAME: "OpenLayers.Control.LayerSwitcherConditional"
});
