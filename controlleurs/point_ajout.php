<?php
require_once ("meta_donnee.php");

add_lib('style_formulaire.css');

$vue->titre="Ajouter un point dans refuges.info";
$vue->types_point_affichables=types_point_affichables(); // Menu des types de points
$vue->icones=$config_wri['correspondance_type_icone'];
