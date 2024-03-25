<?php
/***
Fonctions qui permettent de générer dynamiquement du contenu quasi-statique du menu/bandeau.
31/01/2021 sly : Il aurait pû aller dans le controlleur de la vue du bandeau, mais son controlleur c'est la route generale, et ça fait déjà lourd de code là bas
trouve que de la présentation
***/
require_once ('polygone.php'); // Nécessaire pour générer le menu des zones couvertes
require_once ('wiki.php');
require_once ('meta_donnee.php'); // Pour la liste des types de points

function remplissage_zones_bandeau() // Note 2024, cette liste n'est plus utilisée dans le bandeau, juste sur la page d'accueil, on pourrait mettre ça ailleurs...
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
    $conditions_attente_correction->avec_points_caches=True;
    $commentaires_attente_correction=infos_commentaires($conditions_attente_correction);

    if (count($commentaires_attente_correction)>0)
        return true;
    else
        return false;
}
// Fonction qui va permettre ensuite d'afficher la "petite étoile :☆" en haut à coté du nom du modérateur
// Pour le prévenir si un email envoyé par le forum est resté bloqué
function info_email_bounce ()
{
  global $pdo;
  $query_emails_erreur="select * from emails_bounce where a_traiter='t' LIMIT 1";
  if (! ($res = $pdo->query($query_emails_erreur)))
    return false; // Pas une erreur gràve, on échoue silencieusement
  
  if (count($res->fetchAll())==0)
    return false;
  else
    return true;
}
// Cette fonction permet de préparer le menu des pages d'aide
function prepare_lien_wiki_du_bandeau()
{
    foreach (array("index","licence","prudence","qui_est_refuges.info","liens","don","mentions-legales","cookies") as $nom_lien)
        $lien_wiki[$nom_lien]=lien_wiki($nom_lien);
    return $lien_wiki;
}
