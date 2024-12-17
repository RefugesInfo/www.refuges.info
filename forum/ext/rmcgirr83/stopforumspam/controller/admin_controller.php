<?php
/**
*
* @package Stop forum Spam extension
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\controller;

use phpbb\cache\service as cache;
use phpbb\config\config;
use phpbb\db\driver\driver_interface as db;
use phpbb\json_response;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use rmcgirr83\stopforumspam\core\sfsgroups as sfsgroups;
use rmcgirr83\contactadmin\controller\main_controller as contactadmin;

/**
* Admin controller
*/
class admin_controller implements admin_interface
{

	/** @var cache_service */
	protected $cache;

	/** @var config */
	protected $config;

	/** @var driver_interface */
	protected $db;

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

	/** @var sfsgroups */
	protected $sfsgroups;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/* @var contactadmin $contactadmin */
	protected $contactadmin;

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor
	*
	* @param cache					$cache				Cache object
	* @param config					$config				Config object
	* @param db						$db					Database object
	* @param language				$language			Language object
	* @param log					$log				Log object
	* @param request				$request			Request object
	* @param template				$template			Template object
	* @param user					$user				User object
	* @param sfsgroups				$sfsgroups			functions for the controller
	* @param string                 $root_path      	phpBB root path
	* @param string                 $php_ext        	phpEx
	* @param contactadmin			$contactadmin		Contactadmin extension
	*
	* @return \rmcgirr83\stopforumspam\controller\admin_controller
	* @access public
	*/
	public function __construct(
			cache $cache,
			config $config,
			db $db,
			language $language,
			log $log,
			request $request,
			template $template,
			user $user,
			sfsgroups $sfsgroups,
			$root_path,
			$php_ext,
			contactadmin $contactadmin = null
	)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->language = $language;
		$this->log = $log;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->sfsgroups = $sfsgroups;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->contactadmin = $contactadmin;
	}

	/**
	 * Display the options a user can configure for this extension
	 *
	 * @return null
	 * @access public
	 */
	public function display_options()
	{
		// Add the language files
		$this->language->add_lang('acp/acp_stopforumspam', 'rmcgirr83/stopforumspam');
		$this->language->add_lang('acp/ban');

		$action = $this->request->variable('action', '');

		add_form_key('sfs');
		$curl_active = $this->allow_sfs();

		$cache_built = '';
		if (!$this->cache->get('_sfs_adminsmods') && $this->config['sfs_api_key'])
		{
			$cache_built = $this->language->lang('SFS_NEED_CACHE');
		}

		$sql = 'SELECT COUNT(sfs_reported) AS stat
			FROM ' . POSTS_TABLE . '
			WHERE sfs_reported = 1';
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchfield('stat');
		$this->db->sql_freeresult($result);

		$posts_reported = $row;

		$sql = 'SELECT COUNT(sfs_reported) AS stat
			FROM ' . PRIVMSGS_TABLE . '
			WHERE sfs_reported = 1';
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchfield('stat');
		$this->db->sql_freeresult($result);

		$pms_reported = $row;

		$sfs_posts_pms_count = (int) $posts_reported + (int) $pms_reported;

		switch ($action)
		{
			case 'sfsclrreports':
				//if none have been reported there's nothing to do
				if (empty($sfs_posts_pms_count))
				{
					return false;
				}

				if (confirm_box(true))
				{
					$this->sfsclrreports();
				}
				else
				{
					confirm_box(false, 'SFS_CLEAR_SURE');
				}
			break;

			case 'build_adminsmods':

				$this->build_adminsmods();

			break;
		}

		if ($this->request->is_set_post('submit'))
		{
			// Test if the submitted form is valid
			if (!check_form_key('sfs'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action));
			}

			if (!function_exists('validate_data'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			$has_api_key = $this->request->variable('sfs_api_key', '', true);

			$check_row = ['sfs_threshold' => $this->request->variable('sfs_threshold', 0)];
			$validate_row = ['sfs_threshold' => ['num', false, 1, 99]];
			$error = validate_data($check_row, $validate_row);

			if (!sizeof($error))
			{
				if (!empty($has_api_key))
				{
					$this->sfsgroups->build_adminsmods_cache();
				}

				// Set the options the user configured
				$this->set_options();

				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SFS_CONFIG_SAVED');

				trigger_error($this->language->lang('SFS_SETTINGS_SUCCESS') . adm_back_link($this->u_action));
			}
		}

		$this->template->assign_vars([
			'ERROR'			=> isset($error) ? ((sizeof($error)) ? implode('<br />', $error) : '') : '',
			'SFS_API_KEY'	=> $this->config['sfs_api_key'],
			'ALLOW_SFS'		=> ($this->config['allow_sfs'] && $curl_active) ? true : false,
			'CURL_ACTIVE'	=> (!$curl_active) ? $this->language->lang('LOG_SFS_NEED_CURL') : false,
			'SFS_THRESHOLD'	=> (int) $this->config['sfs_threshold'],
			'SFS_BAN_IP'	=> ($this->config['sfs_ban_ip']) ? true : false,
			'SFS_LOG_MESSAGE'	=> ($this->config['sfs_log_message']) ? true : false,
			'SFS_DOWN'		=> ($this->config['sfs_down']) ? true : false,
			'SFS_BY_NAME'	=> ($this->config['sfs_by_name']) ? true : false,
			'SFS_BY_EMAIL'	=> ($this->config['sfs_by_email']) ? true : false,
			'SFS_BY_IP'		=> ($this->config['sfs_by_ip']) ? true : false,
			'SFS_BAN_REASON'	=> ($this->config['sfs_ban_reason']) ? true : false,
			'SFS_REPORT_PM'	=> ($this->config['sfs_report_pm']) ? true : false,
			'SFS_BAN_TIME'	=> $this->display_ban_time($this->config['sfs_ban_time']),
			'SFS_NOTIFY'	=> ($this->config['sfs_notify']) ? true : false,
			'SFS_POSTS_PMS_COUNT'	=> $sfs_posts_pms_count,
			'SFS_CONTACTADMIN'	=> ($this->config['sfs_contactadmin']) ? true : false,
			'NOTICE'	=> $cache_built,
			'POSTS_REPORTED' => (int) $posts_reported,
			'PMS_REPORTED'	=> (int) $pms_reported,
			'S_CONTACTADMIN' => ($this->contactadmin) ? true : false,

			'U_BUILD_CACHE'	=> $this->u_action . '&amp;action=build_adminsmods',
			'U_CLR_REPORTS'	=> $this->u_action . '&amp;action=sfsclrreports',
			'U_ACTION'		=> $this->u_action,
		]);
	}

	/**
	 * Set the options a user can configure
	 *
	 * @return void
	 * @access protected
	 */
	protected function set_options()
	{
		$this->config->set('sfs_threshold', $this->request->variable('sfs_threshold', 0));
		$this->config->set('allow_sfs', $this->request->variable('allow_sfs', 0));
		$this->config->set('sfs_ban_ip', $this->request->variable('sfs_ban_ip', 0));
		$this->config->set('sfs_log_message', $this->request->variable('sfs_log_message', 0));
		$this->config->set('sfs_down', $this->request->variable('sfs_down', 0));
		$this->config->set('sfs_by_name', $this->request->variable('sfs_by_name', 0));
		$this->config->set('sfs_by_email', $this->request->variable('sfs_by_email', 0));
		$this->config->set('sfs_by_ip', $this->request->variable('sfs_by_ip', 0));
		$this->config->set('sfs_ban_reason', $this->request->variable('sfs_ban_reason', 0));
		$this->config->set('sfs_api_key', $this->request->variable('sfs_api_key', '', true));
		$this->config->set('sfs_ban_time', $this->request->variable('sfs_ban_time', 0));
		$this->config->set('sfs_notify', $this->request->variable('sfs_notify', 0));
		$this->config->set('sfs_report_pm', $this->request->variable('sfs_report_pm', 0));
		$this->config->set('sfs_contactadmin', $this->request->variable('sfs_contactadmin', 0));
	}

	/**
	 * Ensure cURL is active on server
	 *
	 * @return bool
	 * @access protected
	 */
	protected function allow_sfs()
	{
		// Determine if cURL is enabled on the server
		$curl = false;
		if (function_exists('curl_init'))
		{
			$curl = true;
		}

		if (!$curl)
		{
			$this->config->set('allow_sfs', false);
		}

		return $curl;
	}
	/**
	 * Generate a select of ban time options
	 *
	 * @return string
	 * @access protected
	 */
	protected function display_ban_time($ban_time = 0)
	{
		// Ban length options
		$ban_text = [0 => $this->language->lang('PERMANENT'), 30 => $this->language->lang('30_MINS'), 60 => $this->language->lang('1_HOUR'), 360 => $this->language->lang('6_HOURS'), 1440 => $this->language->lang('1_DAY'), 10080 => $this->language->lang('7_DAYS'), 20160 => $this->language->lang('2_WEEKS'), 40320 => $this->language->lang('1_MONTH'), 524160 => $this->language->lang('1_YEAR')];

		$ban_options = '';
		foreach ($ban_text as $length => $text)
		{
			$selected = ($length == $ban_time) ? ' selected="selected"' : '';
			$ban_options .= "<option value='{$length}'$selected>$text</option>";
		}

		return $ban_options;
	}

	/**
	 * Clear reported posts and pms
	 *
	 * @return json response
	 * @access protected
	 */
	protected function sfsclrreports()
	{
		$sql = 'UPDATE ' . POSTS_TABLE . ' SET sfs_reported = 0
			WHERE sfs_reported = 1';
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . PRIVMSGS_TABLE . ' SET sfs_reported = 0
			WHERE sfs_reported = 1';
		$this->db->sql_query($sql);

		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SFS_REPORTED_CLEARED');

		$data = [
			'MESSAGE_TITLE'	=> $this->language->lang('SUCCESS'),
			'MESSAGE_TEXT'	=> $this->language->lang('SFS_REPORTED_CLEARED'),
			'success'	=> true,
		];

		$json_response = new json_response;
		$json_response->send($data);
	}

	/**
	 * Generate admin and mods cache
	 *
	 * @return json response
	 * @access protected
	 */
	protected function build_adminsmods()
	{
		if (empty($this->config['sfs_api_key']))
		{
			trigger_error('SFS_NEEDS_API');
		}

		$this->sfsgroups->build_adminsmods_cache();

		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ADMINSMODS_CACHE_BUILT');

		$data = [
			'MESSAGE_TITLE'	=> $this->language->lang('SUCCESS'),
			'MESSAGE_TEXT'	=> $this->language->lang('LOG_ADMINSMODS_CACHE_BUILT'),
			'success'	=> true,
		];

		$json_response = new json_response;
		$json_response->send($data);

	}

	/**
	 * Set page url
	 *
	 * @param string $u_action Custom form action
	 * @return null
	 * @access public
	 */
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
