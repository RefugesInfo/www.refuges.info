<?php
/**
 * Cleantalk's hepler class
 * Compatible only with phpBB 3.1+
 *
 * Mostly contains request's wrappers.
 *
 * @version 2.4
 * @package Cleantalk
 * @subpackage Helper
 * @author Cleantalk team (welcome@cleantalk.org)
 * @copyright (C) 2014 CleanTalk team (http://cleantalk.org)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 * @see https://github.com/CleanTalk/php-antispam 
 *
 */

namespace cleantalk\antispam\model;

class CleantalkHelper
{
	
	const URL = 'https://api.cleantalk.org'; // CleanTalk's API url
	
	/*
	*	Checking api_key
	*	returns (boolean)
	*/

	static public function apbct_key_is_correct($api_key = '') {

		return preg_match('/^[a-z\d]{3,15}$|^$/', $api_key);

	}
	
	/**
	 * Function gets access key automatically
	 *
	 * @param string admin's email
	 * @param string website's host
	 * @param string website's platform
	 * @param string website's timezone
	 * @param bool perform check flag
	 * @return mixed (STRING || array('error' => true, 'error_string' => STRING))
	 */
	static public function getApiKey($email, $host, $platform, $timezone = null, $do_check = true)
	{
		$request = array(
			'method_name' => 'get_api_key',
			'email' => $email,
			'website' => $host,
			'platform' => $platform,
			'timezone' => $timezone,
			'product_name' => 'antispam'
		);
		
		$result = self::sendRawRequest(self::URL, $request);
		$result = $do_check ? self::checkRequestResult($result, 'get_api_key') : $result;
		
		return $result;
	}

	/**
	 * Function gets information about renew notice
	 *
	 * @param string api_key
	 * @param bool perform check flag
	 * @return mixed (STRING || array('error' => true, 'error_string' => STRING))
	 */
	static public function noticePaidTill($api_key, $do_check = true)
	{
		$request = array(
			'method_name' => 'notice_paid_till',
			'auth_key' => $api_key
		);
		
		$result = self::sendRawRequest(self::URL, $request);
		$result = $do_check ? self::checkRequestResult($result, 'notice_paid_till') : $result;
		
		return $result;
	}
	
	/**
	 * Function gets information about account
	 *
	 * @param string api_key
	 * @param bool perform check flag
	 * @return mixed (STRING || array('error' => true, 'error_string' => STRING))
	 */
	static public function getAccountStatus($api_key, $do_check = true)
	{
		$request = array(
			'method_name' => 'get_account_status',
			'auth_key' => $api_key
		);
		
		$result = self::sendRawRequest(self::URL, $request);
		$result = $do_check ? self::checkRequestResult($result, 'get_account_status') : $result;
		
		return $result;
	}

	/*
	* Wrapper for 2s_blacklists_db API method
	* 
	* returns mixed STRING || array('error' => true, 'error_string' => STRING)
	*/
	static public function get2sBlacklistsDb($api_key, $do_check = true)
	{		
		$request = array(
			'method_name' => '2s_blacklists_db',
			'auth_key' => $api_key,			
		);
		
		$result = self::sendRawRequest(self::URL, $request);
		$result = $do_check ? self::checkRequestResult($result, '2s_blacklists_db') : $result;
		
		return $result;
	}

	/*
	* Wrapper for sfw_logs API method
	* 
	* returns mixed STRING || array('error' => true, 'error_string' => STRING)
	*/
	static public function sfwLogs($api_key, $data, $do_check = true)
	{		
		$request = array(
			'auth_key' => $api_key,
			'method_name' => 'sfw_logs',
			'data' => json_encode($data),
			'rows' => count($data),
			'timestamp' => time()
		);
		$result = self::sendRawRequest(self::URL, $request);
		$result = $do_check ? self::checkRequestResult($result, 'sfw_logs') : $result;
		
		return $result;
	}

	/**
	 * Function gets information about renew notice
	 *
	 * @param string api_key
	 * @param string data "ip1,ip2,ip3..."
	 * @param bool perform check flag
	 * @return mixed (STRING || array('error' => true, 'error_string' => STRING))
	 */
	static public function spamCheckCms($api_key, $data, $do_check = true)
	{	
		$request = array(
			'method_name' => 'spam_check_cms',
			'auth_key' => $api_key,
			'data' => implode(',',$data),
		);
		
		$result = self::sendRawRequest(self::URL, $request, false, 15);
		$result = $do_check ? $result = self::checkRequestResult($result, 'spam_check_cms') : $result;
		
		return $result;
	}	
	
	/**
	 * Function gets spam report
	 *
	 * @param string website host
	 * @param integer report days
	 * @param bool perform check flag
	 * @return mixed (STRING || array('error' => true, 'error_string' => STRING))
	 */
	static public function getAntispamReport($host, $period = 1, $do_check = true)
	{
		$request = array(
			'method_name' => 'get_antispam_report',
			'hostname' => $host,
			'period' => $period
		);
		
		$result = self::sendRawRequest(self::URL, $request);
		$result = $do_check ? $result = self::checkRequestResult($result, 'get_antispam_report') : $result;
		
		return $result;
	}


	/**
	 * Function checks server response
	 *
	 * @param string result
	 * @param string request_method
	 * @return mixed (array || array('error' => true, 'error_string' => STRING))
	 */
	static public function checkRequestResult($result, $method_name = null)
	{		
		// Errors handling
		
		// Bad connection
		if(empty($result))
		{
			return array(
				'error' => true,
				'error_string' => 'CONNECTION_ERROR'
			);
		}
		
		// JSON decode errors
		$result = json_decode($result, true);
		if(empty($result))
		{
			return array(
				'error' => true,
				'error_string' => 'JSON_DECODE_ERROR'
			);
		}
		
		// Server errors
		if($result && (isset($result['error_no']) || isset($result['error_message'])))
		{
			return array(
				'error' => true,
				'error_string' => "SERVER_ERROR NO: {$result['error_no']} MSG: {$result['error_message']}",
				'error_no' => $result['error_no'],
				'error_message' => $result['error_message']
			);
		}
		
		// Patches for different methods
				
		// Other methods
		if(isset($result['data']) && is_array($result['data']))
		{
			return $result['data'];
		}
	}
	
	/**
	 * Function sends raw request to API server
	 *
	 * @param string url of API server
	 * @param array data to send
	 * @param boolean is data have to be JSON encoded or not
	 * @param integer connect timeout
	 * @return type
	 */
	static public function sendRawRequest($url, $data, $isJSON = false, $timeout = 3)
	{	
		$result=null;
		if(!$isJSON)
		{
			$data=http_build_query($data);
			$data=str_replace("&amp;", "&", $data);
		}
		else
		{
			$data= json_encode($data);
		}
		
		$curl_exec=false;
		
		if (function_exists('curl_init') && function_exists('json_decode'))
		{	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// resolve 'Expect: 100-continue' issue
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            // see http://stackoverflow.com/a/23322368
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
           			
			$result = curl_exec($ch);
			
			if($result !== false)
			{
				$curl_exec=true;
			}
			
			curl_close($ch);
		}
		if(!$curl_exec)
		{	
			$opts = array(
				'http'=>array(
					'method' => "POST",
					'timeout'=> $timeout,
					'content' => $data
				)
			);
			$context = stream_context_create($opts);
			$result = @file_get_contents($url, 0, $context);
		}
		
		return $result;
	}
}