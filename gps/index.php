<?php
$baselayers = '{MRI:layerOsmMri()}';
$overlays = '[layerRefugesInfo({baseUrl:"//'.$_SERVER['SERVER_NAME'].'/"})]';

include ('../config_privee.php');

$mapKeys = $config_wri['mapKeys'];

include ('../MyOl/gps/index.php');