<?php
/**********************************************************************************************
Renvoi un fichier au format souhaité contenant les données souhaitées en provenance de notre base
le lien d'accès à pour format :
http://<site>/exportation/exportations.php?format=kmz&
Ne pas changer l'adresse à la légère :
ATTENTION : des sites partenaires sont peut-être basés sur cette adresse!

**********************************************************************************************/

require_once ("../includes/config.php");
require_once ("exportation.php");

//Nous allons récupérer la liste des points souhaités en fonction des paramètres demandés
//Pour des raisons de performance de la carte gmaps qui ne demande pas de limite, on ne donne 
//qu'un nombre limité de points, les exportations devront penser à passer &limite=sans pour tout avoir

$conditions = new stdClass;
if (!$_GET["limite"])
	$conditions->limite=$config['defaut_max_nombre_point'];
elseif ($_GET["limite"]!="sans")
	$conditions->limite = $_GET ["limite"]; 
// si code spécial &limite=sans alors pas de limite	du tout (genre ça peut faire 3000 points ou plus cette histoire !)

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

// FIXME sly : Si les paramètres en GET était synchro avec ceux de $conditions-> on aurait alors plus besoin de faire cette 
// recopie
$conditions->ids_types_point=$_GET['liste_id_point_type'];
$conditions->pas_les_points_caches=1;
$conditions->ordre="point_type.importance DESC";
$conditions->ids_points=$_GET['liste_id_point'];
$conditions->ids_polygones=$_GET['liste_id_massif'];
$conditions->avec_infos_massif=True;

$format_export=$_GET['format'];

/* cas spécial du format gpi (ou n'importe quel autre qu'on voudrait gérer par gpsbabel en fait) on passe par du gpx et 
 on laisse gpsbabel faire la conversion, je pourrais l'incorporer à la fonction elle même qui ferait alors un très
 joli appel à elle-même, mais pour des raisons de chemins d'accès à gpsbabel ça ne marcherait de toute façon pas
 partout sly 30/10/10
 sly : FIXME : je vais peut-être changer d'avis vu comment ce code grossi
*/
if ($format_export=="gpi")
{
    $infos_donnees_exportees=fichier_exportation($conditions,"gpx-garmin");
    if (!$infos_donnees_exportees->erreur)
    {
        // On va éviter de passer par un fichier local car c'est une plaie pour plusieurs raisons
        $descriptorspec = array(
        0 => array("pipe", "r"), // stdin is a pipe that the child will read from
        1 => array("pipe", "w"), // stdout is a pipe that the child will write to
        );
        $process = proc_open("gpsbabel -w -r -t -i gpx -f - -o garmin_gpi -F -", $descriptorspec, $pipes);
        // On lui passe en entré notre gpx
        fwrite($pipes[0], $infos_donnees_exportees->contenu);
        fclose($pipes[0]);
        $osm_node_only="";
        $infos_donnees_exportees->contenu=stream_get_contents($pipes[1]);
        fclose($pipes[1]);
    }
}
else
  /*** Appel à la fonction principal qui nous fourni notre fichier, selon le format ***/
  $infos_donnees_exportees=fichier_exportation($conditions,$format_export);

if ($infos_donnees_exportees->erreur)
    die($infos_donnees_exportees->message);

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
header("Access-Control-Allow-Origin: *");
print($infos_donnees_exportees->contenu);


?>
