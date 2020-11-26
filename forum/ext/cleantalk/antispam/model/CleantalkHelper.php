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

	/**
	 * Default user agent for HTTP requests
	 */
	const AGENT = 'Cleantalk-Helper/3.4';

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
	static public function get2sBlacklistsDb($api_key, $out = null, $version = '1_0', $do_check = true)
	{		
		$request = array(
			'method_name' => '2s_blacklists_db',
			'auth_key' => $api_key,	
			'out'         => $out,
            'version'	  => $version,		
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
		
		$result = self::sendRawRequest(self::URL, $request);
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
	 * Merging arrays without reseting numeric keys
	 *
	 * @param array $arr1 One-dimentional array
	 * @param array $arr2 One-dimentional array
	 *
	 * @return array Merged array
	 */
	static public function array_merge__save_numeric_keys($arr1, $arr2)
	{
		foreach($arr2 as $key => $val){
			$arr1[$key] = $val;
		}
		return $arr1;
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
	static public function sendRawRequest($url, $data = array(), $presets = null, $opts = array(), $timeout = 3)
	{	
		if (function_exists('curl_init'))
		{	
			$ch = curl_init();

			if(!empty($data)){
				$data = is_string($data) || is_int($data) ? array($data => 1) : $data;
				// Build query
				$opts[CURLOPT_POSTFIELDS] = $data;
			}

			// Merging OBLIGATORY options with GIVEN options
			$opts = self::array_merge__save_numeric_keys(
				array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CONNECTTIMEOUT_MS => 3000,
					CURLOPT_FORBID_REUSE => true,
					CURLOPT_POST => true,
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_SSL_VERIFYHOST => 0,
					CURLOPT_HTTPHEADER => array('Expect:'), // Fix for large data and old servers http://php.net/manual/ru/function.curl-setopt.php#82418
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_MAXREDIRS => 5,
				),
				$opts
			);

			// Use presets
			$presets = is_array($presets) ? $presets : explode(' ', $presets);
			foreach($presets as $preset){
				
				switch($preset){
					
					// Do not follow redirects
					case 'dont_follow_redirects':
						$opts[CURLOPT_FOLLOWLOCATION] = false;
						$opts[CURLOPT_MAXREDIRS] = 0;
						break;
					
					// Get headers only
					case 'get_code':
						$opts[CURLOPT_HEADER] = true;
						$opts[CURLOPT_NOBODY] = true;
						break;
					
					// Make a request, don't wait for an answer
					case 'async':
						$opts[CURLOPT_CONNECTTIMEOUT_MS] = 1000;
						$opts[CURLOPT_TIMEOUT_MS] = 1000;
						break;
					
					case 'get':
						$opts[CURLOPT_URL] .= $data ? '?' . str_replace("&amp;", "&", http_build_query($data)) : '';
						$opts[CURLOPT_CUSTOMREQUEST] = 'GET';
						$opts[CURLOPT_POST] = false;
						$opts[CURLOPT_POSTFIELDS] = null;
						break;
					
					case 'ssl':
						$opts[CURLOPT_SSL_VERIFYPEER] = true;
						$opts[CURLOPT_SSL_VERIFYHOST] = 2;
						if(defined('CLEANTALK_CASERT_PATH') && CLEANTALK_CASERT_PATH)
							$opts[CURLOPT_CAINFO] = CLEANTALK_CASERT_PATH;
						break;
					
					default:
						
						break;
				}
				
			}
			unset($preset);

           	curl_setopt_array($ch, $opts);		
			$result = curl_exec($ch);

			// RETURN if async request
			if(in_array('async', $presets))
				return true;
			
			if($result){
				
				if(strpos($result, PHP_EOL) !== false && !in_array('dont_split_to_array', $presets))
					$result = explode(PHP_EOL, $result);
				
				// Get code crossPHP method
				if(in_array('get_code', $presets)){
					$curl_info = curl_getinfo($ch);
					$result = $curl_info['http_code'];
				}
				curl_close($ch);
				$out = $result;
			}else
				$out = array('error' => curl_error($ch));
		} else {
			$out = array('error' => 'CURL_NOT_INSTALLED');
		}

		/**
		 * Getting HTTP-response code without cURL
		 */
		if($presets && ($presets == 'get_code' || (is_array($presets) && in_array('get_code', $presets)))
			&& isset($out['error']) && $out['error'] == 'CURL_NOT_INSTALLED'
		){
			$headers = get_headers($url);
			$out = (int)preg_replace('/.*(\d{3}).*/', '$1', $headers[0]);
		}

		return $out;
	}
}