<?php
if (empty($filename))
  $filename="points-refuges-info";

header("Content-disposition: filename=$filename.json");
header("Content-Type: application/json; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();
headers_cache_api();

$features = [];
foreach ($points as $id => $p)
  $features[] =  [
    "type" => "Feature",
    "id" => intval($id),
    "geometry" => json_decode($points_geojson[$id]["geojson"]),
    "properties" => $p,
  ];

echo json_encode([
  "type" => "FeatureCollection",
  "generator" => "Refuges.info API",
  "copyright" => $config_wri['copyright_API'],
  "timestamp" => date(DATE_ATOM),
  "size" => count((array)$points),
  "features" => $features, 
]);
