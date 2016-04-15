/*
 * Copyright (c) 2014 Dominique Cavailhez
 * Tune the map height accordighly with map width (max window height)
 * Very important for low size mobiles
 */

L.Map.addInitHook(function() {
	if (!this._container.innerHeight) { // Set no height to the map <DIV> to activate MapAutoHeight
		this._overflow();// Execute during the init phase
		L.DomEvent['on']( // Execute when the window resize
			window, 'resize',
			this._overflow,
			this
		);
	}
});

L.Map.include({
	_overflow: function() {
		var h = Math.min(
			window.innerHeight - this._container.offsetTop, // La carte ne dépasse pas en dessous
			window.innerHeight * 0.7 - 10, // La carte n'est pas plus haute que 70% de la fenetre
			this._container.offsetWidth // La largeur
		);

		this._container.style.height = Math.max(200, h) + 'px';
		if (this._size)
			this._size.y = h; // Temporary set the map size y (to avoid bug on fitBounds)
		this._onResize (); // Refresh Leaflet components
	}
});
