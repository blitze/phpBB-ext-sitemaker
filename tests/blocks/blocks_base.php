<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

abstract class blocks_base extends \phpbb_database_test_case
{
	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
		require_once dirname(__FILE__) . '/../../../../../includes/functions_content.php';

		define('FORUMS_ORDER_FIRST_POST', 0);
		define('FORUMS_ORDER_LAST_POST', 1);
		define('FORUMS_ORDER_LAST_READ', 2);

		$tpl_data = array();
		$this->ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$this->ptemplate->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$this->ptemplate->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($block, $data) use (&$tpl_data) {
				$tpl_data[$block][] = $data;
			}));

		$this->ptemplate->expects($this->any())
			->method('assign_block_vars_array')
			->will($this->returnCallback(function($block, $data) use (&$tpl_data) {
				$tpl_data[$block] = $data;
			}));

		$this->ptemplate->expects($this->any())
			->method('render_view')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));
	}
}
