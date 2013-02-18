<?php // Formulaire de recherche

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $modele->...

// 10/03/06 rff : Ajout instr. de libération query sql
// 21/03/06 rff : Insertion infos.de session pour modération
//		La table 'massifs' devient 'polygones' dans la base 'refuges'
//		Balises <table> déplacées depuis header.php & depuis footer.php
// 23/11/07 jmb : remplacement H3 par H4, H3 est pour le titre de page (ok ce devrait plutot etre H1)
// 23/02/08 jmb : vire la derniere visite, plue en base
// 23/02/08 jmb : refait la déco, rajoute la recherche sponsorisee google
// 22/04/08 jmb : virage de la saloperie de pub google
// 08/10/11 Dominique : Utilisation des templates
// 28/05/12 Dominique : Utilisation des modeles simples
// 15/02/13 jmb : ptite modif info_base

require_once("modeles/config.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");

// etait modele=info_base. plus coherent avec les aurt pages
$modele = new stdClass();
$modele->infos_base = infos_base ();
$modele->titre = "Recherche de refuges/cabanes/gites";

// On affiche le tout
$modele->type = 'point_formulaire_recherche';
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");
?>
