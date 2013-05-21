<?php
/********************************************************************************************************
Ceci est un pré-formulaire avant d'appeler point_modification, ceci afin de demande quel type
de point l'internaute souhaite rentrer (cabane, sommet, ...) et ainsi, lui préparer le formulaire mutant de
son choix
********************************************************************************************************/

require_once ("fonctions_points.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_meta_donnees.php");

$vue->etapes = new stdClass; // les etapes, les titres complementaires affiches en haut
$vue->infos_base = infos_base (); // pour récupérer les types de points possibles

$vue->etapes->licence = new stdClass;
$vue->etapes->licence->titre = "Licence des contenus";
$vue->etapes->licence->texte = "<p>L'information que vous allez rentrer <a href=\"".lien_mode_emploi("restriction_licence")."\">sera soumise à la licence creative commons by-sa</a></p>";

$vue->etapes->quoimettre = new stdClass;
$vue->etapes->quoimettre->titre = "Que mettre ou ne pas mettre ?";
$vue->etapes->quoimettre->texte = "<p>Tout ne trouve pas sa place sur le site, merci de prendre connaissance de
<a href='" .lien_mode_emploi('que_mettre') ."'>ce qui est attendu ou pas sur le site</a></p>";


$vue->titre = 'Ajout d\'un point sur le site '.$config['nom_hote'];
?> 
