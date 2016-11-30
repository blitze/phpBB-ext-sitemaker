<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class copy_route extends base_action
{
	/** @var \blitze\sitemaker\model\mapper\blocks */
	protected $block_mapper;

	/** @var \blitze\sitemaker\model\mapper\routes */
	protected $route_mapper;

	/**
	 * {@inheritdoc}
	 */
	public function execute($style_id)
	{
		$ext_name = $this->request->variable('ext', '');
		$route = $this->request->variable('route', '');
		$from_route = $this->request->variable('from_route', '');
		$from_style = $this->request->variable('from_style', $style_id);

		$this->route_mapper = $this->mapper_factory->create('routes');
		$this->block_mapper = $this->mapper_factory->create('blocks');

		$route_data = array(
			'config'	=> array(),
			'list'		=> array(),
		);

		$condition = array(
			array('route', '=', $from_route),
			array('style', '=', $from_style),
		);

		if (!($from_entity = $this->route_mapper->load($condition)))
		{
			return $route_data;
		}

		// delete the current route and all it's blocks
		$this->delete_route($route, $style_id);

		/** @type \blitze\sitemaker\model\entity\route $from_entity */
		$copied_route = $this->duplicate_route($from_entity, $route, $ext_name, $style_id);

		/** @type \blitze\sitemaker\model\entity\route $copied_route */
		$copied_blocks = $this->duplicate_blocks($from_entity->get_blocks(), $copied_route->get_route_id(), $copied_route->get_style());

		$route_data['config'] = $copied_route->to_array();
		$route_data['list'] = array_map('array_filter', $copied_blocks);

		return $route_data;
	}

	/**
	 * @param string $route
	 * @param int $style_id
	 */
	protected function delete_route($route, $style_id)
	{
		$entity = $this->route_mapper->load(array(
			array('route', '=', $route),
			array('style', '=', $style_id),
		));

		if ($entity)
		{
			$this->route_mapper->delete($entity);
		}
	}

	/**
	 * Copy the route preferences
	 *
	 * @param \blitze\sitemaker\model\entity\route $from_entity
	 * @param string $route
	 * @param string $ext_name
	 * @param int $style
	 * @return \blitze\sitemaker\model\entity_interface
	 */
	protected function duplicate_route(\blitze\sitemaker\model\entity\route $from_entity, $route, $ext_name, $style)
	{
		$copy = clone $from_entity;
		$copy->set_route($route)
			->set_ext_name($ext_name)
			->set_style($style);

		return $this->route_mapper->save($copy);
	}

	/**
	 * Copy the blocks
	 *
	 * @param \blitze\sitemaker\model\collections\blocks $collection
	 * @param int $route_id
	 * @param int $style_id
	 * @return array
	 */
	protected function duplicate_blocks(\blitze\sitemaker\model\collections\blocks $collection, $route_id, $style_id)
	{
		$blocks = array();
		foreach ($collection as $entity)
		{
			$copy = clone $entity;
			$copy->set_style($style_id)
				->set_route_id($route_id);

			/** @type \blitze\sitemaker\model\entity\block $copied */
			$copied = $this->block_mapper->save($copy);
			$position = $copied->get_position();

			$this->copy_custom_block($entity->get_bid(), $copied);

			$blocks[$position][] = $this->render_block($copied);
		}

		return $blocks;
	}

	/**
	 * @param int $from_bid
	 * @param \blitze\sitemaker\model\entity\block $entity
	 */
	protected function copy_custom_block($from_bid, \blitze\sitemaker\model\entity\block $entity)
	{
		if ($entity->get_name() === 'blitze.sitemaker.block.custom')
		{
			$block = $this->phpbb_container->get('blitze.sitemaker.block.custom');
			$block->copy($from_bid, $entity->get_bid());
		}
	}
}
