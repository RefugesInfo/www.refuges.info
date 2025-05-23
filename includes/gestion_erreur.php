<?php
/**********************************************************************************************
Ce fichier regroupe les fonctions de gestion des autres fonctions d'une manière généralisée
- retour d'erreurs
- outils de benchmarking
- idéalement, le traitement des retours devrait se faire ici aussi
**********************************************************************************************/

/* Fonctions permettant de centraliser le chargement des vues */
function fichier_vue($nom_fichier_vue, $chemin = 'chemin_vues', $url = false)
{
  global $config_wri, $user;

  // [DOM] Accès aux formats alternatifs (à venir)
  $instance_format = $user->style['style_path'].'/'.$nom_fichier_vue;
  if (file_exists($config_wri[$chemin].$instance_format))
    $nom_fichier_vue = $instance_format;

  if (file_exists($config_wri[$chemin].$nom_fichier_vue)) {
    if($url)
      return $config_wri['url_'.$chemin].$nom_fichier_vue.'?'
        .filemtime($config_wri[$chemin].$nom_fichier_vue);
    else
      return $config_wri[$chemin].$nom_fichier_vue;
  }
}

// Ajoute un lien css ou js à la page
function add_lib($nom_fichier_vue, $chemin = 'chemin_vues')
{
  global $vue;

  $fichier_vue = fichier_vue($nom_fichier_vue, $chemin);

  if(strpos($fichier_vue, '.css'))
    $vue->css_lib_head[] = fichier_vue($nom_fichier_vue, $chemin, true);

  if(strpos($fichier_vue, '.js'))
    $vue->java_lib_foot[] = fichier_vue($nom_fichier_vue, $chemin, true);
}

function temps_execution()
{
  //$__time_start doit être initialisé par : $__time_start = microtime(true); le plus tôt possible dans l'execution du framework wri si on veut des calculs de profiling le plus juste possible (/index.php est un bon endroit !)

  global $__time_start;

  return round(microtime(true) - $__time_start,3);
}

// Une fonction pour afficher à l'écran, de manière vaguement lisible le temps d'execution depuis le début

function t($texte = "")
{
  print("<pre>$texte : ".temps_execution()."</pre>");
}

/*
Fonction qu'on peut appeler pour retourner le fait qu'on soit en erreur+un message public en texte indiquant l'erreur
Mais aussi, si le mode debug de wri est activé ($config_wri['debug']=true) un message plus complet sur l'erreur survenue.
Le premier paramètre est un texte d'erreur qui peut être lu par l'internaute
Le deuxième peut contenir des infos délicates mais qui ne seront affichées qu'en mode debug
FIXME sly 2021 : c'est joli cette fonction mutante qui sert à renvoyer parfois une var, et, en cas d'erreur ce tableau, mais c'est trop galère à faire des is_array, empty à chaque retour.
FIXME on est en 2021 et il existe les exceptions, c'est ça qu'il me faut. Bon par de miracle hein, on passe d'un test du retour, au passage dans un bloc try / catch mais c'est plus standardisé. Il faut "juste" passer en revue la quasi totalité du code, easy..., yapluka

 */
function erreur($texte,$seulement_avec_debug="")
{
  global $config_wri,$pdo;
  
  if ($config_wri['debug'] and $seulement_avec_debug!="pasunbug" and $seulement_avec_debug!="") // Si aucun deuxième paramètre n'a été donné, c'est une erreur mais pas un bug
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
sinon false pour les cas genre "2.3" "5 ; delete * from..." "," "9," ou empty
*/
function verif_multiples_entiers($mixed)
{
  if (empty($mixed))
    return False;
  if (is_int($mixed))
    return True;
  return preg_match ('/^\d+(,\d+)*$/', $mixed);
}

/*
Fonction qui vérifie que le paramètre passé est soit un entier positif soit une string qui peut être transtyper comme un int entier positif
sinon false pour le reste.
4 -> true
-5 -> false
"456" -> true
5.3 -> false
empty() -> false

*/
function est_entier_positif($mixed)
{
  if (empty($mixed))
    return False;
  if (is_string($mixed) and ctype_digit($mixed))
    return true;
  if (is_int($mixed) and $mixed>0)
    return true;
  return false;  
}


// petit débuggeur basique, on l'appel par d($variable1,$variable2) et il balance tout en à peu près lisible dans le navigateur
function d($a=null,$b=null,$c=null,$d=null)
{
  foreach (array('a','b','c','d') as $var ) // Pour toutes les variables qu'on a passées de a à d, factorisation du code
    if (!is_null($$var))
    {
      var_dump($$var,True);
      print("<pre>\n------------------------------------Backtrace des appels :-----------------------------------\n");
      print(htmlspecialchars(print_r(debug_backtrace(),True)));
      print("</pre>");
    }
}


