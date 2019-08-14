<?php
header('Content-Type: application/javascript');

// The app reloads when the service-worker file changes
// Set no cache for immediate check of updating
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

// List file & md5 for automatic updating if any file change
// Use file_get_contents of the URL to expand PHP inclusions
$index_file = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].pathinfo ($_SERVER['PHP_SELF'], PATHINFO_DIRNAME).'/index.php';
preg_match_all ('/(ref|src)="([^"]+)"/', file_get_contents ($index_file), $app_files);
?>

// The first time a user hits the page an install event is triggered.
// The other times an update is provided if the remote service-worker source md5 is different
self.addEventListener('install', function(e) {
	caches.delete('gpsCache');
	e.waitUntil(
		caches.open('gpsCache').then(function(cache) {
			return cache.addAll([
<?php
foreach ($app_files[2] AS $f)
	echo "\t\t\t\t'$f', // ".md5_file($f)."\n";
?>
			]);
		})
	);
});

// Performed each time an URL is required before access to the internet
// Provides cached app file if any available
self.addEventListener('fetch', function(e) {
	e.respondWith(
		caches.match(e.request).then(function(response) {
			return response || fetch(e.request);
		})
	);
});