<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\blocks;

/**
* Menu Block
* @package phpBB Primetime Menu
*/
class mybookmarks  extends \primetime\core\services\blocks\driver\block
{
	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Forum object
	 * @var \primetime\core\services\forum\query
	 */
	protected $forum;

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user							$user				User object
	 * @param \primetime\core\services\forum\query	$forum				Forum object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\user $user, \primetime\core\services\forum\query $forum, $phpbb_root_path, $php_ext)
	{
		$this->user = $user;
		$this->forum = $forum;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function get_config($settings)
	{
		return array(
			'max_topics'	=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
		);
	}

	public function display($db_data, $edit_mode = false)
	{
		if (!$this->user->data['is_registered'] || $this->user->data['is_bot'])
		{
			return array();
		}

		$options = array(
			'enable_caching'	=> false,
			'sort_key'			=> 't.topic_last_post_time',
		);

		$sql_array = array(
			'FROM'		=> array(
				BOOKMARKS_TABLE		=> 'b',
			),
			'WHERE'		=> 'b.user_id = ' . $this->user->data['user_id'] . ' AND b.topic_id = t.topic_id',
		);

		$test = $this->forum->build_query($options, $sql_array);
		$topic_data = $this->forum->get_topic_data($db_data['settings']['max_topics']);

		if (sizeof($topic_data) || $edit_mode !== false)
		{
			$topic_data = array_values($topic_data);
			for ($i = 0, $size = sizeof($topic_data); $i < $size; $i++)
			{
				$row = $topic_data[$i];
				$forum_id = $row['forum_id'];
				$topic_id = $row['topic_id'];

				$this->ptemplate->assign_block_vars('topicrow', array(
					'TOPIC_TITLE'    => censor_text($row['topic_title']),
					'U_VIEWTOPIC'    => append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, "f=$forum_id&amp;t=$topic_id"))
				);
				unset($topic_data[$i]);
			}
		}

		$this->ptemplate->assign_var('NO_RECORDS', $this->user->lang['NO_BOOKMARKS']);

		return array(
			'title'     => 'MY_BOOKMARKS',
			'content'   => $this->ptemplate->render_view('primetime/core', 'blocks/topiclist.html', 'mybookmarks'),
		);
	}
}
