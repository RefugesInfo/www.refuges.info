<?php

/*
 * Cleantalk Base class
 * Compatible only with phpBB 3.1+
 * @version 1.5-phpbb
 * author Cleantalk team (welcome@cleantalk.org)
 * copyright (C) 2014 CleanTalk team (http://cleantalk.org)
 * license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 * see https://github.com/CleanTalk/php-antispam
*/


namespace cleantalk\antispam\model;
use phpbb\template\template;
use phpbb\config\config;
use phpbb\request\request;
use phpbb\user;
use phpbb\db\driver\driver_interface;

class CleantalkSFW
{
	public $ip = 0;
	public $ip_str = '';
	public $ip_array = Array();
	public $ip_str_array = Array();
	public $blocked_ip = '';
	public $passed_ip = '';
	public $result = false;
	
	//Database variables
	private $db_result;
	private $db_result_data = array();
	
	private $cdn_cf = array(
		'103.21.244.0/22',
		'103.22.200.0/22',
		'103.31.4.0/22',
		'104.16.0.0/12',
		'108.162.192.0/18',
		'131.0.72.0/22',
		'141.101.64.0/18',
		'162.158.0.0/15',
		'172.64.0.0/13',
		'173.245.48.0/20',
		'188.114.96.0/20',
		'190.93.240.0/20',
		'197.234.240.0/22',
		'198.41.128.0/17',
	);

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\request\request */
	protected $request;

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;
	
	/** @var string */
	protected $table_prefix;

	/**
	* Constructor
	* @param config			$config		Config object
	* @param user			$user		User object
	* @param request		$request	Request object
	* @param driver_interface 	$db 		The database object
	*/
	public function __construct(template $template, config $config, user $user, request $request, driver_interface $db, $table_prefix)
	{	
		$this->template = $template;
		$this->config = $config;
		$this->user = $user;
		$this->request = $request;		
		$this->table_prefix = $table_prefix;
		$this->db = $db;
	}
	
	public function universal_query($query)
	{
		$this->db_result = $this->db->sql_query($query);
	}
	
	public function universal_fetch()
	{
		$this->db_result_data = $this->db->sql_fetchrow($this->db_result);
		$this->db->sql_freeresult($this->db_result);
	}

