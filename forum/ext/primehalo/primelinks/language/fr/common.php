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
	'PRIMELINKS_FORBIDDEN_MSG'		=> '[Lien masqué]',
	'PRIMELINKS_INLINK_GUEST_MSG'	=> '[Lien interne masqué pour les invités]',
	'PRIMELINKS_EXLINK_GUEST_MSG'	=> '[Lien externe masqué pour les invités]',
));
