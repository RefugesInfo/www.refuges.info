<?php
/**********************************************************************************************
Préparer un lien d'exportation direct de nos données vers plein de formats pour êtreré-utiliser.
Le traitement proprement dit est dans exportations.php
**********************************************************************************************/

require_once ("wiki.php");
require_once ("bdd.php");

$vue->titre="flux RSS ou de la page des nouvelles du site Refuges.info";
$vue->lien_licence = lien_wiki("licence");

// Pour que ça marche, il faut au moins 1 massif et au moins 1 type de nouvelles de cochées
if (!empty($_REQUEST['types_de_nouvelles']) and !empty($_REQUEST['id_massif']) )
{
  $types_de_nouvelles = implode(',',$_REQUEST['types_de_nouvelles']);
  $liste_id_massif = implode(',',$_REQUEST['id_massif']);

  if (!empty($_REQUEST['choix']) and $_REQUEST['choix']=='Obtenir le lien vers le flux RSS')
  {
    $schema = $_SERVER['HTTPS'] ? "https" : "http";
    $vue->url=$schema."://".$config_wri['nom_hote']."/api/contributions?format=rss&amp;format_texte=html&amp;type=$types_de_nouvelles&amp;massif=$liste_id_massif";
    $vue->titre_lien="Voici le lien vers le Flux RSS demandé, vous pouvez l'ajouter à votre agrégateur de flux RSS favoris (Clic-droit puis enregistrer sous)";
  }
  else
  {
    $vue->url="/nouvelles/?quoi=$types_de_nouvelles&amp;ids_polygones=$liste_id_massif";
    $vue->titre_lien="Lien vers les nouvelles personnalisées (vous pouvez la placer en marque page)";
  }
}
