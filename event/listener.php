<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\event;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/* @var \primetime\primetime\core\primetime */
	protected $primetime;

	/* @var \primetime\primetime\core\blocks\display */
	protected $blocks;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/* @var bool */
	protected $startpage = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache				Cache object
	 * @param \phpbb\config\db							$config				Config object
	 * @param \phpbb\request\request_interface			$request			Request object
	 * @param Container									$phpbb_container	Service container
	 * @param \phpbb\template\template					$template			Template object
	 * @param \phpbb\user								$user				User object
	 * @param \primetime\primetime\core\primetime		$primetime			Primetime helper object
	 * @param \primetime\primetime\core\blocks\display	$blocks				Blocks display object
	 * @param string									$root_path			phpBB root path
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\db $config, \phpbb\request\request_interface $request, Container $phpbb_container, \phpbb\template\template $template, \phpbb\user $user, \primetime\primetime\core\primetime $primetime, \primetime\primetime\core\blocks\display $blocks, $root_path)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->request = $request;
		$this->phpbb_container = $phpbb_container;
		$this->template = $template;
		$this->user = $user;
		$this->primetime = $primetime;
		$this->blocks = $blocks;
		$this->phpbb_root_path = $root_path;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'			=> 'init',
			'core.permissions'			=> 'load_permission_language',
			'core.append_sid'			=> 'add_edit_mode',
			'core.page_footer'			=> 'show_primetime',
			'core.adm_page_footer'		=> 'set_assets',
			'core.submit_post_end'		=> 'clear_cached_queries',
			'core.delete_posts_after'	=> 'clear_cached_queries',
			'core.display_forums_modify_sql'		=> 'set_startpage',
			'core.viewonline_overwrite_location'	=> 'add_viewonline_location',
		);
	}

	public function init($event)
	{
		define('FORUMS_PREVIEW_FIRST_POST', 1);
		define('FORUMS_PREVIEW_LAST_POST', 2);
		define('FORUMS_ORDER_FIRST_POST', 0);
		define('FORUMS_ORDER_LAST_POST', 1);
		define('FORUMS_ORDER_LAST_READ', 2);
		define('JQUI_VERSION', '1.11.2');

		if (!defined('ADMIN_START'))
		{
			$this->prepend_breadcrump();
		}

		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'primetime/primetime',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function load_permission_language($event)
	{
		$categories = $event['categories'];
		$categories = array_merge($categories, array('primetime' => 'ACL_CAT_PRIMETIME'));
		$event['categories'] = $categories;

		$permissions = $event['permissions'];
		$permissions = array_merge($permissions, array(
			'a_manage_blocks'	=> array('lang' => 'ACL_A_MANAGE_BLOCKS', 'cat' => 'primetime'),
		));
		$event['permissions'] = $permissions;
	}

	public function add_edit_mode($event)
	{
		if ($this->request->is_set('edit_mode') && !preg_match('/ucp|mcp|adm/', $event['url']))
		{
			$params = $event['params'];
			$amp = ($event['is_amp']) ? '&amp;' : '&';
			if (!is_array($params))
			{
				$params .= (($params) ? $amp : '') . 'edit_mode=1';
			}
			else
			{
				$params[] = 'edit_mode=1';
			}
			$event['params'] = $params;
		}
	}

	public function clear_cached_queries()
	{
		define('PRIMETIME_PRIMETIME_FORUM_CHANGED', true);
		$this->cache->destroy('sql', array(FORUMS_TABLE, TOPICS_TABLE, POSTS_TABLE, USERS_TABLE));
	}

	public function show_primetime()
	{
		$this->blocks->show();
		$this->set_assets();

		if ($this->startpage)
		{
			$this->template->destroy_block_vars('navlinks');
			$this->template->assign_var('S_PT_SHOW_FORUM', true);
		}
	}

	public function set_assets()
	{
		$this->primetime->set_assets();
	}

	public function set_startpage()
	{
		$controller_service = $this->config['primetime_startpage_controller'];

		if ($this->user->page['page_name'] == 'index.php' && $this->phpbb_container->has($controller_service))
		{
			$controller_object = $this->phpbb_container->get($controller_service);
			$controller_dir = explode('\\', get_class($controller_object));

			// 0 vendor, 1 extension name, ...
			if (!is_null($this->template) && isset($controller_dir[1]))
			{
				$controller_style_dir = 'ext/' . $controller_dir[0] . '/' . $controller_dir[1] . '/styles';

				if (is_dir($this->phpbb_root_path . $controller_style_dir))
				{
					$this->template->set_style(array($controller_style_dir, 'styles'));
				}
			}

			$method = $this->config['primetime_startpage_method'];
			$arguments = explode('/', $this->config['primetime_startpage_params']);
			$this->startpage = true;

			$response = call_user_func_array(array($controller_object, $method), $arguments);
			$response->send();

			exit_handler();
		}
	}

	public function prepend_breadcrump()
	{
		if ($this->phpbb_container->has($this->config['primetime_startpage_controller']))
		{
			$u_viewforum = $this->phpbb_container->get('controller.helper')->route('primetime_primetime_forum');

			$this->template->assign_vars(array(
				'S_PT_SHOW_FORUM_NAV'	=> true,
				'U_PT_VIEWFORUM'		=> $u_viewforum,
			));

			if ($this->request->is_set('f') && isset($this->user->lang['FORUM']))
			{
				$this->template->assign_block_vars('navlinks', array(
					'FORUM_NAME'	=> $this->user->lang['FORUM'],
					'U_VIEW_FORUM'	=> $u_viewforum,
				));
			}
		}
	}

	public function add_viewonline_location($event)
	{
		if ($event['on_page'][1] == 'app' && strrpos($event['row']['session_page'], 'app.php' . $this->php_ext . '/forum') === 0)
		{
			$event['location'] = $this->user->lang['FORUM_INDEX'];
			$event['location_url'] = $event['row']['session_page'];
		}
	}
}
