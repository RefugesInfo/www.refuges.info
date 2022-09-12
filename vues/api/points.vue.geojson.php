<?php
header("Content-disposition: filename=points.json");
header("Content-Type: application/json; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();
headers_cache_api();
?>
{
  "type": "FeatureCollection",
  "generator": "Refuges.info API",
  "copyright": "<?=$config_wri['copyright_API']?>",
  "timestamp": "<?=date(DATE_ATOM)?>",
  "size": "<?=count((array)$points)?>",
  "features": 
  [
  <?php foreach ($points as $j => $point)
  if ($points_geojson[$point->id]['geojson']) // Pour éviter un point sans poition (qui ne devrait pas arriver !)
  {
    if ($j) echo ","; // Ajoute une , entre les points sauf le premier
?> {
     "type": "Feature",
     "id": <?=$point->id?>,
     "properties": <?=json_encode($point)?>,
     "geometry": <?=$points_geojson[$point->id]['geojson']?>

    }<?php
  }
?>

  ]
}
