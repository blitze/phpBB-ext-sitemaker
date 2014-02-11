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

	public function get_config($data)
	{
		$sql = 'SELECT * FROM ' . $this->menus_table;
		$result = $this->db->sql_query($sql);

		$options = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$options[$row['menu_id']] = $row['menu_name'];
		}
		$this->db->sql_freeresult($result);

		return array(
            'legend1'       => $this->user->lang['SETTINGS'],
            'enable_icons'  => array('lang' => 'ENABLE_ICONS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
            'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'function' => 'build_select', 'params' => array($options, (isset($data['settings']['menu_id'])) ? $data['settings']['menu_id'] : 0), 'explain' => false),
        );
	}

	public function display($db_data, $editing = false)
	{
		$title = 'Menu';
		$menu_id =& $db_data['settings']['menu_id'];

		if (!$menu_id)
		{
			return array(
				'title'		=> $title,
				'content'	=> ($editing) ? 'Select Menu' : ''
			);
		}

		$this->tree->set_sql_condition('menu_id = ' . (int) $menu_id);
		$sql = $this->tree->qet_tree_sql();
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$this->db->sql_freeresult($result);

		$this->tree->display_list($data, $this->btemplate, 'tree');	

		return array(
            'title'     => $title,
            'content'   => $this->render_block('primetime/primetime', 'blocks/menu.html', 'menu_block'),
        );
	}
}
