<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Whois Block
 */
class whois extends block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** \phpbb\group\helper */
	protected $group_helper;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth				Permission object
	 * @param \phpbb\config\config				$config				phpBB configuration
	 * @param \phpbb\db\driver\driver_interface	$db     			Database connection
	 * @param \phpbb\group\helper				$group_helper		Group helper object
	 * @param \phpbb\language\language			$translator			Language object
	 * @param \phpbb\template\template			$template			Template object
	 * @param \phpbb\user						$user				User object
	 * @param string							$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string							$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\group\helper $group_helper, \phpbb\language\language $translator, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->group_helper = $group_helper;
		$this->translator = $translator;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$data = $this->template->retrieve_vars(array('TOTAL_USERS_ONLINE', 'LOGGED_IN_USER_LIST', 'RECORD_USERS', 'LEGEND'));

		if (!empty($data['TOTAL_USERS_ONLINE']))
		{
			list($l_online_users, $online_userlist, $l_online_record) = array_values($data);
		}
		else
		{
			$online_users = obtain_users_online();
			$user_online_strings = obtain_users_online_string($online_users);

			$l_online_users = $user_online_strings['l_online_users'];
			$online_userlist = $user_online_strings['online_userlist'];

			$l_online_record = $this->translator->lang('RECORD_ONLINE_USERS', (int) $this->config['record_online_users'], $this->user->format_date($this->config['record_online_date'], false, true));
		}

		$this->template->assign_var('S_DISPLAY_ONLINE_LIST', false);

		return array(
			'title'	=> 'WHO_IS_ONLINE',
			'data'	=> array(
				'TOTAL_USERS_ONLINE'	=> $l_online_users,
				'LOGGED_IN_USER_LIST'	=> $online_userlist,
				'RECORD_USERS'			=> $l_online_record,
				'LEGEND'				=> !empty($data['LEGEND']) ? $data['LEGEND'] : $this->get_legend(),
				'U_VIEWONLINE'			=> $this->get_viewonline_url(),
			)
		);
	}

	/**
	 * @return string
	 */
	private function get_viewonline_url()
	{
		return ($this->auth->acl_gets('u_viewprofile', 'a_user', 'a_useradd', 'a_userdel')) ? append_sid("{$this->phpbb_root_path}viewonline." . $this->php_ext) : '';
	}

	/**
	 * @return string
	 */
	private function get_legend()
	{
		$sql = $this->get_legend_sql();
		$result = $this->db->sql_query($sql);

		$legend = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$colour_text = ($row['group_colour']) ? ' style="color:#' . $row['group_colour'] . '"' : '';
			$group_name = $this->group_helper->get_name($row['group_name']);

			$legend[] = $this->get_legend_html($row, $group_name, $colour_text);
		}
		$this->db->sql_freeresult($result);

		return implode($this->translator->lang('COMMA_SEPARATOR'), $legend);
	}

	/**
	 * @param array $row
	 * @param string $group_name
	 * @param string $colour_text
	 * @return string
	 */
	protected function get_legend_html(array $row, $group_name, $colour_text)
	{
		if ($row['group_name'] == 'BOTS' || ($this->user->data['user_id'] != ANONYMOUS && !$this->auth->acl_get('u_viewprofile')))
		{
			return '<span' . $colour_text . '>' . $group_name . '</span>';
		}
		else
		{
			return '<a' . $colour_text . ' href="' . append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=group&amp;g=' . $row['group_id']) . '">' . $group_name . '</a>';
		}
	}

	/**
	 * @return string
	 */
	protected function get_legend_sql()
	{
		$order_legend = ($this->config['legend_sort_groupname']) ? 'group_name' : 'group_legend';

		// Grab group details for legend display
		if ($this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
		{
			return 'SELECT group_id, group_name, group_colour, group_type, group_legend
				FROM ' . GROUPS_TABLE . '
				WHERE group_legend > 0
				ORDER BY ' . $order_legend . ' ASC';
		}
		else
		{
			return 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type, g.group_legend
				FROM ' . GROUPS_TABLE . ' g
				LEFT JOIN ' . USER_GROUP_TABLE . ' ug
					ON (
						g.group_id = ug.group_id
						AND ug.user_id = ' . $this->user->data['user_id'] . '
						AND ug.user_pending = 0
					)
				WHERE g.group_legend > 0
					AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . $this->user->data['user_id'] . ')
				ORDER BY g.' . $order_legend . ' ASC';
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '@blitze_sitemaker/blocks/whois.html';
	}
}
