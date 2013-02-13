<?php
require_once ("../modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_osm.php");
require_once ($config['chemin_modeles']."fonctions_polygones.php");

print("<pre>");
foreach (array("osm_pois","osm_pois_tags","osm_tags") as $table)
{
  $q="truncate table $table";
  mysql_query($q);
}
  
$q="select * from polygones where id_polygone_type = $config[id_massif] and id_polygone != $config[numero_polygone_fictif]";
$res=mysql_query($q);
while ($polygone=mysql_fetch_object($res))
{
  $retour=importation_osm_poi($polygone,"*[tourism=hotel]");
  print($retour->message."\n");
  $retour=importation_osm_poi($polygone,"*[tourism=camp_site]");
  print($retour->message."\n");
  $retour=importation_osm_poi($polygone,"*[tourism=guest_house]");
  print($retour->message."\n");
  $retour=importation_osm_poi($polygone,"*[shop=supermarket]");
  print($retour->message."\n");
}
print("</pre>");
?>