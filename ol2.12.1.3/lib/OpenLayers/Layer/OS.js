/*DCM++ © Dominique Cavailhez 2012.
 * Published under the Clear BSD license.  
 * See http://svn.openlayers.org/trunk/openlayers/license.txt for the
 * full text of the license. */

/**
 * @requires OpenLayers/Layer/WMS.js
 * @requires proj4js-1.1.0/lib/proj4js-combined.js
 */

/**
 * Class: OpenLayers.Layer.IDEE
 * 
 * Inherits from:
 *  - <OpenLayers.Layer.WMS>
 *
 * clé sur: https://openspace.ordnancesurvey.co.uk/osmapapi/register.do
 * doc sur http://www.ordnancesurvey.co.uk/oswebsite/web-services/os-openspace/api/index.html
 */

OpenLayers.Layer.OS = OpenLayers.Class(OpenLayers.Layer.WMS, {
	//	UK Ordnance Survey require the 'attribution', or
	//	copyright message, in their T&C for using the service.
	initialize:	function (name, key, options) {
		Proj4js.defs["EPSG:27700"]	= "+proj=tmerc +lat_0=49 +lon_0=-2 +k=0.9996012717 +x_0=400000 +y_0=-100000 +ellps=airy +datum=OSGB36 +units=m +no_defs ";
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
						attribution: '&copy; Crown Copyright &amp; Database Right 2008.&nbsp; All rights reserved.<br />'
									+'<a href="http://openspace.ordnancesurvey.co.uk/openspace/developeragreement.html#enduserlicense" target="_blank"'
									+' title="openspace.ordnancesurvey.co.uk">End User License Agreement</a>',
						projection:		new OpenLayers.Projection( "EPSG:27700" ),
						maxExtent:		new OpenLayers.Bounds( 0, 0, 800000, 1300000 ),
						resolutions:	new Array( 2500, 1000, 500, 200, 100, 50, 25, 10, 5, 2, 1 ),
						tile200:		new OpenLayers.Size( 200, 200 ),
						tile250:		new OpenLayers.Size( 250, 250 )
					}
				)
			]
		);
	},

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
