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

// Banning
$lang = array_merge($lang, array(
	'1_HOUR'			=> '1 hora',
	'30_MINS'			=> '30 minutos',
	'6_HOURS'			=> '6 horas',

	'ACP_BAN_EXPLAIN'		=> 'Aquí puedes controlar las exclusiones de usuarios por nombre, IP o dirección de email. Este método impide a un usuario acceder a cualquier parte del sitio. Si quieres, puedes dar una razón breve (255 caracteres) para la exclusión. Se mostrará en el registro del Administrador. También puedes especificar la duración de la exclusión. Si quieres que la exclusión termine en una fecha específica en lugar de después de un periodo de tiempo, selecciona <u>Hasta</u> en la duración de la exclusión e ingresa la fecha con el formato aaaa-mm-dd.',

	'BAN_EXCLUDE'			=> 'Quitar exclusión',
	'BAN_LENGTH'			=> 'Duración de la exclusión',
	'BAN_REASON'			=> 'Razón de la exclusión',
	'BAN_GIVE_REASON'		=> 'Razón de la exclusión mostrada al usuario excluído',
	'BAN_UPDATE_SUCCESSFUL'		=> 'La lista de exclusiones ha sido actualizada correctamente.',
	'BANNED_UNTIL_DATE'		=> 'hasta %s', // Ejemplo: "hasta Lun 13.Jul.2009, 14:44"
	'BANNED_UNTIL_DURATION'		=> '%1$s (hasta %2$s)', // Ejemplo: "7 días (hasta Mar 14.Jul.2009, 14:44)"

	'EMAIL_BAN'			=> 'Excluir una o más direcciones de email',
	'EMAIL_BAN_EXCLUDE_EXPLAIN'	=> 'Habilita esto para quitar la dirección de email ingresada de todos las exclusiones actuales.',
	'EMAIL_BAN_EXPLAIN'		=> 'Para expecificar más de una dirección de email, ingresa cada una en una nueva línea. Para direcciones parciales usa * como comodín, por ejemplo, <samp>*@hotmail.com</samp>, <samp>*@*.domain.tld</samp>, etc.',
	'EMAIL_NO_BANNED'		=> 'No hay direcciones de email excluidas',
	'EMAIL_UNBAN'			=> 'Levantar exclusión de emails',
	'EMAIL_UNBAN_EXPLAIN'		=> 'Puedes quitar la exclusión a múltiples direcciones de email al mismo tiempo usando la combinación apropiada de ratón y teclado en tu navegador (por ejemplo, Ctrl+Clic). Las direcciones de email excluidas están en negrita.',

	'IP_BAN'			=> 'Excluir una o más IPs',
	'IP_BAN_EXCLUDE_EXPLAIN'	=> 'Habilita esto para quitar la IP ingresada de todas las exclusiones actuales.',
	'IP_BAN_EXPLAIN'		=> 'Para expecificar más de una IP ingresa cada una en una nueva línea. Para especificar un rango de direcciones IP separa el inicio y el final con un guión (-), para especificar un comodín usa *',
	'IP_HOSTNAME'			=> 'Direcciones IP o hostnames',
	'IP_NO_BANNED'			=> 'No hay direcciones IP excluidas',
	'IP_UNBAN'			=> 'Levantar exclusión de IPs',
	'IP_UNBAN_EXPLAIN'		=> 'Puedes quitar la exclusión a múltiples direcciones IP al mismo tiempo usando la combinación apropiada de ratón y teclado en tu navegador (por ejemplo, Ctrl+Clic). Las direcciones IP excluidas están en negrita.',

	'LENGTH_BAN_INVALID'		=> 'La fecha debe tener el formato <kbd>AAAA-MM-DD</kbd>.',

	'OPTIONS_BANNED'			=> 'Baneado',
	'OPTIONS_EXCLUDED'			=> 'Excluido',

	'PERMANENT'		=> 'Permanente',

	'UNTIL'						=> 'Hasta',
	'USER_BAN'					=> 'Excluir uno o más usuarios por nombre de usuario',
	'USER_BAN_EXCLUDE_EXPLAIN'	=> 'Habilita esto para quitar el nombre de usuario ingresado de todos las exclusiones actuales.',
	'USER_BAN_EXPLAIN'			=> 'Para especificar más de un nombre de usuario, ingresa cada uno en una nueva línea. Usa el enlace <u>Buscar un usuario</u> para encontrar y añadir uno o más nombres de usuarios automáticamente.',
	'USER_NO_BANNED'			=> 'No hay nombres de usuario excluidos',
	'USER_UNBAN'				=> 'Levantar exclusión a usuarios por nombres de usuario',
	'USER_UNBAN_EXPLAIN'		=> 'Puedes quitar la exclusión a múltiples nombres de usuario al mismo tiempo usando la combinación apropiada de ratón y teclado en tu navegador (por ejemplo Ctrl+Clic). Los nombres de usuario <em>excluidos</em> están en negrita.',

));
