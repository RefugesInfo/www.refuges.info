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

$lang = array_merge($lang, [
	'ACP_STYLES_EXPLAIN'						=> 'Aquí puedes administrar los estilos disponibles en tu foro.<br>Ten en cuenta que no puedes desinstalar el estilo “<strong>prosilver</strong>”, ya que es el estilo principal primario y predeterminado de phpBB.',

	'CANNOT_BE_INSTALLED'						=> 'No se puede instalar',
	'CONFIRM_UNINSTALL_STYLES'					=> '¿Estás seguro de querer desinstalar los estilos seleccionados?',
	'COPYRIGHT'									=> 'Copyright',

	'DEACTIVATE_DEFAULT'						=> 'No puedes desactivar el estilo por defecto.',
	'DELETE_FROM_FS'							=> 'Borrar del sistema',
	'DELETE_STYLE_FILES_FAILED'					=> 'Error borrando archivos del estilo "%s".',
	'DELETE_STYLE_FILES_SUCCESS'				=> 'Archivos del estilo "%s" han sido borrados.',
	'DETAILS'									=> 'Detalles',

	'INHERITING_FROM'							=> 'Hereda de',
	'INSTALL_STYLE'								=> 'Instalar estilo',
	'INSTALL_STYLES'							=> 'Instalar estilos',
	'INSTALL_STYLES_EXPLAIN'					=> 'Aquí puedes instalar nuevos estilos.<br>Si no encuentras un estilo específico en la lista, verifica que el estilo ya esté instalado. Si no está instalado, comprueba si lo has subido correctamente.',
	'INVALID_STYLE_ID'							=> 'ID del estilo no válido.',

	'NO_MATCHING_STYLES_FOUND'					=> 'No coinciden estilos para esa consulta.',
	'NO_UNINSTALLED_STYLE'						=> 'No se han detectado estilos desinstalados.',

	'PURGED_CACHE'								=> 'La caché ha sido limpiada.',

	'REQUIRES_STYLE'							=> 'Este estilo requiere que el estilo "%s" se encuentre instalado.',

	'STYLE_ACTIVATE'							=> 'Activar',
	'STYLE_ACTIVE'								=> 'Activo',
	'STYLE_DEACTIVATE'							=> 'Desactivar',
	'STYLE_DEFAULT'								=> 'Hacer estilo por defecto',
	'STYLE_DEFAULT_CHANGE_INACTIVE'				=> 'Debes activar el estilo antes de hacerlo el estilo por defecto.',
	'STYLE_ERR_INVALID_PARENT'					=> 'Estilo padre inválido.',
	'STYLE_ERR_NAME_EXIST'						=> 'Ya existe un estilo con ese nombre.',
	'STYLE_ERR_STYLE_NAME'						=> 'Tienes que proporcionar un nombre para este estilo.',
	'STYLE_INSTALLED'							=> 'El estilo “%s” ha sido instalado.',
	'STYLE_INSTALLED_RETURN_INSTALLED_STYLES'	=> 'Volver a la lista de estilos instalados',
 	'STYLE_INSTALLED_RETURN_UNINSTALLED_STYLES'	=> 'Instalas más estilos',
	'STYLE_NAME'								=> 'Nombre del estilo',
	'STYLE_NAME_RESERVED'						=> 'El estilo “%s” no se puede instalar, porque el nombre está reservado.',
	'STYLE_NOT_INSTALLED'						=> 'El estilo “%s” no se instaló.',
	'STYLE_PATH'								=> 'Ruta del estilo',
	'STYLE_UNINSTALL'							=> 'Desinstalar',
	'STYLE_UNINSTALL_DEPENDENT'					=> 'El estilo “%s” no puede ser desinstalado porque tiene uno o más estilos hijos.',
	'STYLE_UNINSTALLED'							=> 'El estilo “%s” se ha desinstalado correctamente.',
	'STYLE_PHPBB_VERSION'						=> 'Versión de phpBB',
	'STYLE_USED_BY'								=> 'Usado por (incluyendo robots)',
	'STYLE_VERSION'								=> 'Versión del estilo',

	'UNINSTALL_PROSILVER'						=> 'No puedes desinstalar el estilo “prosilver”.',
	'UNINSTALL_DEFAULT'							=> 'No puedes desinstalar el estilo por defecto.',

	'BROWSE_STYLES_DATABASE'					=> 'Navegar por la base de datos de estilos',
]);
