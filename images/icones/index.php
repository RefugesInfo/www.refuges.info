<?php
// Cet utilitaire concatène toutes les icônes SVG utilisées par les cartes
// en les décalant de 24 px à chaque fichier
header( 'Content-type: image/svg+xml' );
header('Cache-Control: max-age=86000');

$files = glob ('*.svg');
echo '<svg xmlns="http://www.w3.org/2000/svg"'.
	' viewBox="0 0 '.(count($files) * 16).' 16"'.
	' width="'.(count($files) * 24).'" height="24">'.
	PHP_EOL;

foreach ($files AS $file_no => $file_name) {
	echo "<!-- $file_name -->\n";
	$file_pointer = fopen ($file_name, 'r');
	while (!feof ($file_pointer)) {
		$line = fgets ($file_pointer); // Pour lire ligne par ligne
		if (!strpos ($line, 'svg') &&
			strlen ($line) > 1)
			echo preg_replace_callback(
				'/(d="M| x="| cx=")([0-9\.]*)/',
				function ($match) {
					global $file_no;
					return $match[1]. ($match[2] + $file_no * 16);
				},
				$line
			);
	}
	fclose($file_pointer);
}
echo '</svg>';
