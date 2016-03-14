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
class m11_remove_item_status_column extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m9_update_menu_items_fields',
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
			'drop_columns'	=> array(
				$this->table_prefix . 'sm_menu_items'	=> array(
					'item_status',
				),
			),
		);
	}
}
