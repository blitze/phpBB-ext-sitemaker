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

class forum_poll extends block
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum_data;

	/** @var \blitze\sitemaker\services\forum\options */
	protected $forum_options;

	/** @var \blitze\sitemaker\services\groups */
	protected $groups;

	/** @var \blitze\sitemaker\services\poll */
	protected $poll;

	/** @var array */
	protected $settings;

	const FORUMS_ORDER_FIRST_POST = 0;
	const FORUMS_ORDER_LAST_POST = 1;
	const FORUMS_ORDER_LAST_READ = 2;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface			$db	 				Database connection
	 * @param \blitze\sitemaker\services\forum\data		$forum_data			Forum Data object
	 * @param \blitze\sitemaker\services\forum\options	$forum_options		Forum Options Object
	 * @param \blitze\sitemaker\services\groups			$groups				Groups Object
	 * @param \blitze\sitemaker\services\poll			$poll				Poll Object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\services\forum\data $forum_data, \blitze\sitemaker\services\forum\options $forum_options, \blitze\sitemaker\services\groups $groups, \blitze\sitemaker\services\poll $poll)
	{
		$this->db = $db;
		$this->forum_data = $forum_data;
		$this->forum_options = $forum_options;
		$this->groups = $groups;
		$this->poll = $poll;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$forum_options = $this->forum_options->get_all();
		$group_options = $this->groups->get_data();
		$topic_type_options = $this->forum_options->get_topic_types();
		$sort_options = array('' => 'RANDOM', self::FORUMS_ORDER_FIRST_POST	=> 'FIRST_POST_TIME', self::FORUMS_ORDER_LAST_POST => 'LAST_POST_TIME', self::FORUMS_ORDER_LAST_READ => 'LAST_READ_TIME');

		return array(
			'legend1'		=> 'SETTINGS',
			'user_ids'		=> array('lang' => 'POLL_FROM_USERS', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
			'group_ids'		=> array('lang' => 'POLL_FROM_GROUPS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $group_options, 'default' => array(), 'explain' => true),
			'topic_ids'		=> array('lang' => 'POLL_FROM_TOPICS', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
			'forum_ids'		=> array('lang' => 'POLL_FROM_FORUMS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $forum_options, 'default' => array(), 'explain' => true),
			'topic_type'	=> array('lang' => 'TOPIC_TYPE', 'validate' => 'string', 'type' => 'checkbox', 'options' => $topic_type_options, 'default' => array(POST_NORMAL), 'explain' => false),
			'order_by'		=> array('lang' => 'ORDER_BY', 'validate' => 'string', 'type' => 'select', 'options' => $sort_options, 'default' => 0, 'explain' => false),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$this->settings = $bdata['settings'];
		$title = 'POLL';

		if (!($topic_data = $this->get_topic_data()))
		{
			return array(
				'title'		=> $title,
				'content'	=> '',
			);
		}

		$this->poll->build($topic_data, $this->ptemplate);

		return array(
			'title'		=> $title,
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/forum_poll.html', 'forum_poll_block')
		);
	}

	/**
	 * @return array|null
	 */
	private function get_topic_data()
	{
		$sql_array = array(
			'WHERE'		=> array(
				't.poll_start <> 0',
			),
		);

		$this->limit_by_group($sql_array);

		$this->forum_data->query(false)
			->fetch_forum($this->settings['forum_ids'])
			->fetch_topic_type($this->settings['topic_type'])
			->fetch_topic($this->get_array($this->settings['topic_ids']))
			->fetch_topic_poster($this->get_array($this->settings['user_ids']))
			->set_sorting($this->get_sorting())
			->fetch_custom($sql_array)
			->build(true, true, false);
		$topic_data = $this->forum_data->get_topic_data(1);

		return array_shift($topic_data);
	}

	/**
	 * @param array $sql_array
	 */
	private function limit_by_group(array &$sql_array)
	{
		if (!empty($this->settings['group_ids']))
		{
			$sql_array['FROM'][USER_GROUP_TABLE] = 'ug';
			$sql_array['WHERE'][] = 't.topic_poster = ug.user_id';
			$sql_array['WHERE'][] = $this->db->sql_in_set('ug.group_id', $this->settings['group_ids']);
		}
	}

	/**
	 * @param string $string
	 * @return array
	 */
	private function get_array($string)
	{
		return array_filter(explode(',', str_replace(' ', '', $string)));
	}

	/**
	 * @return string
	 */
	private function get_sorting()
	{
		$sort_order = array(
			self::FORUMS_ORDER_FIRST_POST		=> 't.topic_time',
			self::FORUMS_ORDER_LAST_POST		=> 't.topic_last_post_time',
			self::FORUMS_ORDER_LAST_READ		=> 't.topic_last_view_time'
		);

		return (isset($sort_order[$this->settings['order_by']])) ? $sort_order[$this->settings['order_by']] : 'RAND()';
	}
}
