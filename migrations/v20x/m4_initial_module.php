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
class m4_initial_module extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\converter\c1_remove_modules',
			'\blitze\sitemaker\migrations\v20x\m3_initial_permission',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			// Add the Sitemaker tab in ucp/mcp. These will be used later
			array('module.add', array('ucp', 0, 'UCP_SITEMAKER_CONTENT')),
			array('module.add', array('mcp', 0, 'MCP_SITEMAKER_CONTENT')),
		);
	}
}
