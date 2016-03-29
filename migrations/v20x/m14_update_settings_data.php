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
class m14_update_settings_data extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m7_update_settings_data',
		);
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
		$result = $this->db->sql_query('SELECT bid, settings FROM ' . $this->table_prefix . "sm_blocks WHERE settings <> ''");

		while ($row = $this->db->sql_fetchrow($result))
		{
			$settings = json_encode(unserialize($row['settings']));
			$sql_data = array(
				'settings'	=> $settings,
				'hash' => md5($settings),
			);
			$this->db->sql_query('UPDATE ' . $this->table_prefix . 'sm_blocks SET ' . $this->db->sql_build_array('UPDATE', $sql_data) .' WHERE bid = ' . (int) $row['bid']);
		}
		$this->db->sql_freeresult($result);
	}
}
