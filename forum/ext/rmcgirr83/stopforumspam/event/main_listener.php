<?php

/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\event;

use phpbb\auth\auth;
use phpbb\cache\service as cache;
use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use rmcgirr83\stopforumspam\core\sfsgroups as sfsgroups;
use rmcgirr83\stopforumspam\core\sfsapi as sfsapi;
use rmcgirr83\contactadmin\controller\main_controller as contactadmin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	/** @var auth */
	protected $auth;

	/** @var service */
	protected $cache;

	/** @var config */
	protected $config;

	/** @var helper */
	protected $helper;

	/** @var language */
	protected $language;

	/** @var log */
	protected $log;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/* @var sfsgroups */
	protected $sfsgroups;

	/* @var sfsapi */
	protected $sfsapi;

	/** @var string root_path */
	protected $root_path;

	/** @var string php_ext */
	protected $php_ext;

	/* @var contactadmin $contactadmin */
	protected $contactadmin;

	public function __construct(
		auth $auth,
		cache $cache,
		config $config,
		helper $helper,
		language $language,
		log $log,
		request $request,
		template $template,
		user $user,
		sfsgroups $sfsgroups,
		sfsapi $sfsapi,
		string $root_path,
		string $php_ext,
		contactadmin $contactadmin = null)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->helper = $helper;
		$this->language = $language;
		$this->log = $log;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->sfsgroups = $sfsgroups;
		$this->sfsapi = $sfsapi;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->contactadmin = $contactadmin;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup_after'					=> 'user_setup_after',
			'core.ucp_register_data_after'			=> 'user_sfs_validate_registration',
			'core.posting_modify_template_vars'		=> 'poster_data_email',
			'core.posting_modify_message_text'		=> 'poster_modify_message_text',
			'core.posting_modify_submission_errors'	=> 'user_sfs_validate_posting',
			'core.group_add_user_after'				=> 'update_sfs_admin_mods',
			'core.group_delete_user_after'			=> 'update_sfs_admin_mods',
			// report to sfs?
			'core.viewtopic_before_f_read_check'	=> 'viewtopic_before_f_read_check',
			'core.viewtopic_post_rowset_data'		=> 'viewtopic_post_rowset_data',
			'core.viewtopic_modify_post_row'		=> 'viewtopic_modify_post_row',
			'core.ucp_pm_view_message'				=> 'ucp_pm_view_message',
			// Custom events for integration with Contact Admin Extension
			'rmcgirr83.contactadmin.modify_data_and_error'	=> 'user_sfs_validate_registration',
		];
	}

	/**
	 * Check for and create if needed admins and mods cache
	 *
	 * @param object $event The event object
	 * @return void
	 * @access public
	 */
	public function user_setup_after($event)
	{
		$this->language->add_lang(['sfs_mcp', 'stopforumspam'], 'rmcgirr83/stopforumspam');
		$this->sfsgroups->build_adminsmods_cache();
	}

	/*
	* user_sfs_validate_registration		validate a users registration event
	*
	* @param	$event	the event object
	* @return 	null
	* @access	public
	*/
	public function user_sfs_validate_registration($event)
	{
		if ($this->config['allow_sfs'] == false)
		{
			return false;
		}

		if ($this->user->page['page_name'] == 'app.' . $this->php_ext . '/contactadmin' && !$this->config['sfs_contactadmin'])
		{
			return false;
		}

		$error_array = $event['error'];

		// validate the user ip
		$userip_error = $this->validate_ip($this->user->ip);
		if ($userip_error)
		{
			$error_array[] = $userip_error;
		}

		/* On registration and only when all errors have cleared
		 * do not want the admin message area to fill up
		*/
		if (!sizeof($error_array))
		{
			$check = $this->stopforumspam_check($event['data']['username'], $this->user->ip, $event['data']['email']);

			if ($check)
			{
				if ($this->config['sfs_down'] && $check === 'sfs_down')
				{
					return;
				}
				$error_array[] = $this->show_message($check);
				// now ban the spammer by IP
				if (is_int($check) && $this->config['sfs_ban_ip'])
				{
					$this->sfsapi->sfs_ban('ip', $this->user->ip, (int) $check);
				}
			}
		}
		$event['error'] = $error_array;
	}

	/*
	* poster_data_email			inject email address into posting if allowed for guests
	*
	* @param	$event			the event object
	* @return 	void
	* @access	public
	*/
	public function poster_data_email($event)
	{
		if ($this->user->data['user_id'] == ANONYMOUS && $this->config['allow_sfs'])
		{
			// Output the data vars to the template
			$this->template->assign_vars([
					'SFS'	=> true,
					'EMAIL'	=> $this->request->variable('email', ''),
			]);
		}
	}

	/*
	* poster_modify_message_text	inject email address into post data  for validation
	*
	* @param	$event			the event object
	* @return 	void
	* @access	public
	*/
	public function poster_modify_message_text($event)
	{
		if ($event['mode'] == 'post' && $this->user->data['user_id'] == ANONYMOUS && $this->config['allow_sfs'])
		{
			$event['post_data'] = array_merge($event['post_data'], [
				'email'	=> strtolower($this->request->variable('email', '')),
				'username' => strtolower($this->request->variable('username', '')),
				'user_ip' => $this->user->ip
			]);
		}
	}

	/*
	* user_sfs_validate_posting		validate username and email for guest posting
	*
	* @param	$event			the event object
	* @return 	void
	* @access	public
	*/
	public function user_sfs_validate_posting($event)
	{
		$error_array = $event['error'];

		if ($this->user->data['user_id'] == ANONYMOUS && $this->config['allow_sfs'])
		{
			$this->language->add_lang('ucp');

			if (!function_exists('phpbb_validate_email'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			// ensure email is populated on posting
			$error = $this->validate_email($event['post_data']['email']);
			if ($error)
			{
				$error_array[] = $this->language->lang($error . '_EMAIL');
			}
			// I just hate empty usernames for guest posting
			if (empty($event['post_data']['username']))
			{
				$username_error = $this->validate_username($event['post_data']['username']);
				if ($username_error)
				{
					$error_array[] = $username_error;
				}
			}

			// validate the user ip
			$userip_error = $this->validate_ip($event['post_data']['user_ip']);
			if ($userip_error)
			{
				$error_array[] = $userip_error;
			}

			if (!sizeof($error_array))
			{
				$check = $this->stopforumspam_check($event['post_data']['username'], $this->user->ip, $event['post_data']['email']);

				if ($check)
				{
					if ($this->config['sfs_down'] && is_string($check))
					{
						return;
					}
					$error_array[] = $this->show_message($check);

					// now ban the spammer by IP
					if (is_int($check))
					{
						$this->sfsapi->sfs_ban('ip', $this->user->ip, (int) $check);
					}
				}
			}
		}
		$event['error'] = $error_array;
	}

	/*
	* update_sfs_admin_mods 			update admin and mods cache when adding|deleting users to|from a group
	* @param 		$event				event object
	* @return		void
	* @access		public
	*/
	public function update_sfs_admin_mods($event)
	{
		// can't determine group id by default so always run this when updating groups
		// apparently no way to get around this
		$this->cache->destroy('_sfs_adminsmods');
		$this->sfsgroups->build_adminsmods_cache();
	}

	/*
	* viewtopic_before_f_read_check() 	inject lang vars and grab admins and mods
	* @param 		$event				event object
	* @return		void
	* @access		public
	*/
	public function viewtopic_before_f_read_check($event)
	{
		if ($this->config['allow_sfs'])
		{
			if (!empty($this->config['sfs_api_key']))
			{
				// get mods and admins
				$this->sfs_admins_mods = $this->sfsgroups->getadminsmods($event['forum_id']);
			}
		}
	}

	/*
	* viewtopic_post_rowset_data	add the posters ip into the rowset
	* @param	$event				event object
	* @return	void
	* @access	public
	*/
	public function viewtopic_post_rowset_data($event)
	{
		$rowset = $event['rowset_data'];
		$row = $event['row'];

		$rowset['poster_ip'] = $row['poster_ip'];
		$rowset['user_email'] = $row['user_email'];
		$rowset['sfs_reported'] = $row['sfs_reported'];

		$event['rowset_data'] = $rowset;
	}

	/*
	* viewtopic_modify_post_row		show a link to admins and mods to report the spammer
	* @param 		$event			event object
	* @return		void
	* @access		public
	*/
	public function viewtopic_modify_post_row($event)
	{
		if (empty($this->config['allow_sfs']) || empty($this->config['sfs_api_key']))
		{
			return;
		}

		$row = $event['row'];

		// ensure we have an IP and email address..this may happen if users have "post" bots on the forum
		// also ensure the IP is something other than 127.0.0.1 which can happen if the anonymised extension is installed
		if (empty($this->validate_ip($row['poster_ip'])) && filter_var($row['poster_ip'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE))
		{
			$sfs_report_allowed = (!empty($row['user_email']) && $event['poster_id'] != ANONYMOUS && !$row['sfs_reported']) ? true : false;

			if ($sfs_report_allowed && in_array($this->user->data['user_id'], $this->sfs_admins_mods) && !in_array((int) $event['poster_id'], $this->sfs_admins_mods))
			{
				$reporttosfs_url = $this->helper->route('rmcgirr83_stopforumspam_core_reporttosfs', ['postid' => (int) $row['post_id'], 'posterid' => (int) $event['poster_id']]);
				$event['post_row'] = array_merge($event['post_row'], [
					'S_SFS'	=> true,
					'U_SFS'	=> $reporttosfs_url,
				]);
			}
		}
	}

	/*
	* ucp_pm_view_message		show a link to report a spammer
	* @param 	$event			event object
	* @return	bool
	* @access	public
	*/
	public function ucp_pm_view_message($event)
	{
		$user_info = $event['user_info'];

		$allowed = ($this->config['allow_sfs'] && $this->config['allow_pm_report'] && !empty($this->config['sfs_api_key']) && $this->config['sfs_report_pm']) ? true : false;

		if (!$allowed || $this->user->data['user_id'] == $user_info['user_id'])
		{
			return false;
		}

		// get mods and admins
		$this->sfs_admins_mods = $this->sfsgroups->getadminsmods(0);

		if (in_array((int) $user_info['user_id'], $this->sfs_admins_mods))
		{
			return false;
		}

		$message_row = $event['message_row'];

		// ensure we have an IP and email address..this may happen if users have "post" bots on the forum
		// also ensure the IP is something other than 127.0.0.1 which can happen if the anonymised extension is installed
		if (empty($this->validate_ip($user_info['author_ip'])) && filter_var($user_info['author_ip'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE))
		{
			$sfs_report_allowed = (!empty($user_info['user_email'])) ? true : false;

			if ($sfs_report_allowed && !$message_row['sfs_reported'] )
			{
				$reporttosfs_url = $this->helper->route('rmcgirr83_stopforumspam_core_report_pm_to_sfs', ['postid' => (int) $message_row['msg_id'], 'posterid' => (int) $user_info['user_id']]);

				$event['msg_data'] = array_merge($event['msg_data'], [
					'S_SFS'		=> true,
					'U_SFS'		=> $reporttosfs_url,
				]);
			}
		}
	}

	/*
	* show_message
	* @param 	string	$check 		the type of check we are, uhmmm, checking
	* @return 	string
	* @access	private
	*/
	private function show_message($check = '')
	{
		if ($check === 'sfs_down')
		{
			return $this->language->lang('SFS_ERROR_MESSAGE');
		}
		else
		{
			if ($this->contactadmin !== null && !empty($this->config['contactadmin_enable']))
			{
				$message = $this->language->lang('NO_SOUP_FOR_YOU', '<a href="' . $this->helper->route('rmcgirr83_contactadmin_displayform') . '">', '</a>');
			}
			else if ($this->config['contact_admin_form_enable'])
			{
				$link = ($this->config['email_enable']) ? append_sid("{$this->root_path}memberlist.$this->php_ext", 'mode=contactadmin') : 'mailto:' . phpbb_get_board_contact($this->config, $this->php_ext);
				$message = $this->language->lang('NO_SOUP_FOR_YOU', '<a href="'. $link .'">','</a>');
			}
			else
			{
				$message = $this->language->lang('NO_SOUP_FOR_YOU_NO_CONTACT');
			}
			return $message;
		}
	}

	/*
	* stopforumspam_check
	* @param 	string	$username 		username from the forum inputs
	* @param	string	$ip				the users ip
	* @param	string	$email			email from the forum inputs
	* @return 	bool|string				true if found, false if not, string if other
	* @access	private
	*/
	private function stopforumspam_check($username, $ip, $email)
	{

		$sfs_log_message = !empty($this->config['sfs_log_message']) ? $this->config['sfs_log_message'] : false;

		// Threshold score to reject registration and/or guest posting
		$sfs_threshold = !empty($this->config['sfs_threshold']) ? $this->config['sfs_threshold'] : 1;

		// Query the SFS database and pull the data into script
		$json = $this->sfsapi->sfsapi('query', $username, $ip, $email);
		$json_decode = json_decode($json, true);

		// If there is a curl error as set in sfs_api, log the error
		if (isset($json_decode[$this->language->lang('CURL_ERROR')]))
		{
			return 'sfs_down';
		}

		// Check if user is a spammer, but only if we successfully got the SFS data
		if (isset($json_decode['success']))
		{
			$username_freq = (int) $json_decode['username']['frequency'];
			$email_freq = (int) $json_decode['email']['frequency'];
			$ip_freq = (int) $json_decode['ip']['frequency'];

			// ACP settings in effect
			if ($this->config['sfs_by_name'] == false)
			{
				$username_freq = 0;
			}

			if ($this->config['sfs_by_email'] == false)
			{
				$email_freq = 0;
			}

			if ($this->config['sfs_by_ip'] == false)
			{
				$ip_freq = 0;
			}
			// Return the total score
			$spam_score = (int) ($username_freq + $email_freq + $ip_freq);

			// If we've got a spammer we'll take away their soup!
			if ($spam_score >= $sfs_threshold)
			{
				if ($sfs_log_message)
				{
					$this->log_message('user', $username, $ip, 'LOG_SFS_MESSAGE', $email, $username_freq, $ip_freq, $email_freq);
				}
				//user is a spammer
				return $spam_score;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if ($sfs_log_message)
			{
				if ($this->config['sfs_down'])
				{
					$this->log_message('admin', $username, $ip, 'LOG_SFS_DOWN_USER_ALLOWED', $email);
				}
				else
				{
					$this->log_message('admin', $username, $ip, 'LOG_SFS_DOWN', $email);
				}
			}
			return 'sfs_down';
		}
	}

	/*
	* log_message	function used in this class to inject messages into the logs
	* @param 	string	$mode 		the mode that we are doing for the log either admin or user
	* @param	string	$username	the users name
	* @param	string	$ip			the users ip
	* @param	string	$message	the message we are injecting
	* @param	string	$email		email from the forum inputs
	* @return 	void
	* @access	private
	*/
	private function log_message($mode, $username, $ip, $message, $email, $username_score = 0, $ip_score = 0, $email_score = 0)
	{

		$sfs_ip = $this->language->lang('SFS_IP_STOPPED', $ip);
		$sfs_username = $this->language->lang('SFS_USERNAME_STOPPED', $username);
		$sfs_email = $this->language->lang('SFS_EMAIL_STOPPED', $email);

		if ($mode === 'admin')
		{
			$this->log->add('admin', $this->user->data['user_id'], $ip, $message, false, [$sfs_username, $sfs_ip, $sfs_email]);
		}
		else
		{
			if ($this->config['sfs_by_name'] == false)
			{
				$username_score = $this->language->lang('SFS_NOT_CHECKED');
			}
			else
			{
				$username_score = $this->language->lang('SFS_FREQUENCY', $username_score);
			}

			if ($this->config['sfs_by_email'] == false)
			{
				$email_score = $this->language->lang('SFS_NOT_CHECKED');
			}
			else
			{
				$email_score = $this->language->lang('SFS_FREQUENCY', $email_score);
			}

			if ($this->config['sfs_by_ip'] == false)
			{
				$ip_score = $this->language->lang('SFS_NOT_CHECKED');
			}
			else
			{
				$ip_score = $this->language->lang('SFS_FREQUENCY', $ip_score);
			}
			$sfs_ip .= $ip_score;
			$sfs_username .= $username_score;
			$sfs_email .= $email_score;

			$this->log->add('user', $this->user->data['user_id'], $ip, $message, false, ['reportee_id' => $this->user->data['user_id'], $sfs_username, $sfs_ip, $sfs_email]);
		}
	}

	/*
	* validate_email	function used in this class to validate a guest posters email address
	* @param	string	$email	email from the forum inputs
	* @return 	string
	* @access	private
	*/
	private function validate_email($email)
	{
		$error = phpbb_validate_email($email);

		return $error;
	}

	/*
	* validate_username	function used in this class to validate a guest posters username
	* @param	string	$username	username from the forum inputs
	* @return 	array
	* @access	private
	*/
	private function validate_username($username)
	{
		$error = [];
		if (($result = validate_username($username)) !== false)
		{
			$error[] = $this->language->lang($result . '_USERNAME');
		}

		if (($result = validate_string($username, false, $this->config['min_name_chars'], $this->config['max_name_chars'])) !== false)
		{
			$min_max_amount = ($result == 'TOO_SHORT') ? $this->config['min_name_chars'] : $this->config['max_name_chars'];
			$error[] = $this->language->lang('FIELD_' . $result, $min_max_amount, $this->language->lang('USERNAME'));
		}

		return $error;
	}

	/*
	* validate_ip		function used in this class to validate an ip address
	* @param	string	$ip		the users ip
	* @return 	string
	* @access	private
	*/
	private function validate_ip($ip)
	{
		$error = '';

		if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6) === false)
		{
			$error = $this->language->lang('INVALID_IP_ADDRESS');
		}

		return $error;
	}
}
