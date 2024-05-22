<?php
/**
*
* This file is part of the french language pack for the Gym Forum Software package.
*
* @copyright (c) 2020 Dominique Cavailhez
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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'EMAIL_REMIND' => 'Email address associated with your account. If you have not changed it via your user panel, it is the address you provided during registration. From March 2024, if your email is managed by SFR (@sfr.fr @cegetel.fr or @neuf.fr) or less commonly, Microsoft (hotmail.com/fr @live.fr/com or @outlook.com), issues may arise with these providers. Please check your spam folder. If possible, use a different email address to participate on refuges.info. If the issue persists, do not hesitate to contact us via the contact form at <a href="/wiki/contact/">formulaire de contact</a>',
));
