<?php
// Editeur de massifs

if (!est_moderateur()) {
  $vue->type="page_simple";
  $vue->titre="Permissions insuffisantes";
  $vue->contenu="Désolé, mais pour cette opération vous devez être modérateur et être connecté au forum :";
  return "";
}

// Bon, on triche un peu ici: on factorise un max avec /nav
require_once ("nav.php");
require_once ("polygone.php");

// Quelques trucs spécifiques
if(!isset($vue->polygone) && isset($vue->contenu))
  $vue->polygone = $vue->contenu; // En édition, c'est la même chose

// Définition d'un nom par défaut à la création pour éviter de perdre tout son travail de dessin de contour
if(isset($vue->polygone) && !isset($vue->polygone->nom_polygone))
  $vue->polygone->nom_polygone='Nom';

if (isset($polygone))
  $vue->titre="Modification $polygone->article_partitif $polygone->type_polygone $polygone->article_partitif $polygone->nom_polygone";
else
  $vue->titre="Création d'un polygone";

$vue->liste_type_polygone=liste_type_polygone();
