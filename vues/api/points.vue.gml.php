<?php
// FIXME sly : 06/12/2019 est-ce qu'il y en a encore qui s'en serve de celui là ? aucune trace dans 15 jours de logs... ménage ménage ?
header("Content-disposition: filename=points-refuges-info.gml");
header("Content-Type: text/xml; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
?>
<?='<?'?>xml version="1.0" encoding="UTF-8" <?='?>'?>
<wfs:FeatureCollection
  xmlns:wfs="http://www.opengis.net/wfs"
  xmlns:gml="http://www.opengis.net/gml"
  xmlns:topp="http://www.openplans.org/topp">
  <name>points-refuges-info.gml</name>
  <description><?=$config_wri['copyright_API']?></description>

<?php foreach ($points as $point) { ?>
  <gml:featureMember>
    <point_wri>
        <nom><?=htmlspecialchars($point->nom)?></nom>
        <type><?=htmlspecialchars($point->type['valeur'])?></type>
        <icone><?=$point->type['icone']?></icone>
        <url><?=$point->lien?></url>
        <altitude><?=$point->coord['alt']?></altitude>
        <gml:Point>
            <gml:coordinates decimal="." cs="," ts=" "><?=$point->coord['long']?>,<?=$point->coord['lat']?></gml:coordinates>
        </gml:Point>
    </point_wri>
  </gml:featureMember>
<?php } ?>
</wfs:FeatureCollection>
