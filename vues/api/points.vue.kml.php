<?php
/* Voici notre format d'export kml, c'est très perfectible. 
 * 2021+ : les remarques, l'accès, les textes ne sont pas correctement intégré (mais quelles balises pour ça ?)
 * 2022+ : il ne prend pas en charge notre nouveau système dynamique d'icone
 * Mais bon, il a le mérite d'exister, c'est déjà ça !
 */

header("Content-disposition: filename=points-refuges-info.$req->format");
header("Content-Type: application/vnd.google-earth.$req->format; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();
headers_cache_api();

?>
<?='<?'?>xml version="1.0" encoding="utf-8"<?='?>'?>
<kml xmlns="http://earth.google.com/kml/2.1">
  <Document>
  <name>points.kml</name>
  <description><?=$config_wri['copyright_API']?></description>
<!-- Liste des styles  (en gros, les icones possibles) -->
<?php foreach ($points AS $point) {
  // on boucle une première fois pour détecter toutes les icones possibles
  $liste_icones_possibles[$point->type['icone']]=1; 
}
?>
<?php /* on constuit la liste des icones/styles */ foreach ($liste_icones_possibles as $nom_icone => $pas_utile) { ?>
  <Style id='<?=$nom_icone?>'>
    <IconStyle>
    <hotSpot x='0.5' y='0.5' xunits='fraction' yunits='fraction' />
      <Icon>
        <href>https://<?=$config_wri['nom_hote'].$config_wri['url_chemin_icones'].$nom_icone?>.png</href>
      </Icon>
    </IconStyle>
  </Style>
<?php } ?>
<!-- Fin des Styles -->
  
<!-- Liste des POINTS -->
  <Folder><name>Points</name>
  <open>0</open>
  
<?php foreach ($points AS $point) { ?>
  <Placemark id='<?=$point->id?>'>
    <name><?=htmlspecialchars($point->nom)?></name>
      <description>
        <![CDATA[ <em><?=$point->type['valeur']?></em> 
              <br>
              <p><?=bbcode2html(htmlspecialchars($point->description['valeur']),true)?></p>
              <br>
            <center><a href='<?=$point->lien?>'>Détails</a></center>
        ]]>
      </description>
      <LookAt>
        <longitude><?=$point->coord['long']?></longitude>
        <latitude><?=$point->coord['lat']?></latitude>
        <range><?=$point->coord['alt']?></range>
        <tilt>40</tilt>
        <heading>50</heading>
      </LookAt>
        <styleUrl>#<?=$point->type['icone']?></styleUrl>
      <Point>
        <coordinates><?=$point->coord['long']?>,<?=$point->coord['lat']?>,0</coordinates>
      </Point>
      <ExtendedData>
          <Data name="url">
          <value><?=$point->lien?></value>
          </Data>
      </ExtendedData>
  </Placemark>
<?php } ?>
<!-- fin des points -->

  </Folder>
  </Document>
</kml>
