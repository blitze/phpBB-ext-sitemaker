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
abstract class builder extends \blitze\sitemaker\services\tree\display
{
	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/**
	 * Construct
	 *
	 * @param \phpbb\db\driver\driver_interface		$db             	Database connection
	 * @param \blitze\sitemaker\services\util			$sitemaker			Sitemaker Object
	 * @param string								$menu_items_table	Menu Items table
	 * @param string								$pk					Primary key
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\services\util $sitemaker, $menu_items_table, $pk)
	{
		parent::__construct($db, $menu_items_table, $pk);

		$this->sitemaker = $sitemaker;
	}

	public function init()
	{
		$asset_path = $this->sitemaker->asset_path;
		$this->sitemaker->add_assets(array(
			'js'        => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				'http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js',
				$asset_path . 'ext/blitze/sitemaker/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jquery.populate/jquery.populate.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/nestedSortable2/jquery.ui.nestedSortable.min.js',
				'@blitze_sitemaker/assets/tree/builder.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				'@blitze_sitemaker/assets/tree/builder.min.css',
			)
		));
	}

	/**
	 * Adds a single node as the child of a given parent node
	 *
	 * @param	array	$sql_data		Other item attributes to insert in the database ex. array('title' => 'Item 1')
	 * @return	mixed	Returns the ID of the newly inserted node or FALSE upon error.
	 */
	public function add_node(&$sql_data)
	{
		if (isset($sql_data['parent_id']) && $sql_data['parent_id'] > 0)
		{
			$row = $this->get_row($sql_data['parent_id']);

			if (!$row)
			{
				$this->errors[] = 'PARENT_NO_EXIST';
				return false;
			}

			$parents_right_id	= (int) $row['right_id'];
			$parents_depth		= (int) $row['depth'];

			$sql = "UPDATE $this->items_table 
				SET left_id = CASE WHEN left_id > $parents_right_id
						THEN left_id + 2
						ELSE left_id 
					END,
					right_id = CASE WHEN right_id >= $parents_right_id
						THEN right_id + 2
						ELSE right_id 
					END
				WHERE right_id >= $parents_right_id" .
					(($this->sql_where) ? ' AND ' . $this->sql_where : '');
			$this->db->sql_query($sql);

			$sql_data['left_id']	= $parents_right_id;
			$sql_data['right_id']	= $parents_right_id + 1;
			$sql_data['depth']		= $parents_depth + 1;
		}
		else
		{
			$sql = "SELECT MAX(right_id) AS right_id
				FROM $this->items_table" .
				(($this->sql_where) ? ' WHERE ' . $this->sql_where : '');
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$sql_data['left_id']	= (int) $row['right_id'] + 1;
			$sql_data['right_id']	= (int) $row['right_id'] + 2;
			$sql_data['parent_id']	= 0;
			$sql_data['depth']		= 0;
		}

		$sql = "INSERT INTO $this->items_table " . $this->db->sql_build_array('INSERT', $sql_data);
		$this->db->sql_query($sql);

		$new_id = (int) $this->db->sql_nextid();
		$sql_data[$this->pk] = $new_id;
		$this->data[$new_id] = $sql_data;

		$this->on_tree_change($this->data);
		$this->reset_data();
	}

