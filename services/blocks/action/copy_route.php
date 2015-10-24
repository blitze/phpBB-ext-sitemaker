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
	/** @var \blitze\sitemaker\model\blocks\mapper\blocks */
	protected $block_mapper;

	/** @var \blitze\sitemaker\model\blocks\mapper\routes */
	protected $route_mapper;

	public function execute($style_id)
	{
		$ext_name = $this->request->variable('ext', '');
		$route	= $this->request->variable('route', '');
		$from_route = $this->request->variable('from_route', '');
		$from_style = $this->request->variable('from_style', $style_id);

		$this->route_mapper = $this->mapper_factory->create('blocks', 'routes');
		$this->block_mapper = $this->mapper_factory->create('blocks', 'blocks');

		$route_data = array(
			'config'	=> array(),
			'data'		=> array(),
		);

		$condition = array(
			'route'	=> $from_route,
			'style'	=> $from_style,
		);

		if (!($from_entity = $this->route_mapper->load($condition)))
		{
			return $route_data;
		}

		// delete the current route and all it's blocks
		$this->_delete_route($route, $style_id);

		$copied_route = $this->_duplicate_route($from_entity, $route, $ext_name, $style_id);
		$copied_blocks = $this->_duplicate_blocks($from_entity->get_blocks(), $copied_route->get_route_id(), $copied_route->get_style());

		$route_data['config'] = $copied_route->to_array();
		$route_data['data'] = array_map('array_filter', $copied_blocks);

		return $route_data;
	}

	protected function _delete_route($route, $style_id)
	{
		$entity = $this->route_mapper->load(array(
			'route'	=> $route,
			'style'	=> $style_id,
		));

		if ($entity)
		{
			$this->route_mapper->delete($entity);
		}
	}

	protected function _duplicate_route(\blitze\sitemaker\model\blocks\entity\route $from_entity, $route, $ext_name, $style)
	{
		$copy = clone $from_entity;
		$copy->set_route($route)
			->set_ext_name($ext_name)
			->set_style($style);

		return $this->route_mapper->save($copy);
	}

	protected function _duplicate_blocks(\blitze\sitemaker\model\blocks\collections\blocks $collection, $route_id, $style_id)
	{
		$blocks = array();
		foreach ($collection as $entity)
		{
			$copy = clone $entity;
			$copy->set_style($style_id)
				->set_route_id($route_id);

			$copied = $this->block_mapper->save($copy);
			$position = $copied->get_position();

			$blocks[$position][] = $this->render_block($copied);
		}

		return $blocks;
	}
}
