<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <https://www.phpbb-fr.com>
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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> 'Administrateurs',
	'ACP_ADMIN_LOGS'			=> 'Journal d’administration',
	'ACP_ADMIN_ROLES'			=> 'Modèles d’administration',
	'ACP_ATTACHMENTS'			=> 'Fichiers joints',
	'ACP_ATTACHMENT_SETTINGS'	=> 'Paramètres des fichiers joints',
	'ACP_AUTH_SETTINGS'			=> 'Authentification',
	'ACP_AUTOMATION'			=> 'Automatique',
	'ACP_AVATAR_SETTINGS'		=> 'Paramètres des avatars',

	'ACP_BACKUP'				=> 'Sauvegarder',
	'ACP_BAN'					=> 'Bannissement',
	'ACP_BAN_EMAILS'			=> 'Bannissement d’adresses courriels',
	'ACP_BAN_IPS'				=> 'Bannissement d’IP',
	'ACP_BAN_USERNAMES'			=> 'Bannissement de membres',
	'ACP_BBCODES'				=> 'BBCodes',
	'ACP_BOARD_CONFIGURATION'	=> 'Configuration générale',
	'ACP_BOARD_FEATURES'		=> 'Fonctionnalités du forum',
	'ACP_BOARD_MANAGEMENT'		=> 'Gestion du forum',
	'ACP_BOARD_SETTINGS'		=> 'Configuration du forum',
	'ACP_BOTS'					=> 'Robots',

	'ACP_CAPTCHA'				=> 'CAPTCHA',

	'ACP_CAT_CUSTOMISE'			=> 'Personnaliser',
	'ACP_CAT_DATABASE'			=> 'Base de données',
	'ACP_CAT_DOT_MODS'			=> 'Extensions',
	'ACP_CAT_FORUMS'			=> 'Forums',
	'ACP_CAT_GENERAL'			=> 'Général',
	'ACP_CAT_MAINTENANCE'		=> 'Maintenance',
	'ACP_CAT_PERMISSIONS'		=> 'Permissions',
	'ACP_CAT_POSTING'			=> 'Messages',
	'ACP_CAT_STYLES'			=> 'Styles',
	'ACP_CAT_SYSTEM'			=> 'Système',
	'ACP_CAT_USERGROUP'			=> 'Membres et groupes',
	'ACP_CAT_USERS'				=> 'Membres',
	'ACP_CLIENT_COMMUNICATION'	=> 'Communication',
	'ACP_COOKIE_SETTINGS'		=> 'Paramètres de cookie',
	'ACP_CONTACT'				=> 'Page de contact',
	'ACP_CONTACT_SETTINGS'		=> 'Paramètres de la page de contact',
	'ACP_CRITICAL_LOGS'			=> 'Journal des erreurs',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> 'Champs de profil personnalisés',

	'ACP_DATABASE'				=> 'Gestion de la base de données',
	'ACP_DISALLOW'				=> 'Interdictions',
	'ACP_DISALLOW_USERNAMES'	=> 'Interdire des noms d’utilisateurs',

	'ACP_EMAIL_SETTINGS'		=> 'Paramètres des courriels',
	'ACP_EXTENSION_GROUPS'		=> 'Gérer les groupes d’extensions des fichiers joints',
	'ACP_EXTENSION_MANAGEMENT'	=> 'Gestion des extensions',
	'ACP_EXTENSIONS'			=> 'Gérer les extensions',

	'ACP_FORUM_BASED_PERMISSIONS'	=> 'Permissions des forums',
	'ACP_FORUM_LOGS'				=> 'Journaux du forum',
	'ACP_FORUM_MANAGEMENT'			=> 'Gestion du forum',
	'ACP_FORUM_MODERATORS'			=> 'Modérateurs des forums',
	'ACP_FORUM_PERMISSIONS'			=> 'Permissions des forums',
	'ACP_FORUM_PERMISSIONS_COPY'	=> 'Copier les permissions de forum',
	'ACP_FORUM_ROLES'				=> 'Modèles de forum',

	'ACP_GENERAL_CONFIGURATION'		=> 'Configuration générale',
	'ACP_GENERAL_TASKS'				=> 'Tâches générales',
	'ACP_GLOBAL_MODERATORS'			=> 'Modérateurs globaux',
	'ACP_GLOBAL_PERMISSIONS'		=> 'Permissions globales',
	'ACP_GROUPS'					=> 'Groupes',
	'ACP_GROUPS_FORUM_PERMISSIONS'	=> 'Permissions groupes/forums',
	'ACP_GROUPS_MANAGE'				=> 'Gérer les groupes',
	'ACP_GROUPS_MANAGEMENT'			=> 'Gestion des groupes',
	'ACP_GROUPS_PERMISSIONS'		=> 'Permissions des groupes',
	'ACP_GROUPS_POSITION'			=> 'Gérer la position des groupes',

	'ACP_HELP_PHPBB'			=> 'Aider et soutenir phpBB',

	'ACP_ICONS'					=> 'Icônes de sujet',
	'ACP_ICONS_SMILIES'			=> 'Icônes et smileys de sujet',
	'ACP_INACTIVE_USERS'		=> 'Membres inactifs',
	'ACP_INDEX'					=> 'Index de l’administration',

	'ACP_JABBER_SETTINGS'		=> 'Paramètres Jabber',

	'ACP_LANGUAGE'				=> 'Gestion des langues',
	'ACP_LANGUAGE_PACKS'		=> 'Packs de langue',
	'ACP_LOAD_SETTINGS'			=> 'Paramètres de charge',
	'ACP_LOGGING'				=> 'Journaux',

	'ACP_MAIN'					=> 'Index de l’administration',

	'ACP_MANAGE_ATTACHMENTS'			=> 'Gérer les fichiers joints',
	'ACP_MANAGE_ATTACHMENTS_EXPLAIN'	=> 'Ici, vous pouvez consulter et supprimer les fichiers attachés à des messages et à des messages privés.',

	'ACP_MANAGE_EXTENSIONS'		=> 'Gérer les extensions des fichiers joints',
	'ACP_MANAGE_FORUMS'			=> 'Gérer les forums',
	'ACP_MANAGE_RANKS'			=> 'Gérer les rangs',
	'ACP_MANAGE_REASONS'		=> 'Gérer les rapports/raisons',
	'ACP_MANAGE_USERS'			=> 'Gérer les membres',
	'ACP_MASS_EMAIL'			=> 'Courriel de masse',
	'ACP_MESSAGES'				=> 'Messages',
	'ACP_MESSAGE_SETTINGS'		=> 'Paramètres des messages privés',
	'ACP_MODULE_MANAGEMENT'		=> 'Gestion de modules',
	'ACP_MOD_LOGS'				=> 'Journal de modération',
	'ACP_MOD_ROLES'				=> 'Modèles de modération',

	'ACP_NO_ITEMS'				=> 'Il n’y a actuellement aucun élément.',

	'ACP_ORPHAN_ATTACHMENTS'	=> 'Fichiers joints orphelins',

	'ACP_PERMISSIONS'			=> 'Permissions',
	'ACP_PERMISSION_MASKS'		=> 'Masques de permission',
	'ACP_PERMISSION_ROLES'		=> 'Modèles de permission',
	'ACP_PERMISSION_TRACE'		=> 'Trace de permission',
	'ACP_PHP_INFO'				=> 'Informations PHP',
	'ACP_POST_SETTINGS'			=> 'Paramètres des messages',
	'ACP_PRUNE_FORUMS'			=> 'Délester les forums',
	'ACP_PRUNE_USERS'			=> 'Délester des membres',
	'ACP_PRUNING'				=> 'Délestage',

	'ACP_QUICK_ACCESS'			=> 'Accès rapide',

	'ACP_RANKS'					=> 'Rangs',
	'ACP_REASONS'				=> 'Rapports/raisons',
	'ACP_REGISTER_SETTINGS'		=> 'Paramètres des enregistrements',

	'ACP_RESTORE'				=> 'Restaurer',

	'ACP_FEED'					=> 'Gestion des flux',
	'ACP_FEED_SETTINGS'			=> 'Paramètres des flux',

	'ACP_SEARCH'				=> 'Recherche',
	'ACP_SEARCH_INDEX'			=> 'Index de recherche',
	'ACP_SEARCH_SETTINGS'		=> 'Paramètres de recherche',

	'ACP_SECURITY_SETTINGS'		=> 'Paramètres de sécurité',
	'ACP_SERVER_CONFIGURATION'	=> 'Configuration du serveur',
	'ACP_SERVER_SETTINGS'		=> 'Paramètres du serveur',
	'ACP_SIGNATURE_SETTINGS'	=> 'Paramètres de signature',
	'ACP_SMILIES'				=> 'Smileys',
	'ACP_STYLE_MANAGEMENT'		=> 'Gestion des styles',
	'ACP_STYLES'				=> 'Gérer les styles',
	'ACP_STYLES_CACHE'			=> 'Purger le cache',
	'ACP_STYLES_INSTALL'		=> 'Installer des styles',

	'ACP_SUBMIT_CHANGES'		=> 'Soumettre les changements',

	'ACP_TEMPLATES'				=> 'Templates',
	'ACP_THEMES'				=> 'Thèmes',

	'ACP_UPDATE'					=> 'Mise à jour',
	'ACP_USERS_FORUM_PERMISSIONS'	=> 'Permissions membres/forums',
	'ACP_USERS_LOGS'				=> 'Journal d’utilisateur',
	'ACP_USERS_PERMISSIONS'			=> 'Permissions des membres',
	'ACP_USER_ATTACH'				=> 'Fichiers joints',
	'ACP_USER_AVATAR'				=> 'Avatar',
	'ACP_USER_FEEDBACK'				=> 'Fiche de suivi',
	'ACP_USER_GROUPS'				=> 'Groupes',
	'ACP_USER_MANAGEMENT'			=> 'Gestion utilisateur',
	'ACP_USER_OVERVIEW'				=> 'Vue d’ensemble',
	'ACP_USER_PERM'					=> 'Permissions',
	'ACP_USER_PREFS'				=> 'Préférences',
	'ACP_USER_PROFILE'				=> 'Profil',
	'ACP_USER_RANK'					=> 'Rang',
	'ACP_USER_ROLES'				=> 'Modèles d’utilisateur',
	'ACP_USER_SECURITY'				=> 'Sécurité utilisateur',
	'ACP_USER_SIG'					=> 'Signature',
	'ACP_USER_WARNINGS'				=> 'Avertissements',

	'ACP_VC_SETTINGS'					=> 'Paramètres de la confirmation visuelle',
	'ACP_VC_CAPTCHA_DISPLAY'			=> 'Aperçu CAPTCHA',
	'ACP_VERSION_CHECK'					=> 'Vérifier les mises à jour',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> 'Permissions des administrateurs',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS'	=> 'Permissions des modérateurs de forums',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> 'Permissions des forums',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS'	=> 'Permissions des modérateurs globaux',
	'ACP_VIEW_USER_PERMISSIONS'			=> 'Permissions des membres',

	'ACP_WORDS'					=> 'Censure',

	'ACTION'				=> 'Action',
	'ACTIONS'				=> 'Actions',
	'ACTIVATE'				=> 'Activer',
	'ADD'					=> 'Ajouter',
	'ADMIN'					=> 'Administration',
	'ADMIN_INDEX'			=> 'Index de l’administration',
	'ADMIN_PANEL'			=> 'Panneau d’administration',

	'ADM_LOGOUT'			=> 'Déconnexion PCA',
	'ADM_LOGGED_OUT'		=> 'Vous avez été déconnecté du panneau d’administration',

	'BACK'					=> 'Retour',

	'CONTAINER_EXCEPTION'	=> 'phpBB a rencontré une erreur lors de la construction du conteneur en raison d’une extension installée. Pour cette raison, toutes les extensions ont été temporairement désactivées. Elles seront automatiquement réactivées dès que l’erreur de conteneur sera résolue. Pour cela, commencez par purger le cache de votre forum. Si cette erreur persiste, veuillez visiter le <a href="https://www.phpbb.com/support">forum de support phpBB.com</a> (en anglais) ou le <a href="https://www.phpbb-fr.com/forums/">forum de support phpBB-fr.com</a> (en français).',
	'EXCEPTION'				=> 'Exception',

	'COLOUR_SWATCH'			=> 'Palette de couleurs',
	'CONFIG_UPDATED'		=> 'La configuration a été mise à jour.',
	'CRON_LOCK_ERROR'		=> 'Impossible de gérer le verrou de cron.',
	'CRON_NO_SUCH_TASK'		=> 'Impossible de trouver la tâche cron « %s ».',
	'CRON_NO_TASK'			=> 'Aucune tâche cron n’a besoin d’être exécutée dans l’immédiat.',
	'CRON_NO_TASKS'			=> 'Aucune tâche cron n’a été trouvée.',
	'CSV_INVALID'			=> 'Les valeurs du paramètre « %1$s », séparées par des virgules, ne sont pas valides. Les valeurs doivent être délimitées uniquement par des virgules. La saisie ne doit pas débuter ou finir avec un délimiteur.',
	'CURRENT_VERSION'		=> 'Version actuelle',

	'DEACTIVATE'				=> 'Désactiver',
	'DIRECTORY_DOES_NOT_EXIST'	=> 'Le chemin indiqué « %s » n’existe pas.',
	'DIRECTORY_NOT_DIR'			=> 'Le chemin indiqué « %s » n’est pas un répertoire.',
	'DIRECTORY_NOT_WRITABLE'	=> 'Le chemin indiqué « %s » n’est pas accessible en écriture.',
	'DISABLE'					=> 'Désactiver',
	'DOWNLOAD'					=> 'Télécharger',
	'DOWNLOAD_AS'				=> 'Télécharger sous',
	'DOWNLOAD_STORE'			=> 'Télécharger ou stocker le fichier joint',
	'DOWNLOAD_STORE_EXPLAIN'	=> 'Vous pouvez directement télécharger le fichier joint ou le sauvegarder dans le répertoire <samp>store/</samp>.',
	'DOWNLOADS'					=> 'Téléchargements',

	'EDIT'					=> 'Modifier',
	'ENABLE'				=> 'Activer',
	'EXPORT_DOWNLOAD'		=> 'Téléchargement',
	'EXPORT_STORE'			=> 'Stockage',

	'GENERAL_OPTIONS'		=> 'Options générales',
	'GENERAL_SETTINGS'		=> 'Paramètres généraux',
	'GLOBAL_MASK'			=> 'Masque de permission globale',

	'INSTALL'				=> 'Installer',
	'IP'					=> 'Adresse IP',
	'IP_HOSTNAME'			=> 'Adresses IP ou noms d’hôtes',

	'LATEST_VERSION'		=> 'Dernière version',
	'LOAD_NOTIFICATIONS'			=> 'Afficher les notifications',
	'LOAD_NOTIFICATIONS_EXPLAIN'	=> 'Affiche la liste des notifications sur chaque page (généralement dans l’en-tête du forum).',
	'LOGGED_IN_AS'				=> 'Vous êtes connecté en tant que :',
	'LOGIN_ADMIN'				=> 'Vous devez être connecté pour administrer le forum.',
	'LOGIN_ADMIN_CONFIRM'		=> 'Vous devez vous reconnecter pour administrer le forum.',
	'LOGIN_ADMIN_SUCCESS'		=> 'Vous avez été authentifié et vous allez être redirigé vers le panneau d’administration.',
	'LOOK_UP_FORUM'				=> 'Sélectionner un forum',
	'LOOK_UP_FORUMS_EXPLAIN'	=> 'Vous pouvez sélectionner plus d’un forum.',

	'MANAGE'				=> 'Gérer',
	'MENU_TOGGLE'			=> 'Cacher ou afficher le menu latéral',
	'MORE'					=> 'Plus',			// Not used at the moment
	'MORE_INFORMATION'		=> 'Plus d’informations »',
	'MOVE_DOWN'				=> 'Descendre',
	'MOVE_UP'				=> 'Monter',

	'NOTIFY'				=> 'Notification',
	'NO_ADMIN'				=> 'Vous n’êtes pas autorisé à administrer ce forum.',
	'NO_EMAILS_DEFINED'		=> 'Aucune adresse courriel valide n’a été indiquée.',
	'NO_FILES_TO_DELETE'	=> 'Les fichiers joints que vous avez sélectionnés pour suppression n’existent pas.',
	'NO_PASSWORD_SUPPLIED'	=> 'Vous devez indiquer votre mot de passe pour accéder au panneau d’administration',

	'OFF'					=> 'Off',
	'ON'					=> 'On',

	'PARSE_BBCODE'						=> 'Autoriser les BBCodes',
	'PARSE_SMILIES'						=> 'Autoriser les smileys',
	'PARSE_URLS'						=> 'Autoriser les liens',
	'PERMISSIONS_TRANSFERRED'			=> 'Les permissions ont été transférées',
	'PERMISSIONS_TRANSFERRED_EXPLAIN'	=> 'Vous utilisez actuellement les permissions de %1$s. Vous pouvez naviguer sur le forum avec les permissions de ce membre, mais ne pouvez pas accéder au panneau d’administration car les permissions d’administration ne sont pas transférables. Vous pouvez <a href="%2$s"><strong>réinitialiser vos permissions</strong></a> à tout moment.',
	'PROCEED_TO_ACP'					=> '%sAller au panneau d’administration%s',

	'RELEASE_ANNOUNCEMENT'	=> 'Annonce',
	'REMIND'				=> 'Rappeler',
	'REPARSE_LOCK_ERROR'	=> 'Une réanalyse est déjà en cours par un autre processus.',
	'RESYNC'				=> 'Resynchroniser',

	'RUNNING_TASK'			=> 'Tâche en cours d’exécution : %s.',
	'SELECT_ANONYMOUS'		=> 'Sélectionner le compte invité',
	'SELECT_OPTION'			=> 'Sélectionner une option',

	'SETTING_TOO_LOW'		=> 'La valeur indiquée pour le paramètre « %1$s » est trop faible. La valeur minimale acceptée est de %2$d.',
	'SETTING_TOO_BIG'		=> 'La valeur indiquée pour le paramètre « %1$s » est trop élevée. La valeur maximale acceptée est de %2$d.',
	'SETTING_TOO_LONG'		=> 'La valeur indiquée pour le paramètre « %1$s » est trop longue. La longueur maximale acceptée est de %2$d.',
	'SETTING_TOO_SHORT'		=> 'La valeur indiquée pour le paramètre « %1$s » est trop courte. La longueur minimale acceptée est de %2$d.',

	'SHOW_ALL_OPERATIONS'	=> 'Afficher toutes les opérations',

	'TASKS_NOT_READY'		=> 'Tâches non prêtes :',
	'TASKS_READY'			=> 'Tâches prêtes :',
	'TOTAL_SIZE'			=> 'Taille totale',

	'UCP'					=> 'Panneau de l’utilisateur',
	'URL_INVALID'			=> 'L’URL indiquée pour le paramètre « %1$s » n’est pas valide.',
	'URL_SCHEME_INVALID'	=> 'Le schéma « %2$s » saisi dans le paramètre « %1$s » n’est pas valide. Un schéma doit commencer par un caractère latin et doit être suivi de caractères alphanumériques, de traits-d’unions ou de points.',
	'USERNAMES_EXPLAIN'		=> 'Indiquez un nom d’utilisateur par ligne',
	'USER_CONTROL_PANEL'	=> 'Panneau de l’utilisateur',

	'UPDATE_NEEDED'			=> 'Le forum n’est pas à jour.',
	'UPDATE_NOT_NEEDED'		=> 'Le forum est à jour.',
	'UPDATES_AVAILABLE'		=> 'Mises à jour disponibles :',

	'WARNING'				=> 'Avertissement',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'	=> 'Cette page contient des détails sur la version installée de PHP. Elle comprend les modules chargés, les variables existantes et les paramètres par défaut. Ces informations peuvent être utiles pour diagnostiquer des problèmes. Soyez attentifs car certains hébergeurs peuvent restreindre l’affichage de ces informations pour des raisons de sécurité. Il est recommandé de ne pas communiquer les informations de cette page, à moins qu’un membre de l’équipe ne les demande.',

	'NO_PHPINFO_AVAILABLE'	=> 'Impossible d’afficher les informations PHP. La fonction Phpinfo() a été désactivée pour des raisons de sécurité.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> 'Liste toutes les actions effectuées par les administrateurs. Vous pouvez trier par nom, date, IP ou par action. Si vous avez les permissions nécessaires vous pouvez aussi effacer individuellement les opérations ou le journal complet.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> 'Liste des actions effectuées par le système. Ce journal vous fournit des informations que vous pouvez utiliser pour résoudre des problèmes particuliers, comme le non-acheminement des courriels. Vous pouvez trier par nom d’utilisateur, date, IP ou action. Si vous avez les permissions nécessaires vous pouvez aussi effacer individuellement les opérations ou le journal complet.',
	'ACP_MOD_LOGS_EXPLAIN'		=> 'Liste toutes les actions effectuées sur les forums, les sujets et les messages ainsi que les actions menées sur les utilisateurs par les modérateurs, y compris les bannissements. Vous pouvez trier par nom d’utilisateur, date, IP ou action. Si vous avez les permissions nécessaires vous pouvez aussi effacer individuellement les opérations ou le journal complet.',
	'ACP_USERS_LOGS_EXPLAIN'	=> 'Liste toutes les actions effectuées par les membres ou sur les membres (rapports, avertissements et notes sur le membre).',
	'ALL_ENTRIES'				=> 'Toutes les entrées',

	'DISPLAY_LOG'	=> 'Affiche les entrées précédentes',

	'NO_ENTRIES'	=> 'Aucune entrée pour la période indiquée',

	'SORT_IP'		=> 'Adresse IP',
	'SORT_DATE'		=> 'Date',
	'SORT_ACTION'	=> 'Action',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> 'Merci d’avoir choisi phpBB comme solution pour votre forum. Cette page vous donnera un rapide aperçu des diverses statistiques de votre forum.<br>Les liens situés sur le volet de gauche vous permettront de contrôler tous les aspects de votre forum.<br>Chaque page contiendra les instructions nécessaires concernant l’utilisation des outils concernés.',
	'ADMIN_LOG'					=> 'Journal des actions des administrateurs',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> 'Ceci est un aperçu des cinq dernières actions effectuées par les administrateurs. Une liste complète des actions est disponible en vous rendant dans le menu approprié du panneau d’administration ou en cliquant directement sur le lien ci-dessous.',
	'AVATAR_DIR_SIZE'			=> 'Taille du répertoire de stockage des avatars',

	'BOARD_STARTED'		=> 'Date d’ouverture du forum',
	'BOARD_VERSION'		=> 'Version du forum',

	'DATABASE_SERVER_INFO'	=> 'Serveur de base de données',
	'DATABASE_SIZE'			=> 'Taille de la base de données',

	// Environment configuration checks, mbstring related
	'ERROR_MBSTRING_FUNC_OVERLOAD'					=> 'La fonction de surcharge n’est pas configurée correctement.',
	'ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN'			=> '<var>mbstring.func_overload</var> doit être configuré sur 0 ou 4. Vous pouvez vérifier la valeur actuelle dans la page <samp>Informations PHP</samp>.',
	'ERROR_MBSTRING_ENCODING_TRANSLATION'			=> 'Les caractères d’encodage transparents ne sont pas configurés correctement.',
	'ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN'	=> '<var>mbstring.encoding_translation</var> doit être configuré sur 0. Vous pouvez vérifier la valeur actuelle dans la page <samp>Informations PHP</samp>.',
	'ERROR_MBSTRING_HTTP_INPUT'						=> 'La conversion des caractères d’entrée HTTP n’est pas configurée correctement.',
	'ERROR_MBSTRING_HTTP_INPUT_EXPLAIN'				=> '<var>mbstring.http_input</var> doit être laissé vide. Vous pouvez vérifier la valeur actuelle dans la page <samp>Informations PHP</samp>.',
	'ERROR_MBSTRING_HTTP_OUTPUT'					=> 'La conversion des caractères de sortie HTTP n’est pas configurée correctement.',
	'ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN'			=> '<var>mbstring.http_output</var> doit être laissé vide. Vous pouvez vérifier la valeur actuelle dans la page <samp>Informations PHP</samp>.',
	'ERROR_DEFAULT_CHARSET'							=> 'Le jeu de caractères par défaut n’est pas configuré correctement.',
	'ERROR_DEFAULT_CHARSET_EXPLAIN'					=> '<var>default_charset</var> doit être configuré sur <samp>UTF-8</samp>. Vous pouvez vérifier la valeur actuelle dans la page <samp>Informations PHP</samp>.',

	'FILES_PER_DAY'		=> 'Moyenne journalière de fichiers joints',
	'FORUM_STATS'		=> 'Statistiques du forum',

	'GZIP_COMPRESSION'	=> 'Compression GZip',

	'NO_SEARCH_INDEX'	=> 'Le moteur de recherche sélectionné n’a pas d’index de recherche.<br>Veuillez créer l’index de recherche pour « %1$s » depuis la page %2$sIndex de recherche%3$s.',
	'NOT_AVAILABLE'		=> 'Indisponible',
	'NUMBER_FILES'		=> 'Nombre de fichiers joints',
	'NUMBER_POSTS'		=> 'Nombre de messages',
	'NUMBER_TOPICS'		=> 'Nombre de sujets',
	'NUMBER_USERS'		=> 'Nombre de membres',
	'NUMBER_ORPHAN'		=> 'Nombre de fichiers joints orphelins',

	'PHP_VERSION'		=> 'Version de PHP',
	'PHP_VERSION_OLD'	=> 'La version de PHP utilisée sur ce serveur (%1$s) ne sera plus supportée par les futures versions de phpBB. La version minimum requise sera PHP %2$s. %3$sPlus d’informations%4$s (en anglais).',

	'POSTS_PER_DAY'		=> 'Moyenne journalière de messages',

	'PURGE_CACHE'			=> 'Purger le cache',
	'PURGE_CACHE_CONFIRM'	=> 'Êtes-vous sûr de vouloir purger le cache ?',
	'PURGE_CACHE_EXPLAIN'	=> 'Purge tous les éléments liés au cache, ce qui inclut tous les fichiers de template mis en cache ou les requêtes.',
	'PURGE_CACHE_SUCCESS'	=> 'Le cache a été purgé.',

	'PURGE_SESSIONS'			=> 'Purger toutes les sessions',
	'PURGE_SESSIONS_CONFIRM'	=> 'Êtes-vous sûr de vouloir purger toutes les sessions ? Cela aura pour effet de déconnecter tous les utilisateurs.',
	'PURGE_SESSIONS_EXPLAIN'	=> 'Purge toutes les sessions. Cela aura pour effet de déconnecter tous les utilisateurs en vidant la table des sessions.',
	'PURGE_SESSIONS_SUCCESS'	=> 'Les sessions ont été purgées.',

	'RESET_DATE'					=> 'Réinitialiser la date d’ouverture du forum',
	'RESET_DATE_CONFIRM'			=> 'Êtes-vous sûr de vouloir réinitialiser la date d’ouverture du forum ?',
	'RESET_DATE_SUCCESS'			=> 'La date d’ouverture du forum a été réinitialisée.',
	'RESET_ONLINE'					=> 'Réinitialiser le record des utilisateurs connectés',
	'RESET_ONLINE_CONFIRM'			=> 'Êtes-vous sûr de vouloir réinitialiser le record des utilisateurs connectés ?',
	'RESET_ONLINE_SUCCESS'			=> 'Le record des utilisateurs connectés a été réinitialisé.',
	'RESYNC_POSTCOUNTS'				=> 'Resynchroniser les compteurs de messages',
	'RESYNC_POSTCOUNTS_EXPLAIN'		=> 'Seuls les messages existants seront pris en compte. Les messages délestés ne seront pas pris en compte.',
	'RESYNC_POSTCOUNTS_CONFIRM'		=> 'Êtes-vous sûr de vouloir resynchroniser les compteurs de messages d’utilisateur ?',
	'RESYNC_POSTCOUNTS_SUCCESS'		=> 'Les compteurs de messages ont été resynchronisés.',
	'RESYNC_POST_MARKING'			=> 'Resynchroniser les sujets pointés',
	'RESYNC_POST_MARKING_CONFIRM'	=> 'Êtes-vous sûr de vouloir resynchroniser les sujets pointés ?',
	'RESYNC_POST_MARKING_EXPLAIN'	=> 'Décoche tous les sujets et coche correctement les sujets ayant eu une activité durant les six derniers mois.',
	'RESYNC_POST_MARKING_SUCCESS'	=> 'Les sujets pointés ont été resynchronisés.',
	'RESYNC_STATS'					=> 'Actualiser les statistiques',
	'RESYNC_STATS_CONFIRM'			=> 'Êtes-vous sûr de vouloir actualiser les statistiques ?',
	'RESYNC_STATS_EXPLAIN'			=> 'Recalcule le nombre total de messages, sujets, utilisateurs et fichiers joints.',
	'RESYNC_STATS_SUCCESS'			=> 'Les statistiques ont été actualisées.',
	'RUN'							=> 'Exécuter maintenant',

	'STATISTIC'					=> 'Statistiques',
	'STATISTIC_RESYNC_OPTIONS'	=> 'Actualiser ou réinitialiser les statistiques',

	'TIMEZONE_INVALID'	=> 'Le fuseau horaire sélectionné n’est pas valide.',
	'TIMEZONE_SELECTED'	=> '(actuellement sélectionné)',
	'TOPICS_PER_DAY'	=> 'Moyenne journalière de sujets',

	'UPLOAD_DIR_SIZE'	=> 'Taille des fichiers joints',
	'USERS_PER_DAY'		=> 'Moyenne d’utilisateurs enregistrés par jour',

	'VALUE'							=> 'Valeur',
	'VERSIONCHECK_FAIL'				=> 'Impossible d’obtenir les informations de la dernière version.',
	'VERSIONCHECK_FORCE_UPDATE'		=> 'Re-contrôler la version',
	'VERSIONCHECK_INVALID_ENTRY'	=> 'Les informations de la dernière version contiennent des données non supportées.',
	'VERSIONCHECK_INVALID_URL'		=> 'Les informations de la dernière version contiennent une URL non valide.',
	'VERSIONCHECK_INVALID_VERSION'	=> 'Les informations de la dernière version contiennent un numéro de version non valide.',
	'VERSION_CHECK'					=> 'Vérification de la version',
	'VERSION_CHECK_EXPLAIN'			=> 'Vérifie si votre installation de phpBB est à jour.',
	'VERSION_NOT_UP_TO_DATE_ACP'	=> 'Votre installation de phpBB n’est pas à jour.<br>Vous trouverez ci-dessous un lien vers l’annonce de publication qui contient davantage d’informations, telles que les instructions de mise à jour.',
	'VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Votre installation phpBB n’est pas à jour.',
	'VERSION_UP_TO_DATE_ACP'		=> 'Votre installation phpBB est à jour.',
	'VIEW_ADMIN_LOG'				=> 'Voir le journal d’administration',
	'VIEW_INACTIVE_USERS'			=> 'Voir les membres inactifs',

	'WELCOME_PHPBB'			=> 'Bienvenue dans phpBB',
	'WRITABLE_CONFIG'		=> 'Votre fichier de configuration (config.php) est actuellement accessible en écriture par tout le monde. Nous vous recommandons fortement de modifier les permissions en 640, ou au moins 644 (par exemple <a href="http://fr.wikipedia.org/wiki/chmod" rel="external">chmod</a> 640 config.php).',
));

