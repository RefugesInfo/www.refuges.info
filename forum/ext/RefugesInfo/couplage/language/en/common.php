<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'EMAIL_REMIND' => 'Email address associated with your account. If you have not changed it via your user panel, it is the address you provided during registration. From March 2024, if your email is managed by SFR (@sfr.fr @cegetel.fr or @neuf.fr) or less commonly, Microsoft (hotmail.com/fr @live.fr/com or @outlook.com), issues may arise with these providers. Please check your spam folder. If possible, use a different email address to participate on refuges.info. If the issue persists, do not hesitate to contact us via the contact form at <a href="/wiki/contact/">formulaire de contact</a>',
));
