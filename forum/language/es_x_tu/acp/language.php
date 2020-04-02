<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
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

$lang = array_merge($lang, array(
	'ACP_FILES'						=> 'Archivos de Administración',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> 'Aquí puedes instalar/desinstalar paquetes de idiomas. El paquete de idioma por defecto está marcado con un asterisco (*).',

    	'DELETE_LANGUAGE_CONFIRM'		=> '¿Estás seguro que deseas eliminar “%s”?',

	'INSTALLED_LANGUAGE_PACKS'		=> 'Paquetes de idiomas instalados',

	'LANGUAGE_DETAILS_UPDATED'			=> 'Detalles del idioma actualizados correctamente.',
	'LANGUAGE_PACK_ALREADY_INSTALLED'	=> 'Este paquete de idioma ya está instalado.',
	'LANGUAGE_PACK_DELETED'				=> 'El paquete de idioma “%s” ha sido deshabilitado. Todos los usuarios de este idioma han sido reasignados al idioma por defecto del sitio.',
	'LANGUAGE_PACK_DETAILS'				=> 'Detalles del paquete de idioma',
	'LANGUAGE_PACK_INSTALLED'			=> 'El paquete de idioma “%s” ha sido instalado correctamente.',
	'LANGUAGE_PACK_CPF_UPDATE'			=> 'En los campos personalizados de Perfil, las cadenas de idioma serán copiadas del idioma por defecto. Por favor, cambia esto si es necesario.',
	'LANGUAGE_PACK_ISO'					=> 'ISO',
	'LANGUAGE_PACK_LOCALNAME'			=> 'Nombre local',
	'LANGUAGE_PACK_NAME'				=> 'Nombre',
	'LANGUAGE_PACK_NOT_EXIST'			=> 'El paquete de idioma seleccionado no existe.',
	'LANGUAGE_PACK_USED_BY'				=> 'Usado por (incluyendo robots)',
	'LANGUAGE_VARIABLE'					=> 'Idioma variable',
	'LANG_AUTHOR'						=> 'Autor',
	'LANG_ENGLISH_NAME'					=> 'Nombre en inglés',
	'LANG_ISO_CODE'						=> 'Código ISO',
	'LANG_LOCAL_NAME'					=> 'Nombre local',

	'MISSING_LANG_FILES'		=> 'Archivo de idioma perdido',
	'MISSING_LANG_VARIABLES'	=> 'Variables de idioma perdidas',

	'NO_FILE_SELECTED'					=> 'No has especificado un archivo.',
	'NO_LANG_ID'						=> 'No has especificado un idioma.',
	'NO_REMOVE_DEFAULT_LANG'			=> 'No puedes deshabilitar el paquete de idioma por defecto.<br />Cambia el idioma por defecto del sitio antes.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'		=> 'Ho hay paquetes desinstalados',

	'THOSE_MISSING_LANG_FILES'			=> 'Los siguientes archivos no se encuentran en la carpeta de idioma “%s”',
	'THOSE_MISSING_LANG_VARIABLES'		=> 'Las siguientes variables no se encuentran en el paquete “%s”',

	'UNINSTALLED_LANGUAGE_PACKS'		=> 'Paquetes desinstalados',

	'BROWSE_LANGUAGE_PACKS_DATABASE'	=> 'Navegar por la base de datos de paquetes de idioma',
));
