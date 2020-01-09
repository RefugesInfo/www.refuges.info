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
			array('config.add', array('cleantalk_antispam_regs', 0)),
			array('config.add', array('cleantalk_antispam_guests', 0)),
			array('config.add', array('cleantalk_antispam_nusers', 0)),
			array('config.add', array('cleantalk_antispam_apikey', 'enter key')),

			array('config.add', array('cleantalk_antispam_work_url', 'http://moderate.cleantalk.ru')),
			array('config.add', array('cleantalk_antispam_server_url', 'http://moderate.cleantalk.ru')),
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

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				SESSIONS_TABLE			=> array(
					'ct_submit_time'	=> array('INT:11', '0'),
				),
				USERS_TABLE			=> array(
					'ct_marked'	=> array('INT:11', '0'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
    			'drop_columns'        => array(
        			SESSIONS_TABLE			=> array('ct_submit_time'),
        			USERS_TABLE			=> array('ct_marked'),
        		),
		);
	}

}
