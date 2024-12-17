<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
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

	// ACP entries
	'SFS_SETTINGS'			=> 'Settings',
	'SFS_ENABLED'			=> 'Enable Stop Forum Spam',
	'SFS_ENABLED_EXPLAIN'	=> 'Enable or disable the extension. This applies to both user registration and guest posts.',
	'SFS_THRESHOLD_SCORE'	=> 'Stop Forum Spam threshold',
	'SFS_THRESHOLD_SCORE_EXPLAIN'	=> 'The extension will check against a threshold (e.g., the number of times a user name, email or IP address is found within the stop forum database). You can input any number between 1 and 99. The lower the number the greater the possibility of a false positive.',
	'SFS_LOG_MESSAGE'		=> 'Log a message',
	'SFS_LOG_MESSAGE_EXPLAIN'	=> 'If set as yes messages will be logged in the ACP in either the admin or user logs stating the action done.',
	'SFS_BAN_IP'			=> 'Ban User',
	'SFS_BAN_IP_EXPLAIN'	=> 'If set as yes the users IP or user name will be banned per the setting of “Length of ban”',
	'SFS_BAN_REASON'		=> 'Display reason if banned',
	'SFS_BAN_REASON_EXPLAIN'	=> 'If “Ban User” is set to yes, you can choose to display a message to the banned user or not.',
	'SFS_DOWN'				=> 'Allow if Stop Forum Spam is down',
	'SFS_DOWN_EXPLAIN'		=> 'Should registration/posting go through if the stop forum spam website is down',
	'SFS_API_KEY'			=> 'Stop Forum Spam API key',
	'SFS_API_KEY_EXPLAIN'	=> 'If you want to submit spammers to the Stop Forum Spam database, input your API key from <a target="_blank" href="http://www.stopforumspam.com/keys" rel="noreferrer noopener">stop forum spam</a> here. You must be registered on the SFS website to get an API key',
	'SFS_NEED_CACHE'		=> 'There is an API key but no cache was built for admins and mods. Please click the button to generate the cache for admins and mods otherwise they can be reported.',
	'SFS_NOTIFY'			=> 'Board Notification',
	'SFS_NOTIFY_EXPLAIN'	=> 'If set yes and there is an API key set above, then board notifications will also be triggered when a post is reported to stop forum spam',
	'SFS_CLEAR'				=> 'Reset reported posts',
	'SFS_CLEAR_EXPLAIN'		=> 'Will reset all posts ( %1s total ) and private messages ( %2s total ) reported to stop forum spam',
	'SFS_CLEAR_SURE'		=> 'Clear SFS reports',
	'SFS_CLEAR_SURE_CONFIRM'	=> 'Are you sure you want to clear all reported posts and private messages?',
	'SFS_BUILD' => 'Build cache of Admins and Mods',
	'SFS_BUILD_EXPLAIN'	=> 'Builds a cache of Admins and Global Mods for use when reporting to SFS',
	'SFS_NEEDS_API'	=> 'To build the cache you need an API key from stop forum spam',
	// ACP messages
	'SFS_BY_NAME'	=> 'Check against user name',
	'SFS_BY_EMAIL'	=> 'Check against email',
	'SFS_BY_IP'		=> 'Check against IP',
	'SFS_ALLOW_PM_REPORT'	=> 'Allow reporting of PMs',
	'SFS_PM_REPORT_EXPLAIN'	=> 'If you have an API key and allow this then any user can report a PM to stop forum spam. Your users maybe “indiscriminate” so it might be best if you leave this set to no.',
	'TOO_SMALL_SFS_THRESHOLD'	=> 'The threshold value is too small.',
	'TOO_LARGE_SFS_THRESHOLD'	=> 'The threshold value is too large.',
	'SFS_SETTINGS_ERROR'		=> 'There was an error saving your settings. Please submit the back trace with your error report.',
	'SFS_SETTINGS_SUCCESS'		=> 'The settings were successfully saved.',
	'SFS_REPORTED_CLEARED' => 'Posts and private messages reported to stop forum spam were reset.',
	//Donation
	'PAYPAL_IMAGE_URL'          => 'https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-26px.png',
	'PAYPAL_ALT'                => 'Donate using PayPal',
	'BUY_ME_A_BEER_URL'         => 'https://paypal.me/RMcGirr83',
	'BUY_ME_A_BEER'				=> 'Buy me a beer for creating this extension',
	'BUY_ME_A_BEER_SHORT'		=> 'Make a donation for this extension',
	'BUY_ME_A_BEER_EXPLAIN'		=> 'This extension is completely free. It is a project that I spend my time on for the enjoyment and use of the phpBB community. If you enjoy using this extension, or if it has benefited your forum, please consider <a href="https://paypal.me/RMcGirr83" target="_blank" rel="noreferrer noopener">buying me a beer</a>. It would be greatly appreciated. <i class="fa fa-smile-o" style="color:green;font-size:1.5em;" aria-hidden="true"></i>',
	'SFS_CONTACTADMIN_EXT'	=> 'Allow on Contactadmin Extension',
	'SFS_CONTACTADMIN_EXT_EXPLAIN'	=> 'If set yes and the contact admin extension is installed, this extension will integrate with the contact admin extension.'
]);
