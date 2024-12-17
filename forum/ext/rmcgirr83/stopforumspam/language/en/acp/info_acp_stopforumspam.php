<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
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
// Some characters for use
// ’ » “ ” …


$lang = array_merge($lang, [

	// ACP entries
	'ACP_SFS_TITLE'			=> 'Stop Forum Spam',
	'SFS_CONTROL'			=> 'Stop Forum Spam Settings',
	// ACP message logs
	'LOG_SFS_MESSAGE'		=> '<strong>Stop Forum Spam triggered</strong>:<br />Username: %1$s<br />IP: %2$s<br />Email: %3$s',
	'LOG_SFS_DOWN'			=> '<strong>Stop Forum Spam was down during a registration or a forum post</strong>',
	'LOG_SFS_DOWN_USER_ALLOWED' => '<strong>Stop Forum Spam was down.</strong> Following user was allowed on the forum:<br />Username: %1$s<br />IP:%2$s<br />Email: %3$s',
	'LOG_SFS_NEED_CURL'		=> 'The stop forum spam extension needs <strong>cURL</strong> to work correctly. Please speak to your server host to get cURL installed and active.',
	'LOG_SFS_CURL_ERROR'	=> '<strong>Stop Forum Spam cURL error</strong><br>» %1$s',
	'LOG_SFS_CONFIG_SAVED'	=> '<strong>Stop Forum Spam settings changed</strong>',
	'LOG_SFS_REPORTED'		=> '<strong>User was reported to Stop Forum Spam</strong><br>» %1$s',
	'LOG_SFS_PM_REPORTED'	=> '<strong>Users PM was reported to Stop Forum Spam</strong><br>» %1$s',
	'LOG_SFS_REPORTED_CLEARED'	=> 'Reported posts and private messages to stop forum spam were cleared',
	'LOG_ADMINSMODS_CACHE_BUILT'	=> 'Stop forum spam Admins and Mods cache was built',
]);
