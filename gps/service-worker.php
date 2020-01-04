<?php
// Set no cache for immediate check of updating
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Content-Type: application/javascript');

// We extract the list of the files that need to be cached from the index.php file
// If any of the cached file is modified, the service will be immediately reloaded
$index = $_SERVER['REQUEST_SCHEME'].
	'://'.$_SERVER['HTTP_HOST'].
	pathinfo ($_SERVER['PHP_SELF'], PATHINFO_DIRNAME).
	'/index.php';
// Call the url to have the filemtime of the dependencies resolved by PHP
preg_match_all ('/(ref|src)="([^"]+)"/', file_get_contents ($index), $app_files);
$files = array_unique ($app_files[2]);

$cached_files = '';
foreach ($files AS $f)
	$cached_files .= "\t'$f', // " .filemtime (explode ('?',$f) [0]) .PHP_EOL;

// Generate a mark containing the generation ID
echo "/* Gen ID ".substr (crc32 ($cached_files), -4)." */\n";

// The list of cached files for the cache manager
echo "const cachedFiles = [\n$cached_files];\n\n";

// Now, the service-worker himself !
include ('service-worker.js');
?>