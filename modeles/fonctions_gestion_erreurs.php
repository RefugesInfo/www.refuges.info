<?php
/**********************************************************************************************
Ce fichier regroupe les fonctions de gestion des autres fonctions d'une manière généralisée
- retour d'erreurs pour l'instant
- idéalement, le traitement des retours devrait se faire ici aussi
**********************************************************************************************/

/*
sly 24/11/2011 Oui je sais, c'est ridicule y'en a qu'une toute petite !
elle est utilisée dans plusieurs autres fonctions pour quitter rapidement en fonction d'une erreur

 */
function erreur($texte)
{
  $retour->erreur=TRUE;
  $retour->message=$texte;
  return $retour;
}
/*
sly 24/11/2011 Oui je sais, c'est ridicule y'en a qu'une toute petite !
elle est utilisée dans plusieurs autres fonctions pour quitter rapidement en fonction d'une erreur

 */
function ok($texte)
{
  $retour->erreur=False;
  $retour->message=$texte;
  return $retour;
}
?>
