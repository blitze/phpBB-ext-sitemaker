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

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var bool */
	private $is_subpage;

	/** @var string */
	public $route;

	const SHOW_BLOCK_BOTH = 0;
	const SHOW_BLOCK_LANDING = 1;
	const SHOW_BLOCK_SUBPAGE = 2;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth					Auth object
	 * @param \phpbb\config\config						$config					Config object
	 * @param ContainerInterface						$phpbb_container		Service container
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->config = $config;
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
		$this->phpbb_container->get('blitze.sitemaker.util')->add_assets(array(
			'css' => array('@blitze_sitemaker/vendor/fontawesome/css/font-awesome.css')
		));

		$this->template->assign_var('L_INDEX', $this->user->lang('HOME'));

		if ($this->page_can_have_blocks())
		{
			$edit_mode = $this->toggle_edit_mode();
			$display_modes = $this->get_display_modes();
			$u_edit_mode = $this->get_edit_mode_url($edit_mode, $display_modes);

			$this->show_blocks($edit_mode, $display_modes);

			$this->template->assign_vars(array(
				'S_SITEMAKER'		=> true,
				'U_EDIT_MODE'		=> $u_edit_mode,
			));
		}
	}

	/**
	 * Set current route
	 */
	public function set_route()
	{
		$this->route = $this->user->page['page_name'];
		$this->is_subpage = ($this->user->page['query_string']) ? true : false;
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
			return (!$this->config['override_user_style']) ? $this->user->data['user_style'] : $this->config['default_style'];
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
	 * @return array
	 */
	protected function get_display_modes()
	{
		$this->set_route();

		if ($this->is_subpage === false)
		{
			$modes = array(
				self::SHOW_BLOCK_BOTH		=> true,
				self::SHOW_BLOCK_LANDING	=> true,
				self::SHOW_BLOCK_SUBPAGE	=> false,
			);
		}
		else
		{
			$modes = array(
				self::SHOW_BLOCK_BOTH		=> true,
				self::SHOW_BLOCK_LANDING	=> false,
				self::SHOW_BLOCK_SUBPAGE	=> true,
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
					self::SHOW_BLOCK_BOTH		=> true,
					self::SHOW_BLOCK_LANDING	=> true,
					self::SHOW_BLOCK_SUBPAGE	=> true,
				);
			}

			$u_edit_mode = append_sid(generate_board_url() . '/' . ltrim(rtrim(build_url(array('edit_mode', 'style')), '?'), './../'), 'edit_mode=' . (int) !$edit_mode);
		}
		else
		{
			$edit_mode = false;
		}

		return $u_edit_mode;
	}

	/**
	 * @param bool  $edit_mode
	 * @param array $display_modes
	 */
	protected function show_blocks($edit_mode, array $display_modes)
	{
		$blocks = $this->phpbb_container->get('blitze.sitemaker.blocks');

		$style_id = $this->get_style_id();
		$route_info = $blocks->get_route_info($this->route, $style_id, $edit_mode);

		$this->show_admin_bar($edit_mode, $route_info);

		$blocks->display($edit_mode, $route_info, $style_id, $display_modes);
	}
}
