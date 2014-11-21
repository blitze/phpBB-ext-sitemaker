<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\migrations\v20x;

/**
 * Initial schema changes needed for Extension installation
 */
class m2_initial_data extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	static public function depends_on()
	{
		return array(
			'\primetime\primetime\migrations\converter\c2_update_data',
			'\primetime\primetime\migrations\v20x\m1_initial_schema'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'create_forum_cat'))),

			array('config.add', array('primetime_last_changed', 0)),
			array('config.add', array('primetime_default_layout', '')),
			array('config.add', array('primetime_parent_forum_id', 0)),
			array('config.add', array('primetime_primetime_forum_perm_from', 0)),
			array('config.add', array('primetime_blocks_cleanup_gc', 604800)),
			array('config.add', array('primetime_blocks_cleanup_last_gc', time(), 1)),
			array('config.add', array('primetime_startpage_controller', '')),
			array('config.add', array('primetime_startpage_method', '')),
			array('config.add', array('primetime_startpage_params', '')),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('config.remove', array('primetime_last_changed')),
			array('config.remove', array('primetime_default_layout')),
			array('config.remove', array('primetime_parent_forum_id')),
			array('config.remove', array('primetime_primetime_forum_perm_from')),
			array('config.remove', array('primetime_blocks_cleanup_gc')),
			array('config.remove', array('primetime_blocks_cleanup_last_gc')),
			array('config.remove', array('primetime_startpage_controller')),
			array('config.remove', array('primetime_startpage_method')),
			array('config.remove', array('primetime_startpage_params')),
		);
	}

	public function create_forum_cat()
	{
		global $user;

		$user->add_lang('acp/forums');

		if (!class_exists('acp_forums'))
		{
			include($this->phpbb_root_path . 'includes/acp/acp_forums.' . $this->php_ext);
		}

		$forum_data = array(
			'parent_id'				=> 0,
			'forum_type'			=> FORUM_CAT,
			'type_action'			=> '',
			'forum_status'			=> ITEM_UNLOCKED,
			'forum_parents'			=> '',
			'forum_name'			=> 'phpBB Primetime Extensions',
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
		);

		if (!empty($this->config['primetime_parent_forum_id']))
		{
			$forum_data['forum_id'] = (int) $this->config['primetime_parent_forum_id'];
		}

		$acp_forum = new \acp_forums();
		$errors = $acp_forum->update_forum_data($forum_data);

		if (!sizeof($errors))
		{
			$this->config->set('primetime_parent_forum_id', $forum_data['forum_id']);
		}
	}
}
