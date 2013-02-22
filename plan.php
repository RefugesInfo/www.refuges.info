<?php // Affichage du plan du site basé sur le menu général

// Contient le code PHP de la page
// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 14/07/12 Dominique : Création

require_once ("modeles/config.php");
require_once ("fonctions_autoconnexion.php");

$modele = new stdClass();

$modele->titre = "Plan du site refuges.info";

// On affiche le tout
$modele->type = 'plan';
include ($config['chemin_vues']."_entete-TEST.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
