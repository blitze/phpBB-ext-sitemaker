<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\action;

use phpbb\request\request_interface;

class set_default_route_test extends base_action
{
	/**
	 * Test setting default route
	 */
	public function test_config_is_set()
	{
		$style_id = 1;
		$route = 'index.php';
		$variable_map = array(
			array('route', '', false, request_interface::REQUEST, $route),
		);

		$command = $this->get_command('set_default_route', $variable_map);

		$command->execute($style_id);

		$this->assertEquals("$route:$style_id", $this->config['sitemaker_default_layout']);
	}
}
