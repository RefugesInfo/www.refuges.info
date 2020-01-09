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
		global $user, $template, $request, $config, $db, $phpbb_root_path, $phpEx;

		$user->add_lang('acp/common');
		$this->tpl_name = 'settings_body';
		$this->page_title = $user->lang('ACP_CLEANTALK_TITLE');
		add_form_key('cleantalk/antispam');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('cleantalk/antispam'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('cleantalk_antispam_regs', $request->variable('cleantalk_antispam_regs', 0));
			$config->set('cleantalk_antispam_guests', $request->variable('cleantalk_antispam_guests', 0));
			$config->set('cleantalk_antispam_nusers', $request->variable('cleantalk_antispam_nusers', 0));
			$config->set('cleantalk_antispam_apikey', $request->variable('cleantalk_antispam_apikey', 'enter key'));

			trigger_error($user->lang('ACP_CLEANTALK_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'CLEANTALK_ANTISPAM_REGS'		=> $config['cleantalk_antispam_regs'],
			'CLEANTALK_ANTISPAM_GUESTS'		=> $config['cleantalk_antispam_guests'],
			'CLEANTALK_ANTISPAM_NUSERS'		=> $config['cleantalk_antispam_nusers'],
			'CLEANTALK_ANTISPAM_APIKEY'		=> $config['cleantalk_antispam_apikey'],
		));

		$user->add_lang_ext('cleantalk/antispam', 'common');

		$ct_del_user=$request->variable('ct_del_user', Array(0), false, \phpbb\request\request_interface::POST);
		$ct_del_all=$request->variable('ct_delete_all', '', false, \phpbb\request\request_interface::POST);
		$savekey=$request->variable('cleantalk_antispam_apikey', '', false, \phpbb\request\request_interface::POST);
		if($savekey!='')
		{
			$spam_check = array();
			$spam_check['auth_key'] = $savekey;
			$spam_check['type'] = 'comment';
			$spam_check['sender_email'] = 'good@cleantalk.org';
			$spam_check['sender_nickname'] = 'CleanTalk';
			$spam_check['message'] = 'This message is a test to check the connection to the CleanTalk servers.';
			$result = \cleantalk\antispam\model\main_model::check_spam($spam_check);
		}
		if($ct_del_all!='')
		{
			if (!function_exists('user_delete'))
			{
				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
			}
			$sql = 'SELECT * FROM ' . USERS_TABLE . ' where ct_marked=1';
			$result = $db->sql_query($sql);
			while($row = $db->sql_fetchrow($result))
			{
				user_delete('remove', $row['user_id']);
			}
		}
		if(sizeof($ct_del_user)>0)
		{
			if (!function_exists('user_delete'))
			{
				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
			}
			foreach($ct_del_user as $key=>$value)
			{
				user_delete('retain', $key);
			}
		}
		if(isset($_GET['check_users_spam']))
		{
			$sql = 'UPDATE ' . USERS_TABLE . ' set ct_marked=0';
			$result = $db->sql_query($sql);
			$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_password<>'';";
			$result = $db->sql_query($sql);
			$users=Array();
			$users[0]=Array();
			$data=Array();
			$data[0]=Array();
			$cnt=0;
			while($row = $db->sql_fetchrow($result))
			{ 
				$users[$cnt][] = Array('name' => $row['username'],
									'id' => $row['user_id'],
									'email' => $row['user_email'],
									'ip' => $row['user_ip'],
									'joined' => $row['user_regdate'],
									'visit' => $row['user_lastvisit'],
							);
				$data[$cnt][]=$row['user_email'];
				$data[$cnt][]=$row['user_ip'];
				if(sizeof($users[$cnt])>450)
				{
					$cnt++;
					$users[$cnt]=Array();
					$data[$cnt]=Array();
				}
			}

			$error="";
			for($i=0;$i<sizeof($users);$i++)
			{
				$send=implode(',',$data[$i]);
				$req="data=$send";
				$opts = array(
				    'http'=>array(
				        'method'=>"POST",
				        'content'=>$req,
				    )
				);
				$context = stream_context_create($opts);
				$result = @file_get_contents("https://api.cleantalk.org/?method_name=spam_check&auth_key=".$config['cleantalk_antispam_apikey'], 0, $context);
				$result=json_decode($result);
				if(isset($result->error_message))
				{
					$error=$result->error_message;
				}
				else
				{
					if(isset($result->data))
					{
						foreach($result->data as $key=>$value)
						{
							if($key === filter_var($key, FILTER_VALIDATE_IP))
							{
								if($value->appears==1)
								{
									$sql = "UPDATE " . USERS_TABLE . " set ct_marked=1 where user_ip='".$db->sql_escape($key)."'";
									$result = $db->sql_query($sql);
								}
							}
							else
							{
								if($value->appears==1)
								{
									$sql = "UPDATE " . USERS_TABLE . " set ct_marked=1 where user_email='".$db->sql_escape($key)."'";
									$result = $db->sql_query($sql);
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
			else
			{
				@header("Location: ".str_replace('&check_users_spam=1', '&finish_check=1', html_entity_decode($request->server('REQUEST_URI'))));
			}
		}
		$sql = 'SELECT * FROM ' . USERS_TABLE . ' where ct_marked = 1';
		$result = $db->sql_query($sql);
		if($request->variable('finish_check', '', false, \phpbb\request\request_interface::GET)!='')
		{
			$template->assign_var('CT_ACP_CHECKUSERS_DONE_1', '1');
		}
		$found = false;
		while($row = $db->sql_fetchrow($result))
		{
			$found = true;
			$template->assign_block_vars('CT_SPAMMERS', array(
			    'USER_ID'		=> $row['user_id'],
			    'USER_POSTS'	=> $row['user_posts'],
			    'USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
			    'JOINED'		=> (!$row['user_regdate']) ? ' - ' : $user->format_date(intval($row['user_regdate'])),
			    'USER_EMAIL'	=> $row['user_email'],
			    'USER_IP'		=> $row['user_ip'],
			    'LAST_VISIT'	=> (!$row['user_lastvisit']) ? ' - ' : $user->format_date(intval($row['user_lastvisit'])),
			));
		}
		if ($found)
		{
			$template->assign_var('CT_TABLE_USERS_SPAM', '1');
		}
		if(!$found && $request->variable('finish_check', '', false, \phpbb\request\request_interface::GET) != '')
		{
			$template->assign_var('CT_ACP_CHECKUSERS_DONE_2', '1');
		}
	}
}
