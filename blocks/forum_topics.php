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
 * Forum Topics Block
 */
class forum_topics extends \primetime\primetime\core\blocks\driver\block
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

		$forum_options = array($this->user->lang['ALL']);
		foreach ($forumlist as $row)
		{
		    $forum_options[$row['forum_id']] = $row['padding'] . $row['forum_name'];
		}

		$topic_type_options = array(POST_NORMAL => 'POST_NORMAL', POST_STICKY => 'POST_STICKY', POST_ANNOUNCE => 'POST_ANNOUNCEMENT', POST_GLOBAL => 'POST_GLOBAL');
		$preview_options = array(0 => 'NO', FORUMS_PREVIEW_FIRST_POST => 'FIRST_POST', FORUMS_PREVIEW_LAST_POST => 'LAST_POST');
		$range_options = array('' => 'ALL_TIME', 'today' => 'TODAY', 'week' => 'THIS_WEEK', 'month' => 'THIS_MONTH', 'year' => 'THIS_YEAR');
        $sort_options = array(FORUMS_ORDER_FIRST_POST	=> 'FIRST_POST_TIME', FORUMS_ORDER_LAST_POST => 'LAST_POST_TIME', FORUMS_ORDER_LAST_READ => 'LAST_READ_TIME');
        $template_options = array('titles' => 'TITLES', 'mini' => 'MINI', 'context' => 'CONTEXT', 'full' => 'FULL');

		$forum_ids	=& $settings['forum_ids'];
		$topic_type	=& $settings['topic_type'];
		$preview	=& $settings['display_preview'];
		$date_range	=& $settings['date_range'];
		$sorting	=& $settings['order_by'];
		$template	= (isset($settings['template'])) ? $settings['template'] : 'mini';

		return array(
			'legend1'			=> $this->user->lang['SETTINGS'],
            'forum_ids'			=> array('lang' => 'SELECT_FORUMS', 'validate' => 'string', 'type' => 'select', 'size' => 4, 'function' => 'build_select', 'params' => array($forum_options, $forum_ids), 'default' => 0, 'explain' => false),
            'topic_type'		=> array('lang' => 'TOPIC_TYPE', 'validate' => 'int', 'type' => 'select', 'function' => 'build_select', 'params' => array($topic_type_options, $topic_type), 'default' => 0, 'explain' => false),
			'enable_tracking'	=> array('lang' => 'ENABLE_TOPIC_TRACKING', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
			'topic_title_limit'	=> array('lang' => 'TOPIC_TITLE_LIMIT', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 25),
			'max_topics'		=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
            'display_preview'	=> array('lang' => 'DISPLAY_PREVIEW', 'validate' => 'int', 'type' => 'select', 'function' => 'build_select', 'params' => array($preview_options, $preview), 'default' => 0, 'explain' => false),
			'preview_max_chars'	=> array('lang' => 'PREVIEW_MAX_CHARS', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 25),
            'date_range'		=> array('lang' => 'LIMIT_POST_TIME', 'validate' => 'string', 'type' => 'select', 'function' => 'build_select', 'params' => array($range_options, $date_range), 'default' => '', 'explain' => false),
            'order_by'			=> array('lang' => 'ORDER_BY', 'validate' => 'string', 'type' => 'select', 'function' => 'build_select', 'params' => array($sort_options, $sorting), 'default' => '', 'explain' => false),
            'template'			=> array('lang' => 'TEMPLATE', 'validate' => 'string', 'type' => 'select', 'function' => 'build_select', 'params' => array($template_options, $template), 'default' => '', 'explain' => false),
        );
	}

	/**
	 * 
	 */
	public function display($bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];

		$options = array(
			'forum_id'			=> $settings['forum_ids'],
			'tracking_info'		=> $settings['enable_tracking'],
			'topic_type'		=> $settings['topic_type'],
		);
		$this->forum->build_query($options);
		$topic_data = $this->forum->get_topic_data();

		if (sizeof($topic_data))
		{
			$this->ptemplate->assign_var('topics', $topic_data);	

			return array(
				'title'		=> 'Forum Topics',
				'content'	=> $this->ptemplate->render_view('primetime/primetime', 'blocks/forum_topics.html', 'forum_topics_block')
			);
		}
	}
}
