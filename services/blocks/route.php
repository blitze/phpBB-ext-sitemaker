<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class route extends base
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $block_routes_table;

	/** @var integer */
	protected $style_id = 0;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param ContainerInterface						$phpbb_container		Service container
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\user								$user					User object
	 * @param string									$php_ext				phpEx
	 * @param string									$block_routes_table		Name of the block_routes database table
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\user $user, $php_ext, $block_routes_table)
	{
		parent::__construct($config, $phpbb_container, $user, $php_ext);

		$this->cache = $cache;
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->block_routes_table = $block_routes_table;
	}

	/**
	 * Get all routes with blocks
	 */
	public function get_all_routes()
	{
		$sql = 'SELECT *
				FROM ' . $this->block_routes_table;
		$result = $this->db->sql_query($sql);

		$routes = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$routes[$row['style']][$row['route']] = $row;
		}
		$this->db->sql_freeresult($result);

		return $routes;
	}

	/**
	 * Get route info, if it exists
	 */
	public function get_route_info($route, $style = 0, $create_route = true)
	{
		$routes = $this->get_all_routes();
		$style_id = ($style) ? $style : $this->style_id;

		return (isset($routes[$style_id][$route])) ? $routes[$style_id][$route] : (($create_route) ? $this->add_route($route, 'data') : array());
	}

	/**
	 * Get the id of the current route. If it does not exist, add the route and get the id
	 */
	public function get_route_id($route)
	{
		$routes = $this->get_all_routes();

		return (isset($routes[$this->style_id][$route])) ? $routes[$this->style_id][$route]['route_id'] : $this->add_route($route);
	}

	/**
	 * Add a new route
	 */
	public function add_route($route, $return = 'id')
	{
		$ext_name = $this->request->variable('ext', '');

		$sql_data = array(
			'ext_name'		=> $ext_name,
			'route'			=> $route,
			'style'			=> $this->style_id,
			'hide_blocks'	=> false,
			'has_blocks'	=> false,
			'ex_positions'	=> '',
		);
		$this->db->sql_query('INSERT INTO ' . $this->block_routes_table . ' ' . $this->db->sql_build_array('INSERT', $sql_data));
		$sql_data['route_id'] = (int) $this->db->sql_nextid();

		$this->cache->destroy('sitemaker_block_routes');

		return ($return == 'id') ? $sql_data['route_id'] : $sql_data;
	}

	/**
	 * Set route preferences
	 */
	public function set_route_prefs($route, $data)
	{
		$route_id = $this->get_route_id($route);
		$blocks = $this->get_blocks($route, 'id');

		$default_prefs = array(
			'hide_blocks'	=> false,
			'ex_positions'	=> '',
		);

		if (sizeof($blocks) || $data != $default_prefs)
		{
			return $this->update_route($route_id, $data);
		}
		else
		{
			$this->delete_route($route_id);
			return array();
		}
	}

	/**
	 * Update route data
	 */
	public function update_route($route_id, $sql_data)
	{
		if (!$route_id)
		{
			return array();
		}

		$this->db->sql_query('UPDATE ' . $this->block_routes_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE route_id = ' . (int) $route_id);
		$this->cache->destroy('sitemaker_block_routes');
		$this->cache->destroy('sitemaker_blocks');

		return array_merge(
			$sql_data,
			array('message' => $this->user->lang('ROUTE_UPDATED'))
		);
	}

	/**
	 * Delete a route
	 */
	public function delete_route($route_id)
	{
		$this->db->sql_query('DELETE FROM ' . $this->block_routes_table . '
			WHERE route_id = ' . (int) $route_id . '
				AND style = ' . $this->style_id);

		$this->cache->destroy('sitemaker_block_routes');
	}
}
