<?php
// Récupère les données locales
// Comme ce fichier est appelé dans un namespace depuis le forum
// il faut s'adresser au tableau $config_wri de WRI qui est global
global $config_wri;

// Aller les chercher dans config_privee.php si on l'appelle depuis le forum
// mais ne pas le réinclure si on l'appelle depuis WRI
require_once(__DIR__.'/../config_privee.php');

$dbms = 'phpbb\\db\\driver\\postgres';
$dbhost = $config_wri['serveur_pgsql'];
$dbport = '';
$dbname = $config_wri['base_pgsql'];
$dbuser = $config_wri['utilisateur_pgsql'];
$dbpasswd = $config_wri['mot_de_passe_pgsql'];
$table_prefix = 'phpbb3_';
$phpbb_adm_relative_path = 'adm/';
$acm_type = 'phpbb\\cache\\driver\\file';

@define('PHPBB_INSTALLED', true);

if (!@$config_wri['debug'])
	@define('PHPBB_ENVIRONMENT', 'production');
