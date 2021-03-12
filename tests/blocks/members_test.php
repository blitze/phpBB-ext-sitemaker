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
		$this->members = $this->getMockBuilder('\blitze\sitemaker\services\members')
			->disableOriginalConstructor()
			->getMock();

		return new members($this->translator, $this->user, $this->members);
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
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/members.html', $block->get_template());
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
						'date_range' => '',
					),
				),
				array(
					'title' => 'LAST_VISITED',
					'data' => array(
						'S_LIST'	=> 'visits',
						'MEMBERS'	=> 'visits list',
						'RANGE'		=> 'ALL_TIME',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'bots',
						'date_range' => 'month',
					),
				),
				array(
					'title' => 'RECENT_BOTS',
					'data' => array(
						'S_LIST'	=> 'bots',
						'MEMBERS'	=> 'bots list',
						'RANGE'		=> 'THIS_MONTH',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'recent',
						'date_range' => 'today',
					),
				),
				array(
					'title' => 'RECENT_MEMBERS',
					'data' => array(
						'S_LIST'	=> 'recent',
						'MEMBERS'	=> 'recent list',
						'RANGE'		=> 'TODAY',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'tenured',
						'date_range' => 'week',
					),
				),
				array(
					'title' => 'MOST_TENURED',
					'data' => array(
						'S_LIST'	=> 'tenured',
						'MEMBERS'	=> 'tenured list',
						'RANGE'		=> 'ALL_TIME',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'query_type' => 'posts',
						'date_range' => 'year',
					),
				),
				array(
					'title' => 'TOP_POSTERS',
					'data' => array(
						'S_LIST'	=> 'posts',
						'MEMBERS'	=> 'posts list',
						'RANGE'		=> 'THIS_YEAR',
					),
				),
			),
		);
	}

	/**
	 * Test block display
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param array $expected
	 */
	public function test_block_display(array $bdata, array $expected)
	{
		$block = $this->get_block();

		$this->members->expects($this->once())
			->method('get_list')
			->will($this->returnCallback(function ($data)
			{
				return array(
					'S_LIST'	=> $data['query_type'],
					'MEMBERS'	=> $data['query_type'] . ' list',
				);
			}));

		$result = $block->display($bdata);

		$this->assertSame($expected, $result);
	}
}
