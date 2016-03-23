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

class prepend_breadcrump_test extends listener_base
{
	/**
	 * @return null
	 */
	public function prepend_breadcrump_test_data()
	{
		$forum_name = 'Forum';
		$u_viewforum = 'blitze_sitemaker_forum#a:0:{}';

		return array(
			// no start page
			array(
				'',
				'index.php',
				array(),
				array(),
			),

			// start page, "Forum" is added to navbar for non-forum pages but not to breadcrump
			array(
				'foo.bar.controller',
				'index.php',
				array(
					'S_PT_SHOW_FORUM_NAV'	=> true,
					'U_PT_VIEWFORUM'		=> $u_viewforum,
				),
				array(),
			),

			// start page, "Forum" is added to breadcrump for forum pages and not to non-forum pages
			array(
				'foo.bar.controller',
				'viewforum.php?f=1',
				array(
					'S_PT_SHOW_FORUM_NAV'	=> true,
					'U_PT_VIEWFORUM'		=> $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),
			// viewtopic
			array(
				'foo.bar.controller',
				'viewtopic.php?f=1&t=1',
				array(
					'S_PT_SHOW_FORUM_NAV'	=> true,
					'U_PT_VIEWFORUM'		=> $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),
			// posting
			array(
				'foo.bar.controller',
				'posting.php?f=1',
				array(
					'S_PT_SHOW_FORUM_NAV'	=> true,
					'U_PT_VIEWFORUM'		=> $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),

			// do not add "Forum" to breadcrump when on forum controller
			array(
				'foo.bar.controller',
				'app.php/forum',
				array(
					'S_PT_SHOW_FORUM_NAV'	=> true,
					'U_PT_VIEWFORUM'		=> $u_viewforum,
				),
				array(),
			),
		);
	}

	/**
	 * @dataProvider prepend_breadcrump_test_data
	 */
	public function test_prepend_breadcrump($start_page, $current_page, $navbar, $breadcrump)
	{
		$listener = $this->get_listener();

		$this->config['sitemaker_startpage_controller'] = $start_page;
		$this->user->page['page'] = $current_page;

		$this->request->expects($this->any())
			->method('is_set')
			->with('f')
			->will($this->returnCallback(function() use ($current_page) {
				return (strpos($current_page, 'f=') !== false) ? true : false;
			}));

		// navbar
		$count = (sizeof($navbar)) ? 1 : 0;
		$this->template->expects($this->exactly($count))
			->method('assign_vars')
			->with($this->equalTo($navbar));

		// breadcrump
		$count = (sizeof($breadcrump)) ? 1 : 0;
		$this->template->expects($this->exactly($count))
			->method('alter_block_array')
			->withConsecutive(array('navlinks'), $breadcrump);

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.page_header', array($listener, 'prepend_breadcrump'));
		$dispatcher->dispatch('core.page_header');
	}
}
