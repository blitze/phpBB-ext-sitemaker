<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus;

class display extends \blitze\sitemaker\services\tree\display
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var bool */
	private $expanded = false;

	/** @var integer */
	private $max_depth = 0;

	/** @var integer */
	private $min_depth = 0;

	/** @var array */
	private $parental_depth;

	/** @var array */
	private $current_item;

	/**
	 * Construct
	 *
	 * @param \phpbb\db\driver\driver_interface		$db             	Database connection
	 * @param \phpbb\template\template				$template			Template object
	 * @param \phpbb\user							$user				User Object
	 * @param string								$menu_items_table	Menu Items table
	 * @param string								$pk					Primary key
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\user $user, $menu_items_table, $pk)
	{
		parent::__construct($db, $menu_items_table, $pk);

		$this->template = $template;
		$this->user = $user;
	}

	/**
	 * @param array $params
	 * @return void
	 */
	public function set_params(array $params)
	{
		$this->expanded = (bool) $params['expanded'];
		$this->max_depth = (int) $params['max_depth'];
	}

	/**
	 * @param array $data
	 * @param \phpbb\template\twig\twig $template
	 * @param string $handle
	 * @return void
	 */
	public function display_navlist(array $data, \phpbb\template\twig\twig &$template, $handle = 'tree')
	{
		$this->prepare_items($data);

		if (sizeof($data))
		{
			$this_depth = 0;
			foreach ($data as $row)
			{
				$prev_depth = $row['prev_depth'];
				$this_depth = $row['this_depth'];
				$row['num_kids'] = $this->count_descendants($row);

				$template->assign_block_vars($handle, array_change_key_case($row, CASE_UPPER));
				$this->close_open_tags($template, $handle . '.close', abs($prev_depth - $this_depth));
			}

			$this->close_open_tags($template, 'close_' . $handle, ($this_depth - $this->min_depth));
		}
	}

	/**
	 * @param array $data
	 * @return void
	 */
	public function generate_breadcrumb(array $data)
	{
		$this->find_parents($data, $this->current_item['parent_id']);
	}

	/**
	 * @param array $data
	 * @return void
	 */
	protected function prepare_items(array &$data)
	{
		$this->set_current_item($data);

		$leaf = array();
		$prev_depth = $this->min_depth;
		$this->parental_depth = array(0 => -1);

		foreach ($data as $item_id => $row)
		{
			// Skip branch
			if (sizeof($leaf))
			{
				if ($row['left_id'] < $leaf['right_id'])
				{
					$this->adjust_right_id($leaf['item_id'], $data, $leaf);
					unset($data[$item_id]);
					continue;
				}
				$leaf = array();
			}

			$is_current_item = $this->is_current_item($row);
			$this_depth	= $this->parental_depth[$row['parent_id']] + 1;
			$leaf = $this->get_leaf_node($row, $is_current_item);

			$this->parental_depth[$row[$this->pk]] = $this_depth;

			if ($row['depth'] < $this->min_depth)
			{
				unset($data[$item_id]);
				continue;
			}

			$data[$item_id] = array_merge($data[$item_id], array(
				'prev_depth'	=> $prev_depth,
				'this_depth'	=> $this_depth,
				'is_current'	=> $is_current_item,
				'full_url'		=> $this->get_full_url($row),
			));

			$prev_depth = $this_depth;
		}
		unset($this->parental_depth, $data);
	}

	/**
	 * @param array $data
	 * @return bool
	 */
	protected function set_current_item(array $data)
	{
		$curr_page = $this->user->page['page_name'];
		$curr_parts = explode('&', $this->user->page['query_string']);

		$data = array_values($data);
		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row = $data[$i];
			if ($this->is_current_path($curr_page, $curr_parts, $row))
			{
				$this->adjust_depth($row);
				$this->current_item = $row;
				return true;
			}
		}

		$this->current_item = $this->default_current_item();
		return false;
	}

	/**
	 * return void
	 */
	protected function default_current_item()
	{
		$this->max_depth = ($this->expanded) ? $this->max_depth : 0;
		$this->min_depth = 0;

		return array(
			'item_id'	=> 0,
			'parent_id'	=> 0,
			'left_id'	=> 0,
			'right_id'	=> 0,
			'depth'		=> 0,
		);
	}

	/**
	 * @param string $curr_page
	 * @param array $curr_parts
	 * @param array $row
	 * @return bool
	 */
	protected function is_current_path($curr_page, array $curr_parts, array $row)
	{
		return ($curr_page === ltrim($row['url_path'], './') && (!sizeof($row['url_query']) || sizeof(array_intersect($row['url_query'], $curr_parts)))) ? true : false;
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_current_item(array $row)
	{
		return ($row['item_id'] === $this->current_item['item_id']) ? true : false;
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_child_of_current_item(array $row)
	{
		return ($row['left_id'] < $this->current_item['left_id'] && $row['right_id'] > $this->current_item['right_id']) ? true : false;
	}

	/**
	 * Does the branch end here?
	 *
	 * @param array $row
	 * @param bool $is_current_item
	 * @return array
	 */
	protected function get_leaf_node(array $row, $is_current_item)
	{
		return (($row['depth'] === $this->max_depth || !$this->is_child_of_current_item($row) && !$this->expanded) && !$is_current_item && $row['is_expandable']) ? $row : array();
	}

	/**
	 * @param \phpbb\template\twig\twig $template
	 * @param string $handle
	 * @param int $repeat
	 * @return void
	 */
	protected function close_open_tags(\phpbb\template\twig\twig &$template, $handle, $repeat)
	{
		for ($i = 0; $i < $repeat; $i++)
		{
			$template->assign_block_vars($handle, array());
		}
	}

	/**
	 * @param int $items_depth
	 * return bool
	 * @return bool
	 */
	protected function needs_adjustment($items_depth)
	{
		return ($items_depth >= $this->max_depth) ? true : false;
	}

	/**
	 * @param array $row
	 * @return void
	 */
	protected function adjust_depth(array $row)
	{
		$depth = (int) $row['depth'];
		if ($this->needs_adjustment($depth))
		{
			$adjustment = ($this->count_descendants($row)) ? 1 : 0;
			$this->min_depth = ($this->max_depth && $depth >= $this->max_depth) ? $depth - $this->max_depth + $adjustment : 0;
			$this->max_depth = $depth + $adjustment;
		}
	}

	/**
	 * @param int $item_id
	 * @param array $data
	 * @param array $leaf
	 * @return void
	 */
	protected function adjust_right_id($item_id, array &$data, array $leaf)
	{
		if (isset($data[$item_id]))
		{
			$data[$leaf['item_id']]['right_id'] -= 2;
		}
	}

	/**
	 * @param array $data
	 * @param int $parent_id
	 * @return void
	 */
	protected function find_parents(array $data, $parent_id)
	{
		if (isset($data[$parent_id]) && $data[$parent_id]['item_url'] !== 'index.php')
		{
			$row = $data[$parent_id];
			$this->template->alter_block_array('navlinks', array(
				'FORUM_NAME'	=> $row['item_title'],
				'U_VIEW_FORUM'	=> $row['full_url'],
			));

			$this->find_parents($data, $row['parent_id']);
		}
	}

	/**
	 * Append session id to local, non-directory paths
	 *
	 * @param array $row
	 * @return string
	 */
	protected function get_full_url(array $row)
	{
		$full_url = $row['full_url'];
		if ($row['is_navigable'])
		{
			$full_url = append_sid($row['full_url'], false, false);
		}

		return $full_url;
	}
}
