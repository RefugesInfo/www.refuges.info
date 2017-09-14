<?php
/**********************************************************************************************
Préparer un lien d'exportation direct de nos données vers plein de formats pour être 
ré-utiliser.
Le traitement proprement dit est dans exportations.php 
**********************************************************************************************/

require_once ("bdd.php");
require_once ("meta_donnee.php");

$vue->titre="Téléchargement et exportation de la base refuges.info aux formats $formats";

// FIXME sly: à découper en deux fichiers pour plus de lisibilité comme on se "post" les informations à soit même, on vérifie dans quel cas on est
if (!isset($_POST['validation'])) // rien de valider, formulaire vierge
{
    $vue->points = new stdClass; // objet contenant les type de points (en tant quobjets eux memes)
    $vue->massifs = new stdClass;

    // LES TYPES DE POINTS ====================================
    $types_de_point = infos_base()->types_point ;
  $vue->types_de_point=new stdClass;
    foreach ( $types_de_point AS $index => $type_de_point ) 
    {
        $objet_vide=new stdClass;
        $vue->types_de_point->$index = $objet_vide;
        $vue->types_de_point->$index->nom_type = $type_de_point->nom_type;
        $vue->types_de_point->$index->id_point_type = $type_de_point->id_point_type;
        if (in_array($type_de_point->id_point_type, (array) $_GET['id_point_type']) OR $type_de_point->importance > 62)
            $vue->types_de_point->$index->checked = true;
    }

    // LES MASSIFS/ZONES ======================================
    // Creation d'une case à cocher pour chaque type massif
    // exploite le champs id_zone renvoyé par infos_polygones
  
    $conditions = new stdClass;
    $conditions->ids_polygone_type=$config_wri['id_massif'];
    $conditions->ordre = "id_zone,nom_polygone"; // classe les massifs par zone
    $conditions->avec_zone_parente=True;
    $massifs=infos_polygones($conditions);

    foreach ( $massifs AS $index => $massif ) 
    {
        $vue->massifs->$index = new stdClass;
        $vue->massifs->$index->nom_polygone = $massif->nom_polygone ;
        $vue->massifs->$index->id_polygone = $massif->id_polygone ;
        $vue->massifs->$index->id_zone = $massif->id_zone ;
        $vue->massifs->$index->nom_zone = $massif->nom_zone ;
        if ( !isset($_GET['id_massif']) OR  ( (array) $_GET['id_massif'] == $massif->id_polygone ) )
            $vue->massifs->$index->checked = true;
    }
}
else // formulaire validé, affichage du lien et d'un blabla
{
    $vue->lien_export = new stdClass; // contiendra: URL, description ...
    $vue->lien_licence = lien_wiki("licence");
    $vue->format=$_POST['format'];

    if ($_POST['id_point_type']=="" OR $_POST['id_massif']=="")
        $vue->lien_export->description="Vous demandez vraiment quelque chose de vide ?";
    else
    {
        $liste_id_point_type = implode(',',$_POST['id_point_type']);
        $liste_id_massif = implode(',',$_POST['id_massif']);
    
        if ($_POST['format']=="gpx")
            $mode_complet="&amp;detail=complet";
        else
            $mode_complet="";
        $options_lien="?nb_points=all$mode_complet&amp;format=".$_POST['format']."&amp;type_points=$liste_id_point_type&amp;massif=$liste_id_massif";
    
        $vue->lien_export->url = "/api/massif$options_lien";
    } 
    $vue->type="formulaire_exportations_validation";
} // fin du else affichage lien

?>
