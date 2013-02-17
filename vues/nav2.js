<?// Code Javascript de la page des cartes
// test de WFS, en Official OL car je ne sais pas modifier OL pour inclure les fonctions
?>

var map;
OpenLayers.ProxyHost = "/ol2.12.1.3/proxy.php?url=";




window.onload = function () {

var options = {
      controls: [
          new OpenLayers.Control.PanZoom()
      ]
 };
  map = new OpenLayers.Map('carte_nav', options);

  base = new OpenLayers.Layer.WMS( "OpenLayers WMS",
                    "http://vmap0.tiles.osgeo.org/wms/vmap0",
                    {layers: 'basic'} );
  map.addLayer(base);
  
   var wfs = new OpenLayers.Layer.Vector("points WRI", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
			version : "1.1.0",
          url: "http://yip.refuges.info/tinyows/tinyows.cgi",
          featureType: "gpspoints",
          featureNS: "http://www.tinyows.org/"
      })
  });

  map.addLayer(wfs);
 
   var wfs2 = new OpenLayers.Layer.Vector("polys WRI", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
			version : "1.1.0",
          url: "http://yip.refuges.info/tinyows/tinyows.cgi",
          featureType: "polygones",
          featureNS: "http://www.tinyows.org/"
      })
  });
  map.addLayer(wfs2);

  /*
  var world = 	new OpenLayers.Layer.Vector("Editable Features", {
      strategies: [new OpenLayers.Strategy.BBOX()],
      protocol: new OpenLayers.Protocol.WFS({
          version: "1.1.0",
          url: "http://yip.refuges.info/tinyows/tinyows.cgi",
          featureNS :  "http://www.tinyows.org/",
          featureType: "world",
          geometryName: "geom",
          schema: "http://yip.refuges.info/tinyows/tinyows.cgi?service=wfs&request=DescribeFeatureType&version=1.1.0&typename=tows:world"
		 })
	});	
  map.addLayer(world);
*/
  
 map.zoomToExtent(new OpenLayers.Bounds(-2,43,10,48));

 }
	