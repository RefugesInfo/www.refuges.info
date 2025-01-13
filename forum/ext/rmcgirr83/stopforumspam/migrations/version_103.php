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

class version_103 extends \phpbb\db\migration\container_aware_migration
{
	static public function depends_on()
	{
		return array('\rmcgirr83\stopforumspam\migrations\version_102');
	}

	protected $settings;

	public function update_data()
	{
		$config_text = $this->container->get('config_text');

		$this->settings = unserialize($config_text->get('sfs_settings'));

		return array(
			array('config.add', array('allow_sfs', $this->get('allow_sfs', 1))),
			array('config.add', array('sfs_threshold', $this->get('sfs_threshold', 5))),
			array('config.add', array('sfs_ban_ip', $this->get('sfs_ban_ip', 0))),
			array('config.add', array('sfs_log_message', $this->get('sfs_log_message', 0))),
			array('config.add', array('sfs_down', $this->get('sfs_down', 0))),
			array('config.add', array('sfs_by_name', $this->get('sfs_by_name', 1))),
			array('config.add', array('sfs_by_email', $this->get('sfs_by_email', 1))),
			array('config.add', array('sfs_by_ip', $this->get('sfs_by_ip', 1))),
			array('config.add', array('sfs_ban_reason', $this->get('sfs_ban_reason', 1))),
			array('config.remove', array('sfs_version')),
			array('config_text.remove', array('sfs_settings')),
		);
	}

	protected function get($name, $default)
	{
		return isset($this->settings[$name]) ? (int) $this->settings[$name] : $default;
	}
}
