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
				'index.php',
				array(),
				array(),
				array(),
			),

			// start page, "Forum" is added to navbar for non-forum pages but not to breadcrump
			array(
				'index.php',
				array(
					'sm_forum_icon' => 'fa fa-comments',
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments',
					'SM_SHOW_FORUM_NAV'	=> true,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(),
			),

			// start page, "Forum" should be added to navbar but user has chosen not to do that
			array(
				'index.php',
				array(
					'sm_forum_icon' => 'fa fa-comments',
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments',
					'SM_SHOW_FORUM_NAV'	=> false,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(),
			),

			// start page, "Forum" is added to breadcrump for forum pages and not to non-forum pages
			array(
				'viewforum.php?f=1',
				array(
					'sm_forum_icon' => 'fa fa-comments',
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments',
					'SM_SHOW_FORUM_NAV'	=> false,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),
			// viewtopic
			array(
				'viewtopic.php?f=1&t=1',
				array(
					'sm_forum_icon' => '',
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => '',
					'SM_SHOW_FORUM_NAV'	=> false,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),
			// posting
			array(
				'posting.php?f=1',
				array(
					'sm_forum_icon' => 'fa fa-comments-o',
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments-o',
					'SM_SHOW_FORUM_NAV'	=> true,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),

			// do not add "Forum" to breadcrump when on forum controller
			array(
				'app.php/forum',
				array(
					'sm_forum_icon' => '',
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => '',
					'SM_SHOW_FORUM_NAV'	=> true,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(),
			),
		);
	}

	/**
	 * @dataProvider prepend_breadcrump_test_data
	 *
	 * @param string $start_page
	 * @param string $current_page
	 * @param array $navbar
	 * @param array $breadcrump
	 */
	public function test_prepend_breadcrump($current_page, array $config_data, array $navbar, array $breadcrump)
	{
		$listener = $this->get_listener();

		$this->user->page['page'] = $current_page;

		foreach ($config_data as $key => $value)
		{
			$this->config->set($key, $value);
		}

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
