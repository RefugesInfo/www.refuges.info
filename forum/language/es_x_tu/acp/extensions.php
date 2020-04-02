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

$lang = array_merge($lang, array(
	'EXTENSION'					=> 'Extensión',
	'EXTENSIONS'				=> 'Extensiones',
	'EXTENSIONS_ADMIN'			=> 'Administrador de Extensiones',
	'EXTENSIONS_EXPLAIN'		=> 'El Administrador de Extensiones es una herramienta en tu foro phpBB que permite gestionar todas sus extensiones, su estado, y ver la información sobre ellas.',
	'EXTENSION_INVALID_LIST'	=> 'La extensión “%s” no es validá.<br />%s<br /><br />',
	'EXTENSION_NOT_AVAILABLE'	=> 'La extensión seleccionada no está disponible en este foro, por favor verifica las versiones de phpBB y PHP (ver la página de detalles).',
	'EXTENSION_DIR_INVALID'		=> 'La extensión seleccionada tiene una estructura de directorio no válido y no se puede activar.',
	'EXTENSION_NOT_ENABLEABLE'	=> 'La siguiente extensión no puede ser habilitada, por favor, verifica los requerimientos de la extensión.',
	'EXTENSION_NOT_INSTALLED'	=> 'La extensión %s no está disponible. Por favor, comprueba que la has instalado correctamente.',

	'DETAILS'				=> 'Detalles',

	'EXTENSIONS_DISABLED'	=> 'Extensiones deshabilitadas',
	'EXTENSIONS_ENABLED'	=> 'Extensiones habilitadas',

	'EXTENSION_DELETE_DATA'	=> 'Borrar datos',
	'EXTENSION_DISABLE'		=> 'Deshabilitar',
	'EXTENSION_ENABLE'		=> 'Habilitar',

	'EXTENSION_DELETE_DATA_EXPLAIN'	=> 'Borrando los datos de la extensión, elimina todos los datos y configuraciones. Los archivos de extensión se conservan para que pueda ser activada de nuevo.',
	'EXTENSION_DISABLE_EXPLAIN'		=> 'Deshabilitando una extensión, conservara sus archivos y configuraciones, pero eliminara cualquier funcionalidad de la extensión.',
	'EXTENSION_ENABLE_EXPLAIN'		=> 'Habilitando una extensión, le permitira usarla en su foro.',

	'EXTENSION_DELETE_DATA_IN_PROGRESS'	=> 'Actualmente se está borrando datos de la extensión. Por favor, no salgas de esta página o refresques hasta que se complete.',
	'EXTENSION_DISABLE_IN_PROGRESS'	=> 'Actualmente se está desactivando la extensión. Por favor, no salgas de esta página o refresques hasta que se complete.',
	'EXTENSION_ENABLE_IN_PROGRESS'	=> 'Actualmente se está activando la extensión. Por favor, no salgas de esta página o refresques hasta que se complete.',

	'EXTENSION_DELETE_DATA_SUCCESS'	=> 'Los datos de la extensión han sido borrados correctamente',
	'EXTENSION_DISABLE_SUCCESS'		=> 'La extensión ha sido deshabilitada correctamente',
	'EXTENSION_ENABLE_SUCCESS'		=> 'La extensión ha sido habilitada correctamente',

	'EXTENSION_NAME'		=> 'Nombre de Extensión',
	'EXTENSION_ACTIONS'		=> 'Acciones',
	'EXTENSION_OPTIONS'		=> 'Opciones',
	'EXTENSION_INSTALL_HEADLINE'=> 'Instalando una extensión',
	'EXTENSION_INSTALL_EXPLAIN'	=> '<ol>
			<li>Descarga una extensión de la base de datos de extensiones de phpBB</li>
			<li>Descomprimir la extensión y subir en el directorio <samp>ext/</samp> de tú foro phpBB</li>
			<li>Habilitar la extensión, aquí en el Administrador de Extensiones</li>
		</ol>',
	'EXTENSION_UPDATE_HEADLINE'	=> 'Actualización de una extensión',
	'EXTENSION_UPDATE_EXPLAIN'	=> '<ol>
			<li>Deshabilita la extensión</li>
			<li>Elimina archivos de la extensión del sistema de archivos</li>
			<li>Sube los nuevos archivos</li>
			<li>Habilita la extensión</li>
		</ol>',
	'EXTENSION_REMOVE_HEADLINE'	=> 'Eliminación completa de una extensión ',
	'EXTENSION_REMOVE_EXPLAIN'	=> '<ol>
			<li>Deshabilita la extensión</li>
			<li>Borra datos de la extensión</li>
			<li>Elimina los archivos de la extensión del sistema de archivos </li>
		</ol>',

	'EXTENSION_DELETE_DATA_CONFIRM'	=> '¿Estás seguro de querer borrar los datos asociados de “%s”?<br /><br />¡Esto elimina todos los datos y configuraciones, y no se puede deshacer!',
	'EXTENSION_DISABLE_CONFIRM'		=> '¿Estás seguro de querer deshabilitar la extensión “%s”?',
	'EXTENSION_ENABLE_CONFIRM'		=> '¿Estás seguro de querer habilitar la extensión “%s”?',
    	'EXTENSION_FORCE_UNSTABLE_CONFIRM'	=> '¿Está seguro de querer forzar el uso de la versión inestable?',

	'RETURN_TO_EXTENSION_LIST'	=> 'Volver a la lista de extensiones',

	'EXT_DETAILS'			=> 'Detalles de la extensión',
	'DISPLAY_NAME'			=> 'Nombre a mostrar',
	'CLEAN_NAME'			=> 'Nombre limpio',
	'TYPE'					=> 'Tipo',
	'DESCRIPTION'			=> 'Descripción',
	'VERSION'				=> 'Versión',
	'HOMEPAGE'				=> 'Página principal',
	'PATH'					=> 'Ruta del archivo',
	'TIME'					=> 'Fecha de lanzamiento',
	'LICENSE'				=> 'Licencia',

	'REQUIREMENTS'			=> 'Requerimientos',
	'PHPBB_VERSION'			=> 'Versión phpBB',
	'PHP_VERSION'			=> 'Versión PHP',
	'AUTHOR_INFORMATION'	=> 'Información del autor',
	'AUTHOR_NAME'			=> 'Nombre',
	'AUTHOR_EMAIL'			=> 'Email',
	'AUTHOR_HOMEPAGE'		=> 'Página principal',
	'AUTHOR_ROLE'			=> 'Rol',

	'NOT_UP_TO_DATE'		=> '%s no está al día',
	'UP_TO_DATE'			=> '%s está al día',
	'ANNOUNCEMENT_TOPIC'	=> 'Anuncio del lanzamiento',
	'DOWNLOAD_LATEST'		=> 'Descargar versión',
	'NO_VERSIONCHECK'		=> 'No hay información de comprobación de la versión dada.',

	'VERSIONCHECK_FORCE_UPDATE_ALL'		=> 'Comprobar de nuevo todas las versiones',
	'FORCE_UNSTABLE'					=> 'Siempre comprobar las versiones inestables',
	'EXTENSIONS_VERSION_CHECK_SETTINGS'	=> 'Ajustes de comprobación de versión',

	'BROWSE_EXTENSIONS_DATABASE'		=> 'Navegar por la base de datos de extensiones',

 	'META_FIELD_NOT_SET'	=> 'Campo meta requerido %s no se ha establecido.',
 	'META_FIELD_INVALID'	=> 'Campo meta %s no es válido.',
));
