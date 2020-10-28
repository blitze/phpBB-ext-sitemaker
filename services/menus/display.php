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
	/** @var \phpbb\user */
	protected $user;

	/** @var bool */
	private $expanded = true;

	/** @var integer */
	private $max_depth = 100;

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
	 * @param \phpbb\user							$user				User Object
	 * @param string								$menu_items_table	Menu Items table
	 * @param string								$pk					Primary key
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\user $user, $menu_items_table, $pk)
	{
		parent::__construct($db, $menu_items_table, $pk);

		$this->user = $user;
	}

	/**
	 * @param array $params
	 * @return void
	 */
	public function set_params(array $params)
	{
		$this->expanded = (bool) ((isset($params['expanded'])) ? $params['expanded'] : true);
		$this->max_depth = (int) ((isset($params['max_depth'])) ? $params['max_depth'] : 100);
	}

	/**
	 * @param array $data
	 * @return []
	 */
	public function display_navlist(array $data)
	{
		$this->set_current_item($data);
		$this->prepare_items($data['items']);

		if (sizeof($data['items']))
		{
			$this_depth = 0;

			$nodes = [];
			foreach ($data['items'] as $row)
			{
				$prev_depth = $row['prev_depth'];
				$this_depth = $row['this_depth'];
				$row['num_kids'] = $this->count_descendants($row);

				$nodes[] = array_merge(array_change_key_case($row, CASE_UPPER),
					array('close' => array_fill(0, abs($prev_depth - $this_depth), ''))
				);
			}

			return array(
				'tree'	=> $nodes,
				'close'	=> array_fill(0, abs($this_depth - $this->min_depth), '')
			);
		}

		return [];
	}

	/**
	 * @param array $data
	 * @return bool
	 */
	protected function set_current_item(array $data)
	{
		$paths = (array) $data['paths'];
		$this->min_depth = 0;

		arsort($paths);

		$curr_path = $this->get_current_path();
		foreach ($paths as $item_id => $test_url)
		{
			if (strpos($curr_path, $test_url) !== false)
			{
				$row = $data['items'][$item_id];
				$this->adjust_depth($row);
				$this->current_item = $row;

				return true;
			}
		}

		$this->current_item = $this->default_current_item();
		return false;
	}

	/**
	 * @return string
	 */
	protected function get_current_path()
	{
		$curr_page = '/' . ltrim($this->user->page['page_dir'] . '/' . $this->user->page['page_name'], './');
		$curr_parts = explode('&', $this->user->page['query_string']);

		sort($curr_parts);

		return $curr_page . '?' . join('&', $curr_parts);
	}

	/**
	 * return void
	 */
	protected function default_current_item()
	{
		$this->max_depth = ($this->expanded) ? $this->max_depth : 0;
		$this->min_depth = 0;

		return array(
			$this->column_item_id	=> 0,
			$this->column_parent_id	=> 0,
			$this->column_left_id	=> 0,
			$this->column_right_id	=> 0,
			$this->column_depth		=> 0,
		);
	}

	/**
	 * @param array $data
	 * @return void
	 */
	protected function prepare_items(array &$data)
	{
		$leaf = array();
		$prev_depth = $this->min_depth;
		$this->parental_depth = array(0 => -1);

		foreach ($data as $item_id => $row)
		{
			// Skip branch
			if ($this->should_skip_branch($row, $leaf))
			{
				$this->adjust_right_id($leaf[$this->column_item_id], $data, $leaf);
				unset($data[$item_id]);
				continue;
			}

			[$is_current_item, $is_parent] = $this->get_current_item($row);
			$this_depth	= $this->get_parental_depth($row) + 1;
			$leaf = $this->get_leaf_node($row, $is_current_item, $is_parent);

			$this->parental_depth[$row[$this->pk]] = $this_depth;

			if ($row[$this->column_depth] < $this->min_depth)
			{
				unset($data[$item_id]);
				continue;
			}

			$data[$item_id] = array_merge($data[$item_id], array(
				'prev_depth'	=> $prev_depth,
				'this_depth'	=> $this_depth,
				'is_current'	=> $is_current_item,
				'is_parent'		=> $is_parent,
				'full_url'		=> $this->get_full_url($row),
			));

			$prev_depth = $this_depth;
		}
		unset($this->parental_depth, $data);
	}

	/**
	 * @param array $row
	 * @return int
	 */
	protected function get_parental_depth(array $row)
	{
		$parent_id = $row[$this->column_parent_id];
		return isset($this->parental_depth[$parent_id]) ? $this->parental_depth[$parent_id] : -1;
	}

	/**
	 * @param array $row
	 * @param array $leaf
	 * @return bool
	 */
	protected function should_skip_branch(array $row, array $leaf)
	{
		return (sizeof($leaf) && $row[$this->column_left_id] < $leaf[$this->column_right_id]);
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function get_current_item(array $row)
	{
		$is_current_item = $is_parent = false;

		if ($this->current_item)
		{
			$is_current_item = $this->is_current_item($row);
			$is_parent = $this->is_parent_of_current_item($row);
		}

		return [$is_current_item, $is_parent];
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_current_item(array $row)
	{
		return ($row[$this->column_item_id] === $this->current_item[$this->column_item_id]) ? true : false;
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_parent_of_current_item(array $row)
	{
		return ($row[$this->column_left_id] < $this->current_item[$this->column_left_id] && $row[$this->column_right_id] > $this->current_item[$this->column_right_id]) ? true : false;
	}

	/**
	 * Does the branch end here?
	 *
	 * @param array $row
	 * @param bool $is_current_item
	 * @param bool $is_current_items_parent
	 * @return array
	 */
	protected function get_leaf_node(array $row, $is_current_item, $is_current_items_parent)
	{
		return ($this->must_not_expand($row, $is_current_items_parent) && !$is_current_item && $row['is_expandable']) ? $row : array();
	}

	/**
	 * @param array $row
	 * @param bool $is_current_items_parent
	 * @return bool
	 */
	protected function must_not_expand(array $row, $is_current_items_parent)
	{
		return ($row[$this->column_depth] === $this->max_depth || !$is_current_items_parent && !$this->expanded) ? true : false;
	}

	/**
	 * @param int $items_depth
	 * return bool
	 * @return bool
	 */
	protected function needs_adjustment($items_depth)
	{
		return (!$this->expanded && $items_depth >= $this->max_depth) ? true : false;
	}

	/**
	 * @param array $row
	 * @return void
	 */
	protected function adjust_depth(array $row)
	{
		$depth = (int) $row[$this->column_depth];
		if ($this->needs_adjustment($depth))
		{
			$adjustment = ($this->count_descendants($row)) ? 1 : 0;
			$this->set_depth_limits($depth, $adjustment);
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
			$data[$leaf[$this->column_item_id]][$this->column_right_id] -= 2;
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

	/**
	 * @param int $depth
	 * @param int $adjustment
	 */
	protected function set_depth_limits($depth, $adjustment)
	{
		$this->min_depth = ($this->max_depth && $depth >= $this->max_depth) ? $depth - $this->max_depth + $adjustment : 0;
		$this->max_depth = $depth + $adjustment;
	}
}
