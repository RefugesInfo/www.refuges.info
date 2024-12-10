<?php
/**
*
* Contact admin extension for the phpBB Forum Software package.
*
* @copyright 2016 Rich McGirr (RMcGirr83)
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
	// General config options
	'ACP_CAT_CONTACTADMIN'	=> 'Formulaire de contact du forum',
	'ACP_CONTACTADMIN_CONFIG'	=> 'Paramètres',
	'FORUM_EMAIL_INACTIVE'	=> 'Comment voulez-vous que les utilisateurs puissent entrer en contact.<br><span style="color:red;">Aucun e-mail autorisé par les paramètres du forum</span>',
	'NO_FORUM_ATTACHMENTS'		=> 'Si les pièces jointes sont définies, elles seront autorisées dans la publication sur le forum et les messages privés. Les extensions autorisées sont les mêmes que la configuration du forum.<br><span style="color:red;">Aucune pièce jointe autorisée par les paramètres du forum !</span>',
	// Log entries
	'LOG_CONFIG_CONTACT_ADMIN'		=> '<strong>Modification des paramètres de la page de l‘extension du formulaire de contact</strong>',
	'LOG_CONTACT_BOT_INVALID'		=> '<strong>Le robot du formulaire de contact contact a un identifiant non valide pour l‘utilisateur sélectionné :</strong><br />ID utilisateur %1$s',
	'LOG_CONTACT_FORUM_INVALID'		=> '<strong>Le forum sélectionné pour le formulaire de contact est non valide :</strong><br />ID du forum %1$s',
	'LOG_CONTACT_EMAIL_INVALID'		=> '<strong>Le formulaire de contact autorise les e-mails, mais le forum n‘est pas configuré pour autoriser pour les utiliser.  L‘extension a été désactivée.',
	'LOG_CONTACT_NONE'				=> '<strong>Aucun administrateur n‘autorise les utilisateurs à les contacter via %1$s dans le formulaire de contact</strong>',
	'LOG_CONTACT_CONFIG_UPDATE'		=> '<strong>Paramètres de configuration du formulaire de contact mis à jour</strong>',
	//Donation
	'PAYPAL_IMAGE_URL'          => 'https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-26px.png',
	'PAYPAL_ALT'                => 'Faire un don avec PayPal',
	'BUY_ME_A_BEER_URL'         => 'https://paypal.me/RMcGirr83',
	'BUY_ME_A_BEER'				=> 'Payez-moi une bière pour la création de cette extension',
	'BUY_ME_A_BEER_SHORT'		=> 'Faites un don pour cette extension',
	'BUY_ME_A_BEER_EXPLAIN'		=> 'Cette extension est totalement gratuite. C‘est un projet sur lequel je passe mon temps pour le plaisir et l‘utilisation de la communauté phpBB. Si vous aimez utiliser cette extension, ou si elle a profité à votre forum, veuillez considérer que <a href="https://paypal.me/RMcGirr83" target="_blank" rel="noreferrer noopener">me payer une bière</a> serait vraiment aprécié. <i class="fa fa-smile-o" style="color:green;font-size:1.5em;" aria-hidden="true"></i>',
]);
