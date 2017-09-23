<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

/**
* Menu Block
* @package phpBB Sitemaker Main Menu
*/
class menu extends links
{
	/** @var string */
	protected $title = 'MENU';

	/** @var string */
	protected $tpl_name = 'menu';

	/** @var bool */
	protected $is_navigation = true;

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$menu_options = $this->navigation->get_menu_options();
		$depth_options = $this->get_depth_options();

		return array(
			'legend1'       => 'SETTINGS',
			'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'options' => $menu_options, 'default' => 0, 'explain' => false),
			'expanded'		=> array('lang' => 'EXPANDED', 'validate' => 'bool', 'type' => 'radio:yes_no', 'default' => 0, 'explain' => false),
			'max_depth'		=> array('lang' => 'MAX_DEPTH', 'validate' => 'int', 'type' => 'select', 'options' => $depth_options, 'default' => 3, 'explain' => false),
		);
	}

	/**
	 * @return int[]
	 */
	protected function get_depth_options()
	{
		$options = array();
		for ($i = 3; $i < 10; $i++)
		{
			$options[$i] = $i;
		}

		return $options;
	}
}
