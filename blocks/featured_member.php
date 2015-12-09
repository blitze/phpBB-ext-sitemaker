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
use phpbb\cache\driver\driver_interface as cache;
use phpbb\config\config;
use phpbb\db\driver\driver_interface as database;
use phpbb\profilefields\manager as profile_fields;
use phpbb\user;

/**
 * Featured Member Block
 */
class featured_member extends block
{
	/** @var cache */
	protected $cache;

	/** @var config */
	protected $config;

	/** @var database */
	protected $db;

	/** @var profile_fields */
	protected $profile_fields;

	/** @var user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $blocks_table;

	/** @var int */
	protected $cache_time;

	/** @var array */
	private $settings;

	/** @var array */
	private static $rotations = array(
		'hourly'	=> 'hour',
		'daily'		=> 'day',
		'weekly'	=> 'week',
		'monthly'	=> 'month'
	);

	/**
	 * Constructor
	 *
	 * @param cache				$cache					Cache driver interface
	 * @param config			$config					Config object
	 * @param database			$db	 					Database connection
	 * @param profile_fields	$profile_fields			Profile fields manager object
	 * @param user				$user					User object
	 * @param string			$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string			$php_ext				php file extension
	 * @param string			$blocks_table			Name of blocks database table
	 * @param int				$cache_time
	 */
	public function __construct(cache $cache, config $config, database $db, profile_fields $profile_fields, user $user, $phpbb_root_path, $php_ext, $blocks_table, $cache_time = 3600)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->profile_fields = $profile_fields;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->blocks_table = $blocks_table;
		$this->cache_time = $cache_time;

