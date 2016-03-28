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
use blitze\sitemaker\services\userlist;

/**
 * Featured Member Block
 */
class featured_member extends block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\profilefields */
	protected $profilefields;

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
	 * @param \phpbb\cache\driver\driver_interface		$cache					Cache driver interface
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db	 					Database connection
	 * @param \blitze\sitemaker\services\profilefields	$profilefields			Profile fields manager object
	 * @param \phpbb\user								$user					User object
	 * @param string									$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string									$php_ext				php file extension
	 * @param string									$blocks_table			Name of blocks database table
	 * @param int										$cache_time
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \blitze\sitemaker\services\profilefields $profilefields, $phpbb_root_path, $php_ext, $blocks_table, $cache_time = 3600)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->profilefields = $profilefields;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->blocks_table = $blocks_table;
		$this->cache_time = $cache_time;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$rotation_options = $this->get_rotation_frequencies();
		$qtype_options = $this->get_query_types();
		$cpf_options = $this->profilefields->get_all_fields();

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
	public function display(array $bdata, $edit_mode = false, $loop_count = 0)
	{
		$this->settings = $this->get_settings($bdata);

		$change_user = $this->change_user();
		$block_title = $this->get_block_title($this->settings['qtype']);

		if (($row = $this->get_user_data($change_user)) === false)
		{
			userlist::update($this->settings);

			$bdata['settings'] = $this->settings;
			$bdata['hash'] = 0;

			// Prevent endless loop looking for valid user
			if ($loop_count < 3)
			{
				return $this->display($bdata, $edit_mode, ++$loop_count);
			}
			$row = array();
		}

		return array(
			'title'		=> $block_title,
			'content'	=> $this->display_user($bdata['bid'], $row, $change_user),
		);
	}

	/**
	 * @param bool $change_user
	 * @return array|false
	 */
	private function get_user_data($change_user)
	{
		$sql = 'SELECT user_id, username, user_colour, user_avatar, user_avatar_type, user_avatar_height, user_avatar_width, user_regdate, user_lastvisit, user_birthday, user_posts, user_rank
			FROM ' . USERS_TABLE . '
			WHERE ' . $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER));

		$method = 'query_' . $this->settings['qtype'];

		if (is_callable(array($this, $method)))
		{
			call_user_func_array(array($this, $method), array(&$sql, $change_user));
		}
		else
		{
			return array();
		}

		$result = $this->db->sql_query_limit($sql, 1, 0, $this->get_cache_time($this->settings['qtype'], $this->settings['rotation']));
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	/**
	 * @param string $sql
	 * @param bool $change_user
	 */
	private function query_featured(&$sql, $change_user)
	{
		$sql .= ' AND user_id = ' . userlist::get_user_id($this->settings, $change_user);
	}

	/**
	 * @param string $sql
	 */
	private function query_recent(&$sql)
	{
		$sql .= ' AND user_posts > 0 ORDER BY user_regdate DESC';
	}

	/**
	 * @param string $sql
	 */
	private function query_posts(&$sql)
	{
		$sql .= ' AND user_posts > 0 ORDER BY user_posts DESC';
	}

	/**
	 * @param string $query_type
	 * @param string $rotation
	 * @return int
	 */
	private function get_cache_time($query_type, $rotation)
	{
		return ($rotation !== 'pageload' || in_array($query_type, array('posts', 'recent'))) ? $this->cache_time : 0;
	}

	/**
	 * @return bool
	 */
	private function change_user()
	{
		$change = false;
		if ($this->settings['rotation'] == 'pageload' || $this->settings['last_changed'] < strtotime('-1 ' . self::$rotations[$this->settings['rotation']]))
		{
			$this->settings['last_changed'] = time();
			$change = true;
		}

		return $change;
	}

	/**
	 */
	private function explain_view()
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
	private function get_settings(array $bdata)
	{
		$cached_settings = $this->cache->get('pt_block_data_' . $bdata['bid']);
		$settings = ($cached_settings && $cached_settings['hash'] === $bdata['hash']) ? $cached_settings : $bdata['settings'];
		$settings['hash'] = $bdata['hash'];

		return $settings;
	}

	/**
	 * @param int $bid
	 * @param bool $change_user
	 */
	private function save_settings($bid, $change_user)
	{
		if ($change_user && $this->settings['qtype'] === 'featured')
		{
			$settings = $this->settings;
			unset($settings['hash']);
			$sql_data = array(
				'settings'	=> json_encode($settings)
			);
			$this->db->sql_query('UPDATE ' . $this->blocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE bid = ' . (int) $bid);
			$this->cache->put('pt_block_data_' . $bid, $this->settings);
		}
	}

	/**
	 * @param int   $block_id
	 * @param array $row
	 * @param bool  $change_user
	 * @return string
	 */
	private function display_user($block_id, array $row, $change_user)
	{
		$this->save_settings($block_id, $change_user);

		$html = '';
		if (sizeof($row))
		{
			$this->explain_view();

			$tpl_data = $this->get_template_data($row);
			$this->ptemplate->assign_vars($tpl_data['row']);
			$this->ptemplate->assign_block_vars_array('custom_fields', $tpl_data['blockrow']);
			unset($tpl_data);

			$html = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/featured_member.html', 'featured_member_block');
		}

		return $html;
	}

	/**
	 * @param array $row
	 * @return array
	 */
	private function get_template_data(array $row)
	{
		$date_format = $this->user->lang('DATE_FORMAT');
		$username = get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']);
		$rank = phpbb_get_user_rank($row, $row['user_posts']);

		$tpl_data = $this->profilefields->get_template_data($row['user_id'], $this->settings['show_cpf']);

		$tpl_data['row'] = array_merge($tpl_data['row'], array(
			'USERNAME'			=> $username,
			'AVATAR_IMG'		=> phpbb_get_user_avatar($row),
			'POSTS_PCT'			=> sprintf($this->user->lang('POST_PCT'), $this->calculate_percent_posts($row['user_posts'])),
			'L_VIEW_PROFILE'	=> sprintf($this->user->lang('VIEW_USER_PROFILE'), $username),
			'JOINED'			=> $this->user->format_date($row['user_regdate'], "|$date_format|"),
			'VISITED'			=> $this->get_last_visit_date($row['user_lastvisit'], $date_format),
			'POSTS'				=> $row['user_posts'],
			'RANK_TITLE'		=> $rank['title'],
			'RANK_IMG'			=> $rank['img'],
			'U_PROFILE'			=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
			'U_SEARCH_USER'		=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts"),
		));

		return $tpl_data;
	}

	/**
	 * @param int $user_posts
	 * @return int|mixed
	 */
	private function calculate_percent_posts($user_posts)
	{
		return ($this->config['num_posts']) ? min(100, ($user_posts / $this->config['num_posts']) * 100) : 0;
	}

	/**
	 * @param int $last_visited
	 * @param string $date_format
	 * @return string
	 */
	private function get_last_visit_date($last_visited, $date_format)
	{
		return ($last_visited) ? $this->user->format_date($last_visited, "|$date_format|") : '';
	}

	/**
	 * @param string $qtype
	 * @return string
	 */
	private function get_block_title($qtype)
	{
		$qtypes = $this->get_query_types();
		return isset($qtypes[$qtype]) ? $qtypes[$qtype] : 'FEATURED_MEMBER';
	}

	/**
	 * @return array
	 */
	private function get_rotation_frequencies()
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
	private function get_query_types()
	{
		return array(
			'recent'	=> 'RECENT_MEMBER',
			'posts'		=> 'POSTS_MEMBER',
			'featured'	=> 'FEATURED_MEMBER',
		);
	}
}
