<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

namespace cleantalk\antispam\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\template\template;
use phpbb\request\request;
use phpbb\user;
use phpbb\db\driver\driver_interface;
use cleantalk\antispam\model\CleantalkSFW;
use cleantalk\antispam\model\main_model;
use phpbb\symfony_request;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_language_on_setup',
			'core.user_setup_after'						=> 'sfw_check',
			'core.page_footer_after'     			    => 'add_js_to_footer',
			'core.posting_modify_submission_errors'		=> 'check_comment',
			'core.posting_modify_submit_post_before'	=> 'change_comment_approve',
			'core.user_add_modify_data'                 => 'check_newuser',
			'core.common'								=> 'ccf_check',
		);
	}
	const APBCT_REMOTE_CALL_SLEEP = 10;
	
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

	/* @var \cleantalk\antispam\model\CleantalkSFW */
	protected $cleantalk_sfw;

	/* @var \cleantalk\antispam\model\main_model */
	protected $main_model;

	/** @var \phpbb\symfony_request */
	protected $symfony_request;

	/** @var string php file extension  */
	protected $php_ext;	

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/* @var array Stores result of spam checking of post or topic when needed*/
	private $ct_comment_result;

	/**
	* Constructor
	*
	* @param template		$template	Template object
	* @param config			$config		Config object
	* @param user			$user		User object
	* @param request		$request	Request object
	* @param driver_interface 	$db 		The database object
	*/
	public function __construct(template $template, config $config, db_text $config_text, user $user, request $request, driver_interface $db, CleantalkSFW $cleantalk_sfw, main_model $main_model, symfony_request $symfony_request, $php_ext)
	{
		$this->template = $template;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->user = $user;
		$this->request = $request;
		$this->db = $db;
		$this->cleantalk_sfw = $cleantalk_sfw;
		$this->main_model = $main_model;
		$this->symfony_request = $symfony_request;
		$this->php_ext = $php_ext;
	}
	/**
	* Loads language
	*
	* @param array	$event		array with event variable values
	*/
	public function load_language_on_setup($event)
	{		
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'cleantalk/antispam',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;

	}
	/**
	* SpamFirewall Check
	*
	* @param array	$event		array with event variable values
	*/
	public function sfw_check($event)
	{
		$this->cleantalk_sfw->sfw_check();		
	}
	/**
	* Fills tamplate variable by generated JS-code with unique hash
	*
	* @param array	$event		array with event variable values
	*/
	public function add_js_to_footer($event)
	{		
		if (!$this->config['cleantalk_antispam_key_is_ok'])
		{
			return;
		}
		$this->template->assign_var('CT_JS_VALUE', $this->main_model->cleantalk_get_checkjs_code());
	}
	/**
	* Checks post or topic to spam
	*
	* @param array	$event		array with event variable values
	*/
	public function check_comment($event)
	{
		$data = $event->get_data();
		if (!$this->config['cleantalk_antispam_key_is_ok'] || $data['submit'] != 1)
		{
			return;
		}

		$moderate = false;
		$this->ct_comment_result = null;

		if ($this->config['cleantalk_antispam_guests'] && $this->user->data['is_registered'] == 0)
		{
			$moderate = true;
		}
		else if ($this->config['cleantalk_antispam_nusers'] && $this->user->data['is_registered'] == 1)
		{
			$user_group_table = USER_GROUP_TABLE;
			$group_table = GROUPS_TABLE;
			$user_id = (int) $this->user->data['user_id'];
			$sql = "SELECT g.group_name 
				FROM $user_group_table ug 
				JOIN $group_table g
				ON (ug.group_id = g.group_id)
				WHERE ug.user_id = $user_id 
				AND	g.group_name = 'NEWLY_REGISTERED'";
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			if ($row !== false && isset($row['group_name']))
			{
				$moderate = true;
			}
			$this->db->sql_freeresult($result);
			//check numposts also
			if (!$moderate)
			{
				$users_table = USERS_TABLE;
				$sql = "SELECT u.user_id
					FROM $users_table u
					WHERE u.user_id = $user_id 
					AND	u.user_posts <= 3";
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				if ($row !== false && isset($row['user_id']))
				{
					$moderate = true;
				}
				$this->db->sql_freeresult($result);								
			}

		}

		if ($moderate)
		{
			if (
				array_key_exists('post_data', $data) &&
				is_array($data['post_data']) &&
				array_key_exists('username', $data['post_data']) &&
				array_key_exists('post_subject', $data['post_data'])
			)
			{
				$spam_check = array();
				$spam_check['type'] = 'comment';
				$spam_check['sender_email'] = '';
				$spam_check['sender_nickname'] = '';
				if (isset($this->user->data))
				{
					$spam_check['sender_email'] = $this->user->data['user_email'];
					$spam_check['sender_nickname'] = $this->user->data['username'];
				}
				else
				{
					if (array_key_exists('user_email', $data['post_data']))
					{
						$spam_check['sender_email'] = $data['post_data']['user_email'];
					}
					if (array_key_exists('username', $data['post_data']))
					{
						$spam_check['sender_nickname'] = $data['post_data']['username'];
					}					
				}

				if (array_key_exists('post_subject', $data['post_data'])) 
				{
					$spam_check['message_title'] = $data['post_data']['post_subject'];
				}
				$spam_check['message_body'] = $this->request->variable('message', '', true);
				$result = $this->main_model->check_spam($spam_check);

				if ($result['errno'] == 0 && $result['allow'] == 0) // Spammer exactly.
				{ 
					if ($result['stop_queue'] == 1)
					{
						// Output error
						array_push($data['error'], $result['ct_result_comment']);
						$event->set_data($data);
					}
					else
					{
						// No error output but send comment to manual approvement
						$this->ct_comment_result = $result;
					}
				}
			}
		}
	}
	/**
	* Marks soft-spam post or comment as manual approvement needed
	*
	* @param array	$event		array with event variable values
	*/
	public function change_comment_approve($event)
	{
		if (!$this->config['cleantalk_antispam_key_is_ok'])
		{
			return;
		}

		// 'stop_queue' = 0 means to manual approvement
		if (isset($this->ct_comment_result) && is_array($this->ct_comment_result) && $this->ct_comment_result['stop_queue'] == 0)
		{
			$data = $event->get_data();
			$data['data']['post_visibility'] = ITEM_UNAPPROVED;
			$data['data']['topic_visibility'] = ITEM_UNAPPROVED;
			$data['data']['force_approved_state'] = 0;
			$event->set_data($data);
		}
	}
	/**
	* Checks user registration to spam
	*
	* @param array	$event		array with event variable values
	*/
	public function check_newuser($event)
	{
		if (!$this->config['cleantalk_antispam_key_is_ok'])
		{
			return;
		}

		if ($this->config['cleantalk_antispam_regs'])
		{
			$data = $event->get_data();
			if (
				array_key_exists('user_row', $data) &&
				is_array($data['user_row']) &&
				array_key_exists('username', $data['user_row']) &&
				array_key_exists('user_email', $data['user_row'])
			)
			{
				$spam_check = array();
				$spam_check['type'] = 'register';
				$spam_check['sender_email'] = $data['user_row']['user_email'];
				$spam_check['sender_nickname'] = $data['user_row']['username'];
				if (array_key_exists('user_timezone', $data['user_row'])) {
					$spam_check['timezone'] = $data['user_row']['user_timezone'];
				}
				$result = $this->main_model->check_spam($spam_check);
				if ($result['errno'] == 0 && $result['allow'] == 0) // Spammer exactly.
				{
					trigger_error($result['ct_result_comment']);
				}
			}
		}
	}
	/**
	* CCF check
	*
	* @param array	$event		array with event variable values
	*/
	public function ccf_check($event)
	{
		$this->main_model->set_cookie();

		//Remote calls
		if ($this->request->variable('spbc_remote_call_token', '') && $this->request->variable('spbc_remote_call_action','') && $this->request->variable('plugin_name', '') && in_array($this->request->variable('plugin_name',''), array('antispam','anti-spam', 'apbct')))
		{
	        $remote_calls_config = $this->config_text->get_array(array('cleantalk_antispam_remote_calls'));
	        $remote_calls = isset($remote_calls_config['cleantalk_antispam_remote_calls']) ? json_decode($remote_calls_config['cleantalk_antispam_remote_calls'],true) : null;
	        $remote_action = $this->request->variable('spbc_remote_call_action', '');
	        $auth_key = $this->config['cleantalk_antispam_apikey'];

	        if(array_key_exists($remote_action, $remote_calls)){
	                    
	            if(time() - $remote_calls[$remote_action]['last_call'] > self::APBCT_REMOTE_CALL_SLEEP){
	                
	                $remote_calls[$remote_action]['last_call'] = time();
	                $this->config_text->set_array(array(
	                	'cleantalk_antispam_remote_calls' => json_encode($remote_calls),
	                ));

	                if(strtolower($this->request->variable('spbc_remote_call_token','')) == strtolower(md5($auth_key))){

	                    // Close renew banner
	                    if($this->request->variable('spbc_remote_call_action','') == 'close_renew_banner'){
	                        die('OK');
	                    // SFW update
	                    }elseif($this->request->variable('spbc_remote_call_action','') == 'sfw_update'){   
	                        $result = $this->cleantalk_sfw->sfw_update($this->config['cleantalk_antispam_apikey']);             
	                        die(empty($result['error']) ? 'OK' : 'FAIL '.json_encode(array('error' => $result['error_string'])));
	                    // SFW send logs
	                    }elseif($this->request->variable('spbc_remote_call_action','') == 'sfw_send_logs'){  
	                        $result = $this->cleantalk_sfw->send_logs($this->config['cleantalk_antispam_apikey']);              
	                        die(empty($result['error']) ? 'OK' : 'FAIL '.json_encode(array('error' => $result['error_string'])));
	                    // Update plugin
	                    }elseif($this->request->variable('spbc_remote_call_action','') == 'update_plugin'){
	                        //add_action('wp', 'apbct_update', 1);
	                    }else
	                        die('FAIL '.json_encode(array('error' => 'UNKNOWN_ACTION_2')));
	                }else
	                    die('FAIL '.json_encode(array('error' => 'WRONG_TOKEN')));
	            }else
	                die('FAIL '.json_encode(array('error' => 'TOO_MANY_ATTEMPTS')));
	        }else
	            die('FAIL '.json_encode(array('error' => 'UNKNOWN_ACTION')));
		}

		if ($this->config['cleantalk_antispam_ccf'] && !in_array($this->symfony_request->getScriptName(), array('/adm/index.'.$this->php_ext,'/ucp.'.$this->php_ext,'/posting.'.$this->php_ext)) && $this->request->variable('submit',''))
		{
			//Checking contact form
			$this->ct_comment_result = null;
			$spam_check = array();	

			$spam_check['sender_email'] = $this->request->variable('email','');
			$spam_check['sender_nickname'] = $this->request->variable('name','');
			$spam_check['message_title'] = $this->request->variable('subject','');
			$spam_check['message_body'] = $this->request->variable('message','');
			
			if ($spam_check['sender_email'] !== '' || $spam_check['message_title'] !== '' || $spam_check['message_body'] !== '' )
			{
				$spam_check['type'] = 'contact';

				$result = $this->main_model->check_spam($spam_check);

				if ($result['errno'] == 0 && $result['allow'] == 0) // Spammer exactly.
				{				 
					// Output error
					trigger_error($result['ct_result_comment']);
				}
			}
		}
	}	
}
