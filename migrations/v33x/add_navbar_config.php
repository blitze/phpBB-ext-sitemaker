<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v33x;

/**
 * Initial schema changes needed for Extension installation
 */
class add_navbar_config extends \phpbb\db\migration\container_aware_migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\converter\c2_update_data',
			'\blitze\sitemaker\migrations\v20x\m1_initial_schema',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('sm_navbar_last_modified', 0)),
			array('config.add', array('sm_navbar_locations', '')),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'remove_navbar_css'))),
			array('config.remove', array('sm_navbar_last_modified')),
			array('config.remove', array('sm_navbar_locations')),
		);
	}

	/**
	 * Remove navbar css stored in config_text for all styles
	 * @return void
	 */
	public function remove_navbar_css()
	{
		$this->container->get('blitze.sitemaker.navbar')->cleanup(true);
	}
}
