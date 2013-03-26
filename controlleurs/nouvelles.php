<?php 
// Page d'affichage des news

// Contient le code PHP de la page
// Le code html est dans /vues/*.html
// Le code javascript est dans /vues/*.js
// Les variables sont passées dans l'objet $vue->...

// 2010 sly : Une grosse partie du code a été déporté dans le fichier de fonctions : fonctions_nouvelles.php
// 08/10/11 Dominique : Utilisation des templates
// 30/05/12 Dominique : Retour en modeles simples

require_once ("fonctions_nouvelles.php");
require_once ("fonctions_commentaires.php");

// Conteneur standard de l'entête et pied de page
$vue->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';
if (isset($_GET['nombre']) and is_numeric($_GET['nombre']))
    $nombre = $_GET['nombre'];
else
    $nombre = 15;
    
if (isset($_GET['general']) and is_numeric($_GET['general']))
    $nombre_nouvelles_generales = $_GET['general'];
else
    $nombre_nouvelles_generales = 3;
    
$vue->stat = stat_site ();
$types_nouvelles = $_GET ['quoi']
			  ? $_GET ['quoi']
			  : 'commentaires,points,forums';
$vue->nouvelles = nouvelles ($nombre,$types_nouvelles);

$conditions_commentaires_generaux = new stdClass;
$conditions_commentaires_generaux->ids_points=$config['numero_commentaires_generaux'];
$conditions_commentaires_generaux->limite=$nombre_nouvelles_generales;
$vue->nouvelles_generales=infos_commentaires($conditions_commentaires_generaux);
?>
