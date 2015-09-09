/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Tune the map height accordighly with map width (max window height)
 */

L.Map.addInitHook(function() {
	if (!this._container.offsetHeight) { // Set no height to the map <DIV> to activate MapAutoHeight
		this.autoHeight();// Execute during the init phase
		L.DomEvent['on']( // Execute when the window resize
			window, 'resize',
			this.autoHeight,
			this
		);
	}
});

L.Map.include({
	autoHeight: function() {
		this._container.style.height =
			Math.min(
				this._container.offsetWidth, // Display a square map
				window.innerHeight -20 // But not more than the window size
			) + 'px';
		this._onResize (); // Refresh Leaflet components
	}
});
