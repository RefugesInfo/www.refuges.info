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

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
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

$lang = array_merge($lang, array(
	'CLI_APCU_CACHE_NOTICE'				=> 'Le cache APCu a été purgé depuis le panneau d’administration.',

	'CLI_CONFIG_CANNOT_CACHED'			=> 'Utilisez cette option si l’option de configuration change trop souvent pour être efficacement mise en cache',
	'CLI_CONFIG_CURRENT'				=> 'Valeur actuelle de la configuration. Utilisez 0 ou 1 pour spécifier des valeurs booléennes',
	'CLI_CONFIG_DELETE_SUCCESS'			=> 'La configuration « %s » a été supprimée',
	'CLI_CONFIG_NEW'					=> 'Nouvelle valeur de la configuration. Utilisez 0 ou 1 pour spécifier des valeurs booléennes',
	'CLI_CONFIG_NOT_EXISTS'				=> 'La configuration « %s » n’existe pas',
	'CLI_CONFIG_OPTION_NAME'			=> 'Le nom de l’option de configuration',
	'CLI_CONFIG_PRINT_WITHOUT_NEWLINE'	=> 'Utilisez cette option si la valeur doit être affichée à l’écran sans effectuer de retour à la ligne',
	'CLI_CONFIG_INCREMENT_BY'			=> 'Valeur de l’incrément',
	'CLI_CONFIG_INCREMENT_SUCCESS'		=> 'La valeur de la configuration « %s » a été incrémentée',
	'CLI_CONFIG_SET_FAILURE'			=> 'Impossible de paramétrer la configuration « %s »',
	'CLI_CONFIG_SET_SUCCESS'			=> 'La configuration « %s » a été paramétrée',

	'CLI_DESCRIPTION_CRON_LIST'					=> 'Afficher à l’écran la liste de tâches cron prêtes et non prêtes',
	'CLI_DESCRIPTION_CRON_RUN'					=> 'Exécuter toutes les tâches cron prêtes',
	'CLI_DESCRIPTION_CRON_RUN_ARGUMENT_1'		=> 'Nom de la tâche à exécuter',
	'CLI_DESCRIPTION_DB_LIST'					=> 'Lister toutes les migrations installées et disponibles',
	'CLI_DESCRIPTION_DB_MIGRATE'				=> 'Mettre à jour la base de données en appliquant les migrations',
	'CLI_DESCRIPTION_DB_REVERT'					=> 'Revenir à une migration',
	'CLI_DESCRIPTION_DELETE_CONFIG'				=> 'Supprimer une option de configuration',
	'CLI_DESCRIPTION_DISABLE_EXTENSION'			=> 'Désactiver l’extension spécifiée',
	'CLI_DESCRIPTION_ENABLE_EXTENSION'			=> 'Activer l’extension spécifiée',
	'CLI_DESCRIPTION_FIND_MIGRATIONS'			=> 'Trouver les migrations qui ne sont pas dépendantes',
	'CLI_DESCRIPTION_FIX_LEFT_RIGHT_IDS'		=> 'Réparer l’arborescence des forums et des modules',
	'CLI_DESCRIPTION_GET_CONFIG'				=> 'Obtenir la valeur d’une option de configuration',
	'CLI_DESCRIPTION_INCREMENT_CONFIG'			=> 'Incrémenter la valeur d’une option de configuration',
	'CLI_DESCRIPTION_LIST_EXTENSIONS'			=> 'Lister toutes les extensions présentes dans la base de données et le système de fichiers',

	'CLI_DESCRIPTION_OPTION_ENV'				=> 'Le nom de l’environnement',
	'CLI_DESCRIPTION_OPTION_SAFE_MODE'			=> 'Exécuter en mode sans échec (sans les extensions)',
	'CLI_DESCRIPTION_OPTION_SHELL'				=> 'Lancer la console',

	'CLI_DESCRIPTION_PURGE_EXTENSION'			=> 'Désactiver et supprimer les données de l’extension spécifiée',

	'CLI_DESCRIPTION_REPARSER_LIST'						=> 'Lister les types de textes qui peuvent être réanalysés',
	'CLI_DESCRIPTION_REPARSER_AVAILABLE'				=> 'Analyseurs disponibles :',
	'CLI_DESCRIPTION_REPARSER_REPARSE'					=> 'Analyser les contenus stockés avec les services « text_formatter » actuels',
	'CLI_DESCRIPTION_REPARSER_REPARSE_ARG_1'			=> 'Type de texte à analyser. Laisser vide pour tout analyser',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_DRY_RUN'		=> 'Ne pas enregistrer les modifications ; seulement afficher ce qui se passerait',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MIN'	=> 'Plus petit ID d’enregistrement à traiter',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MAX'	=> 'Plus grand ID d’enregistrement à traiter',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_SIZE'	=> 'Nombre approximatif d’enregistrements à traiter à la fois',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RESUME'		=> 'Redémarrer l’analyse où la dernière exécution a été arrêtée',

	'CLI_DESCRIPTION_SET_ATOMIC_CONFIG'					=> 'Définir la valeur d’une option de configuration seulement si l’ancienne correspond à la valeur actuelle',
	'CLI_DESCRIPTION_SET_CONFIG'						=> 'Définir la valeur d’une option de configuration',

	'CLI_DESCRIPTION_THUMBNAIL_DELETE'					=> 'Supprimer toutes les vignettes existantes',
	'CLI_DESCRIPTION_THUMBNAIL_GENERATE'				=> 'Générer toutes les vignettes manquantes',
	'CLI_DESCRIPTION_THUMBNAIL_RECREATE'				=> 'Recréer toutes les vignettes',

	'CLI_DESCRIPTION_UPDATE_CHECK'					=> 'Vérifier si le forum est à jour',
	'CLI_DESCRIPTION_UPDATE_CHECK_ARGUMENT_1'		=> 'Nom de l’extension à vérifier (si <info>all</info>, toutes les extensions seront vérifiées)',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_CACHE'		=> 'Exécuter la commande en utilisant le cache',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_STABILITY'	=> 'Exécuter la commande permettant de contrôler seulement les versions stables ou non stables',

	'CLI_DESCRIPTION_UPDATE_HASH_BCRYPT'		=> 'Mettre à jour le hachage obsolète des mots de passe avec le hachage bcrypt',

	'CLI_ERROR_INVALID_STABILITY' => '« %s » doit être paramétré sur « stable » ou « unstable »',

	'CLI_DESCRIPTION_USER_ACTIVATE'				=> 'Activer (ou désactiver) le compte d’un membre',
	'CLI_DESCRIPTION_USER_ACTIVATE_USERNAME'	=> 'Nom d’utilisateur du compte à activer',
	'CLI_DESCRIPTION_USER_ACTIVATE_DEACTIVATE'	=> 'Désactiver le compte du membre',
	'CLI_DESCRIPTION_USER_ACTIVATE_ACTIVE'		=> 'Le compte du membre est déjà activé',
	'CLI_DESCRIPTION_USER_ACTIVATE_INACTIVE'	=> 'Le compte du membre est déjà désactivé',
	'CLI_DESCRIPTION_USER_ADD'					=> 'Ajouter un nouveau membre',
	'CLI_DESCRIPTION_USER_ADD_OPTION_USERNAME'	=> 'Nom d’utilisateur du nouveau membre',
	'CLI_DESCRIPTION_USER_ADD_OPTION_PASSWORD'	=> 'Mot de passe du nouveau membre',
	'CLI_DESCRIPTION_USER_ADD_OPTION_EMAIL'		=> 'Adresse courriel du nouveau membre',
	'CLI_DESCRIPTION_USER_ADD_OPTION_NOTIFY'	=> 'Envoyer un courriel d’activation du compte au nouveau membre (non envoyé par défaut)',
	'CLI_DESCRIPTION_USER_DELETE'				=> 'Supprimer le compte d’un membre',
	'CLI_DESCRIPTION_USER_DELETE_USERNAME'		=> 'Nom d’utilisateur du membre à supprimer',
	'CLI_DESCRIPTION_USER_DELETE_OPTION_POSTS'	=> 'Supprimer tous les messages du membre. Si cette option n’est pas utilisée, les messages du membre seront conservés',
	'CLI_DESCRIPTION_USER_RECLEAN'				=> 'Nettoyer les noms d’utilisateurs',

	'CLI_EXTENSION_DISABLE_FAILURE'		=> 'Impossible de désactiver l’extension « %s »',
	'CLI_EXTENSION_DISABLE_SUCCESS'		=> 'L’extension « %s » a été désactivée',
	'CLI_EXTENSION_DISABLED'			=> 'L’extension « %s » n’est pas activée',
	'CLI_EXTENSION_ENABLE_FAILURE'		=> 'Impossible d’activer l’extension « %s »',
	'CLI_EXTENSION_ENABLE_SUCCESS'		=> 'L’extension « %s » a été activée',
	'CLI_EXTENSION_ENABLED'				=> 'L’extension « %s » est déjà activée',
	'CLI_EXTENSION_NOT_EXIST'			=> 'L’extension « %s » n’existe pas',
	'CLI_EXTENSION_NAME'				=> 'Nom de l’extension',
	'CLI_EXTENSION_PURGE_FAILURE'		=> 'Impossible de désactiver et de supprimer les données de l’extension « %s »',
	'CLI_EXTENSION_PURGE_SUCCESS'		=> 'L’extension « %s » a été désactivée et ses données ont été supprimées',
	'CLI_EXTENSION_UPDATE_FAILURE'		=> 'Impossible de mettre à jour l’extension « %s »',
	'CLI_EXTENSION_UPDATE_SUCCESS'		=> 'L’extension « %s » a été mise à jour',
	'CLI_EXTENSION_NOT_FOUND'			=> 'Aucune extension n’a été trouvée',
	'CLI_EXTENSION_NOT_ENABLEABLE'		=> 'L’extension « %s » ne peut pas être activée.',
	'CLI_EXTENSIONS_AVAILABLE'			=> 'Disponibles',
	'CLI_EXTENSIONS_DISABLED'			=> 'Désactivées',
	'CLI_EXTENSIONS_ENABLED'			=> 'Activées',

	'CLI_FIXUP_FIX_LEFT_RIGHT_IDS_SUCCESS'		=> 'L’arborescence des forums et des modules a été réparée',
	'CLI_FIXUP_UPDATE_HASH_BCRYPT_SUCCESS'		=> 'Tous les hachages obsolètes des mots de passe ont été mis à jour vers le hachage bcrypt',

	'CLI_MIGRATION_NAME'					=> 'Nom de la migration, espace de nom inclus (utilisez des barres obliques au lieu de barres obliques inversées afin d’éviter tout problème)',
	'CLI_MIGRATIONS_AVAILABLE'				=> 'Migrations disponibles',
	'CLI_MIGRATIONS_INSTALLED'				=> 'Migrations installées',
	'CLI_MIGRATIONS_ONLY_AVAILABLE'			=> 'N’afficher que les migrations disponibles',
	'CLI_MIGRATIONS_EMPTY'					=> 'Aucune migration',

	'CLI_REPARSER_REPARSE_REPARSING'		=> 'Réanalyse de %1$s (ligne %2$d…%3$d)',
	'CLI_REPARSER_REPARSE_REPARSING_START'	=> 'Réanalyse de %s…',
	'CLI_REPARSER_REPARSE_SUCCESS'			=> 'Réanalyse terminée',

	// In all the case %1$s is the logical name of the file and %2$s the real name on the filesystem
	// eg: big_image.png (2_a51529ae7932008cf8454a95af84cacd) generated.
	'CLI_THUMBNAIL_DELETED'		=> '%1$s (%2$s) supprimée.',
	'CLI_THUMBNAIL_DELETING'	=> 'Suppression des vignettes',
	'CLI_THUMBNAIL_SKIPPED'		=> '%1$s (%2$s) ignorée',
	'CLI_THUMBNAIL_GENERATED'	=> '%1$s (%2$s) générée',
	'CLI_THUMBNAIL_GENERATING'	=> 'Génération des vignettes',
	'CLI_THUMBNAIL_GENERATING_DONE'	=> 'Toutes les vignettes ont été régénérées',
	'CLI_THUMBNAIL_DELETING_DONE'	=> 'Toutes les vignettes ont été supprimées',

	'CLI_THUMBNAIL_NOTHING_TO_GENERATE'	=> 'Aucune vignette à générer',
	'CLI_THUMBNAIL_NOTHING_TO_DELETE'	=> 'Aucune vignette à supprimer',

	'CLI_USER_ADD_SUCCESS'		=> 'Le membre « %s » a été ajouté',
	'CLI_USER_DELETE_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer « %s » ? [y/N]',
	'CLI_USER_RECLEAN_START'	=> 'Nettoyage des noms d’utilisateurs',
	'CLI_USER_RECLEAN_DONE'		=> [
		0	=> 'Nettoyage terminé. Aucun nom d’utilisateur n’a nécessité d’être nettoyé',
		1	=> 'Nettoyage terminé. %d nom d’utilisateur a été nettoyé',
		2	=> 'Nettoyage terminé. %d noms d’utilisateurs ont été nettoyés',
	],
));

// Additional help for commands.
$lang = array_merge($lang, array(
	'CLI_HELP_CRON_RUN'			=> $lang['CLI_DESCRIPTION_CRON_RUN'] . '. Optionnellement, vous pouvez spécifier le nom d’une seule tâche afin de n’exécuter que celle-ci.',
	'CLI_HELP_USER_ACTIVATE'	=> 'Activez ou désactivez le compte d’un membre en utilisant l’option <info>--deactivate</info>.
Pour éventuellement envoyer un courriel d’activation au membre en utilisant l’option <info>--send-email</info>.',
	'CLI_HELP_USER_ADD'			=> 'La commande <info>%command.name%</info> ajoute un nouveau membre :
Si cette commande est exécutée sans options, vous serez invité à les saisir.
Pour éventuellement envoyer un courriel au nouveau membre, utilisez l’option <info>--send-email</info>.',
	'CLI_HELP_USER_RECLEAN'		=> 'la commande <info>%command.name%</info> analysera tous les noms d’utilisateurs de la base de données et s’assurera qu’une version nettoyée y sera stockée. Les noms d’utilisateurs nettoyés sont rendus insensibles à la casse, normalisés NFC et transformés en ASCII.',
));
