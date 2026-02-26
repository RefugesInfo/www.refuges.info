<?php
// Sortie en format PNG

// On passe en mode bufferisé pour récupérer la sortie du générateur de code svg
ob_start();

// Note : svg.php va bénéficier du paramètre $_GET['nom']
include ('svg.php');

// On récupère le code svg de l'icône
$svg =  ob_get_contents();
ob_end_clean();

// On envoie les headers
header ('Content-disposition: filename='.$_GET['nom'].'.png');
header ('Content-type: image/png');
// Les autres headers, notamment 404 sont générés lors de l'include svg.php

// On fabrique une image PNG à partir du script SVG


/**** Code fonctionnel en php 7.4, sur certaines versions de Imagick mais pas toutes, mais sur php 8.4 de debian 13
$image = new Imagick();
$image->setBackgroundColor(new ImagickPixel('transparent'));
$image->readImageBlob($svg);
$image->setImageFormat('png32');
echo $image;
//file_put_contents($_GET['nom'].'.png', $image); // Crée le fichier .png
$image->clear();
$image->destroy();
*/

// sly 2026-02-26 : j'ai demandé à l'IA de me pondre une alternative et il me propose d'utiliser librsvg :
// On ouvre un processus vers rsvg-convert
// -w 24 -h 24 : force la taille
// -f png : format de sortie
$descriptorspec = [
   0 => ["pipe", "r"],  // stdin (entrée du SVG)
   1 => ["pipe", "w"],  // stdout (sortie du PNG)
   2 => ["pipe", "w"]   // stderr
];

$process = proc_open('rsvg-convert -w 24 -h 24 -f png', $descriptorspec, $pipes);

if (is_resource($process)) {
    fwrite($pipes[0], $svg);
    fclose($pipes[0]);

    $png_data = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    proc_close($process);

    echo $png_data;
    exit;
}
