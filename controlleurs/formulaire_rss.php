<?php
/**********************************************************************************************
Préparer un lien d'exportation direct de nos données vers plein de formats pour être 
ré-utiliser.
Le traitement proprement dit est dans exportations.php 
**********************************************************************************************/

require_once ("wiki.php");
require_once ("bdd.php");

$vue->titre="Flux RSS des nouvelles du site Refuges.info";

// comme on se "post" les informations à soit même, on vérifie dans quel cas on est
if (!isset($_POST['validation'])) // rien de valider, formulaire vierge
{
    $vue->types_de_nouvelles = new stdClass; // objet contenant les type de nouvelles (en tant quobjets eux memes)
    $vue->massifs = new stdClass;

    // LES TYPES DE POINTS ====================================
    $vue->types_de_nouvelles->nom_type = ["Commentaires", "Refuges", "Tous les points", "Messages des forums"];
    $vue->types_de_nouvelles->checked = [1, 1, 1, 0];
    $vue->types_de_nouvelles->id_nouvelle_type = ["commentaires", "refuges", "points", "forums"];

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
        if ( !isset($_GET['id_massif']) OR  ( (array) $_GET['id_massif'] == $massif->id_polygone ) )
            $vue->massifs->$index->checked = true;
    }
}
else // formulaire validé, affichage du lien et d'un blabla
{
    $vue->lien_export = new stdClass; // contiendra: URL, description ...
    $vue->lien_licence = lien_wiki("licence");

    if ($_POST['id_nouvelle_type']=="" OR $_POST['id_massif']=="")
        $vue->lien_export->description="Vous demandez vraiment quelque chose de vide ??";
    else
    {
        $liste_id_nouvelle_type = implode(',',$_POST['id_nouvelle_type']);
        $liste_id_massif = implode(',',$_POST['id_massif']);
    
        $options_lien="format=rss&amp;format_texte=html&amp;type=$liste_id_nouvelle_type&amp;massif=$liste_id_massif";
    
        $vue->lien_export->url = "http://".$config_wri['nom_hote']."/api/contributions?$options_lien";
    } 
    $vue->type="formulaire_rss_validation";
} // fin du else affichage lien

?>