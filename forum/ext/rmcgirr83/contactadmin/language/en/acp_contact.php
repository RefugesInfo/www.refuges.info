<?php
/**
*
* Contact Admin extension for the phpBB Forum Software package.
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
	'ADMINS_NOT_EXIST_FOR_METHOD'	=> [
		0 => 'There are no Administrators who allow emails.  You must choose a different method of contact.',
		2 => 'There are no Administrators who allow private messages. You must choose a different method of contact.',
	],
	'CONTACT_CONFIG_SAVED'			=> 'Contact Admin configuration has been updated',
	'CONTACT_ACP_CONFIRM'				=> 'Enable visual confirmation',
	'CONTACT_ACP_CONFIRM_EXPLAIN'		=> 'If you enable this option, users will have to enter a visual confirmation to send the message.<br>This is to prevent spam messages. Note that this option is for the contact page only.  It does not affect other visual confirmation settings',
	'CONTACT_ATTACHMENTS'				=> 'Attachments allowed',
	'CONTACT_ATTACHMENTS_EXPLAIN'		=> 'If set attachments will be allowed in posting to the forum and private messages.<br>The extensions allowed are the same as the board configuration.<br><span style="color:red;">Does not apply for contact method via “EMail”.</span>',
	'CONTACT_CONFIRM_GUESTS'			=> 'Visual confirmation for guests only',
	'CONTACT_CONFIRM_GUESTS_EXPLAIN'	=> 'If this option is enabled, the visual confirmation is only displayed to guests (if it’s enabled)',
	'CONTACT_WHO'						=> 'Who to contact',
	'CONTACT_WHO_EXPLAIN'				=> 'Who should be contacted via Email or PM',
	'CONTACT_MAX_ATTEMPTS'				=> 'Maximum confirmation attempts',
	'CONTACT_MAX_ATTEMPTS_EXPLAIN'		=> 'How many times may a user attempt to enter the correct confirmation image?<br>Enter 0 for unlimited attempts',
	'CONTACT_METHOD'					=> 'Contact method',
	'CONTACT_METHOD_EXPLAIN'			=> 'How do you want users to be able to make contact',
	'CONTACT_POST_OPTIONS'				=> 'Contact Post or PM Options',
	'CONTACT_REASONS'					=> 'Contact reasons',
	'CONTACT_REASONS_EXPLAIN'			=> 'Enter reasons for contacting, separated by new lines.<br>If you don’t want to use this feature, leave this field empty',
	// Bot config options
	'CONTACT_BOT_FORUM'				=> 'Contact bot forum',
	'CONTACT_BOT_FORUM_EXPLAIN'		=> 'Select the forum, where the contact bot should post to, if the contact method is set to “Forum post”',
	'CONTACT_BOT_POSTER'			=> 'Bot as Poster',
	'CONTACT_BOT_POSTER_EXPLAIN'	=> 'If set PM’s and posts will seem to come from the contact bot user chosen above based on the settings here. If “Neither” is selected then the bot is not used as the poster.  Posts and PM’s will be posted based on the information entered in the contact form',
	'CONTACT_BOT_USER'				=> 'Contact bot user',
	'CONTACT_BOT_USER_EXPLAIN'		=> 'Select the user that messages will be posted under if the contact method is set to “Private Message” or “Forum Post”.',
	'CONTACT_NO_BOT_USER'			=> '<strong>The contact bot user id chosen does not exist</strong>',
	'CONTACT_BOT_IS_BOT'			=> '<strong>The contact bot chosen is designated as a bot of the forum. Are you sure you want this user as the bot?</strong>',
	'CONTACT_USERNAME_CHK'			=> 'Check Username',
	'CONTACT_USERNAME_CHK_EXPLAIN'	=> 'If set yes, the user’s name that is entered will be checked against those in the database. If the name is found the user will be presented with an error and asked to input a different user name',
	'CONTACT_EMAIL_CHK'				=> 'Check Email',
	'CONTACT_EMAIL_CHK_EXPLAIN'		=> 'If set yes, the user’s email address will be checked against those in the database. If the email address is found the user will be presented with an error and asked to input a different email address',

	// Contact methods
	'CONTACT_METHOD_EMAIL'			=> 'Email',
	'CONTACT_METHOD_PM'				=> 'Private message',
	'CONTACT_METHOD_POST'			=> 'Forum post',

	// Contact methods
	'CONTACT_WHO_ALL_ADMINS'		=> 'All Admins',
	'CONTACT_WHO_BOARD_FOUNDER'		=> 'Board Founder',
	'CONTACT_WHO_BOARD_DEFAULT'	=> 'Board Default Email',

	// Contact posters...user bot
	'CONTACT_POST_NEITHER'			=> 'Neither',
	'CONTACT_POST_GUEST'			=> 'Guests only',
	'CONTACT_POST_ALL'				=> 'Everyone',

	// Overwrite the default contact page lang
	'CONTACT_EXTENSION_ACTIVE'	=> '<span style="color:red;">The settings here will not matter as you currently have the contact admin extension enabled. You will not be able to set this to enabled without first disabling the extension</span>',
	'CONTACT_GDPR'	=> 'GDPR',
	'CONTACT_GDPR_EXPLAIN' => 'If set yes, the user will be presented with a check box to acknowledge the boards privacy policy. The box must be checked for the contact form to be submitted',
	'EMAIL_NOT_CONFIGURED' => 'Email isn’t configured for the board, please make a different selection for the contact method',
]);
