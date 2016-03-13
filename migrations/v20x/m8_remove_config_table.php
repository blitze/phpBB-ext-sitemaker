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
class m8_remove_config_table extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m1_initial_schema',
			'\blitze\sitemaker\migrations\v20x\m7_update_settings_data',
		);
	}

	/**
	 * Skip this migration if the sm_blocks_config table does not exist
	 *
	 * @return bool True to skip this migration, false to run it
	 * @access public
	 */
	public function effectively_installed()
	{
		return !$this->db_tools->sql_table_exists($this->table_prefix . 'sm_blocks_config');
	}

	/**
	 * Update the sm_blocks schema
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'sm_blocks_config',
			),
		);
	}
}
