<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace primehalo\primelinks\migrations;

class install_acp_module2 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\primehalo\primelinks\migrations\install_acp_module');
	}

	public function effectively_installed()
	{
		return isset($this->config['primelinks_enable_general']);
	}

	public function update_data()
	{
		return array(
			array('config.add', array('primelinks_inlink_use_titles')),
		);
	}
}