	/**
	 * Save node data. If node exists, update it. If not, create it
	 *
	 * @param	int		$node_id	id of the node to be updated
	 * @param	array	$sql_data	Other item attributes to insert in the database ex. array('title' => 'Item 1').
	 * @return	null
	 */
	public function save_node($node_id, &$sql_data)
	{
		if ($node_id)
		{
			$this->update_node($node_id, $sql_data);
		}
		else
		{
			$this->add_node($sql_data);
		}
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
	 * @return	array	newly added branch data
	 */
	public function add_branch($branch, $parent_id = 0, $retain_keys = false)
	{
		if ($parent_id)
		{
			$row = $this->get_row($parent_id);

			if (!$row)
			{
				$this->errors[] = 'PARENT_NO_EXIST';
				return array();
			}

			$right_id	= (int) $row['right_id'] - 1;
			$depth		= (int) $row['depth'] + 1;

			// Update existing tree
			$diff = sizeof($branch) * 2;

			$sql = "UPDATE $this->items_table
				SET left_id = CASE WHEN left_id > $right_id 
						THEN left_id + $diff
						ELSE left_id
					END,
					right_id = CASE WHEN right_id > $right_id
						THEN right_id + $diff
						ELSE right_id
					END
				WHERE right_id > $right_id" .
					(($this->sql_where) ? ' AND ' . $this->sql_where : '');
			$this->db->sql_query($sql);
		}
		else
		{
			$sql = "SELECT MAX(right_id) AS right_id
				FROM $this->items_table" .
				(($this->sql_where) ? ' WHERE ' . $this->sql_where : '');
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$right_id	= (int) $row['right_id'];
			$parent_id	= 0;
			$depth		= 0;
		}

		// Get the highest id
		$max_id = 0;
		if ($retain_keys === false)
		{
			$sql = "SELECT $this->pk 
				FROM $this->items_table
				ORDER BY $this->pk DESC";
			$result = $this->db->sql_query($sql, 1);
			$max_id = $this->db->sql_fetchfield($this->pk);
			$this->db->sql_freeresult($result);
		}

		// lets start building the nested set
		$sql_data = array();
		foreach ($branch as $i => $row)
		{
			$left_id	= $right_id + 1;
			$right_id   = $right_id + 2;

			$sql_data[$i] = $row;
			$sql_data[$i]['parent_id']	= $parent_id;
			$sql_data[$i]['depth']		= $depth;
			$sql_data[$i]['left_id']	= $left_id;
			$sql_data[$i]['right_id']	= $right_id;

			if ($retain_keys === false)
			{
				$sql_data[$i][$this->pk] += $max_id;
			}

			if ($row['parent_id'])
			{
				$left_id	= $sql_data[$row['parent_id']]['right_id'];
				$right_id   = $left_id + 1;

				$sql_data[$i]['parent_id']	= $row['parent_id'] + $max_id;
				$sql_data[$i]['depth']		= $sql_data[$row['parent_id']]['depth'] + 1;
				$sql_data[$i]['left_id']	= $left_id;
				$sql_data[$i]['right_id']   = $right_id;

				$this->update_right_side($sql_data, $right_id, $row['parent_id'], $branch);
			}
		}

		$this->data += $sql_data;
		$sql_data = array_values($sql_data);
		$this->db->sql_multi_insert($this->items_table, $sql_data);

		$this->on_tree_change($this->data);
		$this->reset_data();

		return $sql_data;
	}

	/**
	 * Update a single node
	 *
	 * @param	int		$node_id		The ID of the node to update.
	 * @param	array	$sql_data		Other item attributes to insert in the database ex. array('title' => 'Item 1')
	 * @return	null
	 */
	public function update_node($node_id, &$sql_data)
	{
		if (isset($sql_data['parent_id']))
		{
			$this->change_branch($node_id, $sql_data['parent_id']);

			if (sizeof($this->errors))
			{
				return;
			}
		}

		$sql = "UPDATE $this->items_table
			SET " . $this->db->sql_build_array('UPDATE', $sql_data) . "
			WHERE $this->pk = " . (int) $node_id;
		$this->db->sql_query($sql);

		$sql_data = $this->get_row($node_id);
		$this->data[$node_id] = $sql_data;
		$this->on_tree_change($this->data);
		$this->reset_data();
	}

	/**
	 * Update a branch
	 *
	 * @param	array	Array of nodes to be updated
	 * @return	null
	 */
	public function update_tree($tree)
	{
		$items_data = $this->get_tree_array();

		/** Remove any new nodes in the tree that did not exist before
		 * The intent of this method is to update an existing tree, not add new nodes
		 */
		$tree = array_intersect_key($tree, $items_data);

		// we do it this way because array_merge_recursive, would append numeric keys rather than overwrite them
		foreach ($tree as $key => $data)
		{
			$tree[$key] = array_merge($items_data[$key], $data);
		}

		// Rather than updating each item individually, we will just delete all items
		// then add them all over again with new parent_id|left_id|right_id|depth
		$this->db->sql_query("DELETE FROM $this->items_table" . (($this->sql_where) ? ' WHERE ' . $this->sql_where : ''));

		// Now we add it back
		$this->add_branch($tree, 0, true);

		$this->data = $tree;
		$this->on_tree_change($this->data);
		$this->reset_data();
	}

	/**
	 * Delete a node, branch, or leaf
	 *
	 * @param	int		$node_id	The ID of the node to delete
	 * @param	string	$mode		Delete mode: node|branch|leaf
	 * @return	null
	 */
	public function delete($node_id, $mode = 'leaf')
	{
		switch ($mode)
		{
			case 'node':
				$this->delete_node($node_id);
			break;
			case 'branch':
				$this->delete_branch($node_id);
			break;
			case 'leaf':
			default:
				$this->delete_leaf($node_id);
			break;
		}
	}

	/**
	 * Jump from one branch to another
	 *
	 * @param	int		$node_id		The ID of the node to move to another branch
	 * @param	int		$to_parent_id	The ID of the node's new parent node
	 * @return	null
	 */
	public function change_branch($node_id, $to_parent_id)
	{
		$row = $this->get_row($node_id);

		if (!$row)
		{
			$this->errors[] = 'NODE_NOT_FOUND';
			return false;
		}

		if ($row['parent_id'] == $to_parent_id)
		{
			return false;
		}

		$parent_row = $this->get_row($to_parent_id);

		if ($to_parent_id && !sizeof($parent_row))
		{
			$this->errors[] = 'PARENT_NO_EXIST';
			return false;
		}

		// Are we going to a new parent that was previously a child of this node?
		if ($row['left_id'] < $parent_row['left_id'] && $row['right_id'] > $parent_row['left_id'])
		{
			$this->move_to_own_child($row, $to_parent_id);
		}
		else
		{
			$this->move_branch($node_id, $to_parent_id);
		}

		$sql = "UPDATE $this->items_table SET parent_id = $to_parent_id WHERE $this->pk = " . (int) $node_id;
		$this->db->sql_query($sql);

		$this->data[$node_id] = $this->get_row($node_id);
		$this->on_tree_change($this->data);
		$this->reset_data();
	}

	/**
	 * Move up / down the same branch
	 *
	 * @param	int		$node_id	The ID of the node to move
	 * @param	string	$action		Direction: move_up|move_down
	 * @param	int		$steps		Number of steps to move up/down
	 * @return	null
	 */
	public function move_by($node_id, $action = 'move_up', $steps = 1)
	{
		/**
		* Fetch all the siblings between the current spot
		* and where we want to move it to. If there are less than $steps
		* siblings between the current spot and the target then the
		* node will move as far as possible
		*/
		$node_row = $this->get_row($node_id);

		if (!$node_row)
		{
			$this->errors[] = 'NODE_NOT_FOUND';
			return false;
		}

		$curr_parent_id = (int) $node_row['parent_id'];
		$curr_right_id  = (int) $node_row['right_id'];
		$curr_left_id   = (int) $node_row['left_id'];

		$sql = "SELECT left_id, right_id
			FROM $this->items_table
			WHERE parent_id = $curr_parent_id
				AND " . (($action == 'move_up') ? "right_id < $curr_right_id ORDER BY right_id DESC" : "left_id > $curr_left_id ORDER BY left_id ASC") .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$result = $this->db->sql_query_limit($sql, $steps);

		$target = array();

		while ($row = $this->db->sql_fetchrow($result))
		{
			$target = $row;
		}
		$this->db->sql_freeresult($result);

		if (!sizeof($target))
		{
			// The node is already on top or bottom
			return false;
		}
		else
		{
			$target_left_id = (int) $target['left_id'];
			$target_right_id = (int) $target['right_id'];
		}

		/**
		* $left_id and $right_id define the scope of the nodes that are affected by the move.
		* $diff_up and $diff_down are the values to substract or add to each node's left_id
		* and right_id in order to move them up or down.
		* $move_up_left and $move_up_right define the scope of the nodes that are moving
		* up. Other nodes in the scope of ($left_id, $right_id) are considered to move down.
		*/
		if ($action == 'move_up')
		{
			$left_id = $target_left_id;
			$right_id = $curr_right_id;

			$diff_up = $curr_left_id - $target_left_id;
			$diff_down = $curr_right_id + 1 - $curr_left_id;

			$move_up_left = $curr_left_id;
			$move_up_right = $curr_right_id;
		}
		else
		{
			$left_id = $curr_left_id;
			$right_id = $target_right_id;

			$diff_up = $curr_right_id + 1 - $curr_left_id;
			$diff_down = $target_right_id - $curr_right_id;

			$move_up_left = $curr_right_id + 1;
			$move_up_right = $target_right_id;
		}

		// Now do the dirty job
		$sql = "UPDATE $this->items_table
			SET left_id = left_id + CASE
					WHEN left_id BETWEEN {$move_up_left} AND {$move_up_right} THEN -{$diff_up}
					ELSE {$diff_down}
				END,
				right_id = right_id + CASE
					WHEN right_id BETWEEN {$move_up_left} AND {$move_up_right} THEN -{$diff_up}
					ELSE {$diff_down}
				END
			WHERE left_id BETWEEN {$left_id} AND {$right_id}
				AND right_id BETWEEN {$left_id} AND {$right_id}" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$this->data[$node_id] = $this->get_row($node_id);
		$this->on_tree_change($this->data);
		$this->reset_data();
	}

	/**
	 * Recalculate Nested Set
	 *
	 * @param int	$new_id		first left_id (should start with 1)
	 * @param int	$parent_id	parent_id of the current set (default = 0)
	 * @param int	$depth		starting depth of the current set (default = 0)
	 * @author EXreaction
	 */
	public function recalc_nestedset(&$new_id = 1, $parent_id = 0, $depth = 0)
	{
		$sql = "SELECT $this->pk, parent_id, depth, left_id, right_id
			FROM $this->items_table
			WHERE parent_id = " . (int) $parent_id .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '') . '
			ORDER BY left_id ASC';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			// First we update the left_id for this module
			if ($row['left_id'] != $new_id)
			{
				$this->db->sql_query('UPDATE ' . $this->items_table . ' SET ' . $this->db->sql_build_array('UPDATE', array('left_id' => $new_id)) . " WHERE $this->pk = " . (int) $row[$this->pk]);
			}
			$new_id++;

			// Then we go through any children and update their left/right id's
			$this->recalc_nestedset($new_id, $row[$this->pk], $depth + 1);

			// Then we come back and update the right_id for this module
			if ($row['right_id'] != $new_id)
			{
				$this->db->sql_query('UPDATE ' . $this->items_table . ' SET ' . $this->db->sql_build_array('UPDATE', array('right_id' => $new_id)) . " WHERE $this->pk = " . (int) $row[$this->pk]);
			}
			$new_id++;
		}
		$this->db->sql_freeresult($result);

		$this->db->sql_query("UPDATE $this->items_table SET depth = $depth WHERE parent_id = " . (int) $parent_id);
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

		$adj_tree = $parent_ary = array();
		foreach ($lines as $i => $string)
		{
			$indent = strspn($string, " ");
			$depth = $indent / 4;

			$parent_id = (isset($parent_ary[$depth - 1])) ? $parent_ary[$depth - 1] : 0;

			if ($depth && !$parent_id)
			{
				$this->errors[] = 'MALFORMED_TREE';
				return array();
			}

			$key = $i + 1;
			$field_values = array_map('trim', explode('|', trim($string))) + $values;

			$adj_tree[$key] = array_merge($data, array_combine($fields, $field_values));
			$adj_tree[$key][$this->pk] = $key;
			$adj_tree[$key]['parent_id'] = $parent_id;

			$parent_ary[$depth] = $key;
		}

		return $adj_tree;
	}