// Inactive Users
$lang = array_merge($lang, array(
	'INACTIVE_DATE'					=> 'Date d’inactivité',
	'INACTIVE_REASON'				=> 'Raison',
	'INACTIVE_REASON_MANUAL'		=> 'Compte désactivé par un administrateur',
	'INACTIVE_REASON_PROFILE'		=> 'Informations du profil mises à jour',
	'INACTIVE_REASON_REGISTER'		=> 'Nouveau compte',
	'INACTIVE_REASON_REMIND'		=> 'Réactivation forcée',
	'INACTIVE_REASON_UNKNOWN'		=> 'Inconnu',
	'INACTIVE_USERS'				=> 'Membres inactifs',
	'INACTIVE_USERS_EXPLAIN'		=> 'Ceci est la liste des membres récemment enregistrés, mais encore inactifs. Vous pouvez activer, supprimer ou contacter (en envoyant un courriel) ces membres si vous le souhaitez.',
	'INACTIVE_USERS_EXPLAIN_INDEX'	=> 'Ceci est la liste des 10 derniers comptes créés restés inactifs. Ces comptes sont inactifs soit parce que l’activation de compte est/était activée dans les paramètres des enregistrements et que ces comptes d’utilisateurs n’ont pas encore été activés, soit parce que ces comptes ont été désactivés. Une liste complète des membres inactifs est disponible en cliquant directement sur le lien ci-dessous. Vous pourrez activer, supprimer ou contacter (par l’envoi d’un courriel) ces membres si vous le souhaitez.',

	'NO_INACTIVE_USERS'		=> 'Aucun membre inactif',

	'SORT_INACTIVE'			=> 'Date d’inactivité',
	'SORT_LAST_VISIT'		=> 'Dernière visite',
	'SORT_REASON'			=> 'Raison',
	'SORT_REG_DATE'			=> 'Date d’enregistrement',
	'SORT_LAST_REMINDER'	=> 'Dernier rappel',
	'SORT_REMINDER'			=> 'Rappel envoyé',

	'USER_IS_INACTIVE'		=> 'Le membre est inactif',
));

