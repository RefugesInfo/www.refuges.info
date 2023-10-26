<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @copyright (c) 2010 phpBB.it
* @copyright (c) 2014 phpBBItalia.net <https://www.phpbbitalia.net>
* @copyright (c) 2018 phpBB-Store.it <https://www.phpbb-store.it>
* @copyright (c) 2021 phpBB-Italia.it <https://www.phpbb-italia.it>
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
// Trova il codice della lingua / del paese su https://developers.google.com/recaptcha/docs/language
// Se non esistesse un codice per la tua lingua puoi usare "en" o lasciare la stringa vuota
	'RECAPTCHA_LANG'				=> 'it', 
	'CAPTCHA_RECAPTCHA'				=> 'reCaptcha v2',
	'CAPTCHA_RECAPTCHA_V3'			=> 'reCaptcha v3',
	'RECAPTCHA_INCORRECT'			=> 'La soluzione che hai inviato non è corretta',
	'RECAPTCHA_NOSCRIPT'			=> 'Abilita JavaScript nel tuo browser per caricare il test antispam.',
	'RECAPTCHA_NOT_AVAILABLE'		=> 'Per utilizzare reCaptcha, devi creare un account su <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_INVISIBLE'			=> 'Questo CAPTCHA è in realtà invisibile. Per verificare che funzioni, dovrebbe apparire una piccola icona nell’angolo inferiore destro di questa pagina.',
	'RECAPTCHA_V3_LOGIN_ERROR_ATTEMPTS'	=> 'Hai superato il numero massimo di tentativi di accesso consentiti.<br>Oltre al nome utente e alla password, verrà utilizzato reCAPTCHA v3 invisibile per autenticare la sessione.',

	'RECAPTCHA_PUBLIC'				=> 'Chiave del sito',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'La tua chiave reCaptcha del sito. Le chiavi possono essere ottenute su <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Per favore, usa reCAPTCHA v2 &gt; tipo di simbolo reCAPTCHA invisibile.',
	'RECAPTCHA_V3_PUBLIC_EXPLAIN'	=> 'La tua chiave reCaptcha del sito. Le chiavi possono essere ottenute su <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Per favore, usa reCAPTCHA v3.',
	'RECAPTCHA_PRIVATE'				=> 'Chiave segreta',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'La tua chiave reCaptcha segreta. Le chiavi possono essere ottenute su <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Per favore, usa reCAPTCHA v2 &gt; tipo di simbolo reCAPTCHA invisibile.',
	'RECAPTCHA_V3_PRIVATE_EXPLAIN'	=> 'La tua chiave reCaptcha segreta. Le chiavi possono essere ottenute su <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Per favore, usa reCAPTCHA v3.',
	'RECAPTCHA_V3_DOMAIN'				=> 'Richiedi dominio',
	'RECAPTCHA_V3_DOMAIN_EXPLAIN'		=> 'Il dominio da cui recuperare lo script e da utilizzare durante la verifica della richiesta. <br> Utilizza <samp>recaptcha.net</samp> quando <samp>google.com</samp> non è accessibile.',

	'RECAPTCHA_V3_METHOD'				=> 'Metodo di richiesta',
	'RECAPTCHA_V3_METHOD_EXPLAIN'		=> 'Il metodo da utilizzare durante la verifica della richiesta. <br> Le opzioni disabilitate non sono disponibili nella configurazione.',
	'RECAPTCHA_V3_METHOD_CURL'			=> 'cURL',
	'RECAPTCHA_V3_METHOD_POST'			=> 'POST',
	'RECAPTCHA_V3_METHOD_SOCKET'		=> 'Socket',

	'RECAPTCHA_V3_THRESHOLD_DEFAULT'			=> 'Soglia predefinita',
	'RECAPTCHA_V3_THRESHOLD_DEFAULT_EXPLAIN'	=> 'Utilizzato quando nessuna delle altre azioni è applicabile.',
	'RECAPTCHA_V3_THRESHOLD_LOGIN'				=> 'Soglia di accesso',
	'RECAPTCHA_V3_THRESHOLD_POST'				=> 'Soglia messaggio',
	'RECAPTCHA_V3_THRESHOLD_REGISTER'			=> 'Soglia registro',
	'RECAPTCHA_V3_THRESHOLD_REPORT'				=> 'Soglia rapporto',
	'RECAPTCHA_V3_THRESHOLDS'					=> 'Soglie',
	'RECAPTCHA_V3_THRESHOLDS_EXPLAIN'			=> 'reCAPTCHA v3 restituisce un punteggio (<samp>1.0</samp> è molto probabilmente una buona interazione, <samp>0.0</samp> è molto probabilmente un bot). Qui puoi impostare il punteggio minimo per azione.',
    'EMPTY_RECAPTCHA_V3_REQUEST_METHOD'			=> 'reCAPTCHA v3 richiede di sapere quale metodo disponibile si desidera utilizzare durante la verifica della richiesta.',
]);
