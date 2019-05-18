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

class release_5_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['cleanalk_antispam_apikey']);
	}

	static public function depends_on()
	{
		return array('\cleantalk\antispam\migrations\release_4_8_0');
	}

	public function update_data()
	{
		return array(
			//Visible settings
			array('config.add', array('cleantalk_antispam_sfw_enabled', 0)),
			//System settings
			array('config.add', array('cleantalk_antispam_key_is_ok', 0)),
			array('config.add', array('cleantalk_antispam_user_token', '')),			
			//SFW update cron task
			array('config.add', array('cleantalk_antispam_sfw_update_last_gc', 0)),
			array('config.add', array('cleantalk_antispam_sfw_update_gc', (86400))),
			//SFW logs send cron task
			array('config.add', array('cleantalk_antispam_sfw_logs_send_last_gc', 0)),
			array('config.add', array('cleantalk_antispam_sfw_logs_send_gc', (3600)))
		);
	}

	public function update_schema()
	{
		return array(	
			'add_tables'    => array(
				$this->table_prefix . 'cleantalk_sfw_logs' => array(
					'COLUMNS' => array(
						'ip'				=> array('VCHAR_UNI:15', ''),
						'all_entries'		=> array('INT:11', NULL),
						'blocked_entries'   => array('INT:11', NULL),
						'entries_timestamp' => array('INT:11', NULL),
					),
					'PRIMARY_KEY' => 'ip',
				),
				$this->table_prefix . 'cleantalk_sfw' => array(
					'COLUMNS' => array(
						'network'	=> array('UINT:11', '0'),
						'mask'		=> array('UINT:11', '0'),
					),
				),
			),
		);
	}

	public function revert_schema()
	{	
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'cleantalk_sfw_logs',
				$this->table_prefix . 'cleantalk_sfw',
			),
		);
	}

}
