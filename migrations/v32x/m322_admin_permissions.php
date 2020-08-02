<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v32x;

/**
 * Initial schema changes needed for Extension installation
 */
class m322_admin_permissions extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m3_initial_permission',
			'\blitze\sitemaker\migrations\v20x\m13_add_menu_permission',
			'\blitze\sitemaker\migrations\v30x\m17_add_settings_module',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('permission.permission_set', array('ADMINISTRATORS', 'a_sm_setttings', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_sm_manage_blocks', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_sm_manage_menus', 'group')),
		);
	}
}
