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
	private $expanded = false;

	/** @var integer */
	private $max_depth = 0;

	/** @var array */
	private $parental_depth;

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

	public function set_params(array $params)
	{
		$this->expanded = (bool) $params['expanded'];
		$this->max_depth = (int) $params['max_depth'];
	}

	/**
	 *
	 */
	public function display_list(array $data, \phpbb\template\twig\twig &$template, $handle = 'tree')
	{
		$data = array_values($data);

		$current_page = $this->user->page['page_name'];
		$current_data = $this->get_current_item($data, $current_page);

		$prev_depth = 0;
		$this->parental_depth = array(0 => -1);

		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row = $data[$i];

			if (!isset($this->parental_depth[$row['parent_id']]))
			{
				continue;
			}

			$is_current_item = $this->is_current_item($row, $current_data['item_id']);
			$this_depth	= $this->parental_depth[$row['parent_id']] + 1;

			$this->set_parental_depth($row, $this_depth, $current_data, $is_current_item);

			if ($this->max_depth && ($current_data['depth'] - $row['depth']) > $this->max_depth)
			{
				continue;
			}

			$tpl_data	= array(
				'S_PREV_DEPTH'	=> $prev_depth,
				'S_THIS_DEPTH'	=> $this_depth,
				'S_NUM_KIDS'	=> $this->count_descendants($row),
				'S_CURRENT'		=> $is_current_item,
			);

			$row['full_url'] = append_sid($row['full_url']);
			$template->assign_block_vars($handle, array_merge($tpl_data, array_change_key_case($row, CASE_UPPER)));

			$this->close_open_tags($template, $handle . '.close', abs($prev_depth - $this_depth));
			$prev_depth = $this_depth;
		}

		$this->close_open_tags($template, 'close_' . $handle, $prev_depth);
	}

	protected function get_current_item($data, $curr_page)
	{
		$curr_parts = explode('&', $this->user->page['query_string']);

		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row = $data[$i];

			if ($curr_page == $row['url_path'] && (!sizeof($row['url_query']) || sizeof(array_intersect($row['url_query'], $curr_parts))))
			{
				$this->max_depth += ($this->count_descendants($row)) ? 1 : 0;

				return $row;
			}
		}

		return array(
			'item_id'	=> 0,
			'left_id'	=> 0,
			'right_id'	=> 0,
			'depth'		=> 0,
		);
	}

	protected function is_current_item($row, $current_item_id)
	{
		return ($row['item_id'] === $current_item_id) ? true : false;
	}

	protected function set_parental_depth($row, $depth, $current_data, $is_current_item)
	{
		if ($is_current_item || $this->expanded || !$row['item_url'] || ($row['left_id'] < $current_data['left_id'] && $row['right_id'] > $current_data['right_id']))
		{
			$this->parental_depth[$row[$this->pk]] = $depth;
		}
	}

	protected function close_open_tags(\phpbb\template\twig\twig &$template, $handle, $repeat)
	{
		for ($i = 0; $i < $repeat; $i++)
		{
			$template->assign_block_vars($handle, array());
		}
	}
}
