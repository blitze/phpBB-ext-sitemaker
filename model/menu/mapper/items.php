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
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \blitze\sitemaker\services\menu\nestedset */
	protected $tree;

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
	 * @param string										$entity_table		Menu Items table
	 * @param \phpbb\config\config							$config				Config object
	 */
	public function  __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\model\base_collection $collection, \blitze\sitemaker\model\mapper_factory $mapper_factory, $entity_table, \phpbb\config\config $config)
	{
		parent::__construct($db, $collection, $mapper_factory, $entity_table);

		$this->config = $config;
		$this->tree = new nestedset(
			$db,
			new \phpbb\lock\db('sitemaker.table_lock.menu_items_table', $this->config, $db),
			$this->_entity_table
		);
	}

	public function load(array $condition = array())
	{
		$sql_where = join(' AND ', $this->_get_condition($condition));
		$row = $this->tree
			->set_sql_where($sql_where)
			->get_item_info();

		if ($row)
		{
			return $this->create_entity($row);
		}
		return null;
	}

	public function find(array $condition = array())
	{
		$sql_where = join(' AND ', $this->_get_condition($condition));
		$tree_data = $this->tree
			->set_sql_where($sql_where)
			->get_all_tree_data();

		$this->_collection->clear();
		foreach ($tree_data as $id => $row)
		{
			$this->_collection[$id] = $this->create_entity($row);
		}

		return $this->_collection;
	}

	public function save($entity)
	{
		$sql_data = $entity->to_db();

		$this->tree->set_sql_where($this->get_sql_where($entity->get_menu_id()));

		if ($entity->get_item_id())
		{
			return $this->tree->update_item($entity->get_item_id(), $sql_data);
		}
		else
		{
			return $this->tree->insert($sql_data);
		}
	}

	public function add_items($menu_id, $parent_id, $string)
	{
		$items = $this->tree->string_to_nestedset($string, array('item_title' => '', 'item_url' => ''), array('menu_id' => $menu_id));

		if (sizeof($items))
		{
			$branch = $this->prep_items($items, true);
			$items = $this->tree
				->set_sql_where($this->get_sql_where($menu_id))
				->add_branch($branch, $parent_id);

			return array(
				'items' => $this->prep_items($items),
			);
		}

		return array();
	}

	public function update_items($menu_id, array $items)
	{
		return $this->tree
			->set_sql_where($this->get_sql_where($menu_id))
			->update_tree($items);
	}

	public function reorder_items($menu_id)
	{
		return $this->tree
			->set_sql_where($this->get_sql_where($menu_id))
			->regenerate_left_right_ids(1);
	}

	/**
	 * Create the entity
	 */
	public function create_entity(array $row)
	{
		return new $this->_entity_class($this->config['enable_mod_rewrite'], $row);
	}

	protected function prep_items($items, $db_mode = false)
	{
		$branch = array();
		$method = ($db_mode) ? 'to_db' : 'to_array';

		foreach ($items as $key => $row)
		{
			$entity = $this->create_entity($row);
			$branch[$key] = $entity->$method();
		}

		return $branch;
	}

	protected function get_sql_where($menu_id)
	{
		return '%smenu_id = ' . (int) $menu_id;
	}
}
