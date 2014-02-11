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
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

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
				$this->table_prefix . 'block_routes'	=> array(
					'COLUMNS'		=> array(
						'route_id'		=> array('UINT', NULL, 'auto_increment'),
						'ext_name'		=> array('VCHAR:255', ''),
						'route'			=> array('XSTEXT_UNI', ''),
						'style'			=> array('USINT', 0),
						'hide_blocks'	=> array('BOOL', 0),
						'ex_positions'	=> array('VCHAR:255', ''),
					),

					'PRIMARY_KEY'	=> 'route_id'
				),

				$this->table_prefix . 'blocks'			=> array(
					'COLUMNS'		=> array(
						'bid'			=> array('UINT', NULL, 'auto_increment'),
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

				$this->table_prefix . 'blocks_config'	=> array(
					'COLUMNS'		=> array(
						'bid'			=> array('UINT', 0),
						'bvar'			=> array('VCHAR', ''),
						'bval'			=> array('VCHAR_UNI', ''),
					),

					'KEYS'			=> array(
						'bid'			=> array('INDEX', 'bid'),
					),
				),

				$this->table_prefix . 'menus'	=> array(
					'COLUMNS'        => array(
						'menu_id'			=> array('UINT', NULL, 'auto_increment'),
						'menu_name'			=> array('VCHAR:55', ''),
					),
					'PRIMARY_KEY'	=> 'menu_id',
					'KEYS'			=> array(
						'menu_name'			=> array('UNIQUE', 'menu_name'),
						'menu_id'			=> array('INDEX', 'menu_id'),
					),
				),

				$this->table_prefix . 'menu_items'	=> array(
					'COLUMNS'        => array(
						'item_id'			=> array('UINT', NULL, 'auto_increment'),
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
				$this->table_prefix . 'blocks',
				$this->table_prefix . 'blocks_config',
				$this->table_prefix . 'block_routes',
				$this->table_prefix . 'menus',
				$this->table_prefix . 'menu_items',
			),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('primetime_version', '1.0.0')),
			array('config.add', array('primetime_default_layout', '')),

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
					'module_basename'	=> '\primetime\menu\acp\menu_module',
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
			array('config.remove', array('primetime_version')),
			array('config.remove', array('primetime_default_layout')),
			array('permission.remove', array('a_manage_blocks')),
		);
	}
}