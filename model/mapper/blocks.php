<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\mapper;

use blitze\sitemaker\model\base_mapper;

class blocks extends base_mapper
{
	/** @var string */
	protected $entity_class = 'blitze\sitemaker\model\entity\block';

	/** @var string */
	protected $entity_pkey = 'bid';

	/**
	 * @param array $sql_where
	 * @return string
	 */
	protected function find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->entity_table .
			((sizeof($sql_where)) ? ' WHERE ' . join(' AND ', $sql_where) : '') . '
			ORDER BY position, weight ASC';
	}

	/**
	 * @param array|\blitze\sitemaker\model\entity\block $condition
	 */
	public function delete($condition)
	{
		parent::delete($condition);

		// move blocks up for position
		if ($condition instanceof $this->entity_class)
		{
			$this->db->sql_query('UPDATE ' . $this->entity_table . '
				SET weight = weight - 1
				WHERE weight > ' . (int) $condition->get_weight() . '
					AND style = ' . (int) $condition->get_style() . '
					AND route_id = ' . (int) $condition->get_route_id() . "
					AND position = '" . $this->db->sql_escape($condition->get_position()) . "'");
		}
	}

	/**
	 * {@inheritdoc}
	 */
	protected function insert(\blitze\sitemaker\model\entity_interface $entity)
	{
		// do we have other existing blocks for route at this position?
		/** @type \blitze\sitemaker\model\entity\block $entity */
		$collection = $this->find(array(
			array('route_id', '=', $entity->get_route_id()),
			array('style', '=', $entity->get_style()),
			array('position', '=', $entity->get_position()),
		));

		// if we don't have existing blocks, make sure weight = 0
		if (!$collection->valid())
		{
			$entity->set_weight(0);
		}
		// if we have existing blocks, increase block weight by 1 for any block that is below the new block
		else
		{
			$this->move_blocks_down($entity);
		}

		return parent::insert($entity);
	}

	/**
	 * @param \blitze\sitemaker\model\entity\block $entity
	 */
	protected function move_blocks_down(\blitze\sitemaker\model\entity\block $entity)
	{
		$sql = 'UPDATE ' . $this->entity_table . '
			SET weight = weight + 1
			WHERE weight >= ' . (int) $entity->get_weight() . '
				AND route_id = ' . (int) $entity->get_route_id() . '
				AND style = ' . (int) $entity->get_style() . "
				AND position = '" . $this->db->sql_escape($entity->get_position()) . "'";
		$this->db->sql_query($sql);
	}
}
