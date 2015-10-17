<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

use blitze\sitemaker\services\menus\nestedset;

/**
* @package acp
*/
class menu_module
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icon;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $page_title;

	/** @var string */
	public $u_action;

	public function __construct()
	{
		global $phpbb_container, $request, $template, $phpbb_root_path, $phpEx;

		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->mapper_factory = $phpbb_container->get('blitze.sitemaker.mapper.factory');
		$this->icon = $phpbb_container->get('blitze.sitemaker.icon_picker');
		$this->util = $phpbb_container->get('blitze.sitemaker.util');
	}

	public function main()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		$menu_mapper = $this->mapper_factory->create('menus', 'menus');

		// Get all menus
		$collection = $menu_mapper->find();

		if ($collection->valid())
		{
			$menu = (isset($collection[$menu_id])) ? $collection[$menu_id] : $collection->current();
			$menu_id = $menu->get_menu_id();

			foreach ($collection as $entity)
			{
				$id = $entity->get_menu_id();
				$this->template->assign_block_vars('menu', array(
					'ID'		=> $id,
					'NAME'		=> $entity->get_menu_name(),
					'S_ACTIVE'	=> ($id == $menu_id) ? true : false,
				));
			}
		}

		nestedset::load_scripts($this->util);

		$this->util->add_assets(array(
			'js'	=> array(
				'@blitze_sitemaker/assets/menu/admin.min.js',
			),
			'css'	=> array(
				'@blitze_sitemaker/assets/menu/admin.min.css',
			)
		));

		$this->template->assign_vars(array(
			'S_MENU'		=> true,
			'MENU_ID'		=> $menu_id,
			'ICON_PICKER'	=> $this->icon->picker(),
			'T_PATH'		=> $this->phpbb_root_path,
			'UA_MENU_ID'	=> $menu_id,
			'UA_AJAX_URL'   => "{$this->phpbb_root_path}app.{$this->php_ext}/menu/admin/")
		);

		$this->tpl_name = 'acp_menu';
		$this->page_title = 'ACP_MENU';
	}
}
