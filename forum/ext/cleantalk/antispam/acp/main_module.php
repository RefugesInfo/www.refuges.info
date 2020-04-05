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

class main_module
{

	function main($id, $mode)
	{
		global $user, $template, $request, $config, $db, $table_prefix, $phpbb_root_path, $phpEx;

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
				$result =\cleantalk\antispam\model\CleantalkHelper::noticePaidTill($savekey);

				if(empty($result['error']))
				{
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
						$result =\cleantalk\antispam\model\CleantalkHelper::get2sBlacklistsDb($savekey);
						
						if(empty($result['error']))
						{	
							$db->sql_query("DELETE FROM ".$table_prefix."cleantalk_sfw");
										
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
								$db->sql_multi_insert($table_prefix.'cleantalk_sfw',$sql_ary);	
							}					
							$config->set('cleantalk_antispam_sfw_update_last_gc', time());														
						}

						$result = $db->sql_query("SELECT * FROM ".$table_prefix."cleantalk_sfw_logs");
						$sfw_logs_data = $db->sql_fetchrowset($result);
 						$db->sql_freeresult($result);
						
						if(count($sfw_logs_data))
						{							
							//Compile logs
							$data = array();
							foreach($sfw_logs_data as $key => $value)
							{
								$data[] = array(trim($value['ip']), $value['all_entries'], $value['all_entries']-$value['blocked_entries'], $value['entries_timestamp']);
							}
							unset($key, $value);							
							//Sending the request
							$result =\cleantalk\antispam\model\CleantalkHelper::sfwLogs($savekey, $data);
							
							//Checking answer and deleting all lines from the table
							if(empty($result['error'])){
								if($result['rows'] == count($data))
								{
									$db->sql_query("DELETE FROM ".$table_prefix."cleantalk_sfw_logs");
									$config->set('cleantalk_antispam_sfw_logs_send_last_gc', time());			
								}
							}								
						}
					}						
				}																										
			}				
			$config->set('cleantalk_antispam_key_is_ok', ($key_is_ok) ? 1 : 0);
			
			trigger_error($user->lang('ACP_CLEANTALK_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'CLEANTALK_ANTISPAM_REGS'		=> $config['cleantalk_antispam_regs'] ? true : false,
			'CLEANTALK_ANTISPAM_GUESTS'		=> $config['cleantalk_antispam_guests'] ? true : false,
			'CLEANTALK_ANTISPAM_NUSERS'		=> $config['cleantalk_antispam_nusers'] ? true : false,
			'CLEANTALK_ANTISPAM_CCF'		=> $config['cleantalk_antispam_ccf'] ? true: false,
			'CLEANTALK_ANTISPAM_SFW_ENABLED'=> $config['cleantalk_antispam_sfw_enabled'] ? true : false,
			'CLEANTALK_ANTISPAM_APIKEY'		=> $config['cleantalk_antispam_apikey'],
			'CLEANTALK_ANTISPAM_KEY_IS_OK'	=> $config['cleantalk_antispam_key_is_ok'] ? true : false,
			'CLEANTALK_ANTISPAM_USER_TOKEN'	=> $config['cleantalk_antispam_user_token'],
			'CLEANTALK_ANTISPAM_REG_EMAIL'	=> $config['board_email'],
			'CLEANTALK_ANTISPAM_REG_URL'	=> $request->server('SERVER_NAME'),
			'CLEANTALK_ANTISPAM_ACCOUNT_NAME_OB' => $config['cleantalk_antispam_account_name_ob'],
			'CLEANTALK_ANTISPAM_MODERATE_IP'=> $config['cleantalk_antispam_moderate_ip'],
			'CLEANTALK_ANTISPAM_IP_LICENSE' => $config['cleantalk_antispam_ip_license'],
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
                $limit = " LIMIT " . (int) $check_spam_number;
                $config->set('check_spam_number', $check_spam_number);

            }
			else
            {
                $sql = 'UPDATE ' . USERS_TABLE . ' SET ct_marked=0';
                $db->sql_query($sql);

                $limit = '';
                $config->set('check_spam_number', '');
            }

            $template->assign_var('CLEANTALK_CHECKUSERS_NUMBER', $config['check_spam_number'] ? $config['check_spam_number'] : '');

			$sql = "SELECT user_ip, user_email FROM " . USERS_TABLE . " WHERE user_password<>'' AND ct_marked<>2 ORDER BY user_regdate DESC" . $limit;
			$result = $db->sql_query($sql);
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
}