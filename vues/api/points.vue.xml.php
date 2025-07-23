<?php
// 2025-07-23 sly : même question que pour le gml, y'a encore des gens qui s'en servent ? Alors certes, c'est pas un code de fou ici, mais on dépend de la classe xml qui finira bien un jour par ne plus marcher. Ménage ?
if (empty($filename))
  $filename="points-refuges-info";
header("Content-disposition: filename=$filename.xml");
header("Content-Type: application/xml; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();

include("xml.class.php");

$xmlOutput = new XMLSerializer;
$points->copyright = $config_wri['copyright_API'];
echo $xmlOutput->generateValidXmlFromObj($points);


