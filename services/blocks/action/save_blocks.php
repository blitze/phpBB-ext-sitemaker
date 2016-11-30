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
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\model\mapper\blocks */
	protected $block_mapper;

	/** @var \blitze\sitemaker\model\mapper\routes */
	protected $route_mapper;

	/**
	 * {@inheritdoc}
	 */
	public function execute($style_id)
	{
		$route = $this->request->variable('route', '');
		$blocks = $this->request->variable('blocks', array(0 => array('' => '')));

		$this->route_mapper = $this->mapper_factory->create('routes');
		$this->block_mapper = $this->mapper_factory->create('blocks');

		$route_entity = $this->force_get_route(array(
			'route'	=> $route,
			'style'	=> $style_id,
		));

		/** @type \blitze\sitemaker\model\entity\route $route_entity */
		$this->save($route_entity, $blocks);

		return array('message' => $this->translator->lang('LAYOUT_SAVED'));
	}

	/**
	 * Save blocks for route
	 *
	 * @param \blitze\sitemaker\model\entity\route $entity
	 * @param array $blocks
	 */
	protected function save(\blitze\sitemaker\model\entity\route $entity, array $blocks)
	{
		// find all blocks for this route
		$db_blocks = $this->get_blocks($entity);

		$blocks_to_delete = array_filter(array_diff_key($db_blocks, $blocks));
		$blocks_to_update = array_filter(array_intersect_key($db_blocks, $blocks));

		$this->delete_blocks($blocks_to_delete);
		$this->update_blocks($blocks_to_update, $blocks);
		$this->update_route($blocks_to_update, $entity);
	}

	/**
	 * Get all blocks for route
	 *
	 * @param \blitze\sitemaker\model\entity\route $entity
	 * @return array
	 */
	protected function get_blocks(\blitze\sitemaker\model\entity\route $entity)
	{
		$collection = $entity->get_blocks();

		return (!empty($collection)) ? $collection->get_entities() : array();
	}

	/**
	 * Delete specified blocks
	 *
	 * @param array $blocks_to_delete
	 */
	protected function delete_blocks(array $blocks_to_delete)
	{
		if (sizeof($blocks_to_delete))
		{
			$this->block_mapper->delete(array('bid', '=', array_keys($blocks_to_delete)));
		}
	}

	/**
	 * Update block position and weight
	 *
	 * @param array $blocks_to_update
	 * @param array $data
	 */
	protected function update_blocks(array $blocks_to_update, array $data)
	{
		foreach ($blocks_to_update as $entity)
		{
			$row = $data[$entity->get_bid()];

			$entity->set_position($row['position']);
			$entity->set_weight($row['weight']);
			$this->block_mapper->save($entity);
		}
	}

	/**
	 * Update route if it has blocks or route is customized, otherwise, delete the route
	 *
	 * @param array                                       $blocks_to_update
	 * @param \blitze\sitemaker\model\entity\route $entity
	 */
	protected function update_route(array $blocks_to_update, \blitze\sitemaker\model\entity\route $entity)
	{
		$has_blocks = (sizeof($blocks_to_update)) ? true : false;

		if (!$has_blocks && !$this->route_is_customized($entity->to_array()))
		{
			$this->route_mapper->delete($entity);
		}
		else
		{
			$entity->set_has_blocks($has_blocks);
			$this->route_mapper->save($entity);
		}
	}
}
