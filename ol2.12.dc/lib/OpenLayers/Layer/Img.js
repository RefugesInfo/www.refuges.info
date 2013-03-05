/*DCM++ © Dominique Cavailhez 2012.
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/Vector.js
 */

/**
 * Class: OpenLayers.Layer.Img
 * Create a vector layer containing one image
 *
 * Inherits from:
 *  - <OpenLayers.Layer.Vector>
 */

OpenLayers.Layer.Img = OpenLayers.Class (OpenLayers.Layer.Vector, {

    initialize: function (name, options) {
		OpenLayers.Util.extend (this, options); // Mémorise les options
        OpenLayers.Layer.Vector.prototype.initialize.apply (this, arguments); // Initialise la classe héritée
	},

	setMap: function  (map) {
        OpenLayers.Layer.Vector.prototype.setMap.apply (this, arguments);
		
		// pos = option donnée en projection courante de la carte | en options.proj
		if (this.proj)
			this.pos = this.pos.transform ( // qu'on ramène en projection courante de la carte
				this.proj,
				map.getProjectionObject ()
			);
		
		// On insère l'image
		this.addFeatures (new OpenLayers.Feature.Vector (
			new OpenLayers.Geometry.Point (this.pos.lon, this.pos.lat),
			null,
			{
				externalGraphic: this.img, 
				graphicHeight: this.h,
				graphicWidth: this.l
			}
		));
		
		this.position = this.pos.transform ( // this.position en degminsec (on doit le figer là car la projection de la carte peut changer)
			map.getProjectionObject (),
			'EPSG:4326');
    },

	// Change la position du curseur
	setPosition: function  (ll) { // ll en degrés décimaux
		this.features[0].move (new OpenLayers.LonLat (0,0)); // Il faut repartir de 0
		this.features[0].move (ll.clone().transform (
			this.map.displayProjection, // Transforme les coordonnées de travail (celles de la première carte)
			this.map.getProjectionObject () // En celles courantes sur le site
		));
	},

	// Donne la position du curseur
	getPosition: function  () {
		var xy = this.features[0].geometry;
		var ll = new OpenLayers.LonLat (xy.x, xy.y);
		return ll.transform (
			this.map.getProjectionObject (),
			this.map.displayProjection
		);
	},

    CLASS_NAME: "OpenLayers.Layer.Img"
});
