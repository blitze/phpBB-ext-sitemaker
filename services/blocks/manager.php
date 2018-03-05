<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class manager
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\model\mapper\blocks */
	protected $block_mapper;

	/** @var \blitze\sitemaker\model\mapper\routes */
	protected $route_mapper;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->cache = $cache;
		$this->block_factory = $block_factory;

		$this->block_mapper = $mapper_factory->create('blocks');
		$this->route_mapper = $mapper_factory->create('routes');
	}

	/**
	 * Get all block routes in database
	 *
	 * @return	array
	 */
	public function get_routes_per_style()
	{
		$collection = $this->route_mapper->find();

		$routes = array();
		foreach ($collection as $entity)
		{
			$route = $entity->get_route();
			$style_id = $entity->get_style();

			$routes[$style_id][$route] = $entity->to_array();
		}

		return $routes;
	}

	/**
	 * Get unique block names in database
	 *
	 * @return array
	 */
	public function get_unique_block_names()
	{
		$collection = $this->block_mapper->find();

		$names = array();
		foreach ($collection as $entity)
		{
			$names[] = $entity->get_name();
		}

		return array_unique($names);
	}

	/**
	 * Check if block exists
	 *
	 * @param	string	$service_name	Service name of block
	 * @return	bool
	 */
	public function block_exists($service_name)
	{
		return ($this->block_factory->get_block($service_name)) ? true : false;
	}

	/**
	 * Delete all blocks and routes for a specific style
	 * @param int|array $style_id
	 */
	public function delete_blocks_by_style($style_id)
	{
		$this->block_mapper->delete(array('style', '=', $style_id));
		$this->route_mapper->delete(array('style', '=', $style_id));

		$this->cache->destroy('sitemaker_block_routes');
	}

	/**
	 * Delete a route and all it's blocks across styles
	 * @param string|array $route
	 */
	public function delete_blocks_by_route($route)
	{
		$collection = $this->route_mapper->find(array('route', '=', $route));

		$route_ids = array_keys($collection->get_entities());

		$this->block_mapper->delete(array('route_id', '=', $route_ids));
		$this->route_mapper->delete(array('route_id', '=', $route_ids));
	}

	/**
	 * Delete all instances of a block across styles/routes
	 * @param string|array $block_name
	 */
	public function delete_blocks_by_name($block_name)
	{
		$collection = $this->block_mapper->find(array('name', '=', $block_name));

		foreach ($collection as $entity)
		{
			$this->block_mapper->delete($entity);
		}
	}
}
