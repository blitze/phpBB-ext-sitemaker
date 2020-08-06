<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\icons;

use blitze\sitemaker\services\icons\picker;

class picker_test extends \phpbb_test_case
{
	protected $tpl_data;

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
	 * Create the icon picker service
	 *
	 * @param string $phpbb_version
	 * @return \blitze\sitemaker\services\icons\picker
	 */
	public function get_service($phpbb_version)
	{
		$config = new \phpbb\config\config(array(
			'version'	=> $phpbb_version,
		));

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->once())
			->method('add_lang')
			->with(
				$this->equalTo('icons'),
				$this->equalTo('blitze/sitemaker')
			);

		$util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();

		// make sure we've added assets
		$util->expects($this->once())
			->method('add_assets');

		$tpl_data = array();
		$ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$this->tpl_data = &$tpl_data;
		$ptemplate->expects($this->once())
			->method('assign_vars')
			->will($this->returnCallback(function ($data) use (&$tpl_data)
			{
				$tpl_data = array_merge($tpl_data, $data);
			}));

		// make sure we've set style path to this extension
		$ptemplate->expects($this->once())
			->method('set_style')
			->with($this->equalTo(array('ext/blitze/sitemaker/styles', 'styles')));

		// make sure we've set template file
		$ptemplate->expects($this->once())
			->method('set_filenames')
			->with(array(
				'icons'	=> 'icons/picker.html'
			));

		$ptemplate->expects($this->once())
			->method('assign_display')
			->with('icons');

		$categories_path = dirname(__FILE__) . '/categories.json';
		return new picker($config, $translator, $util, $ptemplate, $categories_path);
	}

	/**
	 * Data set for picker_test
	 *
	 * @return array
	 */
	function picker_test_data()
	{
		return array(
			array(
				'3.3.0',
				array(
					'icons_tpl'		=> 'fontawesome4',
					'categories'	=> '',
				),
			),
			array(
				'3.3.1',
				array(
					'icons_tpl'		=> 'fontawesome5',
					'categories'	=> array(
						'logistics' 	=> array(
							array(
								'name' => 'box',
								'terms' => 'archive|container|package|storage|box',
								'prefixes' => ['fas']
							),
							array(
								'name' => 'boxes',
								'terms' => 'archives|inventory|storage|warehouse|boxes',
								'prefixes' => ['fas', 'fab']
							),
						)
					),
				),
			),
		);
	}

	/**
	 * Test the picker method
	 *
	 * @dataProvider picker_test_data
	 * @param string $phpbb_version
	 * @param array $expected
	 */
	function test_picker($phpbb_version, array $expected)
	{
		$icon = $this->get_service($phpbb_version);
		$icon->picker();

		$this->assertSame($expected, $this->tpl_data);
	}
}
