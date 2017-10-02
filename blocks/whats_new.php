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
* What's New Block
*/
class whats_new extends block
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum_data;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language				$translator			Language object
	 * @param \phpbb\user							$user				User object
	 * @param \blitze\sitemaker\services\forum\data	$forum_data			Forum Data object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\forum\data $forum_data, $phpbb_root_path, $php_ext)
	{
		$this->translator = $translator;
		$this->user = $user;
		$this->forum_data = $forum_data;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'		=> 'SETTINGS',
			'topics_only'	=> array('lang' => 'TOPICS_ONLY', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
			'max_topics'	=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		if (!$this->user->data['is_registered'])
		{
			return array(
				'title'		=> '',
				'content'	=> '',
			);
		}
		else
		{
			$this->fetch_new($bdata['settings']);

			return array(
				'title'     => 'WHATS_NEW',
				'content'   => $this->ptemplate->render_view('blitze/sitemaker', 'blocks/topiclist.html', 'whats_new'),
			);
		}
	}

	/**
	 * @param array $settings
	 */
	private function fetch_new(array $settings)
	{
		$topic_data = $this->get_topics($settings);

		for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
		{
			$row = $topic_data[$i];
			$forum_id = $row['forum_id'];
			$topic_id = $row['topic_id'];

			$this->ptemplate->assign_block_vars('topicrow', array(
				'TOPIC_TITLE'    => censor_text($row['topic_title']),
				'U_VIEWTOPIC'    => append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"),
			));
			unset($topic_data[$i]);
		}

		$this->ptemplate->assign_var('NO_RECORDS', ($settings['topics_only']) ? $this->translator->lang('NO_NEW_TOPICS') : $this->translator->lang('NO_NEW_POSTS'));
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	private function get_topics(array $settings)
	{
		if ($settings['topics_only'])
		{
			$sorting = 't.topic_last_post_time';
			$sql_array = $this->get_topics_sql();
		}
		else
		{
			$sorting = 'p.post_time';
			$sql_array = $this->get_posts_sql();
		}

		$this->forum_data->query(false)
			->set_sorting($sorting)
			->fetch_custom($sql_array)
			->build(true, false);
		$topic_data = $this->forum_data->get_topic_data($settings['max_topics']);

		return array_values($topic_data);
	}

	/**
	 * @return array
	 */
	private function get_topics_sql()
	{
		return array(
			'WHERE'		=> array(
				't.topic_last_post_time > ' . (int) $this->user->data['user_lastvisit'],
				't.topic_moved_id = 0',
			),
		);
	}

	/**
	 * @return array
	 */
	private function get_posts_sql()
	{
		return array(
			'FROM'		=> array(
				POSTS_TABLE		=> 'p',
			),
			'WHERE'		=> array(
				't.topic_id = p.topic_id AND p.post_time > ' . (int) $this->user->data['user_lastvisit'],
			),
		);
	}
}
