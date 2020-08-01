<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\converter;

class c2_update_data extends \phpbb\db\migration\migration
{
	/**
	 * Skip this migration if pt_parent_forum_id config key does not exist
	 *
	 * @return bool True to skip this migration, false to run it
	 * @access public
	 */
	public function effectively_installed()
	{
		return !isset($this->config['pt_parent_forum_id']);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('config.remove', array('cms_enabled')),
			array('config.remove', array('cms_version')),
			array('config.remove', array('primetime_gc')),
			array('config.remove', array('primetime_last_gc')),
			array('config.remove', array('cms_forum_changed')),
			array('config.remove', array('pt_parent_forum_id')),

			array('permission.remove', array('a_cms_mods')),
			array('permission.remove', array('a_cms_manage_mods')),
			array('permission.remove', array('a_cms_blocks')),
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
