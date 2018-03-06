<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

use Symfony\Component\DependencyInjection\ContainerInterface;

class display
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	const SHOW_ON_ALL_ROUTES = 0;
	const SHOW_ON_PARENT_ROUTE_ONLY = 1;
	const SHOW_ON_CHILD_ROUTE_ONLY = 2;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth					Auth object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\config\db_text						$config_text			Config text object
	 * @param ContainerInterface						$phpbb_container		Service container
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	 * Show blocks
	 */
	public function show()
	{
		if ($this->page_can_have_blocks())
		{
			$edit_mode = $this->toggle_edit_mode();
			$style_id = $this->get_style_id();
			$current_route = ltrim($this->user->page['page_dir'] . '/' . $this->user->page['page_name'], './');

			$this->show_sitemaker($current_route, $this->user->page['page_dir'], $style_id, $edit_mode);
		}
	}

	/**
	 * Get style id
	 * @return int
	 */
	public function get_style_id()
	{
		if ($this->request->is_set('style'))
		{
			return $this->request->variable('style', 0);
		}
		else
		{
			return (int) ((!$this->config['override_user_style']) ? $this->user->data['user_style'] : $this->config['default_style']);
		}
	}

	/**
	 * @return bool
	 */
	protected function page_can_have_blocks()
	{
		$offlimits = array('ucp.php', 'mcp.php', 'memberlist.php');
		return ($this->user->page['page_dir'] == 'adm' || in_array($this->user->page['page_name'], $offlimits)) ? false : true;
	}

	/**
	 * @return bool
	 */
	protected function toggle_edit_mode()
	{
		$edit_mode = $this->request->variable($this->config['cookie_name'] . '_sm_edit_mode', false, false, \phpbb\request\request_interface::COOKIE);

		if ($this->request->is_set('edit_mode'))
		{
			$edit_mode = $this->request->variable('edit_mode', false);
			$this->user->set_cookie('sm_edit_mode', $edit_mode, 0);
		}

		return $edit_mode;
	}

	/**
	 * @param bool $is_sub_route
	 * @return array
	 */
	protected function get_display_modes($is_sub_route)
	{
		if ($is_sub_route === false)
		{
			$modes = array(
				self::SHOW_ON_ALL_ROUTES		=> true,
				self::SHOW_ON_PARENT_ROUTE_ONLY	=> true,
				self::SHOW_ON_CHILD_ROUTE_ONLY	=> false,
			);
		}
		else
		{
			$modes = array(
				self::SHOW_ON_ALL_ROUTES		=> true,
				self::SHOW_ON_PARENT_ROUTE_ONLY	=> false,
				self::SHOW_ON_CHILD_ROUTE_ONLY	=> true,
			);
		}

		return $modes;
	}

	/**
	 * @param bool  $edit_mode
	 * @param array $modes
	 * @return string
	 */
	protected function get_edit_mode_url(&$edit_mode, array &$modes)
	{
		$u_edit_mode = '';
		if ($this->auth->acl_get('a_sm_manage_blocks'))
		{
			if ($edit_mode)
			{
				$modes = array(
					self::SHOW_ON_ALL_ROUTES		=> true,
					self::SHOW_ON_PARENT_ROUTE_ONLY	=> true,
					self::SHOW_ON_CHILD_ROUTE_ONLY	=> true,
				);
			}

			$u_edit_mode = append_sid(generate_board_url() . '/' . ltrim(rtrim(build_url(array('edit_mode', 'sid', 'style')), '?'), './../'), 'edit_mode=' . (int) !$edit_mode);
		}
		else
		{
			$edit_mode = false;
		}

		return $u_edit_mode;
	}

	/**
	 * @param int $style_id
	 * @return string
	 */
	protected function get_layout($style_id)
	{
		$style_prefs = array_filter((array) json_decode($this->config_text->get('sm_layout_prefs'), true));

		return (isset($style_prefs[$style_id])) ? basename($style_prefs[$style_id]['layout']) : 'portal';
	}

	/**
	 * @param int $style_id
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $style_id
	 * @param bool $edit_mode
	 */
	protected function show_sitemaker($current_route, $page_dir, $style_id, $edit_mode)
	{
		$blocks = $this->phpbb_container->get('blitze.sitemaker.blocks');

		$route_info = $blocks->get_route_info($current_route, $page_dir, $style_id, $edit_mode);
		$display_modes = $this->get_display_modes($route_info['is_sub_route']);
		$u_edit_mode = $this->get_edit_mode_url($edit_mode, $display_modes);

		$this->show_admin_bar($edit_mode, $route_info);

		if ($edit_mode || !$route_info['hide_blocks'])
		{
			$blocks->display($edit_mode, $route_info, $style_id, $display_modes);
		}

		$this->template->assign_vars(array(
			'S_SITEMAKER'		=> true,
			'S_LAYOUT'			=> $this->get_layout($style_id),
			'U_EDIT_MODE'		=> $u_edit_mode,
		));
	}

	/**
	 * @param bool  $edit_mode
	 * @param array $route_info
	 */
	protected function show_admin_bar($edit_mode, array $route_info)
	{
		if ($edit_mode)
		{
			$this->phpbb_container->get('blitze.sitemaker.blocks.admin_bar')->show($route_info);
		}
	}
}
