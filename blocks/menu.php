<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\blocks;

/**
* Menu Block
* @package phpBB Primetime Menu
*/
class menu extends \primetime\core\services\blocks\driver\block
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\menu\core\display */
	protected $tree;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache			Cache object
	 * @param \phpbb\config\config						$config			Config object
	 * @param \phpbb\db\driver\driver_interface			$db     		Database connection
	 * @param \phpbb\template\template					$user			User object
	 * @param \primetime\core\services\menu\display		$tree			Menu tree display object
	 * @param string									$menus_table	Menus table
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \primetime\core\services\menu\display $tree, $menus_table)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->tree = $tree;
		$this->menus_table = $menus_table;
	}

	public function get_config($settings)
	{
		$sql = 'SELECT * FROM ' . $this->menus_table;
		$result = $this->db->sql_query($sql);

		$menu_id = 0;
		$options = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$menu_id = $row['menu_id'];
			$options[$menu_id] = $row['menu_name'];
		}
		$this->db->sql_freeresult($result);

		$depth_ary = array();
		for ($i = 3; $i < 10; $i++)
		{
			$depth_ary[$i] = $i;
		}

		$menu_id = (!empty($settings['menu_id'])) ? $settings['menu_id'] : $menu_id;
		$expanded = (!empty($settings['expanded'])) ? $settings['expanded'] : 0;
		$max_depth = (!empty($settings['max_depth'])) ? $settings['max_depth'] : 3;

		return array(
			'legend1'       => $this->user->lang['SETTINGS'],
			'cache_name'	=> 'primetime_menu_data_' . $menu_id,
			'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'params' => array($options, $menu_id), 'default' => $menu_id, 'explain' => false),
			'expanded'		=> array('lang' => 'EXPANDED', 'validate' => 'bool', 'type' => 'checkbox', 'params' => array(array(1 => ''), $expanded), 'default' => 0, 'explain' => false),
			'max_depth'		=> array('lang' => 'MAX_DEPTH', 'validate' => 'int', 'type' => 'select', 'params' => array($depth_ary, $max_depth), 'default' => 3, 'explain' => false),
		);
	}

	public function display($db_data, $editing = false)
	{
		$title = $this->user->lang['MENU'];
		$menu_id = $db_data['settings']['menu_id'];

		if (!$menu_id)
		{
			return array(
				'title'		=> $title,
				'content'	=> ($editing) ? $this->user->lang['SELECT_MENU'] : ''
			);
		}

		if (($data = $this->cache->get('primetime_menu_data_' . $menu_id)) === false)
		{
			$this->tree->set_sql_condition('menu_id = ' . (int) $menu_id);
			$sql = $this->tree->qet_tree_sql();
			$result = $this->db->sql_query($sql);

			$data = array();
			$board_url = generate_board_url();

			while ($row = $this->db->sql_fetchrow($result))
			{
				$url_info = parse_url($row['item_url']);

				$item_url = $row['item_url'];
				if (strpos($item_url, 'app.php') !== false && $this->config['enable_mod_rewrite'])
				{
					$item_url = $board_url . str_replace('app.php', '', $item_url);
				}
				else if (strpos($item_url, 'http') === false)
				{
					$item_url = $board_url . '/' . $item_url;
				}
				$data[$row['item_id']] = $row;
				$data[$row['item_id']]['item_url'] = $item_url;
				$data[$row['item_id']]['url_path'] = (isset($url_info['path'])) ? $url_info['path'] : '';
				$data[$row['item_id']]['url_query'] = (isset($url_info['query'])) ? explode('&', $url_info['query']) : array();
			}
			$this->db->sql_freeresult($result);

			$data = array_values($data);
			$this->cache->put('primetime_menu_data_' . $menu_id, $data);
		}

		$this->tree->set_params($db_data['settings']);
		$this->tree->display_list($data, $this->ptemplate, 'tree');

		return array(
			'title'     => $title,
			'content'   => $this->ptemplate->render_view('primetime/core', 'blocks/menu.html', 'menu_block'),
		);
	}
}
