<?php
/***
Dans notre table "points" il y a des fiches de points inexistants, précisément une par type de point (cabane, gîte, point d'eau, ...)
ce sont les modeles, dont le champ modele vaut 1 et qui servent à pré-remplir les champs et cases à cocher d'un futur vrai point.
L'avantage, c'est qu'on peut utiliser le code/formulaire de modification classique pour que chaque modérateur puisse facilement modifier le modèle sans rentrer dans d'obscurs fichiers texte ou outils.
L'inconvenient c'est qu'il faut bien penser à les exclure de pratiquement toutes les requêtes du site. Chose faite de manière par défaut dans modele/points.php

Ce contrôlleur génére la liste de ces fiches en demandant spécifiquement et uniquement les modèles et faisant un lien vers la modification des modèles

***/

$conditions = new stdClass;
$conditions->modele=True;
$conditions->ordre="importance DESC";
$modeles=infos_points($conditions);

$vue->modeles = $modeles;


