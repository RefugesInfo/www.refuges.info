/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the full text of the license.
 * DCM++ FROM: http://fredj.github.com/openlayers-fullscreen/examples/fullscreen.html
 * Nécéssite quelques ajouts dans theme/default/styles.css
 */

/**
 * @requires OpenLayers/Control.js
 * @requires OpenLayers/Control/Panel.js
 */

/**
 * Class: OpenLayers.Control.FullScreen 
 * Create a control to switch a map to full screen mode
 *
 * Inherits from:
 *  - <OpenLayers.Control>
 */

OpenLayers.Control.FullScreen = OpenLayers.Class(OpenLayers.Control, {

    /** 
     * APIProperty: type 
     * {Number} Controls can have a 'type'. The type determines the type of
     * interactions which are possible with them when they are placed in an
     * <OpenLayers.Control.Panel>. 
     */
    type: OpenLayers.Control.TYPE_TOGGLE,

    /** 
     * Method: setMap
     * Set the map property for the control. This is done through an accessor
     * so that subclasses can override this and take special action once 
     * they have their map variable set. 
     *
     * Parameters:
     * map - {<OpenLayers.Map>} 
     */
    setMap: function(map) {
        OpenLayers.Control.prototype.setMap.apply(this, arguments);

        // handle 'Esc' key press
        OpenLayers.Event.observe(document, "fullscreenchange", OpenLayers.Function.bind(function() {
            if (!document.fullscreenEnabled) {
                this.deactivate();
            }
        }, this));
    },

    /**
     * APIMethod: activate
     * Explicitly activates a control and it's associated
     * handler if one has been set.  Controls can be
     * deactivated by calling the deactivate() method.
     * 
     * Returns:
     * {Boolean}  True if the control was successfully activated or
     *            false if the control was already active.
     */
    activate: function() {
        if (OpenLayers.Control.prototype.activate.apply(this, arguments)) {
			var divs = document.getElementsByTagName('div');
			for (var i in divs)
				if (divs[i].className == 'olMap')
					OpenLayers.Element.addClass (
						divs[i], 
						divs[i].id == this.map.div.id
							? 'fullscreen'
							: 'offscreen'
					);
			document.getElementsByTagName('body')[0].style.overflow= 'hidden';
			this.map.updateSize();
            return true;
        } else {
            return false;
        }
    },

    /**
     * APIMethod: deactivate
     * Deactivates a control and it's associated handler if any.  The exact
     * effect of this depends on the control itself.
     * 
     * Returns:
     * {Boolean} True if the control was effectively deactivated or false
     *           if the control was already inactive.
     */
    deactivate: function() {
        if (OpenLayers.Control.prototype.deactivate.apply(this, arguments)) {
			var divs = document.getElementsByTagName('div');
			for (var i in divs)
				OpenLayers.Element.removeClass (divs[i], 'offscreen');

            OpenLayers.Element.removeClass(this.map.div, 'fullscreen');
			document.getElementsByTagName('body')[0].style.overflow= 'auto';
            this.map.updateSize();
            return true;
        } else {
            return false;
        }
    },

    CLASS_NAME: "OpenLayers.Control.FullScreen"
});


/**
 * Class: OpenLayers.Control.FullScreenPanel 
 * Create the panel to handle OpenLayers.Control.FullScreen
 *
 * Inherits from:
 *  - <OpenLayers.Control.Panel>
 */

OpenLayers.Control.FullScreenPanel = OpenLayers.Class(OpenLayers.Control.Panel, {

    /**
     * Property: displayClass
     * {Sting} class to display the panel
     */
	displayClass: 'olControlFullScreenPanel',

    /**
     * Constructor: OpenLayers.Control.Panel
     * Create a new control panel.
     */
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
