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

class release_4_8_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['cleanalk_antispam_apikey']);
	}

	static public function depends_on()
	{
		return array('\cleantalk\antispam\migrations\release_4_3_0');
	}

	public function update_schema()
	{
		return array(
			'change_columns' => array(
				USERS_TABLE => array(
					'ct_marked' => array('INT:11', 0)
				)
			)
		);
	}

	public function revert_schema()
	{
		return array(
			'change_columns' => array(
				USERS_TABLE => array(
					'ct_marked' => array('INT:11', '0')
				)
			)
		);
	}

}
