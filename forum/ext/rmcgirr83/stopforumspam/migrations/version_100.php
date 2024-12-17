<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\migrations;

/**
* Primary migration
*/

class version_100 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['sfs_version']) && version_compare($this->config['sfs_version'], '1.0.0', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314rc1');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('sfs_version', '1.0.0')),
			array('config.add', array('allow_sfs', 1)),
			array('config.add', array('sfs_threshold', 5)),
			array('config.add', array('sfs_ban_ip', 0)),
			array('config.add', array('sfs_log_message', 0)),
			array('config.add', array('sfs_down', 0)),
			array('config.add', array('sfs_api_key', '')),
		);
	}

}
