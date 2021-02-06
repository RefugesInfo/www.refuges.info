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
	'CONFIG_NOT_EXIST'					=> 'Inesperadamente, el ajuste de configuración "%s" no existe.',

	'GROUP_NOT_EXIST'					=> 'Inesperadamente, el grupo "%s" no existe.',

	'MIGRATION_APPLY_DEPENDENCIES'      => 'Aplicar dependencias de %s.',
	'MIGRATION_DATA_DONE'				=> 'Datos instalados: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Datos instalados: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_DATA_RUNNING'         => 'Instalando datos: %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> 'Migración instalada correctamente (omitido): %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Algo salió mal en la solicitud y se produjo una excepción. Los cambios hechos antes de que ocurriera el error se invirtieron en la medida de nuestras capacidades, pero tú deberás comprobar los errores del foro.',
	'MIGRATION_NOT_FULFILLABLE'			=> 'La migración "%1$s" no se ha realizado, falta la migración "%2$s".',
	'MIGRATION_NOT_INSTALLED'			=> 'La migración "%s" no está instalada.',
	'MIGRATION_NOT_VALID'            => '%s no es una migración válida.',
	'MIGRATION_SCHEMA_DONE'				=> 'Esquema instalado: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_SCHEMA_IN_PROGRESS'		=> 'Instalando esquema: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_SCHEMA_RUNNING'         => 'Instalando esquema: %s.',

	'MIGRATION_REVERT_DATA_DONE'		=> 'Datos revertidos: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_REVERT_DATA_IN_PROGRESS'	=> 'Reversión de datos: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_REVERT_DATA_RUNNING'		=> 'Reversión de datos: %s.',
	'MIGRATION_REVERT_SCHEMA_DONE'		=> 'Esquema revertido: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'	=> 'Reversión del esquema: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'	=> 'Esquema revertido: %1$s; Tiempo: %2$.2f segundos',
	'MIGRATION_REVERT_SCHEMA_RUNNING'	=> 'Reversión del esquema: %s.',

	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'La migración no es válida. Una sentencia if ayudante le falta una condición.',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'La migración no es válida. Una sentencia if ayudante no se encuentra, la llamada válida a un paso de la migración.',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'La migración no es válida. Una función personalizada exigible no pudo ser llamada.',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'La migración no es válida. Se encontró un tipo de herramienta de migración desconocido.',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'La migración no es válida. Se ha encontrado una herramienta de migración definido.',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'La migración no es válida. Se ha encontrado un método de herramienta de migración definido.',

	'MODULE_ERROR'						=> 'Se ha producido un error al crear un módulo: %s',
	'MODULE_EXISTS'						=> 'Ya existe un módulo: %s',
	'MODULE_EXIST_MULTIPLE'				=> 'Ya existen varios módulos con el nombre de módulo primario dado: %s. Intenta usar las teclas antes/después para aclarar la colocación del módulo.',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Un archivo de información del módulo necesario, no ha sido encontrado: %2$s',
	'MODULE_NOT_EXIST'					=> 'Un módulo requerido no existe: %s',

	'PARENT_MODULE_FIND_ERROR'			=> 'No se puede determinar el identificador del módulo primario: %s',
	'PERMISSION_NOT_EXIST'				=> 'El ajuste de permiso "%s" inesperadamente, no existe.',

	'ROLE_NOT_EXIST'					=> 'El rol de permiso "%s" inesperadamente, no existe.',
));
