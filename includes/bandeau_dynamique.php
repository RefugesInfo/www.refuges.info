<?php
/***
Fonctions qui permettent de générer dynamiquement du contenu quasi-statique du menu/bandeau.
31/01/2021 sly : Il aurait pû aller dans le controlleur de la vue du bandeau, mais son controlleur c'est la route generale, et ça fait déjà lour de code là bas
trouve que de la présentation
***/
require_once ('polygone.php'); // Nécessaire pour générer le menu des zones couvertes
require_once ('wiki.php');

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
// Fonction qui va permettre ensuite d'afficher la "petite étoile :*" en haut à coté du nom du modérateur
// Pour le prévenir si un commentaire est en attente avec une demande de correction
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
// Cette fonction permet de préparer le menu des pages d'aide
function prepare_lien_wiki_du_bandeau()
{
    foreach (array("index","licence","prudence","qui_est_refuges.info","liens","don","mentions-legales") as $nom_lien)
        $lien_wiki[$nom_lien]=lien_wiki($nom_lien);
    return $lien_wiki;
}
