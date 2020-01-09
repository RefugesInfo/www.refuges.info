<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_CLEANTALK_TITLE'			            => 'Antispam by CleanTalk',

	'ACP_CLEANTALK_SETTINGS'		            => 'Spam protection settings',
	'ACP_CLEANTALK_SETTINGS_SAVED'		        => 'Spam protection settings have been saved successfully!',

	'ACP_CLEANTALK_REGS_LABEL'		            => 'Check Registrations',
	'ACP_CLEANTALK_REGS_DESCR'		            => 'Spam-bots will be rejected with a statement of reasons.',

	'ACP_CLEANTALK_GUESTS_LABEL'		        => 'Moderate Guests',
	'ACP_CLEANTALK_GUESTS_DESCR'		        => 'Posts and topics from guests will be test for spam. Spam will be rejected or sent to approvement.',

	'ACP_CLEANTALK_NUSERS_LABEL'		        => 'Moderate Newly Registered Users',
	'ACP_CLEANTALK_NUSERS_DESCR'		        => 'Posts and topics from new users will be test for spam. Spam will be rejected or sent to approvement.',

	'ACP_CLEANTALK_APIKEY_LABEL'		        => 'Access key',
	'ACP_CLEANTALK_APIKEY_DESCR'		        => 'To get an access key please register at site ',

	'MAIL_CLEANTALK_ERROR'			            => 'Error while connecting to CleanTalk service',
	'LOG_CLEANTALK_ERROR'			            => '<strong>Error while connecting to CleanTalk service</strong><br />%s',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'			=> 'Check users for spam',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> "Anti-spam by CleanTalk will check all users against blacklists database and show you senders that have spam activity on other websites. Just click 'Check users for spam' to start.",
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'Check users for spam',
	'ACP_CHECKUSERS_DONE_1'                     => 'Done. All users tested via blacklists database, please see result below.',
	'ACP_CHECKUSERS_DONE_2'                     => 'Done. All users tested via blacklists database, found 0 spam users.',
	'ACP_CHECKUSERS_SELECT'                     => 'Select',
	'ACP_CHECKUSERS_USERNAME'                   => 'Username',
	'ACP_CHECKUSERS_MESSAGES'                   => 'Messages',
	'ACP_CHECKUSERS_JOINED'                     => 'Joined',
	'ACP_CHECKUSERS_EMAIL'                      => 'Email',
	'ACP_CHECKUSERS_IP'                         => 'IP',
	'ACP_CHECKUSERS_LASTVISIT'                  => 'Last visit',
	'ACP_CHECKUSERS_DELETEALL'                  => 'Delete all',
	'ACP_CHECKUSERS_DELETEALL_DESCR'            => 'All posts of deleted users will be deleted, too.',
	'ACP_CHECKUSERS_DELETESEL'                  => 'Delete selected',
));
