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
	'EMAIL_REMIND' => 'Adresse courriel associée à votre compte. Si vous ne l’avez pas modifiée via votre panneau d’utilisateur, il s’agit de l’adresse que vous avez fournie lors de votre enregistrement.<br/><br/>'.
	'<span style="color:red">A partir de Mars 2024 si votre email est géré chez SFR (@sfr.fr @cegetel.fr ou @neuf.fr) ou plus rarement, Microsoft (hotmail.com/fr @live.fr/com ou @outlook.com), des problèmes sont rencontrés avec ces prestataires. Vérifiez dans le répertoire indésirables. Si cela vous est possible, utilisez une autre adresse email pour participer sur refuges.info</span><br/> Si le problème persiste, n\'hesitez pas à nous contacter via le <a href="/wiki/contact/">formulaire de contact</a>',
));
