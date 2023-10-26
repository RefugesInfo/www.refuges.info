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
	'ACTIVE_TOPICS'			=> 'Argomenti attivi',
	'ANNOUNCEMENTS'			=> 'Annunci',

	'FORUM_PERMISSIONS'		=> 'Permessi forum',

	'ICON_ANNOUNCEMENT'		=> 'Annuncio',
	'ICON_STICKY'			=> 'Importante',

	'LOGIN_NOTIFY_FORUM'	=> 'Hai ricevuto un avviso per questo forum, accedi per visualizzarlo.',

	'MARK_TOPICS_READ'		=> 'Segna argomenti come già letti',

	'NEW_POSTS_HOT'				=> 'Nuovi messaggi [ Popolari ]',	// Not used anymore
	'NEW_POSTS_LOCKED'			=> 'Nuovi messaggi [ Bloccati ]',	// Not used anymore
	'NO_NEW_POSTS_HOT'			=> 'No nuovi messaggi [ Popolari ]',	// Not used anymore
	'NO_NEW_POSTS_LOCKED'		=> 'No nuovi messaggi [ Bloccati ]',	// Not used anymore
	'NO_READ_ACCESS'            => 'Non hai permessi sufficienti per vedere e leggere gli argomenti di questo forum.',
	'NO_FORUMS_IN_CATEGORY'     => 'Questa categoria non ha forum.', 
	'NO_UNREAD_POSTS_HOT'		=> 'Nessun messaggio da leggere [ Popolare ]',
	'NO_UNREAD_POSTS_LOCKED'	=> 'No messaggi non letti [ Bloccati ]',

	'POST_FORUM_LOCKED'			=> 'Questo forum è bloccato',

	'TOPICS_MARKED'				=> 'Gli argomenti di questo forum sono stati segnati come già letti.',

	'UNREAD_POSTS_HOT'			=> 'Messaggi non letti [ Popolari ]',
	'UNREAD_POSTS_LOCKED'		=> 'Messaggi non letti [ Bloccati ]',

	'VIEW_FORUM'				=> 'Visualizza forum',
	'VIEW_FORUM_TOPICS'			=> array(
		1 => '%d argomento',
		2 => '%d argomenti',
	),
));
