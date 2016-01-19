<?php
/**********************************************************************************************
API pour usage d'autres sites (chemineur.fr)
Renvoie la liste des polygones dans lequel un point est inscrit
Dominique: On garde ce fichier tant que l'API massifs rend les massifs dont le BBox est inclu et non pas une simple intersection
**********************************************************************************************/

require_once ("../includes/config.php");
require_once ("config.php");
require_once ("bdd.php");

$longitude = $_GET ['lon'];
$latitude  = $_GET ['lat'];

$query="SELECT *
FROM polygones
WHERE ST_Within(ST_GeomFromText('POINT($longitude $latitude)',4326), geom) 
";
if ($polygone_type = $_GET ['type'])
    $query .= "AND id_polygone_type IN ($polygone_type)";

$res = $pdo->query($query);
while ($row = $res->fetch())
    $poly .= "<polygone>
        <nom>{$row->nom_polygone}</nom>
        <id>{$row->id_polygone}</id>
        <type>{$row->id_polygone_type}</type>
        <article_partitif>{$row->article_partitif}</article_partitif>
        <message>{$row->message_information_polygone}</message>
        <url_exterieure>{$row->url_exterieure}</url_exterieure>
        <site_web>{$row->site_web}</site_web>
    </polygone>
    ";

$poly = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<localisation>
    $poly
</localisation>";

// Nos données ne changent pas toutes les secondes, on peut autoriser le client à faire un peu de cache pour accélérer
$secondes_de_cache = 3600;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: attachment; filename=localisation.xml");
header("Content-Type: application/xml; utf-8");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($poly));
header("Pragma: cache");
header("Expires: $ts");
header("Cache-Control: max-age=$secondes_de_cache");
header("Access-Control-Allow-Origin: *");
print($poly);
?>