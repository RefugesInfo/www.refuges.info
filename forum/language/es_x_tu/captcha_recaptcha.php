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
	'RECAPTCHA_LANG'				=> 'es', // Busca el código de idioma / país en https://developers.google.com/recaptcha/docs/language. Si no existe un código para tu idioma, puedes usar "en" o dejar la cadena vacía.
	'RECAPTCHA_NOT_AVAILABLE'		=> 'Para poder usar reCaptcha, debes crear una cuenta en <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'CAPTCHA_RECAPTCHA'				=> 'reCaptcha',
	'RECAPTCHA_INCORRECT'			=> 'La solución que has insertado era incorrecta',
	'RECAPTCHA_NOSCRIPT'			=> 'Por favor, activa JavaScript en tú navegador para cargar el desafío.',

	'RECAPTCHA_PUBLIC'				=> 'Clave pública reCaptcha',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'Tu clave pública reCaptcha. Se pueden obtener las claves en <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_PRIVATE'				=> 'Clave Privada reCaptcha',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'Tu clave privada reCaptcha. Se pueden obtener las claves en <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',

	'RECAPTCHA_EXPLAIN'				=> 'En un esfuerzo por prevenir insersiones automáticas requerimos que completes el siguiente desafio.',
));
