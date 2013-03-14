<?php
/**********************************************************************************************
Préparer un lien d'exportation direct de nos données vers plein de formats pour être 
ré-utiliser.
Le traitement proprement dit est dans exportations.php 
**********************************************************************************************/

require_once ("../modeles/config.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_bdd.php");
require_once ("fonctions_exportations.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_meta_donnees.php");

$modele = new stdclass;
$modele->etapes = new stdClass; // liste des titres d'aides: licence, baratin ...

$formats="";
foreach ($config['formats_exportation'] as $formats_possibles)
  if ($formats_possibles['interne']==false)
    $formats.=$formats_possibles['description_courte'].", ";

$modele->titre="Téléchargement et exportation de la base refuges.info aux formats $formats";

// comme on se "post" les informations à soit même, on vérifie dans quel cas on est
if (!isset($_POST['validation'])) // rien de valider, formulaire vierge
{
    $modele->points = new stdClass; // objet contenant les type de points (en tant quobjets eux memes)
    $modele->massifs = new stdClass;

    $modele->etapes->options = new stdClass ;
    $modele->etapes->options->titre = "Options d'exportations";
    $modele->etapes->options->texte = "Veuillez préciser les options des points et des massifs";

    // LES TYPES DE POINTS ====================================
    $types_de_point = infos_base()->types_point ;
  
    // faudrait normaliser tout ça
    foreach ( $types_de_point AS $index => $point ) 
    {
        $modele->points->$index = new stdClass;
        $modele->points->$index->nom_type = $point->nom_type;
        $modele->points->$index->nom_icone = $point->nom_icone;
        $modele->points->$index->id_point_type = $point->id_point_type;
        if (in_array($point->id_point_type, (array) $_GET['id_point_type']) OR $point->importance > 62)
            $modele->points->$index->checked = true;
    }

    // LES MASSIFS/ZONES ======================================
    // Creation d'une case à cocher pour chaque type massif
    // exploite le champs id_zone renvoyé par infos_polygones
  
    $conditions = new stdClass;
    $conditions->ids_polygone_type=$config['id_massif'];
    $conditions->ordre = "id_zone"; // classe les massifs par zone

    $massifs=infos_polygones($conditions);

    foreach ( $massifs AS $index => $massif ) 
    {
        $modele->massifs->$index = new stdClass;
        $modele->massifs->$index->nom_polygone = $massif->nom_polygone ;
        $modele->massifs->$index->id_polygone = $massif->id_polygone ;
        $modele->massifs->$index->id_zone = $massif->id_zone ;
        $modele->massifs->$index->nom_zone = $massif->nom_zone ;
        if ( !isset($_GET['id_massif']) OR  ( (array) $_GET['id_massif'] == $massif->id_polygone ) )
            $modele->massifs->$index->checked = true;
    }
    
    // LA BBOX au choix =========================================
    // ca sert encore ?
    if(isset($_GET["sud"]) ) 
    {
        $modele->bbox = new stdClass;
        $modele->bbox->nord = $_GET["nord"];
        $modele->bbox->sud = $_GET["sud"];
        $modele->bbox->ouest = $_GET["ouest"];
        $modele->bbox->est = $_GET["est"];
    }
}
else // formulaire validé, affichage du lien et d'un blabla
{
    $modele->lien_export = new stdClass; // contiendra: URL, description ...

    // ===== BLA BLA
    $modele->etapes->licence = new stdClass ;
    $modele->etapes->licence->titre = "Licence";
    $modele->etapes->licence->texte = "<a href=\"".lien_mode_emploi("licence")."\">Voir les détails sur la licence de refuges.info</a>";
    
    $modele->etapes->export = new stdClass ;
    $modele->etapes->export->titre = "Exportation demandée";
    $modele->etapes->export->texte = "Voici le lien permanent d'accès direct aux données";

	if ($_POST['id_point_type']=="" OR $_POST['id_massif']=="")
        $modele->lien_export->description="Vous demandez vraiment quelque chose de vide ??";
	else
	{
        //ya plus de description ?
        //$modele->lien_export->description= $config['formats_exportation'][$_POST['format']]['description'] ;
	
        $liste_id_point_type = implode(',',$_POST['id_point_type']);
        $liste_id_massif = implode(',',$_POST['id_massif']);

		// limiter à une bbox (si demandé depuis les cartes)
        if(isset($_POST['sud']) ) 
            $bbox = implode(',',array($_POST['ouest'], $_POST['sud'], $_POST['est'], $_POST['nord']) ) ;
		
        $options_lien="?limite=sans&amp;format=".$_POST['format']."&amp;liste_id_point_type=$liste_id_point_type&amp;liste_id_massif=$liste_id_massif" . (string) $bbox;
		
        $modele->lien_export->url = "http://".$config['nom_hote']."/exportations/exportations.php$options_lien";
    } 
} // fin du else affichage lien


// On affiche le tout
$modele->type = 'exportations/formulaire_exportations';
$modele->java_lib[]="/vues/formulaire_exportations.js";
include ($config['chemin_vues']."_entete.html");
include ($config['chemin_vues']."$modele->type.html");
include ($config['chemin_vues']."_pied.html");

?>
