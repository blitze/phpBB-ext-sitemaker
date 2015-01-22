<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\base\migrations\v20x;

/**
 * Initial schema changes needed for Extension installation
 */
class m3_initial_permission extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('permission.add', array('a_manage_blocks')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_manage_blocks')),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('permission.remove', array('a_manage_blocks')),
		);
	}
}
