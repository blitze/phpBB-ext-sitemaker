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
* Manage nested sets
*/
abstract class builder extends \phpbb\tree\nestedset
{
	public static function load_scripts(\blitze\sitemaker\services\util $util)
	{
		$asset_path = $util->asset_path;
		$util->add_assets(array(
			'js'        => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				'http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js',
				$asset_path . 'ext/blitze/sitemaker/components/twig.js/twig.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jquery.populate/jquery.populate.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/nestedSortable/jquery.ui.nestedSortable.min.js',
				'@blitze_sitemaker/assets/tree/builder.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				'@blitze_sitemaker/assets/tree/builder.min.css',
			)
		));
	}

	/**
	* Set additional sql where restrictions
	*/
	public function set_sql_where($sql_where)
	{
		$this->sql_where = $sql_where;

		return $this;
	}

	/**
	 * Get item data
	 */
	public function get_item_info($item_id = 0)
	{
		$sql = 'SELECT * FROM ' . $this->table_name . ' ' . $this->get_sql_where('WHERE') .
			(($item_id) ? " AND {$this->column_item_id} = " . (int) $item_id : '');

		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	/**
	 * Update a single item
	 *
	 * @param	integer	$item_id		The ID of the item to update.
	 * @param	array	$sql_data		Other item attributes to insert in the database ex. array('title' => 'Item 1')
	 * @return	array
	 */
	public function update_item($item_id, $sql_data)
	{
		$sql = "UPDATE {$this->table_name}
			SET " . $this->db->sql_build_array('UPDATE', $sql_data) . "
			WHERE $this->column_item_id = " . (int) $item_id;
		$this->db->sql_query($sql);

		return $sql_data;
	}

	/**
	 * Update tree
	 *
	 * @param	array	$tree 	Array of parent-child items
	 * @return	null
	 */
	public function update_tree($tree)
	{
		$items_data = $this->get_all_tree_data();

		/**
		 * Remove any new nodes in the tree that did not exist before
		 * The intent of this method is to update an existing tree, not add new nodes
		 */
		$tree = array_intersect_key($tree, $items_data);

		// we do it this way because array_merge_recursive, would append numeric keys rather than overwrite them
		foreach ($tree as $key => $data)
		{
			$tree[$key] = array_merge($items_data[$key], $data);
		}

		$this->acquire_lock();
		$this->db->sql_transaction('begin');

		// Rather than updating each item individually, we will just delete all items
		// then add them all over again with new parent_id|left_id|right_id
		$this->db->sql_query("DELETE FROM {$this->table_name} " . $this->get_sql_where('WHERE'));

		// Now we add it back
		$sql_data = $this->add_sub_tree($tree, 0, true);

		$this->db->sql_transaction('commit');
		$this->lock->release();

		return $sql_data;
	}

	/**
	 * Takes a new line delimited string and returns an associative array of parent/child relationships
	 * that can be saved to a database or converted to a nested set model
	 *
	 * @param	string	$structure		The structure to build ex:
	 *										Home|index.php
	 *										News|index.php?p=news
	 *										Texas|index.php?p=news&cat=Texas
	 *										About Us|index.php?p=about
	 * @param	array	$table_fields	The expected information to get for each line (order is important) ex: array('title' => '', 'url' => '')
	 *									This will then assign 'Home' to 'title' and 'index.php' to 'url' in example above (line 1)
	 *
	 * @return	array					associative array of parent/child relationships ex: the above examples will produce
	 *										array(
	 *											1   => array('title' => 'Home', 'url' => 'index.php', parent_id => 0),
	 *											2   => array('title' => 'News', 'url' => 'index.php?p=news', parent_id => 0),
	 *											3   => array('title' => 'Texas', 'url' => 'index.php?p=news&cat=Texas', parent_id => 2),
	 *											4   => array('title' => 'About Us', 'url' => 'index.php?p=about', parent_id => 0),
	 *										)
	 */
	public function string_to_nestedset($structure, $table_fields, $data = array())
	{
		$field_size = sizeof($table_fields);
		$fields = array_keys($table_fields);
		$values = array_fill(0, $field_size, '');
		$lines = array_filter(explode("\n", $structure));
		$max_id = $this->get_max_id($this->column_item_id, false);

		$adj_tree = $parent_ary = array();
		foreach ($lines as $i => $string)
		{
			$indent = strspn($string, " ");
			$depth = $indent / 4;

			$parent_id = (isset($parent_ary[$depth - 1])) ? $parent_ary[$depth - 1] : 0;

			if ($depth && !$parent_id)
			{
				throw new \RuntimeException($this->message_prefix . 'MALFORMED_TREE');
			}

			$key = $i + $max_id + 1;
			$field_values = array_map('trim', explode('|', trim($string))) + $values;

			$adj_tree[$key] = array_merge($data, array_combine($fields, $field_values));
			$adj_tree[$key][$this->column_item_id] = $key;
			$adj_tree[$key]['parent_id'] = $parent_id;

			$parent_ary[$depth] = $key;
		}

		return $adj_tree;
	}

	/**
	 * Adds a new branch to the tree from an array
	 *
	 * @param	array	$branch		Array of nodes to add to tree of form:
	 * 									array(
	 * 										1   => array('title' => 'Home', 'url' => 'index.php', parent_id => 0),
	 * 										2   => array('title' => 'News', 'url' => 'index.php?p=news', parent_id => 0),
	 * 										3   => array('title' => 'Texas', 'url' => 'index.php?p=news&cat=Texas', parent_id => 2),
	 * 										4   => array('title' => 'About Us', 'url' => 'index.php?p=about', parent_id => 0),
	 * 									);
	 * @param	int		$parent_id  Parent id of the branch we're adding
	 * @return	array	ids of newly added items
	 */
	public function add_branch($branch, $parent_id = 0)
	{
		$this->acquire_lock();
		$this->db->sql_transaction('begin');

		$this->add_sub_tree($branch, $parent_id);

		$this->db->sql_transaction('commit');
		$this->lock->release();

		return array_keys($branch);
	}

	protected function add_sub_tree($branch, $parent_id = 0)
	{
		$sql_data = $this->prepare_branch($parent_id, $branch);

		$this->db->sql_multi_insert($this->table_name, $sql_data);

		return $sql_data;
	}

	protected function prepare_branch($parent_id, array $branch)
	{
		$starting_data = $this->get_starting_data($parent_id, $branch);

		$depth = $starting_data['depth'];
		$right_id = $starting_data['right_id'];

		$sql_data = array();
		foreach ($branch as $i => $row)
		{
			$left_id	= $right_id + 1;
			$right_id   = $right_id + 2;

			$sql_data[$i] = $row;
			$sql_data[$i]['parent_id']	= $parent_id;
			$sql_data[$i]['left_id']	= $left_id;
			$sql_data[$i]['right_id']	= $right_id;
			$sql_data[$i]['depth']		= $depth;

			if ($row['parent_id'])
			{
				$left_id	= $sql_data[$row['parent_id']]['right_id'];
				$right_id   = $left_id + 1;

				$sql_data[$i]['parent_id']	= $row['parent_id'];
				$sql_data[$i]['depth']		= $sql_data[$row['parent_id']]['depth'] + 1;
				$sql_data[$i]['left_id']	= $left_id;
				$sql_data[$i]['right_id']	= $right_id;

				$this->update_right_side($sql_data, $right_id, $row['parent_id'], $branch);
			}
		}

		return array_values($sql_data);
	}

	protected function get_starting_data($parent_id, $branch)
	{
		if ($parent_id)
		{
			$new_parent = $this->get_item_info($parent_id);

			if (!$new_parent)
			{
				$this->db->sql_transaction('rollback');
				$this->lock->release();

				throw new \RuntimeException($this->message_prefix . 'INVALID_PARENT');
			}

			// adjust items in affected branch
			$this->prepare_adding_subset(array_keys($branch), $new_parent);

			return array(
				'depth'		=> $new_parent['depth'] + 1,
				'right_id'	=> --$new_parent['right_id'],
			);
		}
		else
		{
			return array(
				'depth'		=> 0,
				'right_id'	=> $this->get_max_id($this->column_right_id),
			);
		}
	}

	protected function get_max_id($column, $use_sql_where = true)
	{
		$sql = "SELECT MAX($column) AS $column
			FROM {$this->table_name} " .
			(($use_sql_where) ? $this->get_sql_where('WHERE') : '');
		$result = $this->db->sql_query($sql);
		$max_id = $this->db->sql_fetchfield($column);
		$this->db->sql_freeresult($result);

		return ($max_id) ? $max_id : 0;
	}

	/**
	* Update right side of tree
	*/
	protected function update_right_side(&$data, &$right_id, $index, $branch)
	{
		$right_id++;
		$data[$index]['right_id'] = $right_id;

		if ($branch[$index]['parent_id'])
		{
			$this->update_right_side($data, $right_id, $branch[$index]['parent_id'], $branch);
		}
	}
}
