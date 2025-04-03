<?php 
/* Page d'affichage des news
Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...
*/


require_once ("nouvelle.php");
require_once ("commentaire.php");

$vue->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';
if (isset($_GET['nombre']) and is_numeric($_GET['nombre']))
    $nombre = $_GET['nombre'];
else
    $nombre = $config_wri['defaut_nombre_nouvelles_page_nouvelles'];

$vue->types_nouvelles = $_GET ['quoi'] ??  'points,forums,commentaires';
$vue->nouvelles = nouvelles ($nombre,$vue->types_nouvelles);

$vue->nouvelles_generales=wiki_page_html("nouvelles_generales");
$vue->nombre = $nombre+100;

// Pour une raison qui m'échappe, le robot google appel cette page avec nombre=56200 puis 56300 puis 56400, quelle qu'en soit la raison, soyons raisonnable, aucune raison d'appeler cette page avec autant, ça va rendre une page html gigantesque !
if ($vue->nombre > 2000 )
  $vue->nombre = 2000;

$vue->stat = stat_site ();

