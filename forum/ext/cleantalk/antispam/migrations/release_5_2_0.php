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

class release_5_2_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['cleanalk_antispam_apikey']);
	}

	static public function depends_on()
	{
		return array('\cleantalk\antispam\migrations\release_5_0_0');
	}

	public function update_data()
	{
		return array(		
			// Result of notice_paid_till method
			array('config.add', array('cleantalk_antispam_show_notice', 0)),
			array('config.add', array('cleantalk_antispam_renew',       0)),
			array('config.add', array('cleantalk_antispam_trial',       0)),
			array('config.add', array('cleantalk_antispam_spam_count',  0)),
			array('config.add', array('cleantalk_antispam_moderate_ip', 0)),
			array('config.add', array('cleantalk_antispam_ip_license',  0)),
		
			// Checks if the key is paid
			array('config.add', array('cleantalk_antispam_check_payment_status_last_gc', 0)),
			array('config.add', array('cleantalk_antispam_check_payment_status_gc', (86400)))
		);
	}

}
