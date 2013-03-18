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

// Conteneur standard de l'entête et pied de page
$vue->titre = 'Dernières nouvelles du site et informations ajoutées sur les refuges';
$vue->commentaires = $_GET['commentaires'];
$vue->general = $_GET['general'];
$vue->stat = stat_site ();
$vue->quoi = $_GET ['quoi']
			  ? $_GET ['quoi']
			  : 'commentaires,points,forums';

?>
