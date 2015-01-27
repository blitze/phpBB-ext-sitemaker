<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\migrations\v20x;

/**
 * Initial schema changes needed for Extension installation
 */
class m4_initial_module extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	static public function depends_on()
	{
		return array(
			'\primetime\core\migrations\converter\c1_remove_modules',
			'\primetime\core\migrations\v20x\m3_initial_permission',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			// Add the Primetime tab in acp
			array('module.add', array('acp', 0, 'Primetime')),

			// Add Primetime Category
			array('module.add', array('acp', 'Primetime', 'ACP_CAT_CMS')),

			array('module.add', array('acp', 'Primetime', 'ACP_PRIMETIME_EXTENSIONS')),

			// Add the dashboard mode
			array('module.add', array('acp', 'ACP_CAT_CMS', array(
					'module_basename'	=> '\primetime\core\acp\dashboard_module',
				),
			)),

			// Add Menu module
			array('module.add', array('acp', 'ACP_PRIMETIME_EXTENSIONS', array(
					'module_basename'	=> '\primetime\core\acp\menu_module',
				),
			)),

			// Add the Primetime tab in ucp/mcp
			array('module.add', array('ucp', 0, 'UCP_PRIMETIME_CONTENT')),
			array('module.add', array('mcp', 0, 'MCP_PRIMETIME_CONTENT')),
		);
	}
}
