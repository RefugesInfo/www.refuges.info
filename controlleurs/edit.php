<?php
// Editeur de massifs

if (!est_moderateur()) {
  $vue->type="page_simple";
  $vue->titre=_("Permissions insuffisantes");
  $vue->contenu=_("Désolé, mais pour cette opération vous devez être modérateur et être connecté au forum :");
  return "";
}

require_once ("polygone.php");
require_once ("leaflet_libs.php");
add_lib('geoman/leaflet-geoman.js', 'chemin_leaflet');
add_lib('geoman/leaflet-geoman.css', 'chemin_leaflet');

// Récupération des informations du polygone à éditer
if(!empty($controlleur->url_decoupee[1])) {
  $params = new stdClass();
  $params->ids_polygones = $controlleur->url_decoupee[1];
  $params->avec_geometrie = 'geojson';
  $polygones_bruts = infos_polygones($params);
  
  if(count($polygones_bruts)) {
    $vue->polygone = $polygones_bruts[0];
    $vue->titre = implode(' ', [
      'Modifier',
      $vue->polygone->art_def_poly,
      $vue->polygone->type_polygone,
      $vue->polygone->article_partitif,
      $vue->polygone->nom_polygone,
    ]);
    // Le défaut et la traduction seront faites dans edit.html
  }
}

$vue->liste_type_polygone = liste_type_polygone();
