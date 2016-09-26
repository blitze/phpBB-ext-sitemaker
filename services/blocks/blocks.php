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

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\services\groups */
	protected $groups;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \phpbb\config\config							$config					Config object
	 * @param \phpbb\template\template						$template				Template object
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\services\groups				$groups					Groups Object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 * @param string										$php_ext				phpEx
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\services\groups $groups, \blitze\sitemaker\model\mapper_factory $mapper_factory, $php_ext)
	{
		parent::__construct($cache, $config, $user, $block_factory, $mapper_factory, $php_ext);

		$this->template = $template;
		$this->user = $user;
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

		$positions = $this->get_blocks_for_route($route_info, $style_id, $edit_mode);

		$blocks_per_position = array();

		foreach ($positions as $position => $blocks)
		{
			$pos_count_key = "s_{$position}_count";
			$blocks_per_position[$pos_count_key] = 0;

			$this->show_position($position, $blocks, $ex_positions, $users_groups, $blocks_per_position[$pos_count_key], $display_modes, $edit_mode);
		}

		$this->template->assign_var('S_HAS_BLOCKS', sizeof($positions));
		$this->template->assign_vars(array_change_key_case($blocks_per_position, CASE_UPPER));
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

			if ($content = $this->_get_block_content($block, $edit_mode))
			{
				$tpl_data = array_merge($data, array(
					'TITLE'		=> $this->_get_block_title($data['title'], $block['title']),
					'CONTENT'	=> $content,
				));

				$this->template->assign_block_vars($position, array_change_key_case($tpl_data, CASE_UPPER));
				$position_counter++;
			}
		}
	}

	/**
	 * @param string $position
	 * @param array $blocks
	 * @param array $ex_positions
	 * @param array $users_groups
	 * @param int $position_counter
	 * @param array $display_modes
	 * @param bool $edit_mode
	 */
	protected function show_position($position, array $blocks, array $ex_positions, array $users_groups, &$position_counter, $display_modes, $edit_mode)
	{
		if (!$this->_exclude_position($position, $ex_positions, $edit_mode))
		{
			foreach ($blocks as $entity)
			{
				$this->render($display_modes, $edit_mode, $entity->to_array(), $users_groups, $position_counter);
			}
		}
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
