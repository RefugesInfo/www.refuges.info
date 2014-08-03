<?='<?'?>xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
	<head>
		<title>Génération optimisée de la librairie Openlayers modifiée</title>
		<link rel="shortcut icon" href="/images/favicon.ico" />
		<meta name="robots" content="none" />
		<meta http-equiv="Content-Type" content="text/html;charset=windows-1252" />
	</head>
	<body>
<?php
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Paris');

require 'jsmin-1.1.1.php';

$dir = '../../vues'; // Si inclu dans refuges.info
if (!is_dir ($dir)) $dir = '../TEST'; // Sinon, la page de test

// Liste des classes qui sont dans un fichier dont le nom est différent de la classe
$estDans = array (
    'OpenLayers/Bounds.js' => 'OpenLayers/BaseTypes/Bounds.js',
    'OpenLayers/Class.js' => 'OpenLayers/BaseTypes/Class.js',
    'OpenLayers/Date.js' => 'OpenLayers/BaseTypes/Date.js',
    'OpenLayers/Element.js' => 'OpenLayers/BaseTypes/Element.js',
    'OpenLayers/LonLat.js' => 'OpenLayers/BaseTypes/LonLat.js',
    'OpenLayers/Pixel.js' => 'OpenLayers/BaseTypes/Pixel.js',
    'OpenLayers/Size.js' => 'OpenLayers/BaseTypes/Size.js',
    
    'OpenLayers/Layer/IGN/Standard.js' => 'OpenLayers/Layer/IGN.js',
    'OpenLayers/Layer/IGN/Classique.js' => 'OpenLayers/Layer/IGN.js',
    'OpenLayers/Layer/IGN/Photo.js' => 'OpenLayers/Layer/IGN.js',
    'OpenLayers/Layer/IGN/Cadastre.js' => 'OpenLayers/Layer/IGN.js',
    
    'OpenLayers/Layer/SwissTopo/Siegfried.js' => 'OpenLayers/Layer/SwissTopo.js',
    'OpenLayers/Layer/SwissTopo/Dufour.js' => 'OpenLayers/Layer/SwissTopo.js',
    'OpenLayers/Layer/SwissTopo/Photo.js' => 'OpenLayers/Layer/SwissTopo.js',
    
    'OpenLayers/Layer/Google/Terrain.js' => 'OpenLayers/Layer/Googles.js',
    'OpenLayers/Layer/Google/Photo.js' => 'OpenLayers/Layer/Googles.js',
    'OpenLayers/Layer/Google/Hybrid.js' => 'OpenLayers/Layer/Googles.js',
    'OpenLayers/Layer/Google/Terrain.js' => 'OpenLayers/Layer/Googles.js',
    
    'OpenLayers/Layer/OCM/Transport.js' => 'OpenLayers/Layer/OCM.js',
    'OpenLayers/Layer/OCM/Landscape.js' => 'OpenLayers/Layer/OCM.js',
    'OpenLayers/Layer/OCM/Outdoors.js' => 'OpenLayers/Layer/OCM.js',
    
    'OpenLayers/Control/GPSPanel.js' => 'OpenLayers/Control/GPS.js',
    'OpenLayers/Control/FullScreenPanel.js' => 'OpenLayers/Control/FullScreen.js',
);

// Récupèrer les entête & pied de Openlayers.js
$log = "<b>Openlayers.js généré sur ".$_SERVER['SERVER_NAME']." le " .date('r')."</b><br/>"
."Modifications par rapport à OpenLayers-2.12:";

$ollib = explode ('@@@', file_get_contents ('OpenLayers.js'));

$olmin = "/* Librairie minifiée Openlayers générée sur {$_SERVER['SERVER_NAME']} le " .date('r')."\n\n"
        .file_get_contents ('../licenses.txt')."*/\n"
        ."var OpenLayers={singleFile:true};"
        .compress ($ollib [0])
        .compress ($ollib [1]);

