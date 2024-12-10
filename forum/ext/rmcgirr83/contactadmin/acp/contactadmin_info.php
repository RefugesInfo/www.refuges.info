<?php
/**
*
* Contact admin extension for the phpBB Forum Software package.
*
* @copyright 2016 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace rmcgirr83\contactadmin\acp;

class contactadmin_info
{
	function module()
	{
		return [
			'filename'	=> '\rmcgirr83\contactadmin\acp\contactadmin_module',
			'title'		=> 'ACP_CAT_CONTACTADMIN',
			'version'	=> '1.0.0',
			'modes'	=> [
				'configuration'	=> ['title' => 'ACP_CONTACTADMIN_CONFIG', 'auth' => 'ext_rmcgirr83/contactadmin && acl_a_board', 'cat' => ['ACP_CAT_CONTACTADMIN']],
			],
		];
	}
}
