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
  
 
$vue->types_de_nouvelles = new stdClass; // objet contenant les type de nouvelles (en tant quobjets eux memes)
$vue->massifs = new stdClass;

// LES TYPES DE POINTS ====================================
$vue->types_de_nouvelles->types_de_nouvelles_en_francais = $config_wri['types_de_nouvelles_en_francais'];
$vue->types_de_nouvelles->checked = [1, 1, 1, 0];
$vue->types_de_nouvelles->types_de_nouvelles = $config_wri['types_de_nouvelles'];

// LES MASSIFS/ZONES ======================================
// Creation d'une case à cocher pour chaque type massif
// exploite le champs id_zone renvoyé par infos_polygones

$conditions = new stdClass;
$conditions->ids_polygone_type=$config_wri['id_massif'];
$conditions->ordre = "id_zone"; // classe les massifs par zone
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

