<?php
/**
 *
 * @package primetime
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

abstract class base_mapper implements mapper_interface
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var \blitze\sitemaker\model\base_collection */
	protected $_collection;

	/** @var string */
	protected $_entity_table;

	/** @var string */
	protected $_entity_class;

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
		$this->db = $db;
		$this->_collection = $collection;
		$this->mapper_factory = $mapper_factory;

		if (isset($options['entity_table']))
		{
			$this->set_entity_table($options['entity_table']);
		}

		if (isset($options['entity_class']))
		{
			$this->set_entity_class($options['entity_class']);
		}
	}

	/**
	 * Get the collection
	 */
	public function get_collection()
	{
		return $this->_collection;
	}

	/**
	 * Set the entity table
	 */
	public function set_entity_table($entity_table)
	{
		if (!is_string($entity_table) || empty($entity_table))
		{
			throw new DataMapperException('The specified entity table is invalid.');
		}

		$this->_entity_table = $entity_table;
	}

	/**
	 * Get the entity table
	 */
	public function get_entity_table()
	{
		return $this->_entity_table;
	}

	/**
	 * Set the entity class
	 */
	public function set_entity_class($entity_class)
	{
		if (!class_exists($entity_class))
		{
			throw new DataMapperException('The specified entity class is invalid.');
		}

		$this->_entity_class = $entity_class;
	}

	/**
	 * Get the entity class
	 */
	public function get_entity_class()
	{
		return $this->_entity_class;
	}

	/**
	 * Find a single entity
	 */
	public function load(array $condition = array())
	{
		$sql_where = $this->_get_condition($condition);
		$results = $this->db->sql_query($this->_find_sql($sql_where));
		$row = $this->db->sql_fetchrow($results);
		$this->db->sql_freeresult($results);

		if ($row)
		{
			return $this->_create_entity($row);
		}
		return null;
	}

	/**
	 * Find all the entities
	 */
	public function find(array $condition = array())
	{
		$sql_where = $this->_get_condition($condition);
		$results = $this->db->sql_query($this->_find_sql($sql_where));
		$this->_collection->clear();

		while ($row = $this->db->sql_fetchrow($results))
		{
			$this->_collection[$row[$this->_entity_pkey]] = $this->_create_entity($row);
		}
		$this->db->sql_freeresult($results);

		return $this->_collection;
	}

	/**
	 * Save the block entity
	 */
	public function save($entity)
	{
		$accessor = 'get_' . $this->_entity_pkey;
		if (is_null($entity->$accessor()))
		{
			$entity = $this->_insert($entity);
		}
		else
		{
			$this->_update($entity);
		}

		return $entity;
	}

	/**
	 * Delete from the database
	 */
	public function delete($condition)
	{
		if ($condition instanceof $this->_entity_class)
		{
			$accessor = 'get_' . $this->_entity_pkey;
			$condition = array($this->_entity_pkey => $condition->$accessor());
		}

		$sql_where = $this->_get_condition($condition);
		$this->db->sql_query('DELETE FROM ' . $this->_entity_table . (sizeof($sql_where) ? ' WHERE ' . join(' AND ', $sql_where) : ''));
	}

	/**
	 * Insert a new row in the table corresponding to the specified entity
	 */
	protected function _insert($entity)
	{
		if ($entity instanceof $this->_entity_class)
		{
			$this->db->sql_query('INSERT INTO ' . $this->_entity_table . ' ' . $this->db->sql_build_array('INSERT', $entity->to_db()));

			$mutator = 'set_' . $this->_entity_pkey;
			$entity->$mutator((int) $this->db->sql_nextid());

			return $entity;
		}
		throw new DataMapperException('The specified entity is not allowed for this mapper.');
	}

	/**
	 * Update the row in the table corresponding to the specified entity
	 */
	protected function _update($entity)
	{
		if ($entity instanceof $this->_entity_class)
		{
			$accessor = 'get_' . $this->_entity_pkey;
			$id = $entity->$accessor();

			$sql_data = $entity->to_db();
			unset($sql_data[$this->_entity_pkey]);

			return $this->db->sql_query('UPDATE ' . $this->_entity_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) .' WHERE ' . $this->_entity_pkey . ' = ' . $id);
		}
		throw new DataMapperException('The specified entity is not allowed for this mapper.');
	}

	/**
	 * Create the entity
	 */
	protected function _create_entity(array $row)
	{
		return new $this->_entity_class($row);
	}

	protected function _find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->_entity_table .
			(sizeof($sql_where) ? ' WHERE ' . join(' AND ', $sql_where) : '');
	}

	protected function _get_condition(array $condition)
	{
		$sql_where = array();
		foreach ($condition as $field => $value)
		{
			switch (gettype($value))
			{
				case 'array':
				$sql_where[] = $this->db->sql_in_set($field, $value);
				break;
				case 'string':
				$sql_where[] = $field . " = '" . $this->db->sql_escape($value) . "'";
				break;
				case 'boolean':
				case 'integer':
				$sql_where[] = $field . ' = ' . (int) $value;
				break;
			}
		}

		return $sql_where;
	}
}
