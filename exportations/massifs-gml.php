<?php 
/* Génère le flux GML décrivant les massifs 
Prend en paramètre massif.php?bbox=une bbox&massif=(des ids de polygones 5 ou 7,8)&polygone_type=(un type de polygone)
*/

require_once ("../modeles/config.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_polygones.php");
require_once ("fonctions_gestion_erreurs.php");


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
$modele = new stdClass();

// Ici on a demandé un nombre fini de massif solitaires
if (isset($_GET['massif']))
  $conditions->ids_polygones=$_GET['massif'];

// ici on nous précise un type de polygones à récupérer
if (isset($_GET['polygone_type']))
  $conditions->id_polygone_type = $_GET['polygone_type'];
else // sinon on choisi les massifs uniquement
  $conditions->id_polygone_type = $config['id_massif'];

if (isset($_GET['bbox']))
  $conditions->bbox=$_GET['bbox'];

$conditions->avec_geometrie='gmlol';
$polygones=infos_polygones($conditions);

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
  $polygone_export->geometrie_gml=$polygone->geometrie_gmlol;

  $modele->features[]=$polygone_export;
}

$modele->content_type="UTF-8";
$modele->nom_fichier_export="polygones";
$modele->description="Limites de massifs montagneux provenants du site ".$config['nom_hote'];
// On affiche le tout
$modele->type = 'exportations/export_gml';

include ($config['chemin_vues']."$modele->type.php");

?>
