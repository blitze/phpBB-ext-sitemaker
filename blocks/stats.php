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
* Stats Block
*/
class stats extends block
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config			$config		phpBB configuration
	 * @param \phpbb\template\template		$template	Template object
	 * @param \phpbb\user					$user       User object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $settings, $edit_mode = false)
	{
		$content = '';
		$content .= $this->user->lang('TOTAL_POSTS_COUNT', (int) $this->config['num_posts']) . '<br />';
		$content .= $this->user->lang('TOTAL_TOPICS', (int) $this->config['num_topics']) . '<br />';
		$content .= $this->user->lang('TOTAL_USERS', (int) $this->config['num_users']) . '<br />';
		$content .= $this->user->lang('NEWEST_USER', get_username_string('full', $this->config['newest_user_id'], $this->config['newest_username'], $this->config['newest_user_colour']));

		$this->template->assign_var('NEWEST_USER', false);

		return array(
			'title'		=> 'STATISTICS',
			'content'	=> $content,
		);
	}
}
