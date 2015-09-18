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
	public function execute($style_id)
	{
		$route	= $this->request->variable('route', '');
		$from_route = $this->request->variable('from_route', '');
		$from_style = $this->request->variable('from_style', $style_id);

		$this->route_mapper = $this->mapper_factory->create('blocks', 'routes');
		$this->block_mapper = $this->mapper_factory->create('blocks', 'blocks');

		$template_route = $this->route_mapper->load(array(
			'route'	=> $from_route,
			'style'	=> $from_style,
		));
		$template_blocks = $template_route->get_blocks();

		// delete the current route and all it's blocks
		$this->_delete_route($route, $style_id);

		$copied_route = $this->_duplicate_route($template_route, $route, $style_id);
		$copied_blocks = $this->_duplicate_blocks($template_blocks, $copied_route->get_route_id(), $copied_route->get_style());

		return array(
			'config'	=> $copied_route,
			'data'		=> array_filter($copied_blocks),
		);
	}

	protected function _delete_route($route, $style_id)
	{
		$route = $this->route_mapper->load(array(
			'route'	=> $route,
			'style'	=> $style_id,
		));

		if ($route)
		{
			$this->route_mapper->delete($route);
		}
	}

	protected function _duplicate_route($from_route, $to_route, $to_style)
	{
		$copy = clone $from_route;
		$copy->set_route($to_route);
		$copy->set_style($to_style);

		return $this->route_mapper->save($copy);
	}

	protected function _duplicate_blocks(\blitze\sitemaker\model\base_collection $collection, $route_id, $style_id)
	{
		$blocks = array();
		foreach ($collection as $entity)
		{
			$copy = clone $entity;
			$copy->set_style($style_id);
			$copy->set_route_id($route_id);

			$copy = $this->block_mapper->save($copy);
			$position = $copy->get_position();

			$blocks[$position][] = $this->render_block($copy);
		}

		return $blocks;
	}
}
