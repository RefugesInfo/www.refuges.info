<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

error_reporting(E_ALL);
ini_set("display_errors", "on");

// Default config.php
$myol_rep = "../dist/";
$gpx_rep = "";
$map_keys = [];
$vector_layers = [];
$js_include = [];
$html_include = [];

// Get specific config
if (file_exists("config.php")) {
  include "config.php";
}

// Calculate the last modification date of files
$dependencies = array_unique(
  glob("{*,*/*,$myol_rep*,$gpx_rep*}", GLOB_BRACE),
  SORT_STRING
);
date_default_timezone_set("Europe/Paris");
$last_change_time = 0;
foreach ($dependencies as $f) {
  if (is_file($f)) {
    $last_change_time = max($last_change_time, filemtime($f));
  }
}
$last_change_date = date("Y-m-d H:i:s", $last_change_time);

// Values used in javascript code
$js_vars = json_encode([
  "lastChangeDate" => $last_change_date,
  "mapKeys" => $map_keys,
  "gpxFiles" => glob($gpx_rep . "*.gpx", GLOB_BRACE),
  "myolFiles" => glob($myol_rep . "myol.*s"),
  "vectorLayers" => $vector_layers,
]);
