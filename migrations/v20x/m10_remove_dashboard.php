<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v20x;

/**
 * Initial schema changes needed for Extension installation
 */
class m10_remove_dashboard extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m4_initial_module',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		$dashboard_exists = $this->module_exists('ACP_SITEMAKER_EXTENSIONS');

		return array(
			// Remove all ACP modules, if one exists
			array('if', array(
				($dashboard_exists),
				array('module.remove', array('acp', 'ACP_SITEMAKER_EXTENSIONS', array(
					'module_langname'	=> 'MENU',
					'module_mode'		=> 'menu',
				))),
			)),
			array('if', array(
				($dashboard_exists),
				array('module.remove', array('acp', 'ACP_CAT_SITEMAKER', array(
					'module_langname'	=> 'SITEMAKER_DASHBOARD',
					'module_mode'		=> 'dashboard',
				))),
			)),
			array('if', array(
				($dashboard_exists),
				array('module.remove', array('acp', 'SITEMAKER', 'ACP_SITEMAKER_EXTENSIONS')),
			)),
			array('if', array(
				($dashboard_exists),
				array('module.remove', array('acp', 'SITEMAKER', 'ACP_CAT_SITEMAKER')),
			)),
			array('if', array(
				($dashboard_exists),
			array('module.remove', array('acp', 0, 'SITEMAKER')),
			)),

			// Add Menu module to Extensions tab
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_SITEMAKER')),
			array('module.add', array(
				'acp', 'ACP_SITEMAKER', array(
					'module_basename'	=> '\blitze\sitemaker\acp\menu_module',
					'modes'				=> array('menu'),
				),
			)),
		);
	}

	/**
	 * @param string $langname
	 * @return bool
	 */
	function module_exists($langname)
	{
		$sql = 'SELECT module_langname 
			FROM ' . $this->table_prefix . "modules
			WHERE module_langname='" . $this->db->sql_escape($langname) . "'";
		$result = $this->db->sql_query($sql);
		$exists = $this->db->sql_fetchfield('module_langname');
		$this->db->sql_freeresult($result);

		return ($exists) ? true : false;
	}
}
