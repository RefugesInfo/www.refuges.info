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
	'ACP_CAT_CONTACTADMIN'		=> 'Contact Admin',
	'ADD_ATTACHMENT_EXPLAIN'	=> 'If you wish to attach a file enter the details below.',
	'CONTACT_ERROR'			=> 'You can’t use the contact form at the moment because there is an error in the configuration.  An email has been sent to the founder.',
	'CONTACT_NONE'			=> 'The user %1$s tried to use the Contact Admin extension at %2$s to send a %3$s, but there are no Administrators that allow %3$ss by users. Please enter the Contact Admin Configuration in the Admin Extension Panel for the board %4$s and choose a different method for contact',
	'CONTACT_BOT_SUBJECT'		=> 'Contact Admin Extension Error',
	'CONTACT_BOT_MESSAGE'	=> 'The user %1$s tried to use the Contact Admin extension at %2$s, but the %3$s selected in the configuration is incorrect. Please visit the board %4$s and choose a different %3$s in the settings for the Contact Administration Extension.',
	'CONTACT_CONFIRM'			=> 'Confirm',
	'CONTACT_DISABLED'			=> 'You can’t use the contact form at the moment because it is disabled.',
	'CONTACT_MAIL_DISABLED'		=> 'There is an error with the configuration of the Contact  Admin extension. The extension is set to send an email but the board configuration isn’t setup to send emails.  Please notify the %sBoard Administrator%s',
	'CONTACT_MSG_SENT'			=> 'Your message has been sent successfully',
	'CONTACT_NO_MSG'			=> 'You didn’t enter a message',
	'CONTACT_NO_SUBJ'			=> 'You didn’t enter a subject',
	'CONTACT_REASON'			=> 'Reason',
	'CONTACT_TEMPLATE'			=> '[b]Name:[/b] %1$s' . "\n" . '[b]Email Address:[/b] %2$s' . "\n" . '[b]IP:[/b] %3$s' . "\n" . '[b]Subject:[/b] %4$s' . "\n" . '[b]Has entered the following message into the contact form:[/b] %5$s',
	'CONTACT_TITLE'				=> 'Contact Administration',

	'CONTACT_YOUR_NAME'			=> 'Your name',
	'CONTACT_YOUR_NAME_EXPLAIN'	=> 'Please enter your name, so the message has an identity.',
	'CONTACT_YOUR_EMAIL'		=> 'Your email address',
	'CONTACT_YOUR_EMAIL_EXPLAIN'	=> 'Please enter a valid email address, so we can contact you.',
	'CONTACT_YOUR_EMAIL_CONFIRM'	=> 'Confirm email address',
	'WRONG_DATA_EMAIL'			=> 'The email addresses don’t match',

	'TOO_MANY_CONTACT_TRIES'	=> 'You have exceeded the maximum number of attempts for this session. Please try again later.',
	'CONTACT_NO_NAME'			=> 'You didn’t enter a name',
	'FORUM'						=> 'forum',
	'USER'						=> 'user',
	'CONTACT_REGISTERED'		=> 'Registered User',
	'CONTACT_GUEST'				=> 'Guest User',

	'REASON_EXPLAIN'			=> 'Please choose a reason',
	'REASON_ERROR'				=> 'Please choose an appropriate reason',
	'RETURN_CONTACT'			=> '%sReturn to the contact page%s',
	'CONTACT_PRIVACYPOLICY'				=> 'Privacy policy',
	'CONTACT_PRIVACYPOLICY_EXPLAIN'		=> 'I confirm that the given name, e-mail address, message text and my IP address will be processed and stored by the owner of the board according to the <a target="_blank" title="Privacy policy link" href="%s">Privacy Policy</a>',
	'CONTACT_PRIVACYPOLICY_ERROR'		=> 'Please check the privacy policy box. Without your confirmation you won’t able to send us a message.',
]);
