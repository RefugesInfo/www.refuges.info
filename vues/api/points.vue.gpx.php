<?php 
/*
sly 05/12/2019 Ce format gpx est celui qui, selon ce que je comprend de la norme, la respecte le mieux, utilises les champs gpx tels qu'ils ont été prévus, mais perds des fonctionnalités intéresantes que les autres pourraient exploiter.
- J'ai enlevé la balise   <sym><?=$point->sym?></sym> car elle présentait des icônes spécifiques aux outils garmin (basecamp, mapsource, et certains autres comme viking qui reconnaissent les icones par exemple). Je pourrais sans doute la remettre car ça ne change pas grand chose, et des fois qu'un outil les supportent ?
- <desc> est utilisés pour les remarques d'un point
- Le logiciel Marble n'ouvre pas les gpx avec une balise <link> contenant un <text> et <type>, viking ouvre mais indique un "thumbnail cannot be loaded" car il tente d'ouvrir le lien en local   je change alors pour un format plus simple <link href="http://la-bas" />

*/
header("Content-disposition: filename=points-refuges-info-standard.gpx");
header("Content-Type: application/gpx+xml; UTF-8"); // rajout du charset
headers_cors_par_default();
?>
<?='<?'?>xml version="1.0" encoding="UTF-8" standalone="no"<?='?>'?>

<gpx xmlns="http://www.topografix.com/GPX/1/1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd" creator="Export gpx standard de refuges.info" version="1.1">
<metadata>
	<name>Points de refuges.info</name>
	<desc><?=$config_wri["copyright_API"]?></desc>
	<author>
		<name>Contributeurs refuges.info</name>
	</author>
	<copyright author="Contributeurs refuges.info">
		<time><?=date('Y-m-d\TH:i:s')?></time>
		<license>http://creativecommons.org/licenses/by-sa/2.0/deed.fr</license>
	</copyright>
	<link href="https://<?=$config_wri['nom_hote']?>" />
</metadata>

<?php foreach ($points AS $point) { ?>
<wpt lat="<?=$point->coord['lat']?>" lon="<?=$point->coord['long']?>">
  <ele><?=$point->coord['alt']?></ele>
  <name><?=htmlspecialchars($point->nom)?> <?php if ($point->etat['valeur']!="") print('('.$point->etat['valeur'].')')?></name>
    <type><?=$point->type['valeur']?></type>
    <desc><?=htmlspecialchars(bbcode2txt($point->description['valeur']))?></desc>
    <src><?=$point->coord['precision']['nom']?></src>
    <link href="<?=$point->lien?>" />
</wpt>
<?php } ?>
</gpx>
