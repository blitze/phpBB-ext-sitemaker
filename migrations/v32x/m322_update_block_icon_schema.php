<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v32x;

class m322_update_block_icon_schema extends \phpbb\db\migration\migration
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
	 * @inheritdoc
	 */
	public function update_schema()
	{
		return array(
			'change_columns'    => array(
				$this->table_prefix . 'sm_blocks'   => array(
					'icon'	=> array('VCHAR:125', ''),
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
			'change_columns'    => array(
				$this->table_prefix . 'sm_blocks'   => array(
					'icon'	=> array('VCHAR:55', ''),
				),
			),
		);
	}
}
