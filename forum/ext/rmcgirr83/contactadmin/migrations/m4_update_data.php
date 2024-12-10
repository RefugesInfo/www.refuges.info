<?php
/**
*
* Contact Admin extension for the phpBB Forum Software package.
*
* @copyright 2023 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\contactadmin\migrations;

/**
* Primary migration
*/

class m4_update_data extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return ['\rmcgirr83\contactadmin\migrations\m3_update_data'];
	}

	public function update_data()
	{
		return [
			['config.add', ['contactadmin_who', false]],
			['config.add', ['contactadmin_email_chk', false]],
			['config.remove', ['contactadmin_founder_only']],
			['config.remove', ['contactadmin_mail_chk']],
		];
	}
}
