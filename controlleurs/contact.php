<?php 
/* Page d'affichage des options de contact
Contient le code PHP de la page
Le code html est dans /vues/*.html
Le code javascript est dans /vues/*.js
Les variables sont passées dans l'objet $vue->...
*/

require_once ("config.php");
require_once ("contact.php");

$vue->titre = 'Options de contact';
$vue->cherche_points = $_POST ['cherche_points'];
$vue->nbmax_points = 20;

if($vue->cherche_points)
	$vue->points = liste_points ($vue->cherche_points, $vue->nbmax_points);
else
	$vue->points = null;
?>
