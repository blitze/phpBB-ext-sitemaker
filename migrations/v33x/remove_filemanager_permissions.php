<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v33x;

/**
 * Initial schema changes needed for Extension installation
 */
class remove_filemanager_permissions extends \phpbb\db\migration\container_aware_migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v31x\m10_filemanager',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('permission.remove', array('u_sm_filemanager')),
			array('permission.remove', array('a_sm_filemanager')),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'do_nothing'))),
		);
	}

	/**
	 * We are making sure that the config/permission keys listed in update_data above
	 * are not carried over from previous version of this extension but
	 * We do not need them to be recreated by auto revert when this extension is uninstalled
	 * Could not find a cleaner way to do this
	 *
	 * @return void
	 */
	public function do_nothing()
	{
		// do nothing
	}
}
