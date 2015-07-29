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

class manager extends route
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\block_template */
	protected $ptemplate;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	protected $blocks_table;

	/** @var string */
	protected $blocks_config_table;

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
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param \blitze\sitemaker\services\template		$ptemplate				Sitemaker template object
	 * @param string									$root_path				phpBB root path
	 * @param string									$php_ext				phpEx
	 * @param string									$blocks_table			Name of the blocks database table
	 * @param string									$blocks_config_table	Name of the blocks_config database table
	 * @param string									$block_routes_table		Name of the block_routes database table
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, \blitze\sitemaker\services\template $ptemplate, $root_path, $php_ext, $blocks_table, $blocks_config_table, $block_routes_table)
	{
		parent::__construct($cache, $config, $db, $phpbb_container, $request, $user, $php_ext, $block_routes_table);

		$this->cache = $cache;
		$this->db = $db;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->ptemplate = $ptemplate;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->blocks_table = $blocks_table;
		$this->blocks_config_table = $blocks_config_table;
		$this->block_routes_table = $block_routes_table;
	}

	/**
	 * Add a sitemaker block
	 */
	public function add($service, $route)
	{
		if (!$this->block_exists($service))
		{
			return array('errors' => 'BLOCK_NOT_FOUND');
		}

		$position = $this->request->variable('position', '');
		$weight = $this->request->variable('weight', 0);

		$block = $this->phpbb_container->get($service);
		$block->set_template($this->ptemplate);
		$df_settings = $block->get_config(array());

		$block_settings = $this->get_block_settings($df_settings);
		$route_id = (int) $this->get_route_id($route);

		$block_data = array(
			'icon'			=> '',
			'title'			=> '',
			'name'			=> $service,
			'weight'		=> $weight,
			'position'		=> $position,
			'route_id'		=> $route_id,
			'style'			=> (int) $this->style_id,
			'hide_title'	=> false,
			'no_wrap'		=> false,
			'hash'			=> md5(join('', $block_settings)),
		);
		$this->db->sql_query('UPDATE ' . $this->blocks_table . " SET weight = weight + 1 WHERE weight >= $weight AND route_id = $route_id AND style = " . (int) $this->style_id);
		$this->db->sql_query('INSERT INTO ' . $this->blocks_table . ' ' . $this->db->sql_build_array('INSERT', $block_data));

		$block_data['bid'] = $this->db->sql_nextid();
		$block_data['settings'] = $block_settings;

		// update route info
		$this->update_route($route_id, array('has_blocks' => true));

		// get block info and display it
		return array_merge(
			array('id' => $block_data['bid']),
			$block_data,
			$this->display($block, $block_data)
		);
	}

	/**
	 * Update block data
	 */
	public function update($bid, $sql_data)
	{
		if (!$bid)
		{
			return array();
		}

		$this->db->sql_query('UPDATE ' . $this->blocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE bid = ' . (int) $bid);
		$this->cache->destroy('sitemaker_blocks');

		$bdata = $this->get_block_data($bid);
		$db_settings = $this->get_block_config($bid);

		if (!$this->block_exists($bdata['name']))
		{
			return array('errors' => 'BLOCK_NOT_FOUND');
		}

		$block = $this->phpbb_container->get($bdata['name']);
		$df_settings = $block->get_config($db_settings);
		$bdata['settings'] = $this->get_block_settings($df_settings, $db_settings);

		return array_merge(
			$bdata,
			array(
				'id'		=> $bid,
				'message'	=> $this->user->lang['BLOCK_UPDATED'],
			),
			$this->display($block, $bdata)
		);
	}

	/**
	 * Get Edit Form
	 */
	public function edit($bid)
	{
		if (!function_exists('build_multi_select'))
		{
			include($this->root_path . 'ext/blitze/sitemaker/blocks.' . $this->php_ext);
		}

		if (!function_exists('build_cfg_template'))
		{
			include($this->root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		if (!$bid)
		{
			return array('errors' => $this->user->lang['BLOCK_NO_ID']);
		}

		$this->add_block_admin_lang();

		$bdata = $this->get_block_data($bid);
		$db_settings = $this->get_block_config($bid);

		if (!$this->block_exists($bdata['name']))
		{
			return array('errors' => 'BLOCK_NOT_FOUND');
		}

		$block = $this->phpbb_container->get($bdata['name']);
		$block->set_template($this->ptemplate);
		$default_settings = $block->get_config($db_settings);

		return array_merge(
			$bdata,
			array(
				'form'	=> $this->get_edit_form($bdata, $db_settings, $default_settings),
			),
			$this->display($block, $bdata)
		);
	}

	/**
	 * Save Edit Form
	 *
	 * @param	integer		$bid		Block id
	 * @return	array		Return array of all updated blocks
	 */
	public function save($bid)
	{
		if (!function_exists('validate_config_vars'))
		{
			include($this->root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		$settings	= array();
		$bdata		= $this->get_block_data($bid);

		if (!$this->block_exists($bdata['name']))
		{
			return array('errors' => 'BLOCK_NOT_FOUND');
		}

		$block = $this->phpbb_container->get($bdata['name']);
		$block->set_template($this->ptemplate);
		$df_settings = $block->get_config($settings);

		$class = $this->request->variable('class', '');
		$permission_ary = $this->request->variable('permission', array(0));
		$cfg_array = utf8_normalize_nfc($this->request->variable('config', array('' => ''), true));
		$update_similar = $this->request->variable('similar', false);

		$this->get_multi_select($cfg_array, $df_settings);

		$this->add_block_admin_lang();

		$errors = array();
		validate_config_vars($df_settings, $cfg_array, $errors);

		if (sizeof($errors))
		{
			return array('errors' => join("\n", $errors));
		}

		$sql_data = array(
			'permission'	=> implode(',', $permission_ary),
			'class'			=> ($class) ? ' ' . $class : '',
			'hide_title'	=> $this->request->variable('hide_title', 0),
			'status'		=> $this->request->variable('status', 0),
			'type'			=> $this->request->variable('type', 0),
			'no_wrap'		=> $this->request->variable('no_wrap', 0),
			'hash'			=> '',
		);

		$updated_blocks = array();
		if (sizeof($cfg_array))
		{
			$bdata['settings'] = $this->save_settings($bid, $cfg_array, $df_settings);

			$old_hash = $bdata['hash'];
			$new_hash = md5(join('', $bdata['settings']));

			// settings have changed and we want to update similar blocks
			$updated_blocks = $this->update_similar_blocks($update_similar, $bid, $cfg_array, $bdata['settings'], $old_hash, $new_hash);

			$sql_data['hash'] = $new_hash;
		}

		$updated_blocks[$bid] = $this->update($bid, $sql_data);

		return $updated_blocks;
	}

	/**
	 * Save all blocks in layout
	 */
	public function save_layout($route)
	{
		$blocks_ary = $sql_blocks_ary = array();

		$blocks = $this->request->variable('blocks', array(0 => array('' => '')));

		for ($i = 0, $size = sizeof($blocks); $i < $size; $i++)
		{
			$row = $blocks[$i];
			$row['style'] = $this->style_id;
			$blocks_ary[$row['bid']] = $row;
		}

		$current_blocks = $this->get_blocks($route);
		$route_info = $this->get_route_info($route);

		if (sizeof($blocks_ary))
		{
			$sql_blocks_ary = array_intersect_key($current_blocks, $blocks_ary);
			$sql_blocks_ary = array_replace_recursive($sql_blocks_ary, $blocks_ary);
		}

		// Delete all blocks for this route
		$this->delete_blocks(array_keys($current_blocks), false);

		// Remove block settings for deleted blocks
		$removed_blocks = array_keys(array_diff_key($current_blocks, $blocks_ary));
		$this->delete_block_config($removed_blocks);

		// add blocks
		if (sizeof($sql_blocks_ary))
		{
			$this->db->sql_multi_insert($this->blocks_table, array_values($sql_blocks_ary));
		}
		else if (empty($route_info['hide_blocks']) && empty($route_info['ex_positions']))
		{
			$this->delete_route($route_info['route_id']);
		}
		$this->cache->destroy('sitemaker_blocks');

		return array('message' => $this->user->lang['LAYOUT_SAVED']);
	}

	/**
	 * Copy blocks from one route to another
	 */
	public function copy_layout($route, $from_route, $from_style)
	{
		if (!$from_route)
		{
			return array('data' => $this->get_blocks($route));
		}

		// delete all blocks for this route
		$this->delete_blocks_by_route($route, false);

		// copy route settings
		$route_info = $this->copy_route_prefs($route, $from_route, $from_style);

		$route_id	= (int) $route_info['route_id'];
		$style_id	= (int) $route_info['style'];

		// get $from_route blocks
		$from_where = array(
			'b.style = ' . $from_style,
			"r.route = '" . $this->db->sql_escape($from_route) . "'",
		);

		$new_blocks = $this->get_blocks($from_route, 'data', $from_where);

		$db_settings = array();
		$new_blocks = array_values($new_blocks);

		if (sizeof($new_blocks))
		{
			$db_settings = $this->copy_blocks($style_id, $route_id, $new_blocks);
		}
		$this->cache->destroy('sitemaker_blocks');

		return array(
			'data'		=> $this->show_blocks($new_blocks, $db_settings),
			'config'	=> $route_info,
		);
	}

	public function set_style($style_id)
	{
		$this->style_id = (int) $style_id;
	}

	/**
	 * Delete all blocks and routes for a specific style
	 */
	public function delete_blocks_by_style($style_id)
	{
		$this->set_style($style_id);
		$block_ids = $this->get_blocks('', 'id');
		$this->delete_blocks($block_ids);

		// Delete all routes for this style
		$this->db->sql_query('DELETE FROM ' . $this->block_routes_table . ' WHERE style = ' . (int) $style_id);
		$this->cache->destroy('sitemaker_block_routes');
	}

	/**
	 * Delete all blocks for a particular route across styles
	 */
	public function delete_blocks_by_route($route, $update_route = true)
	{
		$block_ids = $this->get_blocks($route, 'id');
		$this->delete_blocks($block_ids);

		// update route info
		if ($update_route)
		{
			$route_info = $this->get_route_info($route);

			$this->set_route_prefs($route, array(
				'hide_blocks'	=> (bool) $route_info['hide_blocks'],
				'ex_positions'	=> $route_info['ex_positions'],
			));
		}
	}

	/**
	 * Delete all instances of a block across styles/routes
	 */
	public function delete_blocks_by_name($service_name)
	{
		$service_name = is_array($service_name) ? $service_name : array($service_name);

		$sql_array = array(
			'SELECT'	=> 'b.bid, b.route_id, b.style, b.weight, b.position',

			'FROM'	  => array(
				$this->blocks_table		=> 'b',
			),

			'WHERE'	 => $this->db->sql_in_set('b.name', $service_name),
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$block_ids = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$style	= (int) $row['style'];
			$route	= (int) $row['route_id'];
			$weight	= (int) $row['weight'];
			$pos	= $this->db->sql_escape($row['position']);

			$block_ids[] = (int) $row['bid'];
			$this->db->sql_query('UPDATE ' . $this->blocks_table . "
				SET weight = weight - 1
				WHERE weight > $weight
					AND style = $style
					AND route_id = $route
					AND position = '$pos'");
		}
		$this->db->sql_freeresult($result);

		$this->delete_blocks($block_ids);
	}

	/**
	 * Check if block exists
	 *
	 * @param	string	$service_name	Service name of block
	 * @return	bool
	 */
	public function block_exists($service_name)
	{
		if (!$this->phpbb_container->has($service_name))
		{
			return false;
		}

		return true;
	}

	/**
	 * Get all blocks for specified route
	 */
	public function get_blocks($route, $return = 'data', $sql_where_array = array())
	{
		$def_sql_where = array(
			'b.style = ' . $this->style_id,
		);

		if ($route)
		{
			$def_sql_where[] = "r.route = '" . $this->db->sql_escape($route) . "'";
		}

		$sql_where = (sizeof($sql_where_array)) ? $sql_where_array : $def_sql_where;

		$sql_array = array(
			'SELECT'	=> 'b.*',

			'FROM'	  => array(
				$this->blocks_table			=> 'b',
				$this->block_routes_table	=> 'r',
			),

			'WHERE'	 => 'b.route_id = r.route_id' . ((sizeof($sql_where)) ? ' AND ' . join(' AND ', $sql_where) : ''),

			'ORDER_BY'  => 'b.style, b.position, b.weight ASC',
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		$blocks = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$blocks[$row['bid']] = $row;
		}
		$this->db->sql_freeresult($result);

		return ($return == 'id') ? array_keys($blocks) : $blocks;
	}

	/**
	 * Generate block configuration fields
	 */
	private function generate_config_fields(&$db_settings, $default_settings)
	{
		foreach ($default_settings as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$this->template->assign_block_vars('options', array(
					'S_LEGEND'	=> $config_key,
					'LEGEND'	=> (isset($this->user->lang[$vars])) ? $this->user->lang[$vars] : $vars)
				);

				continue;
			}

			$db_settings[$config_key] = (isset($db_settings[$config_key])) ? $db_settings[$config_key] : $vars['default'];

			$content = $this->get_config_field($config_key, $db_settings, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (!empty($vars['lang'])) ? ((isset($this->user->lang[$vars['lang']])) ? $this->user->lang[$vars['lang']] : $vars['lang']) : '',
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $vars['lang_explain'],
				'CONTENT'		=> $content)
			);
			unset($default_settings[$config_key]);
		}
	}

	private function get_config_field($config_key, &$db_settings, &$vars)
	{
		$l_explain = '';
		if (!empty($vars['explain']))
		{
			if (isset($vars['lang_explain']))
			{
				$l_explain = (isset($this->user->lang[$vars['lang_explain']])) ? $this->user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else
			{
				$l_explain = (isset($this->user->lang[$vars['lang'] . '_EXPLAIN'])) ? $this->user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}
		}

		$vars['lang_explain'] = $l_explain;

		if (!empty($vars['append']))
		{
			$vars['append'] = (isset($this->user->lang[$vars['append']])) ? $this->user->lang[$vars['append']] : $vars['append'];
		}

		$type = $this->get_field_type($config_key, $db_settings, $vars);

		return build_cfg_template($type, $config_key, $db_settings, $config_key, $vars);
	}

	private function get_field_type($config_key, &$db_settings, &$vars)
	{
		$type = explode(':', $vars['type']);

		if (in_array($type[0], array('checkbox', 'multi_select', 'select')))
		{
			// this looks bad but its the only way without modifying phpbb code
			// this is for select items that do not need to be translated
			$options = $vars['params'][0];
			$this->add_lang_vars($options);
		}

		switch ($type[0])
		{
			case 'select':
				$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : 'build_select';
			break;
			case 'checkbox':
			case 'multi_select':
				$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : (($type[0] == 'checkbox') ? 'build_checkbox' : 'build_multi_select');
				$vars['params'][] = $config_key;
				$type[0] = 'custom';

				if (!empty($db_settings[$config_key]))
				{
					$db_settings[$config_key] = explode(',', $db_settings[$config_key]);
				}
			break;
			case 'hidden':
				$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : 'build_hidden';
				$vars['explain'] = '';
				$type[0] = 'custom';
			break;
		}

		return $type;
	}

	private function add_lang_vars($options)
	{
		foreach ($options as $title)
		{
			if (is_array($title))
			{
				$this->add_lang_vars($title);
			}
			else if (!isset($this->user->lang[$title]))
			{
				$this->user->lang[$title] = $title;
			}
		}
	}

	private function get_block_data($bid)
	{
		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_table . ' WHERE bid = ' . (int) $bid);

		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	private function get_block_config($bid, $raw = false)
	{
		$ids = (is_array($bid)) ? $bid : array($bid);

		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', $ids));

		$bconfig = $data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[] = $row;
			$bconfig[$row['bid']][$row['bvar']] = $row['bval'];
		}
		$this->db->sql_freeresult($result);

		return ($raw === false) ? ((!is_array($bid) && sizeof($bconfig)) ? array_shift($bconfig) : $bconfig) : $data;
	}

	private function copy_route_prefs($route, $from_route, $from_style)
	{
		$new_route_info = $this->get_route_info($from_route, $from_style, false);
		$route_info = $this->get_route_info($route, 0, (sizeof($new_route_info)) ? true : false);

		// copy route prefs
		$route_info['has_blocks'] = $new_route_info['has_blocks'];
		$route_info['hide_blocks'] = $new_route_info['hide_blocks'];
		$route_info['ex_positions'] = $new_route_info['ex_positions'];

		$this->update_route($route_info['route_id'], $route_info);

		return $route_info;
	}

	private function copy_blocks($style_id, $route_id, $new_blocks)
	{
		// get max block id
		$sql = 'SELECT bid FROM ' . $this->blocks_table . ' ORDER BY bid DESC';
		$result = $this->db->sql_query_limit($sql, 1);
		$bid = $this->db->sql_fetchfield('bid');
		$this->db->sql_freeresult($result);

		$mapped_ids = array();
		for ($i = 0, $size = sizeof($new_blocks); $i < $size; $i++)
		{
			$mapped_ids[$new_blocks[$i]['bid']] = ++$bid;

			$new_blocks[$i]['bid'] = $bid;
			$new_blocks[$i]['style'] = (int) $style_id;
			$new_blocks[$i]['route_id'] = (int) $route_id;
		}

		$settings = $this->copy_blocks_config($mapped_ids);
		$this->db->sql_multi_insert($this->blocks_table, $new_blocks);

		return $settings;
	}

	private function copy_blocks_config($mapped_ids)
	{
		$new_blocks_config = $this->get_block_config(array_keys($mapped_ids), true);

		$db_settings = array();
		if (sizeof($new_blocks_config))
		{
			$sql_new_config = array();
			for ($i = 0, $size = sizeof($new_blocks_config); $i < $size; $i++)
			{
				$row = $new_blocks_config[$i];
				$row['bid'] = (int) $mapped_ids[$row['bid']];
				$sql_new_config[] = $row;
				$db_settings[$row['bid']][$row['bvar']] = $row['bval'];
			}

			$this->db->sql_multi_insert($this->blocks_config_table, $sql_new_config);
		}

		return $db_settings;
	}

	private function get_block_settings($df_settings, $db_settings = array())
	{
		foreach ($df_settings as $key => $settings)
		{
			if (!is_array($settings))
			{
				continue;
			}

			$db_settings[$key] = (isset($db_settings[$key])) ? $db_settings[$key] : $settings['default'];

			$type = explode(':', $settings['type']);
			if ($db_settings[$key] && ($type[0] == 'checkbox' || $type[0] == 'multi_select'))
			{
				$db_settings[$key] = explode(',', $db_settings[$key]);
			}
		}

		return $db_settings;
	}

	private function delete_block_config($bid)
	{
		$bid = (is_array($bid)) ? $bid : array($bid);

		if (!sizeof($bid))
		{
			return;
		}

		$this->db->sql_query('DELETE FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', $bid));
	}

	private function delete_blocks($block_ids, $delete_config = true)
	{
		$block_ids = array_filter((is_array($block_ids)) ? $block_ids : array($block_ids));

		if (!sizeof($block_ids))
		{
			return;
		}

		$sql = 'DELETE FROM ' . $this->blocks_table . ' WHERE ' . $this->db->sql_in_set('bid', $block_ids);
		$this->db->sql_query($sql);

		if ($delete_config === true)
		{
			$this->delete_block_config($block_ids);
		}

		$this->cache->destroy('sitemaker_blocks');
	}

	private function display($block, $settings)
	{
		$block->set_template($this->ptemplate);
		$data = $block->display($settings, true);

		return array(
			'title'		=> (!empty($settings['title'])) ? $settings['title'] : ((isset($this->user->lang[$data['title']])) ? $this->user->lang[$data['title']] : $data['title']),
			'content'	=> (!empty($data['content'])) ? $data['content'] : $this->user->lang['BLOCK_NO_DATA']
		);
	}

	private function get_groups($mode = 'data', $selected = '')
	{
		if (!is_array($selected))
		{
			$selected = explode(',', $selected);
		}

		$sql = 'SELECT group_id, group_name, group_type
			FROM ' . GROUPS_TABLE;
		$result = $this->db->sql_query($sql);

		$data = array();
		$selected = array_filter($selected);
		$options = '<option value="0"' . ((!sizeof($selected)) ? ' selected="selected"' : '') . '>' . $this->user->lang['ALL'] . '</option>';

		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected_option = (in_array($row['group_id'], $selected)) ? ' selected="selected"' : '';
			$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang['G_' . $row['group_name']] : ucfirst($row['group_name']);

			$data[$row['group_id']] = $group_name;
			$options .= '<option' . (($row['group_type'] == GROUP_SPECIAL) ? ' class="sep"' : '') . ' value="' . $row['group_id'] . '"' . $selected_option . '>' . $group_name . '</option>';
		}
		$this->db->sql_freeresult($result);

		return ($mode == 'data') ? $data : $options;
	}

	private function update_similar_blocks($update_similar, $block_id, $cfg_array, $settings, $old_hash, $new_hash)
	{
		if (!$update_similar || $new_hash === $old_hash)
		{
			return array();
		}

		// grab all blocks with same settings
		$similar_blocks = $this->get_blocks('', 'data', array(
			'b.bid <> ' . (int) $block_id,
			"b.hash = '" . $this->db->sql_escape($old_hash) . "'",
		));

		if (!sizeof($similar_blocks))
		{
			return array();
		}

		$blocks = array();
		foreach ($similar_blocks as $bid => $block)
		{
			if ($this->block_exists($block['name']))
			{
				$this->save_settings($bid, $cfg_array, $settings);
				$blocks[$bid] = $this->update($bid, array(
					'hash'	=> $new_hash
				));
			}
		}

		return $blocks;
	}

	private function save_settings($bid, $cfg_array, $df_settings)
	{
		$cfg_array = array_intersect_key($cfg_array, $df_settings);

		$sql_ary = $settings = array();
		foreach ($cfg_array as $var => $val)
		{
			$sql_ary[] = array(
				'bid'		=> $bid,
				'bvar'		=> $var,
				'bval'		=> $val,
			);

			settype($val, gettype($df_settings[$var]['default']));
			$settings[$var] = $val;
		}

		// just remove old values and replace
		$this->delete_block_config($bid);
		$this->db->sql_multi_insert($this->blocks_config_table, $sql_ary);

		/**
		 * This is used by blocks that cache their own data.
		 *
		 * Set hidden field in block config called 'cache_name' with the name of the cache
		 * The cache will be cleared everytime the block is settings are changed
		 */
		if (isset($df_settings['cache_name']))
		{
			$this->cache->destroy($df_settings['cache_name']);
		}

		return $settings;
	}

	private function get_multi_select(&$cfg_array, $df_settings)
	{
		$multi_select = utf8_normalize_nfc($this->request->variable('config', array('' => array('' => ''))));

		$multi_select = array_filter($multi_select);

		foreach ($multi_select as $key => $values)
		{
			$cfg_array[$key] = array_filter($values, 'strlen');
			$cfg_array[$key] = (sizeof($cfg_array[$key])) ? join(',', $cfg_array[$key]) : $df_settings[$key]['default'];
		}
	}

	private function get_edit_form(&$bdata, $db_settings, $default_settings)
	{
		$this->generate_config_fields($db_settings, $default_settings);

		$bdata['settings'] = $db_settings;
		$bdata['no_wrap'] = (bool) $bdata['no_wrap'];
		$bdata['hide_title'] = (bool) $bdata['hide_title'];

		$this->template->assign_vars(array(
			'S_ACTIVE'		=> $bdata['status'],
			'S_TYPE'		=> $bdata['type'],
			'S_NO_WRAP'		=> $bdata['no_wrap'],
			'S_HIDE_TITLE'	=> $bdata['hide_title'],
			'S_BLOCK_CLASS'	=> trim($bdata['class']),
			'S_GROUP_OPS'	=> $this->get_groups('options', $bdata['permission']))
		);

		$this->template->set_filenames(array(
			'block_settings' => 'block_settings.html',
		));

		return $this->template->assign_display('block_settings');
	}

	private function show_blocks($blocks, $db_settings)
	{
		$data = array();
		for ($i = 0, $size = sizeof($blocks); $i < $size; $i++)
		{
			$row = $blocks[$i];
			$bid = $row['bid'];
			$db_settings[$bid] = (isset($db_settings[$bid])) ? $db_settings[$bid] : array();

			$block = $this->phpbb_container->get($row['name']);
			$df_settings = $block->get_config($db_settings[$bid]);
			$row['settings'] = $this->get_block_settings($df_settings, $db_settings[$bid]);

			$data[$row['position']][] = array_merge(
				array(
					'id'			=> $row['bid'],
					'icon'			=> $row['icon'],
					'class'			=> $row['class'],
					'status'		=> (bool) $row['status'],
					'no_wrap'		=> (bool) $row['no_wrap'],
					'hide_title'	=> (bool) $row['hide_title'],
				),
				$this->display($block, $row)
			);
		}

		return $data;
	}
}
