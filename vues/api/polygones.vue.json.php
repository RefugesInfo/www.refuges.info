<?php

$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: filename=polygones.json");
header("Content-Type: application/json; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
header("Pragma: cache");
header("Expires: $ts");
headers_cors_par_default();
header("Cache-Control: max-age=$secondes_de_cache");
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
