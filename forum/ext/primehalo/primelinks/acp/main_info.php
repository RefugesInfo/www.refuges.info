<?php
/**
 *
 * Prime Links. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Ken F. Innes IV, https://www.absoluteanime.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace primehalo\primelinks\acp;

/**
 * Prime Links ACP module info.
 */
class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\primehalo\primelinks\acp\main_module',
			'title'		=> 'ACP_PRIMELINKS_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_PRIMELINKS_SETTINGS',
					'auth'	=> 'ext_primehalo/primelinks && acl_a_board',
					'cat'	=> array('ACP_PRIMELINKS_TITLE')
				),
			),
		);
	}
}
