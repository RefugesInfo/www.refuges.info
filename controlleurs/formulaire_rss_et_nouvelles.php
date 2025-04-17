<?php
/********************************************************************************************************
Préparer des liens d'accès direct de nos nouvelles sous différents formats. 
Paramétrer son flux RSS ou paramétrer sa page des nouvelles sont tellemnet proches comme fonctionnalités
que j'ai un seul contrôleur et une seule vue pour les deux avec un switch. J'aurais aussi pû n'avoir qu'un seul contrôleur et 2 vues
que plutôt que faire 2 controlleurs identiques
Depuis 2008 : un flux RSS 
Depuis 2025 : la page des nouvelles "customisable"

NOTE : Ce formulaire est proche de l'exportation des points, peut-être qu'on pourrait factoriser un peu ?

********************************************************************************************************/

require_once ("wiki.php");
require_once ("bdd.php");

if (empty($_GET['choix']) or $_GET['choix'] == 'flux_rss' )
{
  $vue->titre="Paramétrez votre flux RSS";
  $vue->titre_bouton="Obtenir le lien vers le flux RSS";
}
else
{
 $vue->titre="Choisissez ce que vous souhaitez afficher pour votre page des nouvelles";
 $vue->titre_bouton="Obtenir un lien vers les nouvelles demandées";
}
  
 
$vue->massifs = new stdClass;

// LES MASSIFS/ZONES ======================================
// Creation d'une case à cocher pour chaque type massif
// exploite le champs id_zone renvoyé par infos_polygones
// FIXME sly: Ce code est présent à l'identique dans le formulaire pour le RSS et l'exportation, peut-être penser à factoriser un jour.
// FIXME sly: en outre, autant quand il y avait ~20 massifs dans notre base s'était gérable de cliquer ce qu'on veut, là, c'est vraiment énorme ce formulaire, je pense qu'il faudrait passer à un truc plus dynamique avec recherche, un peu comme la recherche, un autre idée, parce que là, en 2025, avec 480 cases à cocher, pas simple de trouver ce qu'on veut !

$conditions = new stdClass;
$conditions->ids_polygone_type=$config_wri['id_massif'];
$conditions->ordre = "id_zone,nom_polygone"; // classe les massifs par zone, et au sein d'une zone range les par nom
$conditions->avec_zone_parente=True;
$massifs=infos_polygones($conditions);

foreach ( $massifs AS $index => $massif ) 
{
  $vue->massifs->$index = new stdClass;
  $vue->massifs->$index->nom_polygone = $massif->nom_polygone ;
  $vue->massifs->$index->id_polygone = $massif->id_polygone ;
  $vue->massifs->$index->id_zone = $massif->id_zone ;
  $vue->massifs->$index->nom_zone = $massif->nom_zone ;
}

