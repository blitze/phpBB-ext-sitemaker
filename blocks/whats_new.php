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
* Menu Block
* @package phpBB Primetime Menu
*/
class whats_new  extends \primetime\primetime\core\blocks\driver\block
{
	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Forum object
	 * @var \primetime\primetime\core\forum\query
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
	 * @param \primetime\primetime\core\forum\query	$forum				Forum object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\user $user, \primetime\primetime\core\forum\query $forum, $phpbb_root_path, $php_ext)
	{
		$this->user = $user;
		$this->forum = $forum;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function get_config($settings)
	{
		return array(
			'legend1'		=> $this->user->lang['SETTINGS'],
			'topics_only'	=> array('lang' => 'TOPICS_ONLY', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
			'max_topics'	=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
       );
	}

	public function display($db_data, $edit_mode = false)
	{
		$topics_only = $db_data['settings']['topics_only'];

		$options = array(
			'sort_key'	=> ($topics_only) ? 't.topic_last_post_time' : 'p.post_time',
		);

		if ($topics_only)
		{
			$sql_array = array(
				'FROM'		=> array(
					TOPICS_TABLE	=> 't',
				),
				'WHERE'		=> 't.topic_last_post_time > ' . $this->user->data['user_lastvisit'] . '
							AND t.topic_moved_id = 0',
			);
		}
		else
		{
			$sql_array = array(
				'FROM'		=> array(
					POSTS_TABLE		=> 'p',
				),
				'WHERE'		=> 't.topic_id = p.topic_id AND p.post_time > ' . $this->user->data['user_lastvisit'],
			);
		}

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

		$this->ptemplate->assign_var('NO_RECORDS', ($topics_only) ? $this->user->lang['NO_NEW_TOPICS'] : $this->user->lang['NO_NEW_POSTS']);

		return array(
            'title'     => 'WHATS_NEW',
            'content'   => $this->ptemplate->render_view('primetime/primetime', 'blocks/topiclist.html', 'whats_new'),
        );
	}
}