// Help support phpBB page
$lang = array_merge($lang, array(
	'EXPLAIN_SEND_STATISTICS'	=> 'Si vous le souhaitez, envoyez les informations de configuration concernant votre serveur et votre forum à phpBB pour contribuer aux analyses statistiques. Toutes les informations qui permettraient d’identifier votre site ou vous-même seront supprimées - Les données sont complètement <strong>anonymes</strong>. Nous baserons nos décisions au sujet des futures versions de phpBB sur ces informations. Les statistiques seront disponibles publiquement. Nous partageons aussi ces données avec le projet PHP, langage de programmation avec lequel phpBB est conçu.',
	'EXPLAIN_SHOW_STATISTICS'	=> 'En utilisant le bouton ci-dessous, vous pouvez prévisualiser toutes les variables qui nous seront transmises.',
	'DONT_SEND_STATISTICS'		=> 'Retourner au PCA si vous ne souhaitez pas envoyer de statistiques à phpBB.',
	'GO_ACP_MAIN'				=> 'Aller à la page de démarrage du PCA',
	'HIDE_STATISTICS'			=> 'Masquer les détails',
	'SEND_STATISTICS'			=> 'Rapport de statistiques',
	'SEND_STATISTICS_LONG'		=> 'Envoyer un rapport de statistiques',
	'SHOW_STATISTICS'			=> 'Afficher les détails',
	'THANKS_SEND_STATISTICS'	=> 'Merci de nous avoir transmis votre rapport de statistiques.',
	'FAIL_SEND_STATISTICS'		=> 'phpBB n’a pas été en mesure d’envoyer le rapport de statistiques.',
));

