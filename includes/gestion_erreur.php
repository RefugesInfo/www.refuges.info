<?php
/**********************************************************************************************
Ce fichier regroupe les fonctions de gestion des autres fonctions d'une manière généralisée
- retour d'erreurs pour l'instant
- idéalement, le traitement des retours devrait se faire ici aussi
**********************************************************************************************/

/*
Fonction qu'on peut appeler pour retourner le fait qu'on soit en erreur+un message public en texte indiquant l'erreur
Mais aussi, si le mode debug de wri est activé ($config_wri['debug']=true) un message plus complet sur l'erreur survenue.
Le premier paramètre est un texte d'erreur qui peut être lu par l'internaute
Le deuxième peut contenir des infos délicates mais qui ne seront affichées qu'en mode debug
 */
function erreur($texte,$seulement_avec_debug="")
{
  global $config_wri,$pdo;
  
  if ($config_wri['debug'] and $seulement_avec_debug!="") // Si aucun deuxième paramètre n'a été donné, c'est une erreur mais pas un bug
  {
    if (isset($pdo))
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
/*
Fonction qui vérifie que le paramètre passé (string) est bien au format int ou int,int,int : "7"  "5,4,7" ou "-2" répond : true, 
sinon false pour les cas genre "2.3" "5 ; delete * from..." "," "9,"
*/
function verif_multiples_entiers($string)
{
    return preg_match ('/^-?\d+(,-?\d+)*$/', $string);
}

// petit débuggeur basique, on l'appel par d($variable1,$variable2) et il balance tout en à peu près lisible
function d($a=null,$b=null,$c=null,$d=null)
{
	print("<pre>"); // Pour la lisibilité, et que les retour ligne sont affichés
	foreach (array('a','b','c','d') as $var ) // Pour toutes les variables qu'on a passées de a à d, factorisation du code
            if (!is_null($$var))
                print(htmlspecialchars(print_r($$var,True))."\n------------------------------------Backtrace des appels :-----------------------------------\n"); // O peut un print_r des variables (des fois que ça soit des arrays) et on veut le résultat brut lisible dans un navigateur
        print(htmlspecialchars(print_r(debug_backtrace(),True)));
	die("</pre>");
}
?>
