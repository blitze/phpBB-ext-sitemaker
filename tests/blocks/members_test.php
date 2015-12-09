<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\members;

class members_test extends blocks_base
{
	protected $members;

	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/users.xml');
	}

	/**
	 * Create the members block
	 *
	 * @return \blitze\sitemaker\blocks\members
	 */
	protected function get_block()
	{
		global $phpbb_dispatcher, $user;

		$user = new \phpbb\user('\phpbb\datetime');

		$this->members = $this->getMockBuilder('\blitze\sitemaker\services\members')
			->disableOriginalConstructor()
			->getMock();

		$block = new members($user, $this->members);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'query_type',
			'date_range',
			'max_members',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_test_data()
	{
		return array(
			array(
				array(
					'settings' => array(
						'query_type' => 'visits',
					),
				),
				array(
					'title' => 'LAST_VISITED',
					'content' => 'visits list',
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'bots',
					),
				),
				array(
					'title' => 'RECENT_BOTS',
					'content' => 'bots list',
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'recent',
					),
				),
				array(
					'title' => 'RECENT_MEMBERS',
					'content' => 'recent list',
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'tenured',
					),
				),
				array(
					'title' => 'MOST_TENURED',
					'content' => 'tenured list',
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'posts',
					),
				),
				array(
					'title' => 'TOP_POSTERS',
					'content' => 'posts list',
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($bdata, $expected)
	{
		$block = $this->get_block();

		$this->members->expects($this->once())
			->method('get_list')
			->will($this->returnCallback(function($data) {
				return $data['query_type'] . ' list';
			}));

		$result = $block->display($bdata);

		$this->assertSame($expected, $result);
	}
}
