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
class m7_update_settings_data extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m1_initial_schema',
			'\blitze\sitemaker\migrations\v20x\m6_add_block_settings_field',
		);
	}

	/**
	 * Skip this migration if the module_dir column does not exist
	 *
	 * @return bool True to skip this migration, false to run it
	 * @access public
	 */
	public function effectively_installed()
	{
		return !$this->db_tools->sql_table_exists($this->table_prefix . 'sm_blocks_config');
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'update_blocks_settings'))),
		);
	}

	public function update_blocks_settings()
	{
		$result = $this->db->sql_query('SELECT * FROM ' . $this->table_prefix . 'sm_blocks_config');

		$bconfig = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bconfig[$row['bid']][$row['bvar']] = $row['bval'];
		}
		$this->db->sql_freeresult($result);

		foreach ($bconfig as $bid => $settings)
		{
			$sql_data = array(
				'settings'	=> serialize($settings)
			);
			$this->db->sql_query('UPDATE ' . $this->table_prefix . 'sm_blocks SET ' . $this->db->sql_build_array('UPDATE', $sql_data) .' WHERE bid = ' . (int) $bid);
		}
	}
}
