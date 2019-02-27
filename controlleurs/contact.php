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
$vue->cherche_refuge = $_POST ['cherche_refuge'];
$vue->forum_refuges = $config_wri['forum_refuges'];
$vue->nbmax_refuges = 20;

if($vue->cherche_refuge)
	$vue->refuges = liste_forums_refuges ($vue->cherche_refuge, $vue->forum_refuges, $vue->nbmax_refuges);
else
	$vue->refuges = null;
?>
