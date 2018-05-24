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

	/**
	 * Column names in the table
	 * @var string
	 */
	protected $column_item_id = 'item_id';
	protected $column_left_id = 'left_id';
	protected $column_right_id = 'right_id';
	protected $column_parent_id = 'parent_id';
	protected $column_depth = 'depth';

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
	 *
	 * @param array $object
	 * @param array $subject
	 * @return bool
	 */
	public function is_ancestor(array $object, array $subject)
	{
		return ($subject[$this->column_left_id] < $object[$this->column_left_id] && $subject[$this->column_right_id] > $object[$this->column_right_id]) ? true : false;
	}

	/**
	 * Count node descendants
	 * @param array $row
	 * @return int
	 */
	public function count_descendants(array $row)
	{
		return (int) (($row[$this->column_right_id] - $row[$this->column_left_id] - 1) / 2);
	}

	/**
	 * Get node row
	 * @param int $node_id
	 * @return mixed
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
	 * @param	integer	$start			Starting depth
	 * @param	integer $max_depth		Max depth
	 * @param	array	$sql_array		Array of elements to merge into query
	 * 										array(
	 * 											'SELECT'	=> array('p.*'),
	 * 											'WHERE'		=> array('p.post_id = 2'),
	 * 										)
	 * @return	array
	 */
	public function qet_tree_sql($start = 0, $max_depth = 0, $sql_array = array())
	{
		$sql_array = array_merge_recursive(
			array(
				'SELECT'	=> array('i.*'),
				'FROM'		=> array(
					$this->items_table => 'i'
				),
				'WHERE'		=> array(
					'i.depth ' . (($max_depth) ? ' BETWEEN ' . (int) $start . ' AND ' . (int) ($start + $max_depth) : ' >= ' . (int) $start),
					$this->sql_where,
				),
				'ORDER_BY'	=> 'i.left_id ASC',
			),
			$sql_array
		);

		$sql_array['SELECT'] = join(', ', array_filter((array) $sql_array['SELECT']));
		$sql_array['WHERE'] = join(' AND ', array_filter((array) $sql_array['WHERE']));

		return $sql_array;
	}

	/**
	 * Get the tree data
	 *
	 * @param	integer	$start			Starting depth
	 * @param	integer $max_depth		Max depth
	 * @param	array	$sql_array		Array of elements to merge into query
	 * 										array(
	 * 											'SELECT'	=> array('p.*'),
	 * 											'WHERE'		=> array('p.post_id = 2'),
	 * 										)
	 * @return array
	 */
	public function get_tree_data($start = 0, $max_depth = 0, $sql_array = array())
	{
		$sql_array = $this->qet_tree_sql($start, $max_depth, $sql_array);
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[$row[$this->pk]] = $row;
		}
		$this->db->sql_freeresult($result);

		return $data;
	}

	/**
	 * @param array $data
	 * @param \phpbb\template\twig\twig $template
	 * @param string $handle
	 */
	public function display_list(array $data, \phpbb\template\twig\twig &$template, $handle = 'tree')
	{
		$prev_depth = 0;
		$parental_depth = array(0 => -1);
		$data = array_values($data);

		for ($i = 0, $size = sizeof($data); $i < $size; $i++)
		{
			$row 		= $data[$i];
			$this_depth	= $parental_depth[$row[$this->column_parent_id]] + 1;
			$repeat		= (int) abs($prev_depth - $this_depth);

			$tpl_data	= array(
				'PREV_DEPTH'	=> $prev_depth,
				'THIS_DEPTH'	=> $this_depth,
				'NUM_KIDS'		=> $this->count_descendants($row),
			);

			$template->assign_block_vars($handle, array_merge($tpl_data, array_change_key_case($row, CASE_UPPER)));
			$this->recursively_close_tags($repeat, $handle . '.close', $template);

			$prev_depth = $this_depth;
			$parental_depth[$row[$this->pk]] = $this_depth;
		}
		$this->recursively_close_tags($prev_depth, 'close_' . $handle, $template);
	}

	/**
	 * @param int $repeat
	 * @param string $handle
	 * @param \phpbb\template\twig\twig $template
	 * @return void
	 */
	protected function recursively_close_tags($repeat, $handle, \phpbb\template\twig\twig $template)
	{
		for ($i = 0; $i < $repeat; $i++)
		{
			$template->assign_block_vars($handle, array());
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
	public function display_options($db_data, $title_column, $selected_ids = array(), $return_mode = 'options', $pad_with = '&nbsp;&nbsp;&nbsp;')
	{
		$right = 0;
		$padding = '';
		$padding_store = array('0' => '');
		$return = array('options' => '', 'data' => array());

		$db_data = array_values($db_data);
		for ($i = 0, $size = sizeof($db_data); $i < $size; $i++)
		{
			$row = $db_data[$i];

			$this->set_padding($padding, $pad_with, $row, $padding_store, $right);

			$right = $row[$this->column_right_id];
			$title = $this->get_padded_title($padding, $row[$title_column]);
			$return['options'] .= $this->get_html_option($row, $selected_ids, $title);
			$return['data'][$row[$this->pk]] = $title;
		}

		return $return[$return_mode];
	}

	/**
	 * @param string $padding
	 * @param string $pad_with
	 * @param array $row
	 * @param array $padding_store
	 * @param int $right
	 * @retur void
	 */
	protected function set_padding(&$padding, $pad_with, array $row, array $padding_store, $right)
	{
		if ($row[$this->column_left_id] < $right)
		{
			$padding .= $pad_with;
			$padding_store[$row[$this->column_parent_id]] = $padding;
		}
		else if ($row[$this->column_left_id] > $right + 1)
		{
			$padding = (isset($padding_store[$row[$this->column_parent_id]])) ? $padding_store[$row[$this->column_parent_id]] : '';
		}
	}

	/**
	 * @param string $padding
	 * @param string $title
	 * @return string
	 */
	protected function get_padded_title($padding, $title)
	{
		return (($padding) ? $padding . '&#x2937; ' : '') . $title;
	}

	/**
	 * @param array $row
	 * @param array $selected_ids
	 * @param string $title
	 * @return string
	 */
	protected function get_html_option(array $row, array $selected_ids, $title)
	{
		$selected = (in_array($row[$this->pk], $selected_ids)) ? ' selected="selected' : '';
		return '<option value="' . $row[$this->pk] . '"' . $selected . '>' . $title . '</option>';
	}
}
