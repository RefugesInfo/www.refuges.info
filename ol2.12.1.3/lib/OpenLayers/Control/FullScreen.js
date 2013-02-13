/* Copyright (c) 2011-2012 by OpenLayers Contributors (see authors.txt for
 * full list of contributors). Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * DCM++ FROM: http://fredj.github.com/openlayers-fullscreen/examples/fullscreen.html
 * Nécéssite quelques ajours dans theme/default/styles.css
 * full text of the license. */

/**
 * @requires OpenLayers/Control.js
 */

OpenLayers.Control.FullScreen = OpenLayers.Class(OpenLayers.Control, {

    type: OpenLayers.Control.TYPE_TOGGLE,

    fullscreenClass: 'fullscreen',

    setMap: function(map) {
        OpenLayers.Control.prototype.setMap.apply(this, arguments);

        // handle 'Esc' key press
        OpenLayers.Event.observe(document, "fullscreenchange", OpenLayers.Function.bind(function() {
            if (!document.fullscreenEnabled) {
                this.deactivate();
            }
        }, this));
    },

    activate: function() {
        if (OpenLayers.Control.prototype.activate.apply(this, arguments)) {
			var divs = document.getElementsByTagName('div');
			for (var i in divs)
				if (divs[i].className &&
					divs[i].className.indexOf ('olMap') !=-1)
					OpenLayers.Element.addClass (
						divs[i], 
						divs[i].id == this.map.div.id
							? this.fullscreenClass
							: 'offscreen'
					);
			this.map.updateSize();
            return true;
        } else {
            return false;
        }
    },

    deactivate: function() {
        if (OpenLayers.Control.prototype.deactivate.apply(this, arguments)) {
			var divs = document.getElementsByTagName('div');
			for (var i in divs)
				OpenLayers.Element.removeClass (divs[i], 'offscreen');

            OpenLayers.Element.removeClass(this.map.div, this.fullscreenClass);
            this.map.updateSize();
            return true;
        } else {
            return false;
        }
    },

    CLASS_NAME: "OpenLayers.Control.FullScreen"
});


OpenLayers.Control.FullScreenPanel = OpenLayers.Class(OpenLayers.Control.Panel, {

	displayClass: 'olControlFullScreenPanel',

    initialize: function(options) {
        OpenLayers.Control.Panel.prototype.initialize.apply(this, arguments);
		
		this.addControls([
			new OpenLayers.Control.FullScreen({
				title: OpenLayers.i18n('fullScreen')
			})
		]);
    },

    CLASS_NAME: "OpenLayers.Control.FullScreenPanel"
});
