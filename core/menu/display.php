<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\menu;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Manage nested sets
 * @package phpBB Primetime Categories
 */
class display extends \primetime\primetime\core\tree\display
{
	/**
	 * Construct
	 * 
	 * @param \phpbb\db\driver\driver				$db             Database connection
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 * @param string								$table_name		Table name
	 * @param string								$pk				Primary key
	 */
	public function __construct(\phpbb\db\driver\driver $db, \primetime\primetime\core\primetime $primetime, $table, $pk)
	{
		parent::__construct($db, $primetime, $table, $pk);
	}

	public function set_params($data)
	{
		$this->expanded = (bool) $data['expanded'];
		$this->max_depth = (int) $data['max_depth'];
	}

	/**
	 * 
	 */
	public function display_list($data, &$template, $handle = 'tree')
	{
		global $user;

		$curr_page = $user->page['page_name'];
		$curr_parts = explode('&', $user->page['query_string']);

		$prev_depth = 0;
		$parental_depth = array(0 => -1);
		$active_left_id = 0;
		$active_right_id = 0;
		$active_depth = 0;

		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row = $data[$i];
			if ($curr_page == $row['url_path'] && (!sizeof($row['url_query']) || sizeof(array_intersect($row['url_query'], $curr_parts))))
			{
				$active_depth = $row['depth'];
				$active_left_id = $row['left_id'];
				$active_right_id = $row['right_id'];
				$this->max_depth += ($this->count_descendants($row)) ? 0 : 1;
				break;
			}
		}

		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row 		= $data[$i];
			$is_active	= ($curr_page == $row['url_path'] && (!sizeof($row['url_query']) || sizeof(array_intersect($row['url_query'], $curr_parts)))) ? true : false;

			if (!isset($parental_depth[$row['parent_id']]))
			{
				continue;
			}

			$this_depth	= $parental_depth[$row['parent_id']] + 1;
			$repeat		= abs($prev_depth - $this_depth);

			if ($is_active === true || $this->expanded === true || ($row['left_id'] < $active_left_id && $row['right_id'] > $active_right_id))
			{
				$parental_depth[$row[$this->pk]] = $this_depth;
			}

			if (($active_depth - $row['depth'] + 2) > $this->max_depth)
			{
				continue;
			}

			$tpl_data	= array(
				'S_PREV_DEPTH'	=> $prev_depth,
				'S_THIS_DEPTH'	=> $this_depth,
				'S_NUM_KIDS'	=> $this->count_descendants($row),
				'S_ACTIVE'		=> $is_active,
			);

			$template->assign_block_vars($handle, array_merge($tpl_data, array_change_key_case($row, CASE_UPPER)));

			for ($j = 0; $j < $repeat; $j++)
			{
				$template->assign_block_vars($handle . '.close', array());
			}

			$prev_depth = $this_depth;
		}

		for ($i = 0; $i < $prev_depth; $i++)
		{
			$template->assign_block_vars('close_' . $handle, array());
		}
	}
}
