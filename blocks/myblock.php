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
* Login Block
*/
class myblock extends \primetime\primetime\core\blocks\driver\block
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

	public function display($bdata, $edit_mode = false)
	{
		$content = (isset($bdata['settings']['content'])) ? $bdata['settings']['content'] : '';
		$content = html_entity_decode($content);

		if ($edit_mode !== false)
		{
			global $phpbb_container;

			$primetime = $phpbb_container->get('primetime');
			$asset_path = $primetime->asset_path;

			$primetime->add_assets(array(
				'js' => array(
					$asset_path . 'ext/primetime/primetime/assets/ckeditor/ckeditor.js',
				)
			));

			$bid = (isset($bdata['bid'])) ? $bdata['bid'] : 0;
			$content = '<div id="block_' . $bid . '" class="editable-block" contenteditable="true">' . (($content) ? $content : $this->user->lang['EDIT_ME']) . '</div>';
		}

		return array(
			'title'		=> 'MY_BLOCK',
			'content'	=> $content,
		);
	}
}
