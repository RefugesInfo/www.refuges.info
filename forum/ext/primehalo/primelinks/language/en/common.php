<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'PRIMELINKS_FORBIDDEN_MSG'		=> '[Forbidden Link Removed]',
	'PRIMELINKS_INLINK_GUEST_MSG'	=> '[Local Link Removed for Guests]',
	'PRIMELINKS_EXLINK_GUEST_MSG'	=> '[External Link Removed for Guests]',
));
