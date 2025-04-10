<?php
/**********************************************************************************************
Préparer un lien d'exportation direct de nos données vers plein de formats pour être 
ré-utiliser.
Le traitement proprement dit est dans exportations.php 
**********************************************************************************************/

require_once ("wiki.php");
require_once ("bdd.php");

$vue->titre="flux RSS ou de la page des nouvelles du site Refuges.info";
$vue->lien_licence = lien_wiki("licence");

// Pour que ça marche, il faut au moins 1 massif et au moins 1 type de nouvelles de cochées
if (!empty($_REQUEST['id_nouvelle_type']) and !empty($_REQUEST['id_massif']) )
{
  $liste_id_nouvelle_type = implode(',',$_REQUEST['id_nouvelle_type']);
  $liste_id_massif = implode(',',$_REQUEST['id_massif']);
  
  $options_lien="format=rss&amp;format_texte=html&amp;type=$liste_id_nouvelle_type&amp;massif=$liste_id_massif";
  if (isset($_SERVER['HTTPS']))
    $schema="https";
  else
    $schema="http";
  $vue->url = $schema."://".$config_wri['nom_hote']."/api/contributions?$options_lien";
  $vue->titre_lien="Voici le lien vers le Flux RSS demandé, vous pouvez l'ajouter à votre agrégateur de flux RSS favoris (Clic-droit puis enregistrer sous)";
} 

