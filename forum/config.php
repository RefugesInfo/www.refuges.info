<?php
// Récupère les données locales
require(__DIR__.'/../config_privee.php');

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

// @define('PHPBB_DISPLAY_LOAD_TIME', true);
// @define('DEBUG_CONTAINER', true);
