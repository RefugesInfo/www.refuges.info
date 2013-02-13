<?php
	header("Content-disposition: attachment; filename=$modele->nom_fichier_export.gml");
	header("Content-Type: text/xml; charset=$modele->content_type");
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<?='<?'?>xml version="1.0" encoding="<?=$modele->content_type?>"?>
<wfs:FeatureCollection
 xmlns:wfs="http://www.opengis.net/wfs"
 xmlns:gml="http://www.opengis.net/gml"
 xmlns:topp="http://www.openplans.org/topp"
>
	<name><?=$modele->nom_fichier_export?>.gml</name>
	<description><?=$modele->description?></description>
	
	<?if ($modele->pois) 
	foreach ($modele->pois as $types => $points)
	foreach ($points as $point) {?>
		<gml:featureMember>
			<point>
				<nom><?=c($point->nom)?></nom>
				<site><?=c($point->site)?></site>
				<type><?=c($point->nom_icone)?></type>
				<url><?=$point->url?></url>
				<gml:Point>
					<gml:coordinates decimal="." cs="," ts=" ">
						<?=$point->longitude?>,<?=$point->latitude?>

					</gml:coordinates>
				</gml:Point>
			</point>
		</gml:featureMember>
	<?}?>
	
	<?if ($trk) foreach ($trk AS $seg) {?>
		<gml:featureMember>
			<trk>
				<name><?=$seg['name']?></name>
				<color>
					<?echo $seg['color'] ? $seg['color'] : 'red'?>
				</color>
				<gml:LineString>
					<url><?=$seg['url']?></url>
					<gml:coordinates>
						<?foreach ($seg['trkpt'] AS $point) echo $point['lon'].','.$point['lat'].' '?>
					</gml:coordinates>
				</gml:LineString>
			</trk>
		</gml:featureMember>
	<?}?>
	
</wfs:FeatureCollection>
