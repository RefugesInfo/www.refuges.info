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

class m1_update_data extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\rmcgirr83\contactadmin\migrations\version_100');
	}

	public function update_data()
	{
		return array(
			// Update config entry
			array('config.update', array('contactadmin_enable', true)),
			array('config.update', array('contactadmin_confirm', true)),
			array('config.update', array('contact_admin_form_enable', false)),
		);
	}
}
