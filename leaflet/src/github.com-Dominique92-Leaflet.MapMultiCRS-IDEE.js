/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Spanish maps
 * Instances of the WMS class allow viewing maps of Infraestructura de Datos Espaciales de España
 * (c) http://www.idee.es
 */

L.TileLayer.WMS.IDEE = L.TileLayer.WMS.extend({

	initialize: function() {
		L.TileLayer.WMS.prototype.initialize.call(this,
			'http://www.idee.es/wms/MTN-Raster/MTN-Raster', {
				layers: 'mtn_rasterizado',
				attribution: '&copy; <a href="http://www.idee.es/">IDEE</a>'
			}
		);
	}
});

L.TileLayer.WMS.IDEE.Photo = L.TileLayer.WMS.extend({

	initialize: function() {
		L.TileLayer.WMS.prototype.initialize.call(this,
			'http://www.ign.es/wms-inspire/pnoa-ma', {
				layers: 'OI.OrthoimageCoverage',
				attribution: '&copy; <a href="http://www.ign.es/PNOA/">PNOA</a>'
			}
		);
	}
});