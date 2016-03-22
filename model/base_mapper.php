<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

use blitze\sitemaker\model\mapper_interface;

abstract class base_mapper implements mapper_interface
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\model\base_collection */
	protected $_collection;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var string */
	protected $_entity_table;

	/** @var string */
	protected $_entity_class;

	/** @var string */
	protected $_entity_pkey;

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
		$this->_collection = $collection;
		$this->mapper_factory = $mapper_factory;
		$this->_entity_table = $entity_table;
	}

	/**
	 * Get the collection
	 */
	public function get_collection()
	{
		return $this->_collection;
	}

	/**
	* {@inheritdoc}
	*/
	public function load(array $condition = array())
	{
		$sql_where = $this->_get_condition($condition);
		$results = $this->db->sql_query($this->_find_sql($sql_where));
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
		$sql_where = $this->_get_condition($condition);
		$results = $this->db->sql_query($this->_find_sql($sql_where));
		$this->_collection->clear();

		while ($row = $this->db->sql_fetchrow($results))
		{
			$this->_collection[$row[$this->_entity_pkey]] = $this->create_entity($row);
		}
		$this->db->sql_freeresult($results);

		return $this->_collection;
	}

	/**
	* {@inheritdoc}
	*/
	public function save(\blitze\sitemaker\model\entity_interface $entity)
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
	* {@inheritdoc}
	*/
	public function delete($condition)
	{
		if ($condition instanceof $this->_entity_class)
		{
			$accessor = 'get_' . $this->_entity_pkey;
			$condition = array($this->_entity_pkey, '=', $condition->$accessor());
		}

		$sql_where = $this->_get_condition($condition);
		$this->db->sql_query('DELETE FROM ' . $this->_entity_table . (sizeof($sql_where) ? ' WHERE ' . join(' AND ', $sql_where) : ''));
	}

	/**
	 * Create the entity
	 */
	public function create_entity(array $row)
	{
		return new $this->_entity_class($row);
	}

	/**
	 * Insert a new row in the table corresponding to the specified entity
	 */
	protected function _insert(\blitze\sitemaker\model\entity_interface $entity)
	{
		if ($entity instanceof $this->_entity_class)
		{
			$this->db->sql_query('INSERT INTO ' . $this->_entity_table . ' ' . $this->db->sql_build_array('INSERT', $entity->to_db()));

			$mutator = 'set_' . $this->_entity_pkey;
			$entity->$mutator((int) $this->db->sql_nextid());

			return $entity;
		}

		throw new \blitze\sitemaker\exception\unexpected_value('INVALID_ENTITY');
	}

	/**
	 * Update the row in the table corresponding to the specified entity
	 */
	protected function _update(\blitze\sitemaker\model\entity_interface $entity)
	{
		if ($entity instanceof $this->_entity_class)
		{
			$accessor = 'get_' . $this->_entity_pkey;

			return $this->db->sql_query('UPDATE ' . $this->_entity_table . '
				SET ' . $this->db->sql_build_array('UPDATE', $entity->to_db()) . '
				WHERE ' . $this->_entity_pkey . ' = ' . (int) $entity->$accessor());
		}

		throw new \blitze\sitemaker\exception\unexpected_value('INVALID_ENTITY');
	}

	protected function _find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->_entity_table .
			(sizeof($sql_where) ? ' WHERE ' . join(' AND ', $sql_where) : '');
	}

	protected function _get_condition(array $condition)
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

	protected function ensure_multi_array(array $condition)
	{
		return array_filter((is_array(current($condition))) ? $condition : array($condition));
	}
}
