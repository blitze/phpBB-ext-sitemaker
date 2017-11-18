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
 * Featured Member Block
 */
class member_menu extends block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum_data;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth				Permission object
	 * @param \phpbb\user								$user				User object
	 * @param \blitze\sitemaker\services\forum\data		$forum_data			Forum Data object
	 * @param \blitze\sitemaker\services\util			$util				utility Object
	 * @param string									$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string									$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\user $user, \blitze\sitemaker\services\forum\data $forum_data, \blitze\sitemaker\services\util $util, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->user = $user;
		$this->forum_data = $forum_data;
		$this->util = $util;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$content = '';
		if ($this->user->data['is_registered'])
		{
			$this->ptemplate->assign_vars(array(
				'USER_AVATAR'	=> $this->get_user_avatar(),
				'USERNAME'		=> get_username_string('full', $this->user->data['user_id'], $this->user->data['username'], $this->user->data['user_colour']),
				'USER_POSTS'	=> $this->user->data['user_posts'],
				'NEW_POSTS'		=> $this->get_new_posts_count(),

				'U_PROFILE'		=> append_sid($this->phpbb_root_path . 'memberlist.' . $this->php_ext, 'mode=viewprofile&amp;u=' . $this->user->data['user_id']),
				'U_SEARCH_NEW'	=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, 'search_id=newposts'),
				'U_SEARCH_SELF'	=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, 'search_id=egosearch'),
				'U_PRIVATE_MSG'	=> append_sid($this->phpbb_root_path . 'ucp.' . $this->php_ext, 'i=pm&amp;folder=inbox'),
				'U_LOGOUT'		=> append_sid($this->phpbb_root_path . 'ucp.' . $this->php_ext, 'mode=logout', true, $this->user->session_id),
				'U_MCP' 		=> $this->get_mcp_url(),
				'U_ACP'			=> $this->get_acp_url(),
			));

			$content = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/member_menu.html', 'member_menu_block');
		}

		return array(
			'title'		=> 'WELCOME',
			'content'	=> $content,
		);
	}

	/**
	 * @return string
	 */
	protected function get_user_avatar()
	{
		return ($this->user->data['user_avatar']) ? phpbb_get_user_avatar($this->user->data) : $this->util->get_default_avatar();
	}

	/**
	 * @return string
	 */
	protected function get_mcp_url()
	{
		return ($this->auth->acl_get('m_')) ? append_sid($this->phpbb_root_path . 'mcp.' . $this->php_ext, false, true, $this->user->session_id) : '';
	}

	/**
	 * @return string
	 */
	protected function get_acp_url()
	{
		return ($this->auth->acl_get('a_')) ? append_sid($this->phpbb_root_path . 'adm/index.' . $this->php_ext, 'i=-blitze-sitemaker-acp-menu_module', true, $this->user->session_id) : '';
	}

	/**
	 * @return int
	 */
	protected function get_new_posts_count()
	{
		$sql_array = array(
			'FROM'		=> array(
				POSTS_TABLE		=> 'p',
			),
			'WHERE'		=> array(
				't.topic_id = p.topic_id AND p.post_time > ' . (int) $this->user->data['user_lastvisit'],
			),
		);

		$this->forum_data->query(false, false)
			->fetch_custom($sql_array)
			->build(true, false);

		return (int) $this->forum_data->get_topics_count();
	}
}
