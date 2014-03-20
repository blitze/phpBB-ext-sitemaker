<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\blocks;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Menu Block
* @package phpBB Primetime Menu
*/
class menu  extends \primetime\primetime\core\blocks\driver\block
{
	/**
	 * Database
	 * @var \phpbb\db\driver\driver
	 */
	protected $db;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Tree object
	 * @var \primetime\menu\core\display
	 */
	protected $tree;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver					$db     		Database connection
	 * @param \phpbb\template\template					$user			User object
	 * @param \primetime\primetime\core\menu\display	$tree			Menu tree display object
	 * @param string									$menus_table	Menus table
	 */
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\user $user, \primetime\primetime\core\menu\display $tree, $menus_table)
	{
		$this->db = $db;
		$this->user = $user;
		$this->tree = $tree;
		$this->menus_table = $menus_table;
	}

	public function get_config($settings)
	{
		$sql = 'SELECT * FROM ' . $this->menus_table;
		$result = $this->db->sql_query($sql);

		$options = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$options[$row['menu_id']] = $row['menu_name'];
		}
		$this->db->sql_freeresult($result);

		$depth_ary = array();
		for ($i = 3; $i < 10; $i++)
		{
			$depth_ary[$i] = $i;
		}

		$menu_id = (!empty($settings['menu_id'])) ? $settings['menu_id'] : 0;
		$expanded = (!empty($settings['expanded'])) ? $settings['expanded'] : 0;
		$max_depth = (!empty($settings['max_depth'])) ? $settings['max_depth'] : 3;

		return array(
            'legend1'       => $this->user->lang['SETTINGS'],
            'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'params' => array($options, $menu_id), 'default' => 0, 'explain' => false),
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

		$this->tree->set_params($db_data['settings']);
		$sql = $this->tree->qet_tree_sql();
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$url_info = parse_url($row['item_url']);

			$data[$row['item_id']] = $row;
			$data[$row['item_id']]['url_path'] = (isset($url_info['path'])) ? $url_info['path'] : '';
			$data[$row['item_id']]['url_query'] = (isset($url_info['query'])) ? explode('&', $url_info['query']) : array();
		}
		$this->db->sql_freeresult($result);

		$this->tree->display_list(array_values($data), $this->ptemplate, 'tree');	

		return array(
            'title'     => $title,
            'content'   => $this->ptemplate->render_view('primetime/primetime', 'blocks/menu.html', 'menu_block'),
        );
	}
}
