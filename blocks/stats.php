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
class stats extends \primetime\primetime\core\blocks\driver\block
{
	/**
	* phpBB configuration
	* @var \phpbb\config\config
	*/
	protected $config;

	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config	$config		phpBB configuration
	 * @param \phpbb\user			$user       User object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\user $user)
	{
		$this->config = $config;
		$this->user = $user;
	}

	public function display($settings, $edit_mode = false)
	{
		$content = '';
		$content .= $this->user->lang('TOTAL_POSTS_COUNT', (int) $this->config['num_posts']) . '<br />';
		$content .= $this->user->lang('TOTAL_TOPICS', (int) $this->config['num_topics']) . '<br />';
		$content .= $this->user->lang('TOTAL_USERS', (int) $this->config['num_users']) . '<br />';
		$content .= $this->user->lang('NEWEST_USER', get_username_string('full', $this->config['newest_user_id'], $this->config['newest_username'], $this->config['newest_user_colour']));

		return array(
			'title'		=> 'STATISTICS',
			'content'	=> $content, 
		);
	}
}
