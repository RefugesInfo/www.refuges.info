<?php
	header("Content-disposition: attachment; filename='$modele->nom_fichier_export.kml");
	header("Content-Type: text/xml; charset=$modele->content_type");
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<?='<?'?>xml version="1.0" encoding="<?php$modele->content_type?>"?>
<kml xmlns="http://earth.google.com/kml/2.1">
<Document>
	<name><?=$modele->nom_fichier_export?>.kml</name>
	<description><?=$modele->description?></description>
	
	<!-- Liste des Styles -->
	<open>1</open>
	<?if ($modele->pois) foreach ($modele->pois AS $type => $t) {?>
		<Style id='icone_<?=$type?>'>
			<IconStyle>
				<hotSpot x='0.5' y='0.5' xunits='fraction' yunits='fraction' />
				<scale>1</scale>
				<Icon>
					<href>http://<?=$config['nom_hote']?>/images/icones/<?=$type?>.png</href>
					<w>16</w>
					<h>16</h>
				</Icon>
			</IconStyle>
		</Style>
	<?}?>

	<!-- Liste des POINTS -->
	<?if ($modele->pois) foreach ($modele->pois AS $type) {?>
		<Folder><name><?=$type[0]->nom_type?></name>
		<open>0</open>
		
		<?foreach ($type AS $point) {?>
			<Placemark id='<?=$point->id_point?>'>
				<name><?=$point->nom?></name>
				<description>
					<![CDATA[
						<img src='http://<?=$config['nom_hote']?>/images/icones/<?=$point->nom_icone?>.png' />
						(<em><?=$type[0]->nom_type?></em>) <br />
						<center><a href='<?=$point->url?>'>Détails</a></center>
					]]>
				</description>
				<LookAt>
					<longitude><?=$point->longitude?></longitude>
					<latitude><?=$point->latitude?></latitude>
					<range>7200</range>
					<tilt>40</tilt>
					<heading>50</heading>
				</LookAt>
				<styleUrl>#icone_<?=$type?></styleUrl>
				<Point>
					<coordinates><?=$point->longitude?>,<?=$point->latitude?>,0</coordinates>
				</Point>
				<ExtendedData>
					<Data name="url">
					<value><?=$point->url?></value>
					</Data>
				</ExtendedData>
			</Placemark>
		<?}?>
		</Folder>
	<?}?>

</Document>
</kml>