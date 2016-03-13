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
class m12_add_hidden_forums extends \phpbb\db\migration\migration
{
	/**
	 * Update forums table schema
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'forums'	=> array(
					'hidden_forum'		=> array('BOOL', 0),
				),
			),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'set_hidden_forums'))),
		);
	}

	public function update_blocks_settings()
	{
		$data = array(
			'hidden_forum' => 1,
		);
		$sql = 'UPDATE ' . FORUMS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $data) . ' WHERE forum_id = ' . (int) $this->config['sitemaker_parent_forum_id'];
		$this->db->sql_query($sql);
	}
}
