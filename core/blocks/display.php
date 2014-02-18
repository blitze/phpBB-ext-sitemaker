<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\blocks;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
*
*/
class display
{
	/**
	 * Auth object instance
	 * @var \phpbb\auth\auth
	 */
	protected $auth;

	/**
	 * Cache
	 * @var \phpbb\cache\service
	 */
	protected $cache;

	/**
	 * Database object
	 * @var \phpbb\db\driver
	 */
	protected $db;

	/**
	 * Request object
	 * @var \phpbb\request\request_interface
	 */
	protected $request;

	/**
	 * Template object
	 * @var \phpbb\template\template
	 */
	protected $template;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime object
	 * @var \primetime\primetime\core\primetime
	 */
	protected $primetime;

	/**
	 * Template object for primetime blocks
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	/**
	 * Name of the blocks database table
	 * @var string
	 */
	private $blocks_table;

	/**
	 * Name of the blocks_config database table
	 * @var string
	 */
	private $blocks_config_table;
	
	/**
	 * Name of the block_routes database table
	 * @var string
	 */
	private $block_routes_table;

	/**
	 * Default layout
	 * @var string
	 */
	private $default_route;

	/**
	 * Current block route
	 * @var string
	 */
	public $route;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth					Auth object
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\db\driver\driver					$db						Database object
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param \primetime\primetime\core\primetime		$primetime				Primetime object
	 * @param \primetime\primetime\core\template		$ptemplate				Primetime template object
	 * @param string									$blocks_table			Name of the blocks database table
	 * @param string									$blocks_config_table	Name of the blocks_config database table
	 * @param string									$block_routes_table		Name of the block_routes database table
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface $cache, \phpbb\db\driver\driver $db, 
		\phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, 
		\primetime\primetime\core\primetime $primetime, \primetime\primetime\core\template $ptemplate, 
		$blocks_table, $blocks_config_table, $block_routes_table)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
    	$this->primetime = $primetime;
		$this->ptemplate = $ptemplate;
		$this->blocks_table = $blocks_table;
		$this->blocks_config_table = $blocks_config_table;
		$this->block_routes_table = $block_routes_table;
	}

	public function show()
	{
		global $phpbb_container, $config;

		$offlimits = array('ucp.php', 'mcp.php');
		if ($this->user->page['page_dir'] == 'adm' || in_array($this->user->page['page_name'], $offlimits))
		{
			return;
		}

		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
            'css'   => array(
                $asset_path . 'ext/primetime/primetime/assets/font-awesome/css/font-awesome.min.css',
            )
		));

		$edit_mode = false;
		$this->default_route = $config['primetime_default_layout'];
		$route = $this->get_route();

		if ($this->auth->acl_get('a_manage_blocks'))
		{
			$manager = $phpbb_container->get('primetime.blocks.manager');
			$edit_mode = $manager->handle($route);
		}

		$route_info = $this->get_route_info($route);
		$blocks = $this->get_blocks($route, $edit_mode);

		if (empty($route_info))
		{
			$route_info = array(
				'hide_blocks'	=> false,
				'ex_positions'	=> '',
			);
		}

		if (!sizeof($blocks) && !$route_info['hide_blocks'] && $edit_mode === false)
		{
			$blocks = $this->get_blocks($this->default_route, false);
		}

		// remove unwanted positions for this route
		if ($route_info['ex_positions'])
		{
			$blocks = array_diff_key($blocks, array_flip(explode(',', $route_info['ex_positions'])));
		}

		$blocks_per_position = array();
		foreach ($blocks as $position => $blocks_ary)
		{
			$pos_count_key = 's_' . $position . '_count';
			$blocks_per_position[$pos_count_key] = 0;

			$blocks_ary = array_values($blocks_ary);
			for ($i = 0, $size = sizeof($blocks_ary); $i < $size; $i++)
			{
				$row = $blocks_ary[$i];
				$block_service = $row['name'];
	
				if ($phpbb_container->has($block_service))
				{
					$b = $phpbb_container->get($block_service);
					$b->set_template($this->ptemplate);
					$block = $b->display($row, $edit_mode);
	
					if (empty($block['content']))
					{
						continue;
					}
	
					$data = array_merge($row, array(
							'TITLE'		=> ($row['title']) ? $row['title'] : ((isset($this->user->lang[$block['title']])) ? $this->user->lang[$block['title']] : $block['title']),
							'CONTENT'	=> $block['content'],
						)
					);
					$this->template->assign_block_vars($position, array_change_key_case($data, CASE_UPPER));
					$blocks_per_position[$pos_count_key]++;
				}
			}
		}

		$this->template->assign_vars(array_merge(array(
				'S_PRIMETIME'		=> true,
				'S_BLOCKS_ADMIN'	=> true,
			),
			array_change_key_case($blocks_per_position, CASE_UPPER))
		);
	}

	public function get_route()
	{
		global $phpbb_container, $symfony_request;

		$controller_service = $symfony_request->attributes->get('_route');
		$this->route = $this->user->page['page_name'];

		if ($controller_service)
		{
			$controller = $phpbb_container->get($controller_service);

			/**
			 * Let controller optionally specify route
			 */
			if (method_exists($controller, 'get_blocks_route'))
			{
				$this->route = $controller->get_blocks_route();
			}
		}

		return $this->route;
	}

	public function get_route_info($route)
	{
		if (($routes = $this->cache->get('_block_routes')) === false)
        {
			$sql = 'SELECT * FROM ' . $this->block_routes_table;
			$result = $this->db->sql_query($sql);

			$routes = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$routes[$row['route']] = $row;
			}
			$this->db->sql_freeresult($result);

            $this->cache->put('_block_routes', $routes);
        }

		return (isset($routes[$route])) ? $routes[$route] : (($this->default_route && isset($routes[$this->default_route])) ? $routes[$this->default_route] : array());
	}

	public function clear_blocks_cache()
	{
		if (!empty($this->route))
		{
			$this->cache->destroy('_blocks_' . $this->route);
		}
	}

	public function get_blocks($route, $edit_mode)
	{
        if (($blocks = $this->cache->get('_blocks_' . $route)) === false)
        {
			global $phpbb_container;

			$sql_array = array(
				'SELECT'	=> 'b.*',

				'FROM'	  => array(
					$this->blocks_table			=> 'b',
					$this->block_routes_table	=> 'r',
				),

				'WHERE'	 => "b.route_id = r.route_id
					AND r.route = '" . $this->db->sql_escape($route) . "'" . 
					((!$edit_mode) ? ' AND b.status = 1' : ''),

				'ORDER_BY'  => 'b.position, b.weight ASC',
			);

			$sql = $this->db->sql_build_query('SELECT', $sql_array);
			$result = $this->db->sql_query($sql);

			$blocks = $block_pos = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$block_pos[$row['bid']] = $row['position'];
				$blocks[$row['position']][$row['bid']] = $row;
				$blocks[$row['position']][$row['bid']]['settings'] = array();
			}
			$this->db->sql_freeresult($result);

			$db_settings = $this->get_blocks_config(array_keys($block_pos));

			foreach ($block_pos as $bid => $position)
			{
				$block_service = $blocks[$position][$bid]['name'];
				$block_config = (isset($db_settings[$bid])) ? $db_settings[$bid] : array();

				if ($phpbb_container->has($block_service) === false)
				{
					continue;
				}

				$b = $phpbb_container->get($block_service);
				$df_settings = $b->get_config($block_config);

				if (sizeof($df_settings))
				{
					foreach ($df_settings as $key => $settings)
					{
						if (!is_array($settings))
						{
							continue;
						}
						$default =& $settings['default'];
						$blocks[$position][$bid]['settings'][$key] = (isset($db_settings[$bid][$key])) ? $db_settings[$bid][$key] : $default;
					}
				}
			}

            $this->cache->put('_blocks_' . $route, $blocks);
        }

		return $blocks;
	}
	
	public function get_blocks_config($bids)
	{
		if (!sizeof($bids))
		{
			return array();
		}

        $sql = 'SELECT bid, bvar, bval
            FROM ' . $this->blocks_config_table . '
            WHERE ' . $this->db->sql_in_set('bid', $bids);
        $result = $this->db->sql_query($sql);

        $data = array();
        while ($row = $this->db->sql_fetchrow($result))
        {
            $data[$row['bid']][$row['bvar']] = $row['bval'];
        }
        $this->db->sql_freeresult($result);
    
        return $data;
	}
}
