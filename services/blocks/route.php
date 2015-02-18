<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services\blocks;

abstract class route
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
	protected $blocks_table;

	/** @var string */
	protected $block_routes_table;

	/** @var integer */
	protected $style_id = 0;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\user								$user					User object
	 * @param string									$blocks_table			Name of the blocks database table
	 * @param string									$block_routes_table		Name of the block_routes database table
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, \phpbb\user $user, $blocks_table, $block_routes_table)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->blocks_table = $blocks_table;
		$this->block_routes_table = $block_routes_table;
	}

	/**
	 * Get all routes with blocks
	 */
	public function get_all_routes()
	{
		if (($routes = $this->cache->get('primetime_block_routes')) === false)
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

			$this->cache->put('primetime_block_routes', $routes);
		}

		return $routes;
	}

	/**
	 * Get routes with blocks
	 */
	public function get_route_options($route)
	{
		$sql_array = array(
			'SELECT'	=> 'r.route',

			'FROM'	  => array(
				$this->blocks_table			=> 'b',
				$this->block_routes_table	=> 'r',
			),

			'WHERE'	 => 'b.route_id = r.route_id',

			'GROUP_BY'  => 'r.route',

			'ORDER_BY'  => 'r.route',
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$options = '<option value="">' . $this->user->lang['SELECT'] . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected = ($row['route'] == $route) ? " selected='selected'" : '';
			$options .= '<option value="' . $row['route'] . '"' . $selected . '>' . $row['route'] . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $options;
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
		$sql_data['route_id'] = $this->db->sql_nextid();

		$this->cache->destroy('primetime_block_routes');

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
		$this->cache->destroy('primetime_block_routes');
		$this->cache->destroy('primetime_blocks');

		return array_merge(
			$sql_data,
			array('message' => $this->user->lang['ROUTE_UPDATED'])
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

		$this->cache->destroy('primetime_block_routes');
	}
}
