<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class blocks
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \phpbb\config\config							$config					Config object
	 * @param \phpbb\db\driver\driver_interface				$db						Database object
	 * @param \phpbb\template\template						$template				Template object
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\user $user, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
	}

	/**
	 * Display blocks for current route
	 *
	 * @param bool $edit_mode
	 * @param array $route_info
	 * @param int $style_id
	 * @param $display_modes
	 */
	public function display($edit_mode, array $route_info, $style_id, array $display_modes)
	{
		$ex_positions = $route_info['ex_positions'];
		$users_groups = $this->get_users_groups();

		$positions = $this->get_blocks_for_route($route_info, $style_id, $edit_mode);

		$blocks_per_position = array();

		foreach ($positions as $position => $blocks)
		{
			$pos_count_key = 's_' . $position . '_count';
			$blocks_per_position[$pos_count_key] = 0;

			if ($this->_exclude_position($position, $ex_positions, $edit_mode))
			{
				continue;
			}

			foreach ($blocks as $entity)
			{
				$this->render($display_modes, $edit_mode, $entity->to_array(), $users_groups, $blocks_per_position[$pos_count_key]);
			}
		}

		$this->template->assign_var('S_HAS_BLOCKS', sizeof($positions));
		$this->template->assign_vars(array_change_key_case($blocks_per_position, CASE_UPPER));
	}

	/**
	 * @param string $current_route
	 * @param int $style_id
	 * @param bool|false $edit_mode
	 * @return array
	 */
	public function get_route_info($current_route, $style_id, $edit_mode = false)
	{
		$all_routes = $this->_get_all_routes();

		if (isset($all_routes[$style_id][$current_route]))
		{
			return $all_routes[$style_id][$current_route];
		}
		else
		{
			return $this->_get_default_route_info($all_routes, $current_route, $style_id, $edit_mode);
		}
	}

	/**
	 * @param array $route_info
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	public function get_blocks_for_route(array $route_info, $style_id, $edit_mode)
	{
		$blocks = $this->_get_cached_blocks($edit_mode);
		$route_id = $this->_get_display_route_id($route_info, $style_id, $edit_mode);

		return (isset($blocks[$style_id][$route_id]) && !$route_info['hide_blocks']) ? $blocks[$style_id][$route_id] : array();
	}

	/**
	 * @return array
	 */
	public function get_users_groups()
	{
		$sql = 'SELECT group_id
			FROM ' . USER_GROUP_TABLE . '
			WHERE user_id = ' . (int) $this->user->data['user_id'];
		$result = $this->db->sql_query($sql);

		$groups = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$groups[$row['group_id']] = $row['group_id'];
		}
		$this->db->sql_freeresult($result);

		return $groups;
	}

	/**
	 * Clear blocks cache
	 */
	public function clear_cache()
	{
		$this->cache->destroy('sitemaker_blocks');
		$this->cache->destroy('sitemaker_block_routes');
	}

	/**
	 * Render block
	 *
	 * @param array $display_modes
	 * @param bool $edit_mode
	 * @param array $data
	 * @param array $users_groups
	 * @param int $position_counter
	 */
	public function render(array $display_modes, $edit_mode, array $data, array $users_groups, &$position_counter)
	{
		$position = $data['position'];
		$service_name = $data['name'];

		if ($this->_block_is_viewable($data, $display_modes, $users_groups, $edit_mode) && ($block_instance = $this->block_factory->get_block($service_name)) !== null)
		{
			$block = $block_instance->display($data, $edit_mode);

			if (!($content = $this->_get_block_content($block, $edit_mode)))
			{
				return;
			}

			$tpl_data = array_merge($data, array(
				'TITLE'		=> $this->_get_block_title($data['title'], $block['title']),
				'CONTENT'	=> $content,
			));

			$this->template->assign_block_vars($position, array_change_key_case($tpl_data, CASE_UPPER));
			$position_counter++;
		}
	}

	/**
	 * @param array $df_settings
	 * @param array $db_settings
	 * @return array
	 */
	public function sync_settings(array $df_settings, array $db_settings = array())
	{
		$settings = array();
		foreach ($df_settings as $field => $vars)
		{
			if (!is_array($vars))
			{
				continue;
			}
			$settings[$field] = $vars['default'];
		}

		return array_merge($settings, array_intersect_key($db_settings, $settings));
	}

	/**
	 * @param string $db_title
	 * @param string $df_title
	 * @return string
	 */
	protected function _get_block_title($db_title, $df_title)
	{
		return ($db_title) ? $db_title : $this->user->lang($df_title);
	}

	/**
	 * @param array $block
	 * @param bool $edit_mode
	 * @return string|null
	 */
	protected function _get_block_content(array $block, $edit_mode)
	{
		$content = '';
		if (!empty($block['content']))
		{
			$content = $block['content'];
		}
		else if ($edit_mode)
		{
			$content = $this->user->lang('BLOCK_NO_DATA');
		}

		return $content;
	}

	/**
	 * @param bool $edit_mode
	 * @return array
	 */
	protected function _get_cached_blocks($edit_mode)
	{
		if (($blocks = $this->cache->get('sitemaker_blocks')) === false || $edit_mode)
		{
			$blocks = $this->_get_all_blocks();
			$this->_cache_block($blocks, $edit_mode);
		}

		return $blocks;
	}

	/**
	 * @return array
	 */
	protected function _get_all_blocks()
	{
		$block_mapper = $this->mapper_factory->create('blocks', 'blocks');
		$collection = $block_mapper->find();

		$blocks = array();
		foreach ($collection as $entity)
		{
			if ($block_instance = $this->block_factory->get_block($entity->get_name()))
			{
				$default_settings = $block_instance->get_config(array());
				$settings = $this->sync_settings($default_settings, $entity->get_settings());

				$entity->set_settings($settings);

				$style = $entity->get_style();
				$route_id = $entity->get_route_id();
				$position = $entity->get_position();

				$blocks[$style][$route_id][$position][] = $entity;
			}
		}

		return $blocks;
	}

	/**
	 * @return array|mixed
	 */
	protected function _get_all_routes()
	{
		if (($all_routes = $this->cache->get('sitemaker_block_routes')) === false)
		{
			$route_mapper = $this->mapper_factory->create('blocks', 'routes');
			$collection = $route_mapper->find();

			$all_routes = array();
			foreach ($collection as $entity)
			{
				$route = $entity->get_route();
				$style = $entity->get_style();
				$all_routes[$style][$route] = $entity->to_array();
			}

			$this->cache->put('sitemaker_block_routes', $all_routes);
		}

		return $all_routes;
	}

	/**
	 * @param array $all_routes
	 * @param string $current_route
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	protected function _get_default_route_info(array $all_routes, $current_route, $style_id, $edit_mode)
	{
		$default_route = $this->config['sitemaker_default_layout'];
		$default_info = array(
			'route_id'		=> 0,
			'route'			=> $current_route,
			'style'			=> $style_id,
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
			'has_blocks'	=> false,
		);

		return ($edit_mode === false && isset($all_routes[$style_id][$default_route])) ? $all_routes[$style_id][$default_route] : $default_info;
	}

	/**
	 * @param array $route_info
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return int
	 */
	protected function _get_display_route_id(array $route_info, $style_id, $edit_mode)
	{
		$route_id = $route_info['route_id'];
		if ($edit_mode === false && !$route_info['has_blocks'])
		{
			$default_route = $this->get_route_info($this->config['sitemaker_default_layout'], $style_id, $edit_mode);
			$route_id = $default_route['route_id'];
		}

		return (int) $route_id;
	}

	/**
	 * @param array $blocks
	 * @param bool $edit_mode
	 */
	protected function _cache_block(array $blocks, $edit_mode)
	{
		if (!$edit_mode)
		{
			$this->cache->put('sitemaker_blocks', $blocks);
		}
	}

	/**
	 * Should we display this block?
	 *
	 * @param array $data
	 * @param array $display_modes
	 * @param array $users_groups
	 * @param bool $edit_mode
	 * @return bool
	 */
	protected function _block_is_viewable(array $data, array $display_modes, array $users_groups, $edit_mode)
	{
		$type = $data['type'];
		$allowed_groups = $data['permission'];

		return ($display_modes[$type] && ($edit_mode || $this->_user_is_permitted($allowed_groups, $users_groups))) ? true : false;
	}

	/**
	 * @param mixed $allowed_groups
	 * @param array $users_groups
	 * @return bool
	 */
	protected function _user_is_permitted($allowed_groups, array $users_groups)
	{
		return (empty($allowed_groups) || sizeof(array_intersect($allowed_groups, $users_groups))) ? true : false;
	}

	/**
	 * @param string $position
	 * @param array $ex_positions
	 * @param bool $edit_mode
	 * @return bool
	 */
	protected function _exclude_position($position, array $ex_positions, $edit_mode)
	{
		return ($edit_mode === false && isset($ex_positions[$position])) ? true : false;
	}
}
