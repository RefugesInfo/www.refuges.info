<?php
/**
*
* @package phpBB Extension - Antispam by CleanTalk
* @author Сleantalk team (welcome@cleantalk.org)
* @copyright (C) 2014 СleanTalk team (http://cleantalk.org)
* @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*
*/

namespace cleantalk\antispam\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\cleantalk\antispam\acp\main_module',
			'title'		=> 'ACP_CLEANTALK_TITLE',
			'version'	=> '5.7.2',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_CLEANTALK_SETTINGS', 'auth' => 'ext_cleantalk/antispam && acl_a_board', 'cat' => array('ACP_CLEANTALK_TITLE')),
			),
		);
	}
}
