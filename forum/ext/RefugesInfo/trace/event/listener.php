<?php
// Ce fichier centralise les fonctions PHP liées à l'enregistrement des traces des posts et enregistrements
// Attention: Le code suivant s'exécute dans un "namespace" bien défini

namespace RefugesInfo\trace\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (!defined('IN_PHPBB')) exit;

class listener implements EventSubscriberInterface
{
	// List of externals
	public function __construct(
	) {
		global $request;
		$this->server = $request->get_super_global(\phpbb\request\request_interface::SERVER);
		$this->get = $request->get_super_global(\phpbb\request\request_interface::GET);
		$this->post = $request->get_super_global(\phpbb\request\request_interface::POST);
	}

	static public function getSubscribedEvents () {
		return [
			'core.submit_post_end' => 'log_request_context',
			'core.ucp_register_register_after' => 'log_request_context',
			'core.mcp_post_additional_options' => 'mcp_additional_options',
			'core.memberlist_modify_view_profile_template_vars' => 'mcp_additional_options',
		];
	}

	// Trace le contexte d'une soumission de post ou d'une création de user
	function log_request_context($vars) {
		global $user, $auth, $db;
		date_default_timezone_set ('Europe/Paris');

		if ($auth->acl_get('m_') || $user->data['is_bot']) return;

		$ipv4 = strpos (@$this->server['REMOTE_ADDR'], ':') ?
			@$this->server['HTTP_X_REAL_IP'] :
			@$this->server['REMOTE_ADDR'];

		if (isset ($vars['user_id'])) // user
			$log = [ // user
				'user_id' => @$vars['user_id'],
			];
		else {
			@$vars['user_row'] = @$user->data;
			$log = [ // post
				'post_id' => @$vars['data']['post_id'],
				'user_id' => @$vars['data']['poster_id'],
				'topic_title' => @$this->post['subject'],
				'text' => @$this->post['message'],
				'user_posts' => @$vars['user_row']['user_posts'],
			];
		}
		$log += [ // general
				'uri' => @$this->server['REQUEST_SCHEME'].'://'.
					@$this->server['HTTP_HOST'].
					@$this->server['REQUEST_URI'],
				'ip' => @$this->server['REMOTE_ADDR'],
				'real_ip' => @$this->server['HTTP_X_REAL_IP'],
				'host' => $this->gethost($ipv4),
				'user_agent' => @$this->server['HTTP_USER_AGENT'],
				'country_code' => @$this->server['HTTP_X_COUNTRY_CODE'],
				'language' => @$this->server['HTTP_ACCEPT_LANGUAGE'],

				'browser_locale' => @$this->post['browser_locale'],
				'browser_timezone' => @$this->post['browser_timeZone'],
				'sid' => @$user->session_id,
				'date' => date('r'),

				// Infos user
				'user_name' => @$vars['user_row']['username'],
				'user_email' => @$vars['user_row']['user_email'],
				'user_signature' => str_replace ('<t></t>', '', @$vars['user_row']['user_sig']),
				'user_lang' => @$vars['user_row']['user_lang'],
				'user_timezone' => @$vars['user_row']['user_timezone'],
				'ip_enregistrement' => @$vars['user_row']['user_ip'],
				'host_enregistrement' => $this->gethost(@$vars['user_row']['user_ip']),
		];

		$sql = 'INSERT INTO trace_requettes '.
			$db->sql_build_array('INSERT', array_filter($log));
		$db->sql_query($sql);
	}

	function gethost ($ip) {
		if (substr_count($ip, '.') === 3)
			return gethostbyaddr($ip);
		return null;
	}

	// Ajout des traces au panneau de modération d'un post et d'un user
	function mcp_additional_options ($vars) {
		global $template, $user, $auth, $db;

		if (isset ($this->get['p']))
			$sql = 'SELECT * FROM trace_requettes'.
				' WHERE post_id = '.$this->get['p'].
				' ORDER BY trace_id'.
				' DESC LIMIT 1';
		elseif (isset ($this->get['u']))
			$sql = 'SELECT * FROM trace_requettes'.
				' WHERE uri LIKE \'%register\''.
				' AND user_id = '.$this->get['u'].
				' ORDER BY trace_id'.
				' DESC LIMIT 1';

		if ($sql && $auth->acl_get('m_')) {
			$result = $db->sql_query ($sql);
			$row = $db->sql_fetchrow ($result);
			if ($row)
				$template->assign_vars(
					array_change_key_case (array_filter ($row), CASE_UPPER)
				);
			$db->sql_freeresult($result);
		}
	}
}
