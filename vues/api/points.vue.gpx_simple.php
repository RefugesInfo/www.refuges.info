<?php 
ob_clean();
header("Content-disposition: filename=points-refuges-info-simple.gpx");
header("Content-Type: application/gpx+xml; UTF-8"); // rajout du charset
?>
<?='<?'?>xml version="1.0" encoding="UTF-8" standalone="no"<?='?>'?>

<gpx xmlns="http://www.topografix.com/GPX/1/1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd" creator="Export gpx 'simple' de refuges.info" version="1.1">

<?php foreach ($points AS $point) { ?>
<wpt lat="<?=$point->coord['lat']?>" lon="<?=$point->coord['long']?>">
  <ele><?=$point->coord['alt']?></ele>
  <name><?=$point->nom?></name>
  <type><?=$point->type['valeur']?></type>
</wpt>
<?php } ?>
</gpx>
