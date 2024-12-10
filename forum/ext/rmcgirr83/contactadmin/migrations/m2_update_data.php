<?php
/**
*
* Contact Admin extension for the phpBB Forum Software package.
*
* @copyright 2020 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\contactadmin\migrations;

/**
* Primary migration
*/

class m2_update_data extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\rmcgirr83\contactadmin\migrations\m1_update_data');
	}

	public function update_data()
	{
		return array(
			array('config.remove', array('contactadmin_enable')),
			//Disable the default contact module
			array('custom', array(
				array(&$this, 'disable_module')
			)),
		);
	}

	public function revert_data()
	{
		//Enable the default contact module
		return array(
			array('custom', array(
				array(&$this, 'enable_module')
			)),
		);
	}

	public function disable_module()
	{
		$sql = 'UPDATE ' . MODULES_TABLE . "
			SET module_enabled = 0
			WHERE module_class = 'acp'
				AND module_basename = 'acp_contact'
				AND module_mode = 'contact'";
		$this->sql_query($sql);
	}

	public function enable_module()
	{
		$sql = 'UPDATE ' . MODULES_TABLE . "
			SET module_enabled = 1
			WHERE module_class = 'acp'
				AND module_basename = 'acp_contact'
				AND module_mode = 'contact'";
		$this->sql_query($sql);
	}
}
