<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services\blocks;

use Symfony\Component\DependencyInjection\Container;

class manager
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\core\services\icon_picker */
	protected $icons;

	/** @var \primetime\core\services\util */
	protected $primetime;

	/** @var \primetime\core\services\block_template */
	protected $ptemplate;

	/** @var string */
	private $blocks_table;

	/** @var string */
	private $blocks_config_table;

	/** @var string */
	private $block_routes_table;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var array */
	private $return_data;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	private $def_icon;

	/** @var integer */
	private $style_id = 0;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param Container									$phpbb_container		Service container
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param \primetime\core\services\icon_picker		$icons					Primetime icon picker object
	 * @param \primetime\core\services\util				$primetime				Template object
	 * @param \primetime\core\services\template			$ptemplate				Primetime template object
	 * @param string									$blocks_table			Name of the blocks database table
	 * @param string									$blocks_config_table	Name of the blocks_config database table
	 * @param string									$block_routes_table		Name of the block_routes database table
	 * @param string									$root_path				phpBB root path
	 * @param string									$php_ext				phpEx
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, Container $phpbb_container, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, \primetime\core\services\icon_picker $icons, \primetime\core\services\util $primetime, \primetime\core\services\template $ptemplate, $blocks_table, $blocks_config_table, $block_routes_table, $root_path, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->icons = $icons;
		$this->primetime = $primetime;
		$this->ptemplate = $ptemplate;
		$this->blocks_table = $blocks_table;
		$this->block_routes_table = $block_routes_table;
		$this->blocks_config_table = $blocks_config_table;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->def_icon = '';
	}

	/**
	 * Handle the admin bar
	 */
	public function handle($route_info)
	{
		$this->user->add_lang_ext('primetime/core', 'block_manager');
		$this->add_block_admin_lang();

		$route = $route_info['route'];
		$style_id = $route_info['style'];

		$this->set_style($style_id);

		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
			'js'		=> array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				'//tinymce.cachefly.net/4.1/tinymce.min.js',
				$asset_path . 'ext/primetime/core/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				$asset_path . 'ext/primetime/core/components/twig.js/twig.min.js',
				100 =>  '@primetime_core/assets/blocks/manager.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				'@primetime_core/assets/blocks/manager.min.css',
			)
		));

		$board_url = generate_board_url();
		$app_url = $board_url . ((!$this->config['enable_mod_rewrite']) ? '/app.' . $this->php_ext : '');
		$ajax_url = $app_url . '/blocks/';
		$u_disp_mode = $board_url . '/' . ltrim(rtrim(build_url(array('edit_mode')), '?'), './../');

		$is_default_route = $u_default_route = false;
		if ($this->config['primetime_default_layout'])
		{
			$is_default_route = ($this->config['primetime_default_layout'] === $route) ? true : false;
			$u_default_route .= $board_url . '/' . $this->config['primetime_default_layout'];
			$u_default_route = reapply_sid($u_default_route);
		}

		$symfony_request = $this->phpbb_container->get('symfony_request');
		$controller = $symfony_request->attributes->get('_controller');

		if ($controller && $controller !== 'primetime.core.forum.controller:handle')
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
				'S_IS_STARTPAGE'	=> ($this->config['primetime_startpage_controller'] == $controller_service && $this->config['primetime_startpage_params'] == $controller_arguments) ? true : false,
				'UA_EXTENSION'		=> $namespace . '/' . $extension,
			));
		}

		$this->get_available_blocks();

		$this->template->assign_vars(array(
			'S_EDIT_MODE'		=> true,
			'S_ROUTE_OPS'		=> $this->get_route_options($route),
			'S_HIDE_BLOCKS'		=> $route_info['hide_blocks'],
			'S_POSITION_OPS'	=> $this->get_position_options($route_info['ex_positions']),
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
	 * Get all available primetime blocks
	 */
	public function get_available_blocks()
	{
		if (($blocks = $this->cache->get('primetime_available_blocks')) === false)
		{
			$factory = $this->phpbb_container->get('primetime.core.blocks.factory');

			$blocks = $factory->get_all_blocks();
			$this->cache->put('primetime_available_blocks', $blocks);
		}

		foreach ($blocks as $service => $name)
		{
			$lname = strtoupper(str_replace('.', '_', $name));
			$this->template->assign_block_vars('block', array(
				'NAME'		=> (isset($this->user->lang[$lname])) ? $this->user->lang[$lname] : $name,
				'SERVICE'	=> $service)
			);
		}
	}

	/**
	 * Get all routes with blocks
	 */
	public function get_all_routes()
	{
		if (($routes = $this->cache->get('primetime_block_routes')) === false)
		{
			$sql = 'SELECT *
				FROM ' . $this->block_routes_table . '
				WHERE style = ' . $this->style_id;
			$result = $this->db->sql_query($sql);

			$routes = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$routes[$row['style']][$row['route']] = $row;
			}
			$this->db->sql_freeresult($result);

			$this->cache->put('primetime_block_routes', $routes);
		}

		return $routes;
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
	 * Get route info, if it exists
	 */
	public function get_route_info($route, $style = 0, $create_route = true)
	{
		$routes = $this->get_all_routes();
		$style_id = ($style) ? $style : $this->style_id;

		return (isset($routes[$style_id][$route])) ? $routes[$style_id][$route] : (($create_route) ? $this->add_route($route, 'data') : array());
	}

	/**
	 * Get the id of the current route. If it does not exist, add the route and get the id
	 */
	public function get_route_id($route)
	{
		$routes = $this->get_all_routes();

		return (isset($routes[$this->style_id][$route])) ? $routes[$this->style_id][$route]['route_id'] : $this->add_route($route);
	}

	/**
	 * Add a new route
	 */
	public function add_route($route, $return = 'id')
	{
		$ext_name = $this->request->variable('ext', '');

		$sql_data = array(
			'ext_name'		=> $ext_name,
			'route'			=> $route,
			'style'			=> $this->style_id,
			'hide_blocks'	=> false,
			'has_blocks'	=> false,
			'ex_positions'	=> '',
		);
		$this->db->sql_query('INSERT INTO ' . $this->block_routes_table . ' ' . $this->db->sql_build_array('INSERT', $sql_data));
		$sql_data['route_id'] = $this->db->sql_nextid();

		$this->cache->destroy('primetime_block_routes');

		return ($return == 'id') ? $sql_data['route_id'] : $sql_data;
	}

	/**
	 * Set route preferences
	 */
	public function set_route_prefs($route, $data)
	{
		$route_id = $this->get_route_id($route);
		$blocks = $this->get_blocks($route, 'id');

		$default_prefs = array(
			'hide_blocks'	=> false,
			'ex_positions'	=> '',
		);

		if (sizeof($blocks) || $data != $default_prefs)
		{
			return $this->update_route($route_id, $data);
		}
		else
		{
			$this->delete_route($route_id);
			return array();
		}
	}

	/**
	 * Update route data
	 */
	public function update_route($route_id, $sql_data)
	{
		if (!$route_id)
		{
			return array();
		}

		$this->db->sql_query('UPDATE ' . $this->block_routes_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE route_id = ' . (int) $route_id);
		$this->cache->destroy('primetime_block_routes');
		$this->cache->destroy('primetime_blocks');

		return array_merge(
			$sql_data,
			array('message' => $this->user->lang['ROUTE_UPDATED'])
		);
	}

	/**
	 * Delete a route
	 */
	public function delete_route($route_id)
	{
		$this->db->sql_query('DELETE FROM ' . $this->block_routes_table . '
			WHERE route_id = ' . (int) $route_id . '
				AND style = ' . $this->style_id);

		$this->cache->destroy('primetime_block_routes');
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

	/**
	 * Add a primetime block
	 */
	public function add($service, $route)
	{
		if (!$this->block_exists($service))
		{
			return array();
		}

		$position = $this->request->variable('position', '');
		$weight = $this->request->variable('weight', 0);

		$b = $this->phpbb_container->get($service);
		$b->set_template($this->ptemplate);
		$bconfig = $b->get_config(array());

		$default_setting = array();
		foreach ($bconfig as $key => $settings)
		{
			if (!is_array($settings))
			{
				continue;
			}
			$default_setting[$key] =& $settings['default'];
		}

		$route_id = (int) $this->get_route_id($route);
		$block_data = array(
			'icon'			=> '',
			'title'			=> '',
			'name'			=> $service,
			'weight'		=> $weight,
			'position'		=> $position,
			'route_id'		=> $route_id,
			'style'			=> (int) $this->style_id,
			'hide_title'	=> false,
			'no_wrap'		=> false,
			'hash'			=> md5(join('', $default_setting)),
		);
		$this->db->sql_query('UPDATE ' . $this->blocks_table . " SET weight = weight + 1 WHERE weight >= $weight AND route_id = $route_id AND style = " . (int) $this->style_id);
		$this->db->sql_query('INSERT INTO ' . $this->blocks_table . ' ' . $this->db->sql_build_array('INSERT', $block_data));

		$block_data['bid'] = $this->db->sql_nextid();
		$block_data['settings'] = $default_setting;

		// update route info
		$this->update_route($route_id, array('has_blocks' => true));

		// get block info and display it
		return array_merge(
			array('id' => $block_data['bid']),
			$block_data,
			$this->display($b, $block_data)
		);
	}

	/**
	 * Update block data
	 */
	public function update($bid, $sql_data)
	{
		if (!$bid)
		{
			return array();
		}

		$this->db->sql_query('UPDATE ' . $this->blocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE bid = ' . (int) $bid);
		$this->cache->destroy('primetime_blocks');

		$bdata = $this->get_block_data($bid);
		$db_settings = $this->get_block_config($bid);

		if (!$this->block_exists($bdata['name']))
		{
			return array();
		}

		$b = $this->phpbb_container->get($bdata['name']);
		$df_settings = $b->get_config($db_settings);

		foreach ($df_settings as $key => $settings)
		{
			if (!is_array($settings))
			{
				continue;
			}

			$db_settings[$key] = (isset($db_settings[$key])) ? $db_settings[$key] : $settings['default'];

			$type = explode(':', $settings['type']);
			if ($db_settings[$key] && ($type[0] == 'checkbox' || $type[0] == 'multi_select'))
			{
				$db_settings[$key] = explode(',', $db_settings[$key]);
			}
			$bdata['settings'][$key] = $db_settings[$key];
		}

		return array_merge(
			$bdata,
			array(
				'id'		=> $bid,
				'message'	=> $this->user->lang['BLOCK_UPDATED'],
			),
			$this->display($b, $bdata)
		);
	}

	/**
	 * Get Edit Form
	 */
	public function edit($bid)
	{
		if (!function_exists('build_multi_select'))
		{
			include($this->root_path . 'ext/primetime/core/blocks.' . $this->php_ext);
		}

		if (!function_exists('build_cfg_template'))
		{
			include($this->root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		if (!$bid)
		{
			return array('errors' => $this->user->lang['BLOCK_NO_ID']);
		}

		$this->add_block_admin_lang();

		$bdata = $this->get_block_data($bid);
		$db_settings = $this->get_block_config($bid);

		$this->template->assign_vars(array()
		);

		if (!$this->block_exists($bdata['name']))
		{
			return array();
		}

		$b = $this->phpbb_container->get($bdata['name']);
		$b->set_template($this->ptemplate);
		$default_settings = $b->get_config($db_settings);

		// Output relevant settings
		$this->generate_config_fields($db_settings, $default_settings);

		$bdata['settings'] = $db_settings;
		$bdata['no_wrap'] = (bool) $bdata['no_wrap'];
		$bdata['hide_title'] = (bool) $bdata['hide_title'];

		$this->template->assign_vars(array(
			'S_ACTIVE'		=> $bdata['status'],
			'S_TYPE'		=> $bdata['type'],
			'S_NO_WRAP'		=> $bdata['no_wrap'],
			'S_HIDE_TITLE'	=> $bdata['hide_title'],
			'S_BLOCK_CLASS'	=> trim($bdata['class']),
			'S_GROUP_OPS'	=> $this->get_groups('options', $bdata['permission']))
		);

		$this->template->set_filenames(array(
			'block_settings' => 'block_settings.html',
		));

		return array_merge(
			$bdata,
			array(
				'icon'		=> ($bdata['icon']) ? $bdata['icon'] : $this->def_icon,
				'form'		=> $this->template->assign_display('block_settings'),
			),
			$this->display($b, $bdata)
		);
	}

	/**
	 * Save Edit Form
	 *
	 * @param	integer		$bid		Block id
	 * @param	string		$route		Routte
	 * @return	array		Return array of all updated blocks 
	 */
	public function save($bid, $route)
	{
		if (!function_exists('validate_config_vars'))
		{
			include($this->root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		$settings	= array();
		$bdata		= $this->get_block_data($bid);

		if (!$this->block_exists($bdata['name']))
		{
			return array();
		}

		$b = $this->phpbb_container->get($bdata['name']);
		$b->set_template($this->ptemplate);
		$df_settings = $b->get_config($settings);

		$class = $this->request->variable('class', '');
		$permission_ary = $this->request->variable('permission', array(0));
		$cfg_array = utf8_normalize_nfc($this->request->variable('config', array('' => ''), true));
		$multi_select = utf8_normalize_nfc($this->request->variable('config', array('' => array('' => ''))));
		$update_similar = $this->request->variable('similar', false);

		$multi_select = array_filter($multi_select);
		foreach ($multi_select as $key => $values)
		{
			$cfg_array[$key] = array_filter($values, 'strlen');
			$cfg_array[$key] = (sizeof($cfg_array[$key])) ? join(',', $cfg_array[$key]) : $df_settings[$key]['default'];
		}

		$this->add_block_admin_lang();

		$errors = array();
		validate_config_vars($df_settings, $cfg_array, $errors);

		if (sizeof($errors))
		{
			return array('errors' => join("\n", $errors));
		}

		$sql_data = array(
			'permission'	=> implode(',', $permission_ary),
			'class'			=> ($class) ? ' ' . $class : '',
			'hide_title'	=> $this->request->variable('hide_title', 0),
			'status'		=> $this->request->variable('status', 0),
			'type'			=> $this->request->variable('type', 0),
			'no_wrap'		=> $this->request->variable('no_wrap', 0),
			'hash'			=> '',
		);

		$updated_blocks = array();
		if (is_array($cfg_array) && sizeof($cfg_array))
		{
			$bdata['settings'] = $this->save_settings($bid, $cfg_array, $df_settings);

			$old_hash = $bdata['hash'];
			$new_hash = md5(join('', $bdata['settings']));

			// settings have changed and we want to update similar blocks
			if ($update_similar && $new_hash != $old_hash)
			{
				$similar_blocks = $this->update_similar_blocks($bid, $cfg_array, $bdata['settings'], $old_hash, $new_hash);

				// Get similar blocks for this route
				if (sizeof($similar_blocks))
				{
					$updated_blocks = array_intersect_key(
						$similar_blocks,
						$this->get_blocks($route, 'data', array(
							'b.style = ' . (int) $this->style_id,
							$this->db->sql_in_set('b.bid', array_keys($similar_blocks))
						))
					);
				}
			}

			$sql_data['hash'] = $new_hash;
		}

		$updated_blocks[$bid] = $this->update($bid, $sql_data);

		return $updated_blocks;
	}

	/**
	 * Save a single block setting
	 */
	public function config($id, $data)
	{
		$settings = $this->get_block_config($id);

		if (isset($settings[$data['bvar']]))
		{
			$this->db->sql_query('UPDATE ' . $this->blocks_config_table . ' SET ' . $this->db->sql_build_array('UPDATE', $data) . ' WHERE bid = ' . (int) $id);
		}
		else
		{
			$this->db->sql_query('INSERT INTO ' . $this->blocks_config_table . ' ' . $this->db->sql_build_array('INSERT', $data));
		}

		$this->cache->destroy('primetime_blocks');
	}

	/**
	 * Save all blocks in layout
	 */
	public function save_layout($route)
	{
		$blocks_ary = $sql_blocks_ary = array();

		$blocks = $this->request->variable('blocks', array(0 => array('' => '')));

		for ($i = 0, $size = sizeof($blocks); $i < $size; $i++)
		{
			$row = $blocks[$i];
			$row['style'] = $this->style_id;
			$blocks_ary[$row['bid']] = $row;
		}

		$current_blocks = $this->get_blocks($route);
		$route_info = $this->get_route_info($route);

		if (sizeof($blocks_ary))
		{
			$sql_blocks_ary = array_intersect_key($current_blocks, $blocks_ary);
			$sql_blocks_ary = array_replace_recursive($sql_blocks_ary, $blocks_ary);
		}

		// Delete all blocks for this route
		$this->delete_blocks(array_keys($current_blocks), false);

		// Remove block settings for deleted blocks
		$removed_blocks = array_keys(array_diff_key($current_blocks, $blocks_ary));
		$this->delete_block_config($removed_blocks);

		// add blocks
		if (sizeof($sql_blocks_ary))
		{
			$this->db->sql_multi_insert($this->blocks_table, array_values($sql_blocks_ary));
		}
		else if (empty($route_info['hide_blocks']) && empty($route_info['ex_positions']))
		{
			$this->delete_route($route_info['route_id']);
		}
		$this->cache->destroy('primetime_blocks');

		return array('message' => $this->user->lang['LAYOUT_SAVED']);
	}

	/**
	 * Copy blocks from one route to another
	 */
	public function copy_layout($route, $from_route, $from_style)
	{
		if (!$from_route)
		{
			return array('data' => $this->get_blocks($route));
		}

		$from_where = array(
			'b.style = ' . $from_style,
			"r.route = '" . $this->db->sql_escape($from_route) . "'",
		);

		// get current route and blocks info
		$route_info = $this->get_route_info($route);
		$old_blocks = $this->get_blocks($route, 'id');

		$route_id	= (int) $route_info['route_id'];
		$style_id	= (int) $route_info['style'];

		// get new blocks info
		$new_route_info = $this->get_route_info($from_route, $from_style, false);

		if (!sizeof($new_route_info))
		{
			return array(
				'data' 		=> array(),
				'config'	=> array(),
			);
		}

		$new_blocks = $this->get_blocks($from_route, 'data', $from_where);

		// copy route prefs
		$route_info['has_blocks'] = $new_route_info['has_blocks'];
		$route_info['hide_blocks'] = $new_route_info['hide_blocks'];
		$route_info['ex_positions'] = $new_route_info['ex_positions'];
		$this->update_route($route_info['route_id'], $route_info);

		// delete current blocks
		$this->delete_blocks($old_blocks);

		// get max block id
		$sql = 'SELECT bid FROM ' . $this->blocks_table . ' ORDER BY bid DESC';
		$result = $this->db->sql_query_limit($sql, 1);
		$bid = $this->db->sql_fetchfield('bid');
		$this->db->sql_freeresult($result);

		$db_settings = array();

		if (sizeof($new_blocks))
		{
			$new_blocks_config = $this->get_block_config(array_keys($new_blocks), true);

			$mapped_ids = array();
			$sql_new_config = array();
			$new_blocks = array_values($new_blocks);

			// copy blocks
			for ($i = 0, $size = sizeof($new_blocks); $i < $size; $i++)
			{
				$mapped_ids[$new_blocks[$i]['bid']] = ++$bid;
				$new_blocks[$i]['bid'] = $bid;
				$new_blocks[$i]['style'] = $style_id;
				$new_blocks[$i]['route_id'] = (int) $route_id;
			}

			$this->db->sql_multi_insert($this->blocks_table, $new_blocks);

			// copy blocks config
			if (sizeof($new_blocks_config))
			{
				for ($i = 0, $size = sizeof($new_blocks_config); $i < $size; $i++)
				{
					$row = $new_blocks_config[$i];
					$row['bid'] = (int) $mapped_ids[$row['bid']];
					$sql_new_config[] = $row;
					$db_settings[$row['bid']][$row['bvar']] = $row['bval'];
				}

				$this->db->sql_multi_insert($this->blocks_config_table, $sql_new_config);
			}
		}

		// Now let's select the new blocks and return data
		$data = array();
		for ($i = 0, $size = sizeof($new_blocks); $i < $size; $i++)
		{
			$row = $new_blocks[$i];
			$bid = $row['bid'];
			$db_settings[$bid] = (isset($db_settings[$bid])) ? $db_settings[$bid] : array();

			$b = $this->phpbb_container->get($row['name']);

			$df_settings = $b->get_config($db_settings[$bid]);

			foreach ($df_settings as $key => $settings)
			{
				if (!is_array($settings))
				{
					continue;
				}

				$db_settings[$bid][$key] = (isset($db_settings[$bid][$key])) ? $db_settings[$bid][$key] : $settings['default'];

				$type = explode(':', $settings['type']);
				if ($db_settings[$bid][$key] && ($type[0] == 'checkbox' || $type[0] == 'multi_select'))
				{
					$db_settings[$bid][$key] = explode(',', $db_settings[$bid][$key]);
				}
				$row['settings'][$key] = $db_settings[$bid][$key];
			}

			$data[$row['position']][] = array_merge(
				array(
					'id'			=> $row['bid'],
					'icon'			=> ($row['icon']) ? $row['icon'] : $this->def_icon,
					'class'			=> $row['class'],
					'status'		=> (bool) $row['status'],
					'no_wrap'		=> (bool) $row['no_wrap'],
					'hide_title'	=> (bool) $row['hide_title'],
				),
				$this->display($b, $row)
			);
		}

		$this->cache->destroy('primetime_blocks');

		return array(
			'data'		=> $data,
			'config'	=> $route_info,
		);
	}

	/**
	 * Get all blocks for specified route
	 */
	public function get_blocks($route, $return = 'data', $sql_where_array = array())
	{
		$def_sql_where = array(
			'b.style = ' . $this->style_id,
		);

		if ($route)
		{
			$def_sql_where[] = "r.route = '" . $this->db->sql_escape($route) . "'";
		}

		$sql_where = (sizeof($sql_where_array)) ? $sql_where_array : $def_sql_where;

		$sql_array = array(
			'SELECT'	=> 'b.*',

			'FROM'	  => array(
				$this->blocks_table			=> 'b',
				$this->block_routes_table	=> 'r',
			),

			'WHERE'	 => 'b.route_id = r.route_id' . ((sizeof($sql_where)) ? ' AND ' . join(' AND ', $sql_where) : ''),

			'ORDER_BY'  => 'b.style, b.position, b.weight ASC',
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$blocks = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$blocks[$row['bid']] = $row;
		}
		$this->db->sql_freeresult($result);

		return ($return == 'id') ? array_keys($blocks) : $blocks;
	}

	/**
	 * Delete all blocks provided by a particular extension
	 */
	public function delete_ext_blocks($ext_name)
	{
		$sql_array = array(
			'SELECT'	=> 'b.bid',

			'FROM'	  => array(
				$this->blocks_table			=> 'b',
				$this->block_routes_table	=> 'r',
			),

			'WHERE'	 => "b.route_id = r.route_id
				AND r.ext_name = '" . $this->db->sql_escape($ext_name) . "'",
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$blocks = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$blocks[] = $row['bid'];
		}
		$this->db->sql_freeresult($result);

		$this->delete_blocks($blocks);

		$this->db->sql_query('DELETE FROM ' . $this->block_routes_table . " WHERE ext_name = '" . $this->db->sql_escape($ext_name) . "'");
		$this->cache->destroy('primetime_block_routes');
	}

	/**
	 * Delete all blocks for a particular route
	 */
	public function delete_route_blocks($route)
	{
		$block_ids = $this->get_blocks($route, 'id');
		$this->delete_blocks($block_ids);

		// update route info
		$route_id = $this->get_route_id($route);
		$this->update_route($route_id, array('has_blocks' => false));
	}

	public function set_style($style_id)
	{
		$this->style_id = (int) $style_id;
	}

	/**
	 * Check if block exists
	 *
	 * @param	string	$service_name	Service name of block
	 * @return	bool
	 */
	private function block_exists($service_name)
	{
		if (!$this->phpbb_container->has($service_name))
		{
			$this->return_data['errors'] = $this->user->lang['BLOCK_NOT_FOUND'];
			return false;
		}

		return true;
	}

	/**
	 * Generate block configuration fields
	 */
	private function generate_config_fields(&$db_settings, $default_settings)
	{
		foreach ($default_settings as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$this->template->assign_block_vars('options', array(
					'S_LEGEND'	=> $config_key,
					'LEGEND'	=> (isset($this->user->lang[$vars])) ? $this->user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = $explain = '';
			if (!empty($vars['explain']))
			{
				$explain = $vars['explain'];

				if (isset($vars['lang_explain']))
				{
					$l_explain = (isset($this->user->lang[$vars['lang_explain']])) ? $this->user->lang[$vars['lang_explain']] : $vars['lang_explain'];
				}
				else
				{
					$l_explain = (isset($this->user->lang[$vars['lang'] . '_EXPLAIN'])) ? $this->user->lang[$vars['lang'] . '_EXPLAIN'] : '';
				}
			}

			if (!empty($vars['append']))
			{
				$vars['append'] = (isset($this->user->lang[$vars['append']])) ? $this->user->lang[$vars['append']] : $vars['append'];
			}

			$db_settings[$config_key] = (isset($db_settings[$config_key])) ? $db_settings[$config_key] : $vars['default'];

			if (in_array($type[0], array('checkbox', 'multi_select', 'select')))
			{
				// this looks bad but its the only way without modifying phpbb code
				// this is for select items that do not need to be translated
				$options = $vars['params'][0];
				$this->add_lang_vars($options);
			}

			switch ($type[0])
			{
				case 'select':
					$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : 'build_select';
				break;
				case 'checkbox':
				case 'multi_select':
					$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : (($type[0] == 'checkbox') ? 'build_checkbox' : 'build_multi_select');
					$vars['params'][] = $config_key;
					$type[0] = 'custom';

					if (!empty($db_settings[$config_key]))
					{
						$db_settings[$config_key] = explode(',', $db_settings[$config_key]);
					}
				break;
				case 'hidden':
					$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : 'build_hidden';
					$type[0] = 'custom';
				break;
			}

			$content = build_cfg_template($type, $config_key, $db_settings, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (!empty($vars['lang'])) ? ((isset($this->user->lang[$vars['lang']])) ? $this->user->lang[$vars['lang']] : $vars['lang']) : '',
				'S_EXPLAIN'		=> $explain,
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content)
			);
			unset($default_settings[$config_key]);
		}
	}

	/**
	 * Add blocks_admin language file
	 * 
	 * This is a modified copy of the add_mod_info in functions_module.php
	 */
	private function add_block_admin_lang()
	{
		$finder = $this->phpbb_container->get('ext.manager')->get_finder();

		// We grab the language files from the default, English and user's language.
		// So we can fall back to the other files like we do when using add_lang()
		$default_lang_files = $english_lang_files = array();

		// Search for board default language if it's not the user language
		if ($this->config['default_lang'] != $this->user->lang_name)
		{
			$default_lang_files = $finder
				->prefix('blocks_admin')
				->suffix(".$this->php_ext")
				->extension_directory('/language/' . basename($this->config['default_lang']))
				->core_path('language/' . basename($this->config['default_lang']) . '/')
				->find();
		}

		// Search for english, if its not the default or user language
		if ($this->config['default_lang'] != 'en' && $this->user->lang_name != 'en')
		{
			$english_lang_files = $finder
				->prefix('blocks_admin')
				->suffix(".$this->php_ext")
				->extension_directory('/language/en')
				->core_path('language/en/')
				->find();
		}

		// Find files in the user's language
		$user_lang_files = $finder
			->prefix('blocks_admin')
			->suffix(".$this->php_ext")
			->extension_directory('/language/' . $this->user->lang_name)
			->core_path('language/' . $this->user->lang_name . '/')
			->find();

		$lang_files = array_unique(array_merge($user_lang_files, $english_lang_files, $default_lang_files));
		foreach ($lang_files as $lang_file => $ext_name)
		{
			$this->user->add_lang_ext($ext_name, $lang_file);
		}
	}

	private function add_lang_vars($options)
	{
		foreach ($options as $key => $title)
		{
			if (is_array($title))
			{
				$this->add_lang_vars($title);
			}
			else if (!isset($this->user->lang[$title]))
			{
				$this->user->lang[$title] = $title;
			}
		}
	}

	private function get_block_data($bid)
	{
		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_table . ' WHERE bid = ' . (int) $bid);

		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	private function get_block_config($bid, $raw = false)
	{
		$ids = (is_array($bid)) ? $bid : array($bid);

		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', $ids));

		$bconfig = $data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[] = $row;
			$bconfig[$row['bid']][$row['bvar']] = $row['bval'];
		}
		$this->db->sql_freeresult($result);

		return ($raw === false) ? ((!is_array($bid) && sizeof($bconfig)) ? array_shift($bconfig) : $bconfig) : $data;
	}

	private function delete_block_config($bid)
	{
		$bid = (is_array($bid)) ? $bid : array($bid);

		if (!sizeof($bid))
		{
			return;
		}

		$this->db->sql_query('DELETE FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', $bid));
	}

	private function delete_blocks($block_ids, $delete_config = true)
	{
		if (!is_array($block_ids))
		{
			$block_ids = array($block_ids);
		}

		$block_ids = array_filter($block_ids);
		if (!sizeof($block_ids))
		{
			return;
		}

		$sql = 'DELETE FROM ' . $this->blocks_table . ' WHERE ' . $this->db->sql_in_set('bid', $block_ids);
		$this->db->sql_query($sql);

		if ($delete_config === true)
		{
			$this->delete_block_config($block_ids);
		}

		$this->cache->destroy('primetime_blocks');
	}

	private function display($block, $settings)
	{
		$block->set_template($this->ptemplate);
		$data = $block->display($settings, true);

		return array(
			'title'		=> (!empty($settings['title'])) ? $settings['title'] : ((isset($this->user->lang[$data['title']])) ? $this->user->lang[$data['title']] : $data['title']),
			'content'	=> (!empty($data['content'])) ? $data['content'] : $this->user->lang['BLOCK_NO_DATA']
		);
	}

	private function get_groups($mode = 'data', $selected = '')
	{
		if (!is_array($selected))
		{
			$selected = explode(',', $selected);
		}

		$sql = 'SELECT group_id, group_name, group_type
			FROM ' . GROUPS_TABLE;
		$result = $this->db->sql_query($sql);

		$data = array();
		$selected = array_filter($selected);
		$options = '<option value="0"' . ((!sizeof($selected)) ? ' selected="selected"' : '') . '>' . $this->user->lang['ALL'] . '</option>';

		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected_option = (in_array($row['group_id'], $selected)) ? ' selected="selected"' : '';
			$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang['G_' . $row['group_name']] : ucfirst($row['group_name']);

			$data[$row['group_id']] = $group_name;
			$options .= '<option' . (($row['group_type'] == GROUP_SPECIAL) ? ' class="sep"' : '') . ' value="' . $row['group_id'] . '"' . $selected_option . '>' . $group_name . '</option>';
		}
		$this->db->sql_freeresult($result);

		return ($mode == 'data') ? $data : $options;
	}

	private function update_similar_blocks($block_id, $cfg_array, $settings, $old_hash, $new_hash)
	{
		// grab all blocks with same settings
		$similar_blocks = $this->get_blocks('', 'data', array(
			'b.bid <> ' . (int) $block_id,
			"b.hash = '" . $this->db->sql_escape($old_hash) . "'",
		));

		if (!sizeof($similar_blocks))
		{
			return array();
		}

		$blocks = array();
		foreach ($similar_blocks as $bid => $block)
		{
			if ($this->block_exists($block['name']))
			{
				$this->save_settings($bid, $cfg_array, $settings);
				$blocks[$bid] = $this->update($bid, array(
					'hash'	=> $new_hash
				));
			}
		}

		return $blocks;
	}

	private function save_settings($bid, $cfg_array, $df_settings)
	{
		$sql_ary = $settings = array();
		foreach ($cfg_array as $var => $val)
		{
			$sql_ary[] = array(
				'bid'		=> $bid,
				'bvar'		=> $var,
				'bval'		=> $val,
			);

			settype($val, gettype($df_settings[$var]['default']));
			$settings[$var] = $val;
		}

		// just remove old values and replace
		$this->delete_block_config($bid);
		$this->db->sql_multi_insert($this->blocks_config_table, $sql_ary);

		/**
		 * This is used by blocks that cache their own data.
		 *
		 * Set hidden field in block config called 'cache_name' with the name of the cache
		 * The cache will be cleared everytime the block is settings are changed
		 */
		if (isset($df_settings['cache_name']))
		{
			$this->cache->destroy($df_settings['cache_name']);
		}

		return $settings;
	}
}
