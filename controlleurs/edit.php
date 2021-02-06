<?php // Editeur de massifs

if (!est_moderateur()) {
  $vue->type="page_simple";
  $vue->titre="Permissions insuffisantes";
  $vue->contenu="Désolé, mais pour cette opération vous devez être modérateur et être connecté au forum :";
  return "";
}

// Bon, on triche un peu ici: on factorise un max avec /nav
require_once ("nav.php");

// Quelques trucs spécifiques
if(!$vue->polygone)
  $vue->polygone = $vue->contenu; // En édition, c'est la même chose

// Définition d'un nom par défaut à la création pour éviter de perdre tout son travail de dessin de contour
if($vue->polygone && !$vue->polygone->nom_polygone)
  $vue->polygone->nom_polygone='Nom';

if ($polygone)
  $vue->titre="Modification $polygone->article_partitif $polygone->type_polygone $polygone->article_partitif $polygone->nom_polygone";
else
  $vue->titre="Création d'un polygone";

