<?php
/**
 *
 * @package primetime
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

class mapper_factory
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var array */
	protected $mapper_tables;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface		$db			Database object
	 * @param array									$tables		Tables for data mapping
	 */
	public function  __construct(\phpbb\db\driver\driver_interface $db, array $tables)
	{
		$this->db = $db;
		$this->mapper_tables = array_shift($tables);
	}

	public function create($entity, $mapper)
	{
		$entity = strtolower($entity);
		$mapper = strtolower($mapper);

		$options = array(
			'entity_table' => $this->mapper_tables[$mapper]
		);

		$mapper_class = 'blitze\\sitemaker\\model\\' . $entity . '\\mapper\\' . $mapper;
		$collection = 'blitze\\sitemaker\\model\\' . $entity . '\\collections\\' . $mapper;

		return new $mapper_class($this->db, new $collection, $this, $options);
	}
}
