<?php // Sortie en format PNG

// On passe en mode bufferisé pour récupérer la sortie du générateur de code svg
ob_start();

// Note : svg.php va bénéficier du paramètre $_GET['nom']
include ('svg.php');

// On récupère le code svg de l'icône
$svg =  ob_get_contents();
ob_end_clean();

// On envoie les headers
header ('Content-type: image/png');
//header ('Content-type: text/plain'); // Debug
// Les autres headers, notamment 404 sont générés lors de l'include

// On fabrique une image PNG à partir du script SVG
$image = new Imagick();
$image->setBackgroundColor(new ImagickPixel('transparent'));
$image->readImageBlob($svg);
$image->setImageFormat('png32');
echo $image;
//file_put_contents($_GET['nom'].'.png', $image); // Crée le fichier .png
$image->clear();
$image->destroy();
