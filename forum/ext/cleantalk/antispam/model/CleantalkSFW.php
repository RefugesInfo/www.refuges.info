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
				COUNT(network) AS cnt
				FROM ".$this->table_prefix."cleantalk_sfw
				WHERE network = ".intval($this->ip_array[$i])." & mask";
			$this->universal_query($query);
			$this->universal_fetch();
						
			if($this->db_result_data['cnt'])
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
	public function sfw_update($ct_key)
	{		
		$result =\cleantalk\antispam\model\CleantalkHelper::get2sBlacklistsDb($ct_key);
		
		if(empty($result['error']))
		{	
			$this->universal_query("DELETE FROM ".$this->table_prefix."cleantalk_sfw");
						
			// Cast result to int
			foreach($result as $value)
			{
				$value[0] = intval($value[0]);
				$value[1] = intval($value[1]);
			} unset($value);
			$sql_ary = null;
			for($i=0, $arr_count = count($result); $i < $arr_count; $i++)
			{
				$sql_ary[] = array(
					'network' => $result[$i][0],
					'mask'    => $result[$i][1],
				);
			}
			if ($sql_ary !== null)
			{
				$this->db->sql_multi_insert($this->table_prefix.'cleantalk_sfw',$sql_ary);	
			}					
			return true;
			
		}
		else
		{
			return $result['error_string'];
		}
	}
	
	/*
	* Sends and wipe SFW log
	* 
	* returns mixed true || array('error' => true, 'error_string' => STRING)
	*/
	public function send_logs($ct_key)
	{	
		//Getting logs
		$query = "SELECT * FROM ".$this->table_prefix."cleantalk_sfw_logs";
		$this->universal_query($query);
		$this->universal_fetch_all();
		
		if(count($this->db_result_data))
		{	
			//Compile logs
			$data = array();
			foreach($this->db_result_data as $key => $value)
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
					$this->universal_query("DELETE FROM ".$this->table_prefix."cleantalk_sfw_logs");
					return true;
				}
			}
			else
			{
				return $result['error_string'];
			}
				
		}
		else
		{
			return 'NO_LOGS_TO_SEND';
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
