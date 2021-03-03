<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Recent Topics Block
 */
class recent_topics extends forum_topics
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var int */
	protected $start = 0;

	/** @var int */
	protected $total_topics = 0;

	/** @var string */
	protected $param;

	/** @var string */
	protected $block;

	/** @var array */
	protected $topic_type_class = [
		POST_GLOBAL		=> ' global-announce',
		POST_ANNOUNCE	=> ' announce',
		POST_STICKY		=> ' sticky',
		POST_NORMAL		=> '',
	];

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
	 * @param \phpbb\cache\service						$cache				Cache Service object
	 * @param \phpbb\request\request_interface			$request			Request object
	 * @param \phpbb\pagination							$pagination			Pagination object
	 * @param \phpbb\template\template					$template			Template object
	 */
	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\content_visibility $content_visibility,
		\phpbb\language\language $translator,
		\phpbb\user $user,
		\Urodoz\Truncate\TruncateService $truncator,
		\blitze\sitemaker\services\date_range $date_range,
		\blitze\sitemaker\services\forum\data $forum_data,
		\blitze\sitemaker\services\forum\options $forum_options,
		$phpbb_root_path,
		$php_ext,
		\phpbb\cache\service $cache,
		\phpbb\request\request_interface $request,
		\phpbb\pagination $pagination,
		\phpbb\template\template $template
	)
	{
		parent::__construct($auth, $content_visibility, $translator, $user, $truncator, $date_range, $forum_data, $forum_options, $phpbb_root_path, $php_ext);

		$this->cache = $cache;
		$this->request = $request;
		$this->pagination = $pagination;
		$this->template = $template;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$orig_config = parent::get_config($settings);
		$config = $orig_config;
		$config['max_topics']['default'] = 5;
		$config['max_topics']['lang'] = 'TOPICS_PER_PAGE';
		unset($config['template'], $config['context']);

		$config['date_range']	= array('lang' => 'TOPICS_LOOK_BACK', 'validate' => 'int:0:255', 'type' => 'number:1:255', 'maxlength' => 3, 'default' => 60, 'append' => 'DAYS');
		$config['last_post']	= array('lang' => 'SHOW_LAST_POST', 'validate' => 'bool', 'type' => 'radio:yes_no', 'default' => true);

		$keys = array_keys($config);
		$keys[array_search('max_topics', $keys)] = 'per_page';
		$keys[array_search('date_range', $keys)] = 'look_back';

		return array_combine($keys, $config);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$this->icons = $this->cache->obtain_icons();
		$this->param = 'pg' . $bdata['bid'];
		$this->block = 'bk-' . $bdata['bid'];

		$bdata['settings']['context'] = 'last';
		$bdata['settings']['template'] = '';
		$bdata['settings']['date_range'] = '';

		if (!$bdata['settings']['last_post'])
		{
			$bdata['settings']['preview_chars'] = 0;
		}

		return parent::display($bdata, $edit_mode);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function get_block_content(array $topic_data)
	{
		$base_url = trim(build_url(array($this->param)), '?');

		return array_merge(
			parent::get_block_content($topic_data),
			array(
				'T_ICONS_PATH'	=> $this->template->retrieve_var('T_ICONS_PATH'),
				'S_LAST_POST'	=> $this->settings['last_post'],
				'TOTAL_PAGES'	=> ceil($this->total_topics / $this->settings['per_page']),
				'CURRENT_PAGE'	=> $this->start + 1,
				'BLOCK_ID'		=> $this->block,
				'BASE_URL'		=> $base_url . '#' . $this->block,
				'PAGE_URL'		=> $base_url . (strpos($base_url, '?') === false ? '?' : '&amp;') . $this->param . '=%s#' . $this->block,
			)
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function build_query()
	{
		parent::build_query();
		$this->forum_data->fetch_custom(array(
			'WHERE' => array($this->sort_order[$this->settings['order_by']] . ' > ' . (time() - ($this->settings['look_back'] * 24 * 3600))),
		));
		$this->forum_data->fetch_db_track();
	}

	/**
	 * {@inheritdoc}
	 */
	protected function get_topic_data()
	{
		$this->set_start_page();

		return $this->forum_data->get_topic_data($this->settings['per_page'], $this->start * $this->settings['per_page']);
	}

	/**
	 * @return void
	 */
	protected function set_start_page()
	{
		$page = $this->request->variable($this->param, 1);

		$this->total_topics = $this->forum_data->get_topics_count();
		$this->start = $this->pagination->validate_start($page - 1, $this->settings['per_page'], $this->total_topics);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function get_topics_template_data(array &$topic_data, array &$post_data, array $user_data)
	{
		$template_data = parent::get_topics_template_data($topic_data, $post_data, $user_data);

		$replies = $template_data['REPLIES'];
		$unread_topic = $template_data['S_UNREAD_TOPIC'];

		// Get folder img, topic status/type related information
		$folder_img = $folder_alt = $topic_type = '';
		topic_status($topic_data, $replies, $unread_topic, $folder_img, $folder_alt, $topic_type);

		$template_data['S_HAS_POLL']			= (bool) $topic_data['poll_start'];
		$template_data['S_TOPIC_ICONS']			= (bool) $topic_data['enable_icons'];
		$template_data['TOPIC_IMG_STYLE']		= $folder_img;
		$template_data['TOPIC_FOLDER_IMG']		= $this->user->img($folder_img, $folder_alt);
		$template_data['TOPIC_FOLDER_IMG_ALT']	= $this->user->lang[$folder_alt];
		$template_data['TOPIC_TYPE_CLASS']		= $this->topic_type_class[$topic_data['topic_type']];
		$template_data['TOPIC_TIME_RFC3339']	= gmdate(DATE_RFC3339, $topic_data['topic_time']);
		$template_data['LAST_POST_TIME_RFC3339'] = gmdate(DATE_RFC3339, $topic_data['topic_last_post_time']);

		if (!empty($this->icons[$topic_data['icon_id']]))
		{
			$template_data['TOPIC_ICON_IMG']		= $this->icons[$topic_data['icon_id']]['img'];
			$template_data['TOPIC_ICON_IMG_WIDTH']	= $this->icons[$topic_data['icon_id']]['width'];
			$template_data['TOPIC_ICON_IMG_HEIGHT']	= $this->icons[$topic_data['icon_id']]['height'];
		}

		return $template_data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '@blitze_sitemaker/blocks/recent_topics.html';
	}
}
