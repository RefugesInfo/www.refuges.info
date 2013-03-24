<?php 
// 10/07/2012 création d'une page d'erreur pour page non retrouvée plus sexy
// Conteneur standard de l'entête et pied de page
header("HTTP/1.0 404 Not Found");
$vue->titre = "La page demandée \"$controlleur->url_base\" est introuvable sur refuges.info";
?>
