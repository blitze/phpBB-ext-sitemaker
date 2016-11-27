<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

class admin
{
	/**
	 * @param array $forum_data
	 * @return array
	 */
	public static function save(array &$forum_data)
	{
		$forum_data = array_merge(array(
				'parent_id'				=> 0,
				'forum_type'			=> FORUM_POST,
				'type_action'			=> '',
				'forum_status'			=> ITEM_UNLOCKED,
				'forum_parents'			=> '',
				'forum_name'			=> '',
				'forum_link'			=> '',
				'forum_link_track'		=> false,
				'forum_desc'			=> '',
				'forum_desc_uid'		=> '',
				'forum_desc_options'	=> 7,
				'forum_desc_bitfield'	=> '',
				'forum_rules'			=> '',
				'forum_rules_uid'		=> '',
				'forum_rules_options'	=> 7,
				'forum_rules_bitfield'	=> '',
				'forum_rules_link'		=> '',
				'forum_image'			=> '',
				'forum_style'			=> 0,
				'display_subforum_list'	=> false,
				'display_on_index'		=> false,
				'forum_topics_per_page'	=> 0,
				'enable_indexing'		=> true,
				'enable_icons'			=> false,
				'enable_prune'			=> false,
				'enable_post_review'	=> true,
				'enable_quick_reply'	=> false,
				'prune_days'			=> 7,
				'prune_viewed'			=> 7,
				'prune_freq'			=> 1,
				'prune_old_polls'		=> false,
				'prune_announce'		=> false,
				'prune_sticky'			=> false,
				'show_active'			=> false,
				'forum_password'		=> '',
				'forum_password_confirm'=> '',
				'forum_password_unset'	=> false,
				'hidden_forum'			=> 1,
			),
			$forum_data
		);

		$forum = new \acp_forums();
		$errors = $forum->update_forum_data($forum_data);

		return $errors;
	}

	/**
	 * @param int $forum_id
	 * @param string $action_posts
	 * @param string $action_subforums
	 * @param int $posts_to_id
	 * @param int $subforums_to_id
	 * @return array
	 */
	public static function remove($forum_id, $action_posts = 'delete', $action_subforums = 'delete', $posts_to_id = 0, $subforums_to_id = 0)
	{
		$forum = new \acp_forums();
		return $forum->delete_forum($forum_id, $action_posts, $action_subforums, $posts_to_id, $subforums_to_id);
	}
}
