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
	'ACCOUNT_REJECTED' => 'Votre compte a été rejeté par BlockBotPosts car vous êtes un robot.',
	'MESSAGE_REJECTED' => 'Votre message a été rejeté par BlockBotPosts car vous êtes un robot.',
));
