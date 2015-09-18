<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

/**
* @package acp
*/
class menu_module
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icon;

	/** @var \blitze\sitemaker\services\menu\builder */
	protected $manager;

	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	protected $tpl_name;

	/** @var string */
	protected $page_title;

	/** @var string */
	protected $u_action;

	public function __construct()
	{
		global $db, $phpbb_container, $request, $template, $phpbb_root_path, $phpEx;

		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->manager = $phpbb_container->get('blitze.sitemaker.menu.builder');
		$this->icon = $phpbb_container->get('blitze.sitemaker.icon_picker');
		$this->sitemaker = $phpbb_container->get('blitze.sitemaker.util');
	}

	public function main()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		$this->manager->init();

		// Get all menus
		$menus = $this->manager->menu_get();
		$menus = array_values(array_filter($menus));

		if (sizeof($menus))
		{
			if (!$menu_id)
			{
				$menu_id = (int) $menus[0]['menu_id'];
			}

			for ($i = 0, $size = sizeof($menus); $i < $size; $i++)
			{
				$row = $menus[$i];
				$this->template->assign_block_vars('menu', array(
					'ID'		=> $row['menu_id'],
					'NAME'		=> $row['menu_name'],
					'S_ACTIVE'	=> ($row['menu_id'] == $menu_id) ? true : false)
				);
			}
		}

		$this->sitemaker->add_assets(array(
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
