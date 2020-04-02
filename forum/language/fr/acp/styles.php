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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_STYLES_EXPLAIN'						=> 'Depuis cette page, vous pouvez gérer les styles disponibles sur votre forum.<br>Veuillez noter que vous ne pouvez pas désinstaller le style « <strong>prosilver</strong> », car il s’agit du style parent par défaut et principal de phpBB.',

	'CANNOT_BE_INSTALLED'						=> 'Ne peut pas être installé',
	'CONFIRM_UNINSTALL_STYLES'					=> 'Êtes-vous sûr de vouloir désinstaller les styles sélectionnés ?',
	'COPYRIGHT'									=> 'Copyright',

	'DEACTIVATE_DEFAULT'						=> 'Vous ne pouvez pas désactiver le style par défaut.',
	'DELETE_FROM_FS'							=> 'Supprimer définitivement les fichiers. Attention ! Cette action est irréversible.',
	'DELETE_STYLE_FILES_FAILED'					=> 'Erreur de suppression de fichiers pour le style « %s ».',
	'DELETE_STYLE_FILES_SUCCESS'				=> 'Les fichiers pour le style « %s » ont été supprimés.',
	'DETAILS'									=> 'Détails',

	'INHERITING_FROM'							=> 'Hérité de',
	'INSTALL_STYLE'								=> 'Installer le style',
	'INSTALL_STYLES'							=> 'Installation de styles',
	'INSTALL_STYLES_EXPLAIN'					=> 'Depuis cette page, vous pouvez installer de nouveaux styles.<br>Si vous ne trouvez pas un style dans la liste ci-dessous, assurez-vous qu’il ne soit pas déjà installé. Si ce n’est pas le cas, vérifiez qu’il a bien été transféré sur le serveur.',
	'INVALID_STYLE_ID'							=> 'ID de style non valide.',

	'NO_MATCHING_STYLES_FOUND'					=> 'Aucun style ne correspond à votre demande.',
	'NO_UNINSTALLED_STYLE'						=> 'Aucun style à installer',

	'PURGED_CACHE'								=> 'Le cache a été purgé.',

	'REQUIRES_STYLE'							=> 'Ce style nécessite que le style « %s » soit installé.',

	'STYLE_ACTIVATE'							=> 'Activer le style',
	'STYLE_ACTIVE'								=> 'Style actif',
	'STYLE_DEACTIVATE'							=> 'Désactiver le style',
	'STYLE_DEFAULT'								=> 'Définir comme style par défaut',
	'STYLE_DEFAULT_CHANGE_INACTIVE'				=> 'Vous devez activer le style avant de le définir comme style par défaut.',
	'STYLE_ERR_INVALID_PARENT'					=> 'Le style parent n’est pas valide.',
	'STYLE_ERR_NAME_EXIST'						=> 'Un style porte déjà ce nom.',
	'STYLE_ERR_STYLE_NAME'						=> 'Vous devez donner un nom à ce style.',
	'STYLE_INSTALLED'							=> 'Le style « %s » a été installé.',
	'STYLE_INSTALLED_RETURN_INSTALLED_STYLES'	=> 'Aller à la liste des styles installés',
	'STYLE_INSTALLED_RETURN_UNINSTALLED_STYLES'	=> 'Installer davantage de styles',
	'STYLE_NAME'								=> 'Nom du style',
	'STYLE_NAME_RESERVED'						=> 'Le style « %s » ne peut pas être installé car ce nom est réservé.',
	'STYLE_NOT_INSTALLED'						=> 'Le style « %s » n’a pas été installé.',
	'STYLE_PATH'								=> 'Chemin du style',
	'STYLE_UNINSTALL'							=> 'Désinstaller',
	'STYLE_UNINSTALL_DEPENDENT'					=> 'Le style « %s » ne peut pas être désinstallé car un ou plusieurs en dépendent.',
	'STYLE_UNINSTALLED'							=> 'Le style « %s » a été désinstallé.',
	'STYLE_PHPBB_VERSION'						=> 'Version de phpBB',
	'STYLE_USED_BY'								=> 'Utilisé par (robots inclus)',
	'STYLE_VERSION'								=> 'Version du style',

	'UNINSTALL_PROSILVER'						=> 'Vous ne pouvez pas désinstaller le style « prosilver ».',
	'UNINSTALL_DEFAULT'							=> 'Vous ne pouvez pas désinstaller le style par défaut.',

	'BROWSE_STYLES_DATABASE'					=> 'Parcourir la base de données des styles',
]);
