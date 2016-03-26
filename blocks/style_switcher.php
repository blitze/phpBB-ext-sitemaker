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
 * Style Switcher Block
 */
class style_switcher extends block
{
	/** @var \blitze\sitemaker\services\blocks\display */
	protected $blocks_display;

	/**
	 * Constructor
	 *
	 * @param \blitze\sitemaker\services\blocks\display $blocks_display
	 */
	public function __construct(\blitze\sitemaker\services\blocks\display $blocks_display)
	{
		$this->blocks_display = $blocks_display;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $settings, $edit_mode = false)
	{
		$this->ptemplate->assign_vars(array(
			'CURRENT_PAGE'		=> build_url(array('style')),
			'S_STYLE_OPTIONS'	=> style_select($this->blocks_display->get_style_id(), true),
		));

		return array(
			'title'		=> 'STYLE_SWITCHER',
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/style_switcher.html', 'style_switcher_block')
		);
	}
}
