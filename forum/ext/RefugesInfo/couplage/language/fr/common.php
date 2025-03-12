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
	'EMAIL_REMIND' => 'Adresse courriel associée à votre compte. Si vous ne l’avez pas modifiée via votre panneau d’utilisateur, il s’agit de l’adresse que vous avez fournie lors de votre enregistrement.<br/><br/>'.
	'<span style="color:red">A partir de Mars 2024 si votre email est géré chez SFR (@sfr.fr @cegetel.fr ou @neuf.fr) ou plus rarement, Microsoft (hotmail.com/fr @live.fr/com ou @outlook.com), des problèmes sont rencontrés avec ces prestataires. Vérifiez dans le répertoire indésirables. Si cela vous est possible, utilisez une autre adresse email pour participer sur refuges.info</span><br/> Si le problème persiste, n\'hesitez pas à nous contacter via le <a href="/wiki/contact/">formulaire de contact</a>',
));
