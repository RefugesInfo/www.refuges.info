<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

namespace cleantalk\antispam\model;

class main_model
{
	const JS_FIELD_NAME = 'ct_checkjs';

	/**
	* Checks user registration to spam
	*
	* @param array	$spam_check		Array with values to check
	* @return array				Array with result flags
	*/
	static public function check_spam( $spam_check )
	{
		global $config, $user, $request, $phpbb_root_path, $phpEx, $phpbb_log;
		require_once 'cleantalk.class.php';

		$ct_checkjs_val = $request->variable(self::JS_FIELD_NAME, '', false, \phpbb\request\request_interface::COOKIE);
		if ($ct_checkjs_val === '')
		{
			$checkjs = NULL;
		}
		//elseif ($ct_checkjs_val == self::get_check_js_value())
		elseif (in_array($ct_checkjs_val, self::get_check_js_array()))
		{
			$checkjs = 1;
		}
		else
		{
			$checkjs = 0;
		}

		$ct = new \CleanTalkBase\Cleantalk();
		
		$root_dir= realpath(dirname(__FILE__).'/../../../../');
		if(file_exists($root_dir."/cleantalk.pem"))
		{
			$ct->ssl_on = true;
			$ct->ssl_path = $root_dir."/cleantalk.pem";
		}

		$ct->work_url       = $config['cleantalk_antispam_work_url'];
		$ct->server_url     = $config['cleantalk_antispam_server_url'];
		$ct->server_ttl     = $config['cleantalk_antispam_server_ttl'];
		$ct->server_changed = $config['cleantalk_antispam_server_changed'];

		$user_agent = $request->server('HTTP_USER_AGENT');
		$refferrer = $request->server('HTTP_REFERER');
		$sender_info = json_encode(
			array(
			'cms_lang' => $config['default_lang'],
			'REFFERRER' => $refferrer,
			'post_url' => $refferrer,
			'USER_AGENT' => $user_agent,
			)
		);

		$composer_json = json_decode(file_get_contents($phpbb_root_path . 'ext/cleantalk/antispam/composer.json'));

		$ct_request = new \CleanTalkBase\CleantalkRequest();
		if(isset($spam_check['auth_key']))
		{
			$ct_request->auth_key = $spam_check['auth_key'];
		}
		else
		{
			$ct_request->auth_key = $config['cleantalk_antispam_apikey'];
		}
		$ct_request->agent = 'phpbb31-' . preg_replace("/(\d)\.(\w+)/", "$1$2", $composer_json->version);
		$ct_request->js_on = $checkjs;
		$ct_request->sender_info = $sender_info;
		$ct_request->sender_email = array_key_exists('sender_email', $spam_check) ? $spam_check['sender_email'] : '';
		$ct_request->sender_nickname = array_key_exists('sender_nickname', $spam_check) ? $spam_check['sender_nickname'] : '';
		$ct_request->sender_ip = $user->ip;
		$ct_request->submit_time = (!empty($user->data['ct_submit_time'])) ? time() - $user->data['ct_submit_time'] : null;

		switch ($spam_check['type'])
		{
		case 'comment':
			$ct_request->message = (array_key_exists('message_title', $spam_check) ? $spam_check['message_title'] : '' ).
				" \n\n" .
				(array_key_exists('message_body', $spam_check) ? $spam_check['message_body'] : '');
			$ct_result = $ct->isAllowMessage($ct_request);
			 break;
		case 'register':
			$ct_request->tz = array_key_exists('timezone', $spam_check) ? $spam_check['timezone'] : '';
			 $ct_result = $ct->isAllowUser($ct_request);
			break;
		}
		$ret_val = array();
		$ret_val['errno'] = 0;
		$ret_val['allow'] = 1;
		$ret_val['ct_request_id'] = $ct_result->id;

		if ($ct->server_change)
		{
			$config->set('cleantalk_antispam_work_url',       $ct->work_url);
			$config->set('cleantalk_antispam_server_url',     $ct->server_url);
			$config->set('cleantalk_antispam_server_ttl',     $ct->server_ttl);
			$config->set('cleantalk_antispam_server_changed', time());
		}

		// First check errstr flag.
		if (!empty($ct_result->errstr) && $checkjs = 1
			|| (!empty($ct_result->inactive) && $ct_result->inactive == 1)
		)
		{
			// Cleantalk error so we go default way (no action at all).
			$ret_val['errno'] = 1;
			$ct_result->allow = 1;
			if (!empty($ct_result->errstr))
			{
				$ret_val['errstr'] = self::filter_response($ct_result->errstr);
			}
			else
			{
				$ret_val['errstr'] = self::filter_response($ct_result->comment);
			}

			$phpbb_log->add('admin', ANONYMOUS, '127.0.0.1', 'LOG_CLEANTALK_ERROR', time(), array($ret_val['errstr']));

			// Email to admin once per 15 min
			if (time() - 900 > $config['cleantalk_antispam_error_time'])
			{
				$config->set('cleantalk_antispam_error_time', time());
				if (!function_exists('phpbb_mail'))
				{
					include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
				}

				$hr_url = str_replace(array('http://', 'https://'), array('', ''), generate_board_url());
				$err_title = $hr_url. ' - ' . $user->lang['MAIL_CLEANTALK_ERROR'];
				$err_message = $hr_url. ' - ' . $user->lang['MAIL_CLEANTALK_ERROR'] . " :\n" . $ret_val['errstr'];

				$headers = array();
				$headers[] = 'Reply-To: ' . $config['board_email'];
				$headers[] = 'Return-Path: <' . $config['board_email'] . '>';
				$headers[] = 'Sender: <' . $config['board_email'] . '>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'X-Mailer: phpBB3';
				$headers[] = 'X-MimeOLE: phpBB3';
				$headers[] = 'X-phpBB-Origin: phpbb://' . $hr_url;
				$headers[] = 'Content-Type: text/plain; charset=UTF-8'; // format=flowed
				$headers[] = 'Content-Transfer-Encoding: 8bit'; // 7bit

				$dummy = '';
				phpbb_mail($config['board_email'], $err_title, $err_message, $headers, "\n", $dummy);
			}

			return $ret_val;
		}
		else if (!empty($ct_result->errstr) && $checkjs = 0)
		{
			$ct_result->allow = 0;
		}

		if ($ct_result->allow == 0)
		{
			// Spammer.
			$ret_val['allow'] = 0;
			$ret_val['ct_result_comment'] = self::filter_response($ct_result->comment);

			// Check stop_queue flag.
			if ($spam_check['type'] == 'comment' && $ct_result->stop_queue == 0)
			{
				// Spammer and stop_queue == 0 - to manual approvement.
				$ret_val['stop_queue'] = 0;
			}
			else
			{
				// New user or Spammer and stop_queue == 1 - display form error message.
				$ret_val['stop_queue'] = 1;
			}
		}
	return $ret_val;
	}

