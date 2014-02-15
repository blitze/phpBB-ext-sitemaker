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
 * Featured Member Block
 */
class featured_member extends \primetime\primetime\core\blocks\driver\block
{
	/**
	 * Cache
	 * @var \phpbb\cache\service
	 */
	protected $cache;

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

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/**
	 * Name of the blocks_config database table
	 * @var string
	 */
	private $blocks_config_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service			$cache					Cache object
	 * @param \phpbb\config\db				$config					Config object
	 * @param \phpbb\db\driver\driver		$db     				Database connection
	 * @param \phpbb\user					$user					User object
	 * @param string						$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string						$php_ext				php file extension
	 * @param string						$blocks_config_table	Blocks config table
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\db $config, \phpbb\db\driver\driver $db, \phpbb\user $user, $phpbb_root_path, $php_ext, $blocks_config_table)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->blocks_config_table = $blocks_config_table;

		if (!function_exists('get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
	}

	/**
	 * 
	 */
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

		$rotation_ary = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$this->user->lang['\\1'])) ? \$this->user->lang['\\1'] : '\\1'", $rotation_ary);
		$qtype_ary = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$this->user->lang['\\1'])) ? \$this->user->lang['\\1'] : '\\1'", $qtype_ary);

		$qtype = (!empty($settings['qtype'])) ? $settings['qtype'] : 'recent';
		$rotation = (!empty($settings['rotation'])) ? $settings['rotation'] : 'daily';

		return array(
			'legend1'		=> $this->user->lang['SETTINGS'],
            'qtype'			=> array('lang' => 'QUERY_TYPE', 'validate' => 'string', 'type' => 'select', 'function' => 'build_select', 'params' => array($qtype_ary, $qtype), 'default' => 'recent', 'explain' => false),
            'rotation'		=> array('lang' => 'FREQUENCY', 'validate' => 'string', 'type' => 'select', 'function' => 'build_select', 'params' => array($rotation_ary, $rotation), 'default' => 'daily', 'explain' => false),
            'userlist'		=> array('lang' => 'FEATURED_MEMBER_IDS', 'validate' => 'string', 'type' => 'textarea:3:40', 'default' => '', 'explain' => true),
		);
	}

	/**
	 * 
	 */
	public function display($bdata, $edit_mode = false)
	{
		$bid = $bdata['bid'];
		$query_type = $bdata['settings']['qtype'];
		$rotation = $bdata['settings']['rotation'];
		$current_user =& $bdata['settings']['current_user'];
		$lastchange =& $bdata['settings']['lastchange'];

		$change = $error = false;
		$reload = (($row = $this->cache->get('_block_members_' . $bid)) === false/* || cms_reset_sql_cache() === true*/) ? true : false;

		if (($rotation == 'monthly'  && $lastchange < strtotime('1 months ago')) ||
			($rotation == 'weekly'   && $lastchange < strtotime('1 weeks ago')) ||
			($rotation == 'daily'    && $lastchange < strtotime('1 days ago')) ||
			($rotation == 'hourly'   && $lastchange < strtotime('1 hours ago')) ||
			($rotation == 'pageload'))
		{
			$change = true;
		}

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
				$this->cache->put('_block_members_' . $bid, $row);
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
				global $phpbb_container;

				if (is_array($userlist))
				{
					$userlist = join(',', $userlist);
				}

				$bconfig = array(
					'qtype'			=> $query_type,
					'rotation'		=> $rotation,
					'userlist'		=> $userlist,
					'lastchange'	=> time(),
					'current_user'	=> (!empty($current_user)) ? $current_user : 0,
				);
		
				foreach ($bconfig as $var => $val)
				{
					$sql_ary[] = array(
						'bid'	=> $bid,
						'bvar'	=> $var,
						'bval'	=> $val,
					);
				}

				$sql = 'DELETE FROM ' . $this->blocks_config_table . ' WHERE bid = ' . (int) $bid;
				$this->db->sql_query($sql);
	
				$this->db->sql_multi_insert($this->blocks_config_table, $sql_ary);
				unset($userlist);

				$block_display = $phpbb_container->get('primetime.blocks.display');
				$block_display->clear_blocks_cache();
			}

			if ($error === true)
			{
				return array();
			}
		}

		$row['user_lastvisit'] = ($row['user_lastvisit']) ? $row['user_lastvisit'] : $row['user_regdate'];
		$memberdays = max(1, round((time() - $row['user_regdate']) / 86400));
		$posts_per_day = $row['user_posts'] / $memberdays;
		$percentage = ($this->config['num_posts']) ? min(100, ($row['user_posts'] / $this->config['num_posts']) * 100) : 0;

		$rank_title = $rank_img = $rank_img_src = '';
		get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);
		$username = get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']);
		$date_format = $this->user->lang['DATE_FORMAT'];

		$this->ptemplate->assign_vars(array(
			'QTYPE_EXPLAIN'		=> ($query_type == 'posts' || $query_type == 'recent') ? $this->user->lang['QTYPE_' . strtoupper($query_type)] : '',
			'TITLE_EXPLAIN'		=> ($rotation != 'pageload') ? $this->user->lang[strtoupper($rotation) . '_MEMBER'] : '',
			'USERNAME'			=> $username,
			'AVATAR_IMG'		=> get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height'], ''),
			'POSTS_DAY'			=> sprintf($this->user->lang['POST_DAY'], $posts_per_day),
			'POSTS_PCT'			=> sprintf($this->user->lang['POST_PCT'], $percentage),
			'L_VIEW_PROFILE'	=> sprintf($this->user->lang['VIEW_USER_PROFILE'], $username),
			'JOINED'			=> $this->user->format_date($row['user_regdate'], "|$date_format|"),
			'VISITED'			=> $this->user->format_date($row['user_lastvisit'], "|$date_format|"),
			'POSTS'				=> ($row['user_posts']) ? $row['user_posts'] : 0,
			'RANK_TITLE'		=> $rank_title,
			'RANK_IMG'			=> $rank_img,
			'RANK_IMG_SRC'		=> $rank_img_src,
			'U_PROFILE'			=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
			'U_SEARCH_USER'		=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts"))
		);

		$block = $this->ptemplate->render_view('primetime/primetime', 'blocks/featured_member.html', 'featured_member_block');

		return array(
			'title'		=> $this->user->lang[strtoupper($query_type) . '_MEMBER'],
			'content'	=> $block,
		);
	}
}
