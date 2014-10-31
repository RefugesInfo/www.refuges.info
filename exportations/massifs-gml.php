<?php 
/* Génère le flux GML décrivant les massifs 
Prend en paramètre massif.php?bbox=une bbox&massif=(des ids de polygones 5 ou 7,8)&polygone_type=(un type de polygone)
*/

require_once ("../includes/config.php");
require_once ("bdd.php");
require_once ("autoconnexion.php");
require_once ("polygone.php");
require_once ("gestion_erreur.php");

// Si on a des infos remontées, on les mémorise
if ($data = file_get_contents ('php://input')) // Récupération du flux en méthode PUT
{
    $FeatureCollection = simplexml_load_string (str_replace (array ('gml:', 'feature:'), '', $data));

    // Polygones
    foreach ($FeatureCollection as $featureMember)
    foreach ($featureMember     as $features)
    foreach ($features          as $attributes)
    foreach ($attributes        as $geometry)
    foreach ($geometry          as $polygonMember)
    foreach ($polygonMember     as $Polygon)
    foreach ($Polygon           as $outerBoundaryIs)
    foreach ($outerBoundaryIs   as $LinearRing)
    foreach ($LinearRing        as $coordinates)
        $polygons [] = geom_polygon ($coordinates);

    // LineStrings (c'est sous cette forme que l'éditeur rend les polygones créés ou modifiés
    foreach ($FeatureCollection as $features)
    foreach ($features          as $attributes)
    foreach ($attributes        as $geometry)
    foreach ($geometry          as $LineString)
    foreach ($LineString        as $coordinates)
    if ((string) $coordinates)
        $polygons [] = geom_polygon ($coordinates);

    $query = "UPDATE polygones SET (geom) = (ST_GeomFromText('MULTIPOLYGON(" .implode (',', $polygons). ")',4326)) WHERE id_polygone=".$_GET['massif'];
    if (!$pdo->exec($query)) {
        header('HTTP/1.0 500 '.$pdo->errorInfo()[2]);
        exit;
    }
}
function geom_polygon ($c) {
    $c = str_replace (',', ';', $c);
    $c = str_replace (' ', ',', $c);
    $c = str_replace (';', ' ', $c);

    // On ferme le polygone si ce n'est pas le cas
    if ($c)
    {
        $cs = explode (',', $c);
        if ($cs[0] != $cs[count($cs)-1])
        {
            $cs [] = $cs[0];
            $c = implode (',', $cs);
        }
    }

    return "(($c))";
}

// Maintenant, on s'occupe du flux descendant

// Générateur de couleurs qui tournent autour du cercle colorimétrique
$no_coul =   0; // Le numéro de la couleur du massif va s'incrémenter
$pas     =   7; // On tourne de $pas à chaque polynome pour bien répartir les couleurs
// FIXME, le nombre de massif change !
$nb_coul =  44; // Jusqu'au massif 44 
$ymin    =   0; // Luminance min
$ymax    = 200; // Luminance max
$b = ($ymin + $ymax) / 2; // Coefs du calcul
$a = 256 + $b; // +256 pour bénéficier du 0 à gauche quand on passe en hexadécimal

$conditions = new stdClass;
$vue = new stdClass;

// Ici on a demandé un nombre fini de massif solitaires
if (isset($_GET['massif']))
  $conditions->ids_polygones=$_GET['massif'];
else
{
  // ici on nous précise un type de polygones à récupérer
  if (isset($_GET['polygone_type']))
    $conditions->ids_polygone_type = $_GET['polygone_type'];
  else // sinon on choisi les massifs uniquement
    $conditions->ids_polygone_type = $config['id_massif'];
}
if (isset($_GET['bbox']))
	$conditions->geometrie = cree_geometrie($_GET['bbox'], 'bboxOL' ) ;
$conditions->avec_geometrie='gml';
$polygones=infos_polygones($conditions);

if ($polygones)
  foreach ($polygones as $polygone ) 
  {
    // Couleur attribuée autour du cercle des couleurs.
    $cr = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul               )), -2);
    $cv = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul + 2 * M_PI / 3)), -2);
    $cb = substr (dechex ($a + $b * cos (M_PI * $no_coul / $nb_coul + 4 * M_PI / 3)), -2);
    $no_coul += $pas;
    
    if ($polygone->geometrie_gml) // On n'envoie pas les polygones vides
    {
        $polygone_export = new stdClass;
        //On pourrait tout aussi bien envoyer tous les champs du polygone donc de notre base directement
        // mais ça ferait des trucs un peu inutile donc sélection :
        $polygone_export->feature_name="massif";
        $polygone_export->proprietes['nom']=c($polygone->nom_polygone);
        $polygone_export->proprietes['color']="#$cb$cv$cr";
        $polygone_export->proprietes['url']=lien_polygone($polygone,False);
        $polygone_export->geometrie_gml=$polygone->geometrie_gml;
        $polygone_export->geometrie_geojson = '['.str_replace(' ','],[',strip_tags($polygone->geometrie_gml).']');

        $vue->features[]=$polygone_export;
    }
  }

$vue->content_type="UTF-8";
$vue->nom_fichier_export="polygones";
$vue->description="Limites de massifs montagneux provenants du site ".$config['nom_hote'];

// On affiche le tout
$vue->type = 'exportations/export_'.($_GET['format'] ? $_GET['format'] : 'gml');
include ($config['chemin_vues']."$vue->type.php");
?>