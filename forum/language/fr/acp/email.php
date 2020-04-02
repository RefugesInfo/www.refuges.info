<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
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

// Email settings
$lang = array_merge($lang, array(
	'ACP_MASS_EMAIL_EXPLAIN'		=> 'Vous pouvez envoyer un courriel à tous vos membres ayant activé l’option « Recevoir les courriels des administrateurs », individuellement ou aux membres d’un groupe en particulier. Pour cela, un courriel sera envoyé depuis l’adresse administrative et tous les destinataires seront en copie cachée. Par défaut, un courriel est limité à 20 destinataires ; au-delà de ce nombre et pour chaque tranche de 20 destinataires un nouveau courriel sera émis. Si vous envoyez le message à un grand groupe de personnes, veuillez patienter après avoir validé et de ne pas arrêter la page lors du traitement. Il est normal qu’un envoi de masse prenne du temps, vous serez informé lorsque le script sera terminé',
	'ALL_USERS'						=> 'Tous les membres',

	'COMPOSE'				=> 'Écrire',

	'EMAIL_SEND_ERROR'		=> 'Il y a eu une erreur lors de l’envoi du courriel. Merci de consulter le %sJournal des erreurs%s pour un message plus détaillé.',
	'EMAIL_SENT'			=> 'Votre message a été envoyé.',
	'EMAIL_SENT_QUEUE'		=> 'Votre message a été mis en attente pour l’envoi.',

	'LOG_SESSION'			=> 'Enregistre la session mail dans le journal des erreurs critiques', // clé non utilisée par phpBB

	'SEND_IMMEDIATELY'		=> 'Envoyer immédiatement',
	'SEND_TO_GROUP'			=> 'Envoyer au groupe',
	'SEND_TO_USERS'			=> 'Envoyer aux membres',
	'SEND_TO_USERS_EXPLAIN'	=> 'Saisir des noms ici écrasera tout groupe sélectionné ci-dessus. Saisissez chaque nom d’utilisateur sur une ligne différente.',

	'MAIL_BANNED'			=> 'Envoyer aux membres bannis',
	'MAIL_BANNED_EXPLAIN'	=> 'Si vous cochez cette case, les membres bannis recevront aussi ce courriel de masse.',
	'MAIL_HIGH_PRIORITY'	=> 'Haute',
	'MAIL_LOW_PRIORITY'		=> 'Basse',
	'MAIL_NORMAL_PRIORITY'	=> 'Normale',
	'MAIL_PRIORITY'			=> 'Priorité du courriel',
	'MASS_MESSAGE'			=> 'Votre message',
	'MASS_MESSAGE_EXPLAIN'	=> 'Notez que vous ne pouvez mettre que du texte brut. Toutes les balises seront supprimées avant l’envoi.',

	'NO_EMAIL_MESSAGE'		=> 'Vous devez saisir un message.',
	'NO_EMAIL_SUBJECT'		=> 'Vous devez indiquer un sujet pour votre message.',
));
