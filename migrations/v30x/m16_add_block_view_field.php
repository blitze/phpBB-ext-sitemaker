<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v30x;

/**
 * Initial schema changes needed for Extension installation
 */
class m16_add_block_view_field extends \phpbb\db\migration\migration
{
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
	 * Update the sm_blocks schema
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'sm_blocks'	=> array(
					'no_wrap',
				),
			),
			'add_columns'	=> array(
				$this->table_prefix . 'sm_blocks'	=> array(
					'view'		=> array('VCHAR:55', ''),
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
			'add_columns'	=> array(
				$this->table_prefix . 'sm_blocks'	=> array(
					'no_wrap'		=> array('BOOL', 0),
				),
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'sm_blocks'	=> array(
					'view',
				),
			),
		);
	}
}
