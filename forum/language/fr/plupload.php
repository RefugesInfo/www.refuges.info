<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010-2013 Moxiecode Systems AB
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

$lang = array_merge($lang, array(
	'PLUPLOAD_ADD_FILES'			=> 'Ajouter des fichiers',
	'PLUPLOAD_ADD_FILES_TO_QUEUE'	=> 'Ajouter des fichiers à la file d’attente de transfert et cliquer sur le bouton « Démarrer le transfert ».',
	'PLUPLOAD_ALREADY_QUEUED'		=> '%s déjà présent dans la file d’attente.',
	'PLUPLOAD_CLOSE'				=> 'Fermer',
	'PLUPLOAD_DRAG'					=> 'Faites glisser les fichiers ici.',
	'PLUPLOAD_DUPLICATE_ERROR'		=> 'Erreur de fichier en double.',
	'PLUPLOAD_DRAG_TEXTAREA'		=> 'Vous pouvez également joindre des fichiers par glisser-déposer dans la zone de saisie du message.',
	'PLUPLOAD_ERR_INPUT'			=> 'Impossible d’ouvrir le flux d’entrée.',
	'PLUPLOAD_ERR_MOVE_UPLOADED'	=> 'Impossible de déplacer le fichier transféré.',
	'PLUPLOAD_ERR_OUTPUT'			=> 'Impossible d’ouvrir le flux de sortie.',
	'PLUPLOAD_ERR_FILE_TOO_LARGE'	=> 'Fichier trop volumineux :',
	'PLUPLOAD_ERR_FILE_COUNT'		=> 'Nombre de fichiers erroné.',
	'PLUPLOAD_ERR_FILE_INVALID_EXT'	=> 'Extension de fichier non prise en charge :',
	'PLUPLOAD_ERR_RUNTIME_MEMORY'	=> 'La mémoire disponible nécessaire au module « Plupload » n’est pas suffisante.',
	'PLUPLOAD_ERR_UPLOAD_URL'		=> 'L’URL de transfert est erronée ou n’existe pas.',
	'PLUPLOAD_EXTENSION_ERROR'		=> 'Extension du fichier erronée.',
	'PLUPLOAD_FILE'					=> 'Fichier : %s',
	'PLUPLOAD_FILE_DETAILS'			=> 'Fichier : %s, taille : %d, taille du fichier maximum : %d',
	'PLUPLOAD_FILENAME'				=> 'Nom du fichier',
	'PLUPLOAD_FILES_QUEUED'			=> '%d fichiers en file d’attente',
	'PLUPLOAD_GENERIC_ERROR'		=> 'Erreur générique.',
	'PLUPLOAD_HTTP_ERROR'			=> 'Erreur HTTP.',
	'PLUPLOAD_IMAGE_FORMAT'			=> 'Le format de l’image n’est pas correct ou n’est pas supporté.',
	'PLUPLOAD_INIT_ERROR'			=> 'Erreur d’initialisation.',
	'PLUPLOAD_IO_ERROR'				=> 'Erreur E/S.',
	'PLUPLOAD_NOT_APPLICABLE'		=> 'N/A',
	'PLUPLOAD_SECURITY_ERROR'		=> 'Erreur de sécurité.',
	'PLUPLOAD_SELECT_FILES'			=> 'Sélectionnez les fichiers',
	'PLUPLOAD_SIZE'					=> 'Taille',
	'PLUPLOAD_SIZE_ERROR'			=> 'Erreur de taille de fichier.',
	'PLUPLOAD_STATUS'				=> 'Statut',
	'PLUPLOAD_START_UPLOAD'			=> 'Démarrer le transfert',
	'PLUPLOAD_START_CURRENT_UPLOAD'	=> 'Démarrer le transfert des fichiers de la file d’attente',
	'PLUPLOAD_STOP_UPLOAD'			=> 'Arrêter le transfert',
	'PLUPLOAD_STOP_CURRENT_UPLOAD'	=> 'Arrêter le transfert en cours',
	// Note: This string is formatted independently by plupload and so does not
	// use the same formatting rules as normal phpBB translation strings
	'PLUPLOAD_UPLOADED'				=> '%d/%d fichiers transférés',
));
