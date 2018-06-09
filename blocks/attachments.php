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
 * Attachments Block
 */
class attachments extends block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\service */
	protected $cache;

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
	private $settings = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth				Permission object
	 * @param \phpbb\cache\service						$cache				Cache Service object
	 * @param \blitze\sitemaker\services\date_range		$date_range			Date Range Object
	 * @param \blitze\sitemaker\services\forum\data		$forum_data			Forum Data object
	 * @param \blitze\sitemaker\services\forum\options	$forum_options		Forum Options object
	 * @param string									$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string									$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\service $cache, \blitze\sitemaker\services\date_range $date_range, \blitze\sitemaker\services\forum\data $forum_data, \blitze\sitemaker\services\forum\options $forum_options, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->date_range = $date_range;
		$this->forum_data = $forum_data;
		$this->forum_options = $forum_options;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * @inheritdoc
	 */
	public function get_config(array $settings)
	{
		$forum_options = $this->forum_options->get_all();
		$topic_type_options = $this->forum_options->get_topic_types();
		$range_options = $this->get_range_options();
		$attach_type_options = array('' => 'ALL_TYPES', 'IMAGES' => 'IMAGES', 'ARCHIVES' => 'ARCHIVES');
		$id_type_options = array('topic' => 'TOPICS', 'post' => 'POSTS');

		return array(
			'legend1'			=> 'SETTINGS',
			'forum_ids'			=> array('lang' => 'SELECT_FORUMS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $forum_options, 'default' => array(), 'explain' => false),
			'topic_type'		=> array('lang' => 'TOPIC_TYPE', 'validate' => 'string', 'type' => 'checkbox', 'options' => $topic_type_options, 'default' => array(), 'explain' => false),
			'first_only'		=> array('lang' => 'FIRST_POST_ONLY', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
			'ids_type'			=> array('lang' => 'TOPIC_POST_IDS_TYPE', 'validate' => 'bool', 'type' => 'radio', 'options' => $id_type_options, 'explain' => false, 'default' => 'topic'),
			'ids'				=> array('lang' => 'TOPIC_POST_IDS', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
			'date_range'		=> array('lang' => 'LIMIT_POST_TIME', 'validate' => 'string', 'type' => 'select', 'options' => $range_options, 'default' => '', 'explain' => false),
			'limit'				=> array('lang' => 'LIMIT', 'validate' => 'int:0', 'type' => 'number:0', 'maxlength' => 2, 'explain' => false, 'default' => 5),
			'ext_type'			=> array('lang' => 'EXTENSION_GROUP', 'validate' => 'string', 'type' => 'radio', 'options' => $attach_type_options, 'default' => '', 'explain' => false),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$this->settings = $bdata['settings'];

		$extensions = $this->cache->obtain_attach_extensions(0);
		$ext_groups = $this->get_extension_groups($extensions);

		$posts_data = $this->get_posts_data();
		$attachments = $this->forum_data->get_attachments(0, $ext_groups[$this->settings['ext_type']], $this->settings['limit'], false);

		$content = '';
		if (sizeof($attachments))
		{
			$this->get_block_content($attachments, $posts_data, $extensions);

			$content = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/attachments.html', 'attachments');
		}

		return array(
			'title'		=> 'ATTACHMENTS',
			'content'	=> $content,
		);
	}

	/**
	 * @param array $attachments_ary
	 * @param array $posts_data
	 * @param array $extensions
	 */
	protected function get_block_content(array $attachments_ary, array $posts_data, array $extensions)
	{
		$message = '';
		$update_count = array();

		foreach ($attachments_ary as $post_id => $attachments)
		{
			$topic_id = $attachments[0]['topic_id'];
			$post_row = $posts_data[$topic_id][$post_id];

			parse_attachments($post_row['forum_id'], $message, $attachments, $update_count, true);

			$this->ptemplate->assign_block_vars('postrow', array());
			foreach ($attachments as $i => $attachment)
			{
				$row = $attachments_ary[$post_id][$i];
				$topic_id = $row['topic_id'];
				$post_id = $row['post_msg_id'];

				$this->ptemplate->assign_block_vars('postrow.attachment', array(
					'DISPLAY_ATTACHMENT'	=> $attachment,
					'EXTENSION_GROUP'		=> $extensions[$row['extension']]['group_name'],
					'U_VIEWTOPIC'			=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", "t=$topic_id&amp;p=$post_id") . '#p' . $post_id,
				));
			}
		}
	}

	/**
	 * @return array
	 */
	private function get_posts_data()
	{
		$topic_ids = $post_ids = array();
		${$this->settings['ids_type'] . '_ids'} = array_filter(explode(',', $this->settings['ids']));
		$range_info = $this->date_range->get($this->settings['date_range']);

		$sql_array = $this->forum_data->query(false)
			->fetch_forum($this->get_allowed_forums())
			->fetch_topic_type($this->settings['topic_type'])
			->fetch_topic($topic_ids)
			->fetch_date_range($range_info['start'], $range_info['stop'])
			->build(true, true, false)
			->get_sql_array();

		$sql_array['SELECT'] = '';
		$sql_array['WHERE'] .= ' AND p.topic_id = t.topic_id AND p.post_attachment <> 0' . (($this->settings['first_only']) ? ' AND p.post_id = t.topic_first_post_id' : '');

		return $this->forum_data->get_post_data(false, $post_ids, $this->settings['limit'], 0, $sql_array);
	}

	/**
	 * @param array $extensions
	 * @return array
	 */
	protected function get_extension_groups(array $extensions)
	{
		array_shift($extensions);

		$ext_groups = array('' => array());
		foreach ($extensions as $ext => $row)
		{
			$ext_groups[$row['group_name']][] = $ext;
		}

		return $ext_groups;
	}

	/**
	 * @return array
	 */
	private function get_allowed_forums()
	{
		$allowed_forums = array_keys($this->auth->acl_getf('f_download', true));
		if (sizeof($this->settings['forum_ids']))
		{
			$allowed_forums = array_intersect($this->settings['forum_ids'], $allowed_forums);
		}

		return array_map('intval', $allowed_forums);
	}

	/**
	 * @return array
	 */
	private function get_range_options()
	{
		return array(
			''      => 'ALL_TIME',
			'today' => 'TODAY',
			'week'  => 'THIS_WEEK',
			'month' => 'THIS_MONTH',
			'year'  => 'THIS_YEAR',
		);
	}
}
