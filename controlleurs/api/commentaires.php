<?php

/********************************************
 * Ici on traite l'URL de l'api
 * exemple pour le test :
 * http://leo.refuges.info/api/bbox?bbox=world : Tout
 * http://leo.refuges.info/api/bbox?bbox=5.5,45.1,6.5,45.6 : Un bout d'alpes
********************************************/
include_once("mise_en_forme_texte.php");
include_once("entetes_http.php");

/****************************************/

$vue = new stdClass();
// Dans un premier temps on met en place l'objet contenant la requête
$req = new stdClass();
$req->id_point = $_REQUEST['id_point'] ?? '';
$req->format = $_REQUEST['format'] ?? 'json'; // En attendant le développement des autres vues
$req->format_texte = $_REQUEST['format_texte'] ?? 'html';

$commentaires = [];
$conditions_commentaires = new stdClass();
$conditions_commentaires->ids_points = $req->id_point;
$commentaires_point = infos_commentaires ($conditions_commentaires);

foreach ($commentaires_point as $cp) {
  $com = [];
  $com['id_point'] = $cp->id_point;
  $com['id_commentaire'] = $cp->id_commentaire;
  $com['date_commentaire'] = $cp->date;
  $com['texte_commentaire'] = $cp->texte;
  $com['auteur_commentaire'] = $cp->auteur_commentaire;
  if(isset($cp->lien_photo['vignette']) )
    $com['photo-vignette'] = $cp->lien_photo['vignette'];
  if(isset($cp->lien_photo['reduite']) )
    $com['photo-reduite'] = $cp->lien_photo['reduite'];
  if(isset($cp->lien_photo['vignette']) )
    $com['photo-originale'] = $cp->lien_photo['vignette'];
  $commentaires[] = $com;
}

/****************************** FORMATAGE DU TEXTE ******************************/

// On transforme le texte dans la correcte syntaxe
if($req->format_texte == "texte")
  array_walk_recursive($commentaires, 'updatebbcode2txt');
elseif($req->format_texte == "html")
  array_walk_recursive($commentaires, 'updatebbcode2html');
elseif($req->format_texte == "markdown")
  array_walk_recursive($commentaires, 'updatebbcode2markdown');

// Remplace les False et True en 0 ou 1
array_walk_recursive($commentaires, 'updatebool2char');

/****************************** FORMAT VUE ******************************/

include($config_wri['chemin_vues'].'api/commentaires.vue.'.$req->format.".php");
?>
