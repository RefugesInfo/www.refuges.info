<?php 
/* 
 * Page d'affichage des news
*/

require_once ("nouvelle.php");
require_once ("commentaire.php");

$vue->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';
if (isset($_GET['nombre']) and is_numeric($_GET['nombre']))
    $nombre = $_GET['nombre'];
else
    $nombre = $config_wri['defaut_nombre_nouvelles_page_nouvelles'];

$vue->types_nouvelles = $_GET ['quoi'] ??  'points,forums,commentaires';
if (!empty($_GET ['ids_polygones']))
  $vue->ids_polygones = "&amp;ids_polygones=" . $_GET ['ids_polygones'];

// Pour une raison qui m'échappe, le robot google appel cette page avec nombre=56200 puis 56300 puis 56400, quelle qu'en soit la raison, soyons raisonnable, aucune raison d'appeler cette page avec autant, ça va rendre une page html gigantesque !
if ($nombre > 2000 )
  $nombre = 2000;

$vue->nouvelles = nouvelles ($nombre,$vue->types_nouvelles,$_GET['ids_polygones'] ?? Null);

// Le modèle des nouvelles a rencontré une erreur
if (!empty($vue->nouvelles->erreur))
{
    $vue->type="page_simple";
    // On affiche le message d'erreur spécifique retourné par le modèle
    $vue->contenu=$vue->titre=$vue->nouvelles->message;
    // Avec un code 404 pour bien préciser aux moteurs de recherche qu'il n'y a pas de page valide pour cette url
    $vue->http_status_code=404;
}
else
{
  $vue->nouvelles_generales=wiki_page_html("nouvelles_generales");
  $vue->nombre = $nombre+100;
  $vue->stat = stat_site ();
}

