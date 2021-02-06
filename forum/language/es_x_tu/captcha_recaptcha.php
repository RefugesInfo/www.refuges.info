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
	// Find the language/country code on https://developers.google.com/recaptcha/docs/language
	// If no code exists for your language you can use "en" or leave the string empty
	'RECAPTCHA_LANG'				=> 'es',

	'CAPTCHA_RECAPTCHA'				=> 'reCaptcha v2',
	'CAPTCHA_RECAPTCHA_V3'			=> 'reCaptcha v3',

	'RECAPTCHA_INCORRECT'			=> 'La solución que has insertado era incorrecta',
	'RECAPTCHA_NOSCRIPT'			=> 'Por favor, activa JavaScript en tú navegador para cargar el desafío.',
	'RECAPTCHA_NOT_AVAILABLE'		=> 'Para usar reCaptcha, debes crear una cuenta en <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_INVISIBLE'			=> 'Este CAPTCHA es realmente invisible. Para verificar que funciona, debe aparecer un pequeño icono en la esquina inferior derecha de esta página.',

	'RECAPTCHA_PUBLIC'				=> 'Clave del sitio',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'Tu clave de sitio reCAPTCHA. Se pueden obtener las claves en <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Por favor, usa reCAPTCHA v2 &gt; Tipo de insignia invisible reCAPTCHA.',
	'RECAPTCHA_V3_PUBLIC_EXPLAIN'	=> 'Tu clave de sitio reCAPTCHA. Se pueden obtener las claves en <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Por favor, usa reCAPTCHA v3.',
	'RECAPTCHA_PRIVATE'				=> 'Clave secreta',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'Tu clave secreta reCAPTCHA. Se pueden obtener las claves en <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Por favor, usa reCAPTCHA v2 &gt; Tipo de insignia invisible reCAPTCHA.',
	'RECAPTCHA_V3_PRIVATE_EXPLAIN'	=> 'Tu clave secreta reCAPTCHA. Se pueden obtener las claves en <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Por favor, usa reCAPTCHA v3.',

	'RECAPTCHA_V3_DOMAIN'				=> 'Dominio requerido',
	'RECAPTCHA_V3_DOMAIN_EXPLAIN'		=> 'El dominio desde el que se obtiene el script y que se utiliza al verificar la solicitud.<br>Usa <samp>recaptcha.net</samp> cuando <samp>google.com</samp> no esté accesible.',

	'RECAPTCHA_V3_METHOD'				=> 'Método de solicitud',
	'RECAPTCHA_V3_METHOD_EXPLAIN'		=> 'El método a utilizar al verificar la solicitud.<br>Las opciones deshabilitadas no están disponibles en tu configuración.',
	'RECAPTCHA_V3_METHOD_CURL'			=> 'cURL',
	'RECAPTCHA_V3_METHOD_POST'			=> 'POST',
	'RECAPTCHA_V3_METHOD_SOCKET'		=> 'Enchufe (Socket)',

	'RECAPTCHA_V3_THRESHOLD_DEFAULT'			=> 'Límite predeterminado',
	'RECAPTCHA_V3_THRESHOLD_DEFAULT_EXPLAIN'	=> 'Se usa cuando ninguna de las otras acciones son aplicables.',
	'RECAPTCHA_V3_THRESHOLD_LOGIN'				=> 'Límite de inicio de sesión',
	'RECAPTCHA_V3_THRESHOLD_POST'				=> 'Límite de mensaje',
	'RECAPTCHA_V3_THRESHOLD_REGISTER'			=> 'Límite de registro',
	'RECAPTCHA_V3_THRESHOLD_REPORT'				=> 'Límite de reportar',
	'RECAPTCHA_V3_THRESHOLDS'					=> 'Límites',
	'RECAPTCHA_V3_THRESHOLDS_EXPLAIN'			=> 'reCAPTCHA v3 devuelve una puntuación (<samp>1.0</samp> es muy probable que sea una buena interacción, <samp>0.0</samp> es muy probable que sea un robot). Aquí puedes establecer la puntuación mínimo por acción.',
	'EMPTY_RECAPTCHA_V3_REQUEST_METHOD'			=> 'reCAPTCHA v3 requiere saber qué método disponible deseas utilizar al verificar la solicitud.',
]);
