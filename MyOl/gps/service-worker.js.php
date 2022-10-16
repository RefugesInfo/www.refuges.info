<?php
error_reporting(E_ALL);
ini_set('display_errors','on');

header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Content-Type: application/javascript');
header('Service-Worker-Allowed: /');

$sw_instance = preg_match ('/^[^0-9]*/', @$_SERVER['QUERY_STRING'], $matches);
$start_path = str_replace (['.',':'], ['/','../'], $matches[0]);
$myol_path = '';

include ('common.php');

// The first time a user hits the page an install event is triggered.
// The other times an update is provided if the service-worker source md5 is different
?>
// Next available version : <?=$build_date?> (to trigger SW upgrade)

var gpxFiles = <?=json_encode($gpx_files)?>;

self.addEventListener('install', evt => {
	console.log('PWA SW install ' + evt.target.location);

	// Clean cache when PWA install or upgrades
	caches.delete('myGpsCache')
		.then(console.log('myGpsCache deleted'));

	// Create & populate the cache
	evt.waitUntil(
		caches.open('myGpsCache')
		.then(cache => cache.addAll(gpxFiles)
			.then(console.log('myGpsCache created, ' + gpxFiles.length + ' files added'))
		)
	);
});

// Cache all used files
self.addEventListener('fetch', evt =>
	evt.respondWith(
		caches.match(evt.request)
		.then(found => {
			if (found) {
				//console.log('found ' + evt.request.url)
				return found;
			} else
				return fetch(evt.request).then(response => //BEST catch errors (url not found)
					caches.open('myGpsCache')
					.then(cache => {
						//console.log(response.type + ' ' + evt.request.url)
						cache.put(evt.request, response.clone());
						return response;
					})
				)
		})
	)
);