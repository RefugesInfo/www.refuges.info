/*
 * Copyright (c) 2014 Dominique Cavailhez
 * https://github.com/Dominique92
 * Supported on Leaflet V0.7 & V1.0
 *
 * Spanish maps
 * Instances of the WMS class allow viewing maps of Instituto Geográfico Nacional de España
 * (c) http://www.ign.es
 *
 * Usage: new L.TileLayer.WMS.IDEE().addTo(map);
 *
 * Different layers:
	new L.TileLayer.WMS.IDEE() : Basic
	new L.TileLayer.WMS.IDEE.Photo() : Satellite
 */

L.TileLayer.WMS.IDEE = L.TileLayer.WMS.extend({
    options: {
        url: '//www.ign.es/wms-inspire/mapa-raster',
        layer: 'mtn_rasterizado',
		crs: L.CRS.EPSG3857,
		maxNativeZoom: 18,
		maxZoom: 21,
        attribution: '&copy; <a href="http://www.ign.es/">Instituto Geográfico Nacional de España</a>'
    },

    initialize: function(options) {
        L.TileLayer.WMS.prototype.initialize.call(this,
            this.options.url, {
                layers: this.options.layer,
                attribution: this.options.attribution
            },
			options
        );
    }
});

L.TileLayer.WMS.IDEE.Photo = L.TileLayer.WMS.IDEE.extend({
    options: {
        url: '//www.ign.es/wms-inspire/pnoa-ma',
        layer: 'OI.OrthoimageCoverage'
    }
});