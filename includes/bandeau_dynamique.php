<?php
/***
Fonctions qui permettent de générer dynamiquement du contenu quasi-statique du menu/bandeaux.
31/01/2021 sly : Il aurait pû aller dans la vue correspondante, mais je voulais limiter le code dans les vues pour qu'on y 
trouve que de la présentation
***/
require_once ('polygone.php');

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
