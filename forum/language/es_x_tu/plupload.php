<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010-2013 Moxiecode Systems AB
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
	'PLUPLOAD_ADD_FILES'		=> 'Añadir archivos',
	'PLUPLOAD_ADD_FILES_TO_QUEUE'	=> 'Agregar archivos a la cola de subida y haz clic en el botón de inicio.',
	'PLUPLOAD_ALREADY_QUEUED'	=> '%s ya presente en la cola.',
	'PLUPLOAD_CLOSE'			=> 'Cerrar',
	'PLUPLOAD_DRAG'				=> 'Arrastra los archivos aquí.',
	'PLUPLOAD_DUPLICATE_ERROR'	=> 'Error de archivo duplicado.',
	'PLUPLOAD_DRAG_TEXTAREA'	=> 'También puedes adjuntar archivos arrastrándolos y soltándolos en el cuadro de mensaje.',
	'PLUPLOAD_ERR_INPUT'		=> 'No se ha podido abrir la secuencia de entrada.',
	'PLUPLOAD_ERR_MOVE_UPLOADED'	=> 'No se ha podido mover el archivo subido.',
	'PLUPLOAD_ERR_OUTPUT'		=> 'No se ha podido abrir la secuencia de salida.',
	'PLUPLOAD_ERR_FILE_TOO_LARGE'	=> 'El archivo es demasiado grande:',
	'PLUPLOAD_ERR_FILE_COUNT'	=> 'El archivo contiene error.',
	'PLUPLOAD_ERR_FILE_INVALID_EXT'	=> 'Extensión de archivo no válido:',
	'PLUPLOAD_ERR_RUNTIME_MEMORY'	=> 'Runtime se quedó sin memoria disponible.',
	'PLUPLOAD_ERR_UPLOAD_URL'	=> 'URL de carga podría ser errónea o no existe.',
	'PLUPLOAD_EXTENSION_ERROR'	=> 'Error de extensión del archivo.',
	'PLUPLOAD_FILE'				=> 'Archivo: %s',
	'PLUPLOAD_FILE_DETAILS'		=> 'Archivo: %s, tamaño: %d, tamaño máximo de archivo: %d',
	'PLUPLOAD_FILENAME'			=> 'Nombre del archivo',
	'PLUPLOAD_FILES_QUEUED'		=> '%d archivos en cola',
	'PLUPLOAD_GENERIC_ERROR'	=> 'Error genérico.',
	'PLUPLOAD_HTTP_ERROR'		=> 'Error HTTP.',
	'PLUPLOAD_IMAGE_FORMAT'		=> 'Formato de imagen, es erroneo o no es compatible.',
	'PLUPLOAD_INIT_ERROR'		=> 'Error Init.',
	'PLUPLOAD_IO_ERROR'			=> 'Error IO.',
	'PLUPLOAD_NOT_APPLICABLE'	=> 'N/A',
	'PLUPLOAD_SECURITY_ERROR'	=> 'Error de seguridad.',
	'PLUPLOAD_SELECT_FILES'		=> 'Seleccionar archivos',
	'PLUPLOAD_SIZE'				=> 'Tamaño',
	'PLUPLOAD_SIZE_ERROR'		=> 'Error de tamaño del archivo.',
	'PLUPLOAD_STATUS'			=> 'Estado',
	'PLUPLOAD_START_UPLOAD'		=> 'Comenzar subida',
	'PLUPLOAD_START_CURRENT_UPLOAD'	=> 'Iniciar cola de subida',
	'PLUPLOAD_STOP_UPLOAD'		=> 'Parar subida',
	'PLUPLOAD_STOP_CURRENT_UPLOAD'	=> 'Parar subida actual',
	// Note: This string is formatted independently by plupload and so does not
	// use the same formatting rules as normal phpBB translation strings
	'PLUPLOAD_UPLOADED'			=> 'Subido(s) %d/%d archivo(s)',
));
