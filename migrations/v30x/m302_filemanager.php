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
class m302_filemanager extends \phpbb\db\migration\container_aware_migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v30x\m17_add_settings_module',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('sm_navbar_menu', 0)),
			array('config.add', array('sm_filemanager', false)),

			array('permission.add', array('u_sm_filemanager', true, 'u_attach')),

			array('custom', array(array($this, 'create_upload_dir'))),
		);
	}

	/**
	 * @return void
	 */
	public function create_upload_dir()
	{
		$fs = $this->container->get('filesystem');

		// create upload folders if they don't exist
		$fs->mkdir($this->phpbb_root_path . 'images/sitemaker_uploads/source', 0766);
		$fs->mkdir($this->phpbb_root_path . 'images/sitemaker_uploads/thumbs', 0744);

		// set filemanager config
		$filemanager_config_tpl = $this->phpbb_root_path . 'filemanager.config';
		$filemanager_config_file = $this->phpbb_root_path . 'ResponsiveFilemanager/filemanager/config/config.' . $this->php_ext;
		$fs->copy($filemanager_config_tpl, $filemanager_config_file, true);
	}
}
