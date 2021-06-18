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
 * Forum Topics Block
 */
class forum_topics extends forum_topics_config
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var \Urodoz\Truncate\TruncateService */
	protected $truncator;

	/** @var \blitze\sitemaker\services\date_range */
	protected $date_range;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum_data;

	/** @var \blitze\sitemaker\services\forum\options */
	protected $forum_options;

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
	 * @param \phpbb\auth\auth							$auth				Permission object
	 * @param \phpbb\content_visibility					$content_visibility	Content visibility object
	 * @param \phpbb\language\language					$translator			Language object
	 * @param \phpbb\user								$user				User object
	 * @param \Urodoz\Truncate\TruncateService			$truncator			Truncator service
	 * @param \blitze\sitemaker\services\date_range		$date_range			Date Range Object
	 * @param \blitze\sitemaker\services\forum\data		$forum_data			Forum Data object
	 * @param \blitze\sitemaker\services\forum\options	$forum_options		Forum Data object
	 * @param string									$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string									$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\content_visibility $content_visibility, \phpbb\language\language $translator, \phpbb\user $user, \Urodoz\Truncate\TruncateService $truncator, \blitze\sitemaker\services\date_range $date_range, \blitze\sitemaker\services\forum\data $forum_data, \blitze\sitemaker\services\forum\options $forum_options, $phpbb_root_path, $php_ext)
	{
		parent::__construct($forum_options);

		$this->auth = $auth;
		$this->content_visibility = $content_visibility;
		$this->translator = $translator;
		$this->user = $user;
		$this->truncator = $truncator;
		$this->date_range = $date_range;
		$this->forum_data = $forum_data;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$this->settings = $bdata['settings'];

		$topic_data = $this->get_topic_data();

		$data = null;
		if (sizeof($topic_data))
		{
			$data = $this->get_block_content($topic_data);
		}

		return array(
			'title'	=> $this->get_block_title(),
			'data'	=> $data,
		);
	}

	/**
	 * @param array $topic_data
	 * @return array
	 */
	protected function get_block_content(array $topic_data)
	{
		$this->set_display_fields();

		$post_data = $this->get_post_data($topic_data);
		$topic_data = array_values($topic_data);

		return array(
			'CONTEXT'			=> $this->settings['context'],
			'TEMPLATE'			=> $this->settings['template'],
			'TOPICS'			=> $this->get_topics($topic_data, $post_data),
			'S_IS_BOT'			=> $this->user->data['is_bot'],
			'LAST_POST_IMG'		=> $this->user->img('icon_topic_latest'),
			'NEWEST_POST_IMG'	=> $this->user->img('icon_topic_newest'),
		);
	}

	/**
	 * @param array $topic_data
	 * @param array $post_data
	 * @return array
	 */
	protected function get_topics(array &$topic_data, array &$post_data)
	{
		$user_data = $this->forum_data->get_posters_info();

		$topics = [];
		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$row = $topic_data[$i];
			$forum_id = $row['forum_id'];
			$topic_id = $row['topic_id'];
			$author = $user_data[$row[$this->fields['user_id']]];
			$last_poster = $user_data[$row['topic_last_poster_id']];

			$topics[] = array(
				'USERNAME'			=> $author['username_full'],
				'AVATAR'			=> $author['avatar'],
				'LAST_POSTER'		=> $last_poster['username_full'],
				'LAST_AVATAR'		=> $last_poster['avatar'],

				'FORUM_TITLE'		=> $row['forum_name'],
				'TOPIC_TITLE'		=> truncate_string(censor_text($row['topic_title']), $this->settings['topic_title_limit'], 255, false, '...'),
				'TOPIC_PREVIEW'		=> $this->get_post_preview(array_pop($post_data[$topic_id])),
				'TOPIC_POST_TIME'	=> $this->user->format_date($row[$this->fields['time']]),
				'ATTACH_ICON_IMG'	=> $this->get_attachment_icon($forum_id, $row['topic_attachment']),
				'REPLIES'			=> $this->content_visibility->get_count('topic_posts', $row, $forum_id) - 1,
				'VIEWS'				=> (int) $row['topic_views'],
				'S_UNREAD_TOPIC'	=> $this->is_unread_topic($forum_id, $topic_id, $row['topic_last_post_time']),

				'U_VIEWPROFILE'		=> $author['u_viewprofile'],
				'U_VIEWTOPIC'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
				'U_VIEWFORUM'		=> append_sid($this->phpbb_root_path . 'viewforum.' . $this->php_ext, "f=$forum_id"),
				'U_NEW_POST'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id&amp;view=unread") . '#unread',
				'U_LAST_POST'		=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id&amp;p=" . $row['topic_last_post_id']) . '#p' . $row['topic_last_post_id'],
			);
			unset($topic_data[$i], $post_data[$topic_id]);
		}

		return $topics;
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

		// if more than one topic type is selected, we default to RECENT_TOPICS
		$topic_type = join(',', $this->settings['topic_type']);

		return ($this->settings['order_by'] !== self::FORUMS_ORDER_LAST_READ) ? (isset($types[$topic_type]) ? $types[$topic_type] : 'FORUM_RECENT_TOPICS') : 'TOPICS_LAST_READ';
	}

	/**
	 * @param array $row
	 * @return string
	 */
	protected function get_post_preview(array $row)
	{
		$preview = '';
		if ($this->settings['preview_chars'])
		{
			$method = ($this->settings['template'] === 'context') ? 'get_trimmed_text' : 'get_tooltip_text';
			$preview = call_user_func_array(array($this, $method), array($row));
		}

		return $preview;
	}

	/**
	 * @param array $row
	 */
	protected function get_trimmed_text(array $row)
	{
		$parse_flags = ($row['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;
		$row['post_text'] = generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $parse_flags, true);

		return $this->truncator->truncate($row['post_text'], $this->settings['preview_chars']);
	}

	/**
	 * @param array $row
	 * @return string
	 */
	protected function get_tooltip_text(array $row)
	{
		strip_bbcode($row['post_text'], $row['bbcode_uid']);

		$row['post_text'] = truncate_string($row['post_text'], $this->settings['preview_chars']);
		return wordwrap($row['post_text'], 40, "\n");
	}

	/**
	 * @return array
	 */
	private function get_topic_data()
	{
		$sort_order = array(
			self::FORUMS_ORDER_FIRST_POST		=> 't.topic_time',
			self::FORUMS_ORDER_LAST_POST		=> 't.topic_last_post_time',
			self::FORUMS_ORDER_LAST_READ		=> 't.topic_last_view_time'
		);

		$range_info = $this->date_range->get($this->settings['date_range']);

		$this->forum_data->query($this->settings['enable_tracking'])
			->fetch_forum($this->settings['forum_ids'])
			->fetch_topic_type($this->settings['topic_type'])
			->fetch_date_range($range_info['start'], $range_info['stop'])
			->set_sorting($sort_order[$this->settings['order_by']])
			->build();

		$topic_data = $this->forum_data->get_topic_data($this->settings['max_topics']);
		$this->topic_tracking_info = $this->forum_data->get_topic_tracking_info();

		return $topic_data;
	}

	/**
	 * @param array $topic_data
	 * @return array
	 */
	private function get_post_data(array $topic_data)
	{
		if ($this->settings['context'] && $this->settings['preview_chars'])
		{
			$post_data = $this->forum_data->get_post_data($this->settings['context']);
		}
		else
		{
			$post_data = array_fill_keys(array_keys($topic_data), array(array('post_text' => '', 'bbcode_uid' => '', 'bbcode_bitfield' => '')));
		}

		return $post_data;
	}

	/**
	 * @return void
	 */
	private function set_display_fields()
	{
		if ($this->settings['context'] === 'last')
		{
			$this->fields['time'] = 'topic_last_post_time';
			$this->fields['user_id'] = 'topic_last_poster_id';
		}
		else
		{
			$this->fields['time'] = 'topic_time';
			$this->fields['user_id'] = 'topic_poster';
		}
	}

	/**
	 * @param int $forum_id
	 * @param int $topic_attachment
	 * @return string
	 */
	private function get_attachment_icon($forum_id, $topic_attachment)
	{
		return ($this->user_can_view_attachments($forum_id) && $topic_attachment) ? $this->user->img('icon_topic_attach', $this->translator->lang('TOTAL_ATTACHMENTS')) : '';
	}

	/**
	 * @param int $forum_id
	 * @return bool
	 */
	private function user_can_view_attachments($forum_id)
	{
		return ($this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id)) ? true : false;
	}

	/**
	 * @param int $forum_id
	 * @param int $topic_id
	 * @param int $topic_last_post_time
	 * @return bool
	 */
	private function is_unread_topic($forum_id, $topic_id, $topic_last_post_time)
	{
		return (isset($this->topic_tracking_info[$forum_id][$topic_id]) && $topic_last_post_time > $this->topic_tracking_info[$forum_id][$topic_id]) ? true : false;
	}
}
