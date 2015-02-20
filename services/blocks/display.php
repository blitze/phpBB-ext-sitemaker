<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services\blocks;

use Symfony\Component\DependencyInjection\Container;

class display
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\core\services\util */
	protected $primetime;

	/** @var \primetime\core\services\template */
	protected $ptemplate;

	/** @var bool */
	private $is_subpage;

	/** @var string */
	private $default_route;

	/** @var string */
	public $route;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth					Auth object
	 * @param \phpbb\cache\service						$cache					Cache object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param Container									$phpbb_container		Service container
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param \primetime\core\services\util				$primetime				Primetime object
	 * @param \primetime\core\services\template			$ptemplate				Primetime template object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, Container $phpbb_container, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, \primetime\core\services\util $primetime, \primetime\core\services\template $ptemplate)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->primetime = $primetime;
		$this->ptemplate = $ptemplate;
	}

	public function show()
	{
		$this->primetime->add_assets(array(
			'css'   => array(
				$this->primetime->asset_path . 'ext/primetime/core/components/fontawesome/css/font-awesome.min.css',
			)
		));

		$this->template->assign_var('L_INDEX', $this->user->lang['HOME']);

		$offlimits = array('ucp.php', 'mcp.php', 'memberlist.php');
		if ($this->user->page['page_dir'] == 'adm' || in_array($this->user->page['page_name'], $offlimits))
		{
			return;
		}

		$edit_mode = $this->request->variable('edit_mode', false);

		$route = $this->get_route();
		$style_id = $this->get_style_id();
		$this->default_route = $this->config['primetime_default_layout'];
		$route_info = $this->get_route_info($route, $style_id, $edit_mode);

		if ($this->is_subpage === false)
		{
			$show_block = array(
				SHOW_BLOCK_BOTH		=> true,
				SHOW_BLOCK_LANDING	=> true,
				SHOW_BLOCK_SUBPAGE	=> false,
			);
		}
		else
		{
			$show_block = array(
				SHOW_BLOCK_BOTH		=> true,
				SHOW_BLOCK_LANDING	=> false,
				SHOW_BLOCK_SUBPAGE	=> true,
			);
		}

		$u_edit_mode = '';
		if ($this->auth->acl_get('a_manage_blocks'))
		{
			if ($edit_mode)
			{
				$show_block = array(
					SHOW_BLOCK_BOTH		=> true,
					SHOW_BLOCK_LANDING	=> true,
					SHOW_BLOCK_SUBPAGE	=> true,
				);

				$this->phpbb_container->get('primetime.core.blocks.builder')->handle($route_info);
			}
			else
			{
				$u_edit_mode = append_sid(generate_board_url() . '/' . ltrim(rtrim(build_url(array('edit_mode', 'style')), '?'), './../'), 'edit_mode=1');
			}
		}
		else
		{
			$edit_mode = false;
		}

		$blocks = $this->get_blocks($route_info, $style_id, $edit_mode);
		$users_groups = $this->get_users_groups();
		$ex_positions = array_flip($route_info['ex_positions']);

		$blocks_per_position = array();
		foreach ($blocks as $position => $blocks_ary)
		{
			$pos_count_key = 's_' . $position . '_count';
			$blocks_per_position[$pos_count_key] = 0;

			if ($edit_mode === false && isset($ex_positions[$position]))
			{
				continue;
			}

			$blocks_ary = array_values($blocks_ary);
			for ($i = 0, $size = sizeof($blocks_ary); $i < $size; $i++)
			{
				$row = $blocks_ary[$i];
				$allowed_groups = explode(',', $row['permission']);
				$block_service = $row['name'];

				if ($show_block[$row['type']] && $this->phpbb_container->has($block_service) && (!$row['permission'] || sizeof(array_intersect($allowed_groups, $users_groups))))
				{
					$b = $this->phpbb_container->get($block_service);
					$b->set_template($this->ptemplate);
					$block = $b->display($row, $edit_mode);

					if (empty($block['content']))
					{
						if ($edit_mode && isset($block['title']))
						{
							$block['content'] = $this->user->lang['BLOCK_NO_DATA'];
						}
						else
						{
							continue;
						}
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
				'S_HAS_BLOCKS'		=> sizeof($blocks),
				'U_EDIT_MODE'		=> $u_edit_mode,
			),
			array_change_key_case($blocks_per_position, CASE_UPPER))
		);
	}

	public function get_style_id()
	{
		if ($this->request->is_set('style'))
		{
			$style_id = $this->request->variable('style', 0);
		}
		else
		{
			$style_id = (!$this->config['override_user_style']) ? $this->user->data['user_style'] : $this->config['default_style'];
		}

		return $style_id;
	}

	public function get_route()
	{
		// let's stay consistent, whether mod rewrite is being used or not
		$user_page = ltrim($this->user->page['page_name'], 'app.php');
		$controller_service = explode(':', $this->phpbb_container->get('symfony_request')->attributes->get('_controller'));

		$this->route = $user_page;
		$this->is_subpage = false;

		if (!empty($controller_service[0]) && $this->phpbb_container->has($controller_service[0]))
		{
			$this->route = join('/', array_slice(explode('/', $this->route), 0, 3));

			if (str_replace($this->route, '', $user_page))
			{
				$this->is_subpage = true;
			}
		}

		return $this->route;
	}

	public function get_route_info($route, $style_id, $edit_mode = false)
	{
		$default_info = array(
			'route_id'		=> 0,
			'route'			=> $route,
			'style'			=> $style_id,
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
			'has_blocks'	=> false,
		);

		if (($route_info = $this->cache->get('primetime_block_routes')) === false)
		{
			$sql = 'SELECT *
				FROM ' . PT_BLOCK_ROUTES_TABLE;
			$result = $this->db->sql_query($sql);

			$route_info = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$row['ex_positions'] = array_filter(explode(',', $row['ex_positions']));
				$route_info[$row['style']][$row['route']] = $row;
			}
			$this->db->sql_freeresult($result);

			$this->cache->put('primetime_block_routes', $route_info);
		}

		$route_info = (isset($route_info[$style_id][$route])) ? $route_info[$style_id][$route] : (($edit_mode === false && $this->default_route && isset($route_info[$style_id][$this->default_route])) ? $route_info[$style_id][$this->default_route] : $default_info);

		return $route_info;
	}

	public function clear_blocks_cache()
	{
		$this->cache->destroy('primetime_blocks');
	}

	public function get_blocks($route_info, $style_id, $edit_mode)
	{
		if (($blocks = $this->cache->get('primetime_blocks')) === false || $edit_mode)
		{
			$sql_array = array(
				'SELECT'	=> 'b.*, r.route_id',

				'FROM'	  => array(
					PT_BLOCKS_TABLE			=> 'b',
					PT_BLOCK_ROUTES_TABLE	=> 'r',
				),

				'WHERE'	 => 'b.route_id = r.route_id' .
					((!$edit_mode) ? ' AND b.status = 1' : ' AND r.style = ' . (int) $style_id),

				'ORDER_BY'  => 'b.style, b.position, b.weight ASC',
			);

			$sql = $this->db->sql_build_query('SELECT', $sql_array);
			$result = $this->db->sql_query($sql);

			$blocks = $block_ids = $block_pos = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$block_ids[] = $row['bid'];
				$block_pos[$row['style']][$row['route_id']][$row['bid']] = $row['position'];
				$blocks[$row['style']][$row['route_id']][$row['position']][$row['bid']] = $row;
				$blocks[$row['style']][$row['route_id']][$row['position']][$row['bid']]['settings'] = array();
			}
			$this->db->sql_freeresult($result);

			$db_settings = array();
			if (sizeof($block_ids))
			{
				$sql_where = $this->db->sql_in_set('bid', $block_ids);
				$db_settings = $this->get_blocks_config($sql_where);
			}

			foreach ($block_pos as $style => $routes)
			{
				foreach($routes as $route_id => $positions)
				{
					foreach ($positions as $bid => $position)
					{
						$block_service = $blocks[$style][$route_id][$position][$bid]['name'];
						$block_config = (isset($db_settings[$bid])) ? $db_settings[$bid] : array();

						if ($this->phpbb_container->has($block_service) === false)
						{
							continue;
						}

						$b = $this->phpbb_container->get($block_service);
						$b->set_template($this->ptemplate);
						$df_settings = $b->get_config($block_config);

						if (sizeof($df_settings))
						{
							foreach ($df_settings as $key => $settings)
							{
								if (!is_array($settings))
								{
									continue;
								}

								$type = explode(':', $settings['type']);
								$db_settings[$bid][$key] = (isset($db_settings[$bid][$key])) ? $db_settings[$bid][$key] : $settings['default'];

								if ($db_settings[$bid][$key] && ($type[0] == 'checkbox' || $type[0] == 'multi_select'))
								{
									$db_settings[$bid][$key] = explode(',', $db_settings[$bid][$key]);
								}
								$blocks[$style][$route_id][$position][$bid]['settings'][$key] = $db_settings[$bid][$key];
							}
						}
					}
				}
			}

			if (!$edit_mode)
			{
				$this->cache->put('primetime_blocks', $blocks);
			}
		}

		$route_id = $route_info['route_id'];
		if ($edit_mode === false && !$route_info['has_blocks'])
		{
			$default_route = $this->get_route_info($this->default_route, $style_id, $edit_mode);
			$route_id = $default_route['route_id'];
		}

		$blocks = (isset($blocks[$style_id][$route_id]) && !$route_info['hide_blocks']) ? $blocks[$style_id][$route_id] : array();

		return $blocks;
	}

	public function get_blocks_config($sql_where = array())
	{
		$sql = 'SELECT bid, bvar, bval
			FROM ' . PT_BLOCKS_CONFIG_TABLE .
			(($sql_where) ? ' WHERE ' . $sql_where : '');
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[$row['bid']][$row['bvar']] = $row['bval'];
		}
		$this->db->sql_freeresult($result);

		return $data;
	}

	public function get_users_groups()
	{
		$sql = 'SELECT group_id
            FROM ' . USER_GROUP_TABLE . '
            WHERE user_id = ' . (int) $this->user->data['user_id'];
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[$row['group_id']] = $row['group_id'];
		}
		$this->db->sql_freeresult($result);

		return $data;
	}
}
