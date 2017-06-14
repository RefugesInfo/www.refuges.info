<?php 
/*******************************************************************************
Ce fichier index.php est le fichier de point d'entrée de tout le site qu'on a codé nous
(ou presque, reste des vielleries toujours pas converties)
 
Il charge des trucs absoument généraux à tout le site mais par défaut, son seul 
rôle consiste à charger la config, et le fichier de ./routes/ pour mapper les urls
On fera un petit effort pour ne lui faire faire qu'un minimum de choses car il peut 
très bien être appelé pour des routes extrêmement simples qui ne font qu'ouvrir une vue html 
toute bête ou des controlleurs n'ayant pas besoin de session par exemple
*******************************************************************************/


// quasi obligatoire pour tout le site
require_once ('includes/config.php');

// pas nécessaire à tout le monde, mais pas gros et nécessaire à presque tous
require_once ('wiki.php');
require_once ('gestion_erreur.php');
require_once ('autoconnexion.php');

// On "démarre" le site
require_once ('generales.routes.php');

?>