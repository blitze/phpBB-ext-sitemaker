<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\converter;

/**
 * Initial schema changes needed for Extension installation
 */
class c3_update_tables extends \phpbb\db\migration\migration
{
	/**
	 * Skip this migration if a previous blocks table does not exist
	 *
	 * @return bool True to skip this migration, false to run it
	 * @access public
	 */
	public function effectively_installed()
	{
		return !$this->db_tools->sql_table_exists($this->table_prefix . 'blocks');
	}

	/**
	 * Update the table name
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'blocks',
				$this->table_prefix . 'blocks_config',
				$this->table_prefix . 'block_positions',
			),
			'add_columns'	=> array(
				$this->table_prefix . 'menu_items'	=> array(
					'depth'		=> array('UINT', 0),
				),
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'menus'		=> array('menu_type', 'menu_status'),
				$this->table_prefix . 'menu_items'	=> array('item_expanded'),
				$this->table_prefix . 'forums'		=> array('module'),
				$this->table_prefix . 'users'		=> array('user_week_start'),
			),
		);
	}
}
