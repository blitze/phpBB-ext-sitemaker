<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v20x;

class m5_add_cblocks_schema extends \phpbb\db\migration\migration
{
	/**
	 * Skip this migration if the sm_cblocks table already exists
	 *
	 * @return bool True to skip this migration, false to run it
	 * @access public
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_table_exists($this->table_prefix . 'sm_cblocks');
	}

	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m1_initial_schema',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'sm_cblocks' => array(
					'COLUMNS'		=> array(
						'block_id'			=> array('UINT', null, 'auto_increment'),
						'block_content'		=> array('TEXT_UNI', ''),
						'bbcode_bitfield'	=> array('VCHAR:255', ''),
						'bbcode_options'	=> array('UINT:11', 7),
						'bbcode_uid'		=> array('VCHAR:8', ''),
					),

					'PRIMARY_KEY'	=> 'block_id'
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
				$this->table_prefix . 'sm_cblocks',
			),
		);
	}
}
