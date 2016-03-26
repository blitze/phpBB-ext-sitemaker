<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

abstract class base_mapper implements mapper_interface
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\model\base_collection */
	protected $collection;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var string */
	protected $entity_table;

	/** @var string */
	protected $entity_class;

	/** @var string */
	protected $entity_pkey;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface				$db					Database object
	 * @param \blitze\sitemaker\model\base_collection		$collection			Entity collection
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory		Mapper factory object
	 * @param string										$entity_table
	 */
	public function  __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\model\base_collection $collection, \blitze\sitemaker\model\mapper_factory $mapper_factory, $entity_table)
	{
		$this->db = $db;
		$this->collection = $collection;
		$this->mapper_factory = $mapper_factory;
		$this->entity_table = $entity_table;
	}

	/**
	 * Get the collection
	 */
	public function get_collection()
	{
		return $this->collection;
	}

	/**
	* {@inheritdoc}
	*/
	public function load(array $condition = array())
	{
		$sql_where = $this->get_condition($condition);
		$results = $this->db->sql_query($this->find_sql($sql_where));
		$row = $this->db->sql_fetchrow($results);
		$this->db->sql_freeresult($results);

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
		$sql_where = $this->get_condition($condition);
		$results = $this->db->sql_query($this->find_sql($sql_where));
		$this->collection->clear();

		while ($row = $this->db->sql_fetchrow($results))
		{
			$this->collection[$row[$this->entity_pkey]] = $this->create_entity($row);
		}
		$this->db->sql_freeresult($results);

		return $this->collection;
	}

	/**
	* {@inheritdoc}
	*/
	public function save(\blitze\sitemaker\model\entity_interface $entity)
	{
		$accessor = 'get_' . $this->entity_pkey;
		if (is_null($entity->$accessor()))
		{
			$entity = $this->insert($entity);
		}
		else
		{
			$this->update($entity);
		}

		return $entity;
	}

	/**
	* {@inheritdoc}
	*/
	public function delete($condition)
	{
		if ($condition instanceof $this->entity_class)
		{
			$accessor = 'get_' . $this->entity_pkey;
			$condition = array($this->entity_pkey, '=', $condition->$accessor());
		}

		$sql_where = $this->get_condition($condition);
		$this->db->sql_query('DELETE FROM ' . $this->entity_table . (sizeof($sql_where) ? ' WHERE ' . join(' AND ', $sql_where) : ''));
	}

	/**
	 * {@inheritdoc}
	 */
	public function create_entity(array $row)
	{
		return new $this->entity_class($row);
	}

	/**
	 * Insert a new row in the table corresponding to the specified entity
	 * @param \blitze\sitemaker\model\entity_interface $entity
	 * @return \blitze\sitemaker\model\entity_interface
	 * @throws \blitze\sitemaker\exception\unexpected_value
	 */
	protected function insert(\blitze\sitemaker\model\entity_interface $entity)
	{
		if ($entity instanceof $this->entity_class)
		{
			$this->db->sql_query('INSERT INTO ' . $this->entity_table . ' ' . $this->db->sql_build_array('INSERT', $entity->to_db()));

			$mutator = 'set_' . $this->entity_pkey;
			$entity->$mutator((int) $this->db->sql_nextid());

			return $entity;
		}

		throw new \blitze\sitemaker\exception\unexpected_value('INVALID_ENTITY');
	}

	/**
	 * Update the row in the table corresponding to the specified entity
	 * @param \blitze\sitemaker\model\entity_interface $entity
	 * @return mixed
	 * @throws \blitze\sitemaker\exception\unexpected_value
	 */
	protected function update(\blitze\sitemaker\model\entity_interface $entity)
	{
		if ($entity instanceof $this->entity_class)
		{
			$accessor = 'get_' . $this->entity_pkey;

			return $this->db->sql_query('UPDATE ' . $this->entity_table . '
				SET ' . $this->db->sql_build_array('UPDATE', $entity->to_db()) . '
				WHERE ' . $this->entity_pkey . ' = ' . (int) $entity->$accessor());
		}

		throw new \blitze\sitemaker\exception\unexpected_value('INVALID_ENTITY');
	}

	/**
	 * @param array $sql_where
	 * @return string
	 */
	protected function find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->entity_table .
			(sizeof($sql_where) ? ' WHERE ' . join(' AND ', $sql_where) : '');
	}

	/**
	 * @param array $condition
	 * @return array
	 */
	protected function get_condition(array $condition)
	{
		$sql_where = array();
		$condition = $this->ensure_multi_array($condition);

		foreach ($condition as $info)
		{
			list($field, $operator, $value) = $info;

			switch (gettype($value))
			{
				case 'array':
					$sql_where[] = $this->db->sql_in_set($field, $value, ($operator == '=') ? false : true);
				break;
				case 'string':
					$sql_where[] = $field . " $operator '" . $this->db->sql_escape($value) . "'";
				break;
				case 'boolean':
				case 'integer':
					$sql_where[] = $field . " $operator " . (int) $value;
				break;
			}
		}

		return $sql_where;
	}

	/**
	 * @param array $condition
	 * @return mixed
	 */
	protected function ensure_multi_array(array $condition)
	{
		return array_filter((is_array(current($condition))) ? $condition : array($condition));
	}
}
