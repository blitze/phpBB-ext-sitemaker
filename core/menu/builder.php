<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\menu;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Manage nested sets
 * @package phpBB Primetime
 */
class builder extends \primetime\primetime\core\tree\builder
{
	/**
	 * Construct
	 * 
	 * @param \phpbb\db\driver\driver				$db             Database connection
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 * @param string								$table_name		Table name
	 * @param string								$pk				Primary key
	 * @param string								$menus_table	Menus table
	 */
	public function __construct(\phpbb\db\driver\driver $db, \primetime\primetime\core\primetime $primetime, $menus_table, $menu_items_table, $pk)
	{
		parent::__construct($db, $primetime, $menu_items_table, $pk);
		$this->menus_table = $menus_table;
	}

	public function menu_create($data)
	{
		$this->db->sql_query('INSERT INTO ' . $this->menus_table . ' ' . $this->db->sql_build_array('INSERT', $data));
		$menu_id = $this->db->sql_nextid();

		return array(
			'id'	=> $menu_id,
			'title'	=> $data['menu_name']
		);
	}

	public function menu_update($id, $data)
	{
		$this->db->sql_query('UPDATE ' . $this->menus_table . ' SET ' . $this->db->sql_build_array('UPDATE', $data) . ' WHERE menu_id = ' . (int) $id);
	}

	public function menu_delete($id)
	{
		$ids = (is_array($id)) ? $id : array($id);
		$ids = array_filter($ids);

		$this->db->sql_query('DELETE FROM ' . $this->menus_table . ' WHERE ' . $this->db->sql_in_set('menu_id', $ids));		
	}

	public function menu_get($id = '')
	{
		$ids = (is_array($id)) ? $id : array($id);
		$ids = array_filter($ids);

		$sql = 'SELECT * FROM ' . $this->menus_table . ((sizeof($ids)) ? ' WHERE ' . $this->db->sql_in_set('menu_id', $ids) : '');
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[$row['menu_id']] = $row;
		}
		$this->db->sql_freeresult($result);

		return (is_array($id)) ? array_pop($data) : $data;
	}
}
