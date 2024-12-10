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
	'ACP_CAT_CONTACTADMIN'	=> 'Contact Admin',
	'ACP_CONTACTADMIN_CONFIG'	=> 'Configuration',
	'FORUM_EMAIL_INACTIVE'	=> 'How do you want users to be able to make contact.<br><span style="color:red;">No email allowed per forum settings</span>',
	'NO_FORUM_ATTACHMENTS'		=> 'If set attachments will be allowed in posting to the forum and private messages. The extensions allowed are the same as the board configuration.<br><span style="color:red;">No attachments allowed per forum settings!</span>',
	// Log entries
	'LOG_CONFIG_CONTACT_ADMIN'		=> '<strong>Altered Contact Admin extension page settings</strong>',
	'LOG_CONTACT_BOT_INVALID'		=> '<strong>The Contact Admin extension bot has an invalid user id selected:</strong><br />User ID %1$s',
	'LOG_CONTACT_FORUM_INVALID'		=> '<strong>The Contact Admin extension forum has an invalid forum selected:</strong><br />Forum ID %1$s',
	'LOG_CONTACT_EMAIL_INVALID'		=> '<strong>The Contact Admin extension is allowing emails but the forum is not setup to allow emails.  The extension has been disabled.',
	'LOG_CONTACT_NONE'				=> '<strong>No Administrators are allowing users to contact them via %1$s in the Contact Admin extension</strong>',
	'LOG_CONTACT_CONFIG_UPDATE'		=> '<strong>Updated Contact Admin config settings</strong>',
	//Donation
	'PAYPAL_IMAGE_URL'          => 'https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-26px.png',
	'PAYPAL_ALT'                => 'Donate using PayPal',
	'BUY_ME_A_BEER_URL'         => 'https://paypal.me/RMcGirr83',
	'BUY_ME_A_BEER'				=> 'Buy me a beer for creating this extension',
	'BUY_ME_A_BEER_SHORT'		=> 'Make a donation for this extension',
	'BUY_ME_A_BEER_EXPLAIN'		=> 'This extension is completely free. It is a project that I spend my time on for the enjoyment and use of the phpBB community. If you enjoy using this extension, or if it has benefited your forum, please consider <a href="https://paypal.me/RMcGirr83" target="_blank" rel="noreferrer noopener">buying me a beer</a>. It would be greatly appreciated. <i class="fa fa-smile-o" style="color:green;font-size:1.5em;" aria-hidden="true"></i>',
]);
