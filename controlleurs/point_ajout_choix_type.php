<?php
/********************************************************************************************************
Ceci est un pré-formulaire avant d'appeler point_modification, ceci afin de demande quel type
de point l'internaute souhaite rentrer (cabane, sommet, ...) et ainsi, lui préparer le formulaire mutant de
son choix
********************************************************************************************************/

require_once ("point.php");
require_once ("meta_donnee.php");

$vue->etapes = new stdClass; // les etapes, les titres complementaires affiches en haut
$vue->infos_base = infos_base (); // pour récupérer les types de points possibles

$liste_types_point_ajoutables=types_point_affichables();
foreach ($liste_types_point_ajoutables as $pa)
{
    $pa->lien_wiki_type_point=lien_wiki("fiche-".replace_url($pa->nom_type));
    $vue->types_point_affichables[]=$pa;
}
$vue->etapes->licence = new stdClass;
$vue->etapes->licence->titre = "Licence des contenus";
$vue->etapes->licence->texte = "<p>L'information que vous allez rentrer <a href=\"".lien_wiki("restriction_licence")."\">sera soumise à la licence creative commons by-sa.</a></p>";

$vue->etapes->quoimettre = new stdClass;
$vue->etapes->quoimettre->titre = "Que mettre ou ne pas mettre ?";
$vue->etapes->quoimettre->texte = "<p>Tout ne trouve pas sa place sur le site, merci de prendre connaissance de
<a href='" .lien_wiki('que_mettre') ."'>ce qui est attendu ou pas sur le site.</a></p>";

if (!isset($_SESSION['id_utilisateur']))
{
    $vue->etapes->pas_connecte = new stdClass;
    $vue->etapes->pas_connecte->titre = "Pas encore de compte ?";
    $vue->etapes->pas_connecte->texte = "<p>Nous remarquons que vous n'êtes pas connecté ou n'êtes pas inscrit sur le site. Cela n'est pas obligatoire, mais si vous souhaitez améliorer ultérieurement votre fiche, vous ne pourrez le faire sans l'aide d'un modérateur.</p>";
}

$vue->titre = 'Ajout d\'un point sur le site '.$config_wri['nom_hote'];
?>
