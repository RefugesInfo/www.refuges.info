<?php
/*
sly 05/12/2019 Ce format gpx est celui qui devrait être le plus adapté à basecamp et aux logiciels qui se comporte comme lui. viking par exemple.
- les icônes spéciales garmin sont dans :  <sym><?=$point->sym?></sym> 
- <cmt> est utilisés pour les remarques d'un point, je place donc tout dans cette balise
- <src> est présente, mais je ne sais pas si c'est utilisé
- j'ai viré les extensions
*/
if (empty($filename))
  $filename="points-refuges-info";
header("Content-disposition: filename=$filename-garmin.gpx");
header("Content-Type: application/gpx+xml; UTF-8"); // rajout du charset
?>
<?='<?'?>xml version="1.0" encoding="UTF-8" standalone="no"<?='?>'?>

<gpx xmlns="http://www.topografix.com/GPX/1/1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd" creator="Export gpx pour garmin de refuges.info" version="1.1">
<metadata>
	<name>Points de refuges.info</name>
	<copyright author="Contributeurs refuges.info">
		<license>http://creativecommons.org/licenses/by-sa/2.0/deed.fr</license>
	</copyright>
	<link href="https://<?=$config_wri['nom_hote']?>" />
</metadata>

<?php foreach ($points AS $point) { ?>
<wpt lat="<?=$point->coord['lat']?>" lon="<?=$point->coord['long']?>">
  <ele><?=$point->coord['alt']?></ele>
  <name><?=htmlspecialchars($point->nom)?><?php if ($point->etat['valeur']!="") print(' ('.$point->etat['valeur'].')')?></name>
  <cmt><?=$point->type['valeur']?>
<?=htmlspecialchars($point->description['valeur'])?></cmt>
  <link href="<?=$point->lien?>" />
  <sym><?=$point->sym?></sym>
  <type><?=$point->type['valeur']?></type>
</wpt>
<?php } ?>
</gpx>
