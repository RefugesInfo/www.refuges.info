<?php
// This utility modify the service-worker.js when the package is used from another directory & with .GPX files

header('Content-Type: application/javascript');

// Check new version each time the url is called
header('Expires: '.date('r'));
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Service-Worker-Allowed: /');

// Read service Worker
$service_worker = file_get_contents ('service-worker.js');

// Calculate a key depending on the delivery (Total byte size of cached files)
$version_tag = 0;

// Package files
foreach (array_merge (glob ('../*'), glob ('../*/*')) as $f)
	$version_tag += filesize ($f);

// Specific files
if (isset ($_GET['files'])) {
	$specific_files = explode (',', str_replace (':', '../', $_GET['files']));

	// Update version tag
	foreach ($specific_files as $f)
		if (file_exists ($f))
			$version_tag += filesize ($f);

	// Update cached file list
	//TODO dangeureux !
	$service_worker = str_replace (
		['index.html', 'manifest.json', 'favicon.png'],
		$specific_files,
		$service_worker
	);
	//BEST icone SVG

	// Add GPX files in the url directory to the list of files to cache
	$gpx_files = glob (pathinfo ($specific_files[0], PATHINFO_DIRNAME) .'/*.gpx');
	foreach ($gpx_files as $gf) {
		$version_tag += filesize ($gf);
		$service_worker = str_replace (
			"addAll([",
			"addAll([\n\t\t\t\t'$gf',",
			$service_worker
		);
	}
}

// Change cache name
$service_worker = str_replace (
	'myGpsCache',
	'myGpsCache_'.strlen(@$_GET['files']), // Unique name for one implementation
	$service_worker
);

// Output the version tag & the revised code
echo "// Version $version_tag\n\n$service_worker";