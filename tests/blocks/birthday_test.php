<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\birthday;

class birthday_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/birthday.xml');
	}

	/**
	 * Create the birthday block
	 * @param string $time
	 * @param integer $call_count
	 * @return \blitze\sitemaker\blocks\birthday
	 */
	protected function get_block($time = 'now', $call_count = 0)
	{
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$template->expects($this->exactly($call_count))
			->method('assign_var')
			->with(
				$this->equalTo('S_DISPLAY_BIRTHDAY_LIST'),
				$this->equalTo(false)
			);

		$block = new birthday($this->cache, $this->db, $template, $this->user, $time);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$this->assertEquals(array(), $config);
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
				'10 November 2015',
				'',
			),
			array(
				'7 October 2015',
				array(
					'birthday' => array(
						array(
							'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
							'USER_AGE' => 20,
						),
						array(
							'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=4" class="username">demo1</a>',
							'USER_AGE' => '',
						),
					),
				),
			),
			array(
				'28 February 2015',
				array(
					'birthday' => array(
						array(
							'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=6" class="username">demo3</a>',
							'USER_AGE' => '',
						),
					),
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param string $time
	 * @param mixed $expected
	 */
	public function test_block_display($time, $expected)
	{
		$block = $this->get_block($time, 1);
		$result = $block->display(array());

		$this->assertEquals($expected, $result['content']);
	}
}
