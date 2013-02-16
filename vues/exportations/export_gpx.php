<?php
	header("Content-disposition: attachment; filename='$nom_fichier_export.gpx");
	header("Content-Type: text/xml; charset=$modele->content_type");
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<?='<?'?>xml version="1.0" encoding="<?php$modele->content_type?>" standalone="no"?>
<gpx
 xmlns="http://www.topografix.com/GPX/1/1"
 creator="refuges.info"
 version="1.1"
 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 xsi:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd"
>
	<metadata>
		<name><?=$nom_fichier_export?>.gpx</name>
		<desc><?=$description?></desc>
		<author>
			<name>Contributeurs refuges.info</name>
		</author>
		<copyright author="Contributeurs refuges.info">
			<year>2002</year>
			<license>http://creativecommons.org/licenses/by-sa/2.0/deed.fr</license>
		</copyright>
		<link href="http://<?=$config['nom_hote']?>/">
			<text>http://<?=$config['nom_hote']?>/</text>
			<type>text/html</type>
		</link>
	</metadata>

	<?if ($poi) foreach ($poi AS $type) foreach ($type AS $point) {?>
		<wpt lat="<?=$point->latitude?>" lon="<?=$point->longitude?>">
			<ele><?=$point->altitude?></ele>
			<name><?=$point->nom?></name>
			<cmt>Acces : <?=$point->acces?></cmt>
			<desc><?=$point->remark?></desc>
			
			<?if (!$simple) {?>
				<src><?=$point->nom_precision_gps?></src>
				<link href="<?=$point->url?>">
					<text><?=$point->nom?> sur <?=$config['nom_hote']?></text>
					<type>text/html</type>
				</link>
				<type><?=$point->nom_type?></type>
				<extensions>
					<id_point><?=$point->id_point?></id_point>
					<massif><?=$point->nom_massif?></massif>
					<id_massif><?=$point->id_massif?></id_massif>
					<id_qualite_gps><?=$point->id_type_precision_gps?></id_qualite_gps>
					<nombre_place><?=$point->places?></nombre_place>
					<renseignements></renseignements>
					<id_type_point><?=$point->id_point_type?></id_type_point>
				</extensions>
			<?}?>
		</wpt>
	<?}?>

</gpx>