<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 * @translated by Raul [TheE KuKa] https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=94590
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
	'PRIMELINKS_FORBIDDEN_MSG'		=> '[Enlace prohibido eliminado]',
	'PRIMELINKS_INLINK_GUEST_MSG'	=> '[Enlace local eliminado para invitados]',
	'PRIMELINKS_EXLINK_GUEST_MSG'	=> '[Enlace externo eliminado para invitados]',
));
