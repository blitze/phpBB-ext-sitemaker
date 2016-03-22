<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

use blitze\sitemaker\model\entity_interface;

abstract class base_entity implements entity_interface
{
	/** @var array */
	protected $db_fields = array();

	/** @var array */
	protected $required_fields = array();

	/**
	 * Populate the entity with data
	 */
	public function __construct(array $data)
	{
		foreach ($data as $name => $value)
		{
			$mutator = 'set_' . $name;
			$this->$mutator($value);
		}
	}

	public function __call($name, $args)
	{
		if (preg_match('/^(get|set)_(\w+)/', strtolower($name), $match) && $attribute = $this->_attribute_exists($match[2]))
		{
			if ('get' == $match[1])
			{
				return $this->$attribute;
			}
			else
			{
				$this->$attribute = $this->_validate_attribute($match[2], $args[0]);
				return $this;
			}
		}
		else
		{
			throw new \blitze\sitemaker\exception\unexpected_value(array($name, 'UNDEFINED_METHOD'));
		}
	}

	/**
	* {@inheritdoc}
	*/
	public function to_array()
	{
		$attributes = $this->_get_attributes();

		$data = array();
		foreach ($attributes as $attribute)
		{
			$accessor = 'get_' . $attribute;
			$data[$attribute] = $this->$accessor();
		}
		unset($data['db_fields'], $data['required_fields']);

		return $data;
	}

	/**
	* {@inheritdoc}
	*/
	public function to_db()
	{
		$this->_check_required();

		$db_data = array();
		foreach ($this->db_fields as $attribute)
		{
			$type = $this->_get_property_type($attribute);
			if (in_array($type, array('boolean', 'integer', 'string')))
			{
				$db_data[$attribute] = $this->$attribute;
			}
		}

		return $db_data;
	}

	protected function _get_attributes()
	{
		return array_keys(get_class_vars(get_class($this)));
	}

	protected function _attribute_exists($name)
	{
		if (in_array(strtolower($name), $this->_get_attributes()))
		{
			return strtolower($name);
		}
	}

	protected function _check_required()
	{
		foreach ($this->required_fields as $field)
		{
			if (!$this->$field)
			{
				throw new \blitze\sitemaker\exception\invalid_argument(array($field, 'FIELD_MISSING'));
			}
		}
	}

	protected function _validate_attribute($name, $value)
	{
		$type = $this->_get_property_type($name);

		if (in_array($type, array('array', 'boolean', 'float', 'integer', 'string')))
		{
			settype($value, $type);
			return $value;
		}

		if ($type === false || !$value instanceof $type)
		{
			throw new \blitze\sitemaker\exception\unexpected_value(array($name, 'INVALID_TYPE'));
		}

		return $value;
	}

	protected function _get_property_type($name)
	{
		$reflection = new \ReflectionObject($this);
		$reflectionProperty = $reflection->getProperty($name);
		$doc = $reflectionProperty->getDocComment();

		preg_match_all('#\/\*\*\s@var\s(.*?)\s\*\/#s', $doc, $annotations);

		return current($annotations[1]);
	}
}
