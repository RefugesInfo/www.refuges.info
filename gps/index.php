<?php
$baselayers = '{MRI:layerOsmMri()}';
$overlays = '[layerRefugesInfo({baseUrl:"//'.$_SERVER['SERVER_NAME'].'/"})]';

include ('../config_privee.php');

$mapKeys = [
	'ign' => $config_wri['ign_key'],
	'thunderforest' => $config_wri['thunderforest_key'],
	'bing' => $config_wri['bing_key'],
];

include ('../MyOl/gps/index.php');