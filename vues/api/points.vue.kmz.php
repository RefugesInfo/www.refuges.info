<?php

$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: filename=points-refuges-info.$req->format");
header("Content-Type: application/vnd.google-earth.$req->format; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
header("Pragma: cache");
header("Expires: $ts");
if($config_wri['autoriser_CORS']===TRUE) header("Access-Control-Allow-Origin: *");
  header("Cache-Control: max-age=$secondes_de_cache");

include($config_wri['chemin_vues'].'/api/points.vue.kml');

$zip = new zipfile() ; //on crée un fichier zip
$zip->addfile($kml, "points.kml") ; //on ajoute le fichier
$kmz = $zip->file() ; //on associe l'archive
echo $kmz;
}
