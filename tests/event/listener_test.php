<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\event;

class listener_test extends listener_base
{
	/**
	* Test the event listener is constructed correctly
	*/
	public function test_construct()
	{
		$listener = $this->get_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $listener);
	}

	/**
	* Test the event listener is subscribing events
	*/
	public function test_getSubscribedEvents()
	{
		$listeners = array(
			'core.user_setup',
			'core.permissions',
			'core.page_header',
			'core.page_footer',
			'core.adm_page_footer',
			'core.submit_post_end',
			'core.delete_posts_after',
			'core.display_forums_modify_sql',
			'core.viewonline_overwrite_location',
		);

		$this->assertEquals($listeners, array_keys(\blitze\sitemaker\event\listener::getSubscribedEvents()));
	}
}
