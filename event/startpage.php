<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\event;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class startpage implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $php_ext;

	/* @var bool */
	protected $is_startpage = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config						$config					Config object
	 * @param ContainerInterface						$phpbb_container		Service container
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\language\language					$translator				Language object
	 * @param \phpbb\user								$user					User object
	 * @param string									$php_ext				php file extension
	 */
	public function __construct(\phpbb\config\config $config, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\language\language $translator, \phpbb\user $user, $php_ext)
	{
		$this->config = $config;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->template = $template;
		$this->translator = $translator;
		$this->user = $user;
		$this->php_ext = $php_ext;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.page_header'					=> 'add_forum_to_navbar',
			'core.display_forums_modify_sql'	=> 'set_startpage',
			'core.page_footer'					=> 'cleanup_breadcrumbs',
		);
	}

	/**
	 * If start page is set,
	 * - Add "Forum" to navbar
	 * - Add "Forum" to the breadcrump when viewing forum page (viewforum/viewtopic/posting)
	 */
	public function add_forum_to_navbar()
	{
		if ($this->config['sitemaker_startpage_controller'])
		{
			$u_viewforum = $this->phpbb_container->get('controller.helper')->route('blitze_sitemaker_forum');

			// show 'Forum' menu item in navbar
			$this->template->assign_vars(array(
				'SM_FORUM_ICON'		=> $this->config['sm_forum_icon'],
				'SM_SHOW_FORUM_NAV'	=> $this->config['sm_show_forum_nav'],
				'U_SM_VIEWFORUM'	=> $u_viewforum,
			));

			// Add "Forum" to breadcrumb menu when viewing forum pages (viewforum/viewtopic/posting)
			if ($this->request->is_set('f'))
			{
				$this->template->alter_block_array('navlinks', array(
					'FORUM_NAME'	=> $this->translator->lang('FORUM'),
					'U_VIEW_FORUM'	=> $u_viewforum,
				));
			}
		}
	}

	/**
	 * If we are on the index page and we have set a custom start page,
	 * we do not want breadcrumbs like Home > Articles on the index page.
	 * This removes everything else, leaving just 'Home'
	 * @return void
	 */
	public function cleanup_breadcrumbs()
	{
		if ($this->is_startpage)
		{
			$this->template->destroy_block_vars('navlinks');
		}
	}

	/**
	 * @return void
	 */
	public function set_startpage()
	{
		if ($this->user->page['page_name'] == 'index.' . $this->php_ext && !$this->is_startpage && ($controller_object = $this->get_startpage_controller()) !== false)
		{
			$method = $this->config['sitemaker_startpage_method'];
			$this->is_startpage = true;

			$controller_dir = explode('\\', get_class($controller_object));
			$controller_style_dir = 'ext/' . $controller_dir[0] . '/' . $controller_dir[1] . '/styles';
			$this->template->set_style(array($controller_style_dir, 'styles'));

			$arguments = explode('/', $this->config['sitemaker_startpage_params']);

			/** @type \Symfony\Component\HttpFoundation\Response $response */
			$response = call_user_func_array(array($controller_object, $method), $arguments);
			$response->send();

			$this->exit_handler();
		}
	}

	/**
	 * @codeCoverageIgnore
	 */
	protected function exit_handler()
	{
		exit_handler();
	}

	/**
	 * @return object|false
	 */
	protected function get_startpage_controller()
	{
		$controller_service_name = $this->config['sitemaker_startpage_controller'];
		if ($this->phpbb_container->has($controller_service_name))
		{
			$controller_object = $this->phpbb_container->get($controller_service_name);
			$method = $this->config['sitemaker_startpage_method'];

			if (is_callable(array($controller_object, $method)))
			{
				return $controller_object;
			}
		}

		// we have a startpage controller but it does not exist or it is not callable so remove it
		if ($controller_service_name)
		{
			$this->config->set('sitemaker_startpage_controller', '');
			$this->config->set('sitemaker_startpage_method', '');
			$this->config->set('sitemaker_startpage_params', '');
		}

		return false;
	}
}
