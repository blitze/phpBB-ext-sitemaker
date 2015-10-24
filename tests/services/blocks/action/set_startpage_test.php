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

class set_startpage_test extends base_action
{
	/**
	 * Test setting default route
	 */
	public function test_config_is_set()
	{
		$controller = 'foo.bar.controller';
		$method = 'handle';
		$params = 'foo';

		$variable_map = array(
			array('controller', '', false, request_interface::REQUEST, $controller),
			array('method', '', false, request_interface::REQUEST, $method),
			array('params', '', false, request_interface::REQUEST, $params),
		);

		$command = $this->get_command('set_startpage', $variable_map);

		$result = $command->execute(1);

		$this->assertEquals($controller, $this->config['sitemaker_startpage_controller']);
		$this->assertEquals($method, $this->config['sitemaker_startpage_method']);
		$this->assertEquals($params, $this->config['sitemaker_startpage_params']);
	}
}
