<?php

$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: filename=points.gml");
header("Content-Type: text/xml; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
header("Pragma: cache");
header("Expires: $ts");
if($config['autoriser_CORS']===TRUE) header("Access-Control-Allow-Origin: *");
header("Cache-Control: max-age=$secondes_de_cache");

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<wfs:FeatureCollection
	xmlns:wfs=\"http://www.opengis.net/wfs\"
	xmlns:gml=\"http://www.opengis.net/gml\"
	xmlns:topp=\"http://www.openplans.org/topp\">
	<name>points.gml</name>
	<description>$config[copyright_API]</description>\r\n";

foreach ($pts as $pt) {
	$pt_lien = new stdClass();
	$pt_lien->id_point = $pt->id;
	$pt_lien->nom_type = $pt->type['valeur'];
	$pt_lien->nom = $pt->nom;
	$pt->lien = lien_point($pt_lien);

	unset($pt_lien);
	echo "	<gml:featureMember>
		<point_wri>
			<nom>".$pt->nom."</nom>
			<type>".$pt->type['valeur']."</type>
			<url>".$pt->lien."</url>
			<altitude>".$pt->coord['alt']."</altitude>
			<gml:Point>
				<gml:coordinates decimal=\".\" cs=\",\" ts=\" \">".$pt->coord['long'].",".$pt->coord['lat']."</gml:coordinates>
			</gml:Point>
		</point_wri>
	</gml:featureMember>\r\n";
}

echo "</wfs:FeatureCollection>"

?>