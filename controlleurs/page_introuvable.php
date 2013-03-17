<?php 
// 10/07/2012 création d'une page d'erreur pour page non retrouvée plus sexy

header('HTTP/1.0 404 Not Found');
// Conteneur standard de l'entête et pied de page

$vue->titre = "La page demandée \"$controlleur->url\" est introuvable sur refuges.info";
?>
