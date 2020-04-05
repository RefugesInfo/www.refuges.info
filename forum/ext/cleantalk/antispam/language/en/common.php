<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
* Translated By : Raul [ThE KuKa] 
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

	'ACP_CLEANTALK_CCF_LABEL'	           		=> 'Check contact forms',
	'ACP_CLEANTALK_CCF_DESCR'	           		=> 'Enable anti-spam test for contact forms. May provide confliсts!',

	'ACP_CLEANTALK_SFW_LABEL'		       		=> 'SpamFireWall',
	'ACP_CLEANTALK_SFW_DESCR'		        	=> 'Enables SpamFireWall. Reduces webserver load and prevents bots to access the website.',

	'ACP_CLEANTALK_APIKEY_LABEL'		        => 'Access key',
	'ACP_CLEANTALK_APIKEY_LABEL_PLACEHOLDER'    => 'Enter the access key',		
	'ACP_CLEANTALK_APIKEY_DESCR'		        => 'To get an access key please register at site ',
	'ACP_CLEANTALK_REG_NOTICE'                  => 'Board e-mail',
	'ACP_CLEANTALK_REG_NOTICE2'                 => 'will be used for registration',
	'ACP_CLEANTALK_AGREEMENT'                   => 'License agreement',
	'ACP_CLEANTALK_APIKEY_IS_OK_LABEL'			=> 'Key is ok!',
	'ACP_CLEANTALK_APIKEY_IS_BAD_LABEL'			=> 'Key is not valid!',
	'ACP_CLEANTALK_APIKEY_GET_AUTO_BUTTON_LABEL'		=> 'Get Access key automatically',
	'ACP_CLEANTALK_APIKEY_GET_MANUALLY_BUTTON_LABEL'	=> 'Get Access manually',
	'ACP_CLEANTALK_APIKEY_CP_LINK_BUTTON'		=> 'Click here to get anti-spam statistics',
	'ACP_CLEANTALK_ACCOUNT_NAME_OB'				=> 'Account at cleantalk.org is',
	'ACP_CLEANTALK_CHECKUSERS_TITLE'			=> 'Check users for spam',
	'ACP_CLEANTALK_CHECKUSERS_DESCRIPTION'		=> 'Anti-spam by CleanTalk will check all users against blacklists database and show you senders that have spam activity on other websites. Just click `Check users for spam` to start.',
	'ACP_CLEANTALK_CHECKUSERS_PAGES_TITLE'      => 'Pages:',	
	'ACP_CLEANTALK_CHECKUSERS_BUTTON'			=> 'Check users for spam',
	'ACP_CLEANTALK_CHECKUSERS_NUMBER_DESCRIPTION'=> 'Number of unchecked users to check. Leave it blank to reset flags and start full scan.',
	'ACP_CHECKUSERS_DONE_2'                     => 'Done. All users tested via blacklists database, found 0 spam users.',
	'ACP_CHECKUSERS_DONE_3'						=> 'Error. No connection with blacklist database.',
	'ACP_CHECKUSERS_USERNAME'                   => 'Username',
	'ACP_CHECKUSERS_MESSAGES'                   => 'Messages',
	'ACP_CHECKUSERS_JOINED'                     => 'Joined',
	'ACP_CHECKUSERS_EMAIL'                      => 'Email',
	'ACP_CHECKUSERS_IP'                         => 'IP',
	'ACP_CHECKUSERS_LASTVISIT'                  => 'Last visit',
	'ACP_CHECKUSERS_DELETEALL'                  => 'Delete all',
	'ACP_CHECKUSERS_DELETEALL_DESCR'            => 'All posts of deleted users will be deleted, too.',
	'ACP_CHECKUSERS_DELETESEL'                  => 'Delete selected',
	'ACP_CLEANTALK_MODERATE_IP'					=> 'The anti-spam service is paid by your hosting provider. License #',
	'SFW_DIE_NOTICE_IP'                         => 'SpamFireWall is activated for your IP ',
	'SFW_DIE_MAKE_SURE_JS_ENABLED'              => 'To continue working with web site, please make sure that you have enabled JavaScript.',
	'SFW_DIE_CLICK_TO_PASS'                     => 'Please click bellow to pass protection,',
	'SFW_DIE_YOU_WILL_BE_REDIRECTED'            => 'Or you will be automatically redirected to the requested page after 3 seconds.',
	
	'CLEANTALK_ERROR_MAIL'		                => 'Error while connecting to CleanTalk service',
	'CLEANTALK_ERROR_LOG'		                => '<strong>Error while connecting to CleanTalk service</strong><br />%s',
	'CLEANTALK_ERROR_CURL'		                => 'CURL error: `%s`',
	'CLEANTALK_ERROR_NO_CURL'		            => 'No CURL support compiled in',
	'CLEANTALK_ERROR_ADDON'		                => ' or disabled allow_url_fopen in php.ini.',
	'CLEANTALK_NOTIFICATION'					=> 'Are you sure?',
));
