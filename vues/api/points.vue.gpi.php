<?php 
/*
FIXME : sly 05/12/2019 a tester, je ne sais même s'il marche toujours tant il y a peu de personne qui passe par cette manière de mettre des points dans un garmin.
Il faudrait que je sorte le mien du placard pour voir si ça fonctionne encore.
Si on décide de le garder, on pourrait factoriser avec le code dans points.vue.gpx par un usage sioux d'un ob_start(); $gpx=ob_get_clean();
*/
header("Content-disposition: filename=points-refuges-info.$req->format");
header("Content-Type: application/binary");
header("Content-Transfer-Encoding: binary");

$gpx = "<?xml version=\"1.1\" encoding=\"UTF-8\" standalone=\"no\"?>
<gpx xmlns=\"http://www.topografix.com/GPX/1/1\" creator=\"refuges.info\" version=\"1.1\" 
    xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
    xsi:schemaLocation=\"http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd\">
<metadata>
	<name>points.gpx</name>
	<desc>".$config_wri['copyright_API']."</desc>
	<author>
		<name>Contributeurs refuges.info</name>
	</author>
	<copyright author=\"Contributeurs refuges.info\">
		<year>2014</year>
		<license>http://creativecommons.org/licenses/by-sa/2.0/deed.fr</license>
	</copyright>
	<link href=\"https://".$config_wri['nom_hote']."/\">
		<text>https://".$config_wri['nom_hote']."/</text>
		<type>text/html</type>
	</link>
</metadata>\r\n";


foreach ($points AS $point) {
	$gpx .= "<wpt lat=\"".$point->coord['lat']."\" lon=\"".$point->coord['long']."\">\r\n";
	$gpx .= "	<ele>".$point->coord['alt']."</ele>\r\n";
	$gpx .= "	<name>".$point->nom."</name>\r\n";
	$gpx .= "	<sym>".$point->sym."</sym>\r\n";
	$gpx .= "	<type>".$point->type['valeur']."</type>\r\n";
		
	if ($req->detail == "complet" or $req->detail == "garmin" ) {
		$gpx .= "	<desc>".$point->acces['nom']." : ".htmlspecialchars($point->acces['valeur'])."</desc>\r\n";
		$gpx .= "	<cmt>".$point->remarque['nom']." : ".htmlspecialchars($point->remarque['valeur'])."</cmt>\r\n";
		if ($req->detail == "complet")
		  $gpx .= "	<src>".$point->coord['precision']['nom']."</src>\r\n";
		$gpx .= "	<link href=\"$point->lien\">\r\n";
		$gpx .= "		<text>$point->nom sur ".$config_wri['nom_hote']."</text>\r\n";
		$gpx .= "		<type>text/html</type>\r\n";
		$gpx .= "	</link>\r\n";
	}
	$gpx .= "</wpt>\r\n";
}

$gpx .= "</gpx>";


if ($req->format=="gpi")
{
	// On va éviter de passer par un fichier local car c'est une plaie pour plusieurs raisons
	$descriptorspec = array(
		0 => array("pipe", "r"), // stdin is a pipe that the child will read from
		1 => array("pipe", "w"), // stdout is a pipe that the child will write to
	);
	$process = proc_open("gpsbabel -w -r -t -i gpx -f - -o garmin_gpi -F -", $descriptorspec, $pipes);
	// On lui passe en entré notre gpx
	fwrite($pipes[0], $gpx);
	fclose($pipes[0]);
	$gpi=stream_get_contents($pipes[1]);
	fclose($pipes[1]);

	echo $gpi;
}
else {
	echo $gpx;
}

