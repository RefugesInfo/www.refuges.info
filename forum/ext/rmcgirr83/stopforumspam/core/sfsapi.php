<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\core;

/**
* ignore
**/
use phpbb\config\config;
use phpbb\language\language;
use phpbb\log\log;
use phpbb\user;

class sfsapi
{
	/** @var config $config */
	protected $config;

	/** @var language $language */
	protected $language;

	/** @var log $log */
	protected $log;

	/** @var user $user */
	protected $user;

	/** @var string root_path */
	protected $root_path;

	/** @var string php_ext */
	protected $php_ext;

	public function __construct(
		config $config,
		language $language,
		log $log,
		user $user,
		string $root_path,
		string $php_ext)
	{
		$this->config = $config;
		$this->language = $language;
		$this->log = $log;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/*
	* sfsapi
	* @param 	$type 			whether we are adding or querying
	* @param	$username		the users name
	* @param	$userip			the users ip
	* @param	$useremail		the users email addy
	* @param	$apikey			the api key of the forum
	* @return 	bool|string		return true on success or false on failure or string on curl error
	*/
	public function sfsapi($type, $username, $userip, $useremail, $apikey = '')
	{
		// We'll use curl..most servers have it installed as default
		if (!function_exists('curl_init'))
		{
			// no cURL no extension
			$this->config->set('allow_sfs', false);

			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SFS_NEED_CURL');

			return false;
		}

		if ($type == 'add')
		{
			$url = 'https://www.stopforumspam.com/add.php';
			$data = [
				'username' => $username,
				'ip' => $userip,
				'email' => $useremail,
				'api_key' => $apikey
			];

			$data = http_build_query($data);
		}
		else
		{
			$url = 'https://api.stopforumspam.org/api';
			$data = [
				'username' => $username,
				'email' => $useremail,
				'ip' => $userip
			];

			$data = http_build_query($data);
			$data = $data . '&nobadusername&json';
		}

		$ch = curl_init($url);

		curl_setopt_array($ch, [
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_FAILONERROR => true, //Required for HTTP error codes to be reported via our call to curl_error($ch)//
		]);

		$contents = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// if curl isn't set correctly on server
		if ($contents === false)
		{
			$error_message = array($this->language->lang('CURL_ERROR') => curl_error($ch));
			// If there is a curl error, log the error
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_SFS_CURL_ERROR', false, [$error_message[$this->language->lang('CURL_ERROR')]]);
		}
		curl_close($ch);

		if (isset($error_message))
		{
			return json_encode($error_message);
		}
		// if nothing is returned (SFS is down)
		if ($httpcode != 200)
		{
			return false;
		}

		if ($type == 'add' && $httpcode == 200)
		{
			return true;
		}

		// We made it this far, returns the results of the curl request
		return $contents;
	}

	/*
	* sfs_ban
	* @param 	$type 			ban by either IP or username
	* @param	$user_info		the users info of who we are banning
	* @return 	null
	*/
	public function sfs_ban($type, $user_info, $check = 0)
	{
		if (!function_exists('user_ban'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->php_ext);
		}

		if ($this->config['sfs_ban_ip'])
		{
			$lang_display = ($type == 'user') ? $this->language->lang('SFS_USER_BANNED') : $this->language->lang('SFS_BANNED', (int) $check);
			$ban_reason = (!empty($this->config['sfs_ban_reason'])) ? $lang_display : '';
			// ban the nub
			user_ban($type, $user_info, (int) $this->config['sfs_ban_time'], 0, false, $lang_display, $ban_reason);
		}
		return;
	}
}