	/**
	 * Takes a flat array of parent/child relationships and converts it to a nested array
	 *
	 * @param	$flat	Flat array
	 * @return	array	Nested array
	 */
	public function adjacent_to_nestedset($flat)
	{
		$indexed = array();
		// first pass - get the array indexed by the primary id
		foreach ($flat as $row)
		{
			$indexed[$row[$this->pk]] = $row;
			$indexed[$row[$this->pk]]['children'] = array();
		}

		//second pass
		foreach ($indexed as $id => $row)
		{
			$indexed[$row['parent_id']]['children'][$id] =& $indexed[$id];
		}

		return $indexed[0]['children'];
	}

	/**
	 * This function does nothing but can be over-written
	 * to do something whenever the tree changes
	 */
	public function on_tree_change($data)
	{
		return $data;
	}

	/**
	 * Move a branch to a another branch
	 */
	private function move_branch($node_id, $to_parent_id)
	{
		$moved_items = $this->get_branch($node_id, 'children', 'descending');
		$from_data = $moved_items[0];
		$diff = sizeof($moved_items) * 2;

		$moved_ids = array();
		for ($i = 0, $size = sizeof($moved_items); $i < $size; ++$i)
		{
			$moved_ids[] = $moved_items[$i][$this->pk];
		}

		// Resync parents
		$sql = "UPDATE $this->items_table
			SET right_id = right_id - $diff
			WHERE left_id < " . (int) $from_data['right_id'] . '
				AND right_id > ' . (int) $from_data['right_id'] .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		// Resync righthand side of tree
		$sql = "UPDATE $this->items_table
			SET left_id = left_id - $diff, right_id = right_id - $diff
			WHERE left_id > " . (int) $from_data['right_id'] .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		if ($to_parent_id > 0)
		{
			$to_data = $this->get_row($to_parent_id);

			// Resync new parents
			$sql = "UPDATE $this->items_table
				SET right_id = right_id + $diff
				WHERE " . (int) $to_data['right_id'] . ' BETWEEN left_id AND right_id
					AND ' . $this->db->sql_in_set($this->pk, $moved_ids, true) .
					(($this->sql_where) ? ' AND ' . $this->sql_where : '');
			$this->db->sql_query($sql);

			// Resync the righthand side of the tree
			$sql = "UPDATE $this->items_table
				SET left_id = left_id + $diff, right_id = right_id + $diff
				WHERE left_id > " . (int) $to_data['right_id'] . '
					AND ' . $this->db->sql_in_set($this->pk, $moved_ids, true) .
					(($this->sql_where) ? ' AND ' . $this->sql_where : '');
			$this->db->sql_query($sql);

			// Resync moved branch
			$to_data['right_id'] += $diff;
			if ($to_data['right_id'] > $from_data['right_id'])
			{
				$diff = '+ ' . ($to_data['right_id'] - $from_data['right_id'] - 1);
			}
			else
			{
				$diff = '- ' . abs($to_data['right_id'] - $from_data['right_id'] - 1);
			}

			$to_parent_depth = $to_data['depth'];
		}
		else
		{
			$sql = "SELECT MAX(right_id) AS right_id
				FROM $this->items_table
				WHERE " . $this->db->sql_in_set($this->pk, $moved_ids, true) .
					(($this->sql_where) ? ' AND ' . $this->sql_where : '');
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$to_parent_depth = -1;
			$diff = '+ ' . (int) ($row['right_id'] - $from_data['left_id'] + 1);
		}

		$depth_diff = $to_parent_depth - $from_data['depth'] + 1;

		$sql = "UPDATE $this->items_table
			SET left_id = left_id $diff, right_id = right_id $diff, depth = depth + $depth_diff
			WHERE " . $this->db->sql_in_set($this->pk, $moved_ids) .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$this->reset_data();
	}

