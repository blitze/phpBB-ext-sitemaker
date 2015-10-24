<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class add_block extends base_action
{
	public function execute($style_id)
	{
		$name	= $this->request->variable('block', '');
		$route	= $this->request->variable('route', '');

		if (($block_instance = $this->block_factory->get_block($name)) === null)
		{
			return array('errors' => $this->user->lang('BLOCK_NOT_FOUND'));
		}

		$route_data = array(
			'route' => $route,
			'style'	=> $style_id,
		);

		$route = $this->_force_get_route($route_data, true);

		$default_settings = $block_instance->get_config(array());
		$block_settings = $this->blocks->sync_settings($default_settings);

		$block_mapper = $this->mapper_factory->create('blocks', 'blocks');

		$entity = $block_mapper->create_entity(array(
			'name'			=> $name,
			'weight'		=> $this->request->variable('weight', 0),
			'position'		=> $this->request->variable('position', ''),
			'route_id'		=> (int) $route->get_route_id(),
			'style'			=> (int) $style_id,
			'hash'			=> $this->generate_hash($block_settings),
			'settings'		=> $block_settings,
		));

		$entity = $block_mapper->save($entity);

		return $this->render_block($entity);
	}
}
