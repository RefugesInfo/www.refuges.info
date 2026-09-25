<?php
if(empty($config_wri['debug'])) { // Libs en mode debug
  add_lib('leaflet/dist/leaflet.js', 'chemin_leaflet');
  add_lib('markercluster/dist/leaflet.markercluster.js', 'chemin_leaflet');
  add_lib('fullscreen/dist/Leaflet.fullscreen.min.js', 'chemin_leaflet');
  add_lib('Coordinates/dist/Leaflet.Coordinates-0.1.5.min.js', 'chemin_leaflet');
  add_lib('gps/dist/leaflet-gps.min.css', 'chemin_leaflet');
  add_lib('gps/dist/leaflet-gps.min.js', 'chemin_leaflet');
} else { // Libs en mode prod
  add_lib('leaflet/dist/leaflet-src.js', 'chemin_leaflet');
  add_lib('markercluster/dist/leaflet.markercluster-src.js', 'chemin_leaflet');
  add_lib('fullscreen/dist/Leaflet.fullscreen.js', 'chemin_leaflet');
  add_lib('Coordinates/dist/Leaflet.Coordinates-0.1.5.src.js', 'chemin_leaflet');
  add_lib('gps/dist/leaflet-gps.src.css', 'chemin_leaflet');
  add_lib('gps/dist/leaflet-gps.src.js', 'chemin_leaflet');
} // Libs n'ayant pas de mode debug
add_lib('leaflet/dist/leaflet.css', 'chemin_leaflet');
add_lib('markercluster/dist/MarkerCluster.css', 'chemin_leaflet');
add_lib('markercluster/dist/MarkerCluster.Default.css', 'chemin_leaflet');
add_lib('fullscreen/dist/leaflet.fullscreen.css', 'chemin_leaflet');
add_lib('Coordinates/dist/Leaflet.Coordinates-0.1.5.css', 'chemin_leaflet');
add_lib('FeatureGroup.SubGroup/src/subgroup.js', 'chemin_leaflet');
add_lib('geocoder/Control.Geocoder.css', 'chemin_leaflet');
add_lib('geocoder/Control.Geocoder.js', 'chemin_leaflet');
add_lib('myLeaflet.css', 'chemin_leaflet');
add_lib('myLeaflet.js', 'chemin_leaflet');
add_lib('_cartes_leaflet.js');
