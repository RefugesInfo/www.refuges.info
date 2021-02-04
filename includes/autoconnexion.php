<?php
/***
Fonctions de gestion de l'autoconnexion des utilisateurs permettant de coupler le forum et le site
L'identification de l'utilisateur par le forum est utilisée pour valider les droits sur la partie fiches
Elle est donc lancé sur chaque page qui pourrait nécessiter d'être connecté
Comme une session est démarrée, c'est à faire avant tout affichage

Le niveau de moderation est récupéré avec la fonction d'autorisatin de PhpBB
Ensuite sont stocké dans la session ( accessible par toutes les pages ):
$_SESSION['login_utilisateur']
$_SESSION['id_utilisateur'] ( celui de la table phpbb_users )
$_SESSION['niveau_moderation'] ayant pour signification
Il n'y a que 2 niveaux dans WRI aujourd'hui : 0 = rien, >= 1 = tout

***/
require_once ("config.php");
require_once ("bdd.php");
require_once ("gestion_erreur.php");
require_once ("commentaire.php");
require_once ("forum.php");

// On appelle le fichier qui va chercher les infos dans phpBB
require_once ("identification.php");
infos_identification();

// phpBB défini lui même sa fonction pour gérer les erreurs, on n'en veut pas merci ! surtout qu'elle est active, même si on semble avoir fait ce qu'il faut pour mettre en mode sans affichage d'erreur (ou alors j'ai pas trouvé sur php 3.3)
restore_error_handler();

// Fonction qui va permettre ensuite d'afficher la "petite étoile :*" en haut à coté du nom du modérateur
// Pour le prévenir si un commentaire est en attente avec une demande de correction
// FIXME sly 2020 : cette fonction n'a rien à faire dans autoconnexion.php c'est pas bien rangé ! Il faudrait la mettre heu, ailleurs ;-) en rapport à la gestion ? mais qui doit quand même être disponible quand le bandeau va se charger vu que c'est lui qui contient l'*
function info_demande_correction ()
{
    $conditions_attente_correction = new stdclass;
    $conditions_attente_correction->demande_correction=True;
    $conditions_attente_correction->avec_points_en_attente=True;
    $commentaires_attente_correction=infos_commentaires($conditions_attente_correction);

    if (count($commentaires_attente_correction)>0)
        return true;
    else
        return false;
}
