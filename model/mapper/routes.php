<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\mapper;

use blitze\sitemaker\model\base_mapper;

class routes extends base_mapper
{
	/** @var \blitze\sitemaker\model\mapper\blocks */
	protected $block_mapper;

	/** @var string */
	protected $entity_class = 'blitze\sitemaker\model\entity\route';

	/** @var string */
	protected $entity_pkey = 'route_id';

	/**
	 * {@inheritdoc}
	 */
	public function load(array $condition = array())
	{
		/** @type \blitze\sitemaker\model\entity\route|null $entity */
		$entity = parent::load($condition);

		if ($entity)
		{
			$block_mapper = $this->mapper_factory->create('blocks');

			/** @type \blitze\sitemaker\model\collections\blocks $collection */
			$collection = $block_mapper->find(array(
				array('style', '=', $entity->get_style()),
				array('route_id', '=', $entity->get_route_id()),
			));
			$entity->set_blocks($collection);
		}

		return $entity;
	}

	/**
	 * @param array|\blitze\sitemaker\model\entity\route $condition
	 */
	public function delete($condition)
	{
		parent::delete($condition);

		// delete blocks associated with this route and style
		if ($condition instanceof $this->entity_class)
		{
			$block_mapper = $this->mapper_factory->create('blocks');

			$block_mapper->delete(array(
				array('style', '=', $condition->get_style()),
				array('route_id', '=', $condition->get_route_id()),
			));
		}
	}

	/**
	 * @param array $sql_where
	 * @return string
	 */
	protected function find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->entity_table .
			((sizeof($sql_where)) ? ' WHERE ' . join(' AND ', $sql_where) : '') . '
			ORDER BY route ASC';
	}
}
