<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class sitemaker implements EventSubscriberInterface
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/* @var \blitze\sitemaker\services\util */
	protected $util;

	/* @var \blitze\sitemaker\services\blocks\display */
	protected $blocks;

	/** @var \blitze\sitemaker\services\menus\navigation */
	protected $navigation;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache				Cache driver interface
	 * @param \phpbb\config\config							$config				Config object
	 * @param \phpbb\template\template						$template			Template object
	 * @param \phpbb\language\language						$translator			Language object
	 * @param \phpbb\user									$user				User object
	 * @param \blitze\sitemaker\services\util				$util				Sitemaker utility object
	 * @param \blitze\sitemaker\services\blocks\display		$blocks				Blocks display object
	 * @param \blitze\sitemaker\services\menus\navigation	$navigation			Sitemaker navigation object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\util $util, \blitze\sitemaker\services\blocks\display $blocks, \blitze\sitemaker\services\menus\navigation $navigation)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->template = $template;
		$this->translator = $translator;
		$this->user = $user;
		$this->util = $util;
		$this->blocks = $blocks;
		$this->navigation = $navigation;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.page_footer'			=> 'show_sitemaker',
			'core.adm_page_footer'		=> 'set_assets',
			'core.submit_post_end'		=> 'clear_cached_queries',
			'core.delete_posts_after'	=> 'clear_cached_queries',
			'core.display_forums_modify_sql'	=> 'hide_hidden_forums',
		);
	}

	/**
	 * Show sitemaker blocks on front page
	 * @return void
	 */
	public function show_sitemaker()
	{
		$this->blocks->show();
		$this->show_hide_index_blocks();

		if ($this->config['sm_navbar_menu'])
		{
			$this->navigation->build_menu($this->template, (int) $this->config['sm_navbar_menu'], true);
		}

		$this->set_assets();
	}

	/**
	 * Send assets to template
	 * @return void
	 */
	public function set_assets()
	{
		$this->util->set_assets();
	}

	/**
	 * Queries for forum data are cached unless a post is created/edited
	 * The defined constant is used as an indicator of this change so a new request is made instead
	 * @see \blitze\sitemaker\services\forum\data
	 * @return void
	 */
	public function clear_cached_queries()
	{
		define('SITEMAKER_FORUM_CHANGED', true);
		$this->cache->destroy('sql', array(FORUMS_TABLE, TOPICS_TABLE, POSTS_TABLE, USERS_TABLE));
	}

	/**
	 * @param \phpbb\event\data $event
	 * @return void
	 */
	public function hide_hidden_forums(\phpbb\event\data $event)
	{
		$sql_ary = $event['sql_ary'];

		$sql_ary['WHERE'] .= ($sql_ary['WHERE']) ? ' AND ' : '';
		$sql_ary['WHERE'] .= 'f.hidden_forum <> 1';

		$event['sql_ary'] = $sql_ary;
	}

	/**
	 * Show or hide birthday_list, online users list, and login box on forum index
	 * @return void
	 */
	protected function show_hide_index_blocks()
	{
		$hide_login = (bool) $this->config['sm_hide_login'];
		$hide_online = (bool) $this->config['sm_hide_online'];
		$hide_birthday = (bool) $this->config['sm_hide_birthday'];

		if ($this->config['sitemaker_startpage_controller'])
		{
			$hide_online = $hide_birthday = true;
			$this->template->assign_var('L_INDEX', $this->translator->lang('HOME'));
		}

		$this->template->assign_vars(array(
			'S_USER_LOGGED_IN'			=> ($hide_login || $this->user->data['is_registered']),
			'S_DISPLAY_ONLINE_LIST'		=> !$hide_online,
			'S_DISPLAY_BIRTHDAY_LIST'	=> !$hide_birthday,
		));
	}
}
