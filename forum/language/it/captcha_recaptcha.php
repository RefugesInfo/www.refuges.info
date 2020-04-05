<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010 phpBB.it
* @copyright (c) 2014 phpBBItalia.net <https://www.phpbbitalia.net>
* @copyright (c) 2020 phpBB-Store.it <https://www.phpbb-store.it>
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
	'RECAPTCHA_LANG'				=> 'it', // Trova il codice Lingua / Paese https://developers.google.com/recaptcha/docs/language - Se non esiste alcun codice per la tua lingua, puoi usare "en" o lasciare la stringa vuota
	'RECAPTCHA_NOT_AVAILABLE'		=> 'Per poter utilizzare reCaptcha, è necessario creare un account su <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'CAPTCHA_RECAPTCHA'				=> 'reCaptcha',
	'RECAPTCHA_INCORRECT'			=> 'La soluzione che hai inviato non è corretta',
	'RECAPTCHA_NOSCRIPT'			=> 'Abilita JavaScript nel tuo browser per caricare il test antispam.',

	'RECAPTCHA_PUBLIC'				=> 'Chiave del sito',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'La tua chiave reCaptcha del sito. Le chiavi possono essere ottenute su <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>. Per favore, usa reCAPTCHA v2 &gt; tipo di simbolo reCAPTCHA invisibile.',
	'RECAPTCHA_PRIVATE'				=> 'Chiave segreta',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'La tua chiave reCaptcha segreta. Le chiavi possono essere ottenute su <a href="http://www.google.com/recaptcha">www.google.com/recaptcha</a>. Per favore, usa reCAPTCHA v2 &gt; tipo di simbolo reCAPTCHA invisibile.',
	'RECAPTCHA_INVISIBLE'			=> 'Questo CAPTCHA è in realtà invisibile. Per verificare che funzioni, dovrebbe apparire una piccola icona nell’angolo in basso a destra di questa pagina.',
));
