<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\blocks;

use Urodoz\Truncate\TruncateService;

/**
 * Forum Topics Block
 */
class forum_topics extends \primetime\core\services\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\core\services\forum\query */
	protected $forum;

	/** @var \primetime\core\services\util */
	protected $primetime;

	/** @var Urodoz\Truncate\TruncateService */
	protected $truncate;

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth				Permission object
	 * @param \phpbb\cache\service					$cache				Cache object
	 * @param \phpbb\config\db						$config				Config object
	 * @param \phpbb\user							$user				User object
	 * @param \primetime\core\services\forum\query	$forum				Forum object
	 * @param \primetime\core\services\util			$primetime			Primetime Object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\service $cache, \phpbb\config\db $config, \phpbb\user $user, \primetime\core\services\forum\query $forum, \primetime\core\services\util $primetime, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->user = $user;
		$this->forum = $forum;
		$this->primetime = $primetime;
		$this->truncate = new TruncateService();
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		$this->user->lang += array('DATE_FORMAT' => $config['default_dateformat']);
	}

	/**
	 * 
	 */
	public function get_config($settings)
	{
		if (!function_exists('make_forum_select'))
		{
			include($this->phpbb_root_path . 'includes/functions_admin.' . $this->php_ext);
		}

		$forumlist = make_forum_select(false, false, true, false, false, false, true);

		$forum_options = array('' => 'ALL');
		foreach ($forumlist as $row)
		{
			$forum_options[$row['forum_id']] = $row['padding'] . $row['forum_name'];
		}

		$topic_type_options = array(POST_NORMAL => 'POST_NORMAL', POST_STICKY => 'POST_STICKY', POST_ANNOUNCE => 'POST_ANNOUNCEMENT', POST_GLOBAL => 'POST_GLOBAL');
		$preview_options = array('' => 'NO', 'first' => 'SHOW_FIRST_POST', 'last' => 'SHOW_LAST_POST');
		$range_options = array('' => 'ALL_TIME', 'today' => 'TODAY', 'week' => 'THIS_WEEK', 'month' => 'THIS_MONTH', 'year' => 'THIS_YEAR');
		$sort_options = array(FORUMS_ORDER_FIRST_POST	=> 'FIRST_POST_TIME', FORUMS_ORDER_LAST_POST => 'LAST_POST_TIME', FORUMS_ORDER_LAST_READ => 'LAST_READ_TIME');
		$template_options = array('titles' => 'TITLES', 'mini' => 'MINI', 'context' => 'CONTEXT');

		$forum_ids	= (isset($settings['forum_ids'])) ? $settings['forum_ids'] : '';
		$topic_type	= (isset($settings['topic_type'])) ? $settings['topic_type'] : POST_NORMAL;
		$preview	= (isset($settings['display_preview'])) ? $settings['display_preview'] : '';
		$date_range	= (isset($settings['date_range'])) ? $settings['date_range'] : '';
		$sorting	= (isset($settings['order_by'])) ? $settings['order_by'] : FORUMS_ORDER_LAST_POST;
		$template	= (isset($settings['template'])) ? $settings['template'] : 'titles';

		$preview = (!empty($preview)) ? $preview : (($template == 'context') ? 'first' : '');

		return array(
			'legend1'			=> $this->user->lang['SETTINGS'],
			'forum_ids'			=> array('lang' => 'SELECT_FORUMS', 'validate' => 'string', 'type' => 'multi_select', 'params' => array($forum_options, $forum_ids), 'default' => '', 'explain' => false),
			'topic_type'		=> array('lang' => 'TOPIC_TYPE', 'validate' => 'string', 'type' => 'checkbox', 'params' => array($topic_type_options, $topic_type), 'default' => POST_NORMAL, 'explain' => false),
			'max_topics'		=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
			'date_range'		=> array('lang' => 'LIMIT_POST_TIME', 'validate' => 'string', 'type' => 'select', 'params' => array($range_options, $date_range), 'default' => '', 'explain' => false),
			'order_by'			=> array('lang' => 'ORDER_BY', 'validate' => 'string', 'type' => 'select', 'params' => array($sort_options, $sorting), 'default' => FORUMS_ORDER_LAST_POST, 'explain' => false),

			'legend2'			=> $this->user->lang['DISPLAY'],
			'enable_tracking'	=> array('lang' => 'ENABLE_TOPIC_TRACKING', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
			'topic_title_limit'	=> array('lang' => 'TOPIC_TITLE_LIMIT', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 25),
			'display_preview'	=> array('lang' => 'DISPLAY_PREVIEW', 'validate' => 'string', 'type' => 'select', 'params' => array($preview_options, $preview), 'default' => '', 'explain' => false),
			'preview_max_chars'	=> array('lang' => 'PREVIEW_MAX_CHARS', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 125),
			'template'			=> array('lang' => 'TEMPLATE', 'validate' => 'string', 'type' => 'select', 'params' => array($template_options, $template), 'default' => 'titles', 'explain' => false),
		);
	}

	/**
	 * 
	 */
	public function display($bdata, $edit_mode = false)
	{
		$this->settings = $bdata['settings'];
		$enable_tracking = ($this->user->data['is_registered'] && $this->config['load_db_lastread'] && $this->settings['enable_tracking']) ? true : false;

		switch ($this->settings['topic_type'])
		{
			case POST_GLOBAL:
				$lang_var = 'FORUM_GLOBAL_ANNOUNCEMENTS';
			break;
			case POST_ANNOUNCE:
				$lang_var = 'FORUM_ANNOUNCEMENTS';
			break;
			case POST_STICKY:
				$lang_var = 'FORUM_STICKY_POSTS';
			break;
			case POST_NORMAL:
			default:
				$lang_var = 'FORUM_RECENT_TOPICS';
			break;
		}

		$sort_order = array(
			FORUMS_ORDER_FIRST_POST		=> 't.topic_time',
			FORUMS_ORDER_LAST_POST		=> 't.topic_last_post_time',
			FORUMS_ORDER_LAST_READ		=> 't.topic_last_view_time'
		);

		if ($this->settings['order_by'] == FORUMS_ORDER_LAST_READ)
		{
			$lang_var = 'TOPICS_LAST_READ';
		}

		$options = array(
			'forum_id'			=> $this->settings['forum_ids'],
			'topic_type'		=> $this->settings['topic_type'],
			'sort_key'			=> $sort_order[$this->settings['order_by']],
			'topic_tracking'	=> $enable_tracking,
		);

		$sql_array = array(
			'WHERE'		=> 'f.display_on_index = 1'
		);

		$this->forum->build_query($options, $sql_array);
		$topic_data = $this->forum->get_topic_data($this->settings['max_topics']);

		if (sizeof($topic_data) || $edit_mode !== false)
		{
			if ($this->settings['display_preview'])
			{
				$post_data = $this->forum->get_post_data($this->settings['display_preview']);
			}
			else
			{
				$post_data = array_fill_keys(array_keys($topic_data), array(array('post_text' => '', 'bbcode_uid' => '', 'bbcode_bitfield' => '')));
			}

			if ($this->settings['template'] == 'mini' || $this->settings['template'] == 'context')
			{
				if ($this->settings['display_preview'] == FORUMS_PREVIEW_LAST_POST)
				{
					$this->fields['time'] = 'topic_last_post_time';
					$this->fields['user_id'] = 'topic_last_poster_id';
					$this->fields['username'] = 'topic_last_poster_name';
					$this->fields['user_colour'] = 'topic_last_poster_colour';

					$this->ptemplate->assign_var('L_POST_BY_AUTHOR', $this->user->lang['LAST_POST_BY_AUTHOR']);
				}
				else
				{
					$this->fields['time'] = 'topic_time';
					$this->fields['user_id'] = 'topic_poster';
					$this->fields['username'] = 'topic_first_poster_name';
					$this->fields['user_colour'] = 'topic_first_poster_colour';
				}
			}

			if ($enable_tracking)
			{
				$this->topic_tracking_info = $this->forum->get_topic_tracking_info();
			}

			$view = 'S_' . strtoupper($this->settings['template']);
			$method = 'forum_topics_' . $this->settings['template'];
			$topic_data = array_values($topic_data);

			$this->$method($topic_data, $post_data);
			unset($topic_data, $post_data);

			$this->ptemplate->assign_vars(array(
				$view				=> true,
				'S_IS_BOT'			=> $this->user->data['is_bot'],
				'LAST_POST_IMG'		=> $this->user->img('icon_topic_latest'),
				'NEWEST_POST_IMG'	=> $this->user->img('icon_topic_newest')
			));

			return array(
				'title'		=> $this->user->lang[$lang_var],
				'content'	=> $this->ptemplate->render_view('primetime/core', 'blocks/forum_topics.html', 'forum_topics_block')
			);
		}
	}

	private function forum_topics_titles(&$topic_data, &$post_data)
	{
		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$row =& $topic_data[$i];
			$forum_id = $row['forum_id'];
			$topic_id = $row['topic_id'];

			$post_row = array_pop($post_data[$topic_id]);
			strip_bbcode($post_row['post_text'], $post_row['bbcode_uid']);

			$tpl_ary = array(
				'FORUM_TITLE'	=> $row['forum_name'],
				'TOPIC_TITLE'	=> truncate_string(censor_text($row['topic_title']), $this->settings['topic_title_limit'], 255, false, '...'),
				'TOPIC_AUTHOR'	=> get_username_string('full', $row['topic_poster'], $row['topic_first_poster_name'], $row['topic_first_poster_colour']),
				'TOPIC_PREVIEW'	=> truncate_string($post_row['post_text'], $this->settings['preview_max_chars'], 255, false, '...'),
				'S_UNREAD_TOPIC'=> (isset($this->topic_tracking_info[$forum_id][$topic_id]) && $row['topic_last_post_time'] > $this->topic_tracking_info[$forum_id][$topic_id]) ? true : false,
				'U_VIEWFORUM'	=> append_sid($this->phpbb_root_path . 'viewforum.' . $this->php_ext, "f=$forum_id"),
				'U_VIEWTOPIC'	=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	private function forum_topics_lastread(&$topic_data, &$post_data)
	{
		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$row =& $topic_data[$i];
			$forum_id = $row['forum_id'];
			$topic_id = $row['topic_id'];

			$tpl_ary = array(
				'TOPIC_TITLE'		=> truncate_string(censor_text($row['topic_title']), $this->settings['topic_title_limit'], 255, false, '...'),
				'TOPIC_READ'		=> sprintf($this->user->lang['TOPIC_LAST_READ'], $this->user->format_date($row['topic_last_view_time'], $this->user->lang['DATE_FORMAT'])),
				'S_UNREAD_TOPIC'	=> (isset($this->topic_tracking_info[$forum_id][$topic_id]) && $row['topic_last_post_time'] > $this->topic_tracking_info[$forum_id][$topic_id]) ? true : false,
				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	private function forum_topics_mini(&$topic_data, &$post_data)
	{
		global $phpbb_container;

		$phpbb_content_visibility = $phpbb_container->get('content.visibility');

		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$row =& $topic_data[$i];
			$forum_id = $row['forum_id'];
			$topic_id = $row['topic_id'];

			$post_row = array_pop($post_data[$topic_id]);
			strip_bbcode($post_row['post_text'], $post_row['bbcode_uid']);

			$tpl_ary = array(
				'FORUM_TITLE'		=> $row['forum_name'],
				'TOPIC_TITLE'		=> truncate_string(censor_text($row['topic_title']), $this->settings['topic_title_limit'], 255, false, '...'),
				'TOPIC_AUTHOR'		=> get_username_string('full', $row[$this->fields['user_id']], $row[$this->fields['username']], $row[$this->fields['user_colour']]),
				'TOPIC_PREVIEW'		=> truncate_string($post_row['post_text'], $this->settings['preview_max_chars'], 255, false, '...'),
				'TOPIC_POST_TIME'	=> $this->user->format_date($row[$this->fields['time']]),
				'ATTACH_ICON_IMG'	=> ($this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id) && $row['topic_attachment']) ? $this->user->img('icon_topic_attach', $this->user->lang['TOTAL_ATTACHMENTS']) : '',
				'REPLIES'			=> $phpbb_content_visibility->get_count('topic_posts', $row, $forum_id) - 1,
				'VIEWS'				=> $row['topic_views'],
				'S_UNREAD_TOPIC'	=> (isset($this->topic_tracking_info[$forum_id][$topic_id]) && $row['topic_last_post_time'] > $this->topic_tracking_info[$forum_id][$topic_id]) ? true : false,

				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
				'U_VIEWFORUM'		=> append_sid($this->phpbb_root_path . 'viewforum.' . $this->php_ext, "f=$forum_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	private function forum_topics_context(&$topic_data, &$post_data)
	{
		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$topic_row =& $topic_data[$i];
			$forum_id = $topic_row['forum_id'];
			$topic_id = $topic_row['topic_id'];
			$post_row = array_pop($post_data[$topic_id]);

			$context = generate_text_for_display($post_row['post_text'], $post_row['bbcode_uid'], $post_row['bbcode_bitfield'], 7);
			$context = $this->truncate->truncate($context, $this->settings['preview_max_chars']);

			$tpl_ary = array(
				'TOPIC_TITLE'		=> truncate_string(censor_text($topic_row['topic_title']), $this->settings['topic_title_limit']),
				'TOPIC_AUTHOR'		=> get_username_string('full', $topic_row[$this->fields['user_id']], $topic_row[$this->fields['username']], $topic_row[$this->fields['user_colour']]),
				'TOPIC_POST_TIME'	=> $this->user->format_date($topic_row[$this->fields['time']], $this->user->lang['DATE_FORMAT']),
				'TOPIC_CONTEXT'		=> $context,
				'S_UNREAD_TOPIC'	=> (isset($this->topic_tracking_info[$forum_id][$topic_id]) && $topic_row['topic_last_post_time'] > $this->topic_tracking_info[$forum_id][$topic_id]) ? true : false,
				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}
}
