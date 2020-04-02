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
	'EXTENSION'					=> 'Extension',
	'EXTENSIONS'				=> 'Extensions',
	'EXTENSIONS_ADMIN'			=> 'Gestionnaire d’extensions',
	'EXTENSIONS_EXPLAIN'		=> 'Le gestionnaire d’extensions est un outil intégré à votre forum phpBB vous permettant de gérer l’ensemble de vos extensions, leurs statuts et de consulter leurs informations.',
	'EXTENSION_INVALID_LIST'	=> 'L’extension « %s » n’est pas valide.<br>%s<br><br>',
	'EXTENSION_NOT_AVAILABLE'	=> 'L’extension sélectionnée n’est pas disponible pour ce forum, vérifiez que vos versions de phpBB et de PHP soient compatibles (voir la page des détails).',
	'EXTENSION_DIR_INVALID'		=> 'L’extension sélectionnée ne peut pas être activée car elle possède une structure de répertoire qui est invalide.',
	'EXTENSION_NOT_ENABLEABLE'	=> 'L’extension sélectionnée ne peut pas être activée. Veuillez en vérifier les prérequis.',
	'EXTENSION_NOT_INSTALLED'	=> 'L’extension « %s » n’est pas disponible. Veuillez vérifier que vous l’avez installée correctement.',

	'DETAILS'				=> 'Détails',

	'EXTENSIONS_DISABLED'	=> 'Extensions désactivées',
	'EXTENSIONS_ENABLED'	=> 'Extensions activées',

	'EXTENSION_DELETE_DATA'	=> 'Supprimer les données',
	'EXTENSION_DISABLE'		=> 'Désactiver',
	'EXTENSION_ENABLE'		=> 'Activer',

	'EXTENSION_DELETE_DATA_EXPLAIN'	=> 'Supprimer les données d’une extension efface l’intégralité de ses données et réglages. Les fichiers de l’extension sont conservés, ce qui permet de l’activer à nouveau.',
	'EXTENSION_DISABLE_EXPLAIN'		=> 'Désactiver une extension conserve ses fichiers, ses données et ses réglages mais retire toute fonctionnalité ajoutée par l’extension.',
	'EXTENSION_ENABLE_EXPLAIN'		=> 'Activer une extension vous permet d’utiliser ses fonctionnalités dans votre forum.',

	'EXTENSION_DELETE_DATA_IN_PROGRESS'	=> 'Les données de l’extension sont en cours de suppression. Veuillez ne pas quitter ou actualiser cette page jusqu’à son achèvement.',
	'EXTENSION_DISABLE_IN_PROGRESS'	=> 'L’extension est en cours de désactivation. Veuillez ne pas quitter ou actualiser cette page jusqu’à son achèvement.',
	'EXTENSION_ENABLE_IN_PROGRESS'	=> 'L’extension est en cours d’activation. Veuillez ne pas quitter ou actualiser cette page jusqu’à son achèvement.',

	'EXTENSION_DELETE_DATA_SUCCESS'	=> 'Les données de l’extension ont été supprimées.',
	'EXTENSION_DISABLE_SUCCESS'		=> 'L’extension a été désactivée.',
	'EXTENSION_ENABLE_SUCCESS'		=> 'L’extension a été activée.',

	'EXTENSION_NAME'			=> 'Nom de l’extension',
	'EXTENSION_ACTIONS'			=> 'Actions',
	'EXTENSION_OPTIONS'			=> 'Options',
	'EXTENSION_INSTALL_HEADLINE'=> 'Pour installer une extension',
	'EXTENSION_INSTALL_EXPLAIN'	=> '<ol>
			<li>Téléchargez une extension depuis la base de données des extensions de phpBB.com ou phpBB-fr.com ;</li>
			<li>Décompressez l’archive de l’extension et transférez son contenu dans le répertoire <samp>ext/</samp> de votre forum phpBB ;</li>
			<li>Activez l’extension, ici depuis le « Gestionnaire d’extensions ».</li>
		</ol>',
	'EXTENSION_UPDATE_HEADLINE'	=> 'Pour mettre à jour une extension',
	'EXTENSION_UPDATE_EXPLAIN'	=> '<ol>
			<li>Désactivez l’extension ;</li>
			<li>Supprimez les fichiers de l’extension du système de fichiers ;</li>
			<li>Transférez les nouveaux fichiers ;</li>
			<li>Activez l’extension.</li>
		</ol>',
	'EXTENSION_REMOVE_HEADLINE'	=> 'Pour supprimer complètement une extension de votre forum',
	'EXTENSION_REMOVE_EXPLAIN'	=> '<ol>
			<li>Désactivez l’extension ;</li>
			<li>Supprimez les données de l’extension ;</li>
			<li>Supprimez les fichiers de l’extension du système de fichiers.</li>
		</ol>',

	'EXTENSION_DELETE_DATA_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer les données de l’extension « %s » ?<br>Cela supprimera la totalité des données et les réglages de cette extension, cette action est irréversible !',
	'EXTENSION_DISABLE_CONFIRM'		=> 'Êtes-vous sûr de vouloir désactiver l’extension « %s » ?',
	'EXTENSION_ENABLE_CONFIRM'		=> 'Êtes-vous sûr de vouloir activer l’extension « %s » ?',
	'EXTENSION_FORCE_UNSTABLE_CONFIRM'	=> 'Êtes-vous sûr de vouloir forcer l’utilisation d’une version instable ?',

	'RETURN_TO_EXTENSION_LIST'	=> 'Retourner à la liste des extensions',

	'EXT_DETAILS'			=> 'Détails de l’extension',
	'DISPLAY_NAME'			=> 'Nom de l’extension',
	'CLEAN_NAME'			=> 'Nom simplifié',
	'TYPE'					=> 'Type',
	'DESCRIPTION'			=> 'Description',
	'VERSION'				=> 'Version',
	'HOMEPAGE'				=> 'Site Internet',
	'PATH'					=> 'Chemin d’accès',
	'TIME'					=> 'Date de diffusion',
	'LICENSE'				=> 'Licence',

	'REQUIREMENTS'			=> 'Prérequis',
	'PHPBB_VERSION'			=> 'Version de phpBB',
	'PHP_VERSION'			=> 'Version de PHP',
	'AUTHOR_INFORMATION'	=> 'Informations sur l’auteur',
	'AUTHOR_NAME'			=> 'Nom',
	'AUTHOR_EMAIL'			=> 'Courriel',
	'AUTHOR_HOMEPAGE'		=> 'Site Internet',
	'AUTHOR_ROLE'			=> 'Fonction',

	'NOT_UP_TO_DATE'		=> '%s n’est pas à jour',
	'UP_TO_DATE'			=> '%s est à jour',
	'ANNOUNCEMENT_TOPIC'	=> 'Annonce de sortie',
	'DOWNLOAD_LATEST'		=> 'Télécharger la dernière version',
	'NO_VERSIONCHECK'		=> 'Cette extension ne prend pas en charge le contrôle de version.',

	'VERSIONCHECK_FORCE_UPDATE_ALL'		=> 'Tout re-contrôler',
	'FORCE_UNSTABLE'					=> 'Toujours vérifier l’existence de versions instables',
	'EXTENSIONS_VERSION_CHECK_SETTINGS'	=> 'Paramètres du contrôle des versions',

	'BROWSE_EXTENSIONS_DATABASE'		=> 'Parcourir la base de données des extensions',

	'META_FIELD_NOT_SET'	=> 'Le champ méta requis « %s » n’a pas été défini.',
	'META_FIELD_INVALID'	=> 'Le champ méta « %s » n’est pas valide.',
));
