<?php
/**
*
* Contact admin extension for the phpBB Forum Software package.
*
* @copyright 2016 Rich McGirr (RMcGirr83)
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
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [
	'ACP_CAT_CONTACTADMIN'		=> 'Contacter l‘administrateur',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'Si vous souhaitez joindre un fichier, entrez les détails ci-dessous.',
	'CONTACT_ERROR'			=> 'Vous ne pouvez pas utiliser le formulaire de contact pour le moment car il y a une erreur dans la configuration. Un email a été envoyé au fondateur.',
	'CONTACT_NONE'			=> 'L‘utilisateur %1$s a essayé d‘utiliser l‘extension "Contacter l‘administrateur" à %2$s pour envoyer un %3$s, mais aucun admnistrateur n‘autorise %3$ss pour les utilisateurs. Aller au panneau de configuration de l‘extension %4$s pour choisir une autre méthode de contact',
	'CONTACT_BOT_SUBJECT'		=> 'Erreur avec l‘extension Contacter un administrateur',
	'CONTACT_BOT_MESSAGE'	=> 'L‘utilisateur %1$s a essayé d‘utiliser l‘extension "Contacter l‘administrateur" à %2$s, mais le %3$s sélectionné dans la configuration est incorrect. Aller au panneau de configuration de l‘extension %4$s et choisir une autre %3$s dans les paramètres de l‘extension.',
	'CONTACT_CONFIRM'			=> 'Confirmer',
	'CONTACT_DISABLED'			=> 'Vous ne pouvez pas utiliser le formulaire de contact pour le moment car il est désactivé.',
	'CONTACT_MAIL_DISABLED'		=> 'Une erreur s‘est produite lors de la configuration de l‘extension. L‘extension est configurée pour envoyer un e-mail, mais la configuration du forum n‘est pas configurée pour envoyer des e-mails. Merci d‘en avertir les %sadministrateurs du forum%s',
	'CONTACT_MSG_SENT'			=> 'Votre message a été envoyé avec succès',
	'CONTACT_NO_MSG'			=> 'Vous n‘avez pas saisi de message',
	'CONTACT_NO_SUBJ'			=> 'Vous n‘avez pas saisi de sujet',
	'CONTACT_REASON'			=> 'Raison',
	'CONTACT_TEMPLATE'			=> '[b]Nom :[/b] %1$s' . "\n" . '[b]Adresse e-mail :[/b] %2$s' . "\n" . '[b]IP :[/b] %3$s' . "\n" . '[b]Sujet :[/b] %4$s' . "\n" . '[b]À écrit le message suivant dans le formulaire de contact :[/b] %5$s',
	'CONTACT_TITLE'				=> 'Contacter l‘dministration',

	'CONTACT_YOUR_NAME'			=> 'Votre nom',
	'CONTACT_YOUR_NAME_EXPLAIN'	=> 'Veuillez entrer votre nom afin que le message ait une identité.',
	'CONTACT_YOUR_EMAIL'		=> 'Votre adresse e-mail',
	'CONTACT_YOUR_EMAIL_EXPLAIN'	=> 'Veuillez saisir une adresse e-mail valide pour éventuellement vous contacter.',
	'CONTACT_YOUR_EMAIL_CONFIRM'	=> 'Confirmation de l‘adresse e-mail',
	'WRONG_DATA_EMAIL'			=> 'Les adresses e-mail ne correspondent pas',

	'TOO_MANY_CONTACT_TRIES'	=> 'Vous avez dépassé le nombre maximal de tentatives pour cette session. Veuillez réessayer plus tard.',
	'CONTACT_NO_NAME'			=> 'Vous n‘avez pas saisi de nom',
	'FORUM'						=> 'forum',
	'USER'						=> 'utilisateur',
	'CONTACT_REGISTERED'		=> 'Utilisateur enregistré',
	'CONTACT_GUEST'				=> 'Visiteur',

	'REASON_EXPLAIN'			=> 'Merci de choisir une raison',
	'REASON_ERROR'				=> 'Veuillez choisir une raison appropriée',
	'RETURN_CONTACT'			=> '%sRevenir à la page contact%s',
]);
