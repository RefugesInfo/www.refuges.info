/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Missing declaration due to Leaflet build optimisation
 */

L.Rectangle      = L.Rectangle      || L.Polygon.extend({});
L.Draw.Rectangle = L.Draw.Rectangle || L.Class.extend({});
L.Draw.Circle    = L.Draw.Circle    || L.Class.extend({});

// Init no default editor toolbar
L.drawLocal = {
	edit:{
		handlers: {},
		toolbar: {
			buttons: {}		
		}
	}
}
