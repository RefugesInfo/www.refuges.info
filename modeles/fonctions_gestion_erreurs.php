<?php
/**********************************************************************************************
Ce fichier regroupe les fonctions de gestion des autres fonctions d'une manière généralisée
- retour d'erreurs pour l'instant
- idéalement, le traitement des retours devrait se faire ici aussi
**********************************************************************************************/

/*
Fonction qu'on peut appeler pour retourner le fait qu'on soit en erreur+un message public en texte indiquant l'erreur
Mais aussi, si le mode debug de wri est activé ($config['debug']=true) un message plus complet sur l'erreur survenue.
Le premier paramètre est un texte d'erreur qui peut être lu par l'internaute
Le deuxième peut contenir des infos délicates mais qui ne seront affichées qu'en mode debug
 */
function erreur($texte,$seulement_avec_debug="")
{
  global $config,$pdo;
  
  if ($config['debug'])
  {
   if ($pdo->errorInfo())
    $erreur_pdo="Erreur PDO : ".var_export($pdo->errorInfo(),true);
    
    print("<pre>
    Mode debug actif : 
    Erreur renvoyée par la fonction : $texte
    Erreur de debug envoyée manuellement : $seulement_avec_debug
    $erreur_pdo
    Backtrace : ".var_export(debug_backtrace(),true).
    "</pre>");
  }
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
