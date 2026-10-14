<?php
/*******************************************************************************
Ecran d'accueil

Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...
*******************************************************************************/

require_once ("nouvelle.php");
require_once ("polygone.php");
require_once ("leaflet_libs.php");
add_lib('overpass/dist/OverPassLayer.bundle.js', 'chemin_leaflet');
add_lib('overpass/dist/OverPassLayer.css', 'chemin_leaflet');

$vue->titre = _('Carte et informations sur les refuges, cabanes et abris de montagne');
$vue->stat = stat_site ();

// Préparation de la liste des photos et commentaires récent(e)s
$conditions_nouveaux_commentaires = new stdclass();
$conditions_nouveaux_commentaires->limite=$config_wri['defaut_max_commentaires_recents'];
$conditions_nouveaux_commentaires->avec_infos_point=True;
$conditions_nouveaux_commentaires->ordre="date_creation DESC";
$vue->nouveaux_commentaires=infos_commentaires($conditions_nouveaux_commentaires);


$conditions_nouveaux_points = new stdclass();
$conditions_nouveaux_points->limite=$config_wri['defaut_max_ajouts_recents'];
$conditions_nouveaux_points->ordre="date_creation DESC";
$vue->nouveaux_points=infos_points($conditions_nouveaux_points);

$vue->type="index";

// Libellés des couches de la carte d'accueil (vues/index.js). La clé est l'identité de la couche (mémorisée dans le navigateur
// et cherchée dans couchesIconesWRI de _cartes_leaflet.js) : elle reste en français. Seul le libellé affiché est traduit.
$vue->libelles_couches = array(
  'Cabane non gardée' => mb_ucfirst(_('cabane non gardée')),
  'Refuge gardé' => mb_ucfirst(_('refuge gardé')),
  "Gîte d'étape" => mb_ucfirst(_("gîte d'étape")),
  'Abri naturel' => mb_ucfirst(_('abri naturel')),
  "Point d'eau" => mb_ucfirst(_("point d'eau")),
  'Passage délicat' => mb_ucfirst(_('passage délicat')),
  'Bâtiment à investiguer' => mb_ucfirst(_('bâtiment à investiguer')),
  'Régions' => _('Régions'),
  'Massifs' => _('Massifs'),
  'Itinéraires' => _('Itinéraires'),
);
$vue->bbox=$config_wri['bbox_page_accueil']; //point de vue et position initiale de la page

// Zones couvertes
$vue->zones_couvertes=[];
$conditions = new stdClass;
$conditions->ids_polygone_type=$config_wri['id_zone'];
$zones=infos_polygones($conditions);
if ($zones)
  foreach ($zones as $zone)
    $vue->zones_couvertes [ucfirst($zone->nom_polygone)] =
      lien_polygone($zone)."?id_polygone_type=".$config_wri['id_massif'];
