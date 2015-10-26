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

	public function display($edit_mode, array $route_info, $style_id, $display_mode)
	{
		$ex_positions = $route_info['ex_positions'];
		$users_groups = $this->get_users_groups();

		$positions = $this->get_blocks_for_route($route_info, $style_id, $edit_mode);

		$blocks_per_position = array();

		foreach ($positions as $position => $blocks)
		{
			$pos_count_key = 's_' . $position . '_count';
			$blocks_per_position[$pos_count_key] = 0;

			if ($edit_mode === false && isset($ex_positions[$position]))
			{
				continue;
			}

			foreach ($blocks as $entity)
			{
				$this->render($display_mode, $edit_mode, $entity->to_array(), $users_groups, $blocks_per_position[$pos_count_key]);
			}
		}

		$this->template->assign_var('S_HAS_BLOCKS', sizeof($positions));
		$this->template->assign_vars(array_change_key_case($blocks_per_position, CASE_UPPER));
	}

	public function get_route_info($current_route, $style_id, $edit_mode = false)
	{
		if ($edit_mode || ($route_info = $this->cache->get('sitemaker_block_routes')) === false)
		{
			$route_mapper = $this->mapper_factory->create('blocks', 'routes');
			$collection = $route_mapper->find();

			$route_info = array();
			foreach ($collection as $entity)
			{
				$route = $entity->get_route();
				$style = $entity->get_style();
				$route_info[$style][$route] = $entity->to_array();
			}

			$this->cache->put('sitemaker_block_routes', $route_info);
		}

		$default_info = array(
			'route_id'		=> 0,
			'route'			=> $current_route,
			'style'			=> $style_id,
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
			'has_blocks'	=> false,
		);

		$default_route = $this->config['sitemaker_default_layout'];
		return (isset($route_info[$style_id][$current_route])) ? $route_info[$style_id][$current_route] : (($edit_mode === false && $default_route && isset($route_info[$style_id][$default_route])) ? $route_info[$style_id][$default_route] : $default_info);
	}

	public function get_blocks_for_route(array $route_info, $style_id, $edit_mode)
	{
		$blocks = $this->_get_all_blocks($edit_mode);

		$route_id = $route_info['route_id'];
		if ($edit_mode === false && !$route_info['has_blocks'])
		{
			$default_route = $this->get_route_info($this->config['sitemaker_default_layout'], $style_id, $edit_mode);
			$route_id = $default_route['route_id'];
		}

		return (isset($blocks[$style_id][$route_id]) && !$route_info['hide_blocks']) ? $blocks[$style_id][$route_id] : array();
	}

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

	public function clear_cache()
	{
		$this->cache->destroy('sitemaker_blocks');
		$this->cache->destroy('sitemaker_block_routes');
	}

	public function render($display_mode, $edit_mode, array $data, array $users_groups, &$position_counter)
	{
		$type = $data['type'];
		$position = $data['position'];
		$service_name = $data['name'];

		if ($display_mode[$type] && ($edit_mode || empty($data['permission']) || sizeof(array_intersect($data['permission'], $users_groups))) && ($block_instance = $this->block_factory->get_block($service_name)) !== null)
		{
			$block = $block_instance->display($data, $edit_mode);

			if (!($content = $this->_get_block_content($block['content'], $edit_mode)))
			{
				return;
			}

			$tpl_data = array_merge($data, array(
				'TITLE'		=> ($data['title']) ? $data['title'] : $this->user->lang($block['title']),
				'CONTENT'	=> $content,
			));

			$this->template->assign_block_vars($position, array_change_key_case($tpl_data, CASE_UPPER));
			$position_counter++;
		}
	}

	protected function _get_block_content($content, $edit_mode)
	{
		if (empty($content) && $edit_mode)
		{
			$content = $this->user->lang('BLOCK_NO_DATA');
		}

		return $content;
	}

	protected function _get_all_blocks($edit_mode)
	{
		if (($blocks = $this->cache->get('sitemaker_blocks')) === false || $edit_mode)
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

			if (!$edit_mode)
			{
				$this->cache->put('sitemaker_blocks', $blocks);
			}
		}

		return $blocks;
	}

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
}
