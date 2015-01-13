<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\acp;

/**
* @package acp
*/
class menu_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $phpbb_root_path, $phpEx;
		global $phpbb_container, $request, $template, $user;

		$menu_id = $request->variable('menu_id', 0);

		$manager = $phpbb_container->get('primetime.primetime.menu.builder');
		$icon = $phpbb_container->get('primetime.primetime.icon_picker');
		$primetime = $phpbb_container->get('primetime.primetime');

		$asset_path = $primetime->asset_path;
		$primetime->add_assets(array(
			'js'        => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				'http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js',
				$asset_path . 'ext/primetime/primetime/components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
				$asset_path . 'ext/primetime/primetime/components/jquery.populate/jquery.populate.min.js',
				$asset_path . 'ext/primetime/primetime/components/nestedSortable/jquery.ui.nestedSortable.min.js',
				'@primetime_primetime/assets/tree/builder.min.js',
				'@primetime_primetime/assets/menu/admin.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				'@primetime_primetime/assets/tree/builder.min.css',
				'@primetime_primetime/assets/menu/admin.min.css',
			)
		));

		// Get all menus
		$menus = $manager->menu_get();
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
				$template->assign_block_vars('menu', array(
					'ID'		=> $row['menu_id'],
					'NAME'		=> $row['menu_name'],
					'S_ACTIVE'	=> ($row['menu_id'] == $menu_id) ? true : false)
				);
			}
		}

		$template->assign_vars(array(
			'S_MENU'		=> true,
			'MENU_ID'		=> $menu_id,
			'ICON_PICKER'	=> $icon->picker(),
			'T_PATH'		=> $phpbb_root_path,
			'UA_MENU_ID'	=> $menu_id,
			'UA_AJAX_URL'   => "{$phpbb_root_path}app.$phpEx/menu/admin/")
		);

		$this->tpl_name = 'acp_menu';
		$this->page_title = 'ACP_MENU';
	}
}
