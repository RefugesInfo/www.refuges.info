<?php
/**********************************************************************************************
Ce fichier regroupe les fonctions de gestion des autres fonctions d'une manière généralisée
- retour d'erreurs pour l'instant
- idéalement, le traitement des retours devrait se faire ici aussi
**********************************************************************************************/

/*
Fonction qu'on peut appeler pour retourner le fait qu'on soit en erreur+un message texte indiquant l'erreur
 */
function erreur($texte)
{
  $retour = new stdClass();
  $retour->erreur=TRUE;
  $retour->message=$texte;
  return $retour;
}

/*
Fonction qu'on peut appeler pour retourner le fait que tout s'est bien passé avec en plus un message de retour
 */
function ok($texte)
{
  $retour = new stdClass();
  $retour->erreur=False;
  $retour->message=$texte;
  return $retour;
}
?>
