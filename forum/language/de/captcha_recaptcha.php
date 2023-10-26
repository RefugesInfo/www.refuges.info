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
* Deutsche Übersetzung durch die Übersetzer-Gruppe von phpBB.de:
* siehe language/de/AUTHORS.md und https://www.phpbb.de/go/ubersetzerteam
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
	'RECAPTCHA_LANG'				=> 'de',

	'CAPTCHA_RECAPTCHA'				=> 'reCaptcha v2',
	'CAPTCHA_RECAPTCHA_V3'			=> 'reCaptcha v3',

	'RECAPTCHA_INCORRECT'				=> 'Die von dir eingegebene Antwort ist falsch',
	'RECAPTCHA_NOSCRIPT'				=> 'Bitte aktiviere JavaScript in deinem Browser, um die Aufgabe zu laden.',
	'RECAPTCHA_NOT_AVAILABLE'			=> 'Um reCaptcha nutzen zu können, musst du dir ein Konto auf <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a> anlegen.',
	'RECAPTCHA_INVISIBLE'				=> 'Dieses CAPTCHA ist unsichtbar. Wenn es korrekt funktioniert, sollte ein kleines Symbol in der rechten unteren Ecke dieser Seite erscheinen.',
	'RECAPTCHA_V3_LOGIN_ERROR_ATTEMPTS'	=> 'Du hast die maximal zulässige Anzahl von Anmeldeversuchen überschritten.<br>Zur Verifizierung deiner Anmeldung wird neben deinem Benutzernamen und Passwort ein unsichtbares reCAPTCHA v3 genutzt.',

	'RECAPTCHA_PUBLIC'				=> 'Website-Schlüssel',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'Der reCaptcha Website-Schlüssel für deine Seite. Schlüssel können über <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a> bezogen werden. Bitte verwende das unsichtbare reCAPTCHA-Logo in der Version 2 (Typ: reCAPTCHA v2 &gt; Invisible reCAPTCHA badge).',
	'RECAPTCHA_V3_PUBLIC_EXPLAIN'	=> 'Der reCaptcha Website-Schlüssel für deine Seite. Schlüssel können über <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a> bezogen werden. Bitte verwende reCAPTCHA in der Version 3.',
	'RECAPTCHA_PRIVATE'				=> 'Geheimer Schlüssel',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'Dein geheimer reCaptcha-Schlüssel. Schlüssel können über <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a> bezogen werden. Bitte verwende das unsichtbare reCAPTCHA-Logo in der Version 2 (Typ: reCAPTCHA v2 &gt; Invisible reCAPTCHA badge).',
	'RECAPTCHA_V3_PRIVATE_EXPLAIN'	=> 'Dein geheimer reCaptcha-Schlüssel. Schlüssel können über <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a> bezogen werden. Bitte verwende reCAPTCHA in der Version 3.',

	'RECAPTCHA_V3_DOMAIN'				=> 'Domain für Abfrage',
	'RECAPTCHA_V3_DOMAIN_EXPLAIN'		=> 'Die Domain, von der das Script geladen werden soll und die zur Prüfung der Abfrage genutzt wird.<br>Verwende <samp>recaptcha.net</samp>, falls <samp>google.com</samp> nicht erreicht werden kann.',
	
	'RECAPTCHA_V3_METHOD'				=> 'Abfrage-Methode',
	'RECAPTCHA_V3_METHOD_EXPLAIN'		=> 'Die Methode, die zur Prüfung der Abfrage verwendet wird.<br>Deaktivierte Optionen stehen in deiner Konfiguration nicht zur Verfügung.',
	'RECAPTCHA_V3_METHOD_CURL'			=> 'cURL',
	'RECAPTCHA_V3_METHOD_POST'			=> 'POST',
	'RECAPTCHA_V3_METHOD_SOCKET'		=> 'Socket',
	
	'RECAPTCHA_V3_THRESHOLD_DEFAULT'			=> 'Standard-Grenzwert',
	'RECAPTCHA_V3_THRESHOLD_DEFAULT_EXPLAIN'	=> 'Wird verwendet, wenn keine andere Option zutrifft.',
	'RECAPTCHA_V3_THRESHOLD_LOGIN'				=> 'Anmelde-Grenzwert',
	'RECAPTCHA_V3_THRESHOLD_POST'				=> 'Beitrags-Grenzwert',
	'RECAPTCHA_V3_THRESHOLD_REGISTER'			=> 'Registrierungs-Grenzwert',
	'RECAPTCHA_V3_THRESHOLD_REPORT'				=> 'Meldungs-Grenzwert',
	'RECAPTCHA_V3_THRESHOLDS'					=> 'Grenzwerte',
	'RECAPTCHA_V3_THRESHOLDS_EXPLAIN'			=> 'reCAPTCHA v3 gibt einen Wert zurück (<samp>1.0</samp> ist recht sicher ein menschliches Gegenüber, <samp>0.0</samp> ist recht sicher ein Bot). Hier kannst du den Mindestwert für jeden Vorgang festlegen.',
	'EMPTY_RECAPTCHA_V3_REQUEST_METHOD'			=> 'reCAPTCHA v3 muss wissen, welche der verfügbaren Methoden du nutzen willst, wenn die Anfragen verifiziert werden.',
]);
