<?php
/**********************************************************************************************
Renvoi un fichier au format souhaité contenant les données souhaitées en provenance de notre base
le lien d'accès à pour format :
http://<site>/exportation/exportations.php?format=kmz&
Ne pas changer l'adresse à la légère :
ATTENTION :Openlayers est basé sur cette adresse, l'export aussi,
des sites partenaires aussi peut-être !

**********************************************************************************************/

require_once ("../modeles/config.php");
require_once ("fonctions_exportations.php");

//Nous allons récupérer la liste des points souhaités en fonction des paramètres demandés
//Pour des raisons de performance de la carte gmaps qui ne demande pas de limite, on ne donne 
//qu'un nombre limité de points, les exportations devront penser à passer &limite=sans pour tout avoir
//sly 
//Pour plus de flexibilité, il me semblerait plus logique de laisser le soin aux applications de faire elles même leur choix de limite
//et que par défaut il n'y ait pas de limite justement
// Peut-être au passage au tout OpenLayers il serait bien d'y passer sly 28/10/2010

// MODIF DOMINIQUE : utilisé par OpenLayers
$conditions = new stdClass;
if (!$_GET["limite"])
	$conditions->limite=120;
else if ($_GET["limite"]!="sans")
	$conditions->limite = $_GET ["limite"]; 
	
// DOMINIQUE : Ajout du paramètre bbox au format utilisé par OpenLayers
// SLY : remplacement de l'ancien format pour ne garder que celui d'openlayers : &bbox=ouest,sud,est,nord
// Note : on pourrait passer directement la bbox vu que infos_points peut la gérer directement, mais la procédure d'exportation à parfois besoin de faire des décallages
// de coordonnées pour l'affichage auquel cas, elle a besoin d'avoir le détail nord/ouest/sud/est
if (isset ($_GET['bbox']))
{
  $bbox=explode(",",$_GET['bbox']);
  $conditions->sud=$bbox [1];
  $conditions->nord=$bbox [3];
  $conditions->ouest=$bbox [0];
  $conditions->est=$bbox [2];
	// jmb: conditions->geometrie contient la BBOX de recherche
	// en theorie, il faudrait supprimer le nord/sud/est/ouest, mais j'ai fait assez de conneries aujourdhui
	$conditions->geometrie = cree_geometrie($_GET['bbox'], 'bboxOL');

}


$conditions->type_point=$_GET['liste_id_point_type'];
$conditions->pas_les_points_caches=1;
$conditions->ordre="point_type.importance DESC";
$conditions->ids_points=$_GET['liste_id_point'];
$conditions->id_polygone=$_GET['liste_id_massif'];
$conditions->avec_infos_massif=True;

$format_export=$_GET['format'];

/* cas spécial du format gpi (ou n'importe quel autre qu'on voudrait gérer par gpsbabel en fait) on passe par du gpx et 
 on laisse gpsbabel faire la conversion, je pourrais l'incorporer à la fonction elle même qui ferait alors un très
 joli appel à elle-même, mais pour des raisons de chemins d'accès à gpsbabel ça ne marcherait de toute façon pas
 partout sly 30/10/10
*/
if ($format_export=="gpi")
{
  $en_gpx=fichier_exportation($conditions,"gpx-garmin");
  $name=rand(1,2000);
  file_put_contents("./$name",$en_gpx->contenu);
  $gpi=shell_exec("cat ./$name | gpsbabel -w -r -t -i gpx -f - -o garmin_gpi -F -");
  $infos_donnees_exportees->contenu=$gpi;
  $infos_donnees_exportees->nom_fichier=$en_gpx->nom_fichier;
  unlink($name);
}
else
  /*** Appel à la fonction principal qui nous fourni notre fichier, selon le format ***/
  $infos_donnees_exportees=fichier_exportation($conditions,$format_export);

// Nos données ne changent pas toutes les secondes, on peut autoriser le client à faire un peu de cache pour accélérer
$secondes_de_cache = 60;
$ts = gmdate("D, d M Y H:i:s", time() + $secondes_de_cache) . " GMT";
header("Content-disposition: attachment; filename=$infos_donnees_exportees->nom_fichier.".$config['formats_exportation'][$format_export]['extension_fichier']);
header("Content-Type: ".$config['formats_exportation'][$format_export]['content_type']."; ".$config['encodage_exportation']); // rajout du charset
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($infos_donnees_exportees->contenu));
header("Pragma: cache");
header("Expires: $ts");
header("Cache-Control: max-age=$secondes_de_cache");
print($infos_donnees_exportees->contenu);


?>
