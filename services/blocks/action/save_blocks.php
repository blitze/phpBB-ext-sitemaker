<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class save_blocks extends base_action
{
	public function execute($style_id)
	{
		$route = $this->request->variable('route', '');
		$blocks = $this->request->variable('blocks', array(0 => array('' => '')));

		$this->route_mapper = $this->mapper_factory->create('blocks', 'routes');
		$this->block_mapper = $this->mapper_factory->create('blocks', 'blocks');

		$entity = $this->_force_get_route(array(
			'route'	=> $route,
			'style'	=> $style_id,
		));

		// find all blocks for this route
		$db_blocks = $this->_get_blocks($entity);

		$blocks_to_delete = array_filter(array_diff_key($db_blocks, $blocks));
		$blocks_to_update = array_filter(array_intersect_key($db_blocks, $blocks));

		$this->_delete_blocks($blocks_to_delete);
		$this->_update_blocks($blocks_to_update, $blocks);
		$this->_update_route($blocks_to_update, $entity);

		return array('message' => $this->user->lang('LAYOUT_SAVED'));
	}

	protected function _get_blocks($entity)
	{
		$collection = $entity->get_blocks();

		if (!empty($collection))
		{
			return $collection->get_entities();
		}
		else
		{
			return array();
		}
	}

	protected function _delete_blocks($blocks_to_delete)
	{
		if (sizeof($blocks_to_delete))
		{
			$this->block_mapper->delete(array(
				'bid'	=> array_keys($blocks_to_delete)
			));
		}
	}

	protected function _update_blocks($blocks_to_update, array $data)
	{
		foreach ($blocks_to_update as $entity)
		{
			$row = $data[$entity->get_bid()];

			$entity->set_position($row['position']);
			$entity->set_weight($row['weight']);
			$this->block_mapper->save($entity);
		}
	}

	protected function _update_route($blocks_to_update, $route)
	{
		$ex_positions = $route->get_ex_positions();
		$hiding_blocks = $route->get_hide_blocks();
		$has_blocks = (sizeof($blocks_to_update)) ? true : false;

		if (!$has_blocks && !$hiding_blocks && !sizeof($ex_positions))
		{
			$this->route_mapper->delete($route);
		}
		else
		{
			$route->set_has_blocks($has_blocks);
			$this->route_mapper->save($route);
		}
	}
}
