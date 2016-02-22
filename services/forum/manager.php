<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

use blitze\sitemaker\services\forum\admin;

class manager
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \acp_forums */
	protected $forum;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth				Auth object
	 * @param \phpbb\cache\driver\driver_interface	$cache				Cache driver interface
	 * @param \phpbb\config\config					$config				Config object
	 * @param \phpbb\db\driver\driver_interface		$db					Database object
	 * @param \phpbb\language\language				$translator			Language object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\language\language $translator, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		if (!class_exists('acp_forums'))
		{
			include($this->phpbb_root_path . 'includes/acp/acp_forums.' . $this->php_ext);
		}

		$translator->add_lang('acp/forums');
	}

	public function add(array &$forum_data, $forum_perm_from = 0)
	{
		$forum_data += array(
			'parent_id' => $this->config['sitemaker_parent_forum_id'],
		);

		$errors = admin::save($forum_data);

		if (!sizeof($errors))
		{
			$forum_data['forum_id'] = (int) $forum_data['forum_id'];

			// Copy permissions?
			if ($forum_perm_from && $forum_perm_from != $forum_data['forum_id'])
			{
				copy_forum_permissions($forum_perm_from, $forum_data['forum_id'], false, false);
				phpbb_cache_moderators($this->db, $this->cache, $this->auth);
			}

			$this->auth->acl_clear_prefetch();
			$this->cache->destroy('sql', FORUMS_TABLE);
		}

		return $errors;
	}

	public function remove($forum_id, $action_posts = 'delete', $action_subforums = 'delete', $posts_to_id = 0, $subforums_to_id = 0)
	{
		admin::remove($forum_id, $action_posts, $action_subforums, $posts_to_id, $subforums_to_id);
	}
}
