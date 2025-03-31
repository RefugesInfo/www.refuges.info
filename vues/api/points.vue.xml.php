<?php

header("Content-disposition: filename=points-refuges-info.xml");
header("Content-Type: application/xml; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();

include("xml.class.php");

$xmlOutput = new XMLSerializer;
$points->copyright = $config_wri['copyright_API'];
echo $xmlOutput->generateValidXmlFromObj($points);


