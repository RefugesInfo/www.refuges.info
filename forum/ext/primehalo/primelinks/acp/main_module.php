<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace primehalo\primelinks\acp;

/**
 * Prime Links ACP module.
 */
class main_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	public function main($id, $mode)
	{
		global $phpbb_container;

		$config = $phpbb_container->get('config');
		$request = $phpbb_container->get('request');
		$template = $phpbb_container->get('template');
		$user = $phpbb_container->get('user');

		$this->tpl_name = 'acp_primelinks_body';
		$this->page_title = $user->lang('ACP_PRIMELINKS_TITLE');
		add_form_key('primelinks_settings');

		// The form was submitted
		if ($request->is_set_post('submit'))
		{
			// Ensure the form submission is valid
			if (!check_form_key('primelinks_settings'))
			{
				 trigger_error('FORM_INVALID');
			}

			// Set the user's options
			$config->set('primelinks_enable_general', $request->variable('primelinks_enable_general', true));
			$config->set('primelinks_enable_forumlist', $request->variable('primelinks_enable_forumlist', true));
			$config->set('primelinks_enable_style', $request->variable('primelinks_enable_style', true));
			$config->set('primelinks_enable_members', $request->variable('primelinks_enable_members', true));
			$config->set('primelinks_inlink_guest_hide', $request->variable('primelinks_inlink_guest_hide', 0));
			$config->set('primelinks_exlink_guest_hide', $request->variable('primelinks_exlink_guest_hide', 0));
			$config->set('primelinks_inlink_domains', $request->variable('primelinks_inlink_domains', ''));
			$config->set('primelinks_forbidden_domains', $request->variable('primelinks_forbidden_domains', ''));
			$config->set('primelinks_forbidden_msg', $request->variable('primelinks_forbidden_msg', false));
			$config->set('primelinks_forbidden_new_url', $request->variable('primelinks_forbidden_new_url', ''));
			$config->set('primelinks_inlink_rel', $request->variable('primelinks_inlink_rel', ''));
			$config->set('primelinks_exlink_rel', $request->variable('primelinks_exlink_rel', ''));
			$config->set('primelinks_inlink_target', $request->variable('primelinks_inlink_target', ''));
			$config->set('primelinks_exlink_target', $request->variable('primelinks_exlink_target', ''));
			$config->set('primelinks_inlink_class', $request->variable('primelinks_inlink_class', ''));
			$config->set('primelinks_exlink_class', $request->variable('primelinks_exlink_class', ''));
			$config->set('primelinks_inlink_prefix', $request->variable('primelinks_inlink_prefix', ''));
			$config->set('primelinks_exlink_prefix', $request->variable('primelinks_exlink_prefix', ''));
			$config->set('primelinks_skip_regex', $request->variable('primelinks_skip_regex', ''));
			$config->set('primelinks_inlink_regex', $request->variable('primelinks_inlink_regex', ''));
			$config->set('primelinks_exlink_regex', $request->variable('primelinks_exlink_regex', ''));
			$config->set('primelinks_skip_prefix_regex', $request->variable('primelinks_skip_prefix_regex', ''));
			$config->set('primelinks_inlink_use_titles', $request->variable('primelinks_inlink_use_titles', false));

			$log = $phpbb_container->get('log');
			$log->add('admin', $user->data['user_id'], $user->ip, 'ACP_PRIMELINKS_SETTINGS_LOG');

			trigger_error($user->lang('ACP_PRIMELINKS_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'PRIMELINKS_ENABLE_GENERAL' 			=> $config['primelinks_enable_general'],
			'PRIMELINKS_ENABLE_FORUMLIST'			=> $config['primelinks_enable_forumlist'],
			'PRIMELINKS_ENABLE_STYLE'				=> $config['primelinks_enable_style'],
			'PRIMELINKS_ENABLE_MEMBERS'				=> $config['primelinks_enable_members'],
			'PRIMELINKS_INLINK_GUEST_HIDE'			=> $config['primelinks_inlink_guest_hide'],
			'PRIMELINKS_EXLINK_GUEST_HIDE'			=> $config['primelinks_exlink_guest_hide'],
			'PRIMELINKS_INLINK_DOMAINS'				=> $config['primelinks_inlink_domains'],
			'PRIMELINKS_FORBIDDEN_DOMAINS'			=> $config['primelinks_forbidden_domains'],
			'PRIMELINKS_FORBIDDEN_MSG'				=> $config['primelinks_forbidden_msg'],
			'PRIMELINKS_FORBIDDEN_NEW_URL'			=> $config['primelinks_forbidden_new_url'],
			'PRIMELINKS_INLINK_REL'					=> $config['primelinks_inlink_rel'],
			'PRIMELINKS_EXLINK_REL'					=> $config['primelinks_exlink_rel'],
			'PRIMELINKS_INLINK_TARGET'				=> $config['primelinks_inlink_target'],
			'PRIMELINKS_EXLINK_TARGET'				=> $config['primelinks_exlink_target'],
			'PRIMELINKS_INLINK_CLASS'				=> $config['primelinks_inlink_class'],
			'PRIMELINKS_EXLINK_CLASS'				=> $config['primelinks_exlink_class'],
			'PRIMELINKS_INLINK_PREFIX'				=> $config['primelinks_inlink_prefix'],
			'PRIMELINKS_EXLINK_PREFIX'				=> $config['primelinks_exlink_prefix'],
			'PRIMELINKS_SKIP_REGEX'					=> $config['primelinks_skip_regex'],
			'PRIMELINKS_INLINK_REGEX'				=> $config['primelinks_inlink_regex'],
			'PRIMELINKS_EXLINK_REGEX'				=> $config['primelinks_exlink_regex'],
			'PRIMELINKS_SKIP_PREFIX_REGEX'			=> $config['primelinks_skip_prefix_regex'],
			'PRIMELINKS_INLINK_USE_TITLES'			=> $config['primelinks_inlink_use_titles'],
			'U_ACTION'								=> $this->u_action,
		));
	}
}
