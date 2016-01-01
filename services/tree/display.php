<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\tree;

/**
* Display nested sets
*/
abstract class display
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var string */
	protected $items_table;

	/** @var string */
	protected $pk;

	/** @var string */
	protected $sql_where;

	/** @var array */
	protected $errors = array();

	/** @var array */
	protected $data = array();

	/**
	* Construct
	*
	* @param \phpbb\db\driver\driver_interface		$db             Database connection
	* @param string									$items_table	Table name
	* @param string									$pk				Primary key
	* @param string									$sql_where		Column restriction
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, $items_table, $pk, $sql_where = '')
	{
		$this->db = $db;
		$this->pk = $pk;
		$this->items_table = $items_table;
		$this->sql_where = $sql_where;
	}

	/**
	 * Is subject node an ancestor of the object node?
	 */
	public function is_in_path($object, $subject)
	{
		return ($subject['left_id'] < $object['left_id'] && $subject['right_id'] > $object['right_id']) ? true : false;
	}

	/**
	 * Count node descendants
	 */
	public function count_descendants($row)
	{
		return ($row['right_id'] - $row['left_id'] - 1) / 2;
	}

	/**
	 * Get node row
	 */
	public function get_node_info($node_id)
	{
		$sql = "SELECT *
			FROM $this->items_table
			WHERE $this->pk = " . (int) $node_id ;
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	/**
	 * Get Tree Query
	 *
	 * @param	integer	$start			Starting level
	 * @param	integer $level			Max depth
	 * @param	array	$sql_array		Array of elements to merge into query
	 * 										array(
	 * 											'SELECT'	=> array('p.*'),
	 * 											'WHERE'		=> array('p.post_id = 2'),
	 * 										)
	 * @return	string		The sql query
	 */
	public function qet_tree_sql($start = 0, $level = 0, $sql_array = array())
	{
		$sql_array = array_merge_recursive(
			array(
				'SELECT'	=> array('t.*'),
				'FROM'		=> array(
					$this->items_table => ' t'
				),
				'WHERE'		=> array(
					't.depth ' . (($level) ? " BETWEEN $start AND " . ($start + $level) : ' >= ' . $start),
					(($this->sql_where) ? 't.' . $this->sql_where : ''),
				),
				'ORDER_BY'	=> 't.left_id ASC',
			),
			$sql_array
		);

		$sql_array['SELECT'] = join(', ', array_filter($sql_array['SELECT']));
		$sql_array['WHERE'] = join(' AND ', array_filter($sql_array['WHERE']));

		return $this->db->sql_build_query('SELECT', $sql_array);
	}

	public function get_tree_array($start = 0, $level = 0, $sql_array = array())
	{
		$sql = $this->qet_tree_sql($start, $level, $sql_array);
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[$row[$this->pk]] = $row;
		}
		$this->db->sql_freeresult($result);

		return $data;
	}

	public function display_list(array $data, \phpbb\template\twig\twig &$template, $handle = 'tree')
	{
		$prev_depth = 0;
		$parental_depth = array(0 => -1);
		$data = array_values($data);

		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row 		= $data[$i];
			$this_depth	= $parental_depth[$row['parent_id']] + 1;
			$repeat		= abs($prev_depth - $this_depth);

			$tpl_data	= array(
				'PREV_DEPTH'	=> $prev_depth,
				'THIS_DEPTH'	=> $this_depth,
				'NUM_KIDS'		=> $this->count_descendants($row),
			);

			$template->assign_block_vars($handle, array_merge($tpl_data, array_change_key_case($row, CASE_UPPER)));

			for ($j = 0; $j < $repeat; $j++)
			{
				$template->assign_block_vars($handle . '.close', array());
			}

			$prev_depth = $this_depth;
			$parental_depth[$row[$this->pk]] = $this_depth;
		}

		for ($i = 0; $i < $prev_depth; $i++)
		{
			$template->assign_block_vars('close_' . $handle, array());
		}
	}

	/**
	 * Get tree as form options or data
	 *
	 * @param	array	$db_data	Raw tree data from database
	 * @param	string	$title_column	Database column name to use as label/title for each item
	 * @param	array	$selected_ids	Array of selected items
	 * @param	string	$return_mode	options | data
	 * @param	string	$pad_with		Character used to denote nesting
	 *
	 * @return	mixed	Returns array of padded titles or html string of options depending on $return_mode
	 */
	public function display_options($db_data, $title_column, $selected_ids = array(), $return_mode = 'options', $pad_with = '&nbsp;&nbsp;&nbsp;&nbsp;')
	{
		$right = 0;
		$padding = '';
		$return_options = '';
		$return_data = array();
		$padding_store = array('0' => '');

		$db_data = array_values($db_data);
		for ($i = 0, $size = sizeof($db_data); $i < $size; $i++)
		{
			$row = $db_data[$i];

			if ($row['left_id'] < $right)
			{
				$padding .= $pad_with;
				$padding_store[$row['parent_id']] = $padding;
			}
			else if ($row['left_id'] > $right + 1)
			{
				$padding = (isset($padding_store[$row['parent_id']])) ? $padding_store[$row['parent_id']] : '';
			}

			$right = $row['right_id'];
			$title = $padding . '&#x251c;&#x2500; ' . $row[$title_column];
			$selected = (in_array($row[$this->pk], $selected_ids)) ? ' selected="selected' : '';

			$return_options .= '<option value="' . $row[$this->pk] . '"' . $selected . '>' . $title . '</option>';
			$return_data[$row[$this->pk]] = $title;
		}

		return ($return_mode == 'options') ? $return_options : $return_data;
	}
}
