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

class admin_bar
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\event\dispatcher_interface */
	protected $phpbb_dispatcher;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\filemanager\setup */
	protected $filemanager;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icons;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config							$config					Config object
	 * @param \phpbb\controller\helper						$controller_helper		Controller Helper object
	 * @param ContainerInterface							$phpbb_container		Service container
	 * @param \phpbb\event\dispatcher_interface				$phpbb_dispatcher		Event dispatcher object
	 * @param \phpbb\template\template						$template				Template object
	 * @param \phpbb\language\language						$translator				Language object
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\services\filemanager\setup	$filemanager			Filemanager object
	 * @param \blitze\sitemaker\services\icon_picker		$icons					Sitemaker icon picker object
	 * @param \blitze\sitemaker\services\util				$util					Sitemaker util object
	 * @param string										$php_ext				phpEx
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $controller_helper, ContainerInterface $phpbb_container, \phpbb\event\dispatcher_interface $phpbb_dispatcher, \phpbb\template\template $template, \phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\filemanager\setup $filemanager, \blitze\sitemaker\services\icon_picker $icons, \blitze\sitemaker\services\util $util, $php_ext)
	{
		$this->config = $config;
		$this->controller_helper = $controller_helper;
		$this->phpbb_container = $phpbb_container;
		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->template = $template;
		$this->translator = $translator;
		$this->user = $user;
		$this->filemanager = $filemanager;
		$this->icons = $icons;
		$this->util = $util;
		$this->php_ext = $php_ext;
	}

	/**
	 * Show admin bar
	 *
	 * @param array $route_info
	 */
	public function show(array $route_info)
	{
		$this->translator->add_lang('block_manager', 'blitze/sitemaker');

		$this->phpbb_container->get('blitze.sitemaker.auto_lang')->add('blocks_admin');

		$route = $route_info['route'];
		$style_id = $route_info['style'];

		$this->get_available_blocks();
		$this->get_startpage_options();
		$this->set_javascript_data($route, $style_id);
		$this->set_assets();

		$this->template->assign_vars(array(
			'S_EDIT_MODE'		=> true,
			'S_ROUTE_OPS'		=> $this->get_route_options($route),
			'S_HIDE_BLOCKS'		=> $route_info['hide_blocks'],
			'S_POSITION_OPS'	=> $this->get_excluded_position_options($route_info['ex_positions']),
			'S_EX_POSITIONS'	=> join(', ', $route_info['ex_positions']),
			'S_STYLE_OPTIONS'	=> style_select($style_id, true),
			'S_STARTPAGE'		=> $this->startpage_is_set(),

			'ICON_PICKER'		=> $this->icons->picker(),
		));
	}

	/**
	 * Set data used in javascript
	 * @param string $route
	 * @param int $style_id
	 */
	public function set_javascript_data($route, $style_id)
	{
		$board_url = generate_board_url();
		$is_default_route = $u_default_route = false;
		if ($this->config['sitemaker_default_layout'])
		{
			$is_default_route = ($this->config['sitemaker_default_layout'] === $route) ? true : false;
			$u_default_route .= $board_url . '/' . $this->config['sitemaker_default_layout'];
			$u_default_route = reapply_sid($u_default_route);
		}

		$this->template->assign_vars(array_merge(array(
			'S_IS_DEFAULT'		=> $is_default_route,

			'BLOCK_ACTIONS'		=> $this->get_block_actions(),
			'PAGE_URL'			=> build_url(array('style')),

			'UA_BOARD_URL'		=> $board_url,
			'UA_ROUTE'			=> $route,
			'UA_STYLE_ID'		=> $style_id,
			'UA_SCRIPT_PATH'	=> $this->user->page['root_script_path'],
			'UA_MODREWRITE'		=> $this->config['enable_mod_rewrite'],
			'UA_WEB_ROOT_PATH'	=> $this->util->get_web_path(),
			'UA_UPLOAD_URL'		=> $this->controller_helper->route('blitze_sitemaker_image_upload'),

			'U_VIEW_DEFAULT'	=> $u_default_route,
		), $this->get_filemanager_settings()));
	}

	/**
	 * @return array
	 */
	protected function get_block_actions()
	{
		$list = array(
			'add_block',
			'copy_route',
			'edit_block',
			'handle_custom_action',
			'save_block',
			'save_blocks',
			'set_default_route',
			'set_route_prefs',
			'set_startpage',
			'update_block',
		);

		$actions = array();
		foreach ($list as $action)
		{
			$actions[$action] = $this->controller_helper->route('blitze_sitemaker_blocks_admin', array('action' => $action));
		}

		return $actions;
	}

	/**
	 * Get all available sitemaker blocks
	 */
	public function get_available_blocks()
	{
		$blocks = $this->phpbb_container->get('blitze.sitemaker.blocks.factory')->get_all_blocks();

		foreach ($blocks as $service => $name)
		{
			$this->template->assign_block_vars('block', array(
				'NAME'		=> $name,
				'SERVICE'	=> $service)
			);
		}
	}

	/**
	 * Provide options to set/unset current page as landing page
	 */
	public function get_startpage_options()
	{
		$symfony_request = $this->phpbb_container->get('symfony_request');
		$controller = $symfony_request->attributes->get('_controller');

		if ($controller)
		{
			list($controller_service, $controller_method) = explode(':', $controller);
			$controller_params	= $symfony_request->attributes->get('_route_params');
			$controller_object	= $this->phpbb_container->get($controller_service);
			$controller_class	= get_class($controller_object);

			$r = new \ReflectionMethod($controller_class, $controller_method);
			$class_params = $r->getParameters();

			list($namespace, $extension) = explode('\\', $controller_class);
			$controller_arguments = $this->get_arguments($controller_params, $class_params);

			$this->template->assign_vars(array(
				'CONTROLLER_NAME'	=> $controller_service,
				'CONTROLLER_METHOD'	=> $controller_method,
				'CONTROLLER_PARAMS'	=> $controller_arguments,
				'S_IS_STARTPAGE'	=> $this->is_startpage($controller_service, $controller_arguments),
				'UA_EXTENSION'		=> $namespace . '/' . $extension,
			));
		}
	}

	/**
	 * Add js/css
	 */
	public function set_assets()
	{
		$assets = array(
			'js'	=> array(
				'@blitze_sitemaker/vendor/jquery-ui/jquery-ui.min.js',
				'@blitze_sitemaker/vendor/tinymce/tinymce.min.js',
				'@blitze_sitemaker/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				'@blitze_sitemaker/vendor/twig.js/index.js',
				1000 =>  '@blitze_sitemaker/assets/blocks/manager.min.js',
			),
			'css'   => array(
				'@blitze_sitemaker/vendor/jquery-ui/themes/smoothness/jquery-ui.min.css',
				'@blitze_sitemaker/assets/blocks/manager.min.css',
			)
		);

		/**
		 * Event to set assets for available blocks
		 * Use array_merge_recursive to add new assets
		 *
		 * @event blitze.sitemaker.admin_bar.set_assets
		 * @var	array	assets		Array of assets to include of form array([js] => array(), [css] => array())
		 * @since 3.0.1-RC1
		 */
		$vars = array('assets');
		extract($this->phpbb_dispatcher->trigger_event('blitze.sitemaker.admin_bar.set_assets', compact($vars)));

		$this->util->add_assets($assets);
	}

	/**
	 * Get routes with blocks
	 *
	 * @param string $current_route
	 * @return string
	 */
	public function get_route_options($current_route)
	{
		$routes_ary = $this->get_routes();

		$options = '<option value="">' . $this->translator->lang('SELECT') . '</option>';
		foreach ($routes_ary as $route)
		{
			$selected = ($route == $current_route) ? ' selected="selected"' : '';
			$options .= '<option value="' . $route . '"' . $selected . '>' . $route . '</option>';
		}

		return $options;
	}

	/**
	 * Get excluded position options
	 *
	 * @param array $ex_positions
	 * @return string
	 */
	public function get_excluded_position_options(array $ex_positions)
	{
		$options = '';
		foreach ($ex_positions as $position)
		{
			$options .= '<option value="' . $position . '" selected="selected">' . $position . '</option>';
		}

		return $options;
	}

	/**
	 * @return array
	 */
	protected function get_routes()
	{
		$factory = $this->phpbb_container->get('blitze.sitemaker.mapper.factory');
		$collection = $factory->create('routes')->find();

		$routes_ary = array();
		foreach ($collection as $entity)
		{
			/** @var \blitze\sitemaker\model\entity\route $entity */
			$route_name = $entity->get_route();
			$routes_ary[$route_name] = $route_name;
		}

		return $routes_ary;
	}

	/**
	 * @param array $controller_params
	 * @param array $class_params
	 * @return string
	 */
	protected function get_arguments(array $controller_params, array $class_params)
	{
		$arguments = array();
		foreach ($class_params as $param)
		{
			$name = $param->getName();
			$arguments[$name] = ($param->isOptional()) ? $param->getDefaultValue() : $controller_params[$name];
		}

		return join('/', $arguments);
	}

	/**
	 * @param string $controller_service
	 * @param string $controller_arguments
	 * @return bool
	 */
	protected function is_startpage($controller_service, $controller_arguments)
	{
		return ($this->config['sitemaker_startpage_controller'] == $controller_service && $this->config['sitemaker_startpage_params'] == $controller_arguments) ? true : false;
	}

	/**
	 * @return bool
	 */
	protected function startpage_is_set()
	{
		return ($this->config['sitemaker_startpage_controller']) ? true : false;
	}

	/**
	 * @return array
	 */
	protected function get_filemanager_settings()
	{
		$enabled = $this->filemanager->is_enabled();

		if ($enabled)
		{
			$this->filemanager->ensure_config_is_ready();
		}

		return array(
			'FILEMANAGER'		=> $enabled,
			'FILEMANAGER_AKEY'	=> $this->filemanager->get_access_key(),
		);
	}
}
