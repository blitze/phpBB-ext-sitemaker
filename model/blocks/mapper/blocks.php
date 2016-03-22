<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\blocks\mapper;

use blitze\sitemaker\model\base_mapper;

class blocks extends base_mapper
{
	/** @var string */
	protected $_entity_class = 'blitze\sitemaker\model\blocks\entity\block';

	/** @var string */
	protected $_entity_pkey = 'bid';

	protected function _find_sql(array $sql_where)
	{
		return 'SELECT * FROM ' . $this->_entity_table .
			((sizeof($sql_where)) ? ' WHERE ' . join(' AND ', $sql_where) : '') . '
			ORDER BY position, weight ASC';
	}

	public function delete($condition)
	{
		parent::delete($condition);

		// move blocks up for position
		if ($condition instanceof $this->_entity_class)
		{
			$this->db->sql_query('UPDATE ' . $this->_entity_table . '
				SET weight = weight - 1
				WHERE weight > ' . (int) $condition->get_weight() . '
					AND style = ' . (int) $condition->get_style() . '
					AND route_id = ' . (int) $condition->get_route_id() . "
					AND position = '" . $this->db->sql_escape($condition->get_position()) . "'");
		}
	}

	protected function _insert(\blitze\sitemaker\model\entity_interface $entity)
	{
		$this->_move_blocks_down($entity);

		return parent::_insert($entity);
	}

	protected function _move_blocks_down(\blitze\sitemaker\model\entity_interface $entity)
	{
		$sql = 'UPDATE ' . $this->_entity_table . '
			SET weight = weight + 1
			WHERE weight >= ' . (int) $entity->get_weight() . '
				AND route_id = ' . (int) $entity->get_route_id() . '
				AND style = ' . (int) $entity->get_style();
		$this->db->sql_query($sql);
	}
}
