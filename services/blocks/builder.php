<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

use Symfony\Component\DependencyInjection\Container;

class builder extends base
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icons;

	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	protected $blocks_table;

	/** @var string */
	protected $block_routes_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param Container									$phpbb_container		Service container
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param \blitze\sitemaker\services\icon_picker		$icons					Sitemaker icon picker object
	 * @param \blitze\sitemaker\services\util				$sitemaker				Template object
	 * @param string									$php_ext				phpEx
	 * @param string									$blocks_table			Name of the blocks database table
	 * @param string									$block_routes_table		Name of the block_routes database table
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, Container $phpbb_container, \phpbb\template\template $template, \phpbb\user $user, \blitze\sitemaker\services\icon_picker $icons, \blitze\sitemaker\services\util $sitemaker, $php_ext, $blocks_table, $block_routes_table)
	{
		parent::__construct($config, $phpbb_container, $user, $php_ext);

		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->phpbb_container = $phpbb_container;
		$this->template = $template;
		$this->user = $user;
		$this->icons = $icons;
		$this->sitemaker = $sitemaker;
		$this->php_ext = $php_ext;
		$this->blocks_table = $blocks_table;
		$this->block_routes_table = $block_routes_table;
	}

	/**
	 * Handle the admin bar
	 */
	public function handle($route_info)
	{
		$this->user->add_lang_ext('blitze/sitemaker', 'block_manager');
		$this->add_block_admin_lang();

		$route = $route_info['route'];
		$style_id = $route_info['style'];

		$board_url = generate_board_url();
		$app_url = $board_url . ((!$this->config['enable_mod_rewrite']) ? '/app.' . $this->php_ext : '');
		$ajax_url = $app_url . '/blocks/';
		$u_disp_mode = $board_url . '/' . ltrim(rtrim(build_url(array('edit_mode')), '?'), './../');

		$is_default_route = $u_default_route = false;
		if ($this->config['sitemaker_default_layout'])
		{
			$is_default_route = ($this->config['sitemaker_default_layout'] === $route) ? true : false;
			$u_default_route .= $board_url . '/' . $this->config['sitemaker_default_layout'];
			$u_default_route = reapply_sid($u_default_route);
		}

		$this->get_available_blocks();
		$this->get_startpage_options();
		$this->set_assets();

		$this->template->assign_vars(array(
			'S_EDIT_MODE'		=> true,
			'S_ROUTE_OPS'		=> $this->get_route_options($route),
			'S_HIDE_BLOCKS'		=> $route_info['hide_blocks'],
			'S_POSITION_OPS'	=> $this->get_position_options($route_info['ex_positions']),
			'S_EX_POSITIONS'	=> join(', ', $route_info['ex_positions']),
			'S_IS_DEFAULT'		=> $is_default_route,
			'S_STYLE_OPTIONS'	=> style_select($style_id, true),

			'ICON_PICKER'		=> $this->icons->picker(),
			'PAGE_URL'			=> build_url(array('style')),

			'UA_STYLE_ID'		=> $style_id,
			'UA_ROUTE'			=> $route,
			'UA_AJAX_URL'		=> $ajax_url,
			'UA_APP_URL'		=> $app_url,
			'UA_BOARD_URL'		=> $board_url,

			'U_VIEW_DEFAULT'	=> $u_default_route,
			'U_DISP_MODE'		=> $u_disp_mode,
		));
	}

	/**
	 * Get all available sitemaker blocks
	 */
	public function get_available_blocks()
	{
		if (($blocks = $this->cache->get('sitemaker_available_blocks')) === false)
		{
			$factory = $this->phpbb_container->get('blitze.sitemaker.blocks.factory');

			$blocks = $factory->get_all_blocks();
			$this->cache->put('sitemaker_available_blocks', $blocks);
		}

		foreach ($blocks as $service => $name)
		{
			$lname = strtoupper(str_replace('.', '_', $name));
			$blocks[$service] = (isset($this->user->lang[$lname])) ? $this->user->lang[$lname] : $name;
		}

		asort($blocks);

		foreach ($blocks as $service => $name)
		{
			$this->template->assign_block_vars('block', array(
				'NAME'		=> $name,
				'SERVICE'	=> $service)
			);
		}
	}

	public function get_startpage_options()
	{
		$symfony_request = $this->phpbb_container->get('symfony_request');
		$controller = $symfony_request->attributes->get('_controller');

		if ($controller && $controller !== 'blitze.sitemaker.forum.controller:handle')
		{
			list($controller_service, $controller_method) = explode(':', $controller);
			$controller_params	= $symfony_request->attributes->get('_route_params');
			$controller_object	= $this->phpbb_container->get($controller_service);
			$controller_class	= get_class($controller_object);

			$r = new \ReflectionMethod($controller_class, $controller_method);
			$params = $r->getParameters();

			$arguments = array();
			foreach ($params as $param)
			{
				$name = $param->getName();
				$arguments[$name] = ($param->isOptional()) ? $param->getDefaultValue() : $controller_params[$name];
			}

			list($namespace, $extension) = explode('\\', $controller_class);
			$controller_arguments = join('/', $arguments);

			$this->template->assign_vars(array(
				'CONTROLLER_NAME'	=> $controller_service,
				'CONTROLLER_METHOD'	=> $controller_method,
				'CONTROLLER_PARAMS'	=> $controller_arguments,
				'S_IS_STARTPAGE'	=> ($this->config['sitemaker_startpage_controller'] == $controller_service && $this->config['sitemaker_startpage_params'] == $controller_arguments) ? true : false,
				'UA_EXTENSION'		=> $namespace . '/' . $extension,
			));
		}
	}

	public function set_assets()
	{
		$asset_path = $this->sitemaker->asset_path;
		$this->sitemaker->add_assets(array(
			'js'		=> array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				'//tinymce.cachefly.net/4.1/tinymce.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/twig.js/twig.min.js',
				100 =>  '@blitze_sitemaker/assets/blocks/manager.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				'@blitze_sitemaker/assets/blocks/manager.min.css',
			)
		));
	}

	/**
	 * Get routes with blocks
	 */
	public function get_route_options($route)
	{
		$sql_array = array(
			'SELECT'	=> 'r.route',

			'FROM'	  => array(
				$this->blocks_table			=> 'b',
				$this->block_routes_table	=> 'r',
			),

			'WHERE'	 => 'b.route_id = r.route_id',

			'GROUP_BY'  => 'r.route',

			'ORDER_BY'  => 'r.route',
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$options = '<option value="">' . $this->user->lang['SELECT'] . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected = ($row['route'] == $route) ? " selected='selected'" : '';
			$options .= '<option value="' . $row['route'] . '"' . $selected . '>' . $row['route'] . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $options;
	}

	/**
	 * Get position options
	 */
	public function get_position_options($selected_positions)
	{
		$options = '<option value=""' . ((!sizeof($selected_positions)) ? ' selected="selected"' : '') . '>' . $this->user->lang['NONE'] . '</option>';
		foreach ($selected_positions as $position)
		{
			$options .= '<option value="' . $position . '" selected="selected">' . $position . '</option>';
		}

		return $options;
	}
}
