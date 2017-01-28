<p><a href="update_nodes.php?dwn=1&loop">UPDATE ALL</a></p>
<?php
$dwn = isset($_GET['dwn']) ? $_GET['dwn'] : 0;
$git = [
	// Kernel LL
	'Leaflet/Leaflet' => ['' /*, 'v1.0.1', 'v0.7.7'*/], // 1.0 dev, 1.0 stable, 0.7 stable

	// CRS exotiques
//	'proj4js/proj4js' => [''],
	'kartena/Proj4Leaflet' => [''/*, 'leaflet-proj-refactor'*/], // For ll 1.0, (TODO : 0.7 : https://github.com/kartena/Proj4Leaflet-master/releases/tag/0.7.2)
//	'tyrasd/togpx' => [''],

	// Couches autres fournisseurs
	'shramov/leaflet-plugins' => [''],
	'rob-murray/os-leaflet' => ['', 'v0.2.1', 'leaflet-1.0'], // For ll 0.7, 1.0, dev ==> TODO A SURVEILLER

	// Controles
	'MrMufflon/Leaflet.Coordinates' => [''],
	'Leaflet/Leaflet.fullscreen' => ['gh-pages'],
	'stefanocudini/leaflet-gps' => [''],
	'k4r573n/leaflet-control-osm-geocoder' => [''],

	'mapbox/togeojson' => [''],
	'makinacorpus/Leaflet.FileLayer' => [''],

	'rowanwins/leaflet-easyPrint' => ['gh-pages'],

	// Couches vectotielles
	'erictheise/rrose' => [''],

	// Draw
	'Leaflet/Leaflet.draw' => [''], // For ll 0.7 & 1.0
	'makinacorpus/Leaflet.GeometryUtil' => [''], // A mettre sinon snap plante.
	'makinacorpus/Leaflet.Snap' => [''],

	// Editable (Evaluation ongoing)
	'Leaflet/Leaflet.Editable' => ['leaflet0.7', ''], // For ll 0.7, 1.0

	/* MyLeaflet / La source est dans lib */
	/* Update uniquement le CREDIT */
	'Dominique92/Leaflet.Permalink.Cookies' => [''],
	'Dominique92/Leaflet.Map.MultiVendors' => [''],
	'Dominique92/Leaflet.Marker.coordinates' => [''],
	'Dominique92/Leaflet.GeoJSON.Ajax' => [''],
	'Dominique92/Leaflet.draw.plus' => [''],
	'Dominique92/MyLeaflet' => [''],

	// Tools
	'tchwork/jsqueeze' => [''],
	'tubalmartin/YUI-CSS-compressor-PHP-port' => [''],
];

$n = 0;
foreach ($git AS $k=>$v)
	foreach ($v AS $kv=>$vv) {
		$n++;
		$g = "https://github.com/$k".($vv?'/tree/':'').$vv;
		echo"<pre style='background-color:white;color:black;font-size:14px;'>Load <a href=\"update_nodes.php?dwn=$n\">$k</a> &nbsp; Git".var_export("<a href=\"$g\">$g</a>",true).'</pre>';

		if ($n == $dwn) {
			if (!$vv) $vv = 'master';
			$z = "https://github.com/$k/archive/$vv.zip";
			$gs = explode ('atest commit', file_get_contents ($g), 2);
			preg_match ('/href="([^"]+)"/', $gs[1], $cs);
			$cs['git'] = $g;
			$cs['zip'] = $z;
			echo"<pre style='background-color:white;color:black;font-size:14px;'>".var_export($cs,true).'</pre>';

			// Read zipfile
			$zip_file = 'TMP.zip';
			$zipResource = fopen($zip_file, 'w');
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $z);
			curl_setopt ($ch, CURLOPT_FAILONERROR, true);
			curl_setopt ($ch, CURLOPT_HEADER, 0);
			curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt ($ch, CURLOPT_BINARYTRANSFER,true);
			curl_setopt ($ch, CURLOPT_TIMEOUT, 100);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt ($ch, CURLOPT_FILE, $zipResource);
			$page = curl_exec ($ch);
			if(!$page) {
				echo "Error download $z :- ".curl_error($ch);
				exit;
			}
			curl_close($ch);
			fclose($zipResource);

			// Unzip the file
			$zip = new ZipArchive;
			if($zip->open($zip_file) != 'true')
				echo 'Error :- Unable to open the Zip File';
			if (!preg_match('/Dominique92/',$k))
				$zip->extractTo ('../lib');
			$zd = $zip->getNameIndex(0); // Archive directory_name/
			$zip->close();

			file_put_contents ("../lib/$zd"."CREDIT.txt", "$g\nhttps://github.com".str_replace ('/tree/', '/commit/', $cs[1]));
		}
	}
	echo"<pre style='background-color:white;color:black;font-size:14px;'>Erreur = ".var_export(error_get_last(),true).'</pre>';

//-----------------------------------
// Boucle
if (isset ($_GET['loop']) &&
	$dwn++ <= $n &&
	!error_get_last()
)
	echo "<meta http-equiv='refresh' content='0;url=update_nodes.php?dwn=$dwn&loop'>";
?>
<p><a href=".">Générer les librairies compressées leaflet.css &amp; leaflet.js</a></p>

