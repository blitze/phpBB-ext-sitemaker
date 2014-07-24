<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\migrations\v10x;

/**
 * Initial schema changes needed for Extension installation
 */
class v100 extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public function effectively_installed()
	{
		return isset($this->config['primetime_version']) && version_compare($this->config['primetime_version'], '1.0.0', '>=');
	}

	/**
	 * @inheritdoc
	 */
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'pt_block_routes' => array(
					'COLUMNS'		=> array(
						'route_id'		=> array('UINT', null, 'auto_increment'),
						'ext_name'		=> array('VCHAR:255', ''),
						'route'			=> array('XSTEXT_UNI', ''),
						'style'			=> array('USINT', 0),
						'hide_blocks'	=> array('BOOL', 0),
						'ex_positions'	=> array('VCHAR:255', ''),
					),

					'PRIMARY_KEY'	=> 'route_id'
				),

				$this->table_prefix . 'pt_blocks' => array(
					'COLUMNS'		=> array(
						'bid'			=> array('UINT', null, 'auto_increment'),
						'icon'			=> array('VCHAR:55', ''),
						'name'			=> array('VCHAR:55', ''),
						'title'			=> array('XSTEXT_UNI', ''),
						'route_id'		=> array('UINT', 0),
						'position'		=> array('VCHAR:55', ''),
						'weight'		=> array('USINT', 0),
						'style'			=> array('USINT', 0),
						'permission'	=> array('VCHAR:125', ''),
						'class'			=> array('VCHAR:125', ''),
						'status'		=> array('BOOL', 1),
						'no_wrap'		=> array('BOOL', 0),
						'hide_title'	=> array('BOOL', 0),
					),

					'PRIMARY_KEY'	=> 'bid',

					'KEYS'			=> array(
						'style'			=> array('INDEX', 'style'),
					),
				),

				$this->table_prefix . 'pt_blocks_config' => array(
					'COLUMNS'		=> array(
						'bid'			=> array('UINT', 0),
						'bvar'			=> array('VCHAR', ''),
						'bval'			=> array('VCHAR_UNI', ''),
					),

					'KEYS'			=> array(
						'bid'			=> array('INDEX', 'bid'),
					),
				),

				$this->table_prefix . 'pt_menus' => array(
					'COLUMNS'        => array(
						'menu_id'			=> array('UINT', null, 'auto_increment'),
						'menu_name'			=> array('VCHAR:55', ''),
					),
					'PRIMARY_KEY'	=> 'menu_id',
					'KEYS'			=> array(
						'menu_name'			=> array('UNIQUE', 'menu_name'),
						'menu_id'			=> array('INDEX', 'menu_id'),
					),
				),

				$this->table_prefix . 'pt_menu_items' => array(
					'COLUMNS'        => array(
						'item_id'			=> array('UINT', null, 'auto_increment'),
						'menu_id'			=> array('UINT', 0),
						'group_id'			=> array('UINT', 0),
						'parent_id'			=> array('UINT', 0),
						'item_title'		=> array('XSTEXT_UNI', ''),
						'item_url'			=> array('VCHAR_UNI', ''),
						'item_icon'			=> array('VCHAR', ''),
						'item_desc'			=> array('VCHAR:55', ''),
						'item_target'		=> array('BOOL', 0),
						'item_status'		=> array('BOOL', 1),
						'left_id'			=> array('UINT', 0),
						'right_id'			=> array('UINT', 0),
						'depth'				=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'item_id',
					'KEYS'			=> array(
						'menu_id'		=> array('INDEX', 'menu_id'),
					),
				),
			),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'pt_blocks',
				$this->table_prefix . 'pt_blocks_config',
				$this->table_prefix . 'pt_block_routes',
				$this->table_prefix . 'pt_menus',
				$this->table_prefix . 'pt_menu_items',
			),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'create_forum_cat'))),

			array('config.add', array('primetime_enabled', true)),
			array('config.add', array('primetime_version', '1.0.0')),
			array('config.add', array('primetime_last_changed', 0)),
			array('config.add', array('primetime_default_layout', '')),
			array('config.add', array('primetime_parent_forum_id', 0)),
			array('config.add', array('primetime_forum_perm_from', 0)),

			array('permission.add', array('a_manage_blocks')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_manage_blocks')),

			// Add the Primetime tab in acp
			array('module.add', array('acp', 0, 'Primetime')),

			// Add Primetime Category
			array('module.add', array('acp', 'Primetime', 'ACP_CAT_CMS')),

			array('module.add', array('acp', 'Primetime', 'ACP_PRIMETIME_EXTENSIONS')),

			// Add the dashboard mode
			array('module.add', array('acp', 'ACP_CAT_CMS', array(
					'module_basename'	=> '\primetime\primetime\acp\dashboard_module',
				),
			)),

			// Add Menu module
			array('module.add', array('acp', 'ACP_PRIMETIME_EXTENSIONS', array(
					'module_basename'	=> '\primetime\primetime\acp\menu_module',
				),
			)),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('config.remove', array('primetime_enabled')),
			array('config.remove', array('primetime_version')),
			array('config.remove', array('primetime_last_changed')),
			array('config.remove', array('primetime_default_layout')),
			array('config.remove', array('primetime_parent_forum_id')),
			array('config.remove', array('primetime_forum_perm_from')),
			array('permission.remove', array('a_manage_blocks')),
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
			'forum_name'			=> 'phpBB Primetime',
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

		$acp_forum = new \acp_forums();
		$errors = $acp_forum->update_forum_data($forum_data);

		if (!sizeof($errors))
		{
			$this->config->set('primetime_parent_forum_id', $forum_data['forum_id']);
		}
	}
}
