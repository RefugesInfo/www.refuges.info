<?php
/**
 *
 * This file is part of the french language pack for the phpBB Forum Software package.
 * This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

// Common installer pages
$lang = array_merge($lang, array(
	'INSTALL_PANEL'	=> 'Assistant d’installation',
	'SELECT_LANG'	=> 'Choisissez une langue',

	'STAGE_INSTALL'	=> 'Installation de phpBB',

	// Introduction page
	'INTRODUCTION_TITLE'	=> 'Introduction',
	'INTRODUCTION_BODY'		=> 'Bienvenue sur phpBB3 !<br><br>phpBB® est la solution de forum libre la plus répandue dans le monde. phpBB3 est l’aboutissement d’un long processus débuté en 2000. Comme ses prédécesseurs, phpBB3 est riche en fonctionnalités, convivial et complètement supporté par l’équipe phpBB. phpBB3 améliore considérablement ce qui a rendu populaire phpBB2 et ajoute des fonctionnalités très souvent demandées, qui n’étaient pas présentes dans les versions précédentes. Nous espérons qu’il dépassera vos attentes.<br><br>Cet outil vous guidera à travers l’installation de phpBB3, la mise à jour de votre forum phpBB3 ou la conversion depuis un autre système de forum (y compris phpBB2). Pour plus d’informations, nous vous invitons à prendre connaissance du <a href="../docs/INSTALL.html">guide d’installation</a> (en anglais).<br><br>Pour consulter la licence de phpBB3 ou vous renseigner sur l’obtention de support ainsi que notre position, choisissez l’option respective à partir du menu latéral. Pour continuer, choisissez l’option appropriée dans les onglets ci-dessus.',

	// Support page
	'SUPPORT_TITLE'		=> 'Support',
	'SUPPORT_BODY'		=> 'Un support complet et gratuit est fourni pour l’actuelle version stable de phpBB3. Ceci inclut les questions concernant :</p><ul><li>l’installation</li><li>la configuration</li><li>les questions techniques</li><li>les problèmes liés aux potentiels bugs du logiciel</li><li>la mise à jour depuis une version « Release Candidate » (RC) vers la dernière version stable</li><li>la conversion depuis un forum phpBB 2.0.x vers phpBB3</li><li>la conversion depuis un autre système de forum vers phpBB3 (consultez <a href="https://www.phpbb.com/community/viewforum.php?f=486">le forum des convertisseurs</a>*)</li></ul><p>Nous encourageons les utilisateurs d’une des versions bêta de phpBB3 à remplacer celle-ci par la dernière version stable.</p><h2>Extensions / Styles</h2><p>Pour des problèmes liés aux extensions, nous vous invitons à créer votre sujet dans le <a href="https://www.phpbb.com/community/viewforum.php?f=451">forum des extensions</a>*.<br>Pour des problèmes liés aux styles, templates et thèmes, nous vous invitons à créer votre sujet dans le <a href="https://www.phpbb.com/community/viewforum.php?f=471">forum des styles</a>*.<br><br>Si votre question est en relation avec une archive précise, créez votre message directement dans le sujet dédié à l’archive.</p><h2>Obtention du support</h2><p><a href="https://www.phpbb.com/support/">Section de support</a>*<br><a href="https://www.phpbb.com/support/docs/en/3.3/ug/quickstart/">Guide de démarrage rapide</a>*<br><br>Pour vous assurer d’être à jour et au courant des dernières nouvelles, suivez-nous sur <a href="https://www.twitter.com/phpbb/">Twitter</a>* et <a href="https://www.facebook.com/phpbb/">Facebook</a>*.<br><br>*liens menant vers des pages en langue anglaise.<br><br>',

	// License
	'LICENSE_TITLE'		=> 'Licence publique générale',

	// Install page
	'INSTALL_INTRO'			=> 'Bienvenue dans l’assistant d’installation de phpBB',
	'INSTALL_INTRO_BODY'	=> 'Cet assistant va vous permettre d’installer phpBB3 sur votre serveur.</p><p>Pour cela, vous aurez besoin des paramètres de connexion à votre base de données. Si vous ne les connaissez pas, contactez votre hébergeur pour les lui demander. Vous ne pourrez pas continuer l’installation sans ces paramètres. Il vous faut :</p>

	<ul>
		<li>Le type de votre base de données.</li>
		<li>L’adresse du serveur de votre base de données ou DSN.</li>
		<li>Le port du serveur de votre base de données (dans bon nombre de cas cette information n’est pas nécessaire).</li>
		<li>Le nom de votre base de données.</li>
		<li>Le nom d’utilisateur et le mot de passe d’accès à votre base de données.</li>
	</ul>

	<p><strong>Note :</strong> Si vous faites une installation en utilisant SQLite, vous devrez saisir le chemin complet d’accès à votre base de données dans le champ DSN et laisser les champs nom d’utilisateur et mot de passe vides. Pour des raisons de sécurité, assurez-vous que votre fichier de base de données n’est pas situé dans un répertoire accessible depuis le Web.</p>

	<p>phpBB3 supporte les bases de données suivantes :</p>
	<ul>
		<li>MySQL 4.1.3 ou supérieur (MySQLi requis)</li>
		<li>PostgreSQL 8.3+</li>
		<li>SQLite 3.6.15+</li>
		<li>MS SQL Server 2000 ou supérieur (directement ou via ODBC)</li>
		<li>MS SQL Server 2005 ou supérieur (natif)</li>
		<li>Oracle</li>
	</ul>

	<p>Seules les bases de données prises en charge par votre serveur seront proposées.',

	'ACP_LINK'	=> 'Accéder au <a href="%1$s">Panneau d’administration</a>',

	'INSTALL_PHPBB_INSTALLED'		=> 'phpBB est déjà installé.',
	'INSTALL_PHPBB_NOT_INSTALLED'	=> 'phpBB n’est pas encore installé.',
));

// Requirements translation
$lang = array_merge($lang, array(
	// Filesystem requirements
	'FILE_NOT_EXISTS'						=> 'Fichier inexistant',
	'FILE_NOT_EXISTS_EXPLAIN'				=> 'Pour être en mesure d’installer phpBB le fichier « %1$s » doit exister.',
	'FILE_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Il est recommandé que le fichier « %1$s » existe pour améliorer votre confort d’utilisation du forum.',
	'FILE_NOT_WRITABLE'						=> 'Fichier inaccessible en écriture',
	'FILE_NOT_WRITABLE_EXPLAIN'				=> 'Pour être en mesure d’installer phpBB le fichier « %1$s » doit être accessible en écriture.',
	'FILE_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Il est recommandé que le fichier « %1$s » soit accessible en écriture pour améliorer votre confort d’utilisation du forum.',

	'DIRECTORY_NOT_EXISTS'						=> 'Répertoire inexistant',
	'DIRECTORY_NOT_EXISTS_EXPLAIN'				=> 'Pour être en mesure d’installer phpBB le répertoire « %1$s » doit exister.',
	'DIRECTORY_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Il est recommandé que le répertoire « %1$s » existe pour améliorer votre confort d’utilisation du forum.',
	'DIRECTORY_NOT_WRITABLE'					=> 'Répertoire inaccessible en écriture',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN'			=> 'Pour être en mesure d’installer phpBB le répertoire « %1$s » doit être accessible en écriture.',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Il est recommandé que le répertoire « %1$s » soit accessible en écriture pour améliorer votre confort d’utilisation du forum.',

	// Server requirements
	'PHP_VERSION_REQD'					=> 'Version de PHP',
	'PHP_VERSION_REQD_EXPLAIN'			=> 'phpBB requiert PHP version 7.1.3 ou supérieure.',
	'PHP_GETIMAGESIZE_SUPPORT'			=> 'La fonction PHP getimagesize() est requise',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> 'Pour que phpBB fonctionne correctement, la fonction getimagesize() doit être disponible.',
	'PCRE_UTF_SUPPORT'					=> 'Support de PCRE UTF-8',
	'PCRE_UTF_SUPPORT_EXPLAIN'			=> 'phpBB ne fonctionnera pas si votre installation PHP n’est pas compilée avec la prise en charge de UTF-8 dans l’extension PCRE.',
	'PHP_JSON_SUPPORT'					=> 'Support de JSON pour PHP',
	'PHP_JSON_SUPPORT_EXPLAIN'			=> 'Pour que phpBB fonctionne correctement, l’extension JSON pour PHP doit être disponible.',
	'PHP_XML_SUPPORT'					=> 'Support de PHP XML/DOM',
	'PHP_XML_SUPPORT_EXPLAIN'			=> 'Pour que phpBB fonctionne correctement, l’extension XML/DOM pour PHP doit être disponible.',
	'PHP_SUPPORTED_DB'					=> 'Bases de données supportées',
	'PHP_SUPPORTED_DB_EXPLAIN'			=> 'Vous devez avoir au moins une base de données compatible avec PHP. Si aucune base de données n’est marquée comme disponible vous devez contacter votre hébergeur ou consulter la documentation d’installation de PHP.',

	'RETEST_REQUIREMENTS'	=> 'Retester les prérequis',

	'STAGE_REQUIREMENTS'	=> 'Vérifier les prérequis',
));

// General error messages
$lang = array_merge($lang, array(
	'INST_ERR_MISSING_DATA'		=> 'Vous devez remplir tous les champs de ce bloc.',

	'TIMEOUT_DETECTED_TITLE'	=> 'Délai d’attente de la demande dépassé',
	'TIMEOUT_DETECTED_MESSAGE'	=> 'L’assistant d’installation n’a pas répondu dans les délais attendus, vous pouvez essayer d’actualiser la page, ce qui peut provoquer une corruption des données. Nous vous suggérons soit d’augmenter le paramètre « timeout » de votre serveur, soit d’essayer d’utiliser le mode « CLI » (ligne de commande).',
));

// Data obtaining translations
$lang = array_merge($lang, array(
	'STAGE_OBTAIN_DATA'	=> 'Définir les données d’installation',

	//
	// Admin data
	//
	'STAGE_ADMINISTRATOR'	=> 'Informations sur l’administrateur',

	// Form labels
	'ADMIN_CONFIG'				=> 'Configuration du compte Administrateur',
	'ADMIN_PASSWORD'			=> 'Mot de passe de l’administrateur',
	'ADMIN_PASSWORD_CONFIRM'	=> 'Confirmez le mot de passe',
	'ADMIN_PASSWORD_EXPLAIN'	=> 'Saisissez un mot de passe entre 6 et 30 caractères.',
	'ADMIN_USERNAME'			=> 'Nom de l’administrateur',
	'ADMIN_USERNAME_EXPLAIN'	=> 'Saisissez un nom d’utilisateur entre 3 et 20 caractères.',

	// Errors
	'INST_ERR_EMAIL_INVALID'		=> 'L’adresse courriel saisie est invalide.',
	'INST_ERR_PASSWORD_MISMATCH'	=> 'Les mots de passe saisis ne correspondent pas.',
	'INST_ERR_PASSWORD_TOO_LONG'	=> 'Le mot de passe saisi est trop long. La longueur maximale est de 30 caractères.',
	'INST_ERR_PASSWORD_TOO_SHORT'	=> 'Le mot de passe saisi est trop court. La longueur minimale est de 6 caractères.',
	'INST_ERR_USER_TOO_LONG'		=> 'Le nom d’utilisateur saisi est trop long. La longueur maximale est de 20 caractères.',
	'INST_ERR_USER_TOO_SHORT'		=> 'Le nom d’utilisateur saisi est trop court. La longueur minimale est de 3 caractères.',

	//
	// Board data
	//
	// Form labels
	'BOARD_CONFIG'		=> 'Configuration de votre forum',
	'DEFAULT_LANGUAGE'	=> 'Langue par défaut',
	'BOARD_NAME'		=> 'Nom de votre forum',
	'BOARD_DESCRIPTION'	=> 'Description de votre forum',

	//
	// Database data
	//
	'STAGE_DATABASE'	=> 'Paramètres de la base de données',

	// Form labels
	'DB_CONFIG'				=> 'Configuration de la base de données',
	'DBMS'					=> 'Type de base de données',
	'DB_HOST'				=> 'Serveur de base de données ou DSN',
	'DB_HOST_EXPLAIN'		=> 'DSN signifie « Data Source Name » (source de données) et n’est utilisé que pour une installation ODBC. Avec PostgreSQL, utilisez « localhost » pour vous connecter au serveur local via le socket de domaine UNIX et « 127.0.0.1 » pour vous connecter via TCP. Pour SQLite, vous devrez saisir le chemin complet d’accès à votre base de données.',
	'DB_PORT'				=> 'Port du serveur',
	'DB_PORT_EXPLAIN'		=> 'Laissez cette case vide à moins que le serveur n’utilise un port non standard.',
	'DB_PASSWORD'			=> 'Mot de passe',
	'DB_NAME'				=> 'Nom de la base de données',
	'DB_USERNAME'			=> 'Nom d’utilisateur',
	'DATABASE_VERSION'		=> 'Version de la base de données',
	'TABLE_PREFIX'			=> 'Préfixe de tables',
	'TABLE_PREFIX_EXPLAIN'	=> 'Le préfixe doit commencer par une lettre et ne doit contenir que des lettres, des nombres et des tirets bas.',

	// Database options
	'DB_OPTION_MSSQL_ODBC'	=> 'MSSQL Server 2000+ via ODBC',
	'DB_OPTION_MSSQLNATIVE'	=> 'MSSQL Server 2005+ [Natif]',
	'DB_OPTION_MYSQLI'		=> 'MySQL avec l’extension MySQLi',
	'DB_OPTION_ORACLE'		=> 'Oracle',
	'DB_OPTION_POSTGRES'	=> 'PostgreSQL',
	'DB_OPTION_SQLITE3'		=> 'SQLite 3',

	// Errors
	'INST_ERR_DB'					=> 'Erreur d’installation de la base de données',
	'INST_ERR_NO_DB'				=> 'Impossible de charger le module PHP pour le type de base sélectionné.',
	'INST_ERR_DB_INVALID_PREFIX'	=> 'Le préfixe que vous avez saisi n’est pas valide. Il doit commencer par une lettre et ne doit contenir que des lettres, des nombres et des tirets bas.',
	'INST_ERR_PREFIX_TOO_LONG'		=> 'Le préfixe de table indiqué est trop long. La taille maximale est de %d caractères.',
	'INST_ERR_DB_NO_NAME'			=> 'Aucun nom de base de données n’est indiqué.',
	'INST_ERR_DB_FORUM_PATH'		=> 'Le fichier de la base de données indiqué est dans le répertoire racine de votre forum. Vous devez déplacer ce fichier dans un emplacement inaccessible depuis Internet.',
	'INST_ERR_DB_CONNECT'			=> 'Impossible de se connecter à la base de données, consultez le message d’erreur ci-dessous.',
	'INST_ERR_DB_NO_WRITABLE'		=> 'La base de données et le répertoire la contenant doivent être accessibles en écriture.',
	'INST_ERR_DB_NO_ERROR'			=> 'Aucune erreur n’est survenue.',
	'INST_ERR_PREFIX'				=> 'Des tables avec le préfixe indiqué existent déjà, choisissez-en un autre.',
	'INST_ERR_DB_NO_MYSQLI'			=> 'La version de MySQL installée sur cette machine est incompatible avec l’option « MySQL avec extension MySQLi ». Essayez avec l’option « MySQL » à la place.',
	'INST_ERR_DB_NO_SQLITE3'		=> 'La version de SQLite installée est trop ancienne, elle doit être mise à jour au minimum à la version 3.6.15.',
	'INST_ERR_DB_NO_ORACLE'			=> 'La version d’Oracle installée nécessite de définir le paramètre <var>NLS_CHARACTERSET</var> sur <var>UTF8</var>. Mettez-la à jour à la version 9.2+ ou changez ce paramètre.',
	'INST_ERR_DB_NO_POSTGRES'		=> 'La base de données sélectionnée n’a pas été créée avec l’encodage <var>UNICODE</var> ou <var>UTF8</var>. Réessayez l’installation avec une base encodée en <var>UNICODE</var> ou bien <var>UTF8</var>',
	'INST_SCHEMA_FILE_NOT_WRITABLE'	=> 'Le fichier schéma n’est pas accessible en écriture.',

	//
	// Email data
	//
	'EMAIL_CONFIG'	=> 'Configuration des courriels',

	// Package info
	'PACKAGE_VERSION'					=> 'Version du pack installé',
	'UPDATE_INCOMPLETE'				=> 'La mise à jour de phpBB n’a pas été finalisée correctement.',
	'UPDATE_INCOMPLETE_MORE'		=> 'Veuillez lire les informations ci-dessous afin de corriger les erreurs.',
	'UPDATE_INCOMPLETE_EXPLAIN'		=> '<h1>Mise à jour erronée</h1>

		<p>Nous vous informons que la dernière mise à jour de votre installation de phpBB ne s’est pas bien terminée. Veuillez <a href="%1$s" title="%1$s">mettre à jour la base de données</a>, en vous assurant que <em>Mettre à jour uniquement la base de données</em> est sélectionné puis cliquez sur <strong>Envoyer</strong>. N’oubliez pas de supprimer le répertoire « install » une fois la mise à jour correctement terminée.</p>',

	//
	// Server data
	//
	// Form labels
	'UPGRADE_INSTRUCTIONS'			=> 'La nouvelle version majeure « phpBB <strong>%1$s</strong> » est disponible. Veuillez lire <a href="%2$s" title="%2$s"><strong>l’annonce de publication</strong></a> (en anglais) pour en savoir plus sur les nouveautés et comment procéder à la mise à niveau.',
	'SERVER_CONFIG'				=> 'Configuration du serveur',
	'SCRIPT_PATH'				=> 'Chemin du script',
	'SCRIPT_PATH_EXPLAIN'		=> 'Le chemin où phpBB est situé par rapport au répertoire racine du forum, par exemple : /<samp>phpbb3</samp>',
));

// Default database schema entries...
$lang = array_merge($lang, array(
	'CONFIG_BOARD_EMAIL_SIG'		=> 'Merci, l’équipe du forum.',
	'CONFIG_SITE_DESC'				=> 'Description de votre forum',
	'CONFIG_SITENAME'				=> 'votredomaine.com',

	'DEFAULT_INSTALL_POST'			=> 'Ceci est un exemple de message de votre installation phpBB3. Tout semble fonctionner. Vous pouvez si vous le voulez supprimer ce message et continuer à configurer votre forum. Durant le processus d’installation, votre première catégorie et votre premier forum sont assignés à un ensemble de permissions appropriées aux groupes d’utilisateurs que sont les administrateurs, les robots, les modérateurs globaux, les invités, les utilisateurs enregistrés et les utilisateurs COPPA enregistrés. Si vous choisissez de supprimer également votre première catégorie et votre premier forum, n’oubliez pas de régler les permissions de tous les groupes d’utilisateurs, pour toutes les nouvelles catégories et forums que vous allez créer. Il est recommandé de renommer votre première catégorie et votre premier forum et de copier leurs permissions sur chaque nouvelle catégorie et nouveau forum lors de leur création. Amusez-vous bien !',

	'FORUMS_FIRST_CATEGORY'			=> 'Votre première catégorie',
	'FORUMS_TEST_FORUM_DESC'		=> 'Description de votre premier forum.',
	'FORUMS_TEST_FORUM_TITLE'		=> 'Votre premier forum',

	'RANKS_SITE_ADMIN_TITLE'		=> 'Administrateur du site',
	'REPORT_WAREZ'					=> 'Le message contient un lien vers un logiciel illégal ou piraté.',
	'REPORT_SPAM'					=> 'Le message rapporté a été posté dans le seul but de promouvoir un site Internet ou un autre produit.',
	'REPORT_OFF_TOPIC'				=> 'Le message rapporté est hors sujet.',
	'REPORT_OTHER'					=> 'Le message rapporté n’entre dans aucune autre catégorie, utilisez le champ d’information complémentaire.',

	'SMILIES_ARROW'					=> 'Flèche',
	'SMILIES_CONFUSED'				=> 'Confus',
	'SMILIES_COOL'					=> 'Cool',
	'SMILIES_CRYING'				=> 'Très triste, en pleurs',
	'SMILIES_EMARRASSED'			=> 'Embarrassé',
	'SMILIES_EVIL'					=> 'Diable',
	'SMILIES_EXCLAMATION'			=> 'Exclamation',
	'SMILIES_GEEK'					=> 'Geek',
	'SMILIES_IDEA'					=> 'Idée',
	'SMILIES_LAUGHING'				=> 'Rire',
	'SMILIES_MAD'					=> 'Fou',
	'SMILIES_MR_GREEN'				=> 'M. Vert',
	'SMILIES_NEUTRAL'				=> 'Neutre',
	'SMILIES_QUESTION'				=> 'Question',
	'SMILIES_RAZZ'					=> 'Tire la langue',
	'SMILIES_ROLLING_EYES'			=> 'Yeux tournants',
	'SMILIES_SAD'					=> 'Triste',
	'SMILIES_SHOCKED'				=> 'Choqué',
	'SMILIES_SMILE'					=> 'Sourire',
	'SMILIES_SURPRISED'				=> 'Surprise',
	'SMILIES_TWISTED_EVIL'			=> 'Diable rieur',
	'SMILIES_UBER_GEEK'				=> 'Geek barbu',
	'SMILIES_VERY_HAPPY'			=> 'Très content',
	'SMILIES_WINK'					=> 'Clin d’œil',

	'TOPICS_TOPIC_TITLE'			=> 'Bienvenue sur phpBB3',
));

// Common navigation items' translation
$lang = array_merge($lang, array(
	'MENU_OVERVIEW'		=> 'Page d’accueil',
	'MENU_INTRO'		=> 'Introduction',
	'MENU_LICENSE'		=> 'Licence',
	'MENU_SUPPORT'		=> 'Support',
));

// Task names
$lang = array_merge($lang, array(
	// Install filesystem
	'TASK_CREATE_CONFIG_FILE'	=> 'Création du fichier de configuration',

	// Install database
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Ajout des paramètres de configuration',
	'TASK_ADD_DEFAULT_DATA'				=> 'Ajout des paramètres par défaut dans la base de données',
	'TASK_CREATE_DATABASE_SCHEMA_FILE'	=> 'Création du fichier de schéma de la base de données',
	'TASK_SETUP_DATABASE'				=> 'Configuration de la base de données',
	'TASK_CREATE_TABLES'				=> 'Création des tables',

	// Install data
	'TASK_ADD_BOTS'				=> 'Initialisation des robots',
	'TASK_ADD_LANGUAGES'		=> 'Initialisation des packs de langue disponibles',
	'TASK_ADD_MODULES'			=> 'Initialisation des modules',
	'TASK_CREATE_SEARCH_INDEX'	=> 'Création de l’index de recherche',

	// Install finish tasks
	'TASK_INSTALL_EXTENSIONS'	=> 'Installation des extensions',
	'TASK_NOTIFY_USER'			=> 'Envoi d’une notification par courriel',
	'TASK_POPULATE_MIGRATIONS'	=> 'Validation de la bonne exécution des migrations',

	// Installer general progress messages
	'INSTALLER_FINISHED'	=> 'L’assistant d’installation a terminé toutes les opérations',
));

// Installer's general messages
$lang = array_merge($lang, array(
	'MODULE_NOT_FOUND'				=> 'Module introuvable',
	'MODULE_NOT_FOUND_DESCRIPTION'	=> 'Un module n’a pu être trouvé car le service « %s » n’a pas été défini.',

	'TASK_NOT_FOUND'				=> 'Tâche introuvable',
	'TASK_NOT_FOUND_DESCRIPTION'	=> 'Une tâche n’a pu être trouvée car le service « %s » n’a pas été défini.',

	'SKIP_MODULE'	=> 'Module « %s » ignoré.',
	'SKIP_TASK'		=> 'Tâche « %s » ignorée.',

	'TASK_SERVICE_INSTALLER_MISSING'	=> 'Tous les services de tâches d’installation devraient commencer par « installer ».',
	'TASK_CLASS_NOT_FOUND'				=> 'La définition des services de tâche d’installation n’est pas valide. Le nom du service « %1$s » a été donné, alors que l’espace de nom de la classe est « %2$s ». Pour plus d’informations veuillez consulter la documentation relative à « task_interface ».',

	'INSTALLER_CONFIG_NOT_WRITABLE'	=> 'Le fichier « install_config.php » n’est pas accessible en écriture.',
));

// CLI messages
$lang = array_merge($lang, array(
	'CLI_INSTALL_BOARD'				=> 'Installer phpBB',
	'CLI_UPDATE_BOARD'				=> 'Mettre à jour phpBB',
	'CLI_INSTALL_SHOW_CONFIG'		=> 'Montrer la configuration qui sera utilisée',
	'CLI_INSTALL_VALIDATE_CONFIG'	=> 'Valider un fichier de configuration',
	'CLI_CONFIG_FILE'				=> 'Fichier de configuration à utiliser',
	'MISSING_FILE'					=> 'Impossible d’accéder au fichier « %1$s »',
	'MISSING_DATA'					=> 'Des données sont manquantes dans le fichier de configuration ou il contient des paramètres invalides.',
	'INVALID_YAML_FILE'				=> 'Impossible d’analyser le fichier YAML « %1$s »',
	'CONFIGURATION_VALID'			=> 'Le fichier de configuration est valide',
));

// Common updater messages
$lang = array_merge($lang, array(
	'UPDATE_INSTALLATION'			=> 'Mettre à jour l’installation de phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 'Avec cette option, il est possible de mettre à jour votre installation de phpBB vers la dernière version.<br>Pendant le processus, tous vos fichiers seront vérifiés dans leur intégralité. Vous pouvez revoir toutes les différences et les fichiers avant la mise à jour.<br><br>La mise à jour de fichiers peut être réalisée de deux manières différentes.</p><h2>Mise à jour manuelle</h2><p>En utilisant la mise à jour manuelle, vous ne téléchargez qu’un pack personnalisé de fichiers modifiés, vous garantissant de ne pas perdre les modifications de fichiers que vous avez peut-être effectuées. Après avoir téléchargé ce pack, vous devez transférer manuellement les fichiers dans leurs emplacements respectifs à partir du répertoire racine de votre forum phpBB. Une fois terminé, vous pouvez recommencer l’étape de vérification des fichiers pour contrôler que les fichiers ont été placés aux bons endroits.</p><h2>Mise à jour automatique par FTP</h2><p>Cette méthode est similaire à la première, mais il ne sera pas nécessaire de télécharger les fichiers modifiés et de les transférer vous-même. Cela sera fait directement. Afin d’utiliser cette méthode, vous devez connaître les informations de votre connexion FTP car elles vous seront demandées. Une fois terminé, vous serez redirigé vers la vérification des fichiers, afin de savoir si tout a été mis à jour correctement.<br><br>',
	'UPDATE_INSTRUCTIONS'			=> '

		<h1>Annonce de mise à jour</h1>

		<p>Veuillez lire l’annonce, relative à la sortie de la dernière version, avant de continuer le processus de mise à jour. Elle contient des informations qui pourraient vous être utiles, telles que les liens de téléchargement et les changements effectués depuis la précédente version.</p>

		<br>

		<h1>Comment mettre à jour votre installation avec le pack complet ?</h1>

		<p>La méthode recommandée pour mettre à jour votre installation consiste à utiliser le pack complet. Si les fichiers de base de phpBB ont été modifiés sur votre installation nous vous recommandons l’utilisation du pack de mise à jour automatique, afin de ne pas perdre vos modifications. Vous pouvez également utiliser les méthodes de mises à jour énumérées dans le document « INSTALL.html ». Pour mettre à jour phpBB en utilisant le pack complet, veuillez suivre ces étapes :</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li><strong class="error">Sauvegardez votre base de données et vos fichiers.</strong></li>
			<li>Depuis la <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">page de téléchargement de phpBB.com</a>, allez dans l’onglet « Install phpBB » puis téléchargez l’archive « Full Package ».</li>
			<li>Décompressez l’archive.</li>
			<li>Supprimez du répertoire de l’archive (pas de votre site) le fichier <code class="inline">config.php</code> ainsi que les répertoires <code class="inline">/images</code>, <code class="inline">/store</code> et <code class="inline">/files</code>.</li>
			<li>Depuis votre forum, allez dans le panneau d’administration puis dans « Général --> Configuration du forum ». Assurez-vous que prosilver soit défini comme style par défaut. Si ce n’est pas le cas, faites-le.</li>
			<li>Supprimez les répertoires <code class="inline">/vendor</code> et <code class="inline">/cache</code> de la racine de votre forum.</li>
			<li>Transférez via un client FTP ou SSH les fichiers et répertoires de l’archive précédemment décompressée (c’est-à-dire, le CONTENU du répertoire <code class="inline">/phpBB3</code>) à la racine du forum de votre serveur, en vous assurant d’écraser les fichiers existants. Attention : ne supprimez aucune extension du répertoire <code class="inline">/ext</code> lorsque vous transférez le nouveau contenu de phpBB3.</li>
			<li><strong><a href="%1$s" title="%1$s">Maintenant démarrez l’assistant de mise à jour en pointant votre navigateur sur le répertoire « install »</a>.</strong></li>
			<li>Suivez les étapes afin de mettre à jour la base de données.</li>
			<li>Supprimez via un client FTP ou SSH le répertoire <code class="inline">/install</code> de la racine de votre forum.<br><br></li>
		</ol>

		<p>Vous avez maintenant un forum à jour avec l’ensemble de vos membres et messages. Il ne vous reste plus qu’à :</p>
		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Mettre à jour vos packs de langue.</li>
			<li>Mettre à jour vos styles.<br><br></li>
		</ul>

		<h1>Comment mettre à jour votre installation avec le pack de mise à jour automatique ?</h1>

		<p>L’usage du pack de mise à jour automatique n’est recommandé que si les fichiers de base de phpBB ont été modifiés sur votre installation. Vous pouvez également utiliser les méthodes de mises à jour énumérées dans le document « INSTALL.html ». Les étapes pour mettre à jour automatiquement phpBB3 sont :</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li>Depuis la <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">page de téléchargement de phpBB.com</a>, allez dans l’onglet « Automatic Update » puis téléchargez l’archive « Automatic Update Package ».</li>
			<li>Décompressez l’archive.</li>
			<li>Transférez les répertoires <code class="inline">/install</code> et <code class="inline">/vendor</code> à la racine de votre forum (où se trouve votre fichier <code class="inline">config.php</code>).<br><br></li>
		</ol>

		<p>De par la présence du répertoire <code class="inline">/install</code>, votre forum sera inaccessible pour les utilisateurs standards.<br><br>
		<strong><a href="%1$s" title="%1$s">Vous pouvez maintenant démarrez l’assistant de mise à jour en pointant votre navigateur sur le répertoire « install »</a>.</strong><br>
		<br>
		Vous serez alors guidé par l’assistant de mise à jour. Vous serez averti une fois la mise à jour terminée.
		</p>

		<br>

		<h1>Utilisateurs de la traduction de phpBB-fr</h1>

		<p>Pour les administrateurs utilisant la traduction de phpBB-fr, nous vous recommandons auparavant de consulter les liens suivants :</p>
		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li><a href="http://forums.phpbb-fr.com/documentation/mise-a-jour/">Mettre à jour phpBB</a>.</li>
			<li><a href="http://www.phpbb-fr.com/telechargements/" title="http://www.phpbb-fr.com/telechargements/">Téléchargements : Pack complet, Mise à jour, Pack français et Pack original</a>.</li>
		</ul>

		<p>Vous trouverez également dans nos tutoriels les instructions nécessaires pour mettre à jour vos styles autres que Prosilver.</p>
	',
));

// Updater forms
$lang = array_merge($lang, array(
	// Updater types
	'UPDATE_TYPE'			=> 'Type de mise à jour à effectuer',

	'UPDATE_TYPE_ALL'		=> 'Mettre à jour les fichiers et la base de données',
	'UPDATE_TYPE_DB_ONLY'	=> 'Mettre à jour uniquement la base de données',

	// File updater methods
	'UPDATE_FILE_METHOD_TITLE'		=> 'Méthode de mise à jour des fichiers',

	'UPDATE_FILE_METHOD'			=> 'Méthode de mise à jour des fichiers',
	'UPDATE_FILE_METHOD_DOWNLOAD'	=> 'Via le téléchargement de l’archive de fichiers modifiés',
	'UPDATE_FILE_METHOD_FTP'		=> 'Via FTP (Automatique)',
	'UPDATE_FILE_METHOD_FILESYSTEM'	=> 'Via l’accès direct (Automatique)',

	// File updater archives
	'SELECT_DOWNLOAD_FORMAT'	=> 'Sélectionner le format de l’archive à télécharger',

	// FTP settings
	'FTP_SETTINGS'			=> 'Paramètres FTP',
));

// Requirements messages
$lang = array_merge($lang, array(
	'UPDATE_FILES_NOT_FOUND'	=> 'Aucun répertoire de mise à jour n’a été trouvé, veuillez vous assurer d’avoir transféré les bons fichiers.',

	'NO_UPDATE_FILES_UP_TO_DATE'	=> 'Votre version est à jour. Il n’est pas nécessaire d’utiliser l’outil de mise à jour. Si vous souhaitez faire une vérification intégrale de vos fichiers, assurez-vous d’avoir transféré les bons fichiers de mise à jour.',
	'OLD_UPDATE_FILES'				=> 'Les fichiers de mise à jour sont obsolètes. Les fichiers trouvés pour la mise à jour sont pour phpBB %1$s vers phpBB %2$s mais la dernière version de phpBB est la %3$s.',
	'INCOMPATIBLE_UPDATE_FILES'		=> 'Les fichiers de mise à jour trouvés sont incompatibles avec votre version installée. Votre version installée est la %1$s et les fichiers de mise à jour sont pour la mise à jour de phpBB %2$s vers %3$s.',
));

// Update files
$lang = array_merge($lang, array(
	'STAGE_UPDATE_FILES'		=> 'Mettre à jour les fichiers',

	// Check files
	'UPDATE_CHECK_FILES'	=> 'Vérifier les fichiers',

	// Update file differ
	'FILE_DIFFER_ERROR_FILE_CANNOT_BE_READ'	=> 'L’analyseur de fichier n’a pas réussi à ouvrir le fichier « %s ».',

	'UPDATE_FILE_DIFF'		=> 'Comparaison des fichiers modifiés',
	'ALL_FILES_DIFFED'		=> 'Tous les fichiers ont été comparés.',

	// File status
	'UPDATE_CONTINUE_FILE_UPDATE'	=> 'Mettre à jour les fichiers',

	'DOWNLOAD'							=> 'Télécharger',
	'DOWNLOAD_CONFLICTS'				=> 'Télécharger les conflits de ce fichier',
	'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Rechercher &lt;&lt;&lt; afin de repérer les conflits',
	'DOWNLOAD_UPDATE_METHOD'			=> 'Télécharger l’archive de fichiers modifiés',
	'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Une fois téléchargée, vous devez décompresser l’archive. Vous y trouverez les fichiers modifiés que vous devez transférer dans votre répertoire à la racine de phpBB. Transférez les fichiers à leurs emplacements respectifs. Après avoir transféré tous les fichiers, vérifiez à nouveau les fichiers avec l’autre bouton ci-dessous.',

	'FILE_ALREADY_UP_TO_DATE'		=> 'Le fichier est déjà à jour.',
	'FILE_DIFF_NOT_ALLOWED'			=> 'Le fichier n’est pas autorisé à être modifié.',
	'FILE_USED'						=> 'Informations utilisées de',			// Single file
	'FILES_CONFLICT'				=> 'Fichiers en conflit',
	'FILES_CONFLICT_EXPLAIN'		=> 'Les fichiers suivants ont été modifiés et ne correspondent plus aux fichiers originaux de l’ancienne version. phpBB a déterminé qu’il ne pouvait pas fusionner ces fichiers sans créer de conflits. Veuillez rechercher les conflits et essayez de les résoudre manuellement ou continuez la mise à jour en choisissant l’une des méthodes de fusion. Si vous résolvez les conflits manuellement, vérifiez à nouveau les fichiers après leur modification. Vous pouvez aussi choisir l’une des méthodes de fusion pour chaque fichier. La première donnera un fichier où les modifications contenues dans les lignes en conflit seront perdues, l’autre ignorera les modifications du nouveau fichier.',
	'FILES_DELETED'					=> 'Fichiers supprimés',
	'FILES_DELETED_EXPLAIN'			=> 'Les fichiers suivants n’existent plus dans cette nouvelle version. Ces fichiers doivent être supprimés de votre installation.',
	'FILES_MODIFIED'				=> 'Fichiers modifiés',
	'FILES_MODIFIED_EXPLAIN'		=> 'Les fichiers suivants ont été modifiés et ne correspondent plus aux fichiers originaux de l’ancienne version. Le fichier mis à jour sera une fusion entre vos modifications et le nouveau fichier.',
	'FILES_NEW'						=> 'Nouveaux fichiers',
	'FILES_NEW_EXPLAIN'				=> 'Les fichiers suivants n’ont pas été trouvés dans votre installation. Ces fichiers seront ajoutés lors de la mise à jour.',
	'FILES_NEW_CONFLICT'			=> 'Nouveaux fichiers en conflit',
	'FILES_NEW_CONFLICT_EXPLAIN'	=> 'Les fichiers suivants sont nouveaux dans la dernière version, mais il existe déjà un fichier de même nom au même emplacement. Ce fichier sera écrasé par le nouveau fichier.',
	'FILES_NOT_MODIFIED'			=> 'Fichiers non modifiés de l’ancienne version, à mettre à jour',
	'FILES_NOT_MODIFIED_EXPLAIN'	=> 'Les fichiers suivants sont les fichiers originaux de l’ancienne version à mettre à jour vers la nouvelle version.',
	'FILES_UP_TO_DATE'				=> 'Fichiers déjà à jour',
	'FILES_UP_TO_DATE_EXPLAIN'		=> 'Les fichiers suivants sont déjà à jour.',
	'FILES_VERSION'					=> 'Versions des fichiers',
	'TOGGLE_DISPLAY'				=> 'Voir/Masquer la liste des fichiers',

	// File updater
	'UPDATE_UPDATING_FILES'	=> 'Mise à jour des fichiers',

	'UPDATE_FILE_UPDATER_HAS_FAILED'	=> 'La méthode de mise à jour de fichiers « %1$s » a échoué. L’assistant d’installation va tenter d’utiliser la méthode « %2$s ».',
	'UPDATE_FILE_UPDATERS_HAVE_FAILED'	=> 'La méthode de mise à jour de fichiers a échoué. Plus aucune méthode n’est disponible pour procéder à la mise à jour des fichiers.',

	'UPDATE_CONTINUE_UPDATE_PROCESS'	=> 'Continuer la procédure de mise à jour',
	'UPDATE_RECHECK_UPDATE_FILES'		=> 'Vérifier à nouveau les fichiers',
));

// Update database
$lang = array_merge($lang, array(
	'STAGE_UPDATE_DATABASE'		=> 'Mettre à jour la base de données',

	'INLINE_UPDATE_SUCCESSFUL'		=> 'La mise à jour de la base de données a été réalisée.',

	'TASK_UPDATE_EXTENSIONS'	=> 'Mise à jour des extensions',
));

// Converter
$lang = array_merge($lang, array(
	// Common converter messages
	'CONVERT_NOT_EXIST'			=> 'Le convertisseur indiqué n’existe pas.',
	'DEV_NO_TEST_FILE'			=> 'Aucune valeur n’a été indiquée pour la variable « test_file » dans le convertisseur. Si vous utilisez ce convertisseur, vous ne devriez pas voir cette erreur, rapportez cette erreur à l’auteur du convertisseur. Si vous êtes l’auteur du convertisseur, vous devez indiquer le nom du fichier présent dans le répertoire source du forum afin de permettre au chemin d’être vérifié.',
	'COULD_NOT_FIND_PATH'		=> 'Impossible de trouver le chemin vers votre ancien forum. Vérifiez vos paramètres et recommencez.<br>» Le chemin indiqué était « %s ».',
	'CONFIG_PHPBB_EMPTY'		=> 'La variable de configuration de phpBB3 pour « %s » est vide.',

	'MAKE_FOLDER_WRITABLE'		=> 'Vérifiez que ce répertoire existe sur le serveur Web et qu’il est accessible en écriture, puis recommencez :<br>» <strong>%s</strong>',
	'MAKE_FOLDERS_WRITABLE'		=> 'Vérifiez que ces répertoires existent sur le serveur Web et qu’ils sont accessibles en écriture, puis recommencez :<br>» <strong>%s</strong>',

	'INSTALL_TEST'				=> 'Tester à nouveau',

	'NO_TABLES_FOUND'			=> 'Aucune table trouvée.',
	'TABLES_MISSING'			=> 'Impossible de trouver ces tables<br>» <strong>%s</strong>.',
	'CHECK_TABLE_PREFIX'		=> 'Vérifiez votre préfixe de table et recommencez.',

	// Conversion in progress
	'CONTINUE_CONVERT'			=> 'Continuer la conversion',
	'CONTINUE_CONVERT_BODY'		=> 'Une conversion est déjà en cours. Vous pouvez choisir de la continuer ou d’en effectuer une nouvelle.',
	'CONVERT_NEW_CONVERSION'	=> 'Nouvelle conversion',
	'CONTINUE_OLD_CONVERSION'	=> 'Continuer la conversion démarrée précédemment',

	// Start conversion
	'SUB_INTRO'					=> 'Introduction',
	'CONVERT_INTRO'				=> 'Bienvenue sur « phpBB Unified Convertor Framework »',
	'CONVERT_INTRO_BODY'		=> 'D’ici, vous pouvez importer des données à partir d’autres systèmes de forum. La liste suivante montre tous les modules de conversion actuellement disponibles. Si le module de conversion de votre forum ne s’y trouve pas, visitez notre site Internet pour vérifier si le convertisseur est disponible.',
	'AVAILABLE_CONVERTORS'		=> 'Convertisseurs disponibles',
	'NO_CONVERTORS'				=> 'Aucun convertisseur disponible',
	'CONVERT_OPTIONS'			=> 'Options',
	'SOFTWARE'					=> 'Logiciel de forum',
	'VERSION'					=> 'Version',
	'CONVERT'					=> 'Convertir',

	// Settings
	'STAGE_SETTINGS'			=> 'Paramètres',
	'TABLE_PREFIX_SAME'			=> 'Le préfixe de table doit être celui utilisé par le logiciel à convertir.<br>» Le préfixe indiqué était « %s »',
	'DEFAULT_PREFIX_IS'			=> 'Le convertisseur n’a pas trouvé de tables avec le préfixe indiqué. Vérifiez que ce préfixe est celui du forum que vous désirez convertir. Le préfixe par défaut pour %1$s est <strong>%2$s</strong>.',
	'SPECIFY_OPTIONS'			=> 'Indiquer les options de conversion',
	'FORUM_PATH'				=> 'Chemin du forum',
	'FORUM_PATH_EXPLAIN'		=> 'Ceci est le chemin <strong>relatif</strong> vers votre ancien forum depuis <strong>la racine de cette installation phpBB3</strong>.',
	'REFRESH_PAGE'				=> 'Rafraîchir la page pour continuer la conversion',
	'REFRESH_PAGE_EXPLAIN'		=> 'Si OUI, le convertisseur va rafraîchir la page après chaque étape. S’il s’agit de votre première conversion pour effectuer des tests et voir les erreurs durant l’avancement, nous vous conseillons de laisser NON.',

	// Conversion
	'STAGE_IN_PROGRESS'			=> 'Conversion en cours',

	'AUTHOR_NOTES'				=> 'Notes de l’auteur<br>» %s',
	'STARTING_CONVERT'			=> 'Démarrage du processus de conversion',
	'CONFIG_CONVERT'			=> 'Conversion des paramètres de configuration',
	'DONE'						=> 'Terminé',
	'PREPROCESS_STEP'			=> 'Exécution des fonctions et requêtes de prétraitement',
	'FILLING_TABLE'				=> 'Remplissage de la table <strong>%s</strong>',
	'FILLING_TABLES'			=> 'Remplissage des tables',
	'DB_ERR_INSERT'				=> 'Erreur pendant l’exécution d’une requête <code>INSERT</code>.',
	'DB_ERR_LAST'				=> 'Erreur pendant l’exécution de <var>query_last</var>.',
	'DB_ERR_QUERY_FIRST'		=> 'Erreur pendant l’exécution de <var>query_first</var>.',
	'DB_ERR_QUERY_FIRST_TABLE'	=> 'Erreur pendant l’exécution de <var>query_first</var>, %s (« %s »).',
	'DB_ERR_SELECT'				=> 'Erreur pendant l’exécution d’une requête <code>SELECT</code>.',
	'STEP_PERCENT_COMPLETED'	=> 'Etape <strong>%d</strong> sur <strong>%d</strong>',
	'FINAL_STEP'				=> 'Étape finale du processus',
	'SYNC_FORUMS'				=> 'Synchronisation des forums',
	'SYNC_POST_COUNT'			=> 'Synchronisation de post_counts',
	'SYNC_POST_COUNT_ID'		=> 'Synchronisation de post_counts de <var>l’entrée</var> %1$s à %2$s.',
	'SYNC_TOPICS'				=> 'Synchronisation des sujets',
	'SYNC_TOPIC_ID'				=> 'Synchronisation des sujets du <var>topic_id</var> $1%s à $2%s.',
	'PROCESS_LAST'					=> 'Exécution des dernières instructions',
	'UPDATE_TOPICS_POSTED'		=> 'Mise à jour des informations de sujets',
	'UPDATE_TOPICS_POSTED_ERR'	=> 'Une erreur est survenue lors de la mise à jour des informations des sujets. Vous pourrez réessayer plus tard via le panneau d’administration.',
	'CONTINUE_LAST'				=> 'Continuer les dernières instructions',
	'CLEAN_VERIFY'				=> 'Nettoyage et vérification de la structure finale',
	'NOT_UNDERSTAND'			=> 'Impossible d’interpréter %s #%d, table %s (« %s »)',
	'NAMING_CONFLICT'			=> 'Conflit de noms : %s et %s sont tous deux des alias<br><br>%s',

	// Finish conversion
	'CONVERT_COMPLETE'			=> 'La conversion est terminée',
	'CONVERT_COMPLETE_EXPLAIN'	=> 'Vous avez converti votre forum vers phpBB 3.3. Assurez-vous que les paramètres aient été correctement transférés avant d’activer votre forum en supprimant le répertoire « install ». Vous pouvez désormais vous connecter et <a href="../">accéder à votre forum</a>. Souvenez-vous que l’aide sur l’utilisation de phpBB est disponible dans la <a href="https://www.phpbb.com/support/docs/en/3.3/ug/">documentation en ligne</a> (en anglais), les <a href="https://www.phpbb.com/community/viewforum.php?f=466">forums de support officiels</a> (en anglais) et les <a href="http://forums.phpbb-fr.com/">forums de support de phpBB-fr.com</a>.',

	'CONV_ERROR_ATTACH_FTP_DIR'			=> 'Le transfert par FTP des fichiers joints est activé sur votre ancien forum. Veuillez désactiver le paramètre « Transfert FTP » et assurez-vous qu’un nom de répertoire de transfert valide soit indiqué, puis copiez tous les fichiers joints dans ce nouveau répertoire. Une fois les fichiers transférés, redémarrez l’assistant de conversion.',
	'CONV_ERROR_CONFIG_EMPTY'			=> 'Il n’y a aucune information de configuration disponible pour la conversion.',
	'CONV_ERROR_FORUM_ACCESS'			=> 'Impossible d’obtenir les informations d’accès au forum.',
	'CONV_ERROR_GET_CATEGORIES'			=> 'Impossible d’obtenir les catégories.',
	'CONV_ERROR_GET_CONFIG'				=> 'Impossible de récupérer la configuration de votre forum.',
	'CONV_ERROR_COULD_NOT_READ'			=> 'Impossible d’accéder/lire « %s ».',
	'CONV_ERROR_GROUP_ACCESS'			=> 'Impossible d’obtenir les informations d’authentification des groupes.',
	'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'La fonction « add_bots() » a détecté une contradiction dans la table « groups » - vous devez ajouter tous les groupes spéciaux manuellement.',
	'CONV_ERROR_INSERT_BOT'				=> 'Impossible d’ajouter un robot dans la table « users ».',
	'CONV_ERROR_INSERT_BOTGROUP'		=> 'Impossible d’ajouter un robot dans la table « bots ».',
	'CONV_ERROR_INSERT_USER_GROUP'		=> 'Impossible d’ajouter un membre dans la table « user_groups ».',
	'CONV_ERROR_MESSAGE_PARSER'			=> 'Erreur lors de l’analyse du message',
	'CONV_ERROR_NO_AVATAR_PATH'			=> 'Note au développeur : vous devez indiquer $convertor[\'avatar_path\'] pour utiliser %s.',
	'CONV_ERROR_NO_FORUM_PATH'			=> 'Le chemin relatif au forum source n’a pas été indiqué.',
	'CONV_ERROR_NO_GALLERY_PATH'		=> 'Note au développeur : vous devez indiquer $convertor[\'avatar_gallery_path\'] pour utiliser %s.',
	'CONV_ERROR_NO_GROUP'				=> 'Le groupe « %1$s » est introuvable dans %2$s.',
	'CONV_ERROR_NO_RANKS_PATH'			=> 'Note au développeur : vous devez indiquer $convertor[\'ranks_path\'] pour utiliser %s.',
	'CONV_ERROR_NO_SMILIES_PATH'		=> 'Note au développeur : vous devez indiquer $convertor[\'smilies_path\'] pour utiliser %s.',
	'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Note au développeur : vous devez indiquer $convertor[\'upload_path\'] pour utiliser %s.',
	'CONV_ERROR_PERM_SETTING'			=> 'Impossible d’insérer/mettre à jour les paramètres de permissions.',
	'CONV_ERROR_PM_COUNT'				=> 'Impossible de sélectionner le compteur de dossiers de messagerie privée.',
	'CONV_ERROR_REPLACE_CATEGORY'		=> 'Impossible d’insérer le nouveau forum en remplacement de l’ancienne catégorie.',
	'CONV_ERROR_REPLACE_FORUM'			=> 'Impossible d’insérer le nouveau forum en remplacement de l’ancien forum.',
	'CONV_ERROR_USER_ACCESS'			=> 'Impossible d’obtenir les informations d’authentification du membre.',
	'CONV_ERROR_WRONG_GROUP'			=> 'Mauvais groupe « %1$s » défini dans %2$s.',
	'CONV_OPTIONS_BODY'					=> 'Cette page collecte les informations qui sont requises pour accéder à votre forum source. Saisissez les informations de la base de données de votre ancien forum ; le convertisseur ne modifiera en rien la base de données ci-dessous. Le forum source devrait être désactivé pour permettre une conversion sans risque.',
	'CONV_SAVED_MESSAGES'				=> 'Messages sauvegardés',

	'PRE_CONVERT_COMPLETE'			=> 'Toutes les étapes de pré-conversion sont terminées. Vous pouvez commencer le processus de conversion. Notez que vous pouvez avoir à faire et ajuster plusieurs choses manuellement. Après la conversion, vérifiez particulièrement les permissions assignées, reconstruisez votre index de recherche si nécessaire et assurez-vous que les fichiers ont été correctement copiés, par exemple, les avatars et les smileys.',
));