	/**
	* Make a node a child of its own child
	*/
	private function move_to_own_child($row, $to_parent_id)
	{
		$this->delete($row[$this->pk], 'node');
		$row['parent_id'] = $to_parent_id;
		$this->add_node($row);
	}

	/**
	* Update right side of tree
	*/
	private function update_right_side(&$data, &$right_id, $index, $branch)
	{
		$right_id++;
		$data[$index]['right_id'] = $right_id;

		if ($branch[$index]['parent_id'])
		{
			$this->update_right_side($data, $right_id, $branch[$index]['parent_id'], $branch);
		}
	}

	/**
	* Delete single node that has no child nodes
	*/
	private function delete_leaf($node_id)
	{
		$row = $this->get_row($node_id);
		$branch = $this->get_branch($node_id, 'children', 'descending', false);

		if (sizeof($branch))
		{
			$this->errors[] = 'CANNOT_DELETE_NODE';
			return false;
		}

		// Delete the node
		$sql = "DELETE FROM $this->items_table
			WHERE $this->pk = $node_id" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$right_id = (int) $row['right_id'];

		// Resync tree
		$sql = "UPDATE $this->items_table 
			SET left_id = CASE WHEN left_id > $right_id
					THEN left_id - 2
					ELSE left_id
				END,
				right_id = CASE WHEN right_id > $right_id
					THEN right_id - 2
					ELSE right_id
				END
			WHERE (left_id > $right_id OR right_id > $right_id)" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$this->reset_data();
	}

