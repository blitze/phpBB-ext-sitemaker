<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\google_maps;

class google_maps_test extends blocks_base
{
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
	 * Create the google maps block
	 * @param integer $call_count
	 * @return \blitze\sitemaker\blocks\google_maps
	 */
	protected function get_block($call_count)
	{
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$template->expects($this->exactly($call_count))
			->method('retrieve_var')
			->with($this->equalTo('S_USER_LANG'))
			->willReturn('pt-BR');

		return new google_maps($template);
	}

	public function test_block_config()
	{
		$block = $this->get_block(0);
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'title',
			'location',
			'coordinates',
			'zoom',
			'view',
			'height',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block(0);

		$this->assertEquals('@blitze_sitemaker/blocks/google_maps.html', $block->get_template());
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
					'location'		=> 'some place',
					'coordinates'	=> '123456,67890',
					'height'		=> 200,
					'title'			=> 'my map',
					'view'			=> 'k',
					'zoom'			=> 15,
					'lang_code'		=> 'pt-BR',
				),
				array(
					'location'		=> 'some+place',
					'coordinates'	=> '123456,67890',
					'height'		=> 200,
					'title'			=> 'my+map',
					'view'			=> 'k',
					'zoom'			=> 15,
					'lang_code'		=> 'pt-BR',
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $config
	 * @param string $expected
	 */
	public function test_block_display(array $config, $expected)
	{
		$block = $this->get_block(1);
		$result = $block->display(array('settings' => $config));

		$this->assertEquals($expected, $result['data']);
	}
}
