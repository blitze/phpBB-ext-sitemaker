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
 * HTML Block
 */
class html extends \primetime\primetime\core\blocks\driver\block
{
	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

	/**
	 * Constructor method
	 */
	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	public function get_config($settings)
	{
		return array(
			'content'	=> array('type' => 'hidden', 'default' => ''),
		);
	}

	public function display($bdata, $edit_mode = false)
	{
		$content = (isset($bdata['settings']['content'])) ? html_entity_decode($bdata['settings']['content']) : '';

		if ($edit_mode !== false)
		{
			$bid = (isset($bdata['bid'])) ? $bdata['bid'] : 0;
			$content = '<div id="block-editor-' . $bid . '" class="editable-block">' . (($content) ? $content : $this->user->lang['EDIT_ME']) . '</div>';
		}

		return array(
			'title'		=> 'BLOCK_TITLE',
			'content'	=> $content,
		);
	}
}
