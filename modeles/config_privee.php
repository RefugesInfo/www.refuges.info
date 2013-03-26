<?php
/*************************************************
Information de type privée à renseigner selon vos 
paramètres locaux (données de type privées à ne pas publier)
*************************************************/

// Accès à Postgresql
$config['utilisateur_pgsql']="refuges";
$config['mot_de_passe_pgsql']="haigaxoi";
$config['serveur_pgsql']="localhost";

$config['base_pgsql']="refuges";

// Info pour développeurs afin de les informer qu'une base "test" est à disposition sur WRI, rien ne change ci-avant, juste décommenter ça :
// ATTENTION ATTENTION : si vous activer cette base sur serveur wri, mais sans changer les dossiers photos+mode emploi
// vous allez créer une incohérence voir supprimer ou remplacer des photos live !!
// Donc pas de photos, ou supprimer votre lien symbolique vers photo + photo du forum
// $config['base_pgsql']="test";



// Activera l'affichage d'un peu plus de debug sur certaines fonctions utilisant la fonction erreur();
// + affichage des erreurs dans le navigateur (commenter les lignes plus bas pour un mixe)
$config['debug']=true;

// Le forum est bourré de warning que je ne compte pas vraiment reprendre
if ($config['debug'] and !preg_match("/forum/",$_SERVER['REQUEST_URI']))
{
  ini_set('error_reporting', E_ALL ^ E_NOTICE);
  ini_set('display_errors', '1');
}