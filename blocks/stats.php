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
* Stats Block
*/
class stats implements \primetime\primetime\core\iblock
{
	/**
	 * Constructor method
	 */
	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	public function config()
	{
		return array();
	}

	public function display($settings, $edit_mode = false)
	{
		global $config;

		$content = '';
		$content .= $this->user->lang('TOTAL_POSTS_COUNT', (int) $config['num_posts']) . '<br />';
		$content .= $this->user->lang('TOTAL_TOPICS', (int) $config['num_topics']) . '<br />';
		$content .= $this->user->lang('TOTAL_USERS', (int) $config['num_users']) . '<br />';
		$content .= $this->user->lang('NEWEST_USER', get_username_string('full', $config['newest_user_id'], $config['newest_username'], $config['newest_user_colour']));

		return array(
			'title'		=> $this->user->lang['STATISTICS'],
			'content'	=> $content, 
		);
	}
}