// Log Entries
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'	=> '<strong>Ajout/modification des permissions utilisateur d’un membre</strong><br>» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'	=> '<strong>Ajout/modification des permissions utilisateur d’un groupe</strong><br>» %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'	=> '<strong>Ajout/modification des permissions de modération globale d’un membre</strong><br>» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'	=> '<strong>Ajout/modification des permissions de modération globale d’un groupe</strong><br>» %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'	=> '<strong>Ajout/modification des permissions d’administration d’un membre</strong><br>» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'	=> '<strong>Ajout/modification des permissions d’administration d’un groupe</strong><br>» %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'	=> '<strong>Ajout/modification des administrateurs</strong><br>» %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'		=> '<strong>Ajout/modification des modérateurs globaux</strong><br>» %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'		=> '<strong>Ajout/modification des permissions d’un membre aux forums</strong> %1$s<br>» %2$s',
	'LOG_ACL_ADD_USER_LOCAL_M_'		=> '<strong>Ajout/modification des permissions de modération des forums</strong> %1$s<br>» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'	=> '<strong>Ajout/modification des permissions d’un groupe aux forums</strong> %1$s<br>» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'	=> '<strong>Ajout/modification des permissions de modération des forums</strong> %1$s<br>» %2$s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'		=> '<strong>Ajout/modification des modérateurs de forums</strong> pour %1$s<br>» %2$s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'	=> '<strong>Ajout/modification des permissions de forums</strong> pour %1$s<br>» %2$s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'	=> '<strong>Suppression d’administrateurs</strong><br>» %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'		=> '<strong>Suppression de modérateurs globaux</strong><br>» %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'		=> '<strong>Suppression de modérateurs</strong> de %1$s<br>» %2$s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'	=> '<strong>Suppression des permissions au forum des groupes/utilisateurs</strong> de %1$s<br>» %2$s',

	'LOG_ACL_TRANSFER_PERMISSIONS'	=> '<strong>Transfert des permissions de</strong><br>» %s',
	'LOG_ACL_RESTORE_PERMISSIONS'	=> '<strong>Restauration de vos permissions après l’utilisation des permissions de</strong><br>» %s',

	'LOG_ADMIN_AUTH_FAIL'		=> '<strong>Échec de connexion à l’administration</strong>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<strong>Connexion réussie à l’administration</strong>',

	'LOG_ATTACHMENTS_DELETED'	=> '<strong>Suppression de fichiers joints d’un utilisateur</strong><br>» %s',

	'LOG_ATTACH_EXT_ADD'		=> '<strong>Ajout/modification d’extension de fichier joint</strong><br>» %s',
	'LOG_ATTACH_EXT_DEL'		=> '<strong>Suppression d’extension de fichier joint</strong><br>» %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<strong>Mise à jour d’extension de fichier joint</strong><br>» %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<strong>Ajout d’un groupe d’extensions de fichier joint</strong><br>» %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<strong>Modification d’un groupe d’extensions de fichier joint</strong><br>» %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<strong>Suppression d’un groupe d’extensions de fichier joint</strong><br>» %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<strong>Rattachement d’un fichier joint orphelin au message</strong><br>» ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<strong>Suppression des fichiers joints orphelins</strong><br>» %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<strong>Débannissement d’un membre</strong> pour la raison suivante : « <em>%1$s</em> »<br>» %2$s',
	'LOG_BAN_EXCLUDE_IP'	=> '<strong>Débannissement d’adresses IP</strong> pour la raison suivante : « <em>%1$s</em> »<br>» %2$s',
	'LOG_BAN_EXCLUDE_EMAIL'	=> '<strong>Débannissement d’adresses courriel</strong> pour la raison suivante : « <em>%1$s</em> »<br>» %2$s',
	'LOG_BAN_USER'			=> '<strong>Bannissement d’un membre</strong> pour la raison suivante : « <em>%1$s</em> »<br>» %2$s',
	'LOG_BAN_IP'			=> '<strong>Bannissement d’une adresse IP</strong> pour la raison suivante : « <em>%1$s</em> »<br>» %2$s',
	'LOG_BAN_EMAIL'			=> '<strong>Bannissement d’une adresse courriel</strong> pour la raison suivante : « <em>%1$s</em> »<br>» %2$s',
	'LOG_UNBAN_USER'		=> '<strong>Débannissement d’un membre</strong><br>» %s',
	'LOG_UNBAN_IP'			=> '<strong>Débannissement d’une adresse IP</strong><br>» %s',
	'LOG_UNBAN_EMAIL'		=> '<strong>Débannissement d’une adresse courriel</strong><br>» %s',

	'LOG_BBCODE_ADD'		=> '<strong>Ajout du nouveau BBCode</strong><br>» %s',
	'LOG_BBCODE_EDIT'		=> '<strong>Modification du BBCode</strong><br>» %s',
	'LOG_BBCODE_DELETE'		=> '<strong>Suppression du BBCode</strong><br>» %s',
	'LOG_BBCODE_CONFIGURATION_ERROR'	=> '<strong>Erreur rencontrée lors de la configuration d’un BBCode</strong> : %1$s<br>» %2$s',

	'LOG_BOT_ADDED'		=> '<strong>Ajout du nouveau robot</strong><br>» %s',
	'LOG_BOT_DELETE'	=> '<strong>Suppression du robot</strong><br>» %s',
	'LOG_BOT_UPDATED'	=> '<strong>Mise à jour du robot</strong><br>» %s',

	'LOG_CLEAR_ADMIN'		=> '<strong>Effacement d’entrées dans le journal d’administration</strong>',
	'LOG_CLEAR_CRITICAL'	=> '<strong>Effacement d’entrées dans le journal des erreurs</strong>',
	'LOG_CLEAR_MOD'			=> '<strong>Effacement d’entrées dans le journal de modération</strong>',
	'LOG_CLEAR_USER'		=> '<strong>Effacement de notes ou avertissements d’un membre</strong><br>» %s',
	'LOG_CLEAR_USERS'		=> '<strong>Effacement d’entrées dans le journal de l’utilisateur</strong>',

	'LOG_CONFIG_ATTACH'			=> '<strong>Les paramètres des fichiers joints ont été modifiés</strong>',
	'LOG_CONFIG_AUTH'			=> '<strong>Les paramètres d’authentification ont été modifiés</strong>',
	'LOG_CONFIG_AVATAR'			=> '<strong>Les paramètres d’avatar ont été modifiés</strong>',
	'LOG_CONFIG_COOKIE'			=> '<strong>Les paramètres de cookie ont été modifiés</strong>',
	'LOG_CONFIG_EMAIL'			=> '<strong>Les paramètres de courriels ont été modifiés</strong>',
	'LOG_CONFIG_FEATURES'		=> '<strong>Les options du forum ont été modifiées</strong>',
	'LOG_CONFIG_LOAD'			=> '<strong>Les paramètres de charge ont été modifiés</strong>',
	'LOG_CONFIG_MESSAGE'		=> '<strong>Les paramètres de la messagerie privée ont été modifiés</strong>',
	'LOG_CONFIG_POST'			=> '<strong>Les paramètres de messages ont été modifiés</strong>',
	'LOG_CONFIG_REGISTRATION'	=> '<strong>Les paramètres d’enregistrements ont été modifiés</strong>',
	'LOG_CONFIG_FEED'			=> '<strong>Les paramètres de flux ont été modifiés</strong>',
	'LOG_CONFIG_SEARCH'			=> '<strong>Les paramètres de recherche ont été modifiés</strong>',
	'LOG_CONFIG_SECURITY'		=> '<strong>Les paramètres de sécurité ont été modifiés</strong>',
	'LOG_CONFIG_SERVER'			=> '<strong>Les paramètres du serveur ont été modifiés</strong>',
	'LOG_CONFIG_SETTINGS'		=> '<strong>La configuration générale du forum a été modifiée</strong>',
	'LOG_CONFIG_SIGNATURE'		=> '<strong>Les paramètres de signature ont été modifiés</strong>',
	'LOG_CONFIG_VISUAL'			=> '<strong>Les paramètres de la confirmation visuelle ont été modifiés</strong>',

	'LOG_APPROVE_TOPIC'			=> '<strong>Approbation du sujet</strong><br>» %s',
	'LOG_BUMP_TOPIC'			=> '<strong>Sujet remonté par un utilisateur</strong><br>» %s',
	'LOG_DELETE_POST'			=> '<strong>Suppression du message « %1$s » écrit par « %2$s » pour la raison suivante</strong><br>» %3$s',
	'LOG_DELETE_SHADOW_TOPIC'	=> '<strong>Suppression du sujet-traceur</strong><br>» %s',
	'LOG_DELETE_TOPIC'			=> '<strong>Suppression du sujet « %1$s » écrit par « %2$s » pour la raison suivante</strong><br>» %3$s',
	'LOG_FORK'					=> '<strong>Copie d’un sujet</strong><br>» depuis %s',
	'LOG_LOCK'					=> '<strong>Verrouillage du sujet</strong><br>» %s',
	'LOG_LOCK_POST'				=> '<strong>Verrouillage du message</strong><br>» %s',
	'LOG_MERGE'					=> '<strong>Fusion de messages</strong> dans le sujet <br>» %s',
	'LOG_MOVE'					=> '<strong>Déplacement d’un sujet</strong><br>» depuis %1$s vers %2$s',
	'LOG_MOVED_TOPIC'			=> '<strong>Déplacement du sujet</strong><br>» %s',
	'LOG_PM_REPORT_CLOSED'		=> '<strong>Clôture du rapport de message privé</strong><br>» %s',
	'LOG_PM_REPORT_DELETED'		=> '<strong>Suppression du rapport de message privé</strong><br>» %s',
	'LOG_POST_APPROVED'			=> '<strong>Approbation du message</strong><br>» %s',
	'LOG_POST_DISAPPROVED'		=> '<strong>Désapprobation du message « %1$s » créé par « %3$s » pour la raison suivante</strong><br>» %2$s',
	'LOG_POST_EDITED'			=> '<strong>Modification du message « %1$s » écrit par « %2$s » pour la raison suivante</strong><br>» %3$s',
	'LOG_POST_RESTORED'			=> '<strong>Restauration du message</strong><br>» %s',
	'LOG_REPORT_CLOSED'			=> '<strong>Clôture du rapport/raison</strong><br>» %s',
	'LOG_REPORT_DELETED'		=> '<strong>Suppression du rapport/raison</strong><br>» %s',
	'LOG_RESTORE_TOPIC'			=> '<strong>Restauration du sujet « %1$s » écrit par</strong><br>» %2$s',
	'LOG_SOFTDELETE_POST'		=> '<strong>Suppression du message « %1$s » écrit par « %2$s » pour la raison suivante</strong><br>» %3$s',
	'LOG_SOFTDELETE_TOPIC'		=> '<strong>Suppression du sujet « %1$s » écrit par « %2$s » pour la raison suivante</strong><br>» %3$s',
	'LOG_SPLIT_DESTINATION'		=> '<strong>Déplacement de messages divisés</strong><br>» vers %s',
	'LOG_SPLIT_SOURCE'			=> '<strong>Division de messages</strong><br>» depuis %s',

	'LOG_TOPIC_APPROVED'		=> '<strong>Approbation du sujet</strong><br>» %s',
	'LOG_TOPIC_RESTORED'		=> '<strong>Restauration du sujet</strong><br>» %s',
	'LOG_TOPIC_DISAPPROVED'		=> '<strong>Désapprobation du sujet « %1$s » créé par « %3$s » pour la raison suivante</strong><br>» %2$s',
	'LOG_TOPIC_RESYNC'			=> '<strong>Resynchronisation des compteurs de sujets</strong><br>» %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<strong>Modification du type de sujet</strong><br>» %s',
	'LOG_UNLOCK'				=> '<strong>Déverrouillage du sujet</strong><br>» %s',
	'LOG_UNLOCK_POST'			=> '<strong>Déverrouillage du message</strong><br>» %s',

	'LOG_DISALLOW_ADD'		=> '<strong>Ajout du nom d’utilisateur interdit</strong><br>» %s',
	'LOG_DISALLOW_DELETE'	=> '<strong>Suppression d’un nom d’utilisateur interdit</strong>',

	'LOG_DB_BACKUP'			=> '<strong>Sauvegarde de la base de données</strong>',
	'LOG_DB_DELETE'			=> '<strong>Suppression d’une sauvegarde de la base de données</strong>',
	'LOG_DB_RESTORE'		=> '<strong>Restauration d’une base de données</strong>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<strong>Exclusion de l’adresse IP ou du nom d’hôte de la liste des téléchargements</strong><br>» %s',
	'LOG_DOWNLOAD_IP'			=> '<strong>Ajout de l’adresse IP ou du nom d’hôte à la liste des téléchargements</strong><br>» %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<strong>Suppression de l’adresse IP ou du nom d’hôte de la liste des téléchargements</strong><br>» %s',

	'LOG_ERROR_JABBER'		=> '<strong>Erreur de compte Jabber</strong><br>» %s',
	'LOG_ERROR_EMAIL'		=> '<strong>Erreur de courriel</strong><br>» %s',
	'LOG_ERROR_CAPTCHA'		=> '<strong>Erreur CAPTCHA</strong><br>» %s',

	'LOG_FORUM_ADD'							=> '<strong>Création du nouveau forum</strong><br>» %s',
	'LOG_FORUM_COPIED_PERMISSIONS'			=> '<strong>Copie des permissions de forum</strong> depuis %1$s<br>» %2$s',
	'LOG_FORUM_DEL_FORUM'					=> '<strong>Suppression du forum</strong><br>» %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<strong>Suppression du forum et de ses sous-forums</strong><br>» %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<strong>Suppression du forum</strong> %2$s <strong>et déplacement des sous-forums vers</strong> %1$s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<strong>Suppression du forum</strong> %2$s <strong>et déplacement des messages vers</strong> %1$s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS'		=> '<strong>Suppression du forum</strong> %2$s <strong>et de ses sous-forums. Déplacement des messages vers</strong> %1$s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<strong>Suppression du forum</strong> %3$s <strong>, déplacement des messages vers</strong> %1$s <strong>et de ses sous-forums vers</strong> %2$s',
	'LOG_FORUM_DEL_POSTS'					=> '<strong>Suppression du forum et de ses messages</strong><br>» %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<strong>Suppression du forum, de ses messages et de ses sous-forums</strong><br>» %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS'		=> '<strong>Suppression du forum</strong> %2$s <strong> et de ses messages. Déplacement des sous-forums vers</strong> %1$s',
	'LOG_FORUM_EDIT'						=> '<strong>Modification des détails du forum</strong><br>» %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<strong>Déplacement du forum</strong> %1$s <strong>au-dessous de</strong> %2$s',
	'LOG_FORUM_MOVE_UP'						=> '<strong>Déplacement du forum</strong> %1$s <strong>au-dessus de</strong> %2$s',
	'LOG_FORUM_SYNC'						=> '<strong>Resynchronisation du forum</strong><br>» %s',

	'LOG_GENERAL_ERROR'	=> '<strong>Une erreur générale a été rencontrée</strong> : %1$s <br>» %2$s',

	'LOG_GROUP_CREATED'		=> '<strong>Création du nouveau groupe</strong><br>» %s',
	'LOG_GROUP_DEFAULTS'	=> '<strong>Groupe « %1$s » défini par défaut pour les membres</strong><br>» %2$s',
	'LOG_GROUP_DELETE'		=> '<strong>Suppression du groupe</strong><br>» %s',
	'LOG_GROUP_DEMOTED'		=> '<strong>Rétrogradation de chef(s) dans le groupe</strong> %1$s<br>» %2$s',
	'LOG_GROUP_PROMOTED'	=> '<strong>Promotion de membre(s) en chef dans le groupe</strong> %1$s<br>» %2$s',
	'LOG_GROUP_REMOVE'		=> '<strong>Suppression de membre(s) du groupe</strong> %1$s<br>» %2$s',
	'LOG_GROUP_UPDATED'		=> '<strong>Mise à jour des informations du groupe</strong><br>» %s',
	'LOG_MODS_ADDED'		=> '<strong>Ajout de nouveaux chefs dans le groupe</strong> %1$s<br>» %2$s',
	'LOG_USERS_ADDED'		=> '<strong>Ajout de nouveaux membres au groupe</strong> %1$s<br>» %2$s',
	'LOG_USERS_APPROVED'	=> '<strong>Membres approuvés dans le groupe</strong> %1$s<br>» %2$s',
	'LOG_USERS_PENDING'		=> '<strong>Demande d’un membre nécessitant une approbation pour rejoindre le groupe</strong> %1$s<br>» %2$s',

	'LOG_IMAGE_GENERATION_ERROR'	=> '<strong>Erreur pendant la création de l’image</strong><br>» Erreur dans %1$s à la ligne %2$s : %3$s',

	'LOG_INACTIVE_ACTIVATE'	=> '<strong>Activation de membres inactifs</strong><br>» %s',
	'LOG_INACTIVE_DELETE'	=> '<strong>Suppression de membres inactifs</strong><br>» %s',
	'LOG_INACTIVE_REMIND'	=> '<strong>Envoi d’un rappel par courriel aux membres inactifs</strong><br>» %s',
	'LOG_INSTALL_CONVERTED'	=> '<strong>Conversion depuis %1$s vers phpBB %2$s</strong>',
	'LOG_INSTALL_INSTALLED'	=> '<strong>Installation de phpBB %s</strong>',

	'LOG_IP_BROWSER_FORWARDED_CHECK'	=> '<strong>La vérification de la session IP/navigateur/X_FORWARDED_FOR a échoué</strong><br>» L’adresse IP de l’utilisateur « <em>%1$s</em> » a été comparée avec la session IP « <em>%2$s</em> », la chaîne du navigateur de l’utilisateur « <em>%3$s</em> » a été comparée avec la chaîne de la session « <em>%4$s</em> » du navigateur et la chaîne X_FORWARDED_FOR de l’utilisateur « <em>%5$s</em> » a été comparée avec la chaîne X_FORWARDED_FOR de la session « <em>%6$s</em> ».',

	'LOG_JAB_CHANGED'			=> '<strong>Modification d’un compte Jabber</strong>',
	'LOG_JAB_PASSCHG'			=> '<strong>Modification de mot de passe du compte Jabber</strong>',
	'LOG_JAB_REGISTER'			=> '<strong>Enregistrement d’un compte Jabber</strong>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<strong>Modification des paramètres du compte Jabber</strong>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<strong>Suppression du pack de langue</strong><br>» %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<strong>Installation du pack de langue</strong><br>» %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<strong>Mise à jour des informations du pack de langue</strong><br>» %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<strong>Remplacement du fichier de langue</strong><br>» %s',
	'LOG_LANGUAGE_FILE_SUBMITTED'	=> '<strong>Envoi et stockage du fichier de langue</strong><br>» %s',

	'LOG_MASS_EMAIL'		=> '<strong>Envoi du courriel de masse</strong><br>» %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<strong>Modification de l’auteur du sujet « %1$s »</strong><br>» de %2$s en %3$s',

	'LOG_MODULE_DISABLE'	=> '<strong>Désactivation du module</strong><br>» %s',
	'LOG_MODULE_ENABLE'		=> '<strong>Activation du module</strong><br>» %s',
	'LOG_MODULE_MOVE_DOWN'	=> '<strong>Déplacement du module</strong><br>» %1$s au-dessous de %2$s',
	'LOG_MODULE_MOVE_UP'	=> '<strong>Déplacement du module</strong><br>» %1$s au-dessus de %2$s',
	'LOG_MODULE_REMOVED'	=> '<strong>Suppression du module</strong><br>» %s',
	'LOG_MODULE_ADD'		=> '<strong>Ajout du module</strong><br>» %s',
	'LOG_MODULE_EDIT'		=> '<strong>Modification du module</strong><br>» %s',

	'LOG_A_ROLE_ADD'		=> '<strong>Ajout du modèle d’administration</strong><br>» %s',
	'LOG_A_ROLE_EDIT'		=> '<strong>Modification du modèle d’administration</strong><br>» %s',
	'LOG_A_ROLE_REMOVED'	=> '<strong>Suppression du modèle d’administration</strong><br>» %s',
	'LOG_F_ROLE_ADD'		=> '<strong>Ajout du modèle de forum</strong><br>» %s',
	'LOG_F_ROLE_EDIT'		=> '<strong>Modification du modèle de forum</strong><br>» %s',
	'LOG_F_ROLE_REMOVED'	=> '<strong>Suppression du modèle de forum</strong><br>» %s',
	'LOG_M_ROLE_ADD'		=> '<strong>Ajout du modèle de modération</strong><br>» %s',
	'LOG_M_ROLE_EDIT'		=> '<strong>Modification du modèle de modération</strong><br>» %s',
	'LOG_M_ROLE_REMOVED'	=> '<strong>Suppression du modèle de modération</strong><br>» %s',
	'LOG_U_ROLE_ADD'		=> '<strong>Ajout du modèle d’utilisateur</strong><br>» %s',
	'LOG_U_ROLE_EDIT'		=> '<strong>Modification du modèle d’utilisateur</strong><br>» %s',
	'LOG_U_ROLE_REMOVED'	=> '<strong>Suppression du modèle d’utilisateur</strong><br>» %s',

	'LOG_PLUPLOAD_TIDY_FAILED'		=> '<strong>Impossible d’ouvrir le fichier %1$s pour classement, vérifiez vos permissions.</strong><br>Exception : %2$s<br>Trace : %3$s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<strong>Activation du champ de profil</strong><br>» %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<strong>Ajout du champ de profil</strong><br>» %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<strong>Désactivation du champ de profil</strong><br>» %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<strong>Modification du champ de profil</strong><br>» %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<strong>Suppression du champ de profil</strong><br>» %s',

	'LOG_PRUNE'					=> '<strong>Délestage du forum</strong><br>» %s',
	'LOG_AUTO_PRUNE'			=> '<strong>Auto-délestage du forum</strong><br>» %s',
	'LOG_PRUNE_SHADOW'			=> '<strong>Auto-délestage des sujets-traceurs</strong><br>» %s',
	'LOG_PRUNE_USER_DEAC'		=> '<strong>Désactivation de membres</strong><br>» %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<strong>Délestage de membres et suppression de leurs messages</strong><br>» %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<strong>Délestage de membres et conservation de leurs messages</strong><br>» %s',

	'LOG_PURGE_CACHE'			=> '<strong>Purge du cache</strong>',
	'LOG_PURGE_SESSIONS'		=> '<strong>Purge des sessions</strong>',

	'LOG_RANK_ADDED'		=> '<strong>Ajout du nouveau rang</strong><br>» %s',
	'LOG_RANK_REMOVED'		=> '<strong>Suppression du rang</strong><br>» %s',
	'LOG_RANK_UPDATED'		=> '<strong>Mise à jour du rang</strong><br>» %s',

	'LOG_REASON_ADDED'		=> '<strong>Ajout du rapport/raison</strong><br>» %s',
	'LOG_REASON_REMOVED'	=> '<strong>Suppression du rapport/raison</strong><br>» %s',
	'LOG_REASON_UPDATED'	=> '<strong>Mise à jour du rapport/raison</strong><br>» %s',

	'LOG_REFERER_INVALID'		=> '<strong>Échec de la validation du référent</strong><br>» Le référent était « <em>%1$s</em> ». La demande a été rejetée et la session terminée.',
	'LOG_RESET_DATE'			=> '<strong>Réinitialisation de la date d’ouverture du forum</strong>',
	'LOG_RESET_ONLINE'			=> '<strong>Réinitialisation du record des utilisateurs connectés</strong>',
	'LOG_RESYNC_FILES_STATS'	=> '<strong>Actualisation des statistiques des fichiers joints</strong>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<strong>Resynchronisation des compteurs de messages d’utilisateur</strong>',
	'LOG_RESYNC_POST_MARKING'	=> '<strong>Resynchronisation des sujets pointés</strong>',
	'LOG_RESYNC_STATS'			=> '<strong>Actualisation des statistiques des messages, sujets et utilisateurs</strong>',

	'LOG_SEARCH_INDEX_CREATED'	=> '<strong>Création de l’index de recherche pour</strong><br>» %s',
	'LOG_SEARCH_INDEX_REMOVED'	=> '<strong>Suppression de l’index de recherche pour</strong><br>» %s',
	'LOG_SPHINX_ERROR'			=> '<strong>Erreur Sphinx</strong><br>» %s',

	'LOG_SPAMHAUS_OPEN_RESOLVER'		=> 'Spamhaus n’autorise pas les requêtes passant par un résolveur public/ouvert. La fonction de vérification de la liste noire a été désactivée. Pour plus d’informations, consultez https://www.spamhaus.com/product/help-for-spamhaus-public-mirror-users/.',
	'LOG_SPAMHAUS_VOLUME_LIMIT'			=> 'Le volume de requête autorisé par Spamhaus a été atteint. La fonction de vérification de la liste noire a été désactivée. Pour plus d’informations, consultez https://www.spamhaus.com/product/help-for-spamhaus-public-mirror-users/.',

	'LOG_STYLE_ADD'				=> '<strong>Ajout du style</strong><br>» %s',
	'LOG_STYLE_DELETE'			=> '<strong>Suppression du style</strong><br>» %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<strong>Modification des informations du style</strong><br>» %s',
	'LOG_STYLE_EXPORT'			=> '<strong>Exportation du style</strong><br>» %s',

	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_DB'			=> '<strong>Ajout du pack de template à la base de données</strong><br>» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_ADD_FS'			=> '<strong>Ajout du pack de template au système de fichiers</strong><br>» %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<strong>Suppression du cache des fichiers du template <em>%1$s</em></strong><br>» %2$s',
	'LOG_TEMPLATE_DELETE'			=> '<strong>Suppression du pack de template</strong><br>» %s',
	'LOG_TEMPLATE_EDIT'				=> '<strong>Modification du pack de template <em>%1$s</em></strong><br>» %2$s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<strong>Modification des informations du pack de template</strong><br>» %s',
	'LOG_TEMPLATE_EXPORT'			=> '<strong>Exportation du pack de template</strong><br>» %s',
	// @deprecated 3.1
	'LOG_TEMPLATE_REFRESHED'		=> '<strong>Rafraîchissement du pack de template</strong><br>» %s',

	// @deprecated 3.1
	'LOG_THEME_ADD_DB'			=> '<strong>Ajout du nouveau thème à la base de données</strong><br>» %s',
	// @deprecated 3.1
	'LOG_THEME_ADD_FS'			=> '<strong>Ajout du nouveau thème au système de fichiers</strong><br>» %s',
	'LOG_THEME_DELETE'			=> '<strong>Suppression du thème</strong><br>» %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<strong>Modification des informations du thème</strong><br>» %s',
	'LOG_THEME_EDIT'			=> '<strong>Modification du thème <em>%1$s</em></strong>',
	'LOG_THEME_EDIT_FILE'		=> '<strong>Modification du thème <em>%1$s</em></strong><br>» Modification du fichier <em>%2$s</em>',
	'LOG_THEME_EXPORT'			=> '<strong>Exportation du thème</strong><br>» %s',
	// @deprecated 3.1
	'LOG_THEME_REFRESHED'		=> '<strong>Rafraîchissement du thème</strong><br>» %s',

	'LOG_UPDATE_DATABASE'	=> '<strong>Mise à jour de la base de données de la version %1$s à la version %2$s</strong>',
	'LOG_UPDATE_PHPBB'		=> '<strong>Mise à jour de phpBB de la version %1$s à la version %2$s</strong>',

	'LOG_USER_ACTIVE'		=> '<strong>Activation du membre</strong><br>» %s',
	'LOG_USER_BAN_USER'		=> '<strong>Bannissement d’utilisateurs via la gestion d’utilisateurs</strong> pour la raison « <em>%1$s</em> »<br>» %2$s',
	'LOG_USER_BAN_IP'		=> '<strong>Bannissement d’adresses IP via la gestion d’utilisateurs</strong> pour la raison « <em>%1$s</em> »<br>» %2$s',
	'LOG_USER_BAN_EMAIL'	=> '<strong>Bannissement d’adresses courriel via la gestion d’utilisateurs</strong> pour la raison « <em>%1$s</em> »<br>» %2$s',
	'LOG_USER_DELETED'		=> '<strong>Suppression du membre</strong><br>» %s',
	'LOG_USER_DEL_ATTACH'	=> '<strong>Suppression de tous les fichiers joints du membre</strong><br>» %s',
	'LOG_USER_DEL_AVATAR'	=> '<strong>Suppression de l’avatar du membre</strong><br>» %s',
	'LOG_USER_DEL_OUTBOX'	=> '<strong>Vidage de la boîte d’envoi du membre</strong><br>» %s',
	'LOG_USER_DEL_POSTS'	=> '<strong>Suppression des messages du membre</strong><br>» %s',
	'LOG_USER_DEL_SIG'		=> '<strong>Suppression de la signature du membre</strong><br>» %s',
	'LOG_USER_INACTIVE'		=> '<strong>Désactivation du membre</strong><br>» %s',
	'LOG_USER_MOVE_POSTS'	=> '<strong>Déplacement des messages de </strong><br>» « %1$s » vers le forum « %2$s »',
	'LOG_USER_NEW_PASSWORD'	=> '<strong>Modification du mot de passe du membre</strong><br>» %s',
	'LOG_USER_REACTIVATE'	=> '<strong>Réactivation forcée du compte du membre</strong><br>» %s',
	'LOG_USER_REMOVED_NR'	=> '<strong>Suppression du statut « nouvel utilisateur enregistré » du membre</strong><br>» %s',

	'LOG_USER_UPDATE_EMAIL'	=> '<strong>Modification de l’adresse courriel du membre « %1$s » </strong><br>» de « %2$s » à « %3$s »',
	'LOG_USER_UPDATE_NAME'	=> '<strong>Modification du nom d’utilisateur</strong><br>» de « %1$s » à « %2$s »',
	'LOG_USER_USER_UPDATE'	=> '<strong>Mise à jour des informations du membre</strong><br>» %s',

	'LOG_USER_ACTIVE_USER'		=> '<strong>Activation du compte d’un membre</strong>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<strong>Suppression d’un avatar</strong>',
	'LOG_USER_DEL_SIG_USER'		=> '<strong>Suppression d’une signature</strong>',
	'LOG_USER_FEEDBACK'			=> '<strong>Ajout d’une fiche de suivi pour le membre</strong><br>» %s',
	'LOG_USER_GENERAL'			=> '<strong>Ajout d’une entrée :</strong><br>» %s',
	'LOG_USER_INACTIVE_USER'	=> '<strong>Désactivation du compte d’un membre</strong>',
	'LOG_USER_LOCK'				=> '<strong>Verrouillage du sujet par son auteur</strong><br>» %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<strong>Déplacement de tous les messages vers le forum</strong> « %s »',
	'LOG_USER_REACTIVATE_USER'	=> '<strong>Réactivation forcée du compte d’un membre</strong>',
	'LOG_USER_UNLOCK'			=> '<strong>Déverrouillage du sujet par son auteur</strong><br>» %s',
	'LOG_USER_WARNING'			=> '<strong>Ajout d’un avertissement au membre</strong><br>» %s',
	'LOG_USER_WARNING_BODY'		=> '<strong>Un avertissement a été donné au membre</strong><br>» %s',

	'LOG_USER_GROUP_CHANGE'			=> '<strong>Modification du groupe par défaut du membre</strong><br>» %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<strong>Rétrogradation d’un chef du groupe d’utilisateurs</strong><br>» %s',
	'LOG_USER_GROUP_JOIN'			=> '<strong>Adhésion à un groupe du membre</strong><br>» %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<strong>Adhésion à un groupe du membre et demande d’approbation</strong><br>» %s',
	'LOG_USER_GROUP_RESIGN'			=> '<strong>Annulation de l’adhésion au groupe du membre</strong><br>» %s',

	'LOG_WARNING_DELETED'		=> '<strong>Suppression de l’avertissement donné au membre</strong><br>» %s',
	'LOG_WARNINGS_DELETED'		=> array(
		1 => '<strong>Suppression de l’avertissement donné au membre</strong><br>» %1$s',
		2 => '<strong>Suppression de %2$d avertissements donnés au membre</strong><br>» %1$s', // Example: '<strong>Deleted 2 user warnings</strong><br>» username'
	),
	'LOG_WARNINGS_DELETED_ALL'	=> '<strong>Suppression de tous les avertissements donnés au membre</strong><br>» %s',

	'LOG_WORD_ADD'			=> '<strong>Ajout du mot censuré</strong><br>» %s',
	'LOG_WORD_DELETE'		=> '<strong>Suppression du mot censuré</strong><br>» %s',
	'LOG_WORD_EDIT'			=> '<strong>Modification du mot censuré</strong><br>» %s',

	'LOG_EXT_ENABLE'	=> '<strong>Activation de l’extension</strong><br>» %s',
	'LOG_EXT_DISABLE'	=> '<strong>Désactivation de l’extension</strong><br>» %s',
	'LOG_EXT_PURGE'		=> '<strong>Suppression des données de l’extension</strong><br>» %s',
	'LOG_EXT_UPDATE'	=> '<strong>Mise à jour de l’extension</strong><br>» %s',
));
