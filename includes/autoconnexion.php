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
require_once ($config_wri['racine_projet'] . "forum/ext/RefugesInfo/couplage/autoconnexion.php");

// Fonction qui va permettre ensuite d'afficher la "petite étoile :*" en haut à coté du nom du modérateur
// Pour le prévenir si un commentaire est en attente avec une demande de correction
// FIXME : cette fonction n'a rien à faire dans autoconnexion.php
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
// FIXME : pas mieux que info_demande_correction tout ça est lié au bandeau et devrait filer dans un autre fichier
function remplissage_zones_bandeau()
{
    global $config_wri;
    // Ajoute les liens vers les autres zones
    $conditions = new stdClass;
    $conditions->ids_polygone_type=$config_wri['id_zone'];
    $zones=infos_polygones($conditions);
    if ($zones)
        foreach ($zones as $zone)
            $array_zones [ucfirst($zone->nom_polygone)] = lien_polygone($zone)."?id_polygone_type=".$config_wri['id_massif'];
    return $array_zones;
}

