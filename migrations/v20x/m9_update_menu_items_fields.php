<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v20x;

/**
 * Initial schema changes needed for Extension installation
 */
class m9_update_menu_items_fields extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\converter\c4_convert_primetime_data',
		);
	}

	/**
	 * Update the sm_menu_items schema
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'sm_menu_items'	=> array(
					'item_parents'		=> array('MTEXT', ''),
				),
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'sm_menu_items'	=> array(
					'item_desc',
					'group_id',
				),
			),
		);
	}
}
