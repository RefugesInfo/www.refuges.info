<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

namespace cleantalk\antispam\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['cleanalk_antispam_apikey']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\alpha2');
	}

	public function update_data()
	{
		return array(
			//Visible settings
			array('config.add', array('cleantalk_antispam_regs', 1)),
			array('config.add', array('cleantalk_antispam_guests', 1)),
			array('config.add', array('cleantalk_antispam_nusers', 1)),
			array('config.add', array('cleantalk_antispam_apikey', '')),
			//System settings
			array('config.add', array('cleantalk_antispam_work_url', '')),
			array('config.add', array('cleantalk_antispam_server_url', 'http://moderate.cleantalk.org')),
			array('config.add', array('cleantalk_antispam_server_ttl', 0)),
			array('config.add', array('cleantalk_antispam_server_changed', 0)),
			array('config.add', array('cleantalk_antispam_error_time', 0)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_CLEANTALK_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_CLEANTALK_TITLE',
				array(
					'module_basename'	=> '\cleantalk\antispam\acp\main_module',
					'modes'			=> array('settings'),
				),
			)),
		);
	}
}
