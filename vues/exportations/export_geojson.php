<?php
$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: attachment; filename=point_$vue->id_point.geojson");
header("Content-Type: application/javascript; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
header("Pragma: cache");
header("Expires: $ts");
header("Access-Control-Allow-Origin: *");
header("Cache-Control: max-age=$secondes_de_cache");
?>
<?if ($vue->features) 
	foreach ($vue->features as $feature) { ?>
		{
			type: "Feature",
			<?if ($feature->proprietes) {?>
				properties: {
					<?foreach ($feature->proprietes as $clef => $valeur) { ?>
						<?=$clef?>: "<?=$valeur?>",
					<?}?>
				},
			<?}?>
			geometry: {
				type: "Polygon",
				coordinates: [[<?=$feature->geometrie_geojson?>]]
			}
		},
	<?}?>
