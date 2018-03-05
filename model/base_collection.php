<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

abstract class base_collection implements \Iterator, \Countable, \ArrayAccess
{
	protected $entities = array();

	protected $entity_class;

	/**
	 * Get the entities stored in the collection
	 */
	public function get_entities()
	{
		return $this->entities;
	}

	/**
	 * Clear the collection
	 */
	public function clear()
	{
		$this->entities = array();
	}

	/**
	 * Reset the collection (implementation required by Iterator Interface)
	 */
	public function rewind()
	{
		reset($this->entities);
	}

	/**
	 * Get the current entity in the collection (implementation required by Iterator Interface)
	 *
	 * @return mixed
	 */
	public function current()
	{
		return current($this->entities);
	}

	/**
	 * Get the next entity in the collection (implementation required by Iterator Interface)
	 *
	 * @return mixed
	 */
	public function next()
	{
		return next($this->entities);
	}

	/**
	 * Get the key of the current entity in the collection (implementation required by Iterator Interface)
	 *
	 * @return mixed
	 */
	public function key()
	{
		return key($this->entities);
	}

	/**
	 * Check if there’re more entities in the collection (implementation required by Iterator Interface)
	 *
	 * @return bool
	 */
	public function valid()
	{
		return ($this->current() !== false);
	}

	/**
	 * Count the number of entities in the collection (implementation required by Countable Interface)
	 *
	 * @return mixed
	 */
	public function count()
	{
		return count($this->entities);
	}

	/**
	 * Add an entity to the collection (implementation required by ArrayAccess interface)
	 *
	 * @param mixed $key
	 * @param mixed $entity
	 * @return void
	 * @throws \blitze\sitemaker\exception\invalid_argument
	 */
	public function offsetSet($key, $entity)
	{
		if (!$entity instanceof $this->entity_class)
		{
			throw new \blitze\sitemaker\exception\invalid_argument(array('entity', 'INVALID_ENTITY'));
		}

		if (!isset($key))
		{
			$this->entities[] = $entity;
		}
		else
		{
			$this->entities[$key] = $entity;
		}
	}

	/**
	 * Remove an entity from the collection (implementation required by ArrayAccess interface)
	 *
	 * @param mixed $key
	 * @return void
	 */
	public function offsetUnset($key)
	{
		if ($key instanceof $this->entity_class)
		{
			$this->entities = array_filter(
				$this->entities,
				function ($v) use ($key)
				{
					return $v !== $key;
				}
			);
		}
		else if (isset($this->entities[$key]))
		{
			unset($this->entities[$key]);
		}
	}

	/**
	 * Get the specified entity in the collection (implementation required by ArrayAccess interface)
	 *
	 * @param mixed $key
	 * @return null
	 */
	public function offsetGet($key)
	{
		return isset($this->entities[$key]) ? $this->entities[$key] : null;
	}

	/**
	 * Check if the specified entity exists in the collection (implementation required by ArrayAccess interface)
	 *
	 * @param mixed $key
	 * @return bool
	 */
	public function offsetExists($key)
	{
		return isset($this->entities[$key]);
	}
}
