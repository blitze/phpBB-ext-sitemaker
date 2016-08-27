<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v20x;

class m1_initial_schema extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\phpbb\db\migration\data\v31x\v312',
			'\blitze\sitemaker\migrations\converter\c3_update_tables',
			'\blitze\sitemaker\migrations\v20x\m3_initial_permission',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'sm_block_routes' => array(
					'COLUMNS'		=> array(
						'route_id'		=> array('UINT', null, 'auto_increment'),
						'ext_name'		=> array('VCHAR:255', ''),
						'route'			=> array('XSTEXT_UNI', ''),
						'style'			=> array('USINT', 0),
						'hide_blocks'	=> array('BOOL', 0),
						'has_blocks'	=> array('BOOL', 0),
						'ex_positions'	=> array('VCHAR:255', ''),
					),

					'PRIMARY_KEY'	=> 'route_id'
				),

				$this->table_prefix . 'sm_blocks' => array(
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
						'type'			=> array('BOOL', 0),
						'no_wrap'		=> array('BOOL', 0),
						'hide_title'	=> array('BOOL', 0),
						'hash'			=> array('VCHAR:32', ''),
					),

					'PRIMARY_KEY'	=> 'bid',

					'KEYS'			=> array(
						'style'			=> array('INDEX', 'style'),
					),
				),

				$this->table_prefix . 'sm_menus' => array(
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

				$this->table_prefix . 'sm_menu_items' => array(
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
				$this->table_prefix . 'sm_blocks',
				$this->table_prefix . 'sm_blocks_config',
				$this->table_prefix . 'sm_block_routes',
				$this->table_prefix . 'sm_menus',
				$this->table_prefix . 'sm_menu_items',
			),
		);
	}
}
