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
    $nombre = 15;

$vue->stat = stat_site ();
$types_nouvelles = $_GET ['quoi']
			  ? $_GET ['quoi']
			  : 'commentaires,points,forums';
$vue->nouvelles = nouvelles ($nombre,$types_nouvelles);
$vue->nouvelles = texte_nouvelles ($vue->nouvelles); // On ajoute le texte

foreach ($vue->nouvelles as $id => $nouvelle)
{
	$vue->nouvelles[$id]['date_formatee']=date("d/m/y", $nouvelle['date']);
	$vue->nouvelles[$id]['titre']=bbcode2html($nouvelle['titre']);
	$vue->nouvelles[$id]['texte']=bbcode2html($nouvelle['texte']);
}

$vue->nouvelles_generales=wiki_page_html("nouvelles_generales");


?>
