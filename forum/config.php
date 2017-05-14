<?php
// phpBB 3.2.x auto-generated configuration file
// Do not change anything in this file!

// Récupère les données locales
require(str_replace(basename(__DIR__),'',__DIR__)."/includes/config_privee.php");

$dbms = 'phpbb\\db\\driver\\postgres';
$dbhost = $config['serveur_pgsql'];
$dbport = '';
$dbname = $config['base_pgsql'];
$dbuser = $config['utilisateur_pgsql'];
$dbpasswd = $config['mot_de_passe_pgsql'];
$table_prefix = 'phpbb3_';
$phpbb_adm_relative_path = 'adm/';
$acm_type = 'phpbb\\cache\\driver\\file';

@define('PHPBB_INSTALLED', true);
// @define('PHPBB_DISPLAY_LOAD_TIME', true);

if (!@$config['debug'])
	@define('PHPBB_ENVIRONMENT', 'production');

// @define('DEBUG_CONTAINER', true);
