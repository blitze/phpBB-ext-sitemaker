<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\blocks\mapper;

use blitze\sitemaker\model\base_mapper;

class routes extends base_mapper
{
	/** @var \blitze\sitemaker\model\blocks\mapper\blocks */
	protected $block_mapper;

	/** @var string */
	protected $_entity_class = 'blitze\sitemaker\model\blocks\entity\route';

	/** @var string */
	protected $_entity_pkey = 'route_id';

	public function load(array $condition = array())
	{
		$entity = parent::load($condition);

		if ($entity)
		{
			$block_mapper = $this->mapper_factory->create('blocks', 'blocks');
			$collection = $block_mapper->find(array(
				'style'		=> $entity->get_style(),
				'route_id'	=> $entity->get_route_id(),
			));
			$entity->set_blocks($collection);
		}

		return $entity;
	}

	public function delete($condition)
	{
		parent::delete($condition);

		// delete blocks associated with this route and style
		if ($condition instanceof $this->_entity_class)
		{
			$block_mapper = $this->mapper_factory->create('blocks', 'blocks');
			$block_mapper->delete(array(
				'style'		=> $condition->get_style(),
				'route_id'	=> $condition->get_route_id(),
			));
		}
	}

	protected function _find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->_entity_table .
			((sizeof($sql_where)) ? ' WHERE ' . join(' AND ', $sql_where) : '') . '
			ORDER BY route ASC';
	}
}
