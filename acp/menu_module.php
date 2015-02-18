<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\acp;

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

	/** @var \primetime\core\services\icon_picker */
	protected $icon;

	/** @var \primetime\core\services\menu\builder */
	protected $manager;

	/** @var \primetime\core\util */
	protected $primetime;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	var $tpl_name;

	/** @var string */
	var $page_title;

	/** @var string */
	var $u_action;

	public function __construct()
	{
		global $db, $phpbb_container, $request, $template, $user;
		global $phpbb_root_path, $phpEx;

		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->manager = $phpbb_container->get('primetime.core.menu.builder');
		$this->icon = $phpbb_container->get('primetime.core.icon_picker');
		$this->primetime = $phpbb_container->get('primetime.core.util');
	}

	public function main()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
			'js'        => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				'http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js',
				$asset_path . 'ext/primetime/core/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				$asset_path . 'ext/primetime/core/components/jquery.populate/jquery.populate.min.js',
				$asset_path . 'ext/primetime/core/components/nestedSortable/jquery.ui.nestedSortable.min.js',
				'@primetime_core/assets/tree/builder.min.js',
				'@primetime_core/assets/menu/admin.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				'@primetime_core/assets/tree/builder.min.css',
				'@primetime_core/assets/menu/admin.min.css',
			)
		));

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
