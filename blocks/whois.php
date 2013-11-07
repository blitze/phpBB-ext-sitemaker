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
	public function __construct(\phpbb\config\config $config, \phpbb\user $user, \phpbb\template\context $context)
	{
		$this->config = $config;
		$this->user = $user;
		$this->context = $context;
	}

	public function display($settings, $edit_mode = false)
	{
		$data = $this->context->get_data_ref();

		$this->btemplate->assign_vars(array(
			'TOTAL_USERS_ONLINE'	=> $data['.'][0]['TOTAL_USERS_ONLINE'],
			'LOGGED_IN_USER_LIST'	=> $data['.'][0]['LOGGED_IN_USER_LIST'],
			'RECORD_USERS'			=> $data['.'][0]['RECORD_USERS'],
		));
		unset($data);

		return array(
			'title'		=> $this->user->lang['WHO_IS_ONLINE'],
			'content'	=> $this->render_block('primetime/primetime', 'blocks/whois.html', 'whois_block')
		);
	}
}
