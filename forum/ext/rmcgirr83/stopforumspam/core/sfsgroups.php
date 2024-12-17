<?php
/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace rmcgirr83\stopforumspam\core;

/**
* ignore
**/
use phpbb\auth\auth;
use phpbb\cache\service as cache;

class sfsgroups
{
	/** @var auth $auth */
	protected $auth;

	/** @var cache $cache */
	protected $cache;

	public function __construct(
			auth $auth,
			cache $cache)
	{
		$this->auth = $auth;
		$this->cache = $cache;
	}

	/*
	* getadminsmods		generate a cache of users who are mods of forums and merge with the already existing cache of admins and mods
	*					this is used in the listener as well as reporttosfs files
	* @param	$forum_id	the id of a forum
	* @return 	null
	* @access	public
	*/
	public function getadminsmods($forum_id)
	{
		$admins_mods = $this->cache->get('_sfs_adminsmods');

		// ensure the cache was built in the ACP
		if (!$admins_mods)
		{
			$admins_mods = [];
		}

		if ($forum_id)
		{
			// now get just the moderators of the forum
			$forum_mods = $this->auth->acl_get_list(false, 'm_', $forum_id);
			$forum_mods = (!empty($forum_mods[$forum_id]['m_'])) ? $forum_mods[$forum_id]['m_'] : [];

			// merge the arrays
			$admins_mods = array_unique(array_merge($admins_mods, $forum_mods));

		}

		return $admins_mods;
	}

	/*
	* build_adminsmods_cache		generate a cache of users who are admins and global mods
	*								this is used in the listener as well as reporttosfs/reportpms files
	* @return 	null
	* @access	public
	*/
	public function build_adminsmods_cache()
	{
		if (($this->cache->get('_sfs_adminsmods')) === false)
		{
			// Grab an array of user_id's with admin permissions
			$admin_ary = $this->auth->acl_get_list(false, 'a_', false);
			$admin_ary = (!empty($admin_ary[0]['a_'])) ? $admin_ary[0]['a_'] : [];

			// Grab an array of user id's with global mod permissions
			$mod_ary = $this->auth->acl_get_list(false,'m_', false);
			$mod_ary = (!empty($mod_ary[0]['m_'])) ? $mod_ary[0]['m_'] : [];

			$admins_mods = array_unique(array_merge($admin_ary, $mod_ary));

			// cache this data for ever
			$this->cache->put('_sfs_adminsmods', $admins_mods);
		}
	}
}
