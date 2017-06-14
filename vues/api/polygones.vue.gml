<?php

$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: filename=polygones.gml");
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

foreach ($polygones as $polygone) {
	echo "	<gml:featureMember>
		<polygone_wri>
			<nom>".$polygone->nom."</nom>
			<type>".$polygone->type['id']."</type>
			<id>".$polygone->id."</id>
			<partitif>".$polygone->partitif."</partitif>
			<bbox>".$polygone->bbox."</bbox>
			<lien>".$polygone->lien."</lien>
			<couleur>".$polygone->couleur."</couleur>
			".$polygone->geometrie."
		</polygone_wri>
	</gml:featureMember>\r\n";
}

echo "</wfs:FeatureCollection>"

?>
