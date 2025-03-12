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
	'ACCOUNT_REJECTED' => 'Your account has been rejected by BlockBotPosts as you are a robot.',
	'MESSAGE_REJECTED' => 'Your message has been rejected by BlockBotPosts as you are a robot.',
));
