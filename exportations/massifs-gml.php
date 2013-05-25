<?php 
/* Génère le flux GML décrivant les massifs 
Prend en paramètre massif.php?bbox=une bbox&massif=(des ids de polygones 5 ou 7,8)&polygone_type=(un type de polygone)
*/

require_once ("../includes/config.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_gestion_erreurs.php");

// Si on a des infos remontées, on les mémorise
if ($data = file_get_contents ('php://input')) { // Récupération du flux en méthode PUT
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
        $coord [] = (string) $coordinates;

    // LineStrings
    foreach ($FeatureCollection as $features)
    foreach ($features          as $attributes)
    foreach ($attributes        as $geometry)
    foreach ($geometry          as $LineString)
    foreach ($LineString        as $coordinates)
    if ((string) $coordinates)
        $coord [] = (string) $coordinates;

    //=======================================================================================================
    //DOMINIQUE: TOTO: C'est là que je requiers l'aide des spacialistes PG pour remonter ce tablo dans la base
    file_put_contents ('trace.log', var_export ($coord, true));
    // Chaque ligne du tablo contient la liste des coordonnées d'un polygone
    //=======================================================================================================
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
    
    $polygone_export = new stdClass;
    //On pourrait tout aussi bien envoyer tous les champs du polygone donc de notre base directement
    // mais ça ferait des trucs un peu inutile donc sélection :
    $polygone_export->feature_name="massif";
    $polygone_export->proprietes['nom']=c($polygone->nom_polygone);
    $polygone_export->proprietes['color']="#$cb$cv$cr";
    $polygone_export->proprietes['url']=lien_polygone($polygone,False);
    $polygone_export->geometrie_gml=$polygone->geometrie_gml;
  
    $vue->features[]=$polygone_export;
  }

$vue->content_type="UTF-8";
$vue->nom_fichier_export="polygones";
$vue->description="Limites de massifs montagneux provenants du site ".$config['nom_hote'];
// On affiche le tout
$vue->type = 'exportations/export_gml';

include ($config['chemin_vues']."$vue->type.php");

?>
