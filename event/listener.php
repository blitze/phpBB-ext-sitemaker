<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/* @var \phpbb\cache\service */
	protected $cache;

	/* @var \phpbb\request\request_interface */
	protected $request;

	/* @var \primetime\primetime\core\primetime */
	protected $primetime;

	/* @var \primetime\primetime\core\blocks\display */
	protected $blocks;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache			Cache object
	 * @param \phpbb\request\request_interface			$request		Request object
	 * @param \primetime\primetime\core\primetime		$primetim		Primetime helper object
	 * @param \primetime\primetime\core\blocks\display	$blocks			Blocks display object
	*/
	public function __construct(\phpbb\cache\service $cache, \phpbb\request\request_interface $request, \primetime\primetime\core\primetime $primetime, \primetime\primetime\core\blocks\display $blocks)
	{
		$this->cache = $cache;
		$this->request = $request;
		$this->primetime = $primetime;
		$this->blocks = $blocks;
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
		);
	}

	public function init($event)
	{
		define('FORUMS_PREVIEW_FIRST_POST', 1);
		define('FORUMS_PREVIEW_LAST_POST', 2);
		define('FORUMS_ORDER_FIRST_POST', 0);
		define('FORUMS_ORDER_LAST_POST', 1);
		define('FORUMS_ORDER_LAST_READ', 2);
		define('JQUI_VERSION', '1.10.1');

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
		define('PRIMETIME_FORUM_CHANGED', true);
		$this->cache->destroy('sql', array(FORUMS_TABLE, TOPICS_TABLE, POSTS_TABLE, USERS_TABLE));
	}

	public function show_primetime()
	{
		$this->blocks->show();
		$this->set_assets();
	}

	public function set_assets()
	{
		$this->primetime->set_assets();
	}
}
