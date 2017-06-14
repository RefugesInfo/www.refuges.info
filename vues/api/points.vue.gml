<?php

$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: filename=points.gml");
header("Content-Type: text/xml; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
header("Pragma: cache");
header("Expires: $ts");
if($config_wri['autoriser_CORS']===TRUE) header("Access-Control-Allow-Origin: *");
header("Cache-Control: max-age=$secondes_de_cache");

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<wfs:FeatureCollection
	xmlns:wfs=\"http://www.opengis.net/wfs\"
	xmlns:gml=\"http://www.opengis.net/gml\"
	xmlns:topp=\"http://www.openplans.org/topp\">
	<name>points.gml</name>
	<description>$config_wri[copyright_API]</description>\r\n";

foreach ($points as $point) {

echo "	<gml:featureMember>
		<point_wri>
			<nom>".$point->nom."</nom>
			<type>".$point->type['valeur']."</type>
			<icone>".$point->type['icone']."</icone>
			<url>".$point->lien."</url>
			<altitude>".$point->coord['alt']."</altitude>
			<gml:Point>
				<gml:coordinates decimal=\".\" cs=\",\" ts=\" \">".$point->coord['long'].",".$point->coord['lat']."</gml:coordinates>
			</gml:Point>
		</point_wri>
	</gml:featureMember>\r\n";
}

echo "</wfs:FeatureCollection>"

?>