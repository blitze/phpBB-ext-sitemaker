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
* Links Block
* @package phpBB Sitemaker
*/
class links extends block
{
	/** @var \phpbb\language\language */
	protected $language;

	/** @var \blitze\sitemaker\services\menus\navigation */
	protected $navigation;

	/** @var string */
	protected $title = 'LINKS';

	/** @var string */
	protected $tpl_name = 'links';

	/** @var bool */
	protected $is_navigation = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language						$language		Language object
	 * @param \blitze\sitemaker\services\menus\navigation	$navigation		sitemaker navigation object
	 */
	public function __construct(\phpbb\language\language $language, \blitze\sitemaker\services\menus\navigation $navigation)
	{
		$this->language = $language;
		$this->navigation = $navigation;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$menu_options = $this->navigation->get_menu_options();

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
		$menu_id = $db_data['settings']['menu_id'];

		if (!$this->navigation->build_menu($this->ptemplate, $menu_id, $this->is_navigation, $db_data['settings']))
		{
			return array(
				'title'		=> $this->title,
				'content'	=> $this->get_message($menu_id, $editing),
				'status'	=> (int) !$editing,
			);
		}

		return array(
			'title'     => $this->title,
			'content'   => $this->ptemplate->render_view('blitze/sitemaker', 'blocks/' . $this->tpl_name . '.html', $this->tpl_name . '_block'),
		);
	}

	/**
	 * @param int $menu_id
	 * @param bool $editing
	 * @return string
	 */
	protected function get_message($menu_id, $editing)
	{
		$msg_key = '';
		if ($editing)
		{
			$msg_key = ($menu_id) ? 'MENU_NO_ITEMS' : 'SELECT_MENU';
		}

		return $this->language->lang($msg_key);
	}
}
