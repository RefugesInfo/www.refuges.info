<?php
// Calculate a build number depending on the files used by the PWA
$dirs = [
	$start_path.'*', // Files in the start dir
	$myol_path.'../*', // MyOl/*
	$myol_path.'../*/*', // MyOl/*/* (includes MyOl/gps/*)
];

$date = 0;
$gpx_files = [];
$files = glob ('{'.implode(',',$dirs).'}', GLOB_BRACE);

date_default_timezone_set ('Europe/Paris');
foreach ($files AS $filename) {
	if (is_file ($filename) && $date < filemtime ($filename))
		$date = filemtime ($filename);

	if (pathinfo($filename, PATHINFO_EXTENSION) == 'gpx')
		$gpx_files[] = $filename;
}

$build_date = date ('jMy-G:i.\vs', $date) .count ($files);
