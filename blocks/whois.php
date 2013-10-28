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
class whois implements \blitze\primetime\core\iblock
{
	/**
	* Primetime object
	* @var \primetime\primetime\core\primetime
	*/
	protected $primetime;

	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\user                			$user       User object
	* @param \primetime\primetime\core\primetime	$primetime	Primetime helper object
	*/
	public function __construct(\phpbb\user $user, \primetime\primetime\core\primetime $primetime)
	{
		$this->user = $user;
		$this->primetime = $primetime;
	}

	public function config()
	{
		return array();
	}

	public function display($settings, $edit_mode = false)
	{
		return array(
			'title'		=> $this->user->lang['WHO_IS_ONLINE'],
			'content'	=> $this->primetime->render_block('primetime/primetime', 'blocks/whois.html', 'whois_block')
		);
	}
}
