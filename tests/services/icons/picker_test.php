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

	public function test_picker()
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

		$ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		// make sure we've set style path to this extension
		$ptemplate->expects($this->once())
			->method('set_style')
			->with($this->equalTo(array('ext/blitze/sitemaker/styles', 'styles')));

		$ptemplate->expects($this->once())
			->method('assign_var')
			->with(
				'categories',
				$this->equalTo(array(
					'logistics' => array(
						'icons' => array(
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
						),
					)
				))
			);

		// make sure we've set template file
		$ptemplate->expects($this->once())
			->method('set_filenames')
			->with(array(
				'icons'	=> 'icon_picker.html'
			));

		$ptemplate->expects($this->once())
			->method('assign_display')
			->with('icons');

		$categories_path = dirname(__FILE__) . '/categories.yml';
		$icon = new picker($translator, $util, $ptemplate, $categories_path);
		$icon->picker();
	}
}