foreach (array ('.', $dir) AS $d)
    foreach (scandir ($d) AS $f)
        if (is_file ($d.'/'.$f)) {
            $fc = file_get_contents ($d.'/'.$f);
            
            // pour @rëquires OpenLayers/Xxx/Yxx.js
            $fc = str_replace ('requires', 'new', $fc); 
            $fc = str_replace ('/', '.', $fc);
            $fc = str_replace ('.js', '', $fc);
            
            preg_match_all ('/new ([A-Z|a-z|\.]*)/', $fc, $fcs);
            foreach ($fcs[1] AS $classe)
                addFile (str_replace ('.', '/', $classe).'.js');
        }

// Ecriture des lib en 1 seule fois pour minimiser la durée d'indisponibilité
$ollib [] = $ollib [1]; // On ajoute la fin du fichier
unset ($ollib [1]);
file_put_contents ('../lib/OpenLayers.js', $ollib);
file_put_contents ('../OpenLayers.js', $olmin);
file_put_contents ('build.log.html', $log);
echo $log;
//------------------------------------------------------------------------------------------------
function addFile ($fileName) {
    global $files, $ollib, $olmin, $log, $estDans;
    if (isset ($estDans [$fileName]))
        $fileName = $estDans [$fileName];
        
    if (is_file ('../lib/'.$fileName) && !isset ($files [$fileName]) && !strstr ($fileName, 'SingleFile')) {
        $files [$fileName] = true;
        $fc = file_get_contents ('../lib/'.$fileName);
        preg_match_all ('/@requires ([A-Z|a-z|0-9|_|\-|\/|\.]*)/', $fc, $fcs);
        foreach ($fcs[1] AS $f)
            addFile ($f);
        $ollib [] = "'$fileName',\n";
        $olmin .= compress ($fc);
		$o = '';
		foreach (explode ("\n", "\n$fc") AS $k => $v) {
            $t = htmlspecialchars (trim (substr ($v, 7)));
			switch (substr ($v, 0, 7)) {
                case '//DCM  ': // Introduction de la modif
                    if ($t)
                        $o .= "<br/>\n<i>$t</i>";
                    break;
                case '/*DCM++': // Nouveau fichier
                    $o .= ": <i>nouveau fichier</i>";
                    break;
                case '//DCM//': // Lignes supprimées
                    $o .= "<br/>\n$k--- $t";
                    break;
                case '/*DCM*/': // Ligne ajoutée
                    $o .= "<br/>\n$k++ $t";
                    break;
                case '//DCM<<': // Lignes ajoutées
                    $o .= "<br/>\nPlusieurs lignes ajoutées: $t";
                    break;
			}
        }
		if ($o)
			$log .= "<hr/><b>$fileName</b>$o\n";
    }
    else if (!is_file ('../lib/'.$fileName) && (strstr ($fileName, 'OpenLayers') || strstr ($fileName, 'proj4js')))
        echo'<pre style="background-color:white"><b>Erreur fichier inexistant:</b> '.var_export($fileName,true).'</pre>';
}
//------------------------------------------------------------------------------------------------
function compress ($js) {
    // Pour remplacer provisoirement les caractÃƒÂ¨res qui ne passent pas dans le compresseur
    $carspe = array (
        'Ã´' => '@OC@',
        'Ã ' => '@AG@',
        'Ã©' => '@EE@',
        'Ã¨' => '@EG@',
        'Ã¹' => '@UG@',
        'Â°' => '@DG@',
        'ô' => '@aOC@', // Ansi
        'à' => '@aAG@',
        'é' => '@aEE@',
        'è' => '@aEG@',
        'ù' => '@aUG@',
        '°' => '@aDG@',
        'ÃƒÂ´' => '@uOC@', // UTF8 sans BOM
        'ÃƒÂ ' => '@uAG@',
        'ÃƒÂ©' => '@uEE@',
        'ÃƒÂ¨' => '@uEG@',
        'ÃƒÂ¹' => '@uUG@',
        'Ã‹Å¡' => '@uDG@',
        '@pad@' => '@pad@',
    );
    $specar = array_flip ($carspe);

    $js = str_replace ($specar, $carspe, $js);
    $js = utf8_decode (JSMin::minify ($js));
    $js = str_replace ($carspe, $specar, $js);
    return $js;
}
?>
	</body>
</html>
