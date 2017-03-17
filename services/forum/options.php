<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

class options
{
	/**
	 * Constructor
	 *
	 * @param string		$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string		$php_ext			php file extension
	 */
	public function __construct($phpbb_root_path, $php_ext)
	{
		// @codeCoverageIgnoreStart
		if (!function_exists('make_forum_select'))
		{
			include($phpbb_root_path . 'includes/functions_admin.' . $php_ext);
		}
		// @codeCoverageIgnoreEnd
	}

	/**
	 * @param bool $select_id
	 * @param bool $ignore_id
	 * @param bool $ignore_acl
	 * @param bool $ignore_nonpost
	 * @param bool $ignore_emptycat
	 * @param bool $only_acl_post
	 * @return array
	 */
	public function get_all($select_id = false, $ignore_id = false, $ignore_acl = true, $ignore_nonpost = false, $ignore_emptycat = true, $only_acl_post = false)
	{
		$forumlist = make_forum_select($select_id, $ignore_id, $ignore_acl, $ignore_nonpost, $ignore_emptycat, $only_acl_post, true);

		$forum_options = array('' => 'ALL_FORUMS');
		foreach ($forumlist as $row)
		{
			$forum_options[$row['forum_id']] = $row['padding'] . $row['forum_name'];
		}

		return $forum_options;
	}

	/**
	 * Get array of topic types.
	 * This is used primarily by blocks config and the values are translated automatically
	 *
	 * @return array
	 */
	public function get_topic_types()
	{
		return array(
			POST_NORMAL     => 'POST_NORMAL',
			POST_STICKY     => 'POST_STICKY',
			POST_ANNOUNCE   => 'POST_ANNOUNCEMENT',
			POST_GLOBAL     => 'POST_GLOBAL',
		);
	}
}
