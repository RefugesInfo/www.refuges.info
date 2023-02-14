<?php
// Calculate a build number depending on the files used by the PWA
$dirs = [
	$start_path.'*', // Files in the start dir
	$myol_path.'../*', // MyOl/*
	$myol_path.'../*/*', // MyOl/*/* (includes MyOl/gps/*)
];

date_default_timezone_set ('Europe/Paris');
$date = 0;
$gpx_files = [];
$gpx_param = '';
$files = glob ('{'.implode(',',$dirs).'}', GLOB_BRACE);

// List files to cache
foreach ($files AS $filename)
	if (is_file ($filename) && $date < filemtime ($filename))
		$date = filemtime ($filename);

// List gps files in the directory
foreach (glob ('*.gpx') AS $filename) {
	$gpx_files[] = $filename;

	if (pathinfo($filename, PATHINFO_FILENAME) == $_SERVER['QUERY_STRING'])
		$gpx_param = $filename;
}

// Load the gps file if it's lonely
if (count ($gpx_files) == 1 && !$gpx_param)
	$gpx_param = $gpx_files[0];

// Build version tag
$build_date = date ('jMy-G:i.\vs', $date) .count ($files);
