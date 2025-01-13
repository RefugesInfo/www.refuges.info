<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
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
// Some characters you may want to copy&paste:
// ’ » “ ” …

$lang = array_merge($lang, [
	'CANNOT_REPORT_ANONYMOUS'	=> 'You are not allowed to report the anonymous account.',
	'CANNOT_REPORT_ADMINS_MODS'	=> 'You can’t report admins or mods of this forum.',
	'FORUM_NOT_EXIST'		=> 'The forum selected does not exist.',
	'INFO_NOT_FOUND'	=> 'The combination of poster id and post id doesn’t exist.',
	'POST_NOT_EXIST'	=> 'The post you requested does not exist.',
	'NO_SOUP_FOR_YOU'	=> 'No soup for you! It looks like you have been flagged as a spammer.<br>If you feel this decision was made in error %scontact the board admin%s.',
	'NO_SOUP_FOR_YOU_NO_CONTACT'	=> 'No soup for you! It looks like you have been flagged as a spammer.',
	'PM_NOT_EXIST'	=> 'PM doesn’t exist',
	'SFS_ANONYMIZED_IP'	=> 'The IP of the user has been anonymized, set to 127.0.0.1, probably due to an extension.',
	'SFS_MISSING_DATA'	=> 'Not all information is provided to report to Stop Forum Spam.',
	'SFS_IP_STOPPED'	=> '<a target="_blank" title="Check IP at StopForumSpam.com (opens in a new window)" href="http://www.stopforumspam.com/ipcheck/%1$s" rel="noreferrer noopener">%1$s</a>',
	'SFS_USERNAME_STOPPED'	=> '<a target="_blank" title="Check Username at StopForumSpam.com (opens in a new window)" href="http://www.stopforumspam.com/search/?q=%1$s" rel="noreferrer noopener">%1$s</a>',
	'SFS_EMAIL_STOPPED'	=> '<a target="_blank" title="Check Email at StopForumSpam.com (opens in a new window)" href="http://www.stopforumspam.com/search/?q=%1$s" rel="noreferrer noopener">%1$s</a>',
	'SFS_FREQUENCY'	=> ' » found in sfs database %d times',
	'SFS_IP_STOPPED'	=> '<a target="_blank" title="Check IP at StopForumSpam.com (opens in a new window)" href="http://www.stopforumspam.com/ipcheck/%1$s" rel="noreferrer noopener">%1$s</a>',
	'SFS_USERNAME_STOPPED'	=> '<a target="_blank" title="Check Username at StopForumSpam.com (opens in a new window)" href="http://www.stopforumspam.com/search/?q=%1$s" rel="noreferrer noopener">%1$s</a>',
	'SFS_EMAIL_STOPPED'	=> '<a target="_blank" title="Check Email at StopForumSpam.com (opens in a new window)" href="http://www.stopforumspam.com/search/?q=%1$s" rel="noreferrer noopener">%1$s</a>',
	'SFS_ERROR_MESSAGE'	=> 'Unfortunately we can’t process your request now due to problems with an external party. You can try again later.',
	'SFS_BANNED'	=> [
		1 => 'Found in the Stop Forum Spam database once',
		2 => 'Found in the Stop Forum Spam database %d times',
	],
	'SFS_USER_BANNED'	=> 'Banned due to a post on the forum',
	'SFS_REPORTED'		=> 'Post has already been reported',
	'SFS_PM_REPORTED'	=> 'PM has already been reported',
	'REPORT_TO_SFS'	=> 'Report to Stop Forum Spam',
	'BUTTON_SFS'	=> 'Report to SFS',
	'SFS_SUCCESS_MESSAGE'	=> 'User was successfully reported to the stop forum database',
	'SFS_WAS_REPORTED'	=> 'Post was reported to Stop Forum Spam',
	'SFS_PM_WAS_REPORTED'	=> 'PM was reported to Stop Forum Spam',
	'SFS_PM_REPORT_NOT_ALLOWED'	=> 'Reporting is not allowed',
	'SFS_NEED_CURL'	=> 'The extension requires cURL which doesn’t seem to be installed',
	'EXTENSION_REQUIREMENTS' => 'Extension requires at least phpBB version %1$s. You need to update your version of phpBB to utilize this extension.',
	'CURL_REQUIREMENTS'	=> 'Extension requires cURL be installed and compiled with a valid ssl certificate on this server',
	'CURL_ERROR' => 'cURL error',
	'INVALID_IP_ADDRESS'	=> 'Invalid IP address',
	'SFS_CONFIRM'	=> 'Report to stop forum database?',
	'SFS_SUCCESS'	=> 'Stop forum spam successful',
	'SFS_OPERATION_CANCELED' => 'Operation canceled',
	'SFS_NOT_CHECKED' => ' » <em>Parameter wasn’t checked per settings in extension</em>',
]);
