<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class blocks extends routes
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\event\dispatcher_interface */
	protected $phpbb_dispatcher;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\services\groups */
	protected $groups;

	/** @var array */
	protected static $status_class = array(
		0	=> ' sm-inactive',
		1	=> '',
	);

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \phpbb\config\config							$config					Config object
	 * @param \phpbb\event\dispatcher_interface				$phpbb_dispatcher		Event dispatcher
	 * @param \phpbb\template\template						$template				Template object
	 * @param \phpbb\language\language						$translator				Language object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\services\groups				$groups					Groups Object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 * @param string										$php_ext				phpEx
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\event\dispatcher_interface $phpbb_dispatcher, \phpbb\template\template $template, \phpbb\language\language $translator, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\services\groups $groups, \blitze\sitemaker\model\mapper_factory $mapper_factory, $php_ext)
	{
		parent::__construct($cache, $config, $block_factory, $mapper_factory, $php_ext);

		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->template = $template;
		$this->translator = $translator;
		$this->block_factory = $block_factory;
		$this->groups = $groups;
	}

	/**
	 * Display blocks for current route
	 *
	 * @param bool $edit_mode
	 * @param array $route_info
	 * @param int $style_id
	 * @param array $display_modes
	 */
	public function display($edit_mode, array $route_info, $style_id, array $display_modes)
	{
		$ex_positions = array_flip($route_info['ex_positions']);
		$users_groups = $this->groups->get_users_groups();
		$route_blocks = $this->get_blocks_for_route($route_info, $style_id, $edit_mode);

		$positions = array();
		foreach ($route_blocks as $position => $blocks)
		{
			$positions[$position] = $this->show_position($position, $blocks, $ex_positions, $users_groups, $display_modes, $edit_mode);
		}

		$this->template->assign_vars(array(
			'positions'		=> $positions,
			'S_HAS_BLOCKS'	=> sizeof($positions),
		));

		/**
		 * Event to modify block positions.
		 *
		 * @event blitze.sitemaker.modify_block_positions
		 * @var	array	positions		Array of block positions
		 * @since 3.0.1-RC1
		 */
		$vars = array('positions');
		extract($this->phpbb_dispatcher->trigger_event('blitze.sitemaker.modify_block_positions', compact($vars)));
	}

	/**
	 * @param string $position
	 * @param array $blocks
	 * @param array $ex_positions
	 * @param array $users_groups
	 * @param array $display_modes
	 * @param bool $edit_mode
	 * @return array[]
	 */
	protected function show_position($position, array $blocks, array $ex_positions, array $users_groups, $display_modes, $edit_mode)
	{
		$pos_blocks = array();
		if (!$this->exclude_position($position, $ex_positions, $edit_mode))
		{
			foreach ($blocks as $index => $entity)
			{
				$pos_blocks[$index] = $this->render($display_modes, $edit_mode, $entity->to_array(), $users_groups, $index);
			}
		}

		return array_filter($pos_blocks);
	}

	/**
	 * Render block
	 *
	 * @param array $display_modes
	 * @param bool $edit_mode
	 * @param array $db_data
	 * @param array $users_groups
	 * @param int $index
	 * @return string[]
	 */
	public function render(array $display_modes, $edit_mode, array $db_data, array $users_groups, $index)
	{
		$service_name = $db_data['name'];

		$block = array();
		if ($this->block_is_viewable($db_data, $display_modes, $users_groups, $edit_mode) && ($block_instance = $this->block_factory->get_block($service_name)) !== null)
		{
			$returned_data =  array(
				'title'		=> '',
				'data'		=> null,
				'content'	=> null,
			);

			try
			{
				$returned_data = array_merge($returned_data, $block_instance->display($db_data, $edit_mode));
			}
			catch (\Exception $e)
			{
				$returned_data['content'] = $this->set_edit_mode_content($returned_data, $edit_mode, $e->getMessage());
			}

			// we get the template after running 'display()' above so template can be set dynamically
			$returned_data['template'] = $block_instance->get_template();

			if ($this->block_has_content($returned_data, $edit_mode))
			{
				$returned_data['title'] = $this->get_block_title($db_data['title'], $returned_data['title']);

				$block = array_merge($db_data, $returned_data);
				$block['class'] .= self::$status_class[$block['status']];
			}

			/**
			 * Event to modify a rendered block.
			 *
			 * @event blitze.sitemaker.modify_rendered_block
			 * @var	array														block			Array of block properties
			 * @var	int															index			Display order/index in position
			 * @var	\blitze\sitemaker\services\blocks\driver\block_interface	block_instance	The block instance
			 * @since 3.0.1-RC1
			 */
			$vars = array('block', 'index', 'block_instance');
			extract($this->phpbb_dispatcher->trigger_event('blitze.sitemaker.modify_rendered_block', compact($vars)));
		}

		return $block;
	}

	/**
	 * @param string $db_title
	 * @param string $df_title
	 * @return string
	 */
	protected function get_block_title($db_title, $df_title)
	{
		return ($db_title) ? $db_title : $this->translator->lang($df_title);
	}

	/**
	 * @param array $returned_data
	 * @param bool $edit_mode
	 * @return bool
	 */
	protected function block_has_content(array &$returned_data, $edit_mode)
	{
		if ($this->block_returns_nothing($returned_data))
		{
			return $this->set_edit_mode_content($returned_data, $edit_mode, 'BLOCK_NO_DATA');
		}
		else if ($this->block_is_missing_template($returned_data))
		{
			$returned_data['data'] = null;
			return $this->set_edit_mode_content($returned_data, $edit_mode, 'BLOCK_MISSING_TEMPLATE');
		}

		return true;
	}

	/**
	 * @param array $data
	 * @param bool $edit_mode
	 * @param string $lang_key
	 * @return bool
	 */
	protected function set_edit_mode_content(array &$data, $edit_mode, $lang_key)
	{
		if ($edit_mode)
		{
			$data['status'] = 0;
			$data['content'] = $this->translator->lang($lang_key);

			return true;
		}

		return false;
	}

	/**
	 * @param array $returned_data
	 * @return bool
	 */
	protected function block_returns_nothing(array $returned_data)
	{
		return !$returned_data['content'] && empty($returned_data['data']);
	}

	/**
	 * @param array $returned_data
	 * @return bool
	 */
	protected function block_is_missing_template(array $returned_data)
	{
		return is_array($returned_data['data']) && !$returned_data['template'];
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
	protected function block_is_viewable(array $data, array $display_modes, array $users_groups, $edit_mode)
	{
		$type = $data['type'];
		$allowed_groups = $data['permission'];

		return ($display_modes[$type] && ($edit_mode || $this->user_is_permitted($allowed_groups, $users_groups))) ? true : false;
	}

	/**
	 * @param mixed $allowed_groups
	 * @param array $users_groups
	 * @return bool
	 */
	protected function user_is_permitted($allowed_groups, array $users_groups)
	{
		return (empty($allowed_groups) || sizeof(array_intersect($allowed_groups, $users_groups))) ? true : false;
	}

	/**
	 * @param string $position
	 * @param array $ex_positions
	 * @param bool $edit_mode
	 * @return bool
	 */
	protected function exclude_position($position, array $ex_positions, $edit_mode)
	{
		return ($edit_mode === false && isset($ex_positions[$position])) ? true : false;
	}
}