	/**
	* Filters raw CleanTalk cloud response
	*
	* @param string	$ct_response		Raw CleanTalk cloud response
	* @return string			Filtered CleanTalk cloud response
	*/
	static public function filter_response( $ct_response )
	{
		if (preg_match('//u', $ct_response))
		{
			$err_str = preg_replace('/\*\*\*/iu', '', $ct_response);
		}
		else
		{
			$err_str = preg_replace('/\*\*\*/i', '', $ct_response);
		}
		return $err_str;
	}

	/**
	* Sets from display time in table
	*/
	static public function set_submit_time()
	{
		global $db, $user;
		$sql = 'UPDATE ' . SESSIONS_TABLE . 
			' SET ct_submit_time = ' . time() .
			' WHERE session_id = \'' . $db->sql_escape($user->session_id) . '\'';
		$db->sql_query($sql);
	}

	/**
	* Gets session-unique hash for JS-enabled checking
	*
	* @return string			Session-unique hash
	*/
	static public function get_check_js_value()
	{
		global $config;
		return md5($config['cleantalk_antispam_apikey'] . date("Ymd",time()));
	}
	
	/** Return Array of JS-keys for checking
	*
	* @return Array
	*/
	static public function get_check_js_array()
	{
		global $config;
		$result=Array();
		for($i=-5;$i<=1;$i++)
		{
			$result[]=md5($config['cleantalk_antispam_apikey'] . date("Ymd",time()+86400*$i));
		}
		return $result;
	}

	/**
	* Gets conplete JS-code with session-unique hash to insert into template for JS-ebabled checkibg
	*
	* @return string			JS-code
	*/
	static public function get_check_js_script()
	{
		$ct_check_def = '0';
		if (!isset($_COOKIE[self::JS_FIELD_NAME]))
		{
			setcookie(self::JS_FIELD_NAME, $ct_check_def, 0, '/');
		}
		$ct_check_value = self::get_check_js_value();
		$js_template = '<script type="text/javascript">function ctSetCookie(c_name,value){document.cookie=c_name+"="+escape(value)+"; path=/";} setTimeout("ctSetCookie(\"%s\", \"%s\");",1000);</script>';
		$ct_addon_body = sprintf($js_template, self::JS_FIELD_NAME, $ct_check_value);
		return $ct_addon_body;
	}
}
