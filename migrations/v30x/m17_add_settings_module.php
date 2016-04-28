<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v30x;

/**
 * Initial schema changes needed for Extension installation
 */
class m17_add_settings_module extends \phpbb\db\migration\container_aware_migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m10_remove_dashboard',
			'\blitze\sitemaker\migrations\v30x\m16_add_block_view_field',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('sm_hide_login', 1)),
			array('config.add', array('sm_hide_online', 1)),
			array('config.add', array('sm_hide_birthday', 1)),
			array('config.add', array('sm_show_forum_nav', 1)),
			array('config.add', array('sm_forum_icon', 'fa fa-comments-o')),

			array('custom', array(array($this, 'set_layout_prefs'))),

			array('permission.add', array('a_sm_settings', true)),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_sm_settings')),

			array('module.add', array(
				'acp', 'ACP_SITEMAKER', array(
					'module_basename'	=> '\blitze\sitemaker\acp\settings_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}

	public function set_layout_prefs()
	{
		$style_id = $this->config['default_style'];
		$layout_prefs = array($style_id => array(
			'layout' => './../ext/blitze/sitemaker/styles/all/template/layouts/portal/',
			'view' => '',
		));

		$config_text = $this->container->get('config_text');
		$config_text->set('sm_layout_prefs', json_encode($layout_prefs));
	}
}
