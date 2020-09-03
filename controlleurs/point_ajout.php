<?php
/********************************************************************************************************
Ceci est un pré-formulaire avant d'appeler point_modification, ceci afin de demande quel type
de point l'internaute souhaite rentrer (cabane, sommet, ...) et ainsi, lui préparer le formulaire mutant de
son choix
********************************************************************************************************/

require_once ("meta_donnee.php");

$vue->infos_base = infos_base (); // pour récupérer les types de points possibles

$liste_types_point_ajoutables=types_point_affichables();
foreach ($liste_types_point_ajoutables as $pa)
{
    $pa->lien_wiki_type_point=lien_wiki("fiche-".replace_url($pa->nom_type));
    $vue->types_point_affichables[]=$pa;
}


$vue->titre = 'Ajout d\'un point sur le site '.$config_wri['nom_hote'];

