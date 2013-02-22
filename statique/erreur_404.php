<?php 
// 10/07/2012 création d'une page d'erreur pour page non retrouvée plus sexy

require_once ("../modeles/config.php");
require_once ("fonctions_autoconnexion.php");

$modele = new stdclass;
// Conteneur standard de l'entête et pied de page
$modele->titre = "Erreur 404 - La page demandée est introuvable sur refuges.info";
$modele->type = 'erreur_404'; // Le type
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
