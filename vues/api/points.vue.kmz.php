<?php

header("Content-disposition: filename=points-refuges-info.$req->format");
header("Content-Type: application/vnd.google-earth.$req->format; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");

include($config_wri['chemin_vues'].'/api/points.vue.kml');

$zip = new zipfile() ; //on crée un fichier zip
$zip->addfile($kml, "points.kml") ; //on ajoute le fichier
$kmz = $zip->file() ; //on associe l'archive
echo $kmz;
}
