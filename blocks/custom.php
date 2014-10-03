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
 * Custom Block
 */
class custom extends \primetime\primetime\core\blocks\driver\block
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
			global $phpbb_container;

			$phpbb_container->get('primetime')->add_assets(array(
				'js' => array(
					'//cdn.ckeditor.com/4.4.5/standard/ckeditor.js',
				)
			));

			$bid = (isset($bdata['bid'])) ? $bdata['bid'] : 0;
			$content = '<div id="block-editor-' . $bid . '" class="editable-block" contenteditable="true">' . (($content) ? $content : $this->user->lang['EDIT_ME']) . '</div>';
		}

		return array(
			'title'		=> 'BLOCK_TITLE',
			'content'	=> $content,
		);
	}
}
