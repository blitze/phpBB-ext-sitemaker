<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use Urodoz\Truncate\TruncateService;

/**
 * Forum Topics Block
 */
class forum_topics extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum;

	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/** @var \Urodoz\Truncate\TruncateService */
	protected $truncate;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var array */
	private $fields = array();

	/** @var array */
	private $settings = array();

	/** @var array */
	private $topic_tracking_info = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth				Permission object
	 * @param \phpbb\cache\driver\driver_interface	$cache				Cache driver interface
	 * @param \phpbb\config\config					$config				Config object
	 * @param \phpbb\content_visibility				content_visibility	Content visibility object
	 * @param \phpbb\user							$user				User object
	 * @param \blitze\sitemaker\services\forum\data	$forum				Forum Data object
	 * @param \blitze\sitemaker\services\util		$sitemaker			Sitemaker Object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\content_visibility $content_visibility, \phpbb\user $user, \blitze\sitemaker\services\forum\data $forum, \blitze\sitemaker\services\util $sitemaker, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->user = $user;
		$this->forum = $forum;
		$this->sitemaker = $sitemaker;
		$this->truncate = new TruncateService();
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		$this->user->lang += array('DATE_FORMAT' => $config['default_dateformat']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config($settings)
	{
		$forum_options = $this->_get_forum_options();
		$topic_type_options = $this->_get_topic_type_options();
		$preview_options = $this->_get_preview_options();
		$range_options = $this->_get_range_options();
		$sort_options = $this->_get_sorting_options();
		$template_options = $this->_get_view_options();

		return array(
			'legend1'			=> $this->user->lang('SETTINGS'),
			'forum_ids'			=> array('lang' => 'SELECT_FORUMS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $forum_options, 'default' => array(), 'explain' => false),
			'topic_type'		=> array('lang' => 'TOPIC_TYPE', 'validate' => 'string', 'type' => 'checkbox', 'options' => $topic_type_options, 'default' => array(POST_NORMAL), 'explain' => false),
			'max_topics'		=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
			'date_range'		=> array('lang' => 'LIMIT_POST_TIME', 'validate' => 'string', 'type' => 'select', 'options' => $range_options, 'default' => '', 'explain' => false),
			'order_by'			=> array('lang' => 'ORDER_BY', 'validate' => 'string', 'type' => 'select', 'options' => $sort_options, 'default' => FORUMS_ORDER_LAST_POST, 'explain' => false),

			'legend2'			=> $this->user->lang('DISPLAY'),
			'enable_tracking'	=> array('lang' => 'ENABLE_TOPIC_TRACKING', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
			'topic_title_limit'	=> array('lang' => 'TOPIC_TITLE_LIMIT', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 25),
			'template'			=> array('lang' => 'TEMPLATE', 'validate' => 'string', 'type' => 'select', 'options' => $template_options, 'default' => 'titles', 'explain' => false),
			'display_preview'	=> array('lang' => 'DISPLAY_PREVIEW', 'validate' => 'string', 'type' => 'select', 'options' => $preview_options, 'default' => '', 'explain' => false),
			'preview_max_chars'	=> array('lang' => 'PREVIEW_MAX_CHARS', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 125),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display($bdata, $edit_mode = false)
	{
		$this->settings = $bdata['settings'];

		$topic_data = $this->_get_topic_data();

		$content = '';
		if (sizeof($topic_data))
		{
			$this->_set_display_fields();

			$view = 'S_' . strtoupper($this->settings['template']);
			$method = 'forum_topics_' . $this->settings['template'];
			$post_data = $this->_get_post_data($topic_data);
			$topic_data = array_values($topic_data);

			$this->$method($topic_data, $post_data);
			unset($topic_data, $post_data);

			$this->ptemplate->assign_vars(array(
				$view				=> true,
				'S_IS_BOT'			=> $this->user->data['is_bot'],
				'LAST_POST_IMG'		=> $this->user->img('icon_topic_latest'),
				'NEWEST_POST_IMG'	=> $this->user->img('icon_topic_newest'),
			));

			$content = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/forum_topics.html', 'forum_topics_block');
		}

		return array(
			'title'		=> $this->get_block_title(),
			'content'	=> $content,
		);
	}

	/**
	 * @param array $topic_data
	 * @param array $post_data
	 */
	protected function forum_topics_titles(array &$topic_data, array &$post_data)
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
				'S_UNREAD_TOPIC'=> $this->_is_unread_topic($forum_id, $topic_id, $row['topic_last_post_time']),
				'U_VIEWFORUM'	=> append_sid($this->phpbb_root_path . 'viewforum.' . $this->php_ext, "f=$forum_id"),
				'U_VIEWTOPIC'	=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	/**
	 * @param array $topic_data
	 * @param array $post_data
	 */
	protected function forum_topics_lastread(array &$topic_data, array &$post_data)
	{
		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$row =& $topic_data[$i];
			$forum_id = $row['forum_id'];
			$topic_id = $row['topic_id'];

			$tpl_ary = array(
				'TOPIC_TITLE'		=> truncate_string(censor_text($row['topic_title']), $this->settings['topic_title_limit'], 255, false, '...'),
				'TOPIC_READ'		=> $this->user->lang('TOPIC_LAST_READ', $this->user->format_date($row['topic_last_view_time'], $this->user->lang['DATE_FORMAT'])),
				'S_UNREAD_TOPIC'	=> $this->_is_unread_topic($forum_id, $topic_id, $row['topic_last_post_time']),
				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	/**
	 * @param array $topic_data
	 * @param array $post_data
	 */
	protected function forum_topics_mini(array &$topic_data, array &$post_data)
	{
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
				'ATTACH_ICON_IMG'	=> $this->_get_attachment_icon($forum_id, $row['topic_attachment']),
				'REPLIES'			=> $this->content_visibility->get_count('topic_posts', $row, $forum_id) - 1,
				'VIEWS'				=> $row['topic_views'],
				'S_UNREAD_TOPIC'	=> $this->_is_unread_topic($forum_id, $topic_id, $row['topic_last_post_time']),

				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
				'U_VIEWFORUM'		=> append_sid($this->phpbb_root_path . 'viewforum.' . $this->php_ext, "f=$forum_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	/**
	 * @param array $topic_data
	 * @param array $post_data
	 */
	protected function forum_topics_context(array &$topic_data, array &$post_data)
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
				'S_UNREAD_TOPIC'	=> $this->_is_unread_topic($forum_id, $topic_id, $topic_row['topic_last_post_time']),
				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			);

			$this->ptemplate->assign_block_vars('topicrow', $tpl_ary);
			unset($topic_data[$i], $post_data[$topic_id]);
		}
	}

	/**
	 * @return string
	 */
	protected function get_block_title()
	{
		$types = array(
			POST_GLOBAL		=> 'FORUM_GLOBAL_ANNOUNCEMENTS',
			POST_ANNOUNCE	=> 'FORUM_ANNOUNCEMENTS',
			POST_STICKY		=> 'FORUM_STICKY_POSTS',
			POST_NORMAL		=> 'FORUM_RECENT_TOPICS',
		);

		$topic_type = $this->settings['topic_type'];
		$lang_var = ($this->settings['order_by'] != FORUMS_ORDER_LAST_READ) ? (isset($types[$topic_type]) ? $types[$topic_type] : 'FORUM_RECENT_TOPICS') : 'TOPICS_LAST_READ';

		return $this->user->lang($lang_var);
	}

	/**
	 * @return array
	 */
	private function _get_topic_data()
	{
		$sort_order = array(
			FORUMS_ORDER_FIRST_POST		=> 't.topic_time',
			FORUMS_ORDER_LAST_POST		=> 't.topic_last_post_time',
			FORUMS_ORDER_LAST_READ		=> 't.topic_last_view_time'
		);

		$range_info = $this->sitemaker->get_date_range($this->settings['date_range']);

		$this->forum->query()
			->fetch_forum($this->settings['forum_ids'])
			->fetch_topic_type($this->settings['topic_type'])
			->fetch_tracking_info($this->settings['enable_tracking'])
			->fetch_date_range($range_info['start'], $range_info['stop'])
			->set_sorting($sort_order[$this->settings['order_by']])
			->fetch_custom(array(
				'WHERE'		=> array('f.display_on_index = 1'),
			))
			->build();

		$topic_data = $this->forum->get_topic_data($this->settings['max_topics']);
		$this->topic_tracking_info = $this->forum->get_topic_tracking_info();

		return $topic_data;
	}

	/**
	 * @param array $topic_data
	 * @return array
	 */
	private function _get_post_data(array $topic_data)
	{
		if ($this->settings['display_preview'])
		{
			$post_data = $this->forum->get_post_data($this->settings['display_preview']);
		}
		else
		{
			$post_data = array_fill_keys(array_keys($topic_data), array(array('post_text' => '', 'bbcode_uid' => '', 'bbcode_bitfield' => '')));
		}

		return $post_data;
	}

	/**
	 *
	 */
	private function _set_display_fields()
	{
		if ($this->settings['template'] == 'mini' || $this->settings['template'] == 'context')
		{
			if ($this->settings['display_preview'] == FORUMS_PREVIEW_LAST_POST)
			{
				$this->fields['time'] = 'topic_last_post_time';
				$this->fields['user_id'] = 'topic_last_poster_id';
				$this->fields['username'] = 'topic_last_poster_name';
				$this->fields['user_colour'] = 'topic_last_poster_colour';

				$this->ptemplate->assign_var('L_POST_BY_AUTHOR', $this->user->lang('LAST_POST_BY_AUTHOR'));
			}
			else
			{
				$this->fields['time'] = 'topic_time';
				$this->fields['user_id'] = 'topic_poster';
				$this->fields['username'] = 'topic_first_poster_name';
				$this->fields['user_colour'] = 'topic_first_poster_colour';
			}
		}
	}

	/**
	 * @param int $forum_id
	 * @param int $topic_attachment
	 * @return string
	 */
	private function _get_attachment_icon($forum_id, $topic_attachment)
	{
		return ($this->_user_can_view_attachments($forum_id) && $topic_attachment) ? $this->user->img('icon_topic_attach', $this->user->lang['TOTAL_ATTACHMENTS']) : '';
	}

	/**
	 * @param int $forum_id
	 * @return bool
	 */
	private function _user_can_view_attachments($forum_id)
	{
		return ($this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id)) ? true : false;
	}

	/**
	 * @param int $forum_id
	 * @param int $topic_id
	 * @param int $topic_last_post_time
	 * @return bool
	 */
	private function _is_unread_topic($forum_id, $topic_id, $topic_last_post_time)
	{
		return (isset($this->topic_tracking_info[$forum_id][$topic_id]) && $topic_last_post_time > $this->topic_tracking_info[$forum_id][$topic_id]) ? true : false;
	}

	/**
	 * @return array
	 */
	private function _get_forum_options()
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

		return $forum_options;
	}

	/**
	 * @return array
	 */
	private function _get_topic_type_options()
	{
		return array(
			POST_NORMAL     => 'POST_NORMAL',
			POST_STICKY     => 'POST_STICKY',
			POST_ANNOUNCE   => 'POST_ANNOUNCEMENT',
			POST_GLOBAL     => 'POST_GLOBAL',
		);
	}

	/**
	 * @return array
	 */
	private function _get_preview_options()
	{
		return array(
			''      => 'NO',
			'first' => 'SHOW_FIRST_POST',
			'last'  => 'SHOW_LAST_POST',
		);
	}

	/**
	 * @return array
	 */
	private function _get_range_options()
	{
		return array(
			''      => 'ALL_TIME',
			'today' => 'TODAY',
			'week'  => 'THIS_WEEK',
			'month' => 'THIS_MONTH',
			'year'  => 'THIS_YEAR',
		);
	}

	/**
	 * @return array
	 */
	private function _get_sorting_options()
	{
		return array(
			FORUMS_ORDER_FIRST_POST => 'FIRST_POST_TIME',
			FORUMS_ORDER_LAST_POST  => 'LAST_POST_TIME',
			FORUMS_ORDER_LAST_READ  => 'LAST_READ_TIME',
		);
	}

	/**
	 * @return array
	 */
	private function _get_view_options()
	{
		return array(
			'titles'    => 'TITLES',
			'mini'      => 'MINI',
			'context'   => 'CONTEXT',
		);
	}
}
