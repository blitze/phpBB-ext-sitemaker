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
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

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

		$manager = $phpbb_container->get('primetime.menu.builder');
		$icon = $phpbb_container->get('primetime.icon_picker');
		$primetime = $phpbb_container->get('primetime');

		$asset_path = $primetime->asset_path;
		$primetime->add_assets(array(
            'js'        => array(
            	'//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js',
            	'http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js',
                $asset_path . 'ext/primetime/primetime/assets/js/jquery.populate.pack.js',
                $asset_path . 'ext/primetime/primetime/assets/tree/nestedSortable.js',
                $asset_path . 'ext/primetime/primetime/assets/tree/builder.js',
                $asset_path . 'ext/primetime/primetime/assets/menu/js/admin.js',
            ),
            'css'   => array(
            	'//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css',
                $asset_path . 'ext/primetime/primetime/assets/tree/builder.css',
                $asset_path . 'ext/primetime/menu/assets/menu/css/admin.css',
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
	}
}
