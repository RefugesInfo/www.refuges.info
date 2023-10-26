<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

namespace cleantalk\antispam\acp;

use cleantalk\antispam\library\Cleantalk\Common\API;
use cleantalk\antispam\library\Cleantalk\Errors;

class main_module
{
	function main($id, $mode)
	{
		global $user, $template, $request, $config, $db, $table_prefix, $phpbb_root_path, $phpEx, $phpbb_container;

		$config_text = $phpbb_container->get('config_text');

		$user->add_lang('acp/common');
		$this->tpl_name = 'settings_body';
		$this->page_title = $user->lang('ACP_CLEANTALK_TITLE');
		add_form_key('cleantalk/antispam');

		if ($request->is_set_post('submit') || $request->is_set_post('get_key_auto'))
		{
			
			if (!check_form_key('cleantalk/antispam'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('cleantalk_antispam_regs', $request->variable('cleantalk_antispam_regs', 0));
			$config->set('cleantalk_antispam_guests', $request->variable('cleantalk_antispam_guests', 0));
			$config->set('cleantalk_antispam_nusers', $request->variable('cleantalk_antispam_nusers', 0));
			$config->set('cleantalk_antispam_ccf', $request->variable('cleantalk_antispam_ccf',0));
			$config->set('cleantalk_antispam_sfw_enabled', $request->variable('cleantalk_antispam_sfw_enabled', 0));
			
			$key_is_valid = false;
			$key_is_ok = false;
			
			if($request->is_set_post('submit'))
			{
				$config->set('cleantalk_antispam_apikey', $request->variable('cleantalk_antispam_apikey', ''));
			}
			
			if($request->is_set_post('get_key_auto'))
			{
							
				$result = \cleantalk\antispam\model\CleantalkHelper::getApiKey(
					$config['board_email'],
					$request->server('SERVER_NAME'),
					'phpbb31'
				);
				
				if(empty($result['error']))
				{						
					$config->set('cleantalk_antispam_apikey', $result['auth_key']);
					$savekey = $result['auth_key'];
					$key_is_valid = true;
				}
			}
			
			$savekey = $key_is_valid ? $savekey : $request->variable('cleantalk_antispam_apikey', '');
							
			if(!$key_is_valid)
			{
				$result =\cleantalk\antispam\model\CleantalkHelper::apbct_key_is_correct($savekey);
				$key_is_valid = ($result) ? true: false;
			}

            if($key_is_valid)
            {
                $result = API::methodNoticePaidTill(
                    $savekey,
                    $config['server_name']
                );

                // Key is not valid
                if (isset($result['valid']) && (int)$result['valid'] === 0) {
                    $config->set('cleantalk_antispam_key_is_ok', 0);
                    trigger_error($user->lang('ACP_CLEANTALK_APIKEY_IS_BAD_LABEL') . adm_back_link($this->u_action));
                } elseif (!empty($result['error'])) {
                    $config->set('cleantalk_antispam_key_is_ok', 0);
                    trigger_error($result['error'] . adm_back_link($this->u_action));
                } else {
                    $key_is_ok = true;

                    $config->set('cleantalk_antispam_show_notice', ($result['show_notice']) ? $result['show_notice'] : 0);
                    $config->set('cleantalk_antispam_renew',       ($result['renew']) ? $result['renew'] : 0);
                    $config->set('cleantalk_antispam_trial',       ($result['trial']) ? $result['trial'] : 0);
                    $config->set('cleantalk_antispam_user_token',  ($result['user_token']) ? $result['user_token'] : '');
                    $config->set('cleantalk_antispam_spam_count',  ($result['spam_count']) ? $result['spam_count'] : 0);
                    $config->set('cleantalk_antispam_moderate_ip', ($result['moderate_ip']) ? $result['moderate_ip'] : 0);
                    $config->set('cleantalk_antispam_moderate', ($result['moderate']) ? $result['moderate'] : 0);
                    $config->set('cleantalk_antispam_show_review', ($result['show_review']) ? $result['show_review'] : 0);
                    $config->set('cleantalk_antispam_service_id', ($result['service_id']) ? $result['service_id'] : 0);
                    $config->set('cleantalk_antispam_ip_license',  ($result['ip_license']) ? $result['ip_license'] : 0);
                    $config->set('cleantalk_antispam_check_payment_status_last_gc', time());
                    $config->set('cleantalk_antispam_account_name_ob', ($result['account_name_ob']) ? $result['account_name_ob'] : '');

                    if ($config['cleantalk_antispam_sfw_enabled'])
                    {
                        $sfw_update = $this->sfw_update($savekey);
                        if (isset($sfw_update['error'])) {
                        	Errors::addError('sfw_update_error', $sfw_update['error']);
                            trigger_error($sfw_update['error'] . adm_back_link($this->u_action));
                        } else {
                        	Errors::removeError('sfw_update_error');
						}
                        $sfw_send_logs = $this->sfw_send_logs($savekey);
                        if (isset($sfw_send_logs['error'])) {
							Errors::addError('sfw_send_logs_error', $sfw_send_logs['error']);
                            trigger_error($sfw_send_logs['error'] . adm_back_link($this->u_action));
                        } else {
							Errors::removeError('sfw_send_logs_error');
						}
                    }
                }
            }
            $config->set('cleantalk_antispam_key_is_ok', ($key_is_ok) ? 1 : 0);
			
			trigger_error($user->lang('ACP_CLEANTALK_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$stat_requests = $config_text->get_array(array('cleantalk_stats__requests'));
		$stat_requests = isset($stat_requests['cleantalk_stats__requests']) ? json_decode($stat_requests['cleantalk_stats__requests'], true) : null;

		// Errors
		$errors = Errors::getErrors();
		
		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'CLEANTALK_ERRORS'				=> (bool) count($errors),
			'CLEANTALK_ERRORS_MSG'			=> implode('<br />', array_values($errors)),
			'CLEANTALK_ANTISPAM_REGS'		=> (bool)$config['cleantalk_antispam_regs'],
			'CLEANTALK_ANTISPAM_GUESTS'		=> (bool)$config['cleantalk_antispam_guests'],
			'CLEANTALK_ANTISPAM_NUSERS'		=> (bool)$config['cleantalk_antispam_nusers'],
			'CLEANTALK_ANTISPAM_CCF'		=> (bool)$config['cleantalk_antispam_ccf'],
			'CLEANTALK_ANTISPAM_SFW_ENABLED'=> (bool)$config['cleantalk_antispam_sfw_enabled'],
			'CLEANTALK_ANTISPAM_APIKEY'		=> $config['cleantalk_antispam_apikey'],
			'CLEANTALK_ANTISPAM_KEY_IS_OK'	=> (bool)$config['cleantalk_antispam_key_is_ok'],
			'CLEANTALK_ANTISPAM_USER_TOKEN'	=> $config['cleantalk_antispam_user_token'],
			'CLEANTALK_ANTISPAM_REG_EMAIL'	=> $config['board_email'],
			'CLEANTALK_ANTISPAM_REG_URL'	=> $request->server('SERVER_NAME'),
			'CLEANTALK_ANTISPAM_ACCOUNT_NAME_OB' => $config['cleantalk_antispam_account_name_ob'],
			'CLEANTALK_ANTISPAM_MODERATE_IP'=> $config['cleantalk_antispam_moderate_ip'],
			'CLEANTALK_ANTISPAM_IP_LICENSE' => $config['cleantalk_antispam_ip_license'],
			'CLEANTALK_STATS__SFW_NETS'     => $config['cleantalk_stats__sfw_nets'],
			'CLEANTALK_DEBUG'               => $config['cleantalk_debug'] ? $config['cleantalk_debug'] :'',
            'CLEANTALK_STATS__LAST_SPAM_REQUEST_TIME' => isset($config['cleantalk_stats__last_spam_request_time']) ? date('M d Y H:i:s', $config['cleantalk_stats__last_spam_request_time']) : 'unknown',
            'CLEANTALK_STATS__AVERAGE_REQUEST_TIME' => ($stat_requests && $stat_requests[min(array_keys($stat_requests))]['average_time'])
                                       ? round($stat_requests[min(array_keys($stat_requests))]['average_time'], 3)
                                       : 'unknown',
            'CLEANTALK_STATS__LAST_SFW_BLOCK_IP' => isset($config['last_sfw_block_ip']) ? $config['last_sfw_block_ip'] : 'unknown',
            'CLEANTALK_STATS__LAST_SFW_BLOCK_TIME' => isset($config['last_sfw_block_time']) ? date('M d Y H:i:s', $config['last_sfw_block_time']) : 'unknown',
            'CLEANTALK_STATS__SFW_LAST_TIME_UPDATED' => isset($config['cleantalk_stats__sfw_last_time_updated']) ? date('M d Y H:i:s', $config['cleantalk_stats__sfw_last_time_updated']) : 'unknown',
            'CLEANTALK_STATS__SFW_LAST_TIME_SEND_LOGS' => isset($config['cleantalk_antispam_sfw_logs_send_last_gc']) ? date('M d Y H:i:s', $config['cleantalk_antispam_sfw_logs_send_last_gc']) : 'unknown',
		));
		
		$user->add_lang_ext('cleantalk/antispam', 'common');

		$table_action = $request->variable('table_actions', '', false, \phpbb\request\request_interface::POST);
		$delete_user_ids = array();		

		if($table_action == 'ct_delete_all')
		{
			if (!check_form_key('cleantalk/antispam'))
			{
				trigger_error('FORM_INVALID');
			}
			
			if (!function_exists('user_delete'))
			{
				include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
			}
			$sql = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE ct_marked=1';
			$result = $db->sql_query($sql);
			
			while($row = $db->sql_fetchrow($result))
			{
				$delete_user_ids[] = $row['user_id'];
			}

			$db->sql_freeresult($result);
		}
		
		if ($table_action == 'ct_delete_checked')
		{
			if (!check_form_key('cleantalk/antispam'))
			{
				trigger_error('FORM_INVALID');
			}
			if (!function_exists('user_delete'))
			{
				include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
			}
			$ct_del_user = $request->variable('ct_del_user',   array(0), false, \phpbb\request\request_interface::POST);
			if (sizeof($ct_del_user) > 0)
			{
				foreach($ct_del_user as $key=>$value)
				{
					$delete_user_ids[] = $key;
				}				
			}
		}
		if (!empty($delete_user_ids))
		{
			user_delete('remove', $delete_user_ids);
		}

		if ($request->variable('check_spam', '', false, \phpbb\request\request_interface::POST))
		{
			if (!check_form_key('cleantalk/antispam'))
			{
				trigger_error('FORM_INVALID');
			}

            $error="";
            $check_spam_number = $request->variable('check_spam_number', '', false, \phpbb\request\request_interface::POST);

            $sql = 'UPDATE ' . USERS_TABLE . ' SET ct_marked=0 WHERE ct_marked=1';
            $db->sql_query($sql);

			if( ! is_numeric($check_spam_number) && '' !== $check_spam_number )
			{
			    $error = 'Please provide a right number to check.';
                $template->assign_var('CT_ERROR', $error);
            }

			if( '' !== $check_spam_number )
			{
                $limit = (int) $check_spam_number;
                $config->set('check_spam_number', $check_spam_number);

            }
			else
            {
                $sql = 'UPDATE ' . USERS_TABLE . ' SET ct_marked=0';
                $db->sql_query($sql);

                $limit = 0;
                $config->set('check_spam_number', '');
            }

            $template->assign_var('CLEANTALK_CHECKUSERS_NUMBER', $config['check_spam_number'] ? $config['check_spam_number'] : '');

			$sql = "SELECT user_ip, user_email FROM " . USERS_TABLE . " WHERE user_password<>'' AND ct_marked<>2 ORDER BY user_regdate DESC";
			if( $limit )
			{
				$result = $db->sql_query_limit($sql, $limit);
			}
			else
			{
				$result = $db->sql_query($sql);
			}

			$data   = array();

			while($row = $db->sql_fetchrow($result))
			{
				if (!empty($row['user_email']) && !in_array($row['user_email'], $data))
					$data[] = $row['user_email'];
				if (!empty($row['user_ip']) && !in_array($row['user_ip'], $data))
					$data[] = $row['user_ip'];
			}

			$db->sql_freeresult($result);
			
			if ($data && count($data) > 0)
			{
				$api_check_limit = 1000;
				$offset = 0;
				for ($i=0;$i < count($data);$i++)
				{
					if ($i % $api_check_limit == 0)
					{
						$result = \cleantalk\antispam\model\CleantalkHelper::spamCheckCms($config['cleantalk_antispam_apikey'], array_slice($data, $offset, $api_check_limit));
						$offset+=$api_check_limit;

						if(!empty($result['error']))
						{					
							if($result['error_string'] == 'CONNECTION_ERROR')
							{
								$error = $user->lang('ACP_CHECKUSERS_DONE_3');
							}
							else 
							{
								$error = $result['error_message'];
							}
						}
						else
						{
							foreach($result as $key => $value)
							{
								if($key === filter_var($key, FILTER_VALIDATE_IP))
								{
									if(strval($value['appears']) == 1)
									{
										$sql = "UPDATE " . USERS_TABLE . " 
										SET ct_marked=1 
										WHERE user_ip='".$db->sql_escape($key)."'";
										$db->sql_query($sql);
									}
								}
								else
								{
									if(strval($value['appears']) == 1)
									{
										$sql = "UPDATE " . USERS_TABLE . "
											SET ct_marked=1 
											WHERE user_email='".$db->sql_escape($key)."'";
										$db->sql_query($sql);
									}
									else
									{
                                        $sql = "UPDATE " . USERS_TABLE . "
											SET ct_marked=2 
											WHERE user_email='".$db->sql_escape($key)."'";
                                        $db->sql_query($sql);
                                    }
								}
							}
						}
					}
				}
				
			}
			if($error!='')
			{
				$template->assign_var('CT_ERROR', $error);
			}
		}
		$start_entry = 0;		
		if($request->is_set('start_entry', \phpbb\request\request_interface::GET))
		{
			$start_entry = $request->variable('start_entry', 1);
		}
		$on_page = 20;
		$sql = 'SELECT COUNT(user_id) AS user_count	FROM ' . USERS_TABLE . ' WHERE ct_marked = 1';
		$result = $db->sql_query($sql);
		$spam_users_count = (int)$db->sql_fetchfield('user_count');
		$db->sql_freeresult($result);

		$sql = 'SELECT user_id, username, user_regdate, user_posts, user_colour, user_email, user_ip, user_lastvisit FROM ' . USERS_TABLE . ' WHERE ct_marked = 1';
		$result = $db->sql_query_limit($sql, $on_page, $start_entry);
		$found = false;
		while($row = $db->sql_fetchrow($result))
		{			
			$found = true;
			$template->assign_block_vars('CT_SPAMMERS', array(
				'USER_POSTS_LINK'	=> append_sid($phpbb_root_path.'search.'.$phpEx, array('author_id' => $row['user_id'], 'sr' => 'posts'), false),
			    'USER_ID'			=> $row['user_id'],
			    'USER_POSTS'		=> $row['user_posts'],
			    'USERNAME'			=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
			    'JOINED'			=> (!$row['user_regdate']) ? ' - ' : $user->format_date(intval($row['user_regdate'])),
			    'USER_EMAIL'		=> $row['user_email'],
			    'USER_IP'			=> (!$row['user_ip']) ? ' - ' : $row['user_ip'],
			    'LAST_VISIT'		=> (!$row['user_lastvisit']) ? ' - ' : $user->format_date(intval($row['user_lastvisit'])),
			));
		}
		$db->sql_freeresult($result);
		$pages = ceil($spam_users_count / $on_page); 
		$server_uri = append_sid($phpbb_root_path.'adm/index.'.$phpEx,array('i'=>$request->variable('i','1')));
		if ($pages>1)
		{
			$template->assign_var('CT_PAGES_TITLE',1);
			for ($i=1; $pages >= $i; $i++)
			{
				$template->assign_block_vars('CT_PAGES_CHECKUSERS', array(
					'PAGE_LINK' => $server_uri.'&start_entry='.($i-1)*$on_page.'&curr_page='.$i,
					'PAGE_NUMBER' => $i, 
					'PAGE_STYLE' => 'background: rgba(23,96,147,'.(($request->variable('curr_page',1) == $i) ? '0.6' : '0.3').');',

				));							
			}			
		}
		if ($found)
		{
			$template->assign_var('CT_TABLE_USERS_SPAM', '1');
		}
		if(!$found && $request->variable('check_spam', '',       false, \phpbb\request\request_interface::POST))
		{
			$template->assign_var('CT_ACP_CHECKUSERS_DONE_2', '1');
		}
	}

	function sfw_update( $access_key = null ){

		global $request, $config;

		$api_server    = !empty($request->variable('api_server', ''))    ? urldecode($request->variable('api_server', ''))    : null;
		$data_id       = !empty($request->variable('data_id', ''))       ? urldecode($request->variable('data_id', ''))       : null;
		$file_url_nums = (!empty($request->variable('file_url_nums', '')) || (string) $request->variable('file_url_nums', '') === '0') ? urldecode($request->variable('file_url_nums', '')) : null;
		$file_url_nums = isset($file_url_nums) ? explode(',', $file_url_nums) : null;
		
	    if( ! isset( $api_server, $data_id, $file_url_nums ) ){
	    
			$result = \cleantalk\antispam\model\CleantalkSFW::sfw_update();
			
	    } elseif( $api_server && $data_id && is_array( $file_url_nums ) && count( $file_url_nums ) ){

			$result = \cleantalk\antispam\model\CleantalkSFW::sfw_update( $api_server, $data_id, $file_url_nums[0] );

			if(empty($result['error'])){

				array_shift($file_url_nums);

				if (count($file_url_nums)) {
					\cleantalk\antispam\model\CleantalkHelper::sendRawRequest(
						($request->server('HTTPS', '') === 'on' ? "https" : "http") . "://".$request->server('HTTP_HOST', ''), 
						array(
							'spbc_remote_call_token'  => md5($config['cleantalk_antispam_apikey']),
							'spbc_remote_call_action' => 'sfw_update',
							'plugin_name'             => 'apbct',
							'api_server'              => $api_server,
							'data_id'                 => $data_id,
		                    'file_url_nums'           => implode(',', $file_url_nums),
						),
						array('get', 'async')
					);							
				} else {
					//Files array is empty update sfw time
					$config->set('cleantalk_antispam_sfw_update_last_gc', time());

					return $result;
				}
			}	    	
	    }else
	        return true;
	}
	function sfw_send_logs($access_key) {

		global $config;

		$result = \cleantalk\antispam\model\CleantalkSFW::send_logs($access_key);

		if (!isset($result['error'])) {
			$config->set('cleantalk_antispam_sfw_logs_send_last_gc', time());			
		}

		return $result;
	}
}