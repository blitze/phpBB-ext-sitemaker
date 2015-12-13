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
class m10_remove_dashboard extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m4_initial_module',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			// Remove all ACP modules
			array('module.remove', array('acp', 'ACP_SITEMAKER_EXTENSIONS', array(
				'module_langname'	=> 'MENU',
				'module_mode'		=> 'menu',
			))),

			array('module.remove', array('acp', 'ACP_CAT_SITEMAKER', array(
				'module_langname'	=> 'SITEMAKER_DASHBOARD',
				'module_mode'		=> 'dashboard',
			))),

			array('module.remove', array('acp', 'SITEMAKER', 'ACP_SITEMAKER_EXTENSIONS')),

			array('module.remove', array('acp', 'SITEMAKER', 'ACP_CAT_SITEMAKER')),

			array('module.remove', array('acp', 0, 'SITEMAKER')),

			// Add Menu module to Extensions tab
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_SITEMAKER')),
			array('module.add', array(
				'acp', 'ACP_SITEMAKER', array(
					'module_basename'	=> '\blitze\sitemaker\acp\menu_module',
					'modes'				=> array('menu'),
				),
			)),
		);
	}
}
