<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config;

class cfg_factory
{
	/** @var array */
	private $fields;

	/**
	 * Constructor
	 *
	 * @param \phpbb\di\service_collection		$cfg_fields			Service Collection
	 */
	public function __construct(\phpbb\di\service_collection $cfg_fields)
	{
		$this->register_fields($cfg_fields);
	}

	/**
	 * @param \phpbb\di\service_collection $cfg_fields
	 */
	protected function register_fields(\phpbb\di\service_collection $cfg_fields)
	{
		$this->fields = array();
		foreach ($cfg_fields as $field)
		{
			$this->fields[$field->get_name()] = $field;
		}
	}

	/**
	 * Get field by name
	 *
	 * @param string $type
	 * @return false|\blitze\sitemaker\services\blocks\config\fields\cfg_field_interface
	 */
	public function get($type)
	{
		if (isset($this->fields[$type]))
		{
			return $this->fields[$type];
		}

		return false;
	}
}
