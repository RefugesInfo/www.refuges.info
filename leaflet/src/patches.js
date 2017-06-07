/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Various patches for known issues
 */

// Bug workaround : https://github.com/Leaflet/Leaflet/issues/3575#issuecomment-150544739
var originalInitTile = L.GridLayer.prototype._initTile;
L.GridLayer.include({
	_initTile: function(tile) {
		originalInitTile.call(this, tile);

		var tileSize = this.getTileSize();

		tile.style.width = tileSize.x + 1 + 'px';
		tile.style.height = tileSize.y + 1 + 'px';
	}
});

// Bug workaround : https://bugs.chromium.org/p/chromium/issues/detail?id=138368
L.Map.addInitHook(function(e) {
	this.on('fullscreenchange', function() {
		this.invalidateSize();
	}, this);
});

// Bug workaround : https://github.com/Leaflet/Leaflet.draw/issues/723
L.Draw.Polyline.include({
	_onTouch: function() {}
});

// Hide multiple big OS logo
L.OSOpenSpace.TileLayer.include({
	onAdd: function(map) {
		L.TileLayer.prototype.onAdd.call(this, map);
	}
});
