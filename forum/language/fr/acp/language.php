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

$lang = array_merge($lang, array(
	'ACP_FILES'						=> 'Fichiers de langue de l’administration',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> 'Vous pouvez installer/supprimer des packs de langue. Le pack de langue par défaut est marqué d’un astérisque (*).',

	'DELETE_LANGUAGE_CONFIRM'		=> 'Êtes-vous sûr de vouloir supprimer « %s » ?',

	'INSTALLED_LANGUAGE_PACKS'		=> 'Packs de langue installés',

	'LANGUAGE_DETAILS_UPDATED'			=> 'Informations de langue mises à jour.',
	'LANGUAGE_PACK_ALREADY_INSTALLED'	=> 'Ce pack de langue est déjà installé.',
	'LANGUAGE_PACK_DELETED'				=> 'Le pack de langue « %s » a été supprimé. La langue paramétrée pour les membres qui utilisaient ce pack est désormais la langue par défaut du forum.',
	'LANGUAGE_PACK_DETAILS'				=> 'Informations du pack de langue',
	'LANGUAGE_PACK_INSTALLED'			=> 'Le pack de langue « %s » a été installé.',
	'LANGUAGE_PACK_CPF_UPDATE'			=> 'Les chaînes de caractères pour la langue des champs de profil personnalisés ont été copiées depuis la langue par défaut. Modifiez-les si nécessaire.',
	'LANGUAGE_PACK_ISO'					=> 'ISO',
	'LANGUAGE_PACK_LOCALNAME'			=> 'Nom local',
	'LANGUAGE_PACK_NAME'				=> 'Nom',
	'LANGUAGE_PACK_NOT_EXIST'			=> 'Le pack de langue sélectionné n’existe pas.',
	'LANGUAGE_PACK_USED_BY'				=> 'Utilisé par (robots inclus)',
	'LANGUAGE_VARIABLE'					=> 'Variable de langue',
	'LANG_AUTHOR'						=> 'Auteur du pack de langue',
	'LANG_ENGLISH_NAME'					=> 'Nom Anglais',
	'LANG_ISO_CODE'						=> 'Code ISO',
	'LANG_LOCAL_NAME'					=> 'Nom local',

	'MISSING_LANG_FILES'		=> 'Fichiers de langue manquants',
	'MISSING_LANG_VARIABLES'	=> 'Variables de langue manquantes',

	'NO_FILE_SELECTED'				=> 'Aucun fichier n’a été sélectionné.',
	'NO_LANG_ID'					=> 'Aucun pack de langue n’a été sélectionné.',
	'NO_REMOVE_DEFAULT_LANG'		=> 'Vous ne pouvez pas supprimer le pack de langue par défaut.<br>Si vous voulez supprimer ce pack, changez d’abord la langue par défaut du forum.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'	=> 'Aucun pack de langue installé',

	'THOSE_MISSING_LANG_FILES'			=> 'Les fichiers de langue suivants sont absents du répertoire de langue « %s »',
	'THOSE_MISSING_LANG_VARIABLES'		=> 'Les variables de langue suivantes sont absentes du pack « %s »',

	'UNINSTALLED_LANGUAGE_PACKS'	=> 'Packs non installés',

	'BROWSE_LANGUAGE_PACKS_DATABASE'	=> 'Parcourir la base de données des packs de langue',
));
