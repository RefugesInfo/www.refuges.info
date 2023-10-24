<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

error_reporting(E_ALL);
ini_set("display_errors", "on");

// Search for myol libraries
$dist_files = glob("{,../,../*/}*/myol.*s", GLOB_BRACE);
$dist_rep = dirname($dist_files[0]) . "/";

// calculate the files last changed date
$dependencies = glob("{*,*/*,../*/myol.*s}", GLOB_BRACE);
date_default_timezone_set("Europe/Paris");
$last_change_time = 0;
foreach ($dependencies as $f) {
  $last_change_time = max($last_change_time, filemtime($f));
}
$last_change_date = date("Y-m-d H:i:s", $last_change_time);

// Search for layer keys efinition
$key_glob = glob("../*/{,*/}keys.php", GLOB_BRACE);
if ($key_glob) {
  include $key_glob[0];
} else {
  $map_keys = [];
}

// List .gpx files included in the gpx directory
$gpx_files = glob("{,*/}*.gpx", GLOB_BRACE);

$js_vars = json_encode([
  "lastChangeDate" => $last_change_date,
  "mapKeys" => $map_keys,
  "gpxFiles" => $gpx_files,
  "distFiles" => $dist_files,
]);