		if (!function_exists('phpbb_show_profile'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$rotation_options = $this->_get_rotation_frequencies();
		$qtype_options = $this->_get_query_types();
		$cpf_options = $this->_get_cpf_fields();

		return array(
			'legend1'		=> 'SETTINGS',
			'qtype'			=> array('lang' => 'QUERY_TYPE', 'validate' => 'string', 'type' => 'select', 'options' => $qtype_options, 'default' => 'recent', 'explain' => false),
			'rotation'		=> array('lang' => 'FREQUENCY', 'validate' => 'string', 'type' => 'select', 'options' => $rotation_options, 'default' => 'daily', 'explain' => false),
			'userlist'		=> array('lang' => 'FEATURED_MEMBER_IDS', 'validate' => 'string', 'type' => 'textarea:3:40', 'default' => '', 'explain' => true),

			'legend2'		=> 'CUSTOM_PROFILE_FIELDS',
			'show_cpf'		=> array('lang' => 'SELECT_PROFILE_FIELDS', 'validate' => 'string', 'type' => 'checkbox', 'options' => $cpf_options, 'default' => array(), 'explain' => true),
			'last_changed'	=> array('type' => 'hidden', 'default' => 0),
			'current_user'	=> array('type' => 'hidden', 'default' => 0),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$this->settings = $this->_get_settings($bdata);

		$change_user = $this->_change_user();
		$block_title = $this->user->lang(strtoupper($this->settings['qtype']) . '_MEMBER');

		if (($row = $this->_get_user_data($change_user)) === false)
		{
			return $this->_update_userlist($block_title, $bdata, $edit_mode);
		}

		$this->_save_settings($bdata['bid'], $change_user);
		$this->_explain_view();
		$this->ptemplate->assign_vars($this->_display_user($row));

		return array(
			'title'		=> $block_title,
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/featured_member.html', 'featured_member_block'),
		);
	}

	/**
	 * @param bool $change_user
	 * @return array|false
	 */
	private function _get_user_data($change_user)
	{
		$sql = 'SELECT user_id, username, user_colour, user_avatar, user_avatar_type, user_avatar_height, user_avatar_width, user_regdate, user_lastvisit, user_birthday, user_posts, user_rank
			FROM ' . USERS_TABLE . '
			WHERE ' . $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER));

		$method = '_query_user_by_' . $this->settings['qtype'];

		if (is_callable(array($this, $method)))
		{
			call_user_func_array(array($this, $method), array(&$sql, $change_user));
		}
		else
		{
			$sql .= 'ORDER BY RAND()';
		}

		$result = $this->db->sql_query_limit($sql, 1, 0, $this->_get_cache_time($this->settings['qtype'], $this->settings['rotation']));
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	/**
	 * @param string $sql
	 * @param bool $change_user
	 */
	private function _query_user_by_featured(&$sql, $change_user)
	{
		$userlist = $this->_get_userlist($this->settings['userlist']);
		$current_user = (sizeof($userlist)) ? $this->_get_featured_user($userlist, $change_user) : 0;

		$sql .= ' AND user_id = ' . (int) $current_user;
	}

	/**
	 * @param string $sql
	 */
	private function _query_user_by_recent(&$sql)
	{
		$sql .= ' AND user_posts > 0 ORDER BY user_regdate DESC';
	}

	/**
	 * @param string $sql
	 */
	private function _query_user_by_posts(&$sql)
	{
		$sql .= ' AND user_posts > 0 ORDER BY user_posts DESC';
	}

	/**
	 * @param string $query_type
	 * @param string $rotation
	 * @return int
	 */
	private function _get_cache_time($query_type, $rotation)
	{
		return ($rotation !== 'pageload' || in_array($query_type, array('posts', 'recent'))) ? $this->cache_time : 0;
	}

	/**
	 * @return bool
	 */
	private function _change_user()
	{
		if ($this->settings['rotation'] == 'pageload' || $this->settings['last_changed'] < strtotime('-1 ' . self::$rotations[$this->settings['rotation']]))
		{
			$this->settings['last_changed'] = time();
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @param array $userlist
	 * @param $change_user
	 * @return int
	 */
	private function _get_featured_user(array $userlist, $change_user)
	{
		$current_user = $this->settings['current_user'];

		if ($change_user && sizeof($userlist))
		{
			$current_user = $this->_get_next_user($current_user, $userlist);

			$this->settings['current_user'] = $current_user;
		}

		return $current_user;
	}

	/**
	 * @param $current_user
	 * @param $userlist
	 * @return int
	 */
	private function _get_next_user($current_user, array $userlist)
	{
		$key = 0;
		if ($current_user)
		{
			$key = $this->_get_next_key($current_user, $userlist);
		}

		return $userlist[$key];
	}

	/**
	 * @param $current_user
	 * @param $userlist
	 * @return int
	 */
	private function _get_next_key($current_user, array $userlist)
	{
		$end_key = sizeof($userlist) - 1;
		$curr_key = (int) array_search($current_user, $userlist);

		return ($curr_key >= 0 && $curr_key < $end_key) ? ($curr_key + 1) : 0;
	}

	/**
	 */
	private function _explain_view()
	{
		$query_type = $this->settings['qtype'];
		$rotation = $this->settings['rotation'];

		$this->ptemplate->assign_vars(array(
			'QTYPE_EXPLAIN'		=> ($query_type == 'posts' || $query_type == 'recent') ? $this->user->lang('QTYPE_' . strtoupper($query_type)) : '',
			'TITLE_EXPLAIN'		=> ($rotation != 'pageload') ? $this->user->lang(strtoupper($rotation) . '_MEMBER') : '',
		));
	}

	/**
	 * @param array $bdata
	 * @return array
	 */
	private function _get_settings(array $bdata)
	{
		$cached_settings = $this->cache->get('pt_block_data_' . $bdata['bid']);
		$settings = ($cached_settings && $cached_settings['hash'] === $bdata['hash']) ? $cached_settings : $bdata['settings'];
		$settings['hash'] = $bdata['hash'];

		return $settings;
	}

	/**
	 * @param $bid
	 * @param bool $change_user
	 */
	private function _save_settings($bid, $change_user)
	{
		if ($change_user && ($this->settings['rotation'] !== 'pageload' || $this->settings['qtype'] === 'featured'))
		{
			$settings = $this->settings;
			unset($settings['hash']);
			$sql_data = array(
				'settings'	=> serialize($settings)
			);
			$this->db->sql_query('UPDATE ' . $this->blocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE bid = ' . (int) $bid);
			$this->cache->put('pt_block_data_' . $bid, $this->settings);
		}
	}

	/**
	 * @param string $list
	 * @return array
	 */
	private function _get_userlist($list)
	{
		$userlist = preg_replace("/\s*,?\s*(\r\n|\n\r|\n|\r)+\s*/", "\n", trim($list));
		return array_map('intval', array_filter(explode(',', $userlist)));
	}

	/**
	 * if we're selecting from a list and there is no result, we remove the culprit and update the list
	 *
	 * @param string $title
	 * @param array $bdata
	 * @param bool $edit_mode
	 * @return array
	 */
	private function _update_userlist($title, array $bdata, $edit_mode)
	{
		$userlist = $this->_get_userlist($bdata['settings']['userlist']);

		if ($this->settings['qtype'] === 'featured' && sizeof($userlist))
		{
			$curr_key = (int) array_search($this->settings['current_user'], $userlist);

			// Remove the invalid user from the list
			$new_list = str_replace($this->settings['current_user'] . ',', '', $this->settings['userlist'] . ',');
			$new_list = trim($new_list, ',');

			$new_userlist = $this->_get_userlist($new_list);
			$current_user =& $new_userlist[$curr_key - 1];

			$this->settings['current_user'] = (int) $current_user;
			$this->settings['userlist'] = $new_list;
			$this->settings['last_changed'] = 0;

			$bdata['settings'] = $this->settings;
			$bdata['hash'] = 0;

			return $this->display($bdata, $edit_mode);
		}

		return array(
			'title' => $title,
		);
	}

	/**
	 * @param $user_id
	 * @return array|string
	 */
	private function _get_profile_fields($user_id)
	{
		$fields = '';
		if (sizeof($this->settings['show_cpf']))
		{
			$fields = $this->profile_fields->grab_profile_fields_data($user_id);

			if (sizeof($fields))
			{
				$fields = array_intersect_key(array_shift($fields), array_flip($this->settings['show_cpf']));
			}
		}

		return $fields;
	}

	/**
	 * @param int $user_id
	 */
	private function _show_profile_fields($user_id)
	{
		if ($profile_fields = $this->_get_profile_fields($user_id))
		{
			$cp_row = $this->profile_fields->generate_profile_fields_template_data($profile_fields);

			$this->ptemplate->assign_vars($cp_row['row']);

			foreach ($cp_row['blockrow'] as $field_data)
			{
				$this->ptemplate->assign_block_vars('custom_fields', $field_data);
			}
		}
	}

	/**
	 * @param array $row
	 * @return array
	 */
	private function _display_user(array $row)
	{
		if (!$row)
		{
			return array();
		}

		$username = get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']);
		$date_format = $this->user->lang('DATE_FORMAT');
		$rank = phpbb_get_user_rank($row, $row['user_posts']);

		$this->_show_profile_fields($row['user_id']);

		return array(
			'USERNAME'			=> $username,
			'AVATAR_IMG'		=> phpbb_get_user_avatar($row),
			'POSTS_PCT'			=> sprintf($this->user->lang('POST_PCT'), $this->_calculate_percent_posts($row['user_posts'])),
			'L_VIEW_PROFILE'	=> sprintf($this->user->lang('VIEW_USER_PROFILE'), $username),
			'JOINED'			=> $this->user->format_date($row['user_regdate'], "|$date_format|"),
			'VISITED'			=> $this->_get_last_visit_date($row['user_lastvisit'], $date_format),
			'POSTS'				=> $row['user_posts'],
			'RANK_TITLE'		=> $rank['title'],
			'RANK_IMG'			=> $rank['img'],
			'U_PROFILE'			=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
			'U_SEARCH_USER'		=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts"),
		);
	}

	/**
	 * @param $user_posts
	 * @return int|mixed
	 */
	private function _calculate_percent_posts($user_posts)
	{
		return ($this->config['num_posts']) ? min(100, ($user_posts / $this->config['num_posts']) * 100) : 0;
	}

	/**
	 * @param int $last_visited
	 * @param string $date_format
	 * @return string
	 */
	private function _get_last_visit_date($last_visited, $date_format)
	{
		return ($last_visited) ? $this->user->format_date($last_visited, "|$date_format|") : '';
	}

	/**
	 * @return array
	 */
	private function _get_rotation_frequencies()
	{
		return array(
			'pageload'	=> 'ROTATE_PAGELOAD',
			'hourly'	=> 'ROTATE_HOURLY',
			'daily'		=> 'ROTATE_DAILY',
			'weekly'	=> 'ROTATE_WEEKLY',
			'monthly'	=> 'ROTATE_MONTHLY',
		);
	}

	/**
	 * @return array
	 */
	private function _get_query_types()
	{
		return array(
			'random'	=> 'RANDOM_MEMBER',
			'recent'	=> 'RECENT_MEMBER',
			'posts'		=> 'POSTS_MEMBER',
			'featured'	=> 'FEATURED_MEMBER',
		);
	}

	/**
	 * @return array
	 */
	private function _get_cpf_fields()
	{
		$sql = 'SELECT l.lang_name, f.field_ident
			FROM ' . PROFILE_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $this->user->get_iso_lang_id() . '
				AND f.field_active = 1
				AND f.field_no_view = 0
				AND f.field_hide = 0
				AND l.field_id = f.field_id
			ORDER BY f.field_order';
		$result = $this->db->sql_query($sql);

		$cpf_options = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$cpf_options[$row['field_ident']] = $row['lang_name'];
		}
		$this->db->sql_freeresult($result);

		return $cpf_options;
	}
}
