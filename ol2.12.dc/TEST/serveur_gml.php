<?php // 16/09/12 Dominique : Création
// Syntaxe: serveur_gml.php?trace=test

$filename = 'serveur_gml_data/'.$_GET['trace'].'.gpx';

// Si on a un fichier remonté, on le mémorise
if ($data = file_get_contents("php://input")) // Récupération du flux en méthode PUT
	file_put_contents ($filename, str_replace (">", ">\n", str_replace ("gpx:", "", $data)));

// Si on a une trace sur le serveur, on l'envoie à l'éditeur 
header('Content-type: application/gpx+xml');
header('Content-Disposition: attachment; filename="'.$_GET['trace'].'.gpx"');
if (file_exists ($filename))
	print (file_get_contents ($filename));
?>