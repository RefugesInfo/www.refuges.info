<?php
// Editeur de massifs

if (!est_moderateur()) {
  $vue->type="page_simple";
  $vue->titre=_("Permissions insuffisantes");
  $vue->contenu=_("Désolé, mais pour cette opération vous devez être modérateur et être connecté au forum :");
  return "";
}

// Bon, on triche un peu ici: on factorise un max avec /nav
require_once ("nav.php");
require_once ("polygone.php");
require_once ("leaflet_libs.php");
add_lib('geoman/leaflet-geoman.js', 'chemin_leaflet');

// Quelques trucs spécifiques
if(!isset($vue->polygone) && isset($vue->contenu))
  $vue->polygone = $vue->contenu; // En édition, c'est la même chose

// Définition d'un nom par défaut à la création pour éviter de perdre tout son travail de dessin de contour
if(isset($vue->polygone) && !isset($vue->polygone->nom_polygone))
  $vue->polygone->nom_polygone='Nom';

if (isset($polygone))
  $vue->titre=($config_wri['langue_courante']=='fr') ? "Modification $polygone->article_partitif $polygone->type_polygone $polygone->article_partitif $polygone->nom_polygone"
    : sprintf(_("Modification %s"), sprintf(_("le %2\$s %1\$s"), _($polygone->type_polygone), $polygone->nom_polygone));
else
  $vue->titre=_("Création d'un polygone");

$vue->liste_type_polygone=liste_type_polygone();
