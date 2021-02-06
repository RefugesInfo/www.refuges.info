<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, [
	// Find the language/country code on https://developers.google.com/recaptcha/docs/language
	// If no code exists for your language you can use "en" or leave the string empty
	'RECAPTCHA_LANG'				=> 'fr',

	'CAPTCHA_RECAPTCHA'				=> 'reCAPTCHA v2',
	'CAPTCHA_RECAPTCHA_V3'			=> 'reCAPTCHA v3',

	'RECAPTCHA_INCORRECT'			=> 'La solution que vous avez fournie est incorrecte',
	'RECAPTCHA_NOSCRIPT'			=> 'Veuillez activer JavaScript dans votre navigateur pour charger ce CAPTCHA.',
	'RECAPTCHA_NOT_AVAILABLE'		=> 'Afin d’utiliser reCAPTCHA, vous devez créer un compte sur <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>.',
	'RECAPTCHA_INVISIBLE'			=> 'Il s’agit d’un CAPTCHA invisible. Pour verifier qu’il fonctionne, une petite icône devrait apparaître dans le coin inférieur droit de cette page.',

	'RECAPTCHA_PUBLIC'				=> 'Clé du site reCAPTCHA',
	'RECAPTCHA_PUBLIC_EXPLAIN'		=> 'Votre clé du site reCAPTCHA. La clé peut être obtenue sur <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Veuillez utiliser reCAPTCHA v2 &gt; type de badge reCAPTCHA invisible.',
	'RECAPTCHA_V3_PUBLIC_EXPLAIN'	=> 'Votre clé du site reCAPTCHA. La clé peut être obtenue sur <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Veuillez utiliser reCAPTCHA v3.',
	'RECAPTCHA_PRIVATE'				=> 'Clé secrète reCAPTCHA',
	'RECAPTCHA_PRIVATE_EXPLAIN'		=> 'Votre clé secrète reCAPTCHA. La clé peut être obtenue sur <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>. Veuillez utiliser reCAPTCHA v2 &gt; type de badge reCAPTCHA invisible.',
	'RECAPTCHA_V3_PRIVATE_EXPLAIN'	=> 'Votre clé secrète reCAPTCHA. La clé peut être obtenue sur <a href="https://www.google.com/recaptcha">www.google.com/recaptcha</a>.  Veuillez utiliser reCAPTCHA v3.',

	'RECAPTCHA_V3_DOMAIN'				=> 'Nom de domaine pour vérifier la demande',
	'RECAPTCHA_V3_DOMAIN_EXPLAIN'		=> 'Nom de domaine à partir duquel récupérer le script et à utiliser lors de la vérification de la demande.<br>Utilisez le domaine <samp>recaptcha.net</samp> quand <samp>google.com</samp> n’est pas accessible.',

	'RECAPTCHA_V3_METHOD'				=> 'Méthode pour vérifier la demande',
	'RECAPTCHA_V3_METHOD_EXPLAIN'		=> 'Méthode à utiliser lors de la vérification de la demande.<br>Les options désactivées ne sont pas disponibles dans votre configuration.',
	'RECAPTCHA_V3_METHOD_CURL'			=> 'cURL',
	'RECAPTCHA_V3_METHOD_POST'			=> 'POST',
	'RECAPTCHA_V3_METHOD_SOCKET'		=> 'Socket',

	'RECAPTCHA_V3_THRESHOLD_DEFAULT'			=> 'Seuil par défaut',
	'RECAPTCHA_V3_THRESHOLD_DEFAULT_EXPLAIN'	=> 'Utilisé quand aucune des autres actions n’est applicable.',
	'RECAPTCHA_V3_THRESHOLD_LOGIN'				=> 'Seuil de connexion',
	'RECAPTCHA_V3_THRESHOLD_POST'				=> 'Seuil de message',
	'RECAPTCHA_V3_THRESHOLD_REGISTER'			=> 'Seuil d’enregistrement',
	'RECAPTCHA_V3_THRESHOLD_REPORT'				=> 'Seuil de rapport',
	'RECAPTCHA_V3_THRESHOLDS'					=> 'Seuil',
	'RECAPTCHA_V3_THRESHOLDS_EXPLAIN'			=> 'reCAPTCHA v3 retourne un score (<samp>1.0</samp> est très probablement une bonne interaction, <samp>0.0</samp> est très probablement un robot). Ici, vous pouvez définir le score minimum par action.',
	'EMPTY_RECAPTCHA_V3_REQUEST_METHOD'			=> 'reCAPTCHA v3 doit savoir quelle méthode disponible vous souhaitez utiliser lors de la vérification de la demande.',
]);
