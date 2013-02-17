<?php


// phpBB 2.x auto-generated config file
// Do not change anything in this file!

// ouais ben désolé, t'as qu'a permettre un mécanisme de réutilisation des codes pour éviter de les dupliquer !
// sly 25/07/2012
require($_SERVER["DOCUMENT_ROOT"] . "/modeles/config.php");


$dbms = 'postgres';
$dbhost = $config['serveur_pgsql'];
$dbname = $config['base_pgsql'];
$dbuser = $config['utilisateur_pgsql'];
$dbpasswd = $config['mot_de_passe_pgsql'];

$table_prefix = 'phpbb_';

define('PHPBB_INSTALLED', true);

?>