<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\controller;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

// This is required for all controllers
use Symfony\Component\HttpFoundation\Response;

/**
*
*/
class blocks_admin
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
	* Template object for primetime blocks
	* @var \primetime\primetime\core\block_template
	*/
	protected $btemplate;

	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

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
	* Name of the block_positions database table
	* @var string
	*/
	private $block_positions_table;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth					$auth					Auth object
	* @param \phpbb\cache\service				$cache					Cache object
	* @param \phpbb\db\driver\driver			$db						Database object
	* @param \phpbb\request\request_interface	$request 				Request object
	* @param \phpbb\template\template			$template				Template object
	* @param \primetime\primetime\core\blocks\template	$btemplate				Primetime template object
	* @param \phpbb\user                		$user       			User object
	* @param string								$blocks_table			Name of the blocks database table
	* @param string								$blocks_config_table	Name of the blocks_config database table
	* @param string								$block_positions_table	Name of the block_positions database table
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface  $cache, \phpbb\db\driver\driver $db, \phpbb\request\request_interface $request, \phpbb\template\template $template, \primetime\primetime\core\blocks\template $btemplate, \phpbb\user $user, $blocks_table, $blocks_config_table, $block_positions_table)
	{
		$this->db = $db;
		$this->auth = $auth;
		$this->cache = $cache;
		$this->user = $user;
		$this->request = $request;
		$this->template = $template;
		$this->btemplate = $btemplate;
		$this->blocks_table = $blocks_table;
		$this->blocks_config_table = $blocks_config_table;
		$this->block_positions_table = $block_positions_table;

		$this->user->add_lang_ext('primetime/primetime', 'admin');

		$this->def_icon = '-icon-check-empty';
		$this->return_data = array(
			'id'		=> '',
			'title'		=> '',
			'content'   => '',
			'message'   => '',
			'errors'	=> array(),
		);
	}

	public function handle($action, $id, $block)
	{
		if (!$this->auth->acl_get('a_manage_blocks') || $this->request->is_ajax() === false)
		{
			$this->return_data['message'] = $this->user->lang['NOT_AUTHORIZED'];
			return new Response(json_encode($this->return_data));
		}

		$id = $this->request->variable('id', 0);
		$block = $this->request->variable('block', '');
		$this->route = $this->request->variable('route', '');

		switch ($action)
		{
			case 'add':
				$this->add($block);
			break;
			case 'copy':
				$this->copy();
			break;
			case 'edit':
				$this->edit($id);
			break;
			case 'save':
				$this->save($id);
			break;
			case 'update':
				$data = array(
					'title'	=> ucwords(trim($this->request->variable('title', ''))),
					'icon'	=> $this->request->variable('icon', ''),
				);
				$this->update($id, array_filter($data));
			break;
			case 'save_layout':
				$this->save_layout();
			break;
		}

		if ($action !== 'edit')
		{
			$this->cache->destroy('_blocks_' . $this->route);
		}

		$this->return_data['errors'] = implode("\n", $this->return_data['errors']);
		return new Response(json_encode($this->return_data));
	}

	/**
	* Add a primetime block
	*
	* @return array
	*/
	public function add($service)
	{
		global $phpbb_container;

		$position = $this->request->variable('position', '');
		$weight = $this->request->variable('weight', 0);

		$block = array();
		$positions_ary = $this->get_positions();

		if (!$phpbb_container->has($service))
		{
			$this->return_data['errors'][] = $this->user->lang['BLOCK_NOT_FOUND'];
			return;
		}

		$block_data = array(
			'icon'		=> '',
			'title'		=> '',
			'name'		=> $service,
			'weight'	=> $weight,
			'position'	=> (isset($positions_ary[$position])) ? $positions_ary[$position] : $this->add_position($position),
			'route'		=> $this->route,
		);
		$this->db->sql_query('INSERT INTO ' . $this->blocks_table . ' ' . $this->db->sql_build_array('INSERT', $block_data));

		$b = $phpbb_container->get($service);
		$bconfig = $b->get_config();
		$b->set_template($this->btemplate);

		foreach ($bconfig as $key => $settings)
		{
			if (!is_array($settings))
			{
				continue;
			}
			$block_data['settings'][$key] =& $settings['default'];
		}

		$this->return_data = array_merge($this->return_data,
			array('id' => $this->db->sql_nextid()),
			$b->display($block_data, true)
		);
	}

	/**
	* 
	*/
	public function edit($bid)
	{
		global $phpbb_container, $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_acp.' . $phpEx);

		if (!$bid)
		{
			$this->return_data['errors'][] = $this->user->lang['BLOCK_NO_ID'];
			return;
		}

		$bdata = $this->get_block_data($bid);
		$db_config = $this->get_block_config($bid);

		$this->template->assign_vars(array(
			'S_ACTIVE'		=> $bdata['status'],
			'S_NO_WRAP'		=> $bdata['no_wrap'],
			'S_HIDE_TITLE'	=> $bdata['hide_title'],
			'S_BLOCK_CLASS'	=> trim($bdata['class']))
		);

		if (!$phpbb_container->has($bdata['name']))
		{
			$this->return_data['errors'][] = $this->user->lang['BLOCK_NOT_FOUND'];
			return;
		}

		$b = $phpbb_container->get($bdata['name']);
		$default_settings = $b->get_config();
		$b->set_template($this->btemplate);

		// Output relevant settings
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
					'LEGEND'	=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $db_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content)
			);

			$bdata['settings'][$config_key] = (isset($db_config[$config_key])) ? $db_config[$config_key] : $vars['default'];
			unset($default_settings[$config_key]);
		}

		$this->template->assign_vars(array(
			'S_GROUP_OPS'	=> $this->get_groups('options', $bdata['permission']))
		);

		$this->template->set_filenames(array(
			'block_settings' => 'block_settings.html',
		));

		$block = $b->display($bdata, true);
		$this->return_data = array_merge($this->return_data, $bdata, array(
			'icon'		=> ($bdata['icon']) ? $bdata['icon'] : $this->def_icon,
			'title'		=> ($bdata['title']) ? $bdata['title'] : $block['title'],
			'form'		=> $this->template->assign_display('block_settings'),
			'content'	=> $block['content'],
		));
	}

	public function save($bid)
	{
		global $phpbb_container, $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_acp.' . $phpEx);

		$bdata = $this->get_block_data($bid);

		if (!$phpbb_container->has($bdata['name']))
		{
			$this->return_data['errors'][] = $this->user->lang['BLOCK_NOT_FOUND'];
			return;
		}

		$b = $phpbb_container->get($bdata['name']);
		$settings = $b->get_config($bdata);
		$b->set_template($this->btemplate);

		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc($this->request->variable('config', array('' => ''), true)) : $bconfig;

		$error = array();
		$this->return_data['id'] = $bdata['bid'];

		validate_config_vars($settings, $cfg_array, $error);

		if (sizeof($error))
		{
			$this->return_data['errors'] += $error;
			return;
		}

		$class = $this->request->variable('class', '');
		$permission_ary = $this->request->variable('permission', array(0));

		$sql_data = array(
			'permission'	=> implode(',', $permission_ary),
			'class'			=> ($class) ? ' ' . $class : '',
			'hide_title'	=> $this->request->variable('hide_title', 0),
			'status'		=> $this->request->variable('status', 0),
			'no_wrap'		=> $this->request->variable('no_wrap', 0),
		);
		$this->update($bid, $sql_data);

		if (is_array($cfg_array) && sizeof($cfg_array))
		{
			$sql_ary = array();
			foreach ($cfg_array as $var => $val)
			{
				$bdata['settings'][$var] = $val;
				$sql_ary[] = array(
					'bid'		=> $bid,
					'bvar'		=> $var,
					'bval'		=> $val,
				);
			}

			// just remove old values and replace
			$this->delete_block_config($bid);
			$this->db->sql_multi_insert($this->blocks_config_table, $sql_ary);
		}

		$block = $b->display($bdata, true);

		$this->return_data['title']		= ($bdata['title']) ? $bdata['title'] : $block['title'];
		$this->return_data['content']	= $block['content'];
		$this->return_data['message']	= $this->user->lang['BLOCK_UPDATED'];
	}

	/**
	* 
	*/
	public function update($id, $sql_data)
	{
		$this->db->sql_query('UPDATE ' . $this->blocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE bid = ' . (int) $id);

		$this->return_data = array_merge($this->return_data,
			$sql_data,
			array(
				'id'		=> $id,
			)
		);
	}

	/**
	* 
	*/
	public function save_layout()
	{
		$block_ids = $blocks_ary = $removed_blocks = $sql_data_ary = array();

		$blocks = $this->request->variable('blocks', array(0 => array('' => '')));

		$positions_ary = $this->get_positions();

		for ($i = 0, $size = sizeof($blocks); $i < $size; $i++)
		{
			$row = $blocks[$i];
			$row['position'] = (isset($positions_ary[$row['position']])) ? $positions_ary[$row['position']] : $this->add_position($row['position']);
			$blocks_ary[$row['bid']] = $row;
		}

		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_table . " WHERE route = '" . $this->db->sql_escape($this->route) . "'");

		while ($row = $this->db->sql_fetchrow($result))
		{
			$block_ids[] = $row['bid'];
			if (isset($blocks_ary[$row['bid']]))
			{
				$sql_data_ary[] = array_merge($row, $blocks_ary[$row['bid']]);
			}
			else
			{
				$removed_blocks[] = $row['bid'];
			}
		}
		$this->db->sql_freeresult($result);

		// Delete all blocks for this route
		$this->delete_blocks($block_ids, false);

		// Remove block settings for deleted blocks
		$this->delete_block_config($removed_blocks);

		// add blocks
		$this->db->sql_multi_insert($this->blocks_table, $sql_data_ary);

		$this->return_data['message'] = $this->user->lang['LAYOUT_SAVED'];
	}

	public function copy()
	{
		global $phpbb_container;

		$copy_from = $this->request->variable('copy', '');

		if (!$copy_from)
		{
			$this->return_data['data'] = $this->get_blocks($this->route);
			return;
		}

		$old_blocks = $this->get_blocks($this->route, 'id');
		$new_blocks = $this->get_blocks($copy_from, 'data');
		$this->delete_blocks($old_blocks);

		// get max block id
		$sql = 'SELECT bid FROM ' . $this->blocks_table . ' ORDER BY bid DESC';
		$result = $this->db->sql_query_limit($sql, 1);
		$bid = $this->db->sql_fetchfield('bid');
		$this->db->sql_freeresult($result);

		$sql_blocks = $mapped_ids = array();
		for ($i = 0, $size = sizeof($new_blocks); $i < $size; $i++)
		{
			$row = $new_blocks[$i];
			$mapped_ids[$row['bid']] = $bid++;

			$sql_blocks[] = array(
				'bid'			=> $bid,
				'icon'			=> $row['icon'],
				'name'			=> $row['name'],
				'title'			=> $row['title'],
				'route'			=> $this->route,
				'position'		=> $row['position'],
				'weight'		=> $row['weight'],
				'style'			=> $row['style'],
				'permission'	=> $row['permission'],
				'class'			=> $row['class'],
				'status'		=> $row['status'],
				'no_wrap'		=> $row['no_wrap'],
				'hide_title'	=> $row['hide_title'],
			);
		}

		if (sizeof($sql_blocks))
		{
			$this->db->sql_multi_insert($this->blocks_table, $sql_blocks);
		}

		$sql = 'SELECT * FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', array_keys($mapped_ids));
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$row['bid'] = (int) $mapped_ids[$row['bid']];
			$sql_blocks_config_ary[$row['bid']] = $row;
		}
		$this->db->sql_freeresult($result);

		if (sizeof($sql_blocks_config_ary))
		{
			$this->db->sql_multi_insert($this->blocks_config_table, array_values($sql_blocks_config_ary));
		}

		// Now let's select the new blocks and return data
		$sql = 'SELECT b.*, p.pname
			FROM ' . $this->blocks_table . ' b, ' . $this->block_positions_table . " p
			WHERE b.position = p.pid
				AND b.route = '" . $this->db->sql_escape($this->route) . "'
			ORDER BY p.pname, b.weight ASC";
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$b = $phpbb_container->get($row['name']);
			$df_settings = $b->get_config();
			
			foreach ($df_settings as $key => $settings)
			{
				if (!is_array($settings))
				{
					continue;
				}
				$default =& $settings['default'];
				$row['settings'][$key] = (isset($sql_blocks_config_ary[$bid][$key])) ? $db_settsql_blocks_config_aryings[$bid][$key] : $default;
			}
			
			$b->set_template($this->btemplate);
			$block = $b->display($row, true);

			$data[$row['pname']][] = array(
				'id'			=> $row['bid'],
				'icon'			=> ($row['icon']) ? $row['icon'] : $this->def_icon,
				'title'			=> ($row['title']) ? $row['title'] : $block['title'],
				'class'			=> $row['class'],
				'no_wrap'		=> $row['no_wrap'],
				'hide_title'	=> $row['hide_title'],
				'content'		=> $block['content'],
			);
		}

		$this->return_data['data'] = $data;
	}

	private function get_blocks($route, $return = 'data')
	{
		$sql = 'SELECT * FROM ' . $this->blocks_table . " WHERE route = '" . $this->db->sql_escape($route) . "' ORDER BY position, weight ASC";
		$result = $this->db->sql_query($sql);

		// delete all blocks for this routeORDER BY position, weight ASC
		$blocks = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$blocks[$row['bid']] = $row;
		}
		$this->db->sql_freeresult($result);

		return ($return == 'id') ? array_keys($blocks) : array_values($blocks);
	}

	private function add_position($position)
	{
		$position_data = array(
			'pname'	  => $position,
		);
		$this->db->sql_query('INSERT INTO ' . $this->block_positions_table . ' ' . $this->db->sql_build_array('INSERT', $position_data));

		return $this->db->sql_nextid();
	}

	private function get_positions()
	{
		$result = $this->db->sql_query('SELECT pid, pname FROM ' . $this->block_positions_table);

		$positions_ary = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$positions_ary[$row['pname']] = $row['pid'];
		}
		$this->db->sql_freeresult($result);

		return $positions_ary;
	}

	private function get_block_data($bid)
	{
		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_table . ' WHERE bid = ' . (int) $bid);

		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	private function get_block_config($bid)
	{
		$result = $this->db->sql_query('SELECT * FROM ' . $this->blocks_config_table . ' WHERE bid = ' . (int) $bid);

		$bconfig = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bconfig[$row['bvar']] = $row['bval'];
		}
		$this->db->sql_freeresult($result);

		return $bconfig;
	}

	private function delete_block_config($bid)
	{
		if (!is_array($bid))
		{
			$bid = array($bid);
		}

		$bid = array_filter($bid);

		if (!sizeof($bid))
		{
			return;
		}

		$this->db->sql_query('DELETE FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', $bid));
	}

	private function delete_blocks($block_ids, $delete_config = true)
	{
		if (!is_array($block_ids))
		{
			$block_ids = array($block_ids);
		}

		$block_ids = array_filter($block_ids);
		if (!sizeof($block_ids))
		{
			return;
		}

		$sql = 'DELETE FROM ' . $this->blocks_table . ' WHERE ' . $this->db->sql_in_set('bid', $block_ids);
		$this->db->sql_query($sql);

		if ($delete_config === true)
		{
			$sql = 'DELETE FROM ' . $this->blocks_config_table . ' WHERE ' . $this->db->sql_in_set('bid', $block_ids);
			$this->db->sql_query($sql);
		}

		// remove all block positions with no blocks
		//$sql = 'DELETE FROM ' . $this->block_positions_table . ' p  LEFT JOIN ' . $this->blocks_table . ' b ON p.pid = b.position WHERE b.position IS NULL';
		//$this->db->sql_query($sql);
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
}
