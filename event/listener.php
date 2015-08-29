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

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/* @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/* @var \blitze\sitemaker\services\blocks\display */
	protected $blocks;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/* @var bool */
	protected $startpage = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param ContainerInterface						$phpbb_container		Service container
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param \blitze\sitemaker\services\util			$sitemaker				Sitemaker object
	 * @param \blitze\sitemaker\services\blocks\display	$blocks					Blocks display object
	 * @param string									$root_path				phpBB root path
	 * @param string									$php_ext				php file extension
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\request\request_interface $request, ContainerInterface $phpbb_container, \phpbb\template\template $template, \phpbb\user $user, \blitze\sitemaker\services\util $sitemaker, \blitze\sitemaker\services\blocks\display $blocks, $root_path, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->request = $request;
		$this->phpbb_container = $phpbb_container;
		$this->template = $template;
		$this->user = $user;
		$this->sitemaker = $sitemaker;
		$this->blocks = $blocks;
		$this->phpbb_root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'			=> 'init_sitemaker',
			'core.permissions'			=> 'load_permission_language',
			'core.page_header'			=> 'prepend_breadcrump',
			'core.page_footer'			=> 'show_sitemaker',
			'core.adm_page_footer'		=> 'set_assets',
			'core.submit_post_end'		=> 'clear_cached_queries',
			'core.delete_posts_after'	=> 'clear_cached_queries',
			'core.display_forums_modify_sql'		=> 'set_startpage',
			'core.viewonline_overwrite_location'	=> 'add_viewonline_location',
		);
	}

	public function init_sitemaker($event)
	{
		// Define forum options
		define('FORUMS_PREVIEW_FIRST_POST', 1);
		define('FORUMS_PREVIEW_LAST_POST', 2);

		define('FORUMS_ORDER_FIRST_POST', 0);
		define('FORUMS_ORDER_LAST_POST', 1);
		define('FORUMS_ORDER_LAST_READ', 2);

		// Define block views
		define('SHOW_BLOCK_BOTH', 0);
		define('SHOW_BLOCK_LANDING', 1);
		define('SHOW_BLOCK_SUBPAGE', 2);

		define('JQUI_VERSION', '1.11.4');

		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'blitze/sitemaker',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function load_permission_language($event)
	{
		$categories = $event['categories'];
		$categories = array_merge($categories, array('sitemaker' => 'ACL_CAT_SITEMAKER'));
		$event['categories'] = $categories;

		$permissions = $event['permissions'];
		$permissions = array_merge($permissions, array(
			'a_manage_blocks'	=> array('lang' => 'ACL_A_MANAGE_BLOCKS', 'cat' => 'sitemaker'),
		));
		$event['permissions'] = $permissions;
	}

	/**
	 * if site startpage is something other than index.php
	 * - Add "Forum" to navbar when we are not on the forum page (viewforum/viewtopic)
	 * - Add "Forum" to the breadcrump when viewing forum page (viewforum/viewtopic)
	 */
	public function prepend_breadcrump()
	{
		if ($this->phpbb_container->has($this->config['sitemaker_startpage_controller']))
		{
			$u_viewforum = $this->phpbb_container->get('controller.helper')->route('blitze_sitemaker_forum');

			// Add "Forum" to breadcrump menu when viewing forum pages (viewforum/viewtopic/posting)
			if ($this->request->is_set('f'))
			{
				$this->template->alter_block_array('navlinks', array(
					'FORUM_NAME'	=> $this->user->lang('FORUM'),
					'U_VIEW_FORUM'	=> $u_viewforum,
				));
			}
			// Add "Forum" to navbar when not on forum pages
			else if ($this->user->page['page'] !== 'app.' . $this->php_ext . '/forum')
			{
				$this->template->assign_vars(array(
					'S_PT_SHOW_FORUM_NAV'	=> true,
					'U_PT_VIEWFORUM'		=> $u_viewforum,
				));
			}
		}
	}

	public function clear_cached_queries()
	{
		define('SITEMAKER_FORUM_CHANGED', true);
		$this->cache->destroy('sql', array(FORUMS_TABLE, TOPICS_TABLE, POSTS_TABLE, USERS_TABLE));
	}

	public function show_sitemaker()
	{
		$this->blocks->show();
		$this->set_assets();

		if ($this->startpage)
		{
			$this->template->destroy_block_vars('navlinks');
			$this->template->assign_var('S_PT_SHOW_FORUM', true);
		}

		// Hide login/whois/birthday on index_body.html
		$this->template->assign_vars(array(
			'S_USER_LOGGED_IN'			=> true,
			'S_DISPLAY_ONLINE_LIST'		=> false,
			'S_DISPLAY_BIRTHDAY_LIST'	=> false,
		));
	}

	public function set_assets()
	{
		$this->sitemaker->set_assets();
	}

	public function set_startpage()
	{
		$controller_service = $this->config['sitemaker_startpage_controller'];

		if ($this->user->page['page_name'] == 'index.' . $this->php_ext && $this->phpbb_container->has($controller_service) && !defined('STARTPAGE_IS_SET'))
		{
			$controller_object = $this->phpbb_container->get($controller_service);
			$method = $this->config['sitemaker_startpage_method'];

			// fail silently if startpage is not callable
			if (is_callable(array($controller_object, $method)))
			{
				$controller_dir = explode('\\', get_class($controller_object));
				define('STARTPAGE_IS_SET', 1);

				$controller_style_dir = 'ext/' . $controller_dir[0] . '/' . $controller_dir[1] . '/styles';
				$this->template->set_style(array($controller_style_dir, 'styles'));

				$arguments = explode('/', $this->config['sitemaker_startpage_params']);
				$this->startpage = true;

				$response = call_user_func_array(array($controller_object, $method), $arguments);
				$response->send();

				// This is really used to prevent exiting during tests
				if (!defined('DONT_EXIT'))
				{
					exit_handler();
				}
			}
		}
	}

	public function add_viewonline_location($event)
	{
		if ($event['on_page'][1] == 'app' && strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/forum') === 0)
		{
			$event['location'] = $this->user->lang('FORUM_INDEX');
			$event['location_url'] = $this->phpbb_container->get('controller.helper')->route('blitze_sitemaker_forum');
		}
	}
}
