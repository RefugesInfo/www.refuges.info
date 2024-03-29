<?php
header("Content-disposition: filename=points-refuges-info.rss");
header("Content-Type: application/xml; UTF-8"); // rajout du charset
header("Content-Transfer-Encoding: binary");
headers_cors_par_default();
headers_cache_api();



$rss = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$rss .= "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\r\n";
$rss .= "<channel>\r\n";
$rss .= "	<title>Refuges.info</title>\r\n";
$rss .= "	<link>https://".$config_wri['nom_hote']."/</link>\r\n";
$rss .= "	<atom:link href=\"https://".$config_wri['nom_hote']."".htmlspecialchars($_SERVER["REQUEST_URI"])."\" rel=\"self\" type=\"application/rss+xml\" />\r\n";
$rss .= "	<description>".$config_wri['copyright_API']."</description>\r\n";
$rss .= "	<language>fr</language>\r\n";
$rss .= "	<image>\r\n";
$rss .= "		<url>https://$config_wri['nom_hote']/images/icone-rss.svg</url>\r\n";
$rss .= "		<title>Refuges.info</title>\r\n";
$rss .= "		<link>https://".$config_wri['nom_hote']."/</link>\r\n";
$rss .= "		<guid>https://".$config_wri['nom_hote']."/</guid>\r\n";
$rss .= "		<height>64</height>\r\n";
$rss .= "		<width>64</width>\r\n";
$rss .= "	</image>\r\n";

foreach ($points AS $point) {
	$rss .= "	<item>\r\n";
	$rss .= "		<title>$point->nom</title>\r\n";
	$rss .= "		<link>$point->lien</link>\r\n";
	$rss .= "		<pubDate>".$point->date['derniere_modif']."</pubDate>\r\n";
	$rss .= "		<description><![CDATA[
			<b>Type</b> : ".$point->type['valeur']."<br>\r\n";
	if($req->detail == "complet")
		$rss .= "			<b>".$point->remarque['nom']."</b> : ".htmlspecialchars($point->remarque['valeur'])."<br>
			<b>".$point->proprio['nom']."</b> : ".htmlspecialchars($point->proprio['valeur'])."<br>
			<b>".$point->acces['nom']."</b> : ".htmlspecialchars($point->acces['valeur'])."\r\n";
	$rss .= "			]]></description>\r\n";
	$rss .= "	</item>\r\n"; 
}

$rss .= '</channel>';
$rss .= '</rss>';

echo $rss;


