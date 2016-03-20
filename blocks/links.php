<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\menus\menu_block;

/**
* Links Block
* @package phpBB Sitemaker
*/
class links extends menu_block
{
	/** @var \blitze\sitemaker\services\menus\display */
	protected $tree;

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$menu_options = $this->get_menu_options();

		return array(
			'legend1'       => 'SETTINGS',
			'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'options' => $menu_options, 'default' => 0, 'explain' => false),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $db_data, $editing = false)
	{
		$title = 'LINKS';
		$menu_id = $db_data['settings']['menu_id'];

		$data = $this->_get_menu($menu_id);

		if (!sizeof($data))
		{
			return array(
				'title'		=> $title,
				'content'	=> $this->_get_message($menu_id, $editing),
			);
		}

		$this->tree->display_list($data, $this->ptemplate, 'tree');

		return array(
			'title'     => $title,
			'content'   => $this->ptemplate->render_view('blitze/sitemaker', 'blocks/links.html', 'links_block'),
		);
	}
}
