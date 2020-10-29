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
	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	public function test_icon_picker()
	{
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

		$template = $this->getMockBuilder('\phpbb\template\template')
			->disableOriginalConstructor()
			->getMock();

		$template->expects($this->once())
			->method('assign_var')
			->with($this->equalTo('categories'), $this->equalTo(array(
				'logistics' 	=> array(
					array(
						'id' => 'box',
						'name' => 'Box',
						'filter' => ['archive', 'container', 'package', 'storage', 'box'],
					),
					array(
						'id' => 'boxes',
						'name' => 'Boxes',
						'filter' => ['archives', 'inventory', 'storage', 'warehouse', 'boxes']
					),
				),
				'example'	=>  array(
					array(
						'id' => 'sample-code',
						'name' => 'Sample Code',
						'filter' => ['sample', 'code']
					)
				)
			)));

		// make sure we've set template file
		$template->expects($this->once())
			->method('set_filenames')
			->with(array(
				'icons'	=> '@blitze_sitemaker/icons/picker.html'
			));

		$template->expects($this->once())
			->method('assign_display')
			->with('icons');

		$categories_path = dirname(__FILE__) . '/categories.json';
		$icon = new picker($translator, $template, $util, $categories_path);
		$icon->picker();
	}
}
