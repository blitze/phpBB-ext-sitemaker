<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class groups
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface		$db	 		Database connection
	 * @param \phpbb\language\language				$translator	Language object
	 * @param \phpbb\user							$user		User object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\language\language $translator, \phpbb\user $user)
	{
		$this->db = $db;
		$this->translator = $translator;
		$this->user = $user;
	}

	/**
	 * @return int[]
	 */
	public function get_users_groups()
	{
		$sql = 'SELECT group_id
			FROM ' . USER_GROUP_TABLE . '
			WHERE user_id = ' . (int) $this->user->data['user_id'];
		$result = $this->db->sql_query($sql);

		$groups = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$groups[$row['group_id']] = (int) $row['group_id'];
		}
		$this->db->sql_freeresult($result);

		return $groups;
	}

	/**
	 * @param string $mode (all|special)
	 * @return array
	 */
	public function get_data($mode = 'all')
	{
		$sql = $this->_get_group_sql($mode);
		$result = $this->db->sql_query($sql);

		$group_data = array('' => 'ALL_GROUPS');
		while ($row = $this->db->sql_fetchrow($result))
		{
			$group_data[$row['group_id']] = $this->_get_group_name($row);
		}
		$this->db->sql_freeresult($result);

		return $group_data;
	}

	/**
	 * @param string $mode (all|special)
	 * @param array $selected
	 * @return string
	 */
	public function get_options($mode = 'all', array $selected = array())
	{
		$sql = $this->_get_group_sql($mode);
		$result = $this->db->sql_query($sql);

		$options = '<option value="0">' . $this->translator->lang('ALL_GROUPS') . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$group_name = $this->_get_group_name($row);
			$group_class = $this->_get_group_class($row['group_type']);
			$selected_option = $this->_get_selected_option($row['group_id'], $selected);
			$options .= '<option' . $group_class . ' value="' . $row['group_id'] . '"' . $selected_option . '>' . $group_name . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $options;
	}

	/**
	 * @param string $mode (all|special)
	 * @return string
	 */
	private function _get_group_sql($mode)
	{
		return 'SELECT group_id, group_name, group_type
			FROM ' . GROUPS_TABLE .
			(($mode === 'special') ? ' WHERE group_type = ' . GROUP_SPECIAL : '') . '
			ORDER BY group_type DESC, group_name ASC';
	}

	/**
	 * @param array $row
	 * @return mixed|string
	 */
	private function _get_group_name(array $row)
	{
		return ($row['group_type'] == GROUP_SPECIAL) ? $this->translator->lang('G_' . $row['group_name']) : ucfirst($row['group_name']);
	}

	/**
	 * @param int $group_type
	 * @return string
	 */
	private function _get_group_class($group_type)
	{
		return ($group_type == GROUP_SPECIAL) ? ' class="sep"' : '';
	}

	/**
	 * @param int $group_id
	 * @param array $selected_options
	 * @return string
	 */
	private function _get_selected_option($group_id, $selected_options)
	{
		return (in_array($group_id, $selected_options)) ? ' selected="selected"' : '';
	}
}
