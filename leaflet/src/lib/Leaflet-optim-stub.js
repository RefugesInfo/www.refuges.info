/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Missing declaration due to Leaflet build optimisation
 */

L.Marker.include({
	closePopup: function(){return this}
});
L.Rectangle = L.Polygon.extend({});
L.Draw.Rectangle = L.Class.extend({});
L.Draw.Circle = L.Class.extend({});
L.drawLocal = {
	edit:{
		handlers: {},
		toolbar: {
			buttons: {}		
		}
	}
}
