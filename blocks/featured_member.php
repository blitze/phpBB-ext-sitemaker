<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

/**
 * Featured Member Block
 */
class featured_member extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\profilefields\manager */
	protected $profile_fields;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service					$cache					Cache object
	 * @param \phpbb\config\config					$config					Config object
	 * @param \phpbb\db\driver\driver_interface		$db	 					Database connection
	 * @param \phpbb\profilefields\manager			$profile_fields			Profile fields manager object
	 * @param \phpbb\user							$user					User object
	 * @param string								$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string								$php_ext				php file extension
	 * @param string								$blocks_config_table	Blocks config table
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\profilefields\manager $profile_fields, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->profile_fields = $profile_fields;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		if (!function_exists('get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
	}

	public function get_config($settings)
	{
		$rotation_ary = array(
			'pageload'	=> 'ROTATE_PAGELOAD',
			'hourly'	=> 'ROTATE_HOURLY',
			'daily'		=> 'ROTATE_DAILY',
			'weekly'	=> 'ROTATE_WEEKLY',
			'monthly'	=> 'ROTATE_MONTHLY',
		);

		$qtype_ary = array(
			'random'	=> 'RANDOM_MEMBER',
			'recent'	=> 'RECENT_MEMBER',
			'posts'		=> 'POSTS_MEMBER',
			'featured'	=> 'FEATURED_MEMBER',
		);

		$sql = 'SELECT l.lang_name, f.field_ident
			FROM ' . PROFILE_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $this->user->get_iso_lang_id() . '
				AND f.field_active = 1
				AND f.field_no_view = 0
				AND f.field_hide = 0
				AND l.field_id = f.field_id
			ORDER BY f.field_order';
		$result = $this->db->sql_query($sql);

		$cpf_ary = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$cpf_ary[$row['field_ident']] = $row['lang_name'];
		}
		$this->db->sql_freeresult($result);

		$qtype = (!empty($settings['qtype'])) ? $settings['qtype'] : 'recent';
		$rotation = (!empty($settings['rotation'])) ? $settings['rotation'] : 'daily';
		$cpf_fields	= (!empty($settings['show_cpf'])) ? $settings['show_cpf'] : '';
		$current_user	= (!empty($settings['curren_user'])) ? $settings['curren_user'] : 0;
		$lastchange	= (!empty($settings['lastchange'])) ? $settings['lastchange'] : 0;

		return array(
			'legend1'		=> 'SETTINGS',
			'qtype'			=> array('lang' => 'QUERY_TYPE', 'validate' => 'string', 'type' => 'select', 'params' => array($qtype_ary, $qtype), 'default' => 'recent', 'explain' => false),
			'rotation'		=> array('lang' => 'FREQUENCY', 'validate' => 'string', 'type' => 'select', 'params' => array($rotation_ary, $rotation), 'default' => 'daily', 'explain' => false),
			'userlist'		=> array('lang' => 'FEATURED_MEMBER_IDS', 'validate' => 'string', 'type' => 'textarea:3:40', 'default' => '', 'explain' => true),
			'legend2'		=> 'CUSTOM_PROFILE_FIELDS',
			'show_cpf'		=> array('lang' => 'SELECT_PROFILE_FIELDS', 'validate' => 'string', 'type' => 'checkbox', 'params' => array($cpf_ary, $cpf_fields), 'default' => '', 'explain' => true),
			'lastchange'	=> array('type' => 'hidden', 'default' => $lastchange),
			'current_user'	=> array('type' => 'hidden', 'default' => $current_user),
		);
	}

	public function display($bdata, $edit_mode = false)
	{
		$bid = $bdata['bid'];
		$query_type = $bdata['settings']['qtype'];
		$show_cpf = $bdata['settings']['show_cpf'];
		$current_user = $bdata['settings']['current_user'];
		$lastchange = $bdata['settings']['lastchange'];
		$rotation = $bdata['settings']['rotation'];
		$rotation_str = array('hourly' => 'hour', 'daily' => 'day', 'weekly' => 'week', 'monthly' => 'month');

		$error = false;
		$reload = (($row = $this->cache->get('pt_block_data_' . $bid)) === false || defined('SITEMAKER_FORUM_CHANGED')) ? true : false;
		$change = ($rotation == 'pageload' || $lastchange < strtotime('-1 ' . $rotation_str[$rotation])) ? true : false;

		if ($change === true || $reload === true)
		{
			$curr_key = $next_key = 0;
			$sql_where = $sql_order_by = $userlist = '';

			switch ($query_type)
			{
				case 'featured':

					$bdata['settings']['userlist'] = preg_replace("/\s*,?\s*(\r\n|\n\r|\n|\r)+\s*/", "\n", trim($bdata['settings']['userlist']));

					if ($bdata['settings']['userlist'])
					{
						$userlist = array_filter(explode(',', $bdata['settings']['userlist']));
						if ($change === true)
						{
							if ($current_user)
							{
								$end_key = sizeof($userlist) - 1;
								$curr_key = array_search($current_user, $userlist);
								$next_key = ($curr_key >= 0 && $curr_key < $end_key) ? ($curr_key + 1) : 0;
							}
							$current_user = trim($userlist[$next_key]);
						}
						$sql_where = ' AND user_id = ' . (int) $current_user;
					}
					else
					{
						$sql_order_by = 'ORDER BY RAND()';
						$query_type = 'random';
					}
				break;
				case 'recent':
					$sql_where = ' AND user_posts > 0';
					$sql_order_by = 'ORDER BY user_regdate DESC';
				break;
				case 'posts':
					$sql_where = ' AND user_posts > 0';
					$sql_order_by = 'ORDER BY user_posts DESC';
				break;
				default:
					$sql_order_by = 'ORDER BY RAND()';
				break;
			}

			$sql = 'SELECT user_id, username, user_colour, user_avatar, user_avatar_type, user_avatar_height, user_avatar_width, user_regdate, user_lastvisit, user_birthday, user_posts, user_rank 
				FROM ' . USERS_TABLE . '
				WHERE ' . $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER)) . "
					$sql_where
					$sql_order_by";
			$result = $this->db->sql_query_limit($sql, 1);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row)
			{
				if (is_array($show_cpf))
				{
					$fields = $this->profile_fields->grab_profile_fields_data($row['user_id']);

					if (sizeof($fields))
					{
						$row['profile_fields'] = array_intersect_key(array_shift($fields), array_flip($show_cpf));
					}
				}

				$this->cache->put('pt_block_data_' . $bid, $row);
			}
			else
			{
				// if we're selecting from a list and there is no result, we remove the culprit and update the list
				$error = true;
				if ($query_type == 'featured' && is_array($userlist))
				{
					$change = true;
					$next_key = $curr_key + 1;
					$next_key = ($next_key < sizeof($userlist)) ? $next_key : 0;
					$current_user = $userlist[$next_key];
					unset($userlist[$curr_key]);
				}
			}

			if (($change && $rotation != 'pageload') || $query_type == 'featured')
			{
				if (is_array($userlist))
				{
					$userlist = join(',', $userlist);
				}

				$bdata['settings']['userlist'] = $userlist;
				$bdata['settings']['lastchange'] = time();
				$bdata['settings']['show_cpf'] = (!empty($show_cpf)) ? join(',', $show_cpf) : '';
				$bdata['settings']['current_user'] = (!empty($current_user)) ? $current_user : 0;

				$this->cache->destroy('pt_block_data_' . $bid);
				unset($userlist);
			}

			if ($error === true)
			{
				return array();
			}
		}

		if (!empty($row['profile_fields']))
		{
			$cp_row = $this->profile_fields->generate_profile_fields_template_data($row['profile_fields']);

			$this->ptemplate->assign_vars($cp_row['row']);

			foreach ($cp_row['blockrow'] as $field_data)
			{
				$this->ptemplate->assign_block_vars('custom_fields', $field_data);
			}
		}

		$row['user_lastvisit'] = ($row['user_lastvisit']) ? $row['user_lastvisit'] : $row['user_regdate'];
		$memberdays = max(1, round((time() - $row['user_regdate']) / 86400));
		$posts_per_day = $row['user_posts'] / $memberdays;
		$percentage = ($this->config['num_posts']) ? min(100, ($row['user_posts'] / $this->config['num_posts']) * 100) : 0;

		$rank_title = $rank_img = $rank_img_src = '';
		get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);
		$username = get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']);
		$date_format = $this->user->lang('DATE_FORMAT');

		$this->ptemplate->assign_vars(array(
			'QTYPE_EXPLAIN'		=> ($query_type == 'posts' || $query_type == 'recent') ? $this->user->lang('QTYPE_' . strtoupper($query_type)) : '',
			'TITLE_EXPLAIN'		=> ($rotation != 'pageload') ? $this->user->lang(strtoupper($rotation) . '_MEMBER') : '',
			'USERNAME'			=> $username,
			'AVATAR_IMG'		=> phpbb_get_user_avatar($row),
			'POSTS_DAY'			=> sprintf($this->user->lang('POST_DAY'), $posts_per_day),
			'POSTS_PCT'			=> sprintf($this->user->lang('POST_PCT'), $percentage),
			'L_VIEW_PROFILE'	=> sprintf($this->user->lang('VIEW_USER_PROFILE'), $username),
			'JOINED'			=> $this->user->format_date($row['user_regdate'], "|$date_format|"),
			'VISITED'			=> $this->user->format_date($row['user_lastvisit'], "|$date_format|"),
			'POSTS'				=> ($row['user_posts']) ? $row['user_posts'] : 0,
			'RANK_TITLE'		=> $rank_title,
			'RANK_IMG'			=> $rank_img,
			'RANK_IMG_SRC'		=> $rank_img_src,
			'U_PROFILE'			=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
			'U_SEARCH_USER'		=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts"))
		);

		$block = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/featured_member.html', 'featured_member_block');

		return array(
			'title'		=> $this->user->lang(strtoupper($query_type) . '_MEMBER'),
			'content'	=> $block,
		);
	}
}
