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

// Database Backup/Restore
$lang = array_merge($lang, array(
	'ACP_BACKUP_EXPLAIN'	=> 'Ici, Vous pouvez sauvegarder l’intégralité des données de votre forum. L’archive de sauvegarde sera stockée dans votre répertoire <samp>store/</samp>. Selon la configuration de votre serveur, vous pouvez utiliser différents formats de compression.',
	'ACP_RESTORE_EXPLAIN'	=> 'Vous pouvez procéder à une restauration de votre forum à partir d’un fichier de sauvegarde. Si votre serveur le permet, vous pouvez utiliser la compression gzip ou bzip2, le fichier sera automatiquement décompressé. <strong>Attention :</strong> cette opération écrase toutes les données existantes. Le processus peut prendre du temps, ne quittez pas cette page avant la fin de la restauration. Les sauvegardes sont stockées dans le répertoire <samp>store/</samp> et sont supposées être générées par la fonctionnalité de sauvegarde de phpBB. La restauration de sauvegardes non créées par phpBB peut ne pas fonctionner.',

	'BACKUP_DELETE'			=> 'Le fichier de sauvegarde a été effacé.',
	'BACKUP_INVALID'		=> 'Le fichier de sauvegarde sélectionné n’est pas valide.',
	'BACKUP_NOT_SUPPORTED'	=> 'Le fichier de sauvegarde sélectionné n’est pas valide.',
	'BACKUP_OPTIONS'		=> 'Options de sauvegarde',
	'BACKUP_SUCCESS'		=> 'Le fichier de sauvegarde a été créé.',
	'BACKUP_TYPE'			=> 'Type de sauvegarde',

	'DATABASE'			=> 'Utilitaires de base de données',
	'DATA_ONLY'			=> 'Données seulement',
	'DELETE_BACKUP'		=> 'Effacer la sauvegarde',
	'DELETE_SELECTED_BACKUP'	=> 'Êtes-vous sûr de vouloir supprimer la sauvegarde sélectionnée ?',
	'DESELECT_ALL'		=> 'Tout désélectionner',
	'DOWNLOAD_BACKUP'	=> 'Télécharger la sauvegarde',

	'FILE_TYPE'			=> 'Type de fichier',
	'FILE_WRITE_FAIL'	=> 'Impossible d’écrire le fichier dans le répertoire de stockage.',
	'FULL_BACKUP'		=> 'Complète',

	'RESTORE_FAILURE'			=> 'Le fichier de sauvegarde est peut-être corrompu.',
	'RESTORE_OPTIONS'			=> 'Options de restauration',
	'RESTORE_SELECTED_BACKUP'	=> 'Êtes-vous sûr de vouloir restaurer la sauvegarde sélectionnée ?',
	'RESTORE_SUCCESS'			=> 'La base de données a été restaurée.<br><br>Votre forum devrait être tel qu’il l’était avant la sauvegarde.',

	'SELECT_ALL'			=> 'Tout sélectionner',
	'SELECT_FILE'			=> 'Sélectionner un fichier',
	'START_BACKUP'			=> 'Démarrer la sauvegarde',
	'START_RESTORE'			=> 'Démarrer la restauration',
	'STORE_AND_DOWNLOAD'	=> 'Stocker et télécharger',
	'STORE_LOCAL'			=> 'Stocker le fichier',

	'TABLE_SELECT'		=> 'Sélection de la table',
	'TABLE_SELECT_ERROR'=> 'Vous devez sélectionner au moins une table.',
));
