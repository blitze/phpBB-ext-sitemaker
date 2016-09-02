<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\event;

use Symfony\Component\EventDispatcher\EventDispatcher;

class show_sitemaker_test extends listener_base
{
	/**
	 * @return null
	 */
	public function show_sitemaker_test_data()
	{
		return array(
			array(false),
			array(true),
		);
	}

	/**
	 * @dataProvider show_sitemaker_test_data
	 * @param bool $startpage
	 */
	public function test_show_sitemaker($startpage)
	{
		$listener = $this->get_listener();

		// http://stackoverflow.com/questions/18558183/phpunit-mockbuilder-set-mock-object-internal-property
		$reflection = new \ReflectionClass($listener);
		$reflection_property = $reflection->getProperty('startpage');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($listener, $startpage);

		$this->blocks->expects($this->once())
			->method('show');

		$this->util->expects($this->once())
			->method('set_assets');

		$count = ($startpage) ? 1 : 0;
		$this->template->expects($this->exactly($count))
			->method('destroy_block_vars')
			->with('navlinks');

		$this->template->expects($this->exactly($count))
			->method('assign_var')
			->withConsecutive(array('S_PT_SHOW_FORUM'), array(true));

		$this->template->expects($this->exactly(1))
			->method('assign_vars')
			->with($this->equalTo(array(
				'S_DISPLAY_BIRTHDAY_LIST'	=> false,
			)));

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.page_footer', array($listener, 'show_sitemaker'));
		$dispatcher->dispatch('core.page_footer');
	}
}
