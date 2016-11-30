<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\mapper;

use blitze\sitemaker\model\base_mapper;
use blitze\sitemaker\services\menus\nestedset;

class items extends base_mapper
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \blitze\sitemaker\services\menus\nestedset */
	protected $tree;

	/** @var string */
	protected $entity_class = 'blitze\sitemaker\model\entity\item';

	/** @var string */
	protected $entity_pkey = 'item_id';

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface				$db					Database object
	 * @param \blitze\sitemaker\model\base_collection		$collection			Entity collection
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory		Mapper factory object
	 * @param string										$entity_table		Menu Items table
	 * @param \phpbb\config\config							$config				Config object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\model\base_collection $collection, \blitze\sitemaker\model\mapper_factory $mapper_factory, $entity_table, \phpbb\config\config $config)
	{
		parent::__construct($db, $collection, $mapper_factory, $entity_table);

		$this->config = $config;
		$this->tree = new nestedset(
			$db,
			new \phpbb\lock\db('sitemaker.table_lock.menu_items_table', $this->config, $db),
			$this->entity_table
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function load(array $condition = array())
	{
		$sql_where = join(' AND ', $this->get_sql_condition($condition));
		$row = $this->tree
			->set_sql_where($sql_where)
			->get_item_info();

		if ($row)
		{
			return $this->create_entity($row);
		}
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function find(array $condition = array())
	{
		$sql_where = join(' AND ', $this->get_sql_condition($condition));
		$tree_data = $this->tree
			->set_sql_where($sql_where)
			->get_all_tree_data();

		$this->collection->clear();
		foreach ($tree_data as $id => $row)
		{
			$this->collection[$id] = $this->create_entity($row);
		}

		return $this->collection;
	}

	/**
	 * {@inheritdoc}
	 */
	public function save(\blitze\sitemaker\model\entity_interface $entity)
	{
		/** @type \blitze\sitemaker\model\entity\item $entity */
		$sql_data = $entity->to_db();

		$this->tree->set_sql_where($this->get_sql_where($entity->get_menu_id()));

		if ($entity->get_item_id())
		{
			$item = $this->tree->update_item($entity->get_item_id(), $sql_data);
		}
		else
		{
			$item = $this->tree->insert($sql_data);
		}

		return $this->create_entity($item);
	}

	/**
	 * Add multiple items via string depicting hierarchical structure
	 *
	 * @param int $menu_id
	 * @param int $parent_id
	 * @param $string
	 * @return \blitze\sitemaker\model\base_collection
	 */
	public function add_items($menu_id, $parent_id, $string)
	{
		$items = $this->tree->string_to_nestedset($string, array('item_title' => '', 'item_url' => ''), array('menu_id' => $menu_id));

		$new_item_ids = array();
		if (sizeof($items))
		{
			$branch = $this->prep_items_for_storage($items);

			$new_item_ids = $this->tree->set_sql_where($this->get_sql_where($menu_id))
				->add_branch($branch, $parent_id);
		}

		return $this->find(array('item_id', '=', $new_item_ids));
	}

	/**
	 * Update entire tree saving parent-child relationships in a single go
	 *
	 * @param int $menu_id
	 * @param array $items
	 * @return array
	 */
	public function update_items($menu_id, array $items)
	{
		return $this->tree->set_sql_where($this->get_sql_where($menu_id))
			->update_tree($items);
	}

	/**
	 * {@inheritdoc}
	 */
	public function create_entity(array $row)
	{
		return new $this->entity_class($row, $this->config['enable_mod_rewrite']);
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function prep_items_for_storage(array $items)
	{
		$branch = array();
		foreach ($items as $key => $row)
		{
			$entity = $this->create_entity($row);
			$branch[$key] = array_merge($entity->to_db(), array(
				'item_id'	=> $key,
			));
		}

		return $branch;
	}

	/**
	 * @param int $menu_id
	 * @return string
	 */
	protected function get_sql_where($menu_id)
	{
		return '%smenu_id = ' . (int) $menu_id;
	}
}