	/**
	* Delete a single node, moving any child nodes one level up
	*/
	private function delete_node($node_id)
	{
		$row = $this->get_row($node_id);

		if (!$row)
		{
			$this->errors[] = 'NODE_NOT_FOUND';
			return false;
		}

		$node_id	= (int) $node_id;
		$parent_id	= (int) $row['parent_id'];
		$left_id	= (int) $row['left_id'];
		$right_id	= (int) $row['right_id'];

		// Delete the node
		$sql = "DELETE FROM $this->items_table
			WHERE $this->pk = $node_id" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		// Move children 1 step up
		$sql = "UPDATE $this->items_table
			SET parent_id = $parent_id
				WHERE parent_id = $node_id" .
					(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		// Reduce depth by 1
		$sql = "UPDATE $this->items_table
			SET depth = depth - 1
				WHERE left_id BETWEEN $left_id AND $right_id";
		$this->db->sql_query($sql);

		$sql = "UPDATE $this->items_table 
			SET 
				left_id = CASE 
					WHEN left_id > $right_id
						THEN left_id - 2
					WHEN left_id BETWEEN $left_id AND $right_id
						THEN left_id - 1
					ELSE left_id
				END,
				right_id = CASE 
					WHEN right_id > $right_id
						THEN right_id - 2
					WHEN left_id BETWEEN $left_id AND $right_id
						THEN right_id - 1
					ELSE right_id
				END
			WHERE (left_id > $left_id OR right_id > $right_id)" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$this->reset_data();
	}

	/**
	* Delete an entire branch, the node and all its child nodes
	*/
	private function delete_branch($node_id)
	{
		$row = $this->get_row($node_id);

		if (!$row)
		{
			$this->errors[] = 'NODE_NOT_FOUND';
			return false;
		}

		$right_id   = (int) $row['right_id'];
		$left_id	= (int) $row['left_id'];

		$sql = "DELETE FROM $this->items_table 
			WHERE left_id BETWEEN $left_id AND $right_id" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$sql = "UPDATE $this->items_table 
			SET 
				left_id = CASE WHEN left_id > $left_id
					THEN left_id - ($right_id - $left_id + 1)
					ELSE left_id 
				END,
				right_id = CASE WHEN right_id > $left_id
					THEN right_id - ($right_id - $left_id + 1)
					ELSE right_id 
				END
			WHERE (left_id > $left_id OR right_id > $left_id)" .
				(($this->sql_where) ? ' AND ' . $this->sql_where : '');
		$this->db->sql_query($sql);

		$this->reset_data();
	}
}
