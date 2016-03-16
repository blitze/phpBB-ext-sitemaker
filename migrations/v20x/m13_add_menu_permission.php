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
class m13_add_menu_permission extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m10_remove_dashboard',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('permission.add', array('a_sm_manage_menus', true)),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_sm_manage_blocks')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_sm_manage_menus')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_sm_manage_menus')),
			array('custom', array(array($this, 'update_menu_module_settings'))),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('permission.remove', array('a_sm_manage_menus')),
		);
	}

	public function update_menu_module_settings()
	{
		$data = array(
			'module_auth' => 'ext_blitze/sitemaker && acl_a_sm_manage_menus',
		);
		$sql = 'UPDATE ' . MODULES_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $data) . " WHERE module_basename = '" . $this->db->sql_escape('\blitze\sitemaker\acp\menu_module') . "'";
		$this->db->sql_query($sql);
	}
}
