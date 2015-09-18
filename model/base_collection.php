<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

abstract class base_collection implements \Iterator, \Countable, \ArrayAccess
{
	protected $_entities = array();
	protected $_entity_class;

	/**
     * Constructor
     */
	public function  __construct(array $entities = array())
	{
		if (!empty($entities))
		{
			$this->_entities = $entities;
		}
		$this->rewind();
	}

	/**
     * Get the entities stored in the collection
     */
	public function get_entities()
	{
		return $this->_entities;
	}

	/**
     * Clear the collection
     */
	public function clear()
	{
		$this->_entities = array();
	}

	/**
     * Reset the collection (implementation required by Iterator Interface)
     */
	public function rewind()
	{
		reset($this->_entities);
	}

	/**
     * Get the current entity in the collection (implementation required by Iterator Interface)
     */
	public function current()
	{
		return current($this->_entities);
	}

	/**
     * Move to the next entity in the collection (implementation required by Iterator Interface)
     */
	public function next()
	{
		next($this->_entities);
	}

	/**
     * Get the key of the current entity in the collection (implementation required by Iterator Interface)
     */
	public function key()
	{
		return key($this->_entities);
	}

	/**
     * Check if there’re more entities in the collection (implementation required by Iterator Interface)
     */
	public function valid()
	{
		return ($this->current() !== false);
	}

	/**
     * Count the number of entities in the collection (implementation required by Countable Interface)
     */
	public function count()
	{
		return count($this->_entities);
	}

	/**
     * Add an entity to the collection (implementation required by ArrayAccess interface)
     */
	public function offsetSet($key, $entity)
	{
		if ($entity instanceof $this->_entity_class)
		{
			if (!isset($key))
			{
				$this->_entities[] = $entity;
			}
			else
			{
				$this->_entities[$key] = $entity;
			}
			return true;
		}
		throw new CollectionException('The specified entity is not allowed for this collection.');
	}

	/**
     * Remove an entity from the collection (implementation required by ArrayAccess interface)
     */
	public function offsetUnset($key)
	{
		if ($key instanceof $this->_entity_class)
		{
			$this->_entities = array_filter(
				$this->_entities,
				function ($v) use ($key)
				{
					return $v !== $key;
				}
			);
			return true;
		}

		if (isset($this->_entities[$key]))
		{
			unset($this->_entities[$key]);
			return true;
		}
		return false;
	}

	/**
     * Get the specified entity in the collection (implementation required by ArrayAccess interface)
     */
	public function offsetGet($key)
	{
		return isset($this->_entities[$key]) ? $this->_entities[$key] : null;
	}

	/**
     * Check if the specified entity exists in the collection (implementation required by ArrayAccess interface)
     */
	public function offsetExists($key)
	{
		return isset($this->_entities[$key]);
	}
}
