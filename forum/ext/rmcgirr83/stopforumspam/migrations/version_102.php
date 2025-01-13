<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) Stop Forum Spam
* @author 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\migrations;

/**
* Primary migration
*/

class version_102 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['sfs_version']) && version_compare($this->config['sfs_version'], '1.0.2', '>=');
	}

	static public function depends_on()
	{
		return array('\rmcgirr83\stopforumspam\migrations\version_101');
	}

	public function update_data()
	{

		$settings_ary = array(
			'allow_sfs'			=> $this->config->offsetGet('allow_sfs'),
			'sfs_threshold'		=> $this->config->offsetGet('sfs_threshold'),
			'sfs_ban_ip'		=> $this->config->offsetGet('sfs_ban_ip'),
			'sfs_log_message'	=> $this->config->offsetGet('sfs_log_message'),
			'sfs_down'			=> $this->config->offsetGet('sfs_down'),
			'sfs_by_name'		=> 1,
			'sfs_by_email'		=> 1,
			'sfs_by_ip'			=> 1,
			'sfs_ban_reason'	=> 1,
		);
		$settings = serialize($settings_ary);

		return array(
			array('config_text.add', array('sfs_settings', $settings)),
			array('config.remove', array('allow_sfs')),
			array('config.remove', array('sfs_threshold')),
			array('config.remove', array('sfs_ban_ip')),
			array('config.remove', array('sfs_log_message')),
			array('config.remove', array('sfs_down')),
			array('config.update', array('sfs_version', '1.0.2')),
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_SFS_TITLE'
			)),

			array('module.add', array(
				'acp',
				'ACP_SFS_TITLE',
				array(
					'module_basename'	=> '\rmcgirr83\stopforumspam\acp\stopforumspam_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