	public function universal_fetch_all()
	{
		$this->db_result_data = $this->db->sql_fetchrowset($this->db_result);
		$this->db->sql_freeresult($this->db_result);
	}
	
	
	/*
	*	Getting arrays of IP (REMOTE_ADDR, X-Forwarded-For, sfw_test_ip)
	* 
	*	reutrns array
	*/
	public function get_ip()
	{	
		$cdn = $this->cdn_cf;
		$result = Array();
		
		// Getting IP
		$result['remote_addr'] = filter_var( $this->request->server('REMOTE_ADDR'), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		$this->ip_str_array[] = $result['remote_addr'];
		$this->ip_array[]=sprintf("%u", ip2long($result['remote_addr']));
		
		// Getting test IP
		$sfw_test_ip = $this->request->variable('sfw_test_ip', '');
		if($sfw_test_ip)
		{
			$result['sfw_test_ip'] = filter_var( $sfw_test_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
			$this->ip_str_array[]=$result['sfw_test_ip'];
			$this->ip_array[]=sprintf("%u", ip2long($result['sfw_test_ip']));
		}
		
		if($this->request->server('HTTP_CF_CONNECTING_IP'))
		{
			foreach($cdn as $cidr)
			{
				if($this->ip_mask_match($result['remote_addr'], $cidr))
				{
					$result['cf_connecting_ip'] = filter_var( $this->request->server('Cf_Connecting_Ip'), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
					$this->ip_array[] = sprintf("%u", ip2long($result['cf_connecting_ip']));
					unset($result['remote_addr']);
					break;
				}
			}
		}
		
		return array_unique($result);
	}
	
	public function ip_mask_match($ip, $cidr)
	{
		$exploded = explode ('/', $cidr);
		$net = $exploded[0];
		$mask = 4294967295 << (32 - $exploded[1]);
		return (ip2long($ip) & $mask) == (ip2long($net) & $mask);
	}
	
	/*
	*	Checks IP via Database
	*/
	public function check_ip()
	{			
		for($i=0, $arr_count = sizeof($this->ip_array); $i < $arr_count; $i++)
		{
			$query = "SELECT 
				network, mask, status
				FROM ".$this->table_prefix."cleantalk_sfw
				WHERE network = ".intval($this->ip_array[$i])." & mask
				ORDER BY status DESC LIMIT 1";
			$this->universal_query($query);
			$this->universal_fetch();

			if($this->db_result_data && $this->db_result_data['status'] == 0)
			{
				$this->result = true;
				$this->blocked_ip=$this->ip_str_array[$i];
			}
			else
			{
				$this->passed_ip = $this->ip_str_array[$i];
			}
		}
	}
	/**
	* Check new visitors for SFW database
	* @return void
	*/
	public function sfw_check()
	{	
		if ($this->config['cleantalk_antispam_sfw_enabled'] && $this->config['cleantalk_antispam_key_is_ok'])
		{			
			$is_sfw_check = true;

			$ip = $this->get_ip();
			
			$cookie_prefix = $this->config['cookie_name'] ? $this->config['cookie_name'].'_' : '';
			$cookie_domain = $this->config['cookie_domain'] ? " domain={$this->config['cookie_domain']};" : ''; 
			
			$ct_sfw_pass_key 	= $this->request->variable($cookie_prefix.'ct_sfw_pass_key', '', false, \phpbb\request\request_interface::COOKIE);
			$ct_sfw_passed 		= $this->request->variable($cookie_prefix.'ct_sfw_passed', '', false, \phpbb\request\request_interface::COOKIE);
			
			foreach ($ip as $ct_cur_ip)
			{								
				if ($ct_sfw_pass_key == md5($ct_cur_ip.$this->config['cleantalk_antispam_apikey']))
				{	
					$is_sfw_check = false;
					if ($ct_sfw_passed)
					{
						$this->sfw_update_logs($ct_cur_ip, 'passed');
						$this->user->set_cookie('ct_sfw_passed', '0', 10);
					}
				}
				
			} unset($ct_cur_ip);
			if ($is_sfw_check)
			{
				$this->check_ip();
				if($this->result)
				{
					$this->sfw_update_logs($this->blocked_ip, 'blocked');
					$this->sfw_die($cookie_prefix, $cookie_domain);
				}
				else
				{
					$this->user->set_cookie('ct_sfw_pass_key', md5($this->passed_ip.$this->config['cleantalk_antispam_apikey']), 0);
				}
			}			
		}
	}		
	/*
	*	Add entry to SFW log
	*/
	public function sfw_update_logs($ip, $result)
	{	
		if($ip === NULL || $result === NULL)
		{
			return;
		}
		
		$blocked = ($result == 'blocked' ? ' + 1' : '');
		$time = time();
		$ip = filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		
		$query = "SELECT COUNT(*) as cnt
			FROM ".$this->table_prefix."cleantalk_sfw_logs
			WHERE ip = '".$this->db->sql_escape($ip)."'";
		$this->universal_query($query);
		$this->universal_fetch();

		if($this->db_result_data['cnt'] > 0)
		{
			$query = "UPDATE ".$this->table_prefix."cleantalk_sfw_logs
				SET
					all_entries = all_entries + 1,
					blocked_entries = blocked_entries".strval($blocked).",
					entries_timestamp = $time
				WHERE ip = '".$this->db->sql_escape($ip)."'";
			$this->universal_query($query);
		}
		else
		{	
			$query = "INSERT INTO ".$this->table_prefix."cleantalk_sfw_logs
			SET 
				ip = '$ip',
				all_entries = 1,
				blocked_entries = 1,
				entries_timestamp = $time";
			$this->universal_query($query);
		}
	}
	
	/*
	* Updates SFW local base
	* 
	* return mixed true || array('error' => true, 'error_string' => STRING)
	*/
	public function sfw_update( $file_url_hash = null, $file_url_num = null )
	{	
		global $config, $request, $db, $table_prefix;

		if( ! isset( $file_url_hash, $file_url_num ) ){

			$result = \cleantalk\antispam\model\CleantalkHelper::get2sBlacklistsDb($config['cleantalk_antispam_apikey'], 'multifiles', '2_0');

			sleep(3);

			if(empty($result['error'])) {
			
				if( !empty($result['file_url']) ){

					if(\cleantalk\antispam\model\CleantalkHelper::sendRawRequest($result['file_url'], array(), 'get_code') === 200) {

						if(ini_get('allow_url_fopen')) {

							$pattenrs = array();
							$pattenrs = array('get', 'async');		
							$base_host_url = ($request->server('HTTPS') === 'on' ? "https" : "http") . "://".$request->server('HTTP_HOST');
							$db->sql_query("TRUNCATE TABLE `".$table_prefix."cleantalk_sfw`");
							
							if (preg_match('/multifiles/', $result['file_url'])) {
								
								$gf = gzopen($result['file_url'], 'rb');

								if ($gf) {

									$file_url_nums = array();

									while(!gzeof($gf)){
										$file_url       = trim( gzgets( $gf, 1024 ) );
										$file_url_nums[] = preg_replace( '@(https://.*)\.(\d*)(\.csv\.gz)@', '$2', $file_url );
										
										if( ! $file_url_hash )
											$file_url_hash = preg_replace( '@(https://.*)\.(\d*)(\.csv\.gz)@', '$1', $file_url );
										
									}
									return \cleantalk\antispam\model\CleantalkHelper::sendRawRequest(
										$base_host_url, 
										array(
											'spbc_remote_call_token'  => md5($config['cleantalk_antispam_apikey']),
											'spbc_remote_call_action' => 'sfw_update',
											'plugin_name'             => 'apbct',
											'file_url_hash'           => $file_url_hash,
											'file_url_nums'           => implode(',', $file_url_nums),
										),
										$pattenrs
									);								
								}
							} else 
								return array('error' => 'COULD_NOT_GET_MULTIFILE');			
						} else
							return array('error' => 'ERROR_ALLOW_URL_FOPEN_DISABLED');
					} else
						return array('error' => 'MULTIFILE_BAD_RESPONSE_CODE');	
				} else
					return array('error' => 'BAD_RESPONSE');
			} else
				return $result;
		} elseif( isset( $file_url_hash, $file_url_num ) ) {
			
			$file_url = $file_url_hash . '.' . $file_url_num . '.csv.gz';
						
			if(\cleantalk\antispam\model\CleantalkHelper::sendRawRequest($file_url, array(), 'get_code') === 200) { // Check if it's there
		
					$gf = gzopen($file_url, 'rb');

					if($gf){
						
						if(!gzeof($gf)) {
							
							for($count_result = 0; !gzeof($gf); ) {
	
								$query = "INSERT INTO ".$table_prefix."cleantalk_sfw VALUES %s";
	
								for($i=0, $values = array(); 5000 !== $i && !gzeof($gf); $i++, $count_result++) {
	
									$entry = trim(gzgets($gf, 1024));
	
									if(empty($entry)) continue;

									$entry = explode(',', $entry);
	
									// Cast result to int
									$ip   = preg_replace('/[^\d]*/', '', $entry[0]);
									$mask = preg_replace('/[^\d]*/', '', $entry[1]);
									$private = isset($entry[2]) ? $entry[2] : 0;
	
									if(!$ip || !$mask) continue;
	
									$values[] = '('. $ip .','. $mask .', '. $private .')';
	
								}

								if(!empty($values)) {
									$query = sprintf($query, implode(',', $values).';');
									$db->sql_query($query);
								}
								
							}
							
							gzclose($gf);
							return $count_result;
							
						} else
							return array('error' => 'ERROR_GZ_EMPTY');
					} else
						return array('error' => 'ERROR_OPEN_GZ_FILE');
			} else
				return array('error' => 'NO_REMOTE_FILE_FOUND');
		}		
	}
	
	/*
	* Sends and wipe SFW log
	* 
	* returns mixed true || array('error' => true, 'error_string' => STRING)
	*/
	public function send_logs($ct_key)
	{	
		global $db, $table_prefix;

		//Getting logs
		$result = $db->sql_query("SELECT * FROM ".$table_prefix."cleantalk_sfw_logs");
		$sfw_logs_data = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);		

		if(is_array($sfw_logs_data) && count($sfw_logs_data))
		{	
			//Compile logs
			$data = array();
			foreach($sfw_logs_data as $key => $value)
			{
				$data[] = array(trim($value['ip']), $value['all_entries'], $value['all_entries']-$value['blocked_entries'], $value['entries_timestamp']);
			}
			unset($key, $value);
			
			//Sending the request
			$result =\cleantalk\antispam\model\CleantalkHelper::sfwLogs($ct_key, $data);

			//Checking answer and deleting all lines from the table
			if(empty($result['error']))
			{
				if($result['rows'] == count($data))
				{
					$db->sql_query("DELETE FROM ".$table_prefix."cleantalk_sfw_logs");
					return true;
				}
			}
			else
			{
				return array('error' => $result['error']);
			}
				
		}
	}
	
	/*
	* Shows DIE page
	* 
	* Stops script executing
	*/	
	public function sfw_die($cookie_prefix = '', $cookie_domain = '')
	{
		$this->user->add_lang_ext('cleantalk/antispam', 'common');

		page_header();

		$this->template->set_filenames ( array (
			'body' => '@cleantalk_antispam/sfw_die_page.html' )
		);
		$this->template->assign_vars(array(
			'SFW_DIE_NOTICE_IP'					=> $this->user->lang('SFW_DIE_NOTICE_IP'),
			'SFW_DIE_MAKE_SURE_JS_ENABLED'		=> $this->user->lang('SFW_DIE_MAKE_SURE_JS_ENABLED'),
			'SFW_DIE_CLICK_TO_PASS'				=> $this->user->lang('SFW_DIE_CLICK_TO_PASS'),
			'SFW_DIE_YOU_WILL_BE_REDIRECTED'	=> $this->user->lang('SFW_DIE_YOU_WILL_BE_REDIRECTED'),
			'REMOTE_ADDRESS'					=> $this->blocked_ip,
			'REQUEST_URI'						=> $this->request->server('REQUEST_URI'),
			'COOKIE_PREFIX'						=> $cookie_prefix,
			'COOKIE_DOMAIN'						=> $cookie_domain,
			'SFW_COOKIE'						=> md5($this->blocked_ip.$this->config['cleantalk_antispam_apikey']),
			'CLEANTALK_ANTISPAM_REG_EMAIL'		=> $this->config['board_email'],
			'CLEANTALK_ANTISPAM_REG_URL'		=> $this->request->server('SERVER_NAME'),			
		));

		page_footer();

	}
			
}
