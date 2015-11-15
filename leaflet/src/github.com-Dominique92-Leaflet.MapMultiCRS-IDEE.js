/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Spanish maps
 * Instances of the WMS class allow viewing maps of Infraestructura de Datos Espaciales de España
 * (c) http://www.idee.es
 */

L.TileLayer.WMS.IDEE = L.TileLayer.WMS.extend({
    options: {
        url: 'http://www.idee.es/wms/MTN-Raster/MTN-Raster',
        layer: 'mtn_rasterizado',
        attribution: '&copy; <a href="http://www.idee.es/">IDEE</a>'
    },

    initialize: function(options) {
        L.setOptions(this, options);
        L.TileLayer.WMS.prototype.initialize.call(this,
            this.options.url, {
                layers: this.options.layer,
                attribution: this.options.attribution
            }
        );
    }
});

L.TileLayer.WMS.IDEE.Photo = L.TileLayer.WMS.IDEE.extend({
    options: {
        url: 'http://www.ign.es/wms-inspire/pnoa-ma',
        layer: 'OI.OrthoimageCoverage',
        attribution: '&copy; <a href="http://www.ign.es/PNOA/">PNOA</a>'
    }
});