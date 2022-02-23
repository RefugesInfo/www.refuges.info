<?php

header("Content-disposition: filename=polygones.json");
header("Content-Type: application/json; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cache_api();
headers_cors_par_default();
?>
{
  "type": "FeatureCollection",
  "generator": "Refuges.info API",
  "copyright": "<?=$config_wri['copyright_API']?>",
  "timestamp": "<?=date(DATE_ATOM)?>",
  "features": 
  [
<?php
$j = 0;
foreach ($polygones as $polygone) 
{
  $j++;
?>
    {
      "type": "Feature",
      "id": <?=$polygone->id?>,
      "geometry": <?=$polygone->geometrie?>,
      "properties":
      <?php unset ($polygone->geometrie); ?>
      <?=json_encode($polygone)?>
      
    }
<?php
	if ($j != $nombre_polygones) echo ",";
}
?>
  ]
}
