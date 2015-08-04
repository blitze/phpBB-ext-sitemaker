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

class clear_cached_queries_test extends listener_base
{
	/**
	* Test the event listener is constructed correctly
	*/
	public function test_clear_cached_queries()
	{
		$listener = $this->get_listener();

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.submit_post_end', array($listener, 'clear_cached_queries'));
		$dispatcher->dispatch('core.submit_post_end');

		$this->assertTrue(defined('SITEMAKER_FORUM_CHANGED'));
	}
}
