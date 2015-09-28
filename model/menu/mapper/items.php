<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\menu\mapper;

use blitze\sitemaker\model\base_mapper;
use blitze\sitemaker\services\menu\nestedset;

class items extends base_mapper
{
	/** @var string */
	protected $_entity_class = 'blitze\sitemaker\model\menu\entity\item';

	/** @var string */
	protected $_entity_pkey = 'item_id';

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface				$db					Database object
	 * @param \blitze\sitemaker\model\base_collection		$collection			Entity collection
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory		Mapper factory object
	 * @param array
	 */
	public function  __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\model\base_collection $collection, \blitze\sitemaker\model\mapper_factory $mapper_factory, array $options = array())
	{
		parent::__construct($db, $collection, $mapper_factory, $options);

		$this->tree = new nestedset($db, $this->_entity_table, $this->_entity_pkey);
	}

	public function load(array $condition = array())
	{
		$node_id = $condition['item_id'];
		$row = $this->tree->get_row($node_id);

		if ($row)
		{
			return $this->_create_entity($row);
		}
		return null;
	}

	public function find(array $condition = array())
	{
		$sql_where = $this->_get_condition($condition);
		$this->tree->set_sql_condition(array_shift($sql_where));
		$sql = $this->tree->qet_tree_sql();
		$results = $this->db->sql_query($sql);

		$this->_collection->clear();
		while ($row = $this->db->sql_fetchrow($results))
		{
			$this->_collection[$row[$this->_entity_pkey]] = $this->_create_entity($row);
		}
		$this->db->sql_freeresult($results);

		return $this->_collection;
	}

	public function save($entity)
	{
		$sql_data = $entity->to_db();

		if ($entity->get_item_id())
		{
			unset($sql_data['parent_id']);
		}

		$this->tree->save_node($entity->get_item_id(), $sql_data);

		return $sql_data;
	}

	public function delete($entity)
	{
		$this->tree->delete($entity->get_item_id());
	}

	public function add_items($menu_id, $parent_id, $string)
	{
		$items = $this->tree->string_to_nestedset($string, array('item_title' => '', 'item_url' => ''), array('menu_id' => $menu_id));

		if (sizeof($items))
		{
			$branch = array();
			foreach ($items as $key => $row)
			{
				$entity = $this->_create_entity($row);
				$branch[$key] = $entity->to_db();
			}

			return array(
				'items' => $this->tree->add_branch($branch, $parent_id),
			);
		}

		return array();
	}

	public function update_items($menu_id, array $items)
	{
		$this->tree->set_sql_condition('menu_id = ' . $menu_id);
		$this->tree->update_tree($items);

		return array(
			'errors' => $this->tree->get_errors(),
		);
	}

	public function reorder_items($menu_id)
	{
		$this->tree->set_sql_condition('menu_id = ' . $menu_id);
		$this->tree->recalc_nestedset();
	}

	public function get_errors()
	{
		return $this->tree->get_errors();
	}
}
