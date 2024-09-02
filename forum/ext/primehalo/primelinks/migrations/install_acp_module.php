<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace primehalo\primelinks\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	static private function get_default_settings()
	{
		return array(
			'primelinks_enable_general'		=> true,
			'primelinks_enable_forum'		=> true,
			'primelinks_enable_style'		=> true,
			'primelinks_enable_members'		=> true,
			'primelinks_inlink_guest_hide'	=> 0,
			'primelinks_exlink_guest_hide'	=> 0,
			'primelinks_inlink_prefix'		=> '',
			'primelinks_exlink_prefix'		=> '',
			'primelinks_inlink_domains' 	=> '',
			'primelinks_forbidden_domains'	=> '',
			'primelinks_forbidden_msg'		=> false,
			'primelinks_forbidden_new_url'	=> '',
			'primelinks_inlink_rel' 		=> '',
			'primelinks_exlink_rel' 		=> '',
			'primelinks_inlink_target'		=> '',
			'primelinks_exlink_target'		=> '',
			'primelinks_inlink_class'		=> '',
			'primelinks_exlink_class'		=> '',
			'primelinks_skip_regex'			=> '',
			'primelinks_inlink_regex'		=> '',
			'primelinks_exlink_regex'		=> '',
			'primelinks_skip_prefix_regex'	=> '',
		);
	}

	public function effectively_installed()
	{
		return isset($this->config['primelinks_enable_general']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		$return_ary = array();

		$settings_ary = $this->get_default_settings();
		foreach ($settings_ary as $setting_key => $setting_val)
		{
			$return_ary[] = array('config.add', array($setting_key, $setting_val));
		}

		// Add a parent module (ACP_PRIMELINKS_TITLE) to the Extensions tab (ACP_CAT_DOT_MODS)
		$return_ary[] = array('module.add', array(
			'acp',
			'ACP_CAT_DOT_MODS',
			'ACP_PRIMELINKS_TITLE'
		));

		// Add our main_module to the parent module (ACP_PRIMELINKS_TITLE)
		$return_ary[] = array('module.add', array(
			'acp',
			'ACP_PRIMELINKS_TITLE',
			array(
				'module_basename'	=> '\primehalo\primelinks\acp\main_module',
				'modes' 			=> array('settings'),
			),
		));

		return $return_ary;
	}
}
