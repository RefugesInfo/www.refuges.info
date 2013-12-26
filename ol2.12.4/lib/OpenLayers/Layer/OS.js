/*DCM++ © Dominique Cavailhez 2012
 * Copyright (c) 2006-2012 by OpenLayers Contributors (see authors.txt for 
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMS.js
 * @requires OpenLayers/BaseTypes/Bounds.js
 * @requires OpenLayers/Projection.js
 * @requires OpenLayers/BaseTypes/Size.js
 * @requires ../proj4js-1.1.0/lib/proj4js-combined.js
 * @requires ../proj4js-1.1.0/lib/defs/EPSG27700.js
 */

/**
 * Class: OpenLayers.Layer.OS
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMS>
 *
 * Clé sur: https://openspace.ordnancesurvey.co.uk/osmapapi/register.do
 * Doc sur http://ordnancesurvey.co.uk/oswebsite/web-services/os-openspace/api/index.html
 * UK Ordonance Survey require the 'attribution', or copyright message, in their T&C for using the service.
 */
OpenLayers.Layer.OS = OpenLayers.Class(OpenLayers.Layer.WMS, {
	
    /**
     * Constructor: OpenLayers.Layer.OS
     * Create a new OS layer.
     */
	initialize:	function (name, key, options) {
		if (typeof Proj4js != 'object')
			alert ('ERROR: This map needs to include proj4js-combined.js');

		OpenLayers.Layer.WMS.prototype.initialize.apply (
			this,
			[
				name,
				'http://openspace.ordnancesurvey.co.uk/osmapapi/ts',
				{
					format:'image/png', 
					key:key,
					url:document.URL
				},
				OpenLayers.Util.extend (
					options,
					{
						projection:		new OpenLayers.Projection( "EPSG:27700" ),
						maxExtent:		new OpenLayers.Bounds( 0, 0, 800000, 1300000 ),
						resolutions:	new Array( 2500, 1000, 500, 200, 100, 50, 25, 10, 5, 2, 1 ),
						tile200:		new OpenLayers.Size( 200, 200 ),
						tile250:		new OpenLayers.Size( 250, 250 ),
						attribution:
							'<a href="http://footpathmaps.com" title="Access Ordonance Survey footpath maps">'+
								'<img src="http://oscompass.com/images/os.gif" />'+
							'</a> '+
							'<a style="position:relative;bottom:11px;"'+
								' title="End User Licence Agreement"'+
								' href="http://openspace.ordnancesurvey.co.uk/openspace/developeragreement.html#enduserlicense">'+
								'&copy; Crown copyright and database rights 2012 Ordonance Survey.'+
							'</a>'
					}
				)
			]
		);
	},
	
    /**
     * Method: moveTo
     * 
     * Parameters:
     * bounds - {<OpenLayers.Bounds>}
     * zoomChanged - {Boolean} Tells when zoom has changed, as layers have to
     *     do some init work in that case.
     * dragging - {Boolean}
     */
	moveTo: function( bounds, zoomChanged, dragging ) {
		if( zoomChanged ) {
			var	resolution = this.getResolution();
			var	oTileSize = this.tileSize;
			this.setTileSize( resolution < 5 ? this.tile250 : this.tile200 );
			if( this.tileSize != oTileSize )
				this.clearGrid();
			this.params = OpenLayers.Util.extend( this.params, OpenLayers.Util.upperCaseObject({'layers':resolution}) );
		}
		OpenLayers.Layer.WMS.prototype.moveTo.apply( this, arguments );
	},

	CLASS_NAME:	'OpenLayers.Layer.OS '
});
