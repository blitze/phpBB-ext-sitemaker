<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menu;

/**
 * Manage nested sets
 * @package phpBB Sitemaker
 */
class builder extends \blitze\sitemaker\services\tree\builder
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var string */
	private $menus_table;

	/**
	 * Construct
	 *
	 * @param \phpbb\cache\service					$cache				Cache object
	 * @param \phpbb\db\driver\driver_interface		$db             	Database connection
	 * @param \blitze\sitemaker\services\util		$sitemaker			Sitemaker Object
	 * @param string								$menus_table		Menus table
	 * @param string								$menu_items_table	Menu Items table
	 * @param string								$pk					Primary key
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\db\driver\driver_interface $db, \blitze\sitemaker\services\util $sitemaker, $menus_table, $menu_items_table, $pk)
	{
		parent::__construct($db, $sitemaker, $menu_items_table, $pk);

		$this->menus_table = $menus_table;
		$this->cache = $cache;
	}

	public function menu_create($data = array())
	{
		if (!isset($data['menu_name']))
		{
			$result = $this->db->sql_query('SELECT COUNT(*) AS total FROM ' . $this->menus_table);
			$total = $this->db->sql_fetchfield('total');
			$this->db->sql_freeresult($result);

			$data['menu_name'] = 'Menu ' . ($total + 1);
		}

		$this->db->sql_query('INSERT INTO ' . $this->menus_table . ' ' . $this->db->sql_build_array('INSERT', $data));
		$menu_id = $this->db->sql_nextid();

		return array(
			'id'	=> $menu_id,
			'title'	=> $data['menu_name']
		);
	}

	public function menu_update($id, $data)
	{
		if (isset($data['menu_name']))
		{
			$sql = 'SELECT COUNT(*) AS found FROM ' . $this->menus_table . " WHERE menu_name = '" . $this->db->sql_escape($data['menu_name']) . "'";
			$result = $this->db->sql_query($sql);
			$found = $this->db->sql_fetchfield('found');
			$this->db->sql_freeresult($result);

			if ($found)
			{
				return $this->menu_get($id);
			}
		}

		$this->db->sql_query('UPDATE ' . $this->menus_table . ' SET ' . $this->db->sql_build_array('UPDATE', $data) . ' WHERE menu_id = ' . (int) $id);

		return $data;
	}

	public function menu_delete($id)
	{
		$this->db->sql_query('DELETE FROM ' . $this->items_table . ' WHERE menu_id = ' . (int) $id);
		$this->db->sql_query('DELETE FROM ' . $this->menus_table . ' WHERE menu_id = ' . (int) $id);

		return array('id' => $id);
	}

	public function menu_get($id = 0)
	{
		$sql = 'SELECT * FROM ' . $this->menus_table . (($id) ? ' WHERE menu_id = ' . (int) $id : '');
		$result = $this->db->sql_query($sql);

		$data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$data[$row['menu_id']] = $row;
		}
		$this->db->sql_freeresult($result);

		return ($id) ? array_pop($data) : $data;
	}

	public function menu_get_items()
	{
		$sql = $this->qet_tree_sql();
		$result = $this->db->sql_query($sql);

		$items = array();
		$board_url = generate_board_url();

		while ($row = $this->db->sql_fetchrow($result))
		{
			$items[$row['item_id']] = $row;
			$items[$row['item_id']]['item_path'] = ($row['item_url'] && strpos($row['item_url'], 'http') === false) ? $board_url . '/' . $row['item_url'] : $row['item_url'];
		}
		$this->db->sql_freeresult($result);

		return array_values($items);
	}

	public function get_item_row($node_id)
	{
		$row = $this->get_row($node_id);
		$board_url = generate_board_url();
		$row['item_path'] = ($row['item_url'] && strpos($row['item_url'], 'http') === false) ? $board_url . '/' . $row['item_url'] : $row['item_url'];

		return $row;
	}

	public function on_tree_change($data)
	{
		$row = array_pop($data);
		$this->cache->destroy('sitemaker_menu_data_' . $row['menu_id']);
	}
}
