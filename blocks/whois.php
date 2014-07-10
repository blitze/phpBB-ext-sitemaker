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
 * Whois Block
 */
class whois extends \primetime\primetime\core\blocks\driver\block
{
	/**
	 * phpBB configuration
	 * @var \phpbb\config\config
	 */
	protected $config;

	/**
	 * Template context
	 * @var \phpbb\template\context
	 */
	protected $context;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config		$config		phpBB configuration
	 * @param \phpbb\template\context	$context    Template context
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\template\context $context)
	{
		$this->config = $config;
		$this->context = $context;
	}

	public function display($settings, $edit_mode = false)
	{
		$data = $this->context->get_data_ref();

		$content = '';
		if (!empty($data['.'][0]['TOTAL_USERS_ONLINE']))
		{
			$this->ptemplate->assign_vars(array(
				'TOTAL_USERS_ONLINE'	=> $data['.'][0]['TOTAL_USERS_ONLINE'],
				'LOGGED_IN_USER_LIST'	=> $data['.'][0]['LOGGED_IN_USER_LIST'],
				'RECORD_USERS'			=> $data['.'][0]['RECORD_USERS'],
			));
			unset($data);
			$content = $this->ptemplate->render_view('primetime/primetime', 'blocks/whois.html', 'whois_block');
		}

		return array(
			'title'		=> 'WHO_IS_ONLINE',
			'content'	=> $content
		);
	}
}
