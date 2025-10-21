<?php
if (empty($filename))
  $filename="points-refuges-info";

header("Content-disposition: filename=$filename.json");
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
  "size": "<?=count((array)$commentaires)?>",
  "features":
  [<?php 
  foreach ($commentaires as $j => $com) { ?>
  {
     "type": "Feature",
     "id_point": <?=$req->id_point?>,
     "properties": <?=json_encode($com, JSON_PRETTY_PRINT)?>,

  }<?php } ?>
  ]
}
